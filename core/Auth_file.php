<?php
session_start();
ob_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);

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
  *FINAL PRODUCT 201710
  *REDISTRIBUTED BY FREE LICENSE
  *VERSION 2.1
**/

require_once 'Query_select.php';

class Auth_File extends Query_select{


    protected function __set_error($param){
        // error handler message
        $this->__system_error($param);

    }


    protected static function menu($menu){
        foreach ($menu as $key => $value) {
            echo"<li role='presentation'><a href='".ROOT_HOST."/".$key."'>".$value."</a></li>";
        }
    }


    private function __meta_index(){
        if(!$this::ajax_request()){
        ob_start();
            echo "<meta charset='utf-8'>
				  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                  <meta name='viewport' content='width=device-width, initial-scale=1'>
                  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0 maximum-scale=1.0, user-scalable=no'>
                  <meta name='license' content='banyumasweb'>
                  <meta name='framework' content='SYN2T'>
                  <meta name='geo.country' content='id'/>
                  <meta name='author' content='".AUTHOR."'>
                  <meta name='robots' content='index,nofollow'>
                  <link rel='stylesheet' href='".ROOT_HOST."/core/css/syn-1.2.css'>
                  <script src='".ROOT_HOST."/core/js/syn-1.2.js'></script>";
        }
    }


    protected static function meta_file($title=WEB_TITLE,$description=DESCRIPTION,$keyword=KEYWORD){
        $auth=new Auth_File();
        if(!$auth::ajax_request()){
        ob_start();
            echo '<!DOCTYPE html><html lang="en"><title>'.$title.'</title>';
            echo '<meta name="keyword" content="'.$keyword.'">';
            echo '<meta name="description" content="'.$description.'">';
        }
    }

    protected static function is_write($dir) {
        $wr=new Auth_File();
        if (is_dir($dir)) {
            if(is_writable($dir)){
                $objects = scandir($dir);
                foreach ($objects as $object) {
                    if ($object != "." && $object != "..") {
                        if (!is_writable($dir."/".$object)) return false;
                        else continue;
                    }
                }
                return true;
            }else{
                return false;
            }

        }else if(file_exists($dir)){
            return (is_writable($dir));

        }
    }





    private function __autoload($path,$core){
        $this->__meta_index();
        $uri_dir = $path.'/';
        foreach ($core as $key => $value) {
              $string = explode("/",$value);
              $file_system = str_replace('//','/','pages/'.$uri_dir.$key.'/'.$value);

              if($key=='model'){
                  if(is_dir($file_system)){
                      if(file_exists($file_system.'/'.$value1.'.php')){
                         require_once $file_system.'/'.$value1.'.php';
                      }
                  }else{
                      if(file_exists($file_system.'.php')){
                         require_once $file_system.'.php';
                      }
                  }

              }elseif($key=='views'){
                  if(is_dir($file_system)){
                      if(file_exists($file_system.'/'.$value1.'.php')){
                         require_once $file_system.'/'.$value1.'.php';
                      }else{
                        ob_end_flush();
                        ob_get_flush();
                        echo "<div class='error_page' onclick=location.href='".ROOT_HOST."'></div>";
                        die();
                      }
                  }else{
                      if(file_exists($file_system.'.php')){
                         require_once $file_system.'.php';

                      }else{
                        ob_end_flush();
                        ob_get_flush();
                        echo "<div class='error_page' onclick=location.href='".ROOT_HOST."'></div>";
                        die();
                      }
                  }
              }elseif($key=='js'){
                  if(is_dir($file_system)){
                      if(file_exists($file_system.'/'.$value1.'.js')){
                         echo"<script src='".ROOT_HOST.'/'.$file_system.$value1.".js'></script>";
                      }
                  }else{
                      if(file_exists($file_system.'.js')){
                         echo"<script src='".ROOT_HOST.'/'.$file_system.".js'></script>";
                      }
                  }
              }
        }
    }

    // load models,views,routers with the same name
    public function __server(){
        $seg = explode('/',str_replace('//','/',str_replace('/./','/',str_replace(BASEURL,'',str_replace(ROOT_HOST,'',$_SERVER['REQUEST_URI'])))));
        $dir_root = explode(" ",DIR_ROOT);

        if(empty($seg[1])){
            $segment ="index";
        }else{
            $segment = strtolower($seg[1]);
        }

        if(in_array($segment,$dir_root)){
            $path = $seg[1];
            if(empty($seg[2])){
                $segments="index";
            }else{
                $segments=$seg[2];
            }
            define('REGISTER',TRUE);
        }else{
            $path = '';
            $segments=$segment;
            define('REGISTER',TRUE);
        }

        if($segments && $segments!=='') {$uri = $segments;}else{$uri='index';}
        $this->__autoload($path,array('model'=>$uri,'views'=>$uri,'js'=>$uri));

    }


    protected static function diff_date($tgl1,$tgl2){
          $tgl1 = strtotime($tgl1);
          $tgl2 = strtotime($tgl2);
          $diff_secs = abs($tgl1 - $tgl2);
          $base_year = min(date("Y", $tgl1), date("Y", $tgl2));
          $diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
          $day = date("j", $diff) - 1;
          $mnt = (int) date("i", $diff);
          $jam = date("G", $diff);
          if($day == 0 AND $jam ==0 AND $mnt==0){
              $dtk = (int) date("s", $diff);
              $hsl = $dtk." second";
          }elseif($day == 0 AND $jam ==0){
              $hsl = $mnt." minutes";
          }elseif ($day == 0 AND $jam != 0) {
              $hsl = $jam." hours";
          }elseif ($day >0) {
              $hsl = date("d M Y",$tgl1);
          }
          return $hsl;
    }



    protected static function basepath(){
        $url = ROOT_HOST.'/'.$this::segment(1);
        return $url;
    }



    protected function get_model(){
       $segment = $this::segment(1);
       if($segment) {$uri = $segment;}else{$uri='index';}
       $file_system = 'pages/model/'.$uri.'.php';

       if(file_exists($file_system)){
           require_once $file_system;
       }else{
           $this->__system_error(E_USER_NOTICE,"File your find is not exits");
       }

    }

    protected function get_view(){
        $segment = $this::segment(1);
        if($segment) {$uri = $segment;}else{$uri='index';}
        $file_system = 'pages/views/'.$uri.'.php';

        if(file_exists($file_system)){
            require_once $file_system;
        }else{
            $this->__system_error(E_USER_NOTICE,"File your find is not exits");
        }
    }


    private function __meta_file_css(){
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

    private function __meta_file_js(){
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

    protected function view($file){
        if(is_file('views/'.$file.'.php')){
            require_once 'views/'.$file.'.php';
        }else{
            return false;
        }
    }

    protected function app_patch(){
        return 'pages/';
    }

    protected static function load($dirs,$param){
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

    protected static function load_custom($file){
        if(is_file('pages/customs/'.$file.'.php')){
            require_once'pages/customs/'.$file.'.php';
        }
    }




    protected static function create_file($location='',$conten='',$mode='a'){
        $handle = fopen($location,$mode);
        fwrite($handle,$content);
        fclose($handle);
    }



    protected static function clean_json($data){
        ob_end_clean();
        ob_get_clean();
        echo json_encode($data);
        exit();
    }


    protected function base_menu(){
        $menu = @$this::segment(1);
        return $menu;
    }



    protected function base_function(){
        $function = @$this::segment(2);
        return $function;
    }

     protected static function user_auth($id,$page=ROOT_HOST.'/login'){
        $session = new Session;
        if(!$session::get_session($id)){
            ob_flush();
            ob_get_clean();
            echo "<meta http-equiv='refresh' content='0,".$page."' />";
            echo "<div class='error_page' onclick=location.href='".$page."'></div>";
            die();
        }
    }


      protected static function resize($target, $newcopy, $w=500, $h=350, $ext='.jpg') {
          list($w_orig, $h_orig) = getimagesize($target);
          $scale_ratio = $w_orig / $h_orig;
          if (($w / $h) > $scale_ratio) {
                 $w = $h * $scale_ratio;
          } else {
                 $h = $w / $scale_ratio;
          }
          $img = "";
          $ext = strtolower($ext);

          if($ext == ".jpg"){
            $img = imagecreatefromjpeg($target);
          }elseif($ext == ".jpeg"){
            $img = imagecreatefromjpeg($target);
          }elseif ($ext == ".gif"){
            $img = imagecreatefromgif($target);
          } elseif($ext ==".png"){
            $img = imagecreatefrompng($target);
          } else {
            $img = imagecreatefromjpeg($target);
          }
          $tci = imagecreatetruecolor($w, $h);
          // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
          imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
          imagejpeg($tci, $newcopy, 80);
      }


      protected static function image_ext($image,$extfile){
          $file = new Auth_File;
          $ext = $file::fileinfo($image);
          $extension = array(
                  'txt' => 'text/plain',
                  'htm' => 'text/html',
                  'html' => 'text/html',
                  'php' => 'text/html',
                  'css' => 'text/css',
                  'js' => 'application/javascript',
                  'json' => 'application/json',
                  'xml' => 'application/xml',
                  'swf' => 'application/x-shockwave-flash',
                  'flv' => 'video/x-flv',

                  // images
                  'png' => 'image/png',
                  'jpe' => 'image/jpeg',
                  'jpeg' => 'image/jpeg',
                  'jpg' => 'image/jpeg',
                  'gif' => 'image/gif',
                  'bmp' => 'image/bmp',
                  'ico' => 'image/vnd.microsoft.icon',
                  'tiff' => 'image/tiff',
                  'tif' => 'image/tiff',
                  'svg' => 'image/svg+xml',
                  'svgz' => 'image/svg+xml',

                  // archives
                  'zip' => 'application/zip',
                  'rar' => 'application/x-rar-compressed',
                  'exe' => 'application/x-msdownload',
                  'msi' => 'application/x-msdownload',
                  'cab' => 'application/vnd.ms-cab-compressed',

                  // audio/video
                  'mp3' => 'audio/mpeg',
                  'qt' => 'video/quicktime',
                  'mov' => 'video/quicktime',

                  // adobe
                  'pdf' => 'application/pdf',
                  'psd' => 'image/vnd.adobe.photoshop',
                  'ai' => 'application/postscript',
                  'eps' => 'application/postscript',
                  'ps' => 'application/postscript',

                  // ms office
                  'doc' => 'application/msword',
                  'rtf' => 'application/rtf',
                  'xls' => 'application/vnd.ms-excel',
                  'ppt' => 'application/vnd.ms-powerpoint',

                  // open office
                  'odt' => 'application/vnd.oasis.opendocument.text',
                  'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
          );
          if(is_array($extfile)){
              foreach ($extfile as $result) {
                  foreach ($extension as $key => $value) {
                      if($result === $key){
                          if($value === $ext){
                              return true;
                          }else{
                              return false;
                          }
                      }
                  }
              }
          }else{
              foreach ($extension as $key => $value) {
                  if($extfile === $key){
                      if($ext === $value){
                          return true;
                      }else{
                          return false;
                      }
                  }
              }
          }
      }

      // get extension file
      //================================================
      protected static function get_ext($filename){
          $file = explode('.',$filename);
          if(count($file)>2){
              $file_ext = $file[count($file)-1];
          }else{
              $file_ext = $file[1];
          }

          return $file_ext;
      }

}

// load default core system
//=====================================
$core = new Auth_File;
$core->__server();
