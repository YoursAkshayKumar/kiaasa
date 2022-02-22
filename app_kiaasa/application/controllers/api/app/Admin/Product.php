<?php
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Product extends REST_Controller {

	public function __construct(){
		parent::__construct();
	}

    
    public function getProduct_post() {

        $method = $this->_detect_method();
        if (!$method == 'POST') {
            $this->response(['status' => 400, 'messsage'=>'error', 'description' => 'Bad request.'], REST_Controller::HTTP_BAD_REQUEST);
            exit();
        }
        else{

            
            $offset = $this->input->post('offset');
            $limit = $this->input->post('limit');
            $min_price = $this->input->post('min_price');
            $max_price = $this->input->post('max_price');

            $products = $this->product_m->getAllProduct();
            


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