<?php
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Product extends REST_Controller {

	public function __construct(){
		parent::__construct();
	}

    
    public function getProduct_post() {
        $method = $this->_detect_method();
        if (!$method == 'GET') {
            $this->response(['status' => 400, 'messsage'=>'error', 'description' => 'Bad request.'], REST_Controller::HTTP_BAD_REQUEST);
            exit();
        }
        else{
            $limit = $this->input->post('limit');
            $min_price = $this->input->post('min_price');
            $max_price = $this->input->post('max_price');


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
                $productIds =  $this->product_inventory_m->getProductByStoreId($this->input->post('store_id'), $limit);
                $this->db->where_in('p.id', $productIds);
            }
            
            if($this->input->post('category_id')){
                $this->db->where('p.category_id', $this->input->post('category_id'));
            }

            if($this->input->post('min_price')){
                $this->db->where('p.base_price >=', $min_price);
            }

            if($this->input->post('max_price')){
                $this->db->where('p.sale_price <=', $max_price);
            }

            $this->db->limit($limit);
            $this->db->order_by('p.id DESC');    
            $products = $this->db->get()->result_array();

            foreach ($products as $key => $p) {
                $product_img = $this->image_m->get_image_by_product_id($p['id']);
                $products[$key]['product_img_url'] = $product_img;
            }

    
    
            if (empty($products)) {
                $response = ['status' => 200, 'message' => 'success', 'description' => 'There is no product'];
            } else {
                $response = ['status' => 200, 'message' => 'success', 'description' => 'Product fetch successfully.', 'data' => $products];
            }
    


            $this->response($response, REST_Controller::HTTP_OK);
            exit();
        }
    }

    





//CLASS ENDS
}