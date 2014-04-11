<?php 
  include("_partials/header.php");
  include("_partials/top.php");
  include("_partials/navbar.php");
?>

  <h2>Account <small>&mdash; edit your settings</small></h2><hr>

  <?php 

    if ($_GET['success'])
    {
      ?>
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Well done!</strong> Your account settings have been successfuly updated.
        </div>
      <?
    }
    elseif ($_GET['error'])
    {
      ?>
        <div class="alert alert-error">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Uh oh!</strong> There was an error. 
          <?php echo (($_GET['duplicate']) ? "That e-mail is already in use." : ""); ?>
          <?php echo (($_GET['passwords_not_match']) ? "The password you entered is wrong." : ""); ?>
        </div>
      <?
    }

  ?>

  <script>
  $(document).ready(function(){
    $('#account_form').validate({
      rules:{
        name: { required: true },
        email: { required: true, email: true },
        notification_email: { required: true, email: true }
      }
    });
  });
  </script>
  
  <form id='account_form' class="form-horizontal" action='<?php echo $helper->getLink("auth/update"); ?>' method="POST" autocomplete='off'>
    <fieldset>
      <div class="control-group">
        <!-- Name -->
        <label class="control-label"  for="name">Name</label>
        <div class="controls">
          <input type="text" id="name" name="name" placeholder="" value="<?php echo $user['name']; ?>" class="input-xlarge">
        </div>
      </div>

      <div class="control-group">
        <!-- E-mail -->
        <label class="control-label"  for="email">E-mail</label>
        <div class="controls">
          <input type="text" id="email" name="email" placeholder="" value="<?php echo $user['email']; ?>" class="input-xlarge">
        </div>
      </div>
    </fieldset>

    <fieldset>
      <legend>Change your password</legend>
      <div class="control-group">
        <!-- Password -->
        <label class="control-label" for="old_password">Old password</label>
        <div class="controls">
          <input type="password" id="old_password" name="old_password" placeholder="" class="input-xlarge">
        </div>
      </div>

      <div class="control-group">
        <!-- New password -->
        <label class="control-label" for="new_password">New password</label>
        <div class="controls">
          <input type="password" id="new_password" name="new_password" placeholder="" class="input-xlarge">
        </div>
      </div>
    </fieldset>


    <fieldset>
      <legend>Notifications</legend>
      <div class="control-group">
        <!-- Notification e-mail -->
        <label class="control-label"  for="notification_email">E-mail</label>
        <div class="controls">
          <input type="text" id="notification_email" name="notification_email" placeholder="" value="<?php echo $user['notification_email']; ?>" class="input-xlarge">
        </div>
      </div>

      <div class="control-group">
        <!-- Notification cellphone -->
        <label class="control-label"  for="notification_cellphone_n">Cellphone number</label>
        <div class="controls">
          <input type="text" id="notification_cellphone_n" name="notification_cellphone_n" placeholder="" value="<?php echo $user['notification_cellphone_n']; ?>" class="input-xlarge"><br>
        </div>
      </div>
    </fieldset>


    <fieldset>
      <div class="control-group">
        <!-- Button -->
        <div class="controls">
          <button class="btn btn-success">Update settings</button>
        </div>
      </div>
    </fieldset>
    <input type='hidden' name='id' value='<?php echo $user['id']; ?>'>
  </form>
          
<?
  include("_partials/footer.php");
?>