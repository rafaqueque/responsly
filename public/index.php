<?php 

  $session = new Sessions();
  $db = new DatabaseUtils();
  $helper = new Helpers();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <base href='http://localhost:8888<?php echo PUBLIC_ROOT; ?>/'>
    <link href='css/bootstrap.css' rel='stylesheet' type='text/css'>
    <link href='css/style.css' rel='stylesheet' type='text/css'>
    <script src='http://code.jquery.com/jquery.js' type='text/javascript'></script>
    <script src='js/bootstrap.js' type='text/javascript'></script>

    <style>
    body
    {
      margin:0;
      padding:0;
    }

    .container-fluid
    {
      padding:0;
    }

    #service-name-container
    {
      margin-top:20px;
      margin-bottom:20px;
    }

    #service-main-image-container
    {
      margin-top:20px;
      margin-bottom:20px;
      overflow:hidden;
      height:400px;
    }

    #service-signup-container
    {
      margin-top:40px;
      margin-bottom:40px;
    }

    #service-features-container
    {
      padding-top:20px;
      padding-bottom:20px;
      background-color:#D8D8D8;
    }

    </style>
  </head>
  
  <body>
    <div id="wrap">
      <div class='container-fluid'>

          <!-- header -->
          <div class='container' id='service-name-container'>
            <h1>responsly <small>server monitoring service</small></h1>
          </div>


          <!-- main image -->
          <div id='service-main-image-container'>
            <img src='img/datacenter.jpg'>
          </div>


          <!-- signup -->
          <div class='container' id='service-signup-container'>
            <div class="row">
              <div class="span12" style="text-align:center;">
                  <p>
                    <a class="btn btn-success btn-even-larger" href="<?php echo $helper->getLink("register"); ?>">
                      Sign-up!
                      <small> <br>No credit card required</small>
                    </a>
                  </p>
                  <p>Already have an account? <a href="<?php echo $helper->getLink("login"); ?>">Click here</a> to log in.</p>
              </div>
            </div>
          </div>

          <div class='container-fluid' id='service-features-container'>
            <div class='container'>
              <div class="row">
                <div class="span5">
                  <h1>It's free!</h1>
                  <p class="lead">Want to try first?</p>
                  <p class="lead">Sign-up with our <strong>free plan and add up to 2 websites</strong> and start using right now. </p>
                  <p class="lead">Want more websites? Upgrade to our paid plan and add up to <strong>10 websites for $2 per month</strong>.</p>
                  <p class="lead">Even more? <a href="#">Get in touch</a> with us.</p>
                </div>
                <div class="span2"></div>
                <div class="span5">
                  <h1>What you get</h1>
                  <ul class="lead">
                    <li>Checks every 5 minutes*</li>
                    <li>Check via multiple locations*</li>
                    <li>Notifications via SMS* and e-mail</li>
                    <li>Beautiful reports and analytics</li>
                    <li>Fast and reliable service and support</li>
                  </ul>
                  <p class="muted">* On our free plan you have a 30 minutes check-cycle and no SMS notifications.</p>
                </div>
              </div>
            </div>
          </div>
          
          <div id="push"></div>
        </div>
    </div>

    <!-- footer -->
    <div id="footer">
      <div class="container">
        <p class="muted credit">Created by <a href="http://rafael.pt">Rafael Albuquerque</a>. Get in touch with <a href="http://twitter.com/rafaqueque">@rafaqueque</a> on Twitter.</p>
      </div>
    </div>
  </body>

  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-41615735-1', 'responsly.com');
    ga('send', 'pageview');

  </script>
</html>