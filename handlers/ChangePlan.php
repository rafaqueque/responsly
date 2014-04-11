<?php 
  
  class ChangePlan
  {
    function __construct()
    {
      $session = new Sessions();
      $helper = new Helpers();
      $db = new DatabaseUtils();

      if ($session->get("is_logged"))
      {
        $user = $db->getRecord("SELECT * FROM users WHERE id = ".$session->get("id_user"), false);
        require_once(ROOT."/public/change_plan.php");
      }
      else
      {
        $helper->redirect($helper->getLink("login",array("forbidden"=>1)));
      }
    }
  }

?>