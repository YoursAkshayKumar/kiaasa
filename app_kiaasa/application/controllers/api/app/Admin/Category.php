<?php
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Category extends REST_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function getCategory_post() {

        $offset = $this->input->post('offset');
        $limit = $this->input->post('limit');
        $method = $this->_detect_method();
        if (!$method == 'POST') {
            $this->response(['status' => 400, 'messsage'=>'error', 'description' => 'Bad request.'], REST_Controller::HTTP_BAD_REQUEST);
            exit();
        }
        else{
            $this->db->select('c.id, c.name, c.product_style, c.parent_id, c.type_id, c.status, c.is_deleted, c.created_at');
            $this->db->from('product_category_master as c');

            if($this->input->post('limit')){
                $this->db->limit($limit,$offset);
            }
 
            $category = $this->db->get()->result_array();
  
            if (empty($category)) {
                $response = ['status' => 200, 'message' => 'success','description' =>'There is no category'];
            }else{
                 $response = ['status' => 200, 'message' => 'success','description' =>'Category fetch successfully.', 'data'=>$category];
            }
        
                    
            $this->response($response, REST_Controller::HTTP_OK);
            exit();
            
        }
    }

    





//CLASS ENDS
}