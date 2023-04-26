<?php
function Basic() //NEEDED
{	
	global $db;
	
	$res=$db->query("SELECT * FROM ".MTABLE."basic_info");

	if(mysql_num_rows($res) > 0)
	{  
	return $res;
	}
	else
	{
	return false;
	}
}
	
function getResultArray($sql){ 
		//To execute all type of queries
		global $db;
		$result  =$db->query($sql)or die (mysql_error()."<br>Please check the following query-<br>".$sql);
		$resultArray=array();
		while($row=mysql_fetch_assoc($result)){
			$resultArray[]=$row;
		}
		//print_r($resultArray);
		return $resultArray;
	}
	 
	function getRowByID($tableName,$idFieldName,$id,$condition){
		global $db;
		$query = "SELECT * FROM ".$tableName." WHERE ".$idFieldName."='".$id."'";
		
		if($condition!=""){
			$query  .= " AND ".$condition;
		}
		$result = $db->query($query);//Calling the execute query 
		$row = mysql_fetch_assoc($result); 
		return $row;
	}
	function upload_files($file,$path){ 
		$file_name=$_FILES[$file]["name"];  
			if ($_FILES[$file]["error"] > 0) {
				echo "Error: " . $_FILES[$file]["error"] . "<br>";
			} else {
				$random_num=rand();
					$new_file_name=$random_num.'_'.$file_name;
					
				if (file_exists($path . $new_file_name)) {
					echo 'File already exists : '.$path. $new_file_name;
				} else { 
					move_uploaded_file($_FILES[$file]["tmp_name"], $path . $new_file_name);
					return  $new_file_name ;
					
				}
			}
		}
		
	function upload_multiple_files($file_name){
		 $no_files = count($file_name);
			for ($i = 0; $i < $no_files; $i++) {
				if ($_FILES["files"]["error"][$i] > 0) {
					echo "Error: " . $_FILES["files"]["error"][$i] . "<br>";
				} else {
					$random_num=rand();
						$new_file_name=$random_num.'_'.$file_name[$i];
					if (file_exists('../uploads/' . $new_file_name)) {
						echo 'File already exists : /uploads/' . $new_file_name;
					} else {
						
						move_uploaded_file($_FILES["files"]["tmp_name"][$i], '../uploads/' . $file_name);
						echo  $file_name ;
						
					}
				}
			}//end of foor loop
		
		}
		
		function deleteQuery($tableName,$condition=""){	 
	//Delete function
		$query = "DELETE FROM $tableName ";
		if($condition!=""){

			$query  .= " WHERE $condition";
		}
		//print_r($query);
		$result = mysql_query($query);
		return $result;
	}//End Of deletequery	
	
?>
