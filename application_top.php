<?php 
error_reporting(0);
ob_start();
session_start();
# Session 
	require('config.php');
extract($_POST);
extract($_GET);
$leftmenu = "";
$err = "";
$denied = "";
# DB Connection
	require(DIR_FUNCTION.'db_class.inc.php');
	$db = new db_mysql(DBHOST,DBUSER,DBPASS,DBNAME);
	$db->connect();
	$db->select_db();

#  HTML Functions
	require(DIR_FUNCTION.'html_class.inc.php');
 	$html = new html;
# PHP General Functions
	require(DIR_FUNCTION.'general.inc.php');
# Admin Side List of Data
	define('DIR_LIST',DIR_ADMIN_TPL.'list/');
# Admin Side Form of Data
	define('DIR_FORM',DIR_ADMIN_TPL.'form/');
# Admin Side Report  of Data
	define('DIR_REPORTS',DIR_ADMIN_INCLUDE.'includes/');
# PHP DB Functions
	require(DIR_INCLUDE.'functions.php');
	
$ones = array(
 "",
 " One",
 " Two",
 " Three",
 " Four",
 " Five",
 " Six",
 " Seven",
 " Eight",
 " Nine",
 " Ten",
 " Eleven",
 " Twelve",
 " Thirteen",
 " Fourteen",
 " Fifteen",
 " Sixteen",
 " Seventeen",
 " Eighteen",
 " Nineteen"
);
 
$tens = array(
 "",
 "",
 " Twenty",
 " Thirty",
 " Forty",
 " Fifty",
 " Sixty",
 " Seventy",
 " Eighty",
 " Ninety"
);
 
$triplets = array(
 "",
 " Thousand",
 " Million",
 " Billion",
 " Trillion",
 " Quadrillion",
 " Quintillion",
 " Sextillion",
 " Septillion",
 " Octillion",
 " Nonillion"
);
 
 // recursive fn, converts three digits per pass
function convertTri($num, $tri) {
  global $ones, $tens, $triplets;
 
  // chunk the number, ...rxyy
  $r = (int) ($num / 1000);
  $x = ($num / 100) % 10;
  $y = $num % 100;
 
  // init the output string
  $str = "";
 
  // do hundreds
  if ($x > 0)
   $str = $ones[$x] . " hundred";
 
  // do ones and tens
  if ($y < 20)
   $str .= $ones[$y];
  else
   $str .= $tens[(int) ($y / 10)] . $ones[$y % 10];
 
  // add triplet modifier only if there
  // is some output to be modified...
  if ($str != "")
   $str .= $triplets[$tri];
 
  // continue recursing?
  if ($r > 0)
   return convertTri($r, $tri+1).$str;
  else
   return $str;
 }
 
// returns the number as an anglicized string
function convertNum($num) {
 $num = (int) $num;    // make sure it's an integer
 
 if ($num < 0)
  return "negative".convertTri(-$num, 0);
 
 if ($num == 0)
  return "zero";
 
 return convertTri($num, 0);
}
 
 // Returns an integer in -10^9 .. 10^9
 // with log distribution
 function makeLogRand() {
  $sign = mt_rand(0,1)*2 - 1;
  $val = randThousand() * 1000000
   + randThousand() * 1000
   + randThousand();
  $scale = mt_rand(-9,0);
 
  return $sign * (int) ($val * pow(10.0, $scale));
 }	
	
# Globals
if(is_array($_POST))
{
 foreach ($_POST as $key => $val)
 {
   ${$key} = $val;
 }}
 
if(is_array($_GET))
{
 foreach ($_GET as $key => $val)
 {
   ${$key} = $val;
 }}

// global arrays
$country_array = array(
"AF" => "Afghanistan",
"AL" => "Albania",
"DZ" => "Algeria",
"AS" => "American Samoa",
"AD" => "Andorra",
"AO" => "Angola",
"AI" => "Anguilla",
"AQ" => "Antarctica",
"AG" => "Antigua and Barbuda",
"AR" => "Argentina",
"AM" => "Armenia",
"AW" => "Aruba",
"AU" => "Australia",
"AT" => "Austria",
"AZ" => "Azerbaijan",
"BS" => "Bahamas",
"BH" => "Bahrain",
"BD" => "Bangladesh",
"BB" => "Barbados",
"BY" => "Belarus",
"BE" => "Belgium",
"BZ" => "Belize",
"BJ" => "Benin",
"BM" => "Bermuda",
"BT" => "Bhutan",
"BO" => "Bolivia",
"BA" => "Bosnia and Herzegovina",
"BW" => "Botswana",
"BV" => "Bouvet Island",
"BR" => "Brazil",
"BQ" => "British Antarctic Territory",
"IO" => "British Indian Ocean Territory",
"VG" => "British Virgin Islands",
"BN" => "Brunei",
"BG" => "Bulgaria",
"BF" => "Burkina Faso",
"BI" => "Burundi",
"KH" => "Cambodia",
"CM" => "Cameroon",
"CA" => "Canada",
"CT" => "Canton and Enderbury Islands",
"CV" => "Cape Verde",
"KY" => "Cayman Islands",
"CF" => "Central African Republic",
"TD" => "Chad",
"CL" => "Chile",
"CN" => "China",
"CX" => "Christmas Island",
"CC" => "Cocos [Keeling] Islands",
"CO" => "Colombia",
"KM" => "Comoros",
"CG" => "Congo - Brazzaville",
"CD" => "Congo - Kinshasa",
"CK" => "Cook Islands",
"CR" => "Costa Rica",
"HR" => "Croatia",
"CU" => "Cuba",
"CY" => "Cyprus",
"CZ" => "Czech Republic",
"CI" => "Côte d’Ivoire",
"DK" => "Denmark",
"DJ" => "Djibouti",
"DM" => "Dominica",
"DO" => "Dominican Republic",
"NQ" => "Dronning Maud Land",
"DD" => "East Germany",
"EC" => "Ecuador",
"EG" => "Egypt",
"SV" => "El Salvador",
"GQ" => "Equatorial Guinea",
"ER" => "Eritrea",
"EE" => "Estonia",
"ET" => "Ethiopia",
"FK" => "Falkland Islands",
"FO" => "Faroe Islands",
"FJ" => "Fiji",
"FI" => "Finland",
"FR" => "France",
"GF" => "French Guiana",
"PF" => "French Polynesia",
"TF" => "French Southern Territories",
"FQ" => "French Southern and Antarctic Territories",
"GA" => "Gabon",
"GM" => "Gambia",
"GE" => "Georgia",
"DE" => "Germany",
"GH" => "Ghana",
"GI" => "Gibraltar",
"GR" => "Greece",
"GL" => "Greenland",
"GD" => "Grenada",
"GP" => "Guadeloupe",
"GU" => "Guam",
"GT" => "Guatemala",
"GG" => "Guernsey",
"GN" => "Guinea",
"GW" => "Guinea-Bissau",
"GY" => "Guyana",
"HT" => "Haiti",
"HM" => "Heard Island and McDonald Islands",
"HN" => "Honduras",
"HK" => "Hong Kong SAR China",
"HU" => "Hungary",
"IS" => "Iceland",
"IN" => "India",
"ID" => "Indonesia",
"IR" => "Iran",
"IQ" => "Iraq",
"IE" => "Ireland",
"IM" => "Isle of Man",
"IL" => "Israel",
"IT" => "Italy",
"JM" => "Jamaica",
"JP" => "Japan",
"JE" => "Jersey",
"JT" => "Johnston Island",
"JO" => "Jordan",
"KZ" => "Kazakhstan",
"KE" => "Kenya",
"KI" => "Kiribati",
"KW" => "Kuwait",
"KG" => "Kyrgyzstan",
"LA" => "Laos",
"LV" => "Latvia",
"LB" => "Lebanon",
"LS" => "Lesotho",
"LR" => "Liberia",
"LY" => "Libya",
"LI" => "Liechtenstein",
"LT" => "Lithuania",
"LU" => "Luxembourg",
"MO" => "Macau SAR China",
"MK" => "Macedonia",
"MG" => "Madagascar",
"MW" => "Malawi",
"MY" => "Malaysia",
"MV" => "Maldives",
"ML" => "Mali",
"MT" => "Malta",
"MH" => "Marshall Islands",
"MQ" => "Martinique",
"MR" => "Mauritania",
"MU" => "Mauritius",
"YT" => "Mayotte",
"FX" => "Metropolitan France",
"MX" => "Mexico",
"FM" => "Micronesia",
"MI" => "Midway Islands",
"MD" => "Moldova",
"MC" => "Monaco",
"MN" => "Mongolia",
"ME" => "Montenegro",
"MS" => "Montserrat",
"MA" => "Morocco",
"MZ" => "Mozambique",
"MM" => "Myanmar [Burma]",
"NA" => "Namibia",
"NR" => "Nauru",
"NP" => "Nepal",
"NL" => "Netherlands",
"AN" => "Netherlands Antilles",
"NT" => "Neutral Zone",
"NC" => "New Caledonia",
"NZ" => "New Zealand",
"NI" => "Nicaragua",
"NE" => "Niger",
"NG" => "Nigeria",
"NU" => "Niue",
"NF" => "Norfolk Island",
"KP" => "North Korea",
"VD" => "North Vietnam",
"MP" => "Northern Mariana Islands",
"NO" => "Norway",
"OM" => "Oman",
"PC" => "Pacific Islands Trust Territory",
"PK" => "Pakistan",
"PW" => "Palau",
"PS" => "Palestinian Territories",
"PA" => "Panama",
"PZ" => "Panama Canal Zone",
"PG" => "Papua New Guinea",
"PY" => "Paraguay",
"YD" => "People's Democratic Republic of Yemen",
"PE" => "Peru",
"PH" => "Philippines",
"PN" => "Pitcairn Islands",
"PL" => "Poland",
"PT" => "Portugal",
"PR" => "Puerto Rico",
"QA" => "Qatar",
"RO" => "Romania",
"RU" => "Russia",
"RW" => "Rwanda",
"RE" => "Réunion",
"BL" => "Saint Barthélemy",
"SH" => "Saint Helena",
"KN" => "Saint Kitts and Nevis",
"LC" => "Saint Lucia",
"MF" => "Saint Martin",
"PM" => "Saint Pierre and Miquelon",
"VC" => "Saint Vincent and the Grenadines",
"WS" => "Samoa",
"SM" => "San Marino",
"SA" => "Saudi Arabia",
"SN" => "Senegal",
"RS" => "Serbia",
"CS" => "Serbia and Montenegro",
"SC" => "Seychelles",
"SL" => "Sierra Leone",
"SG" => "Singapore",
"SK" => "Slovakia",
"SI" => "Slovenia",
"SB" => "Solomon Islands",
"SO" => "Somalia",
"ZA" => "South Africa",
"GS" => "South Georgia and the South Sandwich Islands",
"KR" => "South Korea",
"ES" => "Spain",
"LK" => "Sri Lanka",
"SD" => "Sudan",
"SR" => "Suriname",
"SJ" => "Svalbard and Jan Mayen",
"SZ" => "Swaziland",
"SE" => "Sweden",
"CH" => "Switzerland",
"SY" => "Syria",
"ST" => "São Tomé and Príncipe",
"TW" => "Taiwan",
"TJ" => "Tajikistan",
"TZ" => "Tanzania",
"TH" => "Thailand",
"TL" => "Timor-Leste",
"TG" => "Togo",
"TK" => "Tokelau",
"TO" => "Tonga",
"TT" => "Trinidad and Tobago",
"TN" => "Tunisia",
"TR" => "Turkey",
"TM" => "Turkmenistan",
"TC" => "Turks and Caicos Islands",
"TV" => "Tuvalu",
"UM" => "U.S. Minor Outlying Islands",
"PU" => "U.S. Miscellaneous Pacific Islands",
"VI" => "U.S. Virgin Islands",
"UG" => "Uganda",
"UA" => "Ukraine",
"SU" => "Union of Soviet Socialist Republics",
"AE" => "United Arab Emirates",
"GB" => "United Kingdom",
"US" => "United States",
"ZZ" => "Unknown or Invalid Region",
"UY" => "Uruguay",
"UZ" => "Uzbekistan",
"VU" => "Vanuatu",
"VA" => "Vatican City",
"VE" => "Venezuela",
"VN" => "Vietnam",
"WK" => "Wake Island",
"WF" => "Wallis and Futuna",
"EH" => "Western Sahara",
"YE" => "Yemen",
"ZM" => "Zambia",
"ZW" => "Zimbabwe",
"AX" => "Åland Islands",
);

$status_list = array(
					   '1' => 'Active',
					   '2' => 'Deactive');				   	
$main_status_list = array(
					   '1' => 'Publish',
					   '2' => 'Unpublish');	
					   					   
$sprivileges_list = array(
					   '1' => 'Show',
					   '2' => 'Hide');
					   
$family_financial_status_list = array(
					   '1' => 'Poor',
					   '2' => 'Average',
					    '3' => 'Medium',
						 '4' => 'Good',
						  '5' => 'Very Good',
					   
					   );					   
					   				   
$qualities_list = array(
					   '1' => 'Singing',
					   '2' => 'Oration',
					   '3'=>'Dancing',
					   '4'=>'Sports',
					   '5'=>'Swimming',
					   '6'=>'Acting'); 
					   
$church_going_list = array(
					   '1' => 'Daily',
					   '2' => 'Once a Week',
					   '3'=>'CML/ KCYM'); 
					   
$student_category_list = array(
					   '1' => 'Candidate',
					   '2' => 'Well Wisher',
					   '3' => 'Prayer');	
$reputation_list = array(
					   '1' => 'Good',
					   '2' => 'Poor',
					   '3' => 'Average');
					   
$type_of_education_list = array(
					   '1' => 'School',
					   '2' => 'Seminary',
					   '3' => 'Highter Education');
					   
					   
$relation_with_parish_list = array(
					   '1' => 'Kaikaran',
					   '2' => 'Sunday Teaching',
					   '3' => 'Nuns from family',
					   '4'=>'Preists from family');	
					   
$study_status_list = array(
					   '1' => 'Good',
					   '2' => 'Poor',
					   '3' => 'Average');
					   
$exam_model_list = array(
					   '1' => 'Onam',
					   '2' => 'Cristmas',
					   '3' => 'Model',
					   '4'=> 'Final' );		
$phone_call_type_list = array(
					   '1' => 'Incoming',
					   '2' => 'Outgoing'
					  );	
					  
$phone_call_status_list = array(
					   '1' => 'Attended',
					   '2' => 'Missed',
					   '3'=>'Not Attended'
					  );								   
	$persons_category_list = array(
					   '1' => 'Promoters',
					   '2' => 'Well Wishers',
					   '3'=> 'Prayer Support Team'
					  );	
	$special_day_category_list = array(
					  '1' => 'Feast',
					   '2' => 'Wedding Anniversary',
					   '3'=> 'Birth Day'
					  );
					  
	 $interest_to_be_priest_list = array(
					   '1' => 'Good',
					   '2' => 'Average'
					  );
					  
	$school_syllabus_list = array(
					   '1' => 'State',
					   '2' => 'CBSE(National)',
					   '3'=> 'ICSE',
					   '4'=>'International',
					  );
	$class_list = array(
					   '1' => 'VI',
					   '2' => 'XII',
					   '3'=> 'XIII',
					   '4'=>'IX',
					   '5'=>'X',
					   '6'=>'XI',
					   '7'=>'XII',
					   '8'=>'Degree',
					  );	
	$student_relations_list=array(
				'1'=>'Brother',
				'2'=>'Sister'
	
	);		 		
				   				   				   				   					   							   					   						   				   		   					   					   				   				   					   	
?>
