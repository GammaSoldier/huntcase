<?php

include_once '../config.php';
include_once '../templates.php';
include_once '../database.php';


/***************************************************************************************************
***************************************************************************************************/
function SetListEdit()
{	
	global $Output;

	// read setlist
	if( DBOpen() ) {
		$Result = DBDo( "SELECT * FROM ".TAB_CONTENT." WHERE nameid = 'setlist'" );
		if( $Result ) {
			$Row = DBFetchAssoc( $Result );
			$Content = $Row['content'];
		}// if
		DBClose();
	}// if

	$Content = str_replace("<br>", " \r\n", stripslashes($Content) );  
	$Content = str_replace("<br />", " \r\n", stripslashes($Content) );  

	$Content = array( 'TITLE' 		=> 'Setlist'
					 ,'TEXT' 		=> $Content
					 ,'SAVE'		=> 'sendsetlist'
					 );

					 
	$Output = ParseTemplate( 'setlist.htm', $Content );
	
}// ListThumbs	



/***************************************************************************************************
***************************************************************************************************/
function SetListSave( $Text )
{
	$RetVal = 0;
	
	$Text = addslashes( str_replace("\n", "<br>", str_replace("\r", "", $Text)));
	
	
	// read setlist
	if( DBOpen() ) {
		$Result = DBDo( "UPDATE ".TAB_CONTENT." SET content ='".$Text."' WHERE nameid = 'setlist'" );
		if( !$Result ) {
			$RetVal = -1;
		}// if
		DBClose();
	}// if
	return $RetVal;
}// SetListSave	
?>