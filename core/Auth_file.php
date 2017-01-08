<?php

session_start();

/****************************************************************************************
   **************************************************************************************
   ***                ****     *********     ****      ********    *****           ******
   ***      ***************     *******     *****       *******    ****     ****   ******
   ***         **************     ****     ******        ******    ****    **************
   ********           ********     **     *******    *    *****    ****    **************
   **************     **********        *********    **    ****    ****    **************
   *****              ***********      **********    ***     **    ****     *****   *****
   *****            *************      **********    ****          ******           *****
   **************************************************************************************
   **************************************************************************************
  *SYNC FRAMEWORK
  *IS DEVELOPMENT FORM FREE USED AND DEVELOP BY TERM AND CONDITION
  *AUTHOR BY SYNC FRAMEWORK TEAM
  *
  *FINAL PRODUCT 2016
  *REDISTRIBUTED BY FREE LICENSE
**/

require_once 'Query_select.php';

class Auth_File extends Query_select{


    public function __set_error($__param){
        // error handler message
        $this->__system_error($__param);

    }


    public static function menu($menu){
        foreach ($menu as $key => $value) {
            echo"<li role='presentation'><a href='".ROOT_HOST."/".$key."'>".$value."</a></li>";
        }
    }


    public function __meta_index(){

        if(!$this::ajax_request()){
            echo'<!DOCTYPE html><html lang="en"><title>'.WEB_TITLE.'</title>';
            echo'<meta name="license" content="sync-framework">';
            echo'<link rel="icon" type="image/png" href="'.ROOT_HOST.'/'.ASSETS.'images/'.FAVICON.'">';
            echo'<meta name="author" content="'.AUTHOR.'">';
            echo "<link rel='stylesheet' href='".ROOT_HOST."/core/css/syn-1.2.css'>";
            echo "<script src='".ROOT_HOST.'/core/js/syn-1.2.js'."'></script>";

        }

    }

    public function __autoload($path,$__core){

        $this->__meta_index();
        $uri_dir='';
        if($path == "admin"){$uri_dir = "admin/";}
        foreach ($__core as $key => $value) {
              $string = explode("/",$value);
              $value = $string[0];
              $file_system = 'app/'.$uri_dir.$key.'/'.$value;
              if($key=='model'){
                  if(file_exists($file_system.'.php')){
                     require_once $file_system.'.php';
                  }
              }elseif($key=='views'){
                  if(file_exists($file_system.'.php')){
                     require_once $file_system.'.php';
                  }else{
                    $this->__system_error(E_USER_NOTICE,"File your find is not exits");
                  }
              }elseif($key=='js'){
                  if(file_exists($file_system.'.js')){
                     echo"<script src='".ROOT_HOST.'/'.$file_system.".js'></script>";
                  }
              }
        }
        //$this->__meta_file_js();
    }



    public function basepatch(){
        $url = ROOT_HOST.'/'.$this::segment(1);
        return $url;
    }




    // load models,views,routers with the same name
    public function __server(){
        $segment = $this::segment(1);
        if($segment == ADMIN){
            $path = "admin";
            $segment = $this::segment(2);
            define('REGISTER',TRUE);
        }else{
            $path = "client";
        }
        if($segment) {$uri = $segment;}else{$uri='index';}
        $this->__autoload($path,array('model'=>$uri,'views'=>$uri,'js'=>$uri));
    }

    public function get_model(){
       $segment = $this::segment(1);
       if($segment) {$__uri = $segment;}else{$__uri='index';}
       $file_system = 'app/model/'.$__uri.'.php';

       if(file_exists($file_system)){
           require_once $file_system;
       }else{
           $this->__system_error(E_USER_NOTICE,"File your find is not exits");
       }

    }


    public function base_uri(){
        $url = @$this::segment(0);
        $url = "http://".$url;
        return true;
    }


    public function get_view(){
        $segment = $this::segment(1);
        if($segment) {$__uri = $segment;}else{$__uri='index';}
        $file_system = 'app/views/'.$__uri.'.php';

        if(file_exists($file_system)){
            require_once $file_system;
        }else{
            $this->__system_error(E_USER_NOTICE,"File your find is not exits");
        }
    }


    public function __meta_file_css(){
        $dir = ASSETS.'css/';
        $css_file='';
        if ($handle = opendir($dir)) {

            while (false !== ($entry = readdir($handle))) {
                if($entry!=='.' && $entry!=='..' && !is_dir($entry)){
                    $userfile_name=ROOT_HOST.'/'.ASSETS.'css/'.$entry;
                    $userfile_extn = substr($userfile_name, strrpos($userfile_name, '.')+1);

                    if($userfile_extn=='css'){
                        $css_file[]=$entry;
                    }
                }
            }
            sort($css_file);
             for($a=0;$a<count($css_file);$a++){
                 echo"<link rel='stylesheet' type='text/css' href='".ROOT_HOST.'/'.ASSETS.'css/'.$css_file[$a]."'></link>";
             }
            closedir($handle);
        }

    }

    public function __meta_file_js(){
        $dir = ASSETS.'js/';
        $js_file='';
        if ($handle = opendir($dir)) {

            while (false !== ($entry = readdir($handle))) {
                if($entry!=='.' && $entry!=='..' && !is_dir($entry)){
                    $userfile_name=ROOT_HOST.'/'.ASSETS.'js/'.$entry;
                    $userfile_extn = substr($userfile_name, strrpos($userfile_name, '.')+1);
                    if($userfile_extn=='js'){
                        $js_file[]=$entry;

                    }
                }
            }

            sort($js_file);
             for($a=0;$a<count($js_file);$a++){
                 echo"<script type='text/javascript' src='".ROOT_HOST.'/'.ASSETS.'js/'.$js_file[$a]."'></script>";
             }
            closedir($handle);
        }
       
    }

    public function view($file){
        if(is_file('views/'.$file.'.php')){
            require_once 'views/'.$file.'.php';
        }else{
            return false;
        }
    }

    public function app_patch(){
        return 'app/';
    }

    public static function load($dirs,$param){
          $dir = $dirs.'/';
          if(is_array($param)){
              for($a=0;$a<count($param);$a++){
                  if(file_exists($dir.$param[$a].'.php')){
                      require_once $dir.$param[$a].'.php';
                  }
              }
          }else{
              if(file_exists($dir.$param.'.php')){
                  require_once $dir.$param.'.php';
              }
          }
    }

    public static function load_custom($file){
        if(is_file('app/customs/'.$file.'.php')){
            require_once'app/customs/'.$file.'.php';
        }
    }




    public static function create_file($location='',$conten='',$mode='a'){
        $handle = fopen($location,$mode);
        fwrite($handle,$content);
        fclose($handle);
    }



    public static function clean_json($data){
        ob_start();
        ob_end_clean();
        echo json_encode($data);
        die();
    }



    public function base_url(){
        $url = @$this::segment(0);
        $url = "http://".$url;
        return $url;
    }




    public function base_menu(){
        $menu = @$this::segment(1);
        return $menu;
    }



    public function base_function(){
        $function = @$this::segment(2);
        return $function;
    }
    
     public static function user_auth($id){
        $session = new Session;
         $error = new Error_handler;
        if(!$session->__isset($id)){
            echo "<div style='width:100%;height:100%;position:fixed;top:0;left:0;background:#252525 url(".ROOT_HOST."/core/img/401.jpg);background-position:center;background-repeat:no-repeat' onclick=location.href='".ROOT_HOST."'></div>";
            die();
        }
    }

}

// load default core system
//=====================================
$core = new Auth_File;
$core->__server();
