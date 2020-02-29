<?php
@session_start();
date_default_timezone_set('Africa/Lagos');

include('../model/model.php');
$obj=new Master;
$headers = apache_request_headers();


if(isset($_POST['login'])){
	$username=$obj->Escape($_POST['email']);
	$password=$obj->Escape($_POST['password']);
	$res=$obj->Login($username,$password);
	exit($res);
}
$email=explode(":",base64_decode(explode(" ",$headers['Authorization'])[1]))[0];
$password=explode(":",base64_decode(explode(" ",$headers['Authorization'])[1]))[1];




if(isset($_POST['product'])){
	$obj->Authenticate_And_Authorize("VENDOR",$email,$password);
	$name=$obj->Escape($_POST['name']);
	$description=$obj->Escape($_POST['description']);
	$price=$obj->Escape($_POST['price']);
	echo $obj->createProducts($name,$description,$price);
}

?>
