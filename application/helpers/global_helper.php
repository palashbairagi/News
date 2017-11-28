<?php

function pr(&$a)
{
    echo '<pre>';
    print_r($a);
    echo '</pre>';
}

function vd(&$a)
{
    echo '<pre>';
    var_dump($a);
    echo '</pre>';
}

function is_ajax()
{
    return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest");
}

function checkUrlParam($tableName, $columnName, $param, $is_numeric = FALSE)
{
    $CI =& get_instance();
    /* check for numeric parameter*/
    if($is_numeric == TRUE && !is_numeric($param))
    {
        return FALSE;
    }
    
    $result = $CI->db->get_where($tableName, array($columnName => (string)$param))->row_array();
    if(isset($result['id']))
        return TRUE;
    else
        return FALSE;
}

function is_valid_url($url)
{
    return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}

function get_all_categories()
{
	$CI =& get_instance();
    
    $result = $CI->db->query('
    	SELECT
    		*
		FROM
			meta_categories
		WHERE
			priority != 0
		ORDER BY
			priority
    	')->result_array();
    return $result;
}

function load_img($filename,$params=array(),$tag=true)
{
    if($tag == true)
    {
        $params_str = "";
        foreach($params as $key=>$param)
        {
            $params_str .= $key.'="'.$param.'" ';
        }
        return '<img src="'.base_url()."resources/images/".$filename.'" '.$params_str.'>';
    }
    else
        return base_url()."resources/images/".$filename;
}

////function to load he external js files not pertaining to controllers and action
//file name would be relative to js folder
function load_js($js_file=NULL,$tag=true)
{
	if($js_file!=NULL){
        if(file_exists("./resources/js/".$js_file))
            return '<script type="text/javascript" src="'.base_url()."resources/js/".$js_file.'"></script>';
	}
}

function load_css($css_file=NULL)
{
	if($css_file!=NULL){
        if(file_exists("./resources/css/".$css_file))
            return '<link  type="text/css" rel="stylesheet" href="'.base_url()."resources/css/".$css_file.'" />';
	}
}

function getIndex(&$arrayName,$index)
{
	if(isset($arrayName[$index]))
		return $arrayName[$index];
	else
		return FALSE;
}

function formatDate($dt)
{
	$tstamp = strtotime($dt);
	return date("D jS M, Y ",$tstamp);
}

function formatTime($tstamp)
{
	return date("g:i a",$tstamp);
}

function ago($time)
{    
    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths = array("60","60","24","7","4.35","12","10");

    $now = time();

    $difference     = $now - $time;
    $tense         = "ago";

    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if($difference != 1) {
        $periods[$j].= "s";
    }

    return "$difference $periods[$j]";
}

function formatDateTime($tstamp)
{    
	return date("D jS M, Y (g:i a)",$tstamp);
}

function lq()
{
	// helper to show last query
	$CI =& get_instance();
	echo "<pre class='smalltext'>".htmlentities($CI->db->last_query())."</pre>";
}

function getCountryList($index=null)
{
    
	$countries = array(
		'AF'=>'Afghanistan',
		'AL'=>'Albania',
		'DZ'=>'Algeria',
		'AS'=>'American Samoa',
		'AD'=>'Andorra',
		'AO'=>'Angola',
		'AI'=>'Anguilla',
		'AQ'=>'Antarctica',
		'AG'=>'Antigua and Barbuda',
		'AR'=>'Argentina',
		'AM'=>'Armenia',
		'AW'=>'Aruba',
		'AU'=>'Australia',
		'AT'=>'Austria',
		'AZ'=>'Azerbaijan',
		'BS'=>'Bahamas',
		'BH'=>'Bahrain',
		'BD'=>'Bangladesh',
		'BB'=>'Barbados',
		'BY'=>'Belarus',
		'BE'=>'Belgium',
		'BZ'=>'Belize',
		'BJ'=>'Benin',
		'BM'=>'Bermuda',
		'BT'=>'Bhutan',
		'BO'=>'Bolivia',
		'BA'=>'Bosnia and Herzegovina',
		'BW'=>'Botswana',
		'BV'=>'Bouvet Island',
		'BR'=>'Brazil',
		'IO'=>'British Indian Ocean Territory',
		'BN'=>'Brunei Darussalam',
		'BG'=>'Bulgaria',
		'BF'=>'Burkina Faso',
		'BI'=>'Burundi',
		'KH'=>'Cambodia',
		'CM'=>'Cameroon',
		'CA'=>'Canada',
		'CV'=>'Cape Verde',
		'KY'=>'Cayman Islands',
		'CF'=>'Central African Republic',
		'TD'=>'Chad',
		'CL'=>'Chile',
		'CN'=>'China',
		'CX'=>'Christmas Island',
		'CC'=>'Cocos (Keeling) Islands',
		'CO'=>'Colombia',
		'KM'=>'Comoros',
		'CG'=>'Congo',
		'CD'=>'Congo, the Democratic Republic of the',
		'CK'=>'Cook Islands',
		'CR'=>'Costa Rica',
		'CI'=>'Cote D\'Ivoire',
		'HR'=>'Croatia',
		'CU'=>'Cuba',
		'CY'=>'Cyprus',
		'CZ'=>'Czech Republic',
		'DK'=>'Denmark',
		'DJ'=>'Djibouti',
		'DM'=>'Dominica',
		'DO'=>'Dominican Republic',
		'EC'=>'Ecuador',
		'EG'=>'Egypt',
		'SV'=>'El Salvador',
		'GQ'=>'Equatorial Guinea',
		'ER'=>'Eritrea',
		'EE'=>'Estonia',
		'ET'=>'Ethiopia',
		'FK'=>'Falkland Islands (Malvinas)',
		'FO'=>'Faroe Islands',
		'FJ'=>'Fiji',
		'FI'=>'Finland',
		'FR'=>'France',
		'GF'=>'French Guiana',
		'PF'=>'French Polynesia',
		'TF'=>'French Southern Territories',
		'GA'=>'Gabon',
		'GM'=>'Gambia',
		'GE'=>'Georgia',
		'DE'=>'Germany',
		'GH'=>'Ghana',
		'GI'=>'Gibraltar',
		'GR'=>'Greece',
		'GL'=>'Greenland',
		'GD'=>'Grenada',
		'GP'=>'Guadeloupe',
		'GU'=>'Guam',
		'GT'=>'Guatemala',
		'GN'=>'Guinea',
		'GW'=>'Guinea-Bissau',
		'GY'=>'Guyana',
		'HT'=>'Haiti',
		'HM'=>'Heard Island and Mcdonald Islands',
		'VA'=>'Holy See (Vatican City State)',
		'HN'=>'Honduras',
		'HK'=>'Hong Kong',
		'HU'=>'Hungary',
		'IS'=>'Iceland',
		'IN'=>'India',
		'ID'=>'Indonesia',
		'IR'=>'Iran, Islamic Republic of',
		'IQ'=>'Iraq',
		'IE'=>'Ireland',
		'IL'=>'Israel',
		'IT'=>'Italy',
		'JM'=>'Jamaica',
		'JP'=>'Japan',
		'JO'=>'Jordan',
		'KZ'=>'Kazakhstan',
		'KE'=>'Kenya',
		'KI'=>'Kiribati',
		'KP'=>'Korea, Democratic People\'s Republic of',
		'KR'=>'Korea, Republic of',
		'KW'=>'Kuwait',
		'KG'=>'Kyrgyzstan',
		'LA'=>'Lao People\'s Democratic Republic',
		'LV'=>'Latvia',
		'LB'=>'Lebanon',
		'LS'=>'Lesotho',
		'LR'=>'Liberia',
		'LY'=>'Libyan Arab Jamahiriya',
		'LI'=>'Liechtenstein',
		'LT'=>'Lithuania',
		'LU'=>'Luxembourg',
		'MO'=>'Macao',
		'MK'=>'Macedonia, the Former Yugoslav Republic of',
		'MG'=>'Madagascar',
		'MW'=>'Malawi',
		'MY'=>'Malaysia',
		'MV'=>'Maldives',
		'ML'=>'Mali',
		'MT'=>'Malta',
		'MH'=>'Marshall Islands',
		'MQ'=>'Martinique',
		'MR'=>'Mauritania',
		'MU'=>'Mauritius',
		'YT'=>'Mayotte',
		'MX'=>'Mexico',
		'FM'=>'Micronesia, Federated States of',
		'MD'=>'Moldova, Republic of',
		'MC'=>'Monaco',
		'MN'=>'Mongolia',
		'MS'=>'Montserrat',
		'MA'=>'Morocco',
		'MZ'=>'Mozambique',
		'MM'=>'Myanmar',
		'NA'=>'Namibia',
		'NR'=>'Nauru',
		'NP'=>'Nepal',
		'AN'=>'Netherlands Antilles',
		'NL'=>'Netherlands',
		'NC'=>'New Caledonia',
		'NZ'=>'New Zealand',
		'NI'=>'Nicaragua',
		'NE'=>'Niger',
		'NG'=>'Nigeria',
		'NU'=>'Niue',
		'NF'=>'Norfolk Island',
		'MP'=>'Northern Mariana Islands',
		'NO'=>'Norway',
		'OM'=>'Oman',
		'PK'=>'Pakistan',
		'PW'=>'Palau',
		'PS'=>'Palestinian Territory, Occupied',
		'PA'=>'Panama',
		'PG'=>'Papua New Guinea',
		'PY'=>'Paraguay',
		'PE'=>'Peru',
		'PH'=>'Philippines',
		'PN'=>'Pitcairn',
		'PL'=>'Poland',
		'PT'=>'Portugal',
		'PR'=>'Puerto Rico',
		'QA'=>'Qatar',
		'RE'=>'Reunion',
		'RO'=>'Romania',
		'RU'=>'Russian Federation',
		'RW'=>'Rwanda',
		'SH'=>'Saint Helena',
		'LC'=>'Saint Lucia',
		'PM'=>'Saint Pierre and Miquelon',
		'KN'=>'Saint Kitts and Nevis',
		'VC'=>'Saint Vincent and the Grenadines',
		'WS'=>'Samoa',
		'SM'=>'San Marino',
		'ST'=>'Sao Tome and Principe',
		'SA'=>'Saudi Arabia',
		'SN'=>'Senegal',
		'CS'=>'Serbia and Montenegro',
		'SC'=>'Seychelles',
		'SL'=>'Sierra Leone',
		'SG'=>'Singapore',
		'SK'=>'Slovakia',
		'SI'=>'Slovenia',
		'SB'=>'Solomon Islands',
		'SO'=>'Somalia',
		'ZA'=>'South Africa',
		'GS'=>'South Georgia and the South Sandwich Islands',
		'ES'=>'Spain',
		'LK'=>'Sri Lanka',
		'SD'=>'Sudan',
		'SR'=>'Suriname',
		'SJ'=>'Svalbard and Jan Mayen',
		'SZ'=>'Swaziland',
		'SE'=>'Sweden',
		'CH'=>'Switzerland',
		'SY'=>'Syrian Arab Republic',
		'TW'=>'Taiwan, Province of China',
		'TJ'=>'Tajikistan',
		'TZ'=>'Tanzania, United Republic of',
		'TH'=>'Thailand',
		'TL'=>'Timor-Leste',
		'TG'=>'Togo',
		'TK'=>'Tokelau',
		'TO'=>'Tonga',
		'TT'=>'Trinidad and Tobago',
		'TN'=>'Tunisia',
		'TR'=>'Turkey',
		'TM'=>'Turkmenistan',
		'TC'=>'Turks and Caicos Islands',
		'TV'=>'Tuvalu',
		'UG'=>'Uganda',
		'UA'=>'Ukraine',
		'GB'=>'United Kingdom',
		'US'=>'United States',
		'AE'=>'United Arab Emirates',
		'UM'=>'United States Minor Outlying Islands',
		'UY'=>'Uruguay',
		'UZ'=>'Uzbekistan',
		'VU'=>'Vanuatu',
		'VE'=>'Venezuela',
		'VN'=>'Viet Nam',
		'VG'=>'Virgin Islands, British',
		'VI'=>'Virgin Islands, U.s.',
		'WF'=>'Wallis and Futuna',
		'EH'=>'Western Sahara',
		'YE'=>'Yemen',
		'ZM'=>'Zambia',
		'ZW'=>'Zimbabwe'
	);

	if(is_null($index))
		return $countries;
	else
	{
       
		if(strlen($index)>2)
		{
            $code=ucfirst($index);
			$key = array_search($code,$countries);
			return $key;
		}
		else
		{
			if(isset($countries[$index]))
				return $countries[$code];
			else
				return "";
		}

	}
}

function getMonthoptions()
{
        return array(
        '01'=>'JAN',
        '02'=>'FEB',
        '03'=>'MAR',
        '04'=>'APR',
        '05'=>'MAY',
        '06'=>'JUN',
        '07'=>'JUL',
        '08'=>'AUG',
        '09'=>'SEP',
        '10'=>'OCT',
        '11'=>'NOV',
        '12'=>'DEC',
    );

}

function getYearoptions()
{
    $currentYear  = date("Y")+1;
    
    for($i = $currentYear; $i >= '1901'; $i--)
    {
        $year["$i"] = "$i";
    }

    return $year;
}

function getCurrentDateTime()
{
	return date("Y-m-d G:i:s");
}

function getFileExtension($filename)
{
    return end(explode(".", $filename));
}

function trim_text($string, $limit=10)
{  
    $stringlen = strlen($string);
    
    if($stringlen > $limit)
    {
        $temp_string = substr($string, 0, ($limit - 3));
        $new_string = $temp_string."...";
        echo $new_string;
    }
    else
    {
        echo $string;
    }

}


/*
 * Email function to send mail using mandrill
 * param $details_arr(array) array of information whic includes the following
 * 1. $details_arr['to']            whom to send the email
 * 2. $details_arr['subject']       subjet of the email
 * 3. $details_arr['html']          the body of the email
 * 4. $details_arr['attachment']    attachment if any give the path of the file
 * 5. $details_arr['tag']           use for mandrill
 * TODO : handle various attachement types currently only pdf attachment
 */
function email($details_arr){
    
    /* Mandril code for sending email */
    $mail_data = array(
                        "html" => $details_arr['html'],
                        "subject"=>  $details_arr['subject'],
                        "from_email" => 'noreply@tennisvoorkids.be',                        
                        "to"=> array(array('email' => $details_arr['to'])),
                        "track_opens"=> true,
                        "track_clicks"=> true,
                        "headers" => array('Reply-To' =>'noreply@tennisvoorkids.be'),
                        "tags"=> array($details_arr['tag'])

                    );
    
    // chech for attachment
    if(isset($details_arr['attachment'])){
            $attachment = file_get_contents($filename);
            $attachment_encoded = base64_encode($attachment);
            
            $mail_data['attachments'] = array(
                                            array(
                                                'content' => $attachment_encoded,
                                                'type' => "application/pdf",
                                                'name' => $filepath,
                                            ));
    }
    
    
    $mail_data = array("key" => MANDRIL_KEY, "message"=>$mail_data);
    $data_string = json_encode($mail_data); 
    $response = call_mandrill_api('/messages/send.json',$data_string);
    
    return $response;
}

function call_mandrill_api($url, $data_string)
{
    $ch = curl_init("https://mandrillapp.com/api/1.0".$url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/json', 'Content-Length: ' . strlen($data_string)));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return json_decode($output);
}

function make_thumb($src, $dest, $desired_width, $desired_height) {

	/* read the source image */
    $ext = pathinfo($src, PATHINFO_EXTENSION);
    if($ext == 'jpg' || $ext == 'jpeg')
    {
        $source_image = imagecreatefromjpeg($src);
    }
    elseif($ext == 'png')
    {
        $source_image = imagecreatefrompng($src);
    }
    elseif($ext == 'gif')
    {
        $source_image = imagecreatefromgif($src);
    }
    elseif($ext == 'bmp')
    {
        $source_image = imagecreatefrombmp($src);
    }
    
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	
	/* find the "desired height" of this thumbnail, relative to the desired width  */
	//$desired_height = floor($height * ($desired_width / $width));
	
	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	Imagefill($virtual_image, 0, 0, imagecolorallocate($virtual_image, 255, 255, 255));
	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	
	/* create the physical thumbnail image to its destination */
	imagejpeg($virtual_image, $dest);
}

function resize_image_force($image,$width,$height) {
    $w = @imagesx($image); //current width
    $h = @imagesy($image); //current height
    if ((!$w) || (!$h)) { $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.'; return false; }
    if (($w == $width) && ($h == $height)) { return $image; } //no resizing needed

    $image2 = imagecreatetruecolor ($width, $height);
    imagecopyresampled($image2,$image, 0, 0, 0, 0, $width, $height, $w, $h);

    return $image2;
}

function resize_image_crop($image,$width,$height) {
    $w = @imagesx($image); //current width
    $h = @imagesy($image); //current height
    if ((!$w) || (!$h)) { $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.'; return false; }
    if (($w == $width) && ($h == $height)) { return $image; } //no resizing needed
    
    //try max width first...
    $ratio = $width / $w;
    $new_w = $width;
    $new_h = $h * $ratio;
    
    //if that created an image smaller than what we wanted, try the other way
    if ($new_h < $height) {
        $ratio = $height / $h;
        $new_h = $height;
        $new_w = $w * $ratio;
    }
    
    $image2 = imagecreatetruecolor ($new_w, $new_h);
    imagecopyresampled($image2,$image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);

    //check to see if cropping needs to happen
    if (($new_h != $height) || ($new_w != $width)) {
        $image3 = imagecreatetruecolor ($width, $height);
        if ($new_h > $height) { //crop vertically
            $extra = $new_h - $height;
            $x = 0; //source x
            $y = round($extra / 2); //source y
            imagecopyresampled($image3,$image2, 0, 0, $x, $y, $width, $height, $width, $height);
        } else {
            $extra = $new_w - $width;
            $x = round($extra / 2); //source x
            $y = 0; //source y
            imagecopyresampled($image3,$image2, 0, 0, $x, $y, $width, $height, $width, $height);
        }
        imagedestroy($image2);
        return $image3;
    } else {
        return $image2;
    }
}

function resize_image($method,$image_loc,$new_loc,$width,$height) {
    if (!is_array(@$GLOBALS['errors'])) { $GLOBALS['errors'] = array(); }
    
    if (!in_array($method,array('force','max','crop'))) { $GLOBALS['errors'][] = 'Invalid method selected.'; }
    
    if (!$image_loc) { $GLOBALS['errors'][] = 'No source image location specified.'; }
    else {
        if ((substr(strtolower($image_loc),0,7) == 'http://') || (substr(strtolower($image_loc),0,7) == 'https://')) { /*don't check to see if file exists since it's not local*/ }
        elseif (!file_exists($image_loc)) { $GLOBALS['errors'][] = 'Image source file does not exist.'; }
        $extension = strtolower(substr($image_loc,strrpos($image_loc,'.')));
        if (!in_array($extension,array('.jpg','.jpeg','.png','.gif','.bmp'))) { $GLOBALS['errors'][] = 'Invalid source file extension!'; }
    }
    
    if (!$new_loc) { $GLOBALS['errors'][] = 'No destination image location specified.'; }
    else {
        $new_extension = strtolower(substr($new_loc,strrpos($new_loc,'.')));
        if (!in_array($new_extension,array('.jpg','.jpeg','.png','.gif','.bmp'))) { $GLOBALS['errors'][] = 'Invalid destination file extension!'; }
    }

    $width = abs(intval($width));
    if (!$width) { $GLOBALS['errors'][] = 'No width specified!'; }
    
    $height = abs(intval($height));
    if (!$height) { $GLOBALS['errors'][] = 'No height specified!'; }
    
    if (count($GLOBALS['errors']) > 0) { echo_errors(); return false; }
    
    if (in_array($extension,array('.jpg','.jpeg'))) { $image = @imagecreatefromjpeg($image_loc); }
    elseif ($extension == '.png') { $image = @imagecreatefrompng($image_loc); }
    elseif ($extension == '.gif') { $image = @imagecreatefromgif($image_loc); }
    elseif ($extension == '.bmp') { $image = @imagecreatefromwbmp($image_loc); }
    
    if (!$image) { $GLOBALS['errors'][] = 'Image could not be generated!'; }
    else {
        $current_width = imagesx($image);
        $current_height = imagesy($image);
        if ((!$current_width) || (!$current_height)) { $GLOBALS['errors'][] = 'Generated image has invalid dimensions!'; }
    }
    if (count($GLOBALS['errors']) > 0) { @imagedestroy($image); echo_errors(); return false; }

    if ($method == 'force') { $new_image = resize_image_force($image,$width,$height); }
    elseif ($method == 'max') { $new_image = resize_image_max($image,$width,$height); }
    elseif ($method == 'crop') { $new_image = resize_image_crop($image,$width,$height); }
    
    if ((!$new_image) && (count($GLOBALS['errors'] == 0))) { $GLOBALS['errors'][] = 'New image could not be generated!'; }
    if (count($GLOBALS['errors']) > 0) { @imagedestroy($image); echo_errors(); return false; }
    
    $save_error = false;
    if (in_array($extension,array('.jpg','.jpeg'))) { imagejpeg($new_image,$new_loc) or ($save_error = true); }
    elseif ($extension == '.png') { imagepng($new_image,$new_loc) or ($save_error = true); }
    elseif ($extension == '.gif') { imagegif($new_image,$new_loc) or ($save_error = true); }
    elseif ($extension == '.bmp') { imagewbmp($new_image,$new_loc) or ($save_error = true); }
    if ($save_error) { $GLOBALS['errors'][] = 'New image could not be saved!'; }
    if (count($GLOBALS['errors']) > 0) { @imagedestroy($image); @imagedestroy($new_image); echo_errors(); return false; }

    imagedestroy($image);
    imagedestroy($new_image);
    
    return true;
}

function resize($newWidth, $targetFile, $originalFile) {

    $info = getimagesize($originalFile);
    $mime = $info['mime'];

    switch ($mime) {
            case 'image/jpeg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    $new_image_ext = 'jpg';
                    break;

            case 'image/png':
                    $image_create_func = 'imagecreatefrompng';
                    $image_save_func = 'imagepng';
                    $new_image_ext = 'png';
                    break;

            case 'image/gif':
                    $image_create_func = 'imagecreatefromgif';
                    $image_save_func = 'imagegif';
                    $new_image_ext = 'gif';
                    break;

            default: 
                    throw new Exception('Unknown image type.');
    }

    $img = $image_create_func($originalFile);
    list($width, $height) = getimagesize($originalFile);

    $newHeight = ($height / $width) * $newWidth;
    $tmp = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    if (file_exists($targetFile)) {
            unlink($targetFile);
    }
    $image_save_func($tmp, "$targetFile.$new_image_ext");
}

function get_all_headlines()
{
	$CI =& get_instance();
    
    $result = $CI->db->get('headlines')->result_array();
    return $result;
}

function get_new_comments()
{
    $CI =& get_instance();
    $comments = $CI->db->query('SELECT count(*) as count FROM news_has_comments WHERE is_pending = 1')->row_array();
    return $comments['count'];
}

function get_message_count()
{
    $CI =& get_instance();
    $message = $CI->db->query('SELECT count(*) as count FROM contact_message WHERE is_read = 0')->row_array();
    return $message['count'];
}

function get_contact()
{
	$CI =& get_instance();
    
    $result = $CI->db->get('contact')->row_array();
    return $result;
}

function get_admin_detail()
{
	$CI =& get_instance();
    
    $result = $CI->db->get('admin')->row_array();
    return $result;
}

function mb_trim($str) {
  return preg_replace("/(^\s+)|(\s+$)/us", "", $str); 
}
