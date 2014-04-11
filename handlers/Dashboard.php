<?php 
  
  class Dashboard
  {
    function __construct()
    {
      $session = new Sessions();
      $helper = new Helpers();
      $db = new DatabaseUtils();

      if ($session->get("is_logged"))
      {
        $servers = $db->getRecord("SELECT * FROM servers WHERE id_user = ".$session->get("id_user"), true);
        require_once(ROOT."/public/dashboard.php");
      }
      else
      {
        $helper->redirect($helper->getLink("login",array("forbidden"=>1)));
      }
    }
  }

?>