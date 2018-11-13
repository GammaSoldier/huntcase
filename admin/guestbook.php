<?php



/***************************************************************************************************
***************************************************************************************************/
function GuestbookShowSite()
{
    $Content = array( 'TITLE'               => 'Guestbook'
                     ,'SITE'                => $_SERVER['PHP_SELF']
					 ,'LISTENTRIES'         => GuestbookListEntries( false )
					 );
					 
	return ParseTemplate( 'guestbook.htm', $Content );


}// GuestbookShowSite



/***************************************************************************************************
***************************************************************************************************/
function GuestbookListEntries()
{
	if( DBOpen() ) {
		$LocalOutput = '';
		$Result = DBDo( "SELECT * FROM ".TAB_GUESTBOOK );

		$ColorCounter = 0;
		while( $Row = DBFetchArray()) {
            $Content = array( 'ODD'         => 'odd'
                             ,'NAME'        => $Row['name']
                             ,'DATE'        => date( 'd.m.y H:i', $Row['timestamp'] )
                             ,'HOMEPAGE'    => $Row['homepage']
                             ,'TEXT'        => html_entity_decode( $Row[ 'entry' ] )
                             ,'IP'          => $Row['ip']
                             ,'ID'          => $Row['id']
					 );

            if( !$ColorCounter ) {
				$Content['ODD'] = 'even';
			}// if
			$ColorCounter = 1 - $ColorCounter;
            $LocalOutput .= ParseTemplate( 'guestbook_entry.htm', $Content );
		}// while
		DBClose();
	}// if
	else {
		$LocalOutput = 'Could not access DB';
	}// else
    
    return $LocalOutput;
}// GuestbookListEntries

function GuestbookDelete( $Selection ) 
{
	$Output = true;

	if( DBOpen() ) {
        $NumEntries = count( $Selection );
		for( $i = 0; $i < $NumEntries; $i++ ) {
            $Result = DBDo( "DELETE FROM ".TAB_GUESTBOOK." WHERE ID='".$Selection[$i]."'" );
        }// for $i
		DBClose();
	}// if
	else {
		$Output .= 'Could not access DB';
	}// else
    
    return $Output;
}

?>