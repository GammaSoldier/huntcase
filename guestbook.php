<?php
include_once 'database.php';
include_once 'templates.php';

	function displayGuestbook() {

	if( isset( $_REQUEST['error'] )) {
		$Error = $_REQUEST['error'];
	}// if
	else {
		$Error = 0;
	}// else

	if( isset( $_REQUEST['name'] )) {
		$name = $_REQUEST['name'];
	}// if
	else {
		$name = '';
	}// else

	if( isset( $_REQUEST['site'] )) {
		$site = $_REQUEST['site'];
	}// if
	else {
		$site = '';
	}// else

	if( isset( $_REQUEST['text'] )) {
		$text = $_REQUEST['text'];
	}// if
	else {
		$text = '';
	}// else

	$GBInputSite = "guestentry.php";



	switch ($Error) {
	case 1:
		$IntroText = GetTemplate( 'guestbook_error1.htm' );
		break;
	case 2:
		$IntroText = GetTemplate( 'guestbook_error2.htm' );
		break;
	default:
		$IntroText = GetTemplate( 'guestbook_intro.htm' );
	}// switch

				
	$Output = '';
	// Display entries
	if( DBOpen() ) {
		$Result = DBDo( "SELECT * FROM ".TAB_GUESTBOOK." ORDER BY timestamp DESC" );

		while( $Row = DBFetchArray()) {
			$Content = array( 
				 'NAME' 	=> $Row[ 'name' ]
				,'DATE' 	=> date( 'd. M Y', $Row[ 'timestamp' ] )
				,'HOMEPAGE'	=> $Row[ 'homepage' ]
	//			,'TEXT'		=>  html_entity_decode( $Row[ 'entry' ] )
				,'TEXT'		=>  $Row[ 'entry' ]
			);
			$Output .= ParseTemplate( 'guestbook_entry.htm', $Content );
		}// while
		DBClose();
	}// if
	else {
		die( 'Could not access DB' );
	}// else

	$Content = array( 
		 'GBSITE' 	=> $GBInputSite
		,'INTRO' 	=> $IntroText
		,'NAME'		=> $name
		,'SITE'		=> $site
		,'TEXT'		=> $text
		,'ENTRIES'	=> $Output
	);
	$Output = ParseTemplate( 'guestbook.htm', $Content );


	return $Output;

	$Content = array( 'CONTENT' => $Output );
	$Output = ParseTemplate( 'site.htm', $Content );

	echo $Output;


}			
?>