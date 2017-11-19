<?php
$_SESSION['nis']="sad";
defined('BASEPATH')OR exit('not direct script access allowed');
$this::user_auth('nis');

$url = $this::last_segment();
if($url === 'save_data' && $this::ajax_request()){
    // menangkap variabel dari post methode
    $foo = $this::form_post('foo');
    $bar = $this::form_post('bar');

    // pendefinisian data yang akan disimpan
    // dan field yang digunakan
    $data = array(
        'foo'=>$this::g_decode($foo),
        'bar'=>$this::g_decode($bar)
    );

    // proses simpan data ke database
    $this::insert_data($table,$data);
    $info = array(
        'status'=>'success',
        'msg'=>'write message here'
    );
    $this::clean_json($info);
}

 ?>
