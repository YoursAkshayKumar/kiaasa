<?php 
defined('BASEPATH') or exit('no dierct script access allowed');

class Product_m extends MY_Model {

	protected $tbl_name = 'products';
    protected $primary_col = 'product_id';
    protected $order_by = 'created_on';

    public function __construct()
	{
		parent::__construct();   
	}


	public function getProduct(){
		$requestData = $_REQUEST;
        $start = (int)$requestData['start'];

        $sql = "select 
                p.product_id, 
                p.product_name, 
                p.mrp, 
                p.sell_price, 
                i.thumbnail, 
                b.brand_name,
                c.category_name
                from products as p 
                join brand as b 
                on p.brand_id = b.brand_id
                join images as i 
                on p.thumbnail = i.image_id
                join category as c 
                on p.category_id = c.category_id
                ";

        //echo $sql;
        $query = $this->db->query($sql);
        $queryqResults = $query->result();
        $totalData = $query->num_rows(); // rules datatable
        $totalFiltered = $totalData; // rules datatable

        if (!empty($requestData['search']['value'])) { // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $searchValue = $requestData['search']['value'];
            // $this->db->like('product_name', $searchValue);
            // $this->db->or_like('mobile', $searchValue);
            // $this->db->or_like('email', $searchValue);
            // $this->db->or_like('profile', $searchValue);
        }

        $query = $this->db->query($sql);
        $totalFiltered = $query->num_rows();
        $sql.= " order by p.product_id asc limit " . $start . " ," . $requestData['length'] . "   ";
        $query = $this->db->query($sql);

        $SearchResults = $query->result();


        $data = array();
        $counter = 0;
        foreach ($SearchResults as $row) {
            $counter++;
            $nestedData = array();
            $id = $row->product_id;
            // $crypted_id = $this->outh_m->Encryptor('encrypt', $id);
            $action = $this->data_table_factory_model->productsButtonFactory($id);
            $columnFactory = $this->data_table_factory_model->productsColumnFactory($row);
            $tableCol = $this->data_table_factory_model->drawCustomTableData($counter, $id, $columnFactory,$row);
            $j = 0;
            foreach ($tableCol as $key => $value) {
                $nestedData[] = $tableCol[$j];
                $j++;
            }
            $nestedData[] = $action;
            $data[] = $nestedData;
        }
        return $json_data = array("draw" => intval($requestData['draw']), "recordsTotal" => intval($totalData), // total number of records
        "recordsFiltered" => intval($totalFiltered), // total number of records after searching,
        "data" => $data
        // total data array
        );
        // FUNCTION ENDS
    }

    public function getProductById($id){
        $this->db->select(
                            'p.product_id,
                             p.brand_id,
                             p.category_id,
                             p.sub_category,
                             p.sub_category_type,
                             p.gst_id,
                             p.type, 
                             p.type, 
                             p.product_name,
                             p.mrp,
                             p.sell_price,
                             p.status,
                             p.thumbnail as image_id,
                             i.thumbnail
                             '
                        );
        $this->db->from('products as p');
        $this->db->join('images as i', 'p.thumbnail = i.image_id');
        $this->db->where('p.product_id', $id);
        $data = $this->db->get()->row();
        $data->thumbnail = BASEURL.'upload/'.$data->thumbnail;
        return $data;
        // FUNCTION ENDS
    }


    public function getAllProduct(){

        $data = 



        // $this->db->select(
            //     'p.id,
            //      p.product_name,
            //      p.product_barcode,
            //      p.product_sku,
            //      p.vendor_product_sku,
            //      p.category_id,
            //      p.subcategory_id,
            //      p.product_description,
            //      p.base_price,
            //      p.sale_price,
            //      p.size_id,
            //      p.color_id,
            //      p.push_demand_booked,
            //      p.sale_category,
            //      p.story_id,
            //      p.season_id,
            //      p.product_type,
            //      p.hsn_code,
            //      p.user_id,
            //      p.gst_inclusive,
            //      p.custom_product,
            //      p.arnon_product,
            //      p.supplier_name,
            //      p.product_rate_updated,
            //      p.status,
            //      p.is_deleted,
            //      p.created_at
            //     '
            // );

            $this->db->select(
                'p.id,
                 p.product_name,
                 p.base_price,
                 p.sale_price,
                 p.category_id
                '
            );
    
            $this->db->from('pos_product_master as p');

            if($this->input->post('store_id')){
                $productIds =  $this->product_inventory_m->getProductByStoreId($this->input->post('store_id'));
                $this->db->where_in('p.id', $productIds);
            }
            
            if($this->input->post('category_id')){
                $this->db->where('p.category_id', $this->input->post('category_id'));
                
            }

            if($this->input->post('min_price')){
                $this->db->where('p.base_price >=', $this->input->post('min_price'));
                
            }

            if($this->input->post('color_id')){
                $this->db->where('p.sale_price <=', $this->input->post('color_id'));
            }

            
            
            $this->db->limit($this->input->post('limit'), $this->input->post('offset'));
            $this->db->order_by('p.id DESC');    
            $products = $this->db->get()->result_array();

            // $size = array(
            //     0 => array(
            //         "id" => "1",
            //         "size" => "s",
            //     ),
            //     1 => array(
            //         "id" => "1",
            //         "size" => "m",
            //     ),
            //     2 => array(
            //         "id" => "1",
            //         "size" => "l",
            //     ),
            // );


            foreach ($products as $key => $p) {
                $product_img = $this->image_m->get_image_by_product_id($p['id']);
                $products[$key]['product_img_url'] = $product_img;
                // $products[$key]['size'] = $size;
            }

            return $products;

    }   

//end class

}
