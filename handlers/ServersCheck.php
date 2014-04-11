<?php 
  
  class ServersCheck
  {

    function get($action=null, $id=null)
    {
      if ($action == "check")
      {
        $db = new DatabaseUtils();
        $helper = new Helpers();
        $servercheck = new ServerCheck();

        if ($id)
        {
          $server = $db->getRecord("SELECT * FROM servers WHERE id = ".$id, false);

          if ($server)
          {
            $response_time = $servercheck->ping($server['host']);

            $log = array();
            $log['id_server'] = $server['id'];
            $log['id_server_check_type'] = $server['id_server_check_type'];
            $log['host'] = $server['host'];
            $log['response_time'] = $response_time;
            $log['date'] = date("Y-m-d H:i:s");

            $db->insert("servers_check_log", $log);


            $db->update("servers", "id", $server['id'], array("last_checked" => date("Y-m-d H:i:s"),
                                                              "id_server_check_status" => (($response_time > 0) ? 2 : 3)));

            $helper->redirect($helper->getLink("servers/view/".$server['id'],array("success"=>1,"checked"=>1)));
          }
          else
          {
            $helper->redirect($helper->getLink("servers/view/".$server['id'],array("error"=>1,"checked"=>0)));
          }
        }
        else
        {
          $helper->redirect($helper->getLink("servers/view/".$server['id'],array("error"=>1)));
        }
      }
    }

  }

?>