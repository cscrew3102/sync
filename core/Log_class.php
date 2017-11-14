<?php


protected $log_file ="log.txt";



protected static function cek_log($filename){

    if(file_exists($filename)){

      if(file_exists($log_file)){

          if(filemtime($log_file) > $result_set['filemtime']) {
              $handle = fopen($log_file,'a');
              fwrite($handle,"\rfile $log_file telah diupdate pada :".date('Y-m-d H:i:s'));
              fclose($handle);
          }

      }

    }


}



protected static function search_word($word){

      $file = 'somefile.txt';
      $searchfor = 'name';

      // the following line prevents the browser from parsing this as HTML.
      header('Content-Type: text/plain');

      // get the file contents, assuming the file to be readable (and exist)
      $contents = file_get_contents($file);
      // escape special characters in the query
      $pattern = preg_quote($searchfor, '/');
      // finalise the regular expression, matching the whole line
      $pattern = "/^.*$pattern.*\$/m";
      // search, and store all matching occurences in $matches
      if(preg_match_all($pattern, $contents, $matches)){
       echo "Found matches:\n";
       echo implode("\n", $matches[0]);
      }
      else{
       echo "No matches found";
      }

}
