<?php
/* starttrip.php
 * User session to record settings for trip that's beginning
 * session variable 'userid' accessed
*/
session_start();
$userid = $_SESSION['userid'];

include_once('inc/db.php');
include_once('inc/format.php');

/* laters
//if session variable not set, prompt for password
if (! isset( $_SESSION['userid'] ) ) {
  start_page();
  login_prompt();
  end_page();
  exit;
}
*/

//we're sessioning, so pull database info and populate form, then process form on POST

if ( $_SERVER['REQUEST_METHOD'] != 'POST' ) {
//no form data submitted yet

  start_page();
  settings_form();
  end_page();


} else {
//form data has been submitted
	$budget_amt = filter_input( INPUT_POST, 'budget_amt', FILTER_SANITIZE_NUMBER_FLOAT ); 
	$budget_per = filter_input( INPUT_POST, 'budget_per', FILTER_SANITIZE_NUMBER_INT );
	$trip_max   = filter_input( INPUT_POST, 'trip_max', FILTER_SANITIZE_NUMBER_FLOAT );
	$arrive_by  = filter_input( INPUT_POST, 'arrive_by', FILTER_SANITIZE_STRING );
 	$userid     = $_SESSION['userid'];	

	$arrival_est_gp   = 0; //these variables will pass from Google API and ML 
	$arrival_est_toll = 0;
	$arrive_by        = 0;
	$curr_toll        = 0;
	$end_pt           = 0;
	$start_pt         = 0;


	//insert into database
	$query = 'insert into trip_data (arrival_est_gp, arrival_est_toll, arrive_by, curr_toll, end_pt, start_pt, user_id) values ("' . $arrival_est_gp . '", "' . $arrival_est_toll . '", "' . $arrive_by . '", "' . $curr_toll . '", "' . $end_pt . '", "' . $start_pt . '", "' . $user_id . '")';
	$mysqli = new mysqli( $server, $dbuser, $dbpass, $dbname );
	if ( $mysqli->connect_error ) {
	  die( 'DB connection error, of course. ' . $mysqli->connect_error);
	}

	$mysqli->query( $query ) or die( 'DB insert failed.' );
	$mysqli->close();

	//output something cool

}

function settings_form() {
?>
    <div class="well well-lg"><h2>New Trip Settings</h2></div>
    <form class="form-horizontal" method="post">
      <div class="form-group">
        <label class="control-label col-md-4" for="budget_amt">How much have you budgeted for tolls?</label>
        <div class="col-md-8">
          <input type=text id="budget_amt">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-4" for="budget_per">How long is your budget meant to last?</label>
        <div class="col-md-8">
          <select id="budget_per" max=1>
                <option value=1>Per trip</option>
                <option value=2>Per day</option>
                <option value=3>Per week</option>
                <option value=4>Per 2 weeks</option>
                <option value=5>Per month</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-4" for="trip_max">How much are you willing to spend per trip? (MAX)</label>
        <div class="col-md-8">
           <input type="text" id="trip_max">
        </div>
      </div>
      <div class="form-group">
	<label class="control-label col-md-4" for="arrive_by">When do you need to arrive?</label>
	<div class="col-md-8">
	  <input type="text" id="arrive_by">
	</div>
      </div>
      <div class="col-md-12">
          <button type="submit" class="btn btn-default">Submit</button>
      </div>
 
     </form>
   <iframe id="map"
  width="450"
  height="250"
  frameborder="0" style="border:0"
  src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyAnBtTVs8Fd85M3TdPg6ovTSywM8Ye3zlM&origin=1701+Baltic+Ave+Virginia+Beach,VA&destination=Norfolk,VA">
</iframe>
   <script>
     function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: {lat: 36.843975, lng: -75.979564}
        });

        var trafficLayer = new google.maps.TrafficLayer();
        trafficLayer.setMap(map);
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqnAXE3LB3b4fOpwLarqksU9zy8546ZuA&callback=initMap">
    </script>	
<?php
}
?>
