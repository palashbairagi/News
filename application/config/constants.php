<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

define('CITY', 1);
define('STATE', 2);
define('COUNTRY', 3);
define('WORLD', 4);
define('BUSINESS', 5);
define('TEXTILE', 6);
define('ENTERTAINMENT', 7);
define('TECHNOLOGY', 8);
define('SPORTS', 9);
define('DHARM', 10);
define('RASHIFAL', 11);
define('VICHAR', 12);
define('VIDEO', 13);
define('EDUCATION', 14);
define('KRISHI', 15);
define('ROJGAR', 16);
define('HEALTH', 17);

define('POPULAR_NEWS', 10);
define('OTHER_NEWS', 4);

define('NO_OF_ROWS', 10);

define('LIKE', 'like');
define('UNLIKE', 'unlike');

define('FACEBOOK_APP_ID', '605769449575989');

/* End of file constants.php */
/* Location: ./application/config/constants.php */