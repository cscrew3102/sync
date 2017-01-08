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
require_once "core/Session.php";

class Auth_user extends Session{

  /**
  *@param array name
  *@return array session
  *======================================
  */

  public static function session($key,$value){
      // $session = $this::getInstance();
      // $session->$key = $value;
  }


  /**
  *@param array session
  *@return remove array session
  *======================================
  */
  public static function del_session($data){
    if(is_array($data)){
        for($a=0;$a<count($data);$a++){
            unset($_SESSION[$key[$a]]);
        }
    }
  }


  /**
  *@param array value
  *@return array session
  *======================================
  */

  public static function view_session($data){
      $data = isset($_SESSION[$data]);
      return $data;
  }



  public static function userdata($value){
      $session = new Session;
      $static = $session->__isset($value);
      return $static;
  }



  public static function set_user($data){
      $session = new Session;
      if(is_array($data)){
          foreach ($data as $key => $value) {
              $user = $session->getInstance()->$key = $value;
              return $user;
          }
      }else{
          return false;
      }
  }

}
