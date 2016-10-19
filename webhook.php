<?php
  require("functions.php");

  $data = json_decode($HTTP_RAW_POST_DATA);

  foreach ( $data as $obj ){
    error_log(print_r($obj->email, TRUE));
    error_log(print_r($obj->event, TRUE));

    if ($obj->event == 'delivered'){
      insertTable("Lists", $obj->email);
    }
    if (($obj->event == 'dropped') || ($obj->event == 'bounce') || ($obj->event == 'spamreport')){
      insertTable("ColdLists", $obj->email);
    }

  }
?>
