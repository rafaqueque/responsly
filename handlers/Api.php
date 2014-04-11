<?php 
  
  class Api
  {
    function get($action=null, $id=null)
    {
      $db = new DatabaseUtils();

      if ($action == "servers")
      {
        $hosts = array();

        $servers = $db->getRecord("SELECT DISTINCT host FROM servers", true);
        foreach ($servers as $server)
        {
          array_push($hosts, $server['host']);
        }

        header("Content-Type: text/plain");
        echo implode(",",$hosts);

      }
    }
  }

?>