<?php 
defined('BASEPATH') or exit('no dierct script access allowed');

class Image_m extends MY_Model {

	protected $tbl_name = 'pos_product_images';
    protected $primary_col = 'id';
    protected $order_by = 'created_on';

    public function __construct()
	{
		parent::__construct();   
	}



    public function get_image_by_product_id($product_id){
        $this->db->select(
            '
                i.id,
                i.image_name,
                i.image_title,
                i.image_type 
            '
        );

        $this->db->from('pos_product_images as i');
        $this->db->where('i.product_id', $product_id);
        $image = $this->db->get()->result_array();

        foreach($image as $key => $value){
            $image[$key]['image_name'] = IMAGE_URL. '/' . $product_id . '/' . $value['image_name'];
        }

        return $image;
    }

  


//end class

}
