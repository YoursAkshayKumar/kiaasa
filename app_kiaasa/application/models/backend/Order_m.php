<?php 
defined('BASEPATH') or exit('no dierct script access allowed');

class Order_m extends MY_Model {

	protected $tbl_name = 'pos_customer_orders';
    protected $primary_col = 'id';
    protected $order_by = 'created_on';

    public function __construct()
	{
		parent::__construct();   
	}



    // public function getStoreCount($storename){
    //     $this->db->select('id');
    //     $this->db->from('store');
    //     $this->db->where('store_name', $storename);
    //     return $this->db->get()->num_rows();
    // }




    public function getOrders($limit,$offset){
        $this->db->select('*');
        $this->db->from('pos_customer_orders');
        $this->db->limit($limit,$offset);
        $order = $this->db->get();
        return $order->result_array();
    }

    public function getOrdersById($id){
        $this->db->select('*');
        $this->db->from('pos_customer_orders_detail');
        $this->db->where('id', $id);
        $order = $this->db->get();
        return $order->result_array();
    }


    
    public function addStore($data){
        $this->db->insert('store', $data);
        return true;
    }


    public function updatePassword($email,$password){
        $data = [
            'password' => $password
        ];
        $this->db->where('email', $email);
        $this->db->update('users', $data);
        return true;
    }

  


//end class

}
