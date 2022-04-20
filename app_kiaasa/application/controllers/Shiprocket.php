<?php
// require APPPATH . '/libraries/REST_Controller.php';
// use Restserver\Libraries\REST_Controller;

class Shiprocket extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}


    public function track_order(){

        $awb_no =  '19041313924854';
        $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/track/awb/'.$awb_no,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjI1NzEyMTgsImlzcyI6Imh0dHBzOi8vYXBpdjIuc2hpcHJvY2tldC5pbi92MS9leHRlcm5hbC9hdXRoL2xvZ2luIiwiaWF0IjoxNjUwMzU4OTQ3LCJleHAiOjE2NTEyMjI5NDcsIm5iZiI6MTY1MDM1ODk0NywianRpIjoiQnc5SHFnbTBTc1ZIa2Q2dSJ9.KwF8fbhcDm7jILWBwSFqLjT0DZi3r2NA4ne5tIbazws'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;

    }



    public function print_invoice(){
     

            
            
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/orders/print/invoice',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "ids": [206002098]
        }
        ',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjI1NzEyMTgsImlzcyI6Imh0dHBzOi8vYXBpdjIuc2hpcHJvY2tldC5pbi92MS9leHRlcm5hbC9hdXRoL2xvZ2luIiwiaWF0IjoxNjUwMzU4OTQ3LCJleHAiOjE2NTEyMjI5NDcsIm5iZiI6MTY1MDM1ODk0NywianRpIjoiQnc5SHFnbTBTc1ZIa2Q2dSJ9.KwF8fbhcDm7jILWBwSFqLjT0DZi3r2NA4ne5tIbazws'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;


    }

    
   

    

    





//CLASS ENDS
}