<?php 
defined('BASEPATH') or exit('no dierct script access allowed');

class Store_m extends MY_Model {

	protected $tbl_name = 'store';
    protected $primary_col = 'id';
    protected $order_by = 'created_on';

    public function __construct()
	{
		parent::__construct();   
	}



    public function getStoreCount($storename){
        $this->db->select('id');
        $this->db->from('store');
        $this->db->where('store_name', $storename);
        return $this->db->get()->num_rows();
    }

    public function getValidUser($username, $password){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $username);
        $user = $this->db->get()->row();

        if(password_verify($password, $user->password)){
            return $user;
        }
        else{
            return false;
        }
    }


    public function getStores($limit,$offset){
        $this->db->select('*');
        $this->db->from('store');
        $this->db->limit($limit,$offset);
        $store = $this->db->get();
        return $store->result_array();
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
