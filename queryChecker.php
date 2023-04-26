<?php
extract($_POST);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Query Checker</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="827" border="0">
    <tr>
      <td width="47">&nbsp;</td>
      <td width="625">&nbsp;</td>
      <td width="141">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><textarea name="query" id="query" cols="85" rows="10"><?php echo $query; ?></textarea></td>
      <td><input type="submit" name="btnSubmit" id="button" value="Submit" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  hiiiii
</form>
<?php
	
$con = mysql_connect("localhost","oziasits_palaso","X^L4$A0?V]}(");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db('oziasits_palasoftt');

if(isset($btnSubmit) && $query != '')
{
	$aryFileds = array();
	$aryFirstElements = array();
	$starter = 1;
	$res = mysql_query($query) or die(mysql_error());
	if(mysql_num_rows($res) > 0)
	{
		echo 'Total Recors : '.mysql_num_rows($res).'<br>';
		echo '<table width="200" border="1">';
		while($row = mysql_fetch_array($res))
		{
			if($starter==1)
			{
				foreach($row as $key=>$val)
				{
					 if (!is_numeric($key)) {
						//echo $key.'<br>';
						$aryFileds[] = $key;
						$aryFirstElements[] = $val;
					 }
				}
				$starter++;

			// table field names
			echo ' <tr>';
			foreach($aryFileds as $fieldNames)
			{
				echo ' <td valign="top"><strong>'.$fieldNames.'</strong></td>';
			}
			echo ' </tr>';
			
			
			// search first elements
			echo ' <tr>';
			foreach($aryFirstElements as $items)
			{
				echo ' <td valign="top">'.$items.'</td>';
			}
			echo ' </tr>';

  

				
			}
			else
			{
				echo ' <tr>';
				foreach($aryFileds as $fieldNames)
				{
					echo ' <td valign="top">'.$row[$fieldNames].'</td>';
				}
				echo ' </tr>';

			}
		}
		echo '</table>';
	}
	else
	{
			echo "No result";
	}
	
}


mysql_close($con);

?>
</body>
</html>