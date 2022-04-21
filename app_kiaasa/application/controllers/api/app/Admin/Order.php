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

    // public function createOrder_post(){
    //     $this->response(['status' => 400, 'messsage' => 'success', 'description' => 'ok.'], REST_Controller::HTTP_OK);
    //         exit();
    // }



    public function createOrder_post()
    {
        $method = $this->_detect_method();
        if (!$method == 'POST') {
            $this->response(['status' => 400, 'messsage' => 'error', 'description' => 'Bad request.'], REST_Controller::HTTP_BAD_REQUEST);
            exit();
        } else {
            $this->form_validation->set_rules('customer_id', 'customer_id', 'trim|required');
      

            if ($this->form_validation->run() == FALSE) {
                $response = ['status' => 200, 'message' => 'error', 'description' => validation_errors()];
            } else {

                $this->order_m->customer_id = $this->input->post('customer_id');
                $this->order_m->address_id = $this->input->post('address_id');
                $this->order_m->net_price = $this->input->post('net_price');
                $this->order_m->products = $this->input->post('product');
                $this->order_m->colors = $this->input->post('color');
                $this->order_m->size = $this->input->post('size');
                $this->order_m->quantity = $this->input->post('quantity');
                $this->order_m->store_id = $this->input->post('store_id');

                $isInserted = $this->order_m->create_order();
                if($isInserted) {
                    $isItemsInserted = $this->order_m->create_order_item();
                    if($isItemsInserted){
                        $this->response(['status' => 200, 'messsage' => 'success', 'description' => 'Order created successfully'], REST_Controller::HTTP_BAD_REQUEST);                        
                    } else {
                        $this->response(['status' => 200, 'messsage' => 'error', 'description' => 'Something went wrong1'], REST_Controller::HTTP_BAD_REQUEST);                        
                    }
                } else {
                    $this->response(['status' => 200, 'messsage' => 'error', 'description' => 'Something went wrong'], REST_Controller::HTTP_BAD_REQUEST);
                }


            }
        }
    }











    //CLASS ENDS
}
