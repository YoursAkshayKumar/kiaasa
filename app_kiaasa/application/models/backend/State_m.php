<?php 
defined('BASEPATH') or exit('no dierct script access allowed');

class State_m extends MY_Model {

	protected $tbl_name = 'state_list';
    protected $primary_col = 'id';
    protected $order_by = 'created_on';

    public function __construct()
	{
		parent::__construct();   
	}



 


    public function getStates($limit,$offset){
        $this->db->select('*');
        $this->db->from('state_list');
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
