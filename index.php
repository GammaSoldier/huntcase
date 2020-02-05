<?php

include_once 'config.php';
include_once 'templates.php';
include_once 'database.php';

include_once 'dates.php';
include_once 'music.php';
include_once 'guestbook.php';
include_once 'pictures.php';


execute();


	
function execute() {
	// check URL parameter 'page'
	if( !isset( $_REQUEST['page'] ) ) {
		$Page = 'home';
	}// if
	else {
		$Page = $_REQUEST['page'];
	}// else

		
	// check if template exists	
	if( !file_exists( TEMPLATE_PATH . $Page.'.htm' ) ) {
		$Page = 'home';
	}// if
		
		
	switch ($Page) {
		case 'dates':
			$subPageContent = displayDates();
			break;
		case 'music':
			$subPageContent = displayMusic();
			break;
		case 'guestbook':
			$subPageContent = displayGuestbook();
			break;
		case 'pictures':
			$subPageContent = displayPictures();
			break;
		default:
			$subPageContent = GetTemplate( $Page.'.htm' );
	}// switch
	$Content = array( 'CONTENT' => $subPageContent
					 ,'NEWS'    => newsBox() );


	$Output = ParseTemplate( 'site.htm', $Content );
	echo $Output;

}// execute

	



/***********************************************************************************************
***********************************************************************************************/
function newsBox() {
	global $WDays, $Months;
    $Output = '';
    $Now = time();
	$TimeDiff = 30 * 24 * 3600; // 30 days given in seconds

    // Get next date
    if( DBOpen() ) {
        // display next dates in future
        $result = DBDo( "SELECT * FROM ".TAB_DATES." WHERE timestamp > ".$Now." AND isnewsletter=1  ORDER BY timestamp ASC" );
        if( $result ) {
            if( DBGetNumRows() != 0 ) {
                if( $RowTime = DBFetchArray() ) {
                    if( ( $RowTime['timestamp'] - $Now ) < $TimeDiff ) {
                        $result2 = DBDo( "SELECT * FROM ".TAB_LOCATIONS." WHERE ID=".$RowTime['location'] );
                        $RowLocation = DBFetchArray();
                        
                        $Ausgabe = strtok( ";" );
                        $GoogleLink = str_replace( ' ', '+', $RowLocation['address'] );
                        
                        // display date
                        $Content = array(
                             'WEEKDAY' => $WDays[ strftime('%w', $RowTime['timestamp'] ) ]
                            ,'DAY' => strftime("%d", $RowTime['timestamp'] )
                            ,'MONTH' => $Months[ strftime("%m", $RowTime['timestamp'] ) - 1 ]
                            ,'YEAR' => strftime("%Y", $RowTime['timestamp'] )
                            ,'TIME' => strftime("%H:%M", $RowTime['timestamp'] )
                            ,'LOCATION' => $RowLocation['name']
                            ,'ADDRESS' => $RowLocation['address']
                            ,'GOOGLELINK' => $GoogleLink
                        );
                        $Output .= ParseTemplate( 'news.htm', $Content );
                    }// if
                }// if
                else {
//                    die( 'could not fetch content from result' );
                }// else
            }// if
            else {
//                die( 'no content from db' );
            }// else
        }// if
        else {
//            die( 'no query result' );
        }// else
    }// if
    else {
//        die( 'could not open db' );
    }// else

	return $Output;
}// newsBox


?>
