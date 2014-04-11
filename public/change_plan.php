<?php 
  include("_partials/header.php");
  include("_partials/top.php");
  include("_partials/navbar.php");
?>

  <h2>Plans <small>&mdash; it's easy to upgrade!</small></h2><hr>

  <?php 

    if ($_GET['success'])
    {
      ?>
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Well done!</strong> You have a new plan now.
        </div>
      <?
    }
    elseif ($_GET['error'])
    {
      ?>
        <div class="alert alert-error">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Uh oh!</strong> There was an error. 
          <?php echo (($_GET['alreadychanged']) ? "This is your current plan." : ""); ?>
        </div>
      <?
    }

  ?>


    <?php $plans = $db->getRecord("SELECT * FROM plans", true); ?>
    <ul class="thumbnails">
      <?php foreach ($plans as $plan): ?>
        <li class="span4" style='text-align:center'>
          <form action="<?php echo $helper->getLink("payment/init"); ?>" method="POST">

            <h3><?php echo $plan['designation']; ?></h3>
            <table class="table table-hover table-striped">
              <tr><td style='text-align:center;'><b><?php echo $plan['n_websites']; ?></b> websites or servers</td></tr>
              <tr><td style='text-align:center;'><b><?php echo $plan['check_cycle']; ?> min</b> check-cycle</td></tr>
              <tr><td style='text-align:center;'><?php echo (($plan['has_email_notifications']) ? "<b>Unlimited e-mails</b> per month" : "No e-mail notifications"); ?></td></tr>
              <tr><td style='text-align:center;'><?php echo (($plan['has_sms_notifications']) ? "<b>".$plan['sms_limit']." SMS</b> per month" : "No SMS notifications"); ?></td></tr>
            </table>
            <span style='font-size:35px;'>$<?php echo $plan['price']; ?></span><span class='muted'>/year</span><br>
            <span style='font-size:12px;' class='muted'><?php echo "(~$".round(($plan['price']/12),2)." per month)"; ?></span>

            <br><br>
              
            <?php if ($plan['id'] == $user['id_plan']): ?>
              <span class="muted">This is your current plan <br> until <b><?php echo $user['plan_valid_until']; ?></b>.</span>
            <?php else: ?>
              <input type='submit' class='btn btn-success btn-large' value='I want this one!'>
            <?php endif; ?>
            <input type='hidden' name='price' value='<?php echo $plan['price']; ?>'>
            <input type='hidden' name='id_user' value='<?php echo $user['id']; ?>'>
            <input type='hidden' name='id_plan' value='<?php echo $plan['id']; ?>'>
            <input type='hidden' name='reference' value='<?php echo uniqid($plan['designation'], true); ?>'>
          </form>
        </li>

      <?php endforeach; ?>
    </ul>

  


          
<?
  include("_partials/footer.php");
?>