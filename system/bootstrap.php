<?php 

  require_once("config.php");

  /* core libs */
  require_once(ROOT."/system/core/sessions.php");
  require_once(ROOT."/system/core/email.php");
  require_once(ROOT."/system/core/helpers.php");
  require_once(ROOT."/system/core/database.php");
  require_once(ROOT."/system/core/servercheck.php");

  /* handlers and routes */
  require_once(ROOT."/system/core/handlers.php");
  require_once(ROOT."/system/core/routes.php");
  
?>