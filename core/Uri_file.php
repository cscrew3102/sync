<?php



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
require_once 'core/Message_class.php';

class Uri_file extends Message_class{

  /**
  *@author csteam
  *@return uri segment
  *@param segment
  *=================================================
  **/
  protected static function segment($segment){
        $_SERVER['REQUEST_URI_PATH'] = $_SERVER['REQUEST_URI'];
        $segments = explode('/',str_replace('/./','/',str_replace('//','/',str_replace(ROOT_HOST,'',$_SERVER['REQUEST_URI']))));

        if(isset($segments[$segment])!==''){
            $data = @$segments[$segment];
        }
        return $data;
  }


  protected static function last_segment($min=0){
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $link=str_replace('/./','/',str_replace('//','',$actual_link));
        $link=explode('/',$link);
        $str=$link[(count($link)-($min+1))];
        return $str;
  }


  protected static function full_url($min=0){
        if($min<1){
            $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            return $actual_link;
        }else{
            $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $fase=explode('/',$actual_link);$ln='';
            for($a=(count($fase)-$min);$a<count($fase);$a++){
                $ln.='/'.$fase[$a];
            }
            $link=str_replace($ln,'',$actual_link);
            return $link;
        }
  }

  /**
  *@return true false
  *@param request header
  *============================================**/
  protected static function ajax_request(){
      $enc = new Encrypt_class;
      $headers = isset($_SERVER['HTTP_X_VALIDATE']) ? $_SERVER['HTTP_X_VALIDATE'] : null;
      $x_header = $enc::g_decode($headers);

      $header = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? $_SERVER['HTTP_X_REQUESTED_WITH'] : null;
      if($header === 'XMLHttpRequest' && $x_header === 'banyumasweb'){
          return true;
      }else{
          return false;
      }
  }



  protected static function redirect($string){
      $red = "<meta http-equiv='refresh' content='10,".$string."' />";
      // return $red;
  }


  protected static function images($images,$size='',$path=''){
      if($size == 'md'){
          $img = "md_no-preview.jpg";
      }elseif($size == 'sm'){
          $img = "sm_no-preview.jpg";
      }else{
          $img = "no-preview.jpg";
      }

      if(empty($path)){
          $gambar = IMG_HOST.'/'.str_replace("assets/uploads/",'',$images);
      }else{
          $gambar = $path.$images;
      }

      if(is_file($images)){
          return $gambar;
      }else{
          return IMAGES.'/'.$img;
      }
  }


  protected static function set_dir(){
      if(date('d') < 2){
          if(is_dir('./assets/uploads/'.date('Y'))){
              if(!is_dir('./assets/uploads/'.date('Y/m'))){
                  mkdir('./assets/uploads/'.date('Y/m'));
                  mkdir('./assets/uploads/'.date('Y/m/').'tumb');
              }
          }else{
              mkdir('./assets/uploads/'.date('Y'));
          }

          if(is_dir('./assets/users/'.date('Y'))){
              if(!is_dir('./assets/users/'.date('Y/m'))){
                  mkdir('./assets/users/'.date('Y/m'));
                  mkdir('./assets/users/'.date('Y/m/').'tumb');
              }
          }else{
              mkdir('./assets/users/'.date('Y'));
          }
      }
  }


  protected static function setting($field){
      $query = $this::view_data('setting_value',
                                'setting',
                                array('setting_name'=>"'$field'"));
      $data = $query->current();
      return $data->setting_value;
  }


  protected static function remove_image($image){
      if(file_exists($image)){
          unlink($image);
      }
  }

}
