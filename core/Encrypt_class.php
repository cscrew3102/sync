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




/**
*@param encripted class
*/
require_once "core/Auth_user.php";

class Encrypt_class extends Auth_user{

    /**
    *@param array name
    *@return array session
    *======================================
    */

    public static function data_session($data){

        if(is_array($data)){
            for($a=0;$a<count($data);$a++){
                $_SESSION["$key[$a]"] = $value[$a];
            }
        }
    }


    /**
    *@param array session
    *@return remove array session
    *======================================
    */
    public static function del_session($data){
      if(is_array($data)){
          for($a=0;$a<count($data);$a++){
              unset($_SESSION["$key[$a]"]);
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



    /**
    *@param random key string
    */
    protected $sync__key = 'enteryourcompanyname';



    /**
    *@param random number
    */
    private function random(){

        return $sync__string = rand(11111,99999);
    }




    /**
    *@param $sync_string string type
    */
    public static function b64_encode($sync__string){
        $sync__rand = $this->random();
        $sync__data = str_replace("=","#",base64_encode($sync__rand.$sync__string));
        $sync__data = strrev($sync__data);
        return $sync__data;
    }




    /**
    *@param $string to decode base64_decode
    *@return string data
    */
    public static function b64_decode($sync__string){
        $string = strrev($sync__string);
        $string = base64_decode($string);
        $string = substr(str_replace("#","=",$string),5);

        return $string;
    }




    /**
    *@param $string data to hash
    *@return string data hash
    *@return hash string to hexa char
    */
    public static function str2hex($sync__string){
        $hex = '';
        for ($i=0; $i<strlen($sync__string); $i++){
            $ord = ord($sync__string[$i]);
            $hexCode = dechex($ord);
            $hex .= substr('0'.$hexCode, -2);
        }
        return strToUpper($hex);
    }



    /**
    *@param $hex string to decode
    *@return string data has been decode
    *@return string data who has to decode
    */
    public static function hex2str($hex){
        $sync__string='';
        for ($i=0; $i < strlen($hex)-1; $i+=2){
            $sync__string .= chr(hexdec($hex[$i].$hex[$i+1]));
        }
        return $sync__string;
    }



    /**
    *@param string to encode
    *@return string encode
    */
    public static function md5_hash($string){
        $string = sha1(md5($string));
        $key = sha1($string);
        $string = strrev($string.':'.$key);

        return $string;
    }



    private function sth($sync__string){
      $hex = '';
      for ($i=0; $i<strlen($sync__string); $i++){
          $ord = ord($sync__string[$i]);
          $hexCode = dechex($ord);
          $hex .= substr('0'.$hexCode, -2);
      }
      return strToUpper($hex);
    }


    /**
    * global encode format
    *@param string
    *@return string
    */
    public static function g_encode($string){
        $string = base64_encode($string);
        $string = strrev($string);
        $hex = '';
        for ($i=0; $i<strlen($string); $i++){
            $ord = ord($string[$i]);
            $hexCode = dechex($ord);
            $hex .= substr('0'.$hexCode, -2);
        }
        return strToUpper($hex);
    }



    /**
    *global decode format
    *@param string
    *@return string
    */
    public static function g_decode($string){
        $str='';
        for ($i=0; $i < strlen($string)-1; $i+=2){
            $str .= chr(hexdec($string[$i].$string[$i+1]));
        }
        $string = strrev($str);
        return base64_decode($string);
    }



}
