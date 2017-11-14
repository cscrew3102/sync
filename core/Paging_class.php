<?php
require_once'Encrypt_class.php';

class Paging_class extends Encrypt_class{


  protected $start=0;


  protected $limit=10;

  protected static function pagging(){
      $start = $this::segment(3);
      if($start==''){
          $start=0;
      }
      $st = "<div class='paging'>
                <a href='".$start."'>".$start."</a>
            </div>";

      echo $st;
  }


}
