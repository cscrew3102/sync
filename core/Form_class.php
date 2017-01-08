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


require_once 'core/Error_handler.php';

class form_class extends Error_handler{

  function pesan_log($param){
      if(SQL_LOG == true){
          if(LOG_FILE !== ''){
              $file=LOG_FILE;
          }else{
              $file='sql_log.dat';
          }
              $handle = fopen($file,'a');
              write($handle,$param);
              fclose($handle);

      }

  }




    /**
    *@param $post is a post name data
    *@param $validate is a array data
    *@return true or false
    */

    public function validate($post,$validate =''){
        $post = $_POST[$post];
        $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
        $array = explode("|",$validate);
        if(count($array)>1){
            foreach ($array as $value) {
                if($value === 'required'){
                    if($post==''){return false;}
                }
                elseif($value === 'number'){
                    if(!is_int($post)){return false;}
                }
                elseif($value === 'alphabet'){
                    if(!preg_match("/^[a-zA-Z0-9]+$/", $post)){return false;}
                }
                elseif($value === 'email'){
                    if(filter_var($post, FILTER_VALIDATE_EMAIL) === false){return false;}
                }elseif($value === "notag"){
                    return strip_tags($post);
                }
                else{
                    return true;
                }
            }
        }
    }




    /**
    *@param $name is a field name of inpu
    *@return array post data
    */

    public static function form_post($name ='',$validate=''){
      if(!empty($_POST)){
          $data[] = $_POST ? $_POST:'';
          if(!empty($data[0][$name])){
              if(is_array($validate)){
                  foreach ($validate as $value) {
                      $this->validate($name,$value);
                  }
              }else{
                $st__ =$data[0][$name];
                return $st__;
              }
          }else{
              return false;
          }
      }
    }



    /**
    *@param $url is a url location
    *@param $statusCode is a status recirect code
    *@return link location
    */

    public static function redirect($url){
        echo"<meta http-equiv='refresh' content='0,$url'>";
    }





    public function image_creates($field_name = '', $target_folder = '', $file_name = '', $thumb = FALSE, $thumb_folder = '', $thumb_width = '', $thumb_height = ''){

        //folder path setup
        $target_path = $target_folder;
        $thumb_path = $thumb_folder;

        //file name setup
        $filename_err = explode(".",$_FILES[$field_name]['name']);
        $filename_err_count = count($filename_err);
        $file_ext = $filename_err[$filename_err_count-1];
        if($file_name != ''){
            $fileName = $file_name.'.'.$file_ext.'.jpg';
        }else{
            $fileName = $_FILES[$field_name]['name'];
        }

        //upload image path
        $upload_image = $target_path.basename($fileName);

        //upload image
        if(move_uploaded_file($_FILES[$field_name]['tmp_name'],$upload_image))
        {
            //thumbnail creation
            if($thumb == TRUE)
            {
                $thumbnail = $thumb_path.$fileName;
                list($width,$height) = getimagesize($upload_image);
                $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
                switch($file_ext){
                    case 'jpg':
                        $source = imagecreatefromjpeg($upload_image);
                        break;
                    case 'jpeg':
                        $source = imagecreatefromjpeg($upload_image);
                        break;

                    case 'png':
                        $source = imagecreatefrompng($upload_image);
                        break;
                    case 'gif':
                        $source = imagecreatefromgif($upload_image);
                        break;
                    default:
                        $source = imagecreatefromjpeg($upload_image);
                }

                imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
                switch($file_ext){
                    case 'jpg' || 'jpeg':
                        imagejpeg($thumb_create,$thumbnail,100);
                        break;
                    case 'png':
                        imagepng($thumb_create,$thumbnail,100);
                        break;

                    case 'gif':
                        imagegif($thumb_create,$thumbnail,100);
                        break;
                    default:
                        imagejpeg($thumb_create,$thumbnail,100);
                }

            }

            return $fileName;
        }
        else
        {
            return false;
        }
    }



    /*
    upload image using create image
    its to handler uploading shell
    ===========================================
    $this->upload(field_name,dir_name,file_name);
    ===========================================
    */
    public  function upload($name='',$dir='uploads/',$filename='tumb',$tumneil=FALSE,$tumbdir='thumb/',$width='100',$height='100'){
      if(!empty($_FILES[$name]['name'])){
        $rnd = rand(111,999);
        //call thumbnail creation function and store thumbnail name
        $upload_img = $this->image_creates($name,$dir,$filename.$rnd,$tumneil,$dir.'/'.$tumbdir,'200','160');

        //full path of the thumbnail image
        $thumb_src = 'uploads/'.$upload_img;

        //set success and error messages
        $message = $upload_img?"<span style='color:#008000;'>Image thumbnail have been created successfully.</span>":"<span style='color:#F00000;'>Some error occurred, please try again.</span>";
        return $message;

      }else{

        return false;
      }
    }




    /*
    filter info
    its to filter long text and contain html tag
    ==============================================
    $this::filter('field');
    ==============================================
    return true or false
    */
    public static function filter($field){
        $string = wordwrap(strip_tags($field),20," ",1);
        return $string;
    }





    public static function sort_key($input){
        $string = addcslashes(trip_tags($input));
        return $string;
    }




    /*
    function name b64_image()
    its compress image to base64_encode script
    ============================================
    $this::b64_image('filename.jpg');
    ============================================
    */
    public static function b64_images($filename){
          $imgData = base64_encode(file_get_contents($filename));
          $src = 'data: '.mime_content_type($filename).';base64,'.$imgData;
          return $src;
    }


    /*
    get file info
    usage this
    ================================================
    $this->fileinfo('filename.txt');
    ================================================
    */

    public  function fileinfo($filename){
        $type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $filename);
        return $type;
    }



    /*
    get myme type of file
    usage like this
    ===============================================
    $this::mime_type('filename.txt',false);
    ===============================================
    return example application/text
    */
    public function mime_type($file, $encoding=true) {
        $mime=false;

        if (function_exists('finfo_file')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mime = finfo_file($finfo, $file);
            finfo_close($finfo);
        }
        else if (substr(PHP_OS, 0, 3) == 'WIN') {
            $mime = mime_content_type($file);
        }
        else {
            $file = escapeshellarg($file);
            $cmd = "file -iL $file";

            exec($cmd, $output, $r);

            if ($r == 0) {
                $mime = substr($output[0], strpos($output[0], ': ')+2);
            }
        }

        if (!$mime) {
            return false;
        }

        if ($encoding) {
            return $mime;
        }

        return substr($mime, 0, strpos($mime, '; '));
    }


    /*
    compress file to zip
    usage info
    ===========================================
    create_zip($files_to_zip,'my-archive.zip');
    ===========================================
    */
    public static function create_zip($files = array(),$destination = '',$overwrite = false) {
    	if(file_exists($destination) && !$overwrite) { return false; }
    	$valid_files = array();
    	if(is_array($files)) {
    		foreach($files as $file) {
    			if(file_exists($file)) {
    				$valid_files[] = $file;
    			}
    		}
    	}

    	if(count($valid_files)) {
    		$zip = new ZipArchive();
    		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
    			return false;
    		}
    		foreach($valid_files as $file) {
    			$zip->addFile($file,$file);
    		}

    		$zip->close();
    		return file_exists($destination);
    	}
    	else
    	{
    		return false;
    	}
    }



}
