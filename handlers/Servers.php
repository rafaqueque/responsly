<?php 
  
  class Servers
  {

    function __construct()
    {
      $session = new Sessions();
      $helper = new Helpers();

      if (!$session->get("is_logged"))
        $helper->redirect($helper->getLink("login",array("forbidden"=>1)));
    }
    

    function get($action=null, $id=null)
    {

      if (!$action)
      {
        $session = new Sessions();
        $db = new DatabaseUtils();

        $servers = $db->getRecord("SELECT * FROM servers WHERE id_user = ".$session->get("id_user"), true);

        require_once(ROOT."/public/servers.php"); 
      }
      else
      {
        if (in_array($action,array("edit","view")))
        {
          $session = new Sessions();
          $db = new DatabaseUtils();

          $server = $db->getRecord("SELECT * FROM servers WHERE id = ".$id." AND id_user = ".$session->get("id_user"), false);
          $server_check_type = $db->getRecord("SELECT * FROM servers_check_type WHERE id = ".$server['id_server_check_type'], false);  
          $server_check_status = $db->getRecord("SELECT * FROM servers_check_status WHERE id = ".$server['id_server_check_status'], false);     

          if ($action === "edit")
          {
            require_once(ROOT."/public/servers_detail.php");
          }
          if ($action === "view")
          {
            require_once(ROOT."/public/servers_detail.php");
          }
        } 
      }
      
    }


    function post($action=null, $id=null)
    {
      if ($action === "remove")
      {
        $db = new DatabaseUtils();
        $helper = new Helpers();
        
        $result = $db->delete("servers", "id", array($id));

        if ($result)
        {
          $helper->redirect($helper->getLink("servers"));
        }
      }

      if ($action === "new")
      {
        $db = new DatabaseUtils();
        $helper = new Helpers();
        $session = new Sessions();

        $user = $db->getRecord("SELECT * FROM users WHERE id = ".$session->get("id_user"));
        $plan = $db->getRecord("SELECT * FROM plans WHERE id = ".$user['id_plan']);
        $servers = $db->getRecord("SELECT COUNT(*) as 'count' FROM servers WHERE id_user = ".$user['id']);

        if ($servers['count'] < $plan['n_websites'])
        {
          $_POST['date_added'] = date("Y-m-d H:i:s");
          
          $result = $db->insert("servers", $_POST);

          if ($result)
          {
            $helper->redirect($helper->getLink("servers/view/".$result));
          }
          else
          {
            $helper->redirect($helper->getLink("servers", array("error"=>1)));
          }
        }
        else
        {
          $helper->redirect($helper->getLink("servers", array("error"=>1,"too_many"=>1)));
        }
      }

      if ($action === "update")
      {
        $db = new DatabaseUtils();
        $helper = new Helpers();

        $result = $db->update("servers", "id", $_POST['id'], $_POST);

        if ($result)
        {
          $helper->redirect($helper->getLink("servers/view/".$_POST['id']));
        }
      }
    }

  }

?>