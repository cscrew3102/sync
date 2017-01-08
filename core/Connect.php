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

defined('DB_HOST') OR exit('No host defined for connection');




/**
*@param directory config file
*@return connection stat
*/
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../app/config/config.php';




class Connect {



	protected static $_connection;



	public static function getConnection(){
		if(!self::$_connection){

			self::$_connection = @mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
			if(!self::$_connection){

				/**
				*@param error handler
				*@return error message failer to connect to server db
				*/
				throw new Exception('Unable to connect to server. '.mysqli_connect_error());
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
