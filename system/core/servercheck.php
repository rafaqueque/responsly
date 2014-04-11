<?php 
  
  class ServerCheck
  {
    function ping($domain)
    {
      $start_time = microtime(true);
      $socket = fsockopen ($domain, 80, $errno, $errstr, 10);
      $end_time = microtime(true);
      $status = 0;
   
      if (!$socket)
      {
        $status = -1;
      } 
      else 
      {
        fclose($socket);
        
        $status = ($end_time - $start_time) * 1000;
        $status = floor($status);
      }

      return $status;
    }
  }

  
?>