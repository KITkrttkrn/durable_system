<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CI_Curl {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function line_api($message, $token)
	{

		$mms =  trim($message); // ข้อความที่ต้องการส

		$chOne = curl_init();
		curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");

		// SSL USE
		curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);

		//POST
		curl_setopt( $chOne, CURLOPT_POST, 1);
		curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$mms");
		curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1);
		$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$token.'', );
		curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec( $chOne );

		//Check error
		if(curl_error($chOne))
		{

		echo 'error:' . curl_error($chOne);

		} else {

			$result_ = json_decode($result, true);

			//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
		}
		curl_close( $chOne );  
	}
}
