<?php

//The functions name is very specific, it explains it all
require('../config/connect.php');
require('crud.php');
class Master extends Crud{
	private $obj;
	public $db;
	public $field_of_interest;

	//class constructor
	function __construct(){
		$this->obj=new connection;
		$this->db=$this->obj->connect();
	}

	function __destruct(){

	}

	public function Authenticate_And_Authorize($type,$email,$pass){
		$qry="select * from users where email='$email' and password='".md5($pass)."'";
		$result=$this->Get_All_Data($qry);
		//print_r($result);die;
		if(count($result)<1){
			$response['error']="Login Failed! Please Check your username and password";
			die(json_encode($response,JSON_FORCE_OBJECT));
		}else if($type!=$result[0]['role']){
			$response['error']="Authorization Failed!";
			die(json_encode($response,JSON_FORCE_OBJECT));
		}

	}

	//logs user in
	function Login($uname,$lpass){
		$msg="";
		$hashp=md5($lpass);
		$response=array();
		//echo $hashp;
		$qry="select * from users where email='$uname' and password='$hashp'";
		$result=$this->Get_All_Data($qry);
		//print_r($result);die;
		if (count($result)>0){
			$_SESSION['id']=$result[0]['id'];
			$_SESSION['name']=$result[0]['name'];
			$_SESSION['email']=$result[0]['email'];
			$_SESSION['role']=$result[0]['role'];
			$_SESSION['token']=MD5(uniqid());
			$response['success']="Login Successful";
			$response['data']=$_SESSION;


		}
		else{
			$response['error']="Login Failed! Please Check your username and password";
		}
		return json_encode($response,JSON_FORCE_OBJECT);
	}

	public function createProducts($name,$description,$price){
		$sql="INSERT INTO `products` set
		`name`='$name',
		`description`='$description',
		`user_id`=1,
		`price`='$price',
		 `shop_id`=1,
		 `category_id`=1";
		$res=$this->Execute_Query($sql);
		if($res){
			die(json_encode(array("1"=>"Product Created Successful"),JSON_FORCE_OBJECT));
		}else{
			die(json_encode(array("0"=>"An Error Occurred While Processing Your Request"),JSON_FORCE_OBJECT));
		}
	}

}



?>
