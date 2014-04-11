<?php 
  include("_partials/header.php");
  include("_partials/top.php");
  include("_partials/navbar.php");
?>

            <script type="text/javascript" src="https://www.google.com/jsapi"></script>

             <h2><?php echo $server['name']; ?> <small>&mdash; how is your server performing?</small></h2><hr>
              <table class="table">
                <tr class="<?php echo $server_check_status['css_row']; ?>"><td width="20%"><strong>Status</strong></td> <td><span class="label <?php echo $server_check_status['css_label']; ?>"><?php echo strtoupper($server_check_status['name']); ?></span></td></tr>
                <tr><td width="20%"><strong>Host</strong></td> <td><a href="#"><?php echo $server['host']; ?></a> <small class="muted">(resolved to <?php echo gethostbyname($server['host']); ?>)</small></td></tr>
                <tr><td width="20%"><strong>Check method</strong></td> <td><?php echo $server_check_type['name']; ?></td></tr>
                <tr><td width="20%"><strong>Last checked</strong></td> <td><?php echo $server['last_checked']; ?></td></tr>
                <tr><td width="20%"><strong>Added on</strong></td> <td><?php echo $server['date_added']; ?></td></tr>
              </table>
              <div class="btn-group">
                <a class="btn btn-small" href="<?php echo $helper->getLink("servers_check/check/".$server['id']); ?>"><i class="icon-refresh"></i> Check now</a>
                <a class="btn btn-small" href="#myModal" data-toggle="modal" href="<?php echo $helper->getLink("servers/edit/".$server['id']); ?>"><i class="icon-pencil"></i> Edit information</a>
              </div> 

              <!-- remove form -->
              <form style='display:inline-block;' method='post' action='<?php echo $helper->getLink("servers/remove/".$server['id']); ?>'>
                <button type="submit" class="btn btn-small btn-danger"><i class="icon-remove icon-white"></i> Remove</button>
              </form>  

              <br><br>        


              <h4>Server response-time &mdash; today</h4>
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
                
                  new google.visualization.ImageLineChart(document.getElementById('chart-response-time-today')).
                      draw(data, null);
                }
                
                google.setOnLoadCallback(drawVisualization);
              </script>
              <div id='chart-response-time-today' style='width:960px;height:250px;'></div>
              <br><br>

              <h4>Server response-time &mdash; past 30 days</h4>
              <script type="text/javascript">
                google.load('visualization', '1', {packages: ['imagelinechart']});
                function drawVisualization() 
                {
                  var data = google.visualization.arrayToDataTable([
                    ['', 'Response time'],
                    ['', 0],
                    <?php 
                      $logs = $db->getRecord("SELECT * FROM servers_check_log WHERE id_server = ".$server['id']." AND date >= DATE_SUB(NOW(),INTERVAL 30 DAY) ORDER BY date ASC", true);

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
                
                  new google.visualization.ImageLineChart(document.getElementById('chart-response-time-30days')).
                      draw(data, null);
                }
                
                google.setOnLoadCallback(drawVisualization);
              </script>
              <div id='chart-response-time-30days' style='width:960px;height:250px;'></div>
              <br><br>




              <script>
              $(document).ready(function(){
                $('#updateserver_form').validate({
                  rules:{
                    name: { required: true },
                    host: { required: true }
                  }
                });
              });
              </script>
              <!-- Modal -->
              <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h3 id="myModalLabel">Edit server</h3>
                </div>
                <form id='updateserver_form' class="form-horizontal" style="margin:0;" method="post" action="<?php echo $helper->getLink("servers/update"); ?>">
                  <div class="modal-body">
                    <div class="control-group">
                      <label class="control-label" for="inputName">Name</label>
                      <div class="controls">
                        <input type="text" id="inputName" name="name" placeholder="Name" value="<?php echo $server['name']; ?>">
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="inputHost">Host</label>
                      <div class="controls">
                        <input type="text" id="inputHost" name="host" placeholder="Host" value="<?php echo $server['host']; ?>">
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="checkMethod">Check method</label>
                      <div class="controls">
                        <select id="checkMethod" name="id_server_check_type">
                          <?php 
                            $servers_check_type = $db->getRecord("SELECT * FROM servers_check_type", true);
                            foreach ($servers_check_type as $server_check_type):
                          ?>
                          <option value='<?php echo $server_check_type['id']; ?>' <?php echo (($server_check_type['id'] == $server['id_server_check_type']) ? "selected" : ""); ?>><?php echo $server_check_type['name']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>                
                  </div>
                  <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                  </div>
                  <input type='hidden' name='id' value='<?php echo $server['id']; ?>'>
                </form>
              </div>
          
<?
  include("_partials/footer.php");
?>