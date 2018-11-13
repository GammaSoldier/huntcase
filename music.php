<?php

include_once 'templates.php';
include_once 'database.php';

// read setlist
if( DBOpen() ) {
	$Result = DBDo( "SELECT * FROM ".TAB_CONTENT." WHERE nameid = 'setlist'" );
	if( $Result ) {
		$Row = DBFetchAssoc();
		$Content = $Row['content'];
	}// if
	DBClose();
}// if


$Setlist = array( 'SETLIST' 	=> stripslashes( $Content ) );
$Output = ParseTemplate( 'music.htm', $Setlist );

$Content = array( 'CONTENT' => $Output );
$Output = ParseTemplate( 'site.htm', $Content );

echo $Output;
?>

