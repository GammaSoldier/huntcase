<?php
define ('DAYS_IN_ADVANCE', 100 );
define ('TEST_ADDRESS', 'contact@joekoperski.de' );
//define ('TEST_ADDRESS', 'joachim.koperski@leuze.de' );


include_once 'database.php';
include_once 'notify.php';


// execute();
NotifyUsers( true );

/***************************************************************************************************
This code makes no sense for me. 

function execute()
{
	$i = 0;
	
	if( DBOpen() ) {
		$Result = DBDo( "SELECT * FROM ".TAB_USERS." WHERE email='".TEST_ADDRESS."'" );
		while( $Row[$i] = DBFetchArray( $Result )) {
			$i++;
		}// while

		DBClose();

		for( $j = 0; $j < $i; $j++ ) {
			// There is no function "NotifyUser"
			NotifyUser( -1, TEST_ADDRESS, $Row[$j]['hash'], 0, DAYS_IN_ADVANCE );
		}// for $j
	}// if
}// execute
***************************************************************************************************/

?>