<?php 
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	if(isset($_GET['res'])){$res = $_GET['res'];}else{
		echo "specificare la risorsa richiesta in get";
	}
	class MyDB extends SQLite3
	{
		function __construct()
		{
			$this->open('../db/database.db');
		}
	}
	$return_arr = array();
	$db = new MyDB();
	if($db){
		$query = "SELECT * FROM layout_components";
		$ret = $db->query($query);
		while($row = $ret->fetchArray(SQLITE3_ASSOC)){ 
			$row_array['id'] = $row['id'];
    		$row_array['name'] = $row['name'];
    		array_push($return_arr,$row_array);
		}
		echo json_encode($return_arr);
	} else {
		echo $db->lastErrorMsg();
	}
?>