<?php
  //sendgrid lib
  require("sendgrid-php/sendgrid-php.php");
  require("functions.php");

  createTable("Lists");
  createTable("ColdLists");

  if (isset($_REQUEST['email']))  {
    $URL    = "https://engaged-email.herokuapp.com/lists.php";
    $apiKey = getenv('SENDGRID_API_KEY');
    $sg     = new \SendGrid($apiKey);

    $email_a = $_REQUEST['email'];
    $message = $_REQUEST['message'];
    $subject = $_REQUEST['subject'];

    $from    = new SendGrid\Email(null, "testeproduction@gmail.com");
    $content = new SendGrid\Content("text/plain", $message);

    // treat array of emails
    $emails    = explode(",", $email_a);
    $arrlength = count($emails);

    for($i = 0; $i < $arrlength; $i++) {
      $to   = new SendGrid\Email(null, $emails[$i]);
      $mail = new SendGrid\Mail($from, $subject, $to, $content);

      $response    = $sg->client->mail()->send()->post($mail);
      $status_code = $response->statusCode();

      print_r($response);

      if($status_code == 202){
        insertTable("Lists", $emails[$i]);
      } else {
        insertTable("ColdLists", $emails[$i]);
      }
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
