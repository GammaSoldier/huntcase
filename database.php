<?php
/**
 * Database.php
 * Created on 20.10.2007
 *
 * @author  Joe Koperski 
 * 
 */


include_once( 'config.php' );
 
$WDays = array("So", "Mo", "Di", "Mi", "Do", "Fr", "Sa" );
$Months = array( "Jan", "Feb", "M&auml;r", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dez" );

$mysqli = null;
$mysqli_result = false;

/*******************************************************************************
*******************************************************************************/
function DBOpen() 
{
    global $mysqli;
	$RetVal = false;
	
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB);
	if(!$mysqli) {
		echo 'No connection to DB: ' . mysqli_connect_errno() .'<br>';
	}// if
	else {
		$RetVal = true;
	}// else
    
    return $RetVal;
}// DBOpen


/*******************************************************************************
*******************************************************************************/
function DBClose() 
{
    global $mysqli;

    if( $mysqli ) {
        $mysqli->close();
        $mysqli = null;
    }// if
    
    return;
}// DBClose

 
/*******************************************************************************
*******************************************************************************/
function DBDo( $Query ) {
    global $mysqli, $mysqli_result;
	$mysqli_result = $mysqli->query($Query);
	// debug
	if( !$mysqli_result ) {
		echo 'DB Error: '.$mysqli->error.'<br>';
	}// if

	return $mysqli_result;
}// DBDo


/*******************************************************************************
*******************************************************************************/
function DBGetNumRows() {
    global $mysqli;
	$Result = $mysqli->affected_rows;
	// debug
//	if( !$Result ) {
//		echo 'DB Error: '.$mysqli->error.'<br>';
//	}// if

	return $Result;
}// DBGetNumRows
  
 
/*******************************************************************************
*******************************************************************************/
function DBFetchArray( $result = null ) {
    global $mysqli, $mysqli_result;
	if($result != null) {
		$Result = $result->fetch_array();
	}// if
	else{
		if($mysqli_result) {
			$Result = $mysqli_result->fetch_array();
		}// if
	}// else
	
	return $Result;
}// DBGetNumRows
 
 
/*******************************************************************************
*******************************************************************************/
function DBFetchAssoc( $result = null ) {
    global $mysqli, $mysqli_result;
	if($result != null) {
		$Result = $result->fetch_assoc();
	}// if
	else{
		if($mysqli_result) {
			$Result = $mysqli_result->fetch_assoc();
		}// if
	}// else
	
	return $Result;
}// DBGetNumRows
 
 
/*******************************************************************************
*******************************************************************************/
function DBEscapeString($String) {
    global $mysqli;
	if($mysqli) {
		$mysqli->real_escape_string($String);
	}// if
	
	return $String;
}// DBGetNumRows
 
 
?>
