<?php
  require("functions.php");

  $array = $_REQUEST;

  $arrlength = count($array);

  for($i = 0; $i < $arrlength; $i++) {
    if ($array[$i].event == 'delivered'){
      insertTable("Lists", $array[$i].email);
    }
    if (($array[$i].event == 'dropped') || ($array[$i].event == 'bounce') || ($array[$i].event == 'spamreport')){
      insertTable("ColdLists", $array[$i].email);
    }
  }
?>
