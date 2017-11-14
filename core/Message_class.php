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

class Message_class{


  /**
  *@param  string
  *@return string message
  */
  protected static function msg_blank($string = 'There is still an empty field or illegal characters,
  please fill out first and then move on again'){
      return $string;
  }


  /**
  *@param  string
  *@return string message
  */
  protected static function msg_duplicate($string = 'Some data already exists in our database,
  please check back in your input for better'){
      return $string;
  }



  /**
  *@param  string
  *@return string message
  */
  protected static function msg_login_failed($string = 'email address or password you entered is not registered in our database,
  please check again'){
      return $string;
  }


  /**
  *@param  string
  *@return string message
  */
  protected static function msg_login_success($string = 'Authentication email address and password you are successful,
  please continue your activities back'){
      return $string;
  }


  /**
  *@param  string
  *@return string message
  */
  protected static function msg_wrong_email($string = 'Authentication email address and password you are not successful,
  please correct your email address first'){
      return $string;
  }

  /**
  *@param  string
  *@return string message
  */
  protected static function msg_register_success($string = 'Your member registration are successfuly,
  please continue your activities'){
      return $string;
  }

  /**
  *@param  string
  *@return string message
  */
  protected static function msg_already($string = 'The email address you used is already registered on our database,
  please use another email address'){
      return $string;
  }


  protected static function msg_save($string='your data has been successfully saved, please continue your activities'){
      return $string;
  }


  protected static function msg_failed($string='your data failed to save to database, please cek your data first'){
      return $string;
  }


}


 ?>
