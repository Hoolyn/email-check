<?php
  //sendgrid lib
  require("sendgrid-php/sendgrid-php.php");

  if (isset($_REQUEST['email']))  {
    $mail_to = $_REQUEST['email'];
    $from    = new SendGrid\Email(null, "testeproduction@gmail.com");
    $to      = new SendGrid\Email(null, $mail_to);
    $subject = $_REQUEST['subject'];
    $message = $_REQUEST['message'];

    //send email
    $mail = new SendGrid\Mail($from, $subject, $to, $message);

    $apiKey = getenv('SENDGRID_API_KEY');
    $sg = new \SendGrid($apiKey);

    $response = $sg->client->mail()->send()->post($mail);
    $status_code = $response->statusCode();
    echo $status_code;

    if($status_code == 200){
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
