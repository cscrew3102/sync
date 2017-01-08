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

class Uri_file {

  /**
  *@author csteam
  *@return uri segment
  *@param segment
  *=================================================
  **/
  public static function segment($segment){
        $_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $segments = explode('/', $_SERVER['REQUEST_URI_PATH']);

        if(isset($segments[$segment])!==''){
            $data = @$segments[$segment];
        }
        return $data;
  }



  /**
  *@return true false
  *@param request header
  *============================================**/
  public static function ajax_request(){
      $header = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? $_SERVER['HTTP_X_REQUESTED_WITH'] : null;

      if($header === 'XMLHttpRequest'){
          return true;
      }else{
          return false;
      }
  }


}
