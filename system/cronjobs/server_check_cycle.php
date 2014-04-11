<?php 
  ini_set("display_errors", 1);
  error_reporting(E_ALL);

  define("IGNORE_SWIFT_REQUIRE", true);
  define('CRON_ROOT', dirname(__FILE__));

  require_once(CRON_ROOT."/../config.php");
  require_once(CRON_ROOT."/../core/database.php");
  require_once(CRON_ROOT."/../core/servercheck.php");
  require_once(CRON_ROOT."/../third-party/Swift/lib/swift_required.php");
  require_once(CRON_ROOT."/../core/email.php");

  $db = new DatabaseUtils();
  $servercheck = new ServerCheck();
  $email = new Email();

  $servers = $db->getRecord("SELECT * FROM servers", true);

  if (is_array($servers))
  {
    foreach ($servers as $server)
    {
      if ($server['host'])
      {
        $response_time = $servercheck->ping($server['host']);

        $log = array();
        $log['id_server'] = $server['id'];
        $log['id_server_check_type'] = $server['id_server_check_type'];
        $log['host'] = $server['host'];
        $log['response_time'] = $response_time;
        $log['date'] = date("Y-m-d H:i:s");

        $id_log = $db->insert("servers_check_log", $log);

        $db->update("servers", "id", $server['id'], array("last_checked" => date("Y-m-d H:i:s"),
                                                          "id_server_check_status" => (($response_time > 0) ? 2 : 3)));

        if ($response_time <= 0)
        {
          $user = $db->getRecord("SELECT * FROM users WHERE id = ".$server['id_user']);

          /* e-mail after a server is down */
          $email_from = "";
          $email_to = $user['notification_email'];
          $email_subject = "[ATTENTION] ".$server['name']." (".$server['host'].") is down!";
          $email_message = "Hello, we have bad news! <br><br>
                            You have this server/website down. Check the details: <br><br>
                            <table cellpadding='10'>
                              <tr><td>Name</td> <td><b>".$server['name']."</b></td></tr>
                              <tr><td>Host</td> <td><b>".$log['host']."</b></td></tr>
                              <tr><td>Date</td> <td><b>".$log['date']."</b></td></tr>
                            </table><br><br>
                            We are so sorry about this!";
          $sent = $email->send($email_from, $email_to, $email_subject, $email_message);

          if ($sent)
          {
            $db->update("servers_check_log", "id", $id_log, array("sent_notification_email" => 1));
          }
        }
      }
    }
  }

  echo "finito";

?>