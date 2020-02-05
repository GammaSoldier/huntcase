<?php 

////////////////////////////////////////////////////////////////////////////////////////////////////
// Database

// general database settings
if( $_SERVER[ 'SERVER_NAME' ] == 'localhost' ) {
	define ( 'DB_HOST', 'localhost' );
	define ( 'DB_USER', 'root' );
	define ( 'DB_PASS', 'admin' );
	define ( 'DB', 'huntcase' );
}// if 
else {
	define ( 'DB_HOST', 'localhost' );
	define ( 'DB_USER', 'dbu10565286' );
	define ( 'DB_PASS', 'eddievanhalen' );
	define ( 'DB', 'db10565286-1' );
}// else         


define ( 'TAB_DATES', 'band_dates' );
define ( 'TAB_LOCATIONS', 'band_locations' );
define ( 'TAB_USERS', 'band_users' );
define ( 'TAB_GUESTBOOK', 'band_guestbook' );
define ( 'TAB_PICTURES', 'band_pictures' );
define ( 'TAB_CONTENT', 'band_content' );
define ( 'TAB_SETTINGS', 'band_settings' );


////////////////////////////////////////////////////////////////////////////////////////////////////
// Band Data
define( 'MAIL_ADDRESS', 'contact@huntcase.de' );
define( 'NEWSLETTER_ADDRESS', 'users@huntcase.de' );
define( 'BAND_NAME', 'Huntcase' );


////////////////////////////////////////////////////////////////////////////////////////////////////
// Admin
define( 'ADMIN_USER', 'joekoperski' );
define( 'ADMIN_PASSWORD', 'takeiteasy' );


////////////////////////////////////////////////////////////////////////////////////////////////////
// Gallery
define( 'PIC_ROOT', './../' );
if( $_SERVER[ 'SERVER_NAME' ] == 'localhost' ) {
	define( 'PIC_FILE_ROOT', './../' );
}// if
else {
	define( 'PIC_FILE_ROOT', $_SERVER["DOCUMENT_ROOT"] );
}// else

define( 'PIC_IMAGE_DIR', 'Grafik/Gallery/' ); 
define( 'PIC_THUMB_DIR', 'Grafik/Thumbs/' ); 

define( 'PIC_THUMBS_PER_PAGE', '5' ); 
define( 'PIC_NAV_PAGES', '10' ); 

define( 'PIC_MAX_WIDHT', 800 );
define( 'PIC_MAX_HEIGHT', 800 );

define( 'PIC_THUMB_WIDTH', 140 ); 
define( 'PIC_THUMB_HEIGHT', 140 ); 

define( 'PIC_THUMB_PREFIX', 'TN' );


////////////////////////////////////////////////////////////////////////////////////////////////////
// Templates
define( 'TEMPLATE_PATH', 'templates/' ); 
define( 'TEMPLATE_PATH_MOBILE', 'templates/mobile/' ); 



?>