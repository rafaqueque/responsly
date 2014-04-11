<?php 
  include("_partials/header.php");
  include("_partials/top.php");
  include("_partials/navbar.php");
?>
	
	<h2>FAQ <small>&mdash; frequently asked questions</small></h2><hr>

	<h4>Do you have support 24/7?</h4>
	<p>Unfortunately, we don't have that kind of support yet, but we can promise fast replies in a matter of hours.</p>

	<br>
	<h4>This says my website is down, but it's online!</h4>
	<p>Maybe your site went down during our periodic check, which is likely to happen.</p>

	<br>
	<h4>It's possible to cancel the account?</h4>
	<p>Sure, but to be sure if you really want to do that, contact us. Check our <a href='<?php echo $helper->getLink("support"); ?>'>Support</a> page for more information.</p>
     
<?
  include("_partials/footer.php");
?>