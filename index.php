<?php
  if (isset($_REQUEST['email']))  {
    $to      = $_REQUEST['email'];
    $subject = $_REQUEST['subject'];
    $message = $_REQUEST['message'];
    $header  = "From: testeproduction@gmail.com" . "\r\n";

    //send email
    $send = mail($to, $subject, $message, $header);

    if($send){
      echo "Message has been successfully sent";
    } else {
      echo "Sorry, something was wrong";
    }
  } else {
?>
  <form method="post">
    Email: <input name="email" type="text" /><br />
    Subject: <input name="subject" type="text" /><br />
    Message:<br />
    <textarea name="message" rows="15" cols="40"></textarea><br />
    <input type="submit" value="Submit" />
  </form>
<?php
  }
?>
