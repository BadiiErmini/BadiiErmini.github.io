<?php 
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	if(isset($_GET['id'])){$id = $_GET['id'];}else{
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
		$query = "SELECT * FROM components WHERE layout_components_id=".$id;
		$ret = $db->query($query);
		while($row = $ret->fetchArray(SQLITE3_ASSOC)){ 
			$id_comp = $row['id'];
			$query = "SELECT * FROM components_structure WHERE component_id=".$id_comp;
			$ret_comp = $db->query($query);
			$attribute_arr = array();
			while($row_comp = $ret_comp->fetchArray(SQLITE3_ASSOC)){ 
				$attribute = $row_comp['attribute'];
				array_push($attribute_arr,$attribute);
			}
			$row_array['field'] = $row['field'];
    		$row_array['attributes'] = $attribute_arr;
    		array_push($return_arr,$row_array);
    		
		}
		echo json_encode($return_arr);
	} else {
		echo $db->lastErrorMsg();
	}
?>