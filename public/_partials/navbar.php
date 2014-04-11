
              <!-- navbar -->
              <div class="navbar navbar-inverse navbar-static-top">
                <div class="navbar-inner">
                  <div class='container'>
                    <ul class="nav">
                      <li <?php echo (($helper->getCurrentDir() == "dashboard") ? 'class="active"' : ""); ?>><a href="<?php echo $helper->getLink("dashboard"); ?>"><i class="icon-th-large icon-white"></i> Dashboard</a></li>
                      <li <?php echo (($helper->getCurrentDir() == "servers") ? 'class="active"' : ""); ?>><a href="<?php echo $helper->getLink("servers"); ?>"><i class="icon-th-list icon-white"></i> Servers</a></li>
                      <li <?php echo (($helper->getCurrentDir() == "reports") ? 'class="active"' : ""); ?>><a href="<?php echo $helper->getLink("reports"); ?>"><i class="icon-calendar icon-white"></i> Reports & Analytics</a></li>
                    </ul>

                    <ul class="nav pull-right">

                      <?php 
                        $user = $db->getRecord("SELECT * FROM users WHERE id = '".$session->get("id_user")."'", false);
                      ?>
                      
                      <?php if ($user): ?>
                        <li class="divider-vertical"></li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i> <b><?php echo $user['name']; ?></b> <b class="caret"></b></a>
                          <ul class="dropdown-menu">
                            <li><a href="<?php echo $helper->getLink("account"); ?>">Your account</a></li>
                            <li><a href="<?php echo $helper->getLink("change_plan"); ?>">Change plan</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo $helper->getLink("faq"); ?>">FAQ</a></li>
                            <li><a href="<?php echo $helper->getLink("support"); ?>">Support</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo $helper->getLink("auth/logout"); ?>">Log out</a></li>
                          </ul>
                        </li>
                      <?php endif; ?>

                    </ul>
                  </div>
                </div>
              </div>
              

              <br>
              
              <div class='container'>
