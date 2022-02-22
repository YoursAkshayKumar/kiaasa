<?php
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller
{

	public function __construct() {
		parent::__construct();
        // $db2 = $this->load->database('database2', TRUE);
	}

    public function userRegistration_post(){
        $method = $this->_detect_method();
        if (!$method == 'POST') {
            $this->response(['status' => 400, 'messsage'=>'error', 'description' => 'Bad request.'], REST_Controller::HTTP_BAD_REQUEST);
            exit();
        }
        else{
            $this->form_validation->set_rules('phone', 'phone', 'trim|required|min_length[10]');
			$this->form_validation->set_rules('salutation', 'salutation');
			$this->form_validation->set_rules('customer_name', 'Customername');
			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
	 		$this->form_validation->set_rules('postal_code', 'postal_code', 'trim|min_length[6]');

            if ($this->form_validation->run() == FALSE) {
				$response = ['status' => 200, 'message' => 'error', 'description' => validation_errors()];
			} else {
				$data = $this->input->post();
				$userCount = $this->auth_m->userCountByEmail($data['email']);
				if($userCount > 0){
					$response = ['status' => 200, 'message' => 'error', 'description' => 'User already exits.'];
                }
				else{
                    $mobileNoCount = $this->auth_m->getUserCountByMobile($data['phone']);
                    if($mobileNoCount > 0) {
                        $response = ['status' => 200, 'message' => 'error', 'description' => 'Duplicate mobile no.'];
                    }
                    else{
                    
                        $isAdded = $this->auth_m->userRegistration($data);
                       
                        if($isAdded){
                            $response = ['status' => 200, 'message' => 'success', 'description' => 'Your registration is successfull.'];  
                        }
                        else{
                            $response = ['status' => 200, 'message' => 'error', 'description' => 'Something went wrong.'];
                        }
                    }
                }
            }   
        }
        $this->response($response, REST_Controller::HTTP_OK);
        exit();
        
	}



    public function getUser_post(){
        $method = $this->_detect_method();
        if (!$method == 'POST') {
            $this->response(['status' => 400, 'messsage'=>'error', 'description' => 'Bad request.'], REST_Controller::HTTP_BAD_REQUEST);
            exit();
        }
        else{
            $this->form_validation->set_rules('user_id', 'User Id', 'trim|min_length[10]');

            if ($this->form_validation->run() == FALSE) {
				$response = ['status' => 200, 'message' => 'error', 'description' => validation_errors()];
			} else {
				$data = $this->input->post();
				$userCount = $this->auth_m->userCountByEmail($data['email']);
				if($userCount > 0){
					$response = ['status' => 200, 'message' => 'error', 'description' => 'User already exits.'];
                }
				else{
                    $mobileNoCount = $this->auth_m->getUserCountByMobile($data['phone']);
                    if($mobileNoCount > 0) {
                        $response = ['status' => 200, 'message' => 'error', 'description' => 'Duplicate mobile no.'];
                    }
                    else{
                    
                        $isAdded = $this->auth_m->userRegistration($data);
                       
                        if($isAdded){
                            $response = ['status' => 200, 'message' => 'success', 'description' => 'Your registration is successfull.'];  
                        }
                        else{
                            $response = ['status' => 200, 'message' => 'error', 'description' => 'Something went wrong.'];
                        }
                    }
                }
            }   
        }
        $this->response($response, REST_Controller::HTTP_OK);
        exit();
        
	}






	//CLASS ENDS
}
