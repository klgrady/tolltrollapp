<?php
/*userprefs.php
* Record user preferences
*/

session_start();
$userid = $_SESSION['userid'];

include_once('inc/db.php');
include_once('inc/format.php');

if ( $_SERVER['REQUEST_METHOD'] != 'POST' ) {

//no form data submitted yet
  start_page();
  trip_form();
  end_page();


} else {
//capture form data and update the database
  
  $budget_amt = filter_input( INPUT_POST, 'budget_amt', FILTER_SANITIZE_NUMBER_FLOAT); 
  $budget_per = filter_input( INPUT_POST, 'budget_per', FILTER_SANITIZE_NUMBER_FLOAT);
  
  $query = '';

  $mysqli = new mysqli($server, $dbuser, $dbpass, $dbname);
  if ( $mysqli->connect_error ) {
    die( 'Connect error! ' . $mysqli->error ) {
  }

  $mysqli->query( $query );


}

function trip_form() {
?>
  <div class="well well-lg"><h2>User Settings</h2></div>
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
      <label class="control-label col-md-4" for="">
<?php
}
