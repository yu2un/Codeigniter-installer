<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

}

class Admin_Controller extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    //redirect("index");
    if(empty($this->session->login)){
      echo "Login Olunmadı";
      redirect(base_url()."admin");
    }else{

    }
  }
}
