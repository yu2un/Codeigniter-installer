<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class install extends CI_Controller{

  public $url;

  public function __construct()
  {
    parent::__construct();
    $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
    $redir .= "://".$_SERVER['HTTP_HOST'];
    $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
    $redir = str_replace('install/','',$redir);
    $this->url = $redir;
  }

  function index()
  {
    $data["url"] = $this->url;
    $this->load->view('install/index' , $data);
  }
  //Ajax Control
  function testconnect()
  {
    if($_POST)
    {
      $data = $_POST;
      $this->database_control($data);
      if($this->database_control($data)){
        $redir["success"] = true;
        $redir["message"] = "Successful";
        echo json_encode($redir);
      }else{
        $redir["success"] = false;
        $redir["message"] = "Database connection error";
        echo json_encode($redir);
      }
    }else{
      return false;
    }
  }

  function changeconfig()
  {
    if($_POST){
      $data = $_POST;
      if($this->write_data($data))
      {
        $this->removeinstall();
      }
    }
  }


  // Database Control
  private function database_control($data)
	{
    ini_set('display_errors', 'Off');

    $mysqli = new mysqli($data['hostname'],$data['username'],$data['password'],'');
		// Check for errors
		if(mysqli_connect_errno())
			return false;
		// Create the prepared statement
		$mysqli->query("CREATE DATABASE IF NOT EXISTS ".$data['database']);
		// Close the connection
		$mysqli->close();
		return true;
	}

  // Changing config
  private function write_data($data)
  {
  	$database_path 	 = 'application/config/database.php';
  	$config_path 	   = 'application/config/config.php';

  	$database_file   = file_get_contents($database_path);
    $config_file     = file_get_contents($config_path);

  	$newdb  = str_replace("%HOSTNAME%",$data['hostname'],$database_file);
  	$newdb  = str_replace("%USERNAME%",$data['username'],$newdb);
  	$newdb  = str_replace("%PASSWORD%",$data['password'],$newdb);
  	$newdb  = str_replace("%DATABASE%",$data['database'],$newdb);

    $newurl = str_replace("%BASE_URL%",$data["base_url"],$config_file);

  	$db      = fopen($database_path,'w+');
    $config  = fopen($config_path ,  'w+');

  	@chmod($database_path, 0777);
    @chmod($config_path  , 0777);
  	if(is_writable($database_path) && is_writable($config_path )) {
  		if(fwrite($db,$newdb) && fwrite($config,$newurl)) {
  			return true;
  		} else {
  			return false;
  		}
  	} else {
  		return false;
  	}
	}

  private function removeinstall()
  {
    $this->RemoveFolder('application/controllers/install');
    $this->RemoveFolder('application/views/install');
    $this->RemoveFolder('assets/install');

    $routes_path 	 = 'application/config/routes.php';
    $routes_file   = file_get_contents($routes_path);

    $new = str_replace('$route["install"] = "install/install";' ,'',$routes_file);
    $new = str_replace('$route["install/(:any)"] = "install/install/$1";' ,'',$new);

    $routes = fopen($routes_path,'w+');

    @chmod($routes_path, 0777);
    if(is_writable($routes_path)){
  		if(fwrite($routes,$new)) {
  			return true;
  		} else {
  			return false;
  		}
  	} else {
  		return false;
  	}

  }

  private function RemoveFolder($dir) {
    if (substr($dir, strlen($dir)-1, 1)!= '/')
    $dir .= '/';
    if ($handle = opendir($dir)) {
     while ($obj = readdir($handle)) {
      if ($obj!= '.' && $obj!= '..') {
       if (is_dir($dir.$obj)) {
        if (!RemoveFolder($dir.$obj))
         return false;
        } elseif (is_file($dir.$obj)) {
         if (!unlink($dir.$obj))
          return false;
         }
       }
     }
      closedir($handle);
      if (!@rmdir($dir))
      return false;
      return true;
     }
    return false;
  }


}
