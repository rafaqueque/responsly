<?php 
  include("_partials/header.php");
  include("_partials/top.php");
  include("_partials/navbar.php");
?>
            
            <?php if ($servers): ?>
              <script type="text/javascript" src="https://www.google.com/jsapi"></script>
              <ul class="thumbnails">
                <?php foreach ($servers as $server): ?>
                  <?php 
                    $server_check_status = $db->getRecord("SELECT * FROM servers_check_status WHERE id = ".$server['id_server_check_status'], false); 
                  ?>
                  <li class="span4">
                    <div class="well" style="margin:0;padding:0;">
                      <div class="server-dashboard-thumb">
                        <div class="server-graph">
                          <script type="text/javascript">
                            google.load('visualization', '1', {packages: ['imagelinechart']});
                            function drawVisualization() 
                            {
                              var data = google.visualization.arrayToDataTable([
                                ['', 'Response time'],
                                ['', 0],
                                <?php 
                                  $logs = $db->getRecord("SELECT * FROM servers_check_log WHERE id_server = ".$server['id']." AND DATE_FORMAT(date,'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d') ORDER BY date ASC", true);

                                  $i = 1;
                                  foreach ($logs as $log)
                                  {
                                    echo "['',".($log['response_time']/1000)."]";

                                    if ($i < count($logs))
                                    {
                                      echo ",";
                                    }

                                    $i++;
                                  }
                                ?>
                              ]);
                            
                              new google.visualization.ImageLineChart(document.getElementById('chart-response-time-today-<?php echo $server['id']; ?>')).
                                  draw(data, {showAxisLines:false,showCategoryLabels:false,showValueLabels:false,legend:'none',colors:['FFFFFF'],backgroundColor:'<?php echo $server_check_status["chart_bg_color"]; ?>'});
                            }
                            
                            google.setOnLoadCallback(drawVisualization);
                          </script>
                          <div id='chart-response-time-today-<?php echo $server['id']; ?>' style='width:300px;height:150px;'></div>
                        </div>
                        <div class="server-info" style="padding:10px;">
                          <div class="pull-left">
                            <strong><?php echo $server['name']; ?></strong><br>
                            <small><a href="#"><?php echo $server['host']; ?></a></small>
                          </div>
                          <div class="pull-right" style="text-align:right;">
                            <span class="label <?php echo $server_check_status['css_label']; ?>"><?php echo strtoupper($server_check_status['name']); ?></span><br>
                            <small class="muted">checked <?php echo $helper->time2str($server['last_checked']); ?></small>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                      </div>
                    </div>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php else: ?>
              <p>No servers yet. What are you waiting for? Click the button below and start managing your servers!</p>
            <?php endif; ?>


            <a href="<?php echo $helper->getLink("servers"); ?>" class="btn btn-success"><i class="icon-th-list icon-white"></i> Manage servers</a>
            <br><br>
          
<?
  include("_partials/footer.php");
?>