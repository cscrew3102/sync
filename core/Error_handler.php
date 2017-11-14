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

ini_set('log_error',1);
// ini_set('error_log',LOG_FILE);

require_once 'core/Basepath.php';
require_once 'core/Encrypt_class.php';

class Error_handler extends Encrypt_class{



    protected function __system_error($sync__errno=0, $sync__errstr='', $sync__errfile='undefined', $__errline='zero'){
        if (!(error_reporting() & $sync__errno)) {
            // This error code is not included in error_reporting
            return;
        }
        ?>
        <style>
          body{padding:0;left:0;top:0;margin:0;position:absolute;width:100%;background:#ffffff;background-position:middle;overflow:hidden;}
          .bg_error{position:absolute;left:50%;top:50%;margin-top:100px;margin-left:-250px;background:url('<?php echo ASSETS.'/images/'.'404.gif'; ?>');width:500px;height:420px;background-repeat:no-repeat}
          .error{width:100%;min-height:70px;background:#e6e3e3;font:12px sans-serif;padding:10px;border-bottom:1px solid #8a8988;border-top:1px solid #8a8988}
          .error h3{font-weight: bold;font: 20px sans-serif}
        </style>
        <?php

        switch ($sync__errno) {

        case E_USER_ERROR:
            echo "<div style='width:100%;height:100%;position:fixed;top:0;left:0;background:#252525 url(".ASSETS."/images/404.gif);background-position:center;background-repeat:no-repeat' onclick=location.href='".ROOT_HOST."'></div>";
            exit(1);
            break;

        case E_USER_WARNING:
            echo "<div style='width:100%;height:100%;position:fixed;top:0;left:0;background:#252525 url(".ASSETS."/images/404.gif);background-position:center;background-repeat:no-repeat' onclick=location.href='".ROOT_HOST."'></div>";
            exit(1);
            break;

        case E_USER_NOTICE:
            echo "<div style='width:100%;height:100%;position:fixed;top:0;left:0;background:#252525 url(".ASSETS."/images/404.gif);background-position:center;background-repeat:no-repeat' onclick=location.href='".ROOT_HOST."'></div>";
            die();
            break;

        default:
            echo "<div style='width:100%;height:100%;position:fixed;top:0;left:0;background:#252525 url(".ASSETS."/images/404.gif);background-position:center;background-repeat:no-repeat' onclick=location.href='".ROOT_HOST."'></div>";
            exit(1);
            break;
        }

        /* Don't execute PHP internal error handler */

        return true;
    }


    protected static function error_php(){
          ob_flush();
          echo "<div style='width:100%;height:100%;position:fixed;top:0;left:0;background:#252525 url(".ASSETS."/images/404.gif);background-position:center;background-repeat:no-repeat' onclick=location.href='".ROOT_HOST."'></div>";
          die();
    }

    protected function error_query($error){
        throw new Exception($error.': '.mysql_error());
        $this::pesan_log($error.mysql_error());

    }


}
