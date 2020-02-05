<?php

include_once 'database.php';
include_once 'templates.php';
 

function displayDates() {
	global $WDays, $Months;
	
	$Now = time();

	$Output = '';

	if( DBOpen() ) {
		// display dates in future
		$result = DBDo( "SELECT * FROM ".TAB_DATES." WHERE timestamp > ".$Now." ORDER BY timestamp ASC" );
		if( !$result ) {
			// No dates found
			$Output = GetTemplate( 'dates_list_empty.htm' );
		}// if
		else {
			if( DBGetNumRows() != 0 ) {
				while( $RowTime = DBFetchArray($result) ) {
					if( $RowTime['timestamp'] >= $Now ) {
						$result2 = DBDo( "SELECT * FROM ".TAB_LOCATIONS." WHERE ID=".$RowTime['location'] );
						$RowLocation = DBFetchArray($result2);
						
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
						$Output .= ParseTemplate( 'dates_list.htm', $Content );
					}// if
				}// while
			}// if
			else {
				// No dates found
				$Output = ParseTemplate( 'dates_list_empty.htm', array('' => '') );
			}// else
		}// else

		// display past dates
		$result = DBDo( "SELECT * FROM ".TAB_SETTINGS." WHERE nameid = 'showpastdates'" );
		if( $result ) {
			$Row = DBFetchArray($result);
			$NumEntriesToDisplay = $Row[ 'value' ];
			
			if( $NumEntriesToDisplay != 0 ) {
				$result = DBDo( "SELECT * FROM ".TAB_DATES." WHERE timestamp <= ".$Now." ORDER BY timestamp DESC" );
				if( !$result ) {
					// No dates found
					$Output2 = GetTemplate( 'dates_list_past_empty.htm' );
				}// if
				else {
					$i = 0;
					if( ($Temp = DBGetNumRows()) != 0 ) {
						if( $NumEntriesToDisplay < 0 ) {
							$NumEntriesToDisplay = $Temp;
						}// if 
						$Output2 = '';
						while( ($RowTime = DBFetchArray($result)) && ($i < $NumEntriesToDisplay )) {
							if( $RowTime['timestamp'] <= $Now ) {
								$i++;
								$result2 = DBDo( "SELECT * FROM ".TAB_LOCATIONS." WHERE ID=".$RowTime['location'] );
								$RowLocation = DBFetchArray($result2);

								$Ausgabe = strtok( ";" );
								$GoogleLink = str_replace( ' ', '+', $RowLocation['address'] );
								
								// display date
								$Content = array(
									 'WEEKDAY' => $WDays[ strftime('%w', $RowTime['timestamp'] ) ]
									,'DAY' => strftime("%d", $RowTime['timestamp'] )
									,'MONTH' => $Months[ strftime("%m", $RowTime['timestamp'] ) - 1 ]
									,'YEAR' => strftime("%Y", $RowTime['timestamp'] )
									,'LOCATION' => $RowLocation['name']
									,'ADDRESS' => $RowLocation['address']
									,'GOOGLELINK' => $GoogleLink
								);
								$Output2 .= ParseTemplate( 'dates_list_past.htm', $Content );
							}// if
						}// while
					}// if
					else {
						// No dates found
						$Output2 = ParseTemplate( 'dates_list_empty.htm', array('' => '') );
					}// else
				}// else
				$Content = array( 'DATELISTPAST' => $Output2 );
				$Output2 = ParseTemplate( 'dates_past.htm', $Content );
			}// if
			else {
				$Output2 = '';
			}// else
		}// if

		DBClose();
	}// if

	else {
		die( 'Database Error' );
	}// else

	$Content = array( 'DATELIST' => $Output
					 ,'DATESPAST' => $Output2);
	$Output = ParseTemplate( 'dates.htm', $Content );

	return $Output;

}// displayDates
?>




