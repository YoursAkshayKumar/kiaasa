<?php 
defined('BASEPATH') or exit('no dierct script access allowed');

class Order_m extends MY_Model {

	protected $tbl_name = 'order';
    protected $primary_col = 'id';
    protected $order_by = 'created_on';
    public $customer_id = "";
    public $address_id = "";
    public $net_price = 0;
    public $product_id = "";
    public $color_id = "";
    public $size_id = "";
    public $order_id = "";
    public $store_id = "";
    public $products = [];
    public $colors = [];
    public $size = [];
    public $quantity = [];
    public $qty = "";




    public function __construct()
	{
		parent::__construct();   
	}

    public function create_order(){
        $data = array(
            'customer_id' => $this->customer_id,
            'address_id' => $this->address_id,
            'net_price' => $this->net_price,
        );
        $isAdded = $this->db->insert('order', $data);
        if($isAdded) {
            $this->order_id = $this->db->insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function create_order_item() {
        $products = $this->products;
        $color = $this->colors;
        $size = $this->size;
        $quantity = $this->quantity;
        
        $i = 0;
        foreach(array_combine($products, $quantity) as $p => $q) {
            $this->product_id = $p;
            $this->qty = $q;
            $this->size_id = $size[$i];
            $this->color_id = $color[$i];
            $this->insertOrderItem();
        $i++;
        }
        return true;
    }

    public function insertOrderItem(){
        $data = array(
            'product_id' => $this->product_id,
            'color_id' => $this->color_id,
            'size_id' => $this->size_id,
            'quantity' => $this->qty,
            'order_id' => $this->order_id,
            'store_id' => $this->store_id
        );
        $isAdded = $this->db->insert('order_items', $data);
        if($isAdded){
            return true;
        } else {
            return false;
        }
    }

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
