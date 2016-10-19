<?php
  require("functions.php");

  $array = $HTTP_RAW_POST_DATA;
  error_log(print_r("array => ", TRUE));
  error_log(print_r($array, TRUE));

  $hash = $array[0];
  error_log(print_r("hash => ", TRUE));
  error_log(print_r($hash, TRUE));

  $arrlength = count($hash);
  error_log(print_r("count => ", TRUE));
  error_log(print_r($arrlength, TRUE));

  for($i = 0; $i < $arrlength; $i++) {
    if ($hash[$i]["event"] == 'delivered'){
      insertTable("Lists", $hash[$i]["email"]);
    }
    if (($hash[$i]["event"] == 'dropped') || ($hash[$i]["event"] == 'bounce') || ($hash[$i]["event"] == 'spamreport')){
      insertTable("ColdLists", $hash[$i]["email"]);
    }
  }
?>
