<?php

class db_mysql
{
	var $database;
	var $hostname;
	var $username;
	var $password;
	var $link;
	
	function db_mysql($hostname, $username, $password, $database)
	{
		$this->hostname = $hostname;
		$this->username = $username;
		$this->password = $password;
		$this->database = $database;
	}

	function connect()
	{	
		if(!$this->link = @mysql_connect($this->hostname,$this->username,$this->password) )
		{
			echo "Cannot Connect to host: ".$this->hostname;
			exit;
			return false;
		}
		else
		{
			return true;
		}
	}

	function select_db()
	{
		if(!@mysql_select_db($this->database, $this->link) )
		{
			echo "Cannot select database: ".$this->database;
			exit;
			return false;
		}
		else
		{
			return true;
		}
	}
	

	function query($query)
	{
		//$result = @mysql_query($query, $this->link) or die($query.'--<font color=red>'.mysql_error().'</font>');
			
			try
		 {
			$result = @mysql_query($query, $this->link);
			if(mysql_error())
			{
				throw new Exception(mysql_error());
			}
		  
		 }
		//catch exception
		catch(Exception $e)
	  	{
	  		header('location: error.php');
	  	}
		return $result;
		 
	}
	
	function fetch_one_row($query)
	{
		//$result = @mysql_query($query, $this->link) or die($query.'--<font color=red>'.mysql_error().'</font>');
		try
		 {
			$result = @mysql_query($query, $this->link);
			if(mysql_error())
			{
				throw new Exception(mysql_error());
			}
		  
		 }
		//catch exception
		catch(Exception $e)
	  	{
	  		header('location: error.php');
			//$e->getFile();
	  	}
		$array = @mysql_fetch_row($result);
		if(is_array($array)) {
		foreach($array as $key => $val)
		   $fetch_array[$key] = stripslashes($val);
		 }  
		return $fetch_array;
	}
	

	function fetch_array($result)
	{
		$array = @mysql_fetch_array($result);
		if(is_array($array)) {
		foreach($array as $key => $val)
		   $fetch_array[$key] = stripslashes($val);
		 }  
		return $fetch_array;
	}

	function fetch_row($result)
	{
		$array = @mysql_fetch_row($result);
		if(is_array($array)) {
		foreach($array as $key => $val)
		   $fetch_array[$key] = stripslashes($val);
		 }  
		return $fetch_array;
	}

	function fetch_assoc($result)
	{
		$array = mysql_fetch_assoc($result);
		if(is_array($array)) {
		foreach($array as $key => $val)
		   $fetch_array[$key] = stripslashes($val);
		 }  
		return $fetch_array;
	}

	
	function delete_id($id, $field, $table)
	{
		if( is_array($id) )
		{
			foreach( $id AS $i )
			{
				$this->query("DELETE FROM $table WHERE $field = '$i'");
			}
		}
		else
		{
			$this->query("DELETE FROM $table WHERE $field = '$id'");
		}
	}

	function delete_sel_value($table,$field,$value)
	{
		$result=$this->query("SELECT $field FROM $table WHERE $field='$value'");
		$count = $this->fetch_row($result);
		
			return $count;
	}
	
	
	
	function num_rows($result)
	{
		return @mysql_num_rows($result);
	}

	function affected_rows()
	{
		return @mysql_affected_rows();
	}

	function insert_id()
	{
		return @mysql_insert_id();
	}

	function value_exists($array, $table)
	{
		/*array contains values of the field name and field value*/
		foreach($array as $key => $value)
		{
			$condition .= $key." = '".$value."' and ";
		}
		$condition = substr($condition,0,-5);
		$result = $this->query("SELECT COUNT(*) as cnt FROM ".$table." WHERE ".$condition);
		$count = $this->fetch_row($result);
		return $count[0];
	}

	function get_count($table,$condition='')
	{
		if($condition) $condition = " WHERE " . $condition;
		//echo "SELECT COUNT(*) as cnt FROM ".$table . $condition; exit;
		$result = $this->query("SELECT COUNT(*) as cnt FROM ".$table . $condition);
		
		$count = $this->fetch_row($result);
		return $count[0];
	}

	function get_count_sql($sql='')
	{
		$result = $this->query($sql);
		$count = $this->fetch_row($result);
		return $count[0];
	}
	
	function update_from_array($array, $table, $field, $id)
	{ 
		$query = "UPDATE $table SET ";
		while(@list($key,$value) = @each($array))
		{
		if((strpos($value,'now()') === false ) and (strpos($value,'date()')=== false) and (strpos($value,'DATE_ADD')=== false))
			{
				$fields[] = "$key='$value'";
			}
			else
			{
				$fields[] = "$key=$value";
			}
		}
		$query .= implode(', ', $fields);
		$query .= " WHERE ".$field." = '$id'";
		//echo $query;  exit;
		$this->query($query);
		return true;
	}

 function cleanUserInput($insertValue){
	//Function for cleaning user inputs
		$this->insertValue=$insertValue;
		if (!get_magic_quotes_gpc()){
			$this->insertValue 	= addslashes($this->insertValue);
		}
		else{
			$this->insertValue 	= stripslashes($this->insertValue);
			$this->insertValue	= addslashes($this->insertValue);
		}
		return 	trim($this->insertValue);
	}
	
function UpdateQuery($tableName,$dataArray,$condition=""){
	//Function to Update a table	
		$this->tableName=$tableName;
		$this->dataArray=$dataArray;
		if(is_array($this->dataArray)){
			$query	    = "UPDATE  $this->tableName SET ";
			$arrayCount			= sizeof($this->dataArray);
			$count				= 1;
			while(list($key,$val)  = each($this->dataArray)){				
				if ($count==$arrayCount)
					$query .=" $key='".$this->cleanUserInput($val)."'";
				else
					$query .="$key='".$this->cleanUserInput($val)."', ";
					$count ++;	
			}//End Of while loop	
			if ($condition!=""){
				$query   .= " WHERE  $condition ";
			}//end of if 
			//print($query);exit;
			$this->result = $this->query($query);//Calling the execute query 
			return true;
		}//end of if
	}//End of updatequery Function...

	function update_sql_cond($array, $table, $sql_cond)
	{
		$query = "UPDATE $table SET ";
		while(@list($key,$value) = @each($array))
		{
		if((strpos($value,'now()') === false ) and (strpos($value,'date()')=== false) and (strpos($value,'DATE_ADD')=== false))
			{
				$fields[] = "$key='$value'";
			}
			else
			{
				$fields[] = "$key=$value";
			}
		}
		$query .= implode(', ', $fields);
		$query .= " WHERE ".$sql_cond." ";
		$this->query($query);
		return true;
	}
	
	function insert_from_array($array, $table)
	{ 
		while( @list($key,$value) = @each($array) )
		{
			$field_names[] = "$key";
			if((strpos($value,'now()') === false ) and (strpos($value,'date()')=== false) and (strpos($value,'DATE_ADD')=== false) )
			$field_values[] = "'$value'";
			else
			$field_values[] = "$value";
		}
		$query = "INSERT INTO $table (";
		$query .= implode(', ', $field_names);
		$query .= ') VALUES (' . implode(',', $field_values) . ')';
		//echo $query; exit();
		$this->query($query);
		return true;
	}
	
	function copy_from_array($array, $table)
	{
		while( @list($key,$value) = @each($array) )
		{
			$field_names[] = "$key";
			if((strpos($value,'now()') === false ) and (strpos($value,'date()')=== false) and (strpos($value,'DATE_ADD')=== false) )
			$field_values[] = "'$value'";
			else
			$field_values[] = "$value";
		}
		$query = "INSERT INTO $table (";
		$query .= implode(', ', $field_names);
		$query .= ') VALUES (' . implode(',', $field_values) . ')';
		$this->query($query);
		return true;
	}
}  
// END CLASS
 ?>
