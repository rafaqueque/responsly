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
  $('#register_form').validate({
    rules:{
      name: { required: true },
      email: { required: true, email: true },
      password: { required: true }
    }
  });
});
</script>

<div style='text-align:center;margin-top:100px;color:white;'>
  <a href='index.php'><img src='img/logo.png' alt='Responsly' title='Responsly' style='width:352px;' /></a>
  <br>

  <p class='lp_text'>Register an account and start monitoring your servers and websites.</p>
  <p class='lp_text'>Already have an account? <a href='<?php echo $helper->getLink("login"); ?>'>Click here</a> to login.</p>

  <?php 

    if ($_GET['error'])
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
    <form id='register_form' class="form-horizontal" action='<?php echo $helper->getLink("auth/register"); ?>' method="POST" autocomplete='off'>
      <input type="text" id="name" name="name" placeholder="Name" class="input-large"> <br>
      <input type="text" id="email" name="email" placeholder="E-mail" class="input-large"> <br>
      <input type="password" id="password" name="password" placeholder="Password" class="input-large"> <br>
      <button class="btn btn-success">Register</button>
    </form>
  </div>
</div>
<?
  include("_partials/footer.php");
?>