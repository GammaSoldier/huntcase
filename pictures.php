<?php
include_once 'templates.php';
include_once 'database.php';
include_once 'config.php';



function displayPictures() {
	
	$ThisFile = "index.php?page=pictures";

	if( isset( $_GET['Actual'] )) {
		$Actual = $_GET['Actual'];
	}// if
	else {
		$Actual = 0; 
	}// else


	$i = 0;
	//$FileList = 0;

	if( DBOpen() ) {
		$Result = DBDo( "SELECT * FROM ".TAB_PICTURES." ORDER BY position ASC" );
		if( $Result ) {
			while( $Row = DBFetchAssoc() ) {
				$FileList[$i] = $Row[ 'name' ];
				$i++;
			}// while
		}// if
		DBClose();
	}// if

	// illegal values
	if( $Actual < 0 ) {
		$Actual = 0;
	}// if
	if( isset($FileList ) && $Actual >= count($FileList) ) {
		$Actual = count($FileList)-1;
	}// if


	// Navigation 	
	if( $Actual > 0) {
		$Content = array( 'LINK' => $ThisFile.'&Actual='.($Actual-1) );
		$OutputBack = ParseTemplate( 'pictures_back.htm', $Content );
	}// if 
	else {
		$OutputBack = '';
	}// else

	if( $Actual < count($FileList)-1 ){
		$Content = array( 'LINK' => $ThisFile.'&Actual='.($Actual+1) );
		$OutputForward = ParseTemplate(  'pictures_forward.htm', $Content );
	}// if 
	else {
		$OutputForward = '';
	}// else


	// Content
	$Content = array( 
		 'BACK' => $OutputBack
		,'FORWARD' => $OutputForward 
		,'IMAGE' => PIC_IMAGE_DIR.$FileList[$Actual] 
		,'ALT' => $FileList[$Actual]
	);

	$Output = ParseTemplate( 'pictures.htm', $Content );

	return $Output;

}

?>
