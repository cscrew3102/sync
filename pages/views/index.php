<?php
$query = $this::view_data('*','system_calltype');
foreach ($query as $value) {

    $query1 = $this::view_data('date(date_time) as tot, HOUR(date_time) as hour',
                              "data_transaction group by hour(date_time)");
    $data = array();
    foreach ($query1 as $result) {
        $data[]=array(
            'jam'=>$result->hour,
            'tot'=>$result->tot
        );
    }
    $info[] = array(
        'data'=>$data
    );
}
$this::clean_json($info);
 ?>
