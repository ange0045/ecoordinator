<?php
include_once 'src/funcs.php';
include_once 'src/constants.php';
include_once 'src/dataAccessClass.php';
include_once 'src/entityClass.php';
session_start();

// Checks to see if user is logged. If not forces user to go to login page.
if(!isset($_SESSION['ses_Name']) && ($_SERVER['PHP_SELF'] != '/eCoordinator/f_login.php' && $_SERVER['PHP_SELF'] != '/eCoordinator/f_newuser.php')) {
    echo "<script type='text/javascript'>document.location.href='/eCoordinator/f_login.php';</script>";
}
?>
<html>
    <head>
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='src/css/styleFlowChart.css' rel='stylesheet'/>
        <link href='src/css/bootstrap.min.css' rel='stylesheet'/>
        <link href='src/css/font-awesome.min.css' rel='stylesheet' >
        <script src='src/js/jquery.min.js'></script>
        <script src='src/js/flowchart.js'></script>
        <script src='src/js/bootstrap.min.js'></script>
     </head>
    <body>
<?php // ************************** MESSAGE CONFIRMATION ************************** ?>
      <div id="message">
          <div style="padding: 5px;">
              <div class="alert alert-success" id="success-alert">
                  <button type="button" class="close" data-dismiss="alert">x</button>
                  <strong>Success! </strong> Item has been saved.
              </div>
          </div>
      </div><!-- /.message -->

<?php // ************************** DYNAMIC MODAL ************************** ?>
          <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
               <div class="modal-dialog">
                    <div class="modal-content">
                         <div class="modal-header">
                          <i class="fa fa-edit fa-2x"></i>
                              <div class="modal-title">
                                  <button type="button" class="modalClose" data-dismiss="modal" aria-hidden="true">X</button>
                              </div>
                         </div><!-- /.modal-header -->
                         <div class="style"></div>
                         <div class="modal-body">
                             <div id="modal-loader" style="display: none; text-align: center;">
                                  <img src="src/img/loader.gif">
                             </div>
                             <div id="dynamic-content"></div><!-- Form loads here -->
                          </div>
                   </div>
                </div>
          </div><!-- /.dynamic modal -->


<?php // ************************** DYNAMIC MODAL INFO ************************** ?>
            <div id="view-modal-info" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                 <div class="modal-dialog">
                      <div class="modal-content">
                           <div class="modal-header">
                                <div class="modal-title">
                                    <button type="button" class="modalClose" data-dismiss="modal" aria-hidden="true">X</button>
                                </div>
                           </div><!-- /.modal-header -->
                           <div class="modal-body">
                               <div id="modal-loader" style="display: none; text-align: center;">
                                    <img src="src/img/loader.gif">
                               </div>
                               <div id="dynamic-content-info"></div><!-- Form loads here -->
                            </div>
                     </div>
                  </div>
            </div><!-- /.dynamic modal -->
