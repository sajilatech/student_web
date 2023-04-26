<?php

class html
{

# ComboBox
 function combo($name, $values, $default = '', $parameters = '') 
 {
    if (empty($default) && isset($GLOBALS[$name])) 
					$default = stripslashes($GLOBALS[$name]);

    $field = '<select name="' . $name . '"';
    if ($parameters) $field .= ' ' . $parameters;
    $field .= '>';
    foreach($values as  $i => $value)
	 {
      $field .= '<option value="' . $i . '"';
      if(is_array($default)) 
	    { if (in_array($i,$default))  $field .= ' SELECTED'; }
	  else
		{  if ($default == $i)    $field .= ' SELECTED'; }
      $field .= '>' . $value . '</option>';
    }
    $field .= '</select>';
    return $field;
  }

# Radio 
  function radio($name, $values, $separator, $default='',$parameters ='')
  {
	  $fields = "";
	  $field = array();
      foreach($values as $k => $v)
		 {
	         $field[$k] .= '<input type="Radio" name="'.$name.'" value="'.$k.'"';
			 if($default == $k) $field[$k] .= " checked ";
			 $field[$k] .= $parameters .' > ' . $v;
		 }
	   $fields = @implode($separator,$field);
	   return $fields;
  }

# CheckBox
  function checkbox($name, $values, $separator, $default=array(),$parameters ='')
  {
	  $field = array();
      foreach($values as $k => $v)
		 {
	         $field[$k] .= '<input type="Checkbox" name="'.$name.'" value="'.$k.'"';
			 if(in_array($k,$default)) $field[$k] .= " checked ";
			 $field[$k] .= $parameters .' > ' . $v;
		 }
	   $fields = @implode($separator,$field);
	   return $fields;
  }


# Hyperlink
function hyperlink($url,$argument='',$text,$properties='')
{
// if($argument) $argument = session_name().'='.session_id().'&'.$argument; 
// else $argument = session_name().'='.session_id();
 if(strpos($url,'?'))
			 $strurl = '<a '.$properties.' href="'.$url.'&'.$argument.'">'.$text.'</a>';
 else
 	     	 $strurl = '<a '.$properties.' href="'.$url.'?'.$argument.'">'.$text.'</a>';
 if(!$argument) 
 				$strurl = '<a '.$properties.' href="'.$url.'">'.$text.'</a>';
 return $strurl;
}

# Email
function email($email,$text="",$properties="")
{
   $url = "mailto:".$email;
   if(!$text) $text =$email;
   return  $this->hyperlink($url,$argument='',$text,$properties='');
}

# Image
function image($source,$alt="",$width="",$height="",$parameters="")
{
 if($width) $width = ' width="'.$width.'" ';
 if($height) $height = ' height="'.$height.'" ';
 if($alt) $alt = ' alt="'.$alt.'" ';
 if(@fopen($source,'r'))
		 return '<img src="'.$source.'"'.$width.$height.$alt.' border="0">';
}


} // END  CLASS
 ?>