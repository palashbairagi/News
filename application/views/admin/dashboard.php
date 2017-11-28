 <!-- page content -->
  <div class="right_col" role="main">
    <div class="">
      <div class="row top_tiles">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-comments-o"></i></div>
            <div class="count"><?php $comment_count = get_new_comments();echo $comment_count;?></div>
            <h3>New Comment</h3>
            </div>
          </div>
          <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-envelope"></i></div>
              <div class="count"><?php $message_count = get_message_count();echo $message_count;?></div>
              <h3>New Message</h3>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Visitor Summary <small>Weekly progress</small></h2>
                  <div class="filter">

                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="demo-container" style="height:280px">
                      <div id="placeholder33x" class="demo-placeholder">
                        <p>This is static data. Actual contents can be shown on main server.</p>
                      </div>
                    </div>
                    <div class="tiles">
                      <div class="col-md-4 tile">
                        <span>Total Visitors</span>
                        <h2>231,809</h2>
                        <span class="sparkline11 graph" style="height: 160px;">
                          <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                        </span>
                      </div>
                      <div class="col-md-4 tile">
                        <span>Total Unique Visitors</span>
                        <h2>809</h2>
                        <span class="sparkline22 graph" style="height: 160px;">
                        <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>    
<!-- /page content -->
