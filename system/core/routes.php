<?php 

  require_once(ROOT."/system/third-party/Toro/Toro.php");

  Toro::serve(array(

    /* Regular */
    '/' => 'Homepage',
    '/index' => 'Homepage',
    '/login' => 'Login',
    '/register' => 'Register',
    '/faq' => 'Faq',
    '/support' => 'Support',

    /* misc */
    '/test' => 'TestPage',
    '/auth/:string' => 'Auth',

    /* app */
    '/account' => 'Account',
    '/change_plan' => 'ChangePlan',
    '/change_plan/:string' => 'ChangePlan',
    '/dashboard' => 'Dashboard',
    '/payment/:string' => 'Payments',
    '/servers' => 'Servers',
    '/servers/:string' => 'Servers',
    '/servers/:string/:number' => 'Servers',
    '/servers_check/:string/:number' => 'ServersCheck',

    /* api */
    '/api/:string' => 'Api'
  ));

?>