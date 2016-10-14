<?php
  //sendgrid lib
  require("sendgrid-php/sendgrid-php.php");
  require("functions.php");

  createTable("Lists");
  createTable("ColdLists");

  if (isset($_REQUEST['email']))  {
    $URL="https://engaged-email.herokuapp.com/lists.php";

    $email_a = $_REQUEST['email'];

    // treat array of emails
    $emails    = explode(",", $email_a);
    $arrlength = count($emails);

    for($x = 0; $x < $arrlength; $x++) {
      $to .= new SendGrid\Email(null, $emails[$x]);
    }

    $message = $_REQUEST['message'];
    $subject = $_REQUEST['subject'];

    $from    = new SendGrid\Email(null, "testeproduction@gmail.com");
    $content = new SendGrid\Content("text/plain", $message);

    $mail = new SendGrid\Mail($from, $subject, $to, $content);

    $apiKey = getenv('SENDGRID_API_KEY');
    $sg     = new \SendGrid($apiKey);

    $response    = $sg->client->mail()->send()->post($mail);
    $status_code = $response->statusCode();

    if($status_code == 202){
      insertTable("Lists", $mail_to);

      echo "Message has been successfully sent";
    } else {
      insertTable("ColdLists", $mail_to);

      echo "Sorry, something was wrong";
    }

    header ("Location: $URL");
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
