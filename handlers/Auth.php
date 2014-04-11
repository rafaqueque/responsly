<?php 
  
  class Auth
  {
    function get($action=null, $id=null)
    {
      if ($action == "logout")
      {
        $helper = new Helpers();
        $session = new Sessions();
        
        $session->destroy();
        
        $helper->redirect($helper->getLink("login",array("success"=>1)));
      }
    }

    function post($action=null, $id=null)
    {
      if ($action == "login")
      {
        $db = new DatabaseUtils();
        $helper = new Helpers();
        $session = new Sessions();

        $user = $db->getRecord("SELECT * FROM users WHERE email = '".$_POST['email']."' AND password = '".sha1(md5(sha1($_POST['password'])))."'", false);

        if ($user)
        {
          $session->set("is_logged", true);
          $session->set("id_user", $user['id']);

          if ($session->get("is_logged"))
          {
            $helper->redirect($helper->getLink("dashboard"));
          }
          else
          {
            $helper->redirect($helper->getLink("login",array("error"=>2)));
          }
        }
        else
        {
          $session->destroy();
          
          $helper->redirect($helper->getLink("login",array("error"=>1)));
        }
      }

      if ($action == "register")
      {
        $db = new DatabaseUtils();
        $helper = new Helpers();
        $session = new Sessions();
        $email = new Email();

        $check_duplicate = $db->getRecord("SELECT * FROM users WHERE email = '".$_POST['email']."'", false);

        if (!$check_duplicate)
        {

          $plain_text_password = $_POST['password'];
          $_POST['password'] = sha1(md5(sha1($_POST['password'])));

          $result = $db->insert("users", $_POST);

          if ($result)
          {
            /* e-mail after registration */
            $email_from = "";
            $email_to = $_POST['email'];
            $email_subject = "Thank you for your registration";
            $email_message = "Welcome aboard, <br><br>
                              You can start using our service right now! Take a look at your login details below: <br><br>
                              <table cellpadding='10'>
                                <tr><td>E-mail</td> <td><b>".$_POST['email']."</b></td></tr>
                                <tr><td>Password</td> <td><b>".$plain_text_password."</b></td></tr>
                              </table><br><br>
                              Thank your for your registration. Hope you're doing well!";
            $email->send($email_from, $email_to, $email_subject, $email_message);


            $user = $db->getRecord("SELECT * FROM users WHERE id = ".$result, false);


            if ($user)
            {
              $session->set("is_logged", true);
              $session->set("id_user", $user['id']);

              if ($session->get("is_logged"))
              {
                $helper->redirect($helper->getLink("dashboard"));
              }
              else
              {
                $helper->redirect($helper->getLink("login",array("registered"=>1)));
              }
            }
            else
            {
              $helper->redirect($helper->getLink("login",array("registered"=>1)));
            }
          }
          else
          {
            $helper->redirect($helper->getLink("register",array("error"=>1)));
          }
        }
        else
        {
          $helper->redirect($helper->getLink("register",array("error"=>1,"duplicate"=>1)));
        }
      }


      if ($action == "update")
      {
        $db = new DatabaseUtils();
        $helper = new Helpers();
        $session = new Sessions();
        $email = new Email();

        $user = $db->getRecord("SELECT * FROM users WHERE id = ".$_POST['id'], false);
        $check_duplicate = $db->getRecord("SELECT * FROM users WHERE email = '".$_POST['email']."' AND id <> ".$_POST['id'], false);

        if (!$check_duplicate)
        {

          if (strlen($_POST['old_password']) > 0 || strlen($_POST['new_password']) > 0)
          {
            if (sha1(md5(sha1($_POST['old_password']))) === $user['password'])
            {
              $plain_text_password = $_POST['new_password'];
              $_POST['password'] = sha1(md5(sha1($_POST['new_password'])));
            }
            else
            {
              $helper->redirect($helper->getLink("account",array("error"=>1,"passwords_not_match"=>1)));
              die();
            }
          }
          unset($_POST['new_password']);
          unset($_POST['old_password']);

          $result = $db->update("users", "id", $_POST['id'], $_POST);
          $user = $db->getRecord("SELECT * FROM users WHERE id = ".$_POST['id'], false);
          
          if ($result)
          {
            if ($_POST['password'])
            {
              /* e-mail after registration */
              $email_from = "";
              $email_to = $_POST['email'];
              $email_subject = "Your password has changed";
              $email_message = "Hello, <br><br>
                                Looks like you've changed your password. Keep your login details safe: <br><br>
                                <table cellpadding='10'>
                                  <tr><td>E-mail</td> <td><b>".$_POST['email']."</b></td></tr>
                                  <tr><td>Password</td> <td><b>".$plain_text_password."</b></td></tr>
                                </table><br><br>
                                Thank you!";
              $email->send($email_from, $email_to, $email_subject, $email_message);
            }            

            $helper->redirect($helper->getLink("account",array("success"=>1)));
          }
          else
          {
            $helper->redirect($helper->getLink("account",array("error"=>1)));
          }
        }
        else
        {
          $helper->redirect($helper->getLink("account",array("error"=>1,"duplicate"=>1)));
        }
      }
    }
  }

?>