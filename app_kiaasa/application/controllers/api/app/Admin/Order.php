<?php
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Order extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getOrder_post()
    {
        $method = $this->_detect_method();
        if (!$method == 'POST') {
            $this->response(['status' => 400, 'messsage' => 'error', 'description' => 'Bad request.'], REST_Controller::HTTP_BAD_REQUEST);
            exit();
        } else {

            $this->form_validation->set_rules('limit', 'limit', 'trim|numeric|max_length[3]');
            $this->form_validation->set_rules('offset', 'offset', 'trim|numeric|max_length[3]');
            $this->form_validation->set_rules('order_id', 'Order Id', 'trim|numeric|max_length[10]');
           

            if ($this->form_validation->run() == FALSE) {
                $response = ['status' => 200, 'message' => 'error', 'description' => 'Validation error'];
            } else {

                $offset = $this->input->post('offset');
                $limit = $this->input->post('limit');

                if ($this->input->post('order_id')) {
                    $order = $this->order_m->getOrdersById($this->input->post('order_id'));
                    if (!empty($order)) {
                        $newdata = array(
                            'Order' => $order
                        );
                        $response = ['status' => 200, 'message' => 'success', 'description' => 'There is Order list.', 'data' => $newdata];
                    } else {
                        $response = ['status' => 200, 'message' => 'error', 'description' => 'There is some error'];
                    }
                } else {
                    $order = $this->order_m->getOrders($limit, $offset);
                    if (!empty($order)) {
                        $newdata = array(
                            'Order' => $order
                        );
                        $response = ['status' => 200, 'message' => 'success', 'description' => 'There is Order list.', 'data' => $newdata];
                    } else {
                        $response = ['status' => 200, 'message' => 'error', 'description' => 'There is some error'];
                    }
                }

             
            }
            $this->response($response, REST_Controller::HTTP_OK);
            exit();
        }
    }


    public function createOrder_post()
    {
        $method = $this->_detect_method();
        if (!$method == 'POST') {
            $this->response(['status' => 400, 'messsage' => 'error', 'description' => 'Bad request.'], REST_Controller::HTTP_BAD_REQUEST);
            exit();
        } else {
            $this->form_validation->set_rules('phone', 'phone', 'trim|required|min_length[10]');
            $this->form_validation->set_rules('salutation', 'salutation');
            $this->form_validation->set_rules('customer_name', 'Customername');
            $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
            $this->form_validation->set_rules('postal_code', 'postal_code', 'trim|min_length[6]');

            if ($this->form_validation->run() == FALSE) {
                $response = ['status' => 200, 'message' => 'error', 'description' => validation_errors()];
            } else {

                $offset = $this->input->post('offset');
                $limit = $this->input->post('limit');

                if ($this->input->post('order_id')) {
                    $order = $this->order_m->getOrdersById($this->input->post('order_id'));
                    if (!empty($order)) {
                        $newdata = array(
                            'Order' => $order
                        );
                        $response = ['status' => 200, 'message' => 'success', 'description' => 'There is Order list.', 'data' => $newdata];
                    } else {
                        $response = ['status' => 200, 'message' => 'error', 'description' => 'There is some error'];
                    }
                } else {
                    $order = $this->order_m->getOrders($limit, $offset);
                    if (!empty($order)) {
                        $newdata = array(
                            'Order' => $order
                        );
                        $response = ['status' => 200, 'message' => 'success', 'description' => 'There is Order list.', 'data' => $newdata];
                    } else {
                        $response = ['status' => 200, 'message' => 'error', 'description' => 'There is some error'];
                    }
                }

                $this->response($response, REST_Controller::HTTP_OK);
                exit();
            }
        }
    }











    //CLASS ENDS
}
