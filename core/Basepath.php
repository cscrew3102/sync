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
*@link http://sync-framework.net
*@param configuration patch file
*@author sync-framework team
*@final 2016
*@copyright sync-framework team
*@license sync-framework team
*@package free php framework
*/

require_once 'app/config/config.php';




/**
*@param $host $user $password $database
*@return status
*/
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'Connect.php';



/**
* define get http or https
*
*============================== */
$http='';
if(@$_SERVER["HTTPS"]){$http = "https://";}else{$http ="http://";}


/**
*define root position
*@param $server
*@return dir root
*/
define('ROOT_HOST', $http.$_SERVER['HTTP_HOST']);





/**
*@param image dir system
*@return image dir
*/
define('IMAGES',  ROOT_HOST.'/assets/images/');




/**
*@param core folder system
*@return core file location
*/
define('CORE', ROOT_HOST.'/core/');






/**
*@param filename without .ext
*@return load file
*==================================*/
define('CUSTOM',  ROOT_HOST.'/app/customs');




/**
*@param validate to local file host
*@return TRUE or FALSE
*/
define('BASEPATH',  ROOT_HOST);
