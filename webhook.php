<?php
  require("functions.php");

  $array = $_REQUEST;
  error_log(print_r($array, TRUE));

  $arrlength = count($array);
  error_log(print_r($arrlength, TRUE));
  error_log(print_r($array[0], TRUE));
  error_log(print_r($array[0].email, TRUE));

  for($i = 0; $i < $arrlength; $i++) {
    if ($array[$i].event == 'delivered'){
      insertTable("Lists", $array[$i].email);
    }
    if (($array[$i].event == 'dropped') || ($array[$i].event == 'bounce') || ($array[$i].event == 'spamreport')){
      insertTable("ColdLists", $array[$i].email);
    }
  }
?>
