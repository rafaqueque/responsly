<?php 
  include("_partials/header.php");
  include("_partials/top_lp.php");
?>
  
  <style>
  body 
  {
    background-image:url(img/bg_strip.jpg);
  }
  </style>
  

<script>
$(document).ready(function(){
  $('#login_form').validate({
    rules:{
      email: { required: true, email: true },
      password: { required: true }
    }
  });
});
</script>

<div style='text-align:center;margin-top:100px;color:white;'>
  <a href='index.php'><img src='img/logo.png' alt='Responsly' title='Responsly' style='width:352px;' /></a>
  <br>

  <p class='lp_text'>Log in with your account and see how your servers are doing.</p>
  <p class='lp_text'>Don't have an account? <a href='<?php echo $helper->getLink("register"); ?>'>Click here</a> to register.</p>

  <?php 

    if ($_GET['registered'])
    {
      ?>
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Well done!</strong> Your account has been created. Login below and start monitoring your servers!
        </div>
      <?
    }
    elseif ($_GET['error'])
    {
      ?>
        <div class="alert alert-error">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Uh oh!</strong> There was an error.
        </div>
      <?
    }

  ?>
  <div style='line-height:35px;'>
    <form id='login_form' class="form-horizontal" action='<?php echo $helper->getLink("auth/login"); ?>' method="POST">
      <input type="text" id="username" name="email" placeholder="E-mail" class="input-large"> <br>
      <input type="password" id="password" name="password" placeholder="Password" class="input-large"> <br>
      <button class="btn btn-success">Login</button>  
    </form>
  </div>
</div>
          
<?
  include("_partials/footer.php");
?>