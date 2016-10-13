<?php
  //sendgrid lib
  require("sendgrid-php/sendgrid-php.php");

  if (isset($_REQUEST['email']))  {
    $mail_to = $_REQUEST['email'];
    $message = $_REQUEST['message'];
    $subject = $_REQUEST['subject'];

    $from    = new SendGrid\Email(null, "testeproduction@gmail.com");
    $to      = new SendGrid\Email(null, $mail_to);
    $content = new SendGrid\Content("text/plain", $message);

    $mail = new SendGrid\Mail($from, $subject, $to, $content);

    $apiKey = getenv('SENDGRID_API_KEY');
    $sg     = new \SendGrid($apiKey);

    $response    = $sg->client->mail()->send()->post($mail);
    $status_code = $response->statusCode();

    echo $status_code;
    echo $response->headers();
    echo $response->body();

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
