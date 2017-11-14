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
*@param directory config file
*@return connection stat
*/
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../config.php';



class Connect{



	public static $_connection;



	public static function getConnection(){
		if(!self::$_connection){

			self::$_connection = @mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
			if(!self::$_connection){

				/**
				*@param error handler
				*@return error message failer to connect to server db
				*/
				throw new Exception('Unable to connect to server');
			}
		}
		return self::$_connection;
	}



	/**
	*@param close connection function
	*/
	public static function close(){
		if(self::$_connection){
			mysqli_close(self::$_connection);
		}
	}
}
