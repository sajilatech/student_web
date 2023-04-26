<?php
# Function to redirect 
function redirect($url='',$argument='')
{
 if($argument) $argument = '?'.$argument; 
 else $argument = ""; //session_name().'='.session_id();
 header("Location: ". $url.$argument);
 //print_r("redirect");
 exit();
}


# Form Validation
function validateForm($fieldRequired,$fieldEmail='',$fieldConfirm='',$fieldConfirmDesc='',$fieldNumeric='')
{

define('VALIDATION_ERROR_MESSSAGE', 'The Following Errors Occured : <br>');
define('NULL_ERROR_MSG', ' should contain a  value');
define('EMAIL_ERROR_MSG', ' is not a valid email address');
define('CONFIRM_ERROR_MSG', ' does not match');
define('NUMERIC_ERROR_MSG', ' should be a numeric value');

	if(empty($fieldConfirm)) $fieldConfirm = array ();
	if(empty($fieldConfirmDesc)) $fieldConfirmDesc = array();		
	if(empty($fieldEmail)) $fieldEmail = array();	
	if(empty($fieldNumeric)) $fieldNumeric = array();	

   $alertMsg =  VALIDATION_ERROR_MESSSAGE;
	 $error = false;
		# NULL VALUE
   	foreach($fieldRequired as $key => $value)
	  {
		  if(trim($value[0]) == "")
		  {
			    $error = true;
					$alertMsg .=  '<div align="left"><span style="border-bottom: 1px dashed green;">'. $value[1] . '</span>' . NULL_ERROR_MSG . " </div> ";
			}
		}
		# EMAIL
		foreach($fieldEmail as $key => $value)
		{
				if(!ereg("^[a-z0-9_]+@[a-z0-9]+\.([a-z.]{2,10})",$value[0]) && trim($value[0]) !="")
				{
					$alertMsg .=  '<div align="left"><span style="border-bottom: 1px dashed green;">'. $value[1] . '</span>' . EMAIL_ERROR_MSG ." </div>";
					$error = true;
				}
	  }
		for($i=0; $i< sizeof($fieldConfirm); $i+=2)
	  {
			if(($fieldConfirm[$i] != $fieldConfirm[$i+1]) && (trim($fieldConfirm[$i+1]) !="") && (trim($fieldConfirm[$i]) !="")) 
			{
						$alertMsg .=  '<div align="left"><span style="border-bottom: 1px dashed green;">'. $fieldConfirmDesc[$i] . '' . ' & '.  ''. $fieldConfirmDesc[$i+1] . '</span>'. CONFIRM_ERROR_MSG ."</div>";
						$error = true;
		  }
		}
		foreach($fieldNumeric as $key => $value)
	  { 
			if(!is_numeric($value[0]) && trim($value[0]) !="")
			{
					$alertMsg .=   '<div align="left"><span style="border-bottom: 1px dashed green;">'.$value[1] . '</span>' . NUMERIC_ERROR_MSG ." </div>";;
					$error = true;
	  	}
	  }
    if ($error)
	      return $alertMsg;
  	else
	   	  return false;
} // END FUNCTION


function sorting($fieldkey,$fieldname)
{
	 global $_REQUEST;
     global $html;
	 unset($_REQUEST[session_name()]);

	 foreach($_REQUEST as $key => $values)
	 { 
		 $sorted = str_replace(" desc","",$_REQUEST['sort']);
			if($sorted == $fieldkey) 
				  { 
					  if(strpos($_REQUEST['sort'],'desc'))
								 { $arrow = 'down.gif'; }
						else
								 { 	$asc=' desc';	$arrow = 'up.gif'; }
					} 
			  if($key != 'sort' && $key != 'doaction') $query_string .= '&'.$key . '=' . $values; 
	  }
	  $query_string = 'sort='. $fieldkey . $asc . $query_string;
	if($arrow) {	$fieldname = str_replace("</div>","&nbsp;&nbsp;&nbsp;<img border='0'  src='".ADMIN_IMAGE_URL.$arrow."'></div>",$fieldname); }
	return $html->hyperlink('',$query_string,$fieldname,'style="text-decoration:none;"');
} // END FUNCTION


function editLink($id,$argument="",$url="")
{
  global $html;
  echo $html->hyperlink($url,'select_id='.$id.'&edit=1'.$argument,IMAGE_EDIT);
}

function deleteLink($id,$argument="",$url="")
{
  global $html;
  echo $html->hyperlink($url,'select_id='.$id.'&doaction=delete'.$argument,IMAGE_DELETE,'onclick="javascript:return confirm(\'Are You Sure to Delete the Record \');"');
}

function copyLink($id,$argument="",$url="")
{
  global $html;
  echo $html->hyperlink($url,'select_id='.$id.'&doaction=copy'.$argument,Copy);
}

function activeToggle($id,$value)
{
  global $html;
  global $_REQUEST;
  $query_string ="";
   foreach($_REQUEST as $key => $values)
   { 
	  if($key != 'doaction' && $key != 'select_id') $query_string .= '&'.$key . '=' . $values; 
   }
   if($value=='1')
   {
		   $query_string = '&doaction=deact'.$query_string;
		   echo $html->hyperlink('','select_id='.$id.$query_string,IMAGE_YES);
   }
   else
   {
           $query_string = '&doaction=act'.$query_string;
		   echo $html->hyperlink('','select_id='.$id.$query_string,IMAGE_NO);
   }
} // End function

function activeDisp($id,$value)
{
  global $html;
  global $_REQUEST;
  $query_string ="";
   foreach($_REQUEST as $key => $values)
   { 
	  if($key != 'doaction' && $key != 'select_id') $query_string .= '&'.$key . '=' . $values; 
   }
   if($value=='1')
   {
		   $query_string = '&doaction=nodisp'.$query_string;
		   echo $html->hyperlink('','select_id='.$id.$query_string,IMAGE_YES);
   }
   else
   {
           $query_string = '&doaction=disp'.$query_string;
		   echo $html->hyperlink('','select_id='.$id.$query_string,IMAGE_NO);
   }
} // End function

function goUp($id,$value)
{
  global $html;
  global $_REQUEST;
   $query_string ="";
   foreach($_REQUEST as $key => $values)
   { 
	  if($key != 'doaction' && $key != 'select_id' && $key != 'sort') $query_string .= '&'.$key . '=' . $values; 
   }
   $query_string = '&doaction=up'.$query_string;
   echo $html->hyperlink('','select_id='.$id.$query_string,IMAGE_UP);
}// END

function goDown($id,$value)
{
  global $html;
  global $_REQUEST;
   $query_string ="";
   foreach($_REQUEST as $key => $values)
   { 
	  if($key != 'doaction' && $key != 'select_id' && $key != 'sort') $query_string .= '&'.$key . '=' . $values; 
   }
   $query_string = '&doaction=down'.$query_string;
   echo $html->hyperlink('','select_id='.$id.$query_string,IMAGE_DOWN);
}// END


// Currency format
function currencyFormat($value,$currency_display="")
{
  global $db;
  if(!$currency_display)
  {
    $currency_disp_val  = $db->fetch_one_row("select currency_value,currency_code from currency_master where set_default='1'");
	$currency_display = $currency_disp_val[1];
  }
   return  $currency_display." ".sprintf("%0.02f",$value);
}

// Currency format
function currencyValForm($value,$currency_display="",$currency_from="")
{
  global $db;
  if($currency_from)
  {
     $currency_from_val   = $db->fetch_one_row("select currency_value from currency_master where id='".$currency_from."'");
    if($currency_display)
	    $currency_disp_val = $db->fetch_one_row("select currency_value,currency_code from currency_master where id='".$currency_display."'");
	else	
	    $currency_disp_val  = $db->fetch_one_row("select currency_value,currency_code from currency_master where set_default='1'");
   
   if($value > 0) 
   			$value = ($value/$currency_disp_val[0])*$currency_from_val[0]; 
	$currency_display = $currency_disp_val[1];
  }
  else
  {
    $currency_disp_val  = $db->fetch_one_row("select currency_value,currency_code from currency_master where set_default='1'");
	$currency_display = $currency_disp_val[1];
  }
   return  array($value,$currency_display." ".sprintf("%0.02f",$value));
}

