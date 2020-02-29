<?php

//The functions name is very specific, it explains it all
//require('../config/connect.php');
class Crud{
  private $obj;
  public $db;

  function __construct(){
    $this->obj=new connection;

    $this->db=$this->obj->connect();
  }

  function __destruct(){

  }
  ///handles all sql query execution
  function insert($sql){
    $res=mysqli_query($this->db,$sql) or die(mysqli_error($this->db));
    if($res){
      return 1;
    }
  }

  function update($sql){
    $res=mysqli_query($this->db,$sql) or die(mysqli_error($this->db));
    if($res){
      return 1;
    }
  }

  function delete($sql){
    $res=mysqli_query($this->db,$sql) or die(mysqli_error($this->db));
    if($res){
      return 1;
    }
  }


  public function Get_All_Data($sql){
    $data_array=array();
    $res=mysqli_query($this->db,$sql)or die(mysqli_error($this->db));
    $num_row=mysqli_num_rows($res);
    if($num_row>0)
    {
      while($fetch=mysqli_fetch_assoc($res)){
        $data_array[]=$fetch;
      }
      return $data_array;
    }
  }
  function Execute_Query($sql){
    $res=mysqli_query($this->db,$sql) or die(mysqli_error($this->db));
    if($res){
      return 1;
    }
  }

  public function Escape($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data=mysqli_real_escape_string($this->db,$data);
    return $data;

  }


}
?>
