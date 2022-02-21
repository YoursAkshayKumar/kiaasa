<?php
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Category extends REST_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function getCategory_post() {
        $method = $this->_detect_method();
        if (!$method == 'POST') {
            $this->response(['status' => 400, 'messsage'=>'error', 'description' => 'Bad request.'], REST_Controller::HTTP_BAD_REQUEST);
            exit();
        }
        else{
            $this->db->select('c.id, c.name, c.product_style, c.parent_id, c.type_id, c.status, c.is_deleted, c.created_at');
            $this->db->from('product_category_master as c');
            // $this->db->where('c.is_deleted =', 0);
            
            $category = $this->db->get()->result_array();
    
            // foreach($category as $key => $c){
            //     $category[$key]['actual'] = BASEURL.'upload/'.$c['actual'];
            // 	$category[$key]['thumbnail'] = BASEURL.'upload/'.$c['thumbnail'];
            // 	$this->db->select('sc.sub_category_id, sc.sub_category_name, sc.thumbnail, sc.product_count, i.actual, i.thumbnail');
            // 	$this->db->from('sub_category as sc');
            // 	$this->db->where('sc.category_id', $c['category_id']);
            // 	$this->db->where('sc.product_count >', 0);
            // 	$this->db->join('images as i', 'sc.thumbnail = i.image_id');
            // 	$subCategory = $this->db->get()->result_array();
    
            
    
            // 	$category[$key]['sub_category'] = $subCategory;
    
                
            // }
            if (empty($category)) {
                $response = ['status' => 200, 'message' => 'success','description' =>'There is no category'];
            }else{
                 $response = ['status' => 200, 'message' => 'success','description' =>'Category fetch successfully.', 'data'=>$category];
            }
        
            // echo json_encode($response);
            // exit();
                    
            $this->response($response, REST_Controller::HTTP_OK);
            exit();
            
        }
    }

    





//CLASS ENDS
}