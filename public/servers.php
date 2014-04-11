<?php 
  include("_partials/header.php");
  include("_partials/top.php");
  include("_partials/navbar.php");
?>
  <?php 

    if ($_GET['success'])
    {
      ?>
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Well done!</strong> A new server has been added.
        </div>
      <?
    }
    elseif ($_GET['error'])
    {
      ?>
        <div class="alert alert-error">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Uh oh!</strong> There was an error. 
          <?php echo (($_GET['too_many']) ? "You've reached your limit. If you want more, upgrade to a <a href='".$helper->getLink("change_plan")."'>higher plan</a>." : ""); ?>
        </div>
      <?
    }

  ?>

            <?php if ($servers): ?>
              <table class="table table-hover table-striped">
                <tr>
                  <th>Name</th>
                  <th>Host</th>
                  <th>Last checked</th>
                  <th>Status</th>
                  <th></th>
                </tr>

                <?php foreach ($servers as $server): ?>
                  <?php 
                    $server_check_status = $db->getRecord("SELECT * FROM servers_check_status WHERE id = ".$server['id_server_check_status'], false); 
                  ?>
                  <tr class="<?php echo (($server['id_server_check_status'] == 3) ? $server_check_status['css_row'] : ""); ?>">
                    <td width="35%"><?php echo $server['name']; ?></td>
                    <td><a href='#'><?php echo $server['host']; ?></a></td>
                    <td><small><?php echo $server['last_checked']; ?></small></td>
                    <td><span class="label <?php echo $server_check_status['css_label']; ?>"><?php echo strtoupper($server_check_status['name']); ?></span></td>
                    <td width="10%">
                      <div class="btn-group pull-right">
                        <a class="btn btn-small" href="<?php echo $helper->getLink("servers/view/".$server['id']); ?>"><i class="icon-file"></i> Stats</a>
                        <a class="btn btn-small" href="<?php echo $helper->getLink("servers/edit/".$server['id']); ?>"><i class="icon-pencil"></i></a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>

              </table>
            <?php else: ?>
              <p>No servers yet. What are you waiting for? Click the button below and start managing your servers!</p>
            <?php endif; ?>


              <!-- Button to trigger modal -->
              <a href="#myModal" role="button" class="btn btn-success" data-toggle="modal"><i class="icon-plus icon-white"></i> Add new server</a>
               

              <script>
              $(document).ready(function(){
                $('#newserver_form').validate({
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
                  <h3 id="myModalLabel">Add new server</h3>
                </div>
                <form id='newserver_form' class="form-horizontal" style="margin:0;" method="post" action="<?php echo $helper->getLink("servers/new"); ?>">
                  <div class="modal-body">
                    <div class="control-group">
                      <label class="control-label" for="inputName">Name</label>
                      <div class="controls">
                        <input type="text" id="inputName" name="name" placeholder="Name">
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="inputHost">Host</label>
                      <div class="controls">
                        <input type="text" id="inputHost" name="host" placeholder="Host">
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
                          <option value='<?php echo $server_check_type['id']; ?>'><?php echo $server_check_type['name']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>                
                  </div>
                  <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                  </div>
                  <input type='hidden' name='id_user' value='<?php echo $session->get("id_user"); ?>'>
                </form>
              </div>
          
<?
  include("_partials/footer.php");
?>