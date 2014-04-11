<?php 

  class Sessions
  {

    protected $prefix = "71780fa09c6b080c8333f86e79619465";

    function __construct()
    {
      session_start();
    }


    function get($key)
    {
      if (!$key)
      {
        return false;
      }
      else
      {
        return $_SESSION[$this->prefix.$key];
      }
    }


    function set($key, $value="")
    {
      if (!$key)
      {
        return false;
      }
      else
      {
        if ($value)
        {
          $_SESSION[$this->prefix.$key] = $value;
        }
        else
        {
          unset($_SESSION[$this->prefix.$key]);
        }

        return true;
      }
    }


    function destroy()
    {
      session_start();
      unset($_SESSION);
      session_destroy();

      return true;
    }

  }

?>