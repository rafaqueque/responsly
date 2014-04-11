<?php 
  
  class Email
  {

    function __construct()
    {
      if (!IGNORE_SWIFT_REQUIRE)
        require_once(ROOT."/system/third-party/Swift/lib/swift_required.php");
    }


    function send($from=null, $to, $subject, $message, $attachments=array())
    {

      $transport = Swift_SendmailTransport::newInstance();
      $mailer = Swift_Mailer::newInstance($transport);
      $email = Swift_Message::newInstance();

      if ($from)
      {
        if (!is_array($from))
        {
          $from = array($from);
        }
      }
      else
      {
        $from = array("notify@responsly.com" => "Responsly Notification");
      }

      if ($to)
      {
        if (!is_array($to))
        {
          $to = array($to);
        }
      }

      $email->setFrom($from);
      $email->setTo($to);
      $email->setSubject($subject);
      $email->setBody($message, 'text/html');

      return $mailer->send($email);

    }

  }


?>