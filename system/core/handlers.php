<?php 
    
    spl_autoload_register(function ($handler) {
      $handler_path = ROOT."/handlers/".$handler.".php";
      if (file_exists($handler_path))
      {
        require_once($handler_path);
      }
    });

?>