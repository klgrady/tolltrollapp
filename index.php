<?php
/* index.html
 * This file prompts the user for a password, sets a session, and displays options for a trip
 */

$sess_length = 20 * 60 * 60;
session_set_cookie_params( $sess_length, '/' );
session_start();

include_once('inc/db.php');
include_once('inc/format.php');


//If this is the first time through
if( $_SERVER['REQUEST_METHOD'] != "POST" )  {
    start_page();
    login_prompt();
    end_page();

//If the session is active and login has happened
} elseif ( isset( $_SESSION['userid'] ) ) {
    start_page();
    page_content();

    end_page();

//If we're checking credentials
} else {
 
    //get userid
    $user = filter_input( INPUT_POST, 'username' );
    $passwd = filter_input( INPUT_POST, 'passwd' );


    $hashedpass = password_hash( $passwd, PASSWORD_DEFAULT );

    $query = 'select id from user where username="' . $user . '" and passwd="' . $hashedpass . '"';
    $mysqli = new mysqli( $server, $dbuser, $dbpass, $dbname );
    if ( $mysqli->connect_error ) {
	die('Well, that didn\'t work as planned. ' . $mysqli->connect_error);
    }

    if ($result = $mysqli->query( $mysqli->prepare( $query ) ) ) {
	$match = $result->num_rows;
	if ( $result->fetch_row() != 1 ) {
	   echo 'Invalid login.';
	   end_page();
	   exit;
	} else {
	  $userid = $row[0];
	}
	$result->close();
    }
   $mysqli->close();
    
    
    //set session variable - userid
    $_SESSION['userid'] = $userid;


    //display options for the trip
    start_page();
    page_content();
    
}
end_page();
?>
