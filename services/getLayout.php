﻿<?php 	$layout = $_GET['layout'];		class MyDB extends SQLite3	{		function __construct()		{			$this->open('../db/database.db');		}	}	$json_string;	$db = new MyDB();	if($db){		$json_string = "{";		$sql_layout =<<<EOF		SELECT id FROM layout_components WHERE name='$layout';EOF;		$ret = $db->query($sql_layout);		$row = $ret->fetchArray(SQLITE3_ASSOC);		$layout_id = $row['id'];				$sql_component =<<<EOF		SELECT id,field FROM components WHERE layout_components_id=$layout_id;EOF;		$ret = $db->query($sql_component);		while($row = $ret->fetchArray(SQLITE3_ASSOC)){			$field = $row['field'];			$component_id = $row['id'];			$json_string = $json_string."\"".$field."\" : ";			$json_string = $json_string."[";						$sql_object=<<<EOF			SELECT id FROM object WHERE component_id = $component_id;EOF;			$ret_obj = $db->query($sql_object);			while($row_obj = $ret_obj->fetchArray(SQLITE3_ASSOC)){				$id_object = $row_obj['id'];				$json_string = $json_string."{";												$sql_content=<<<EOF				SELECT attribute,value FROM content,components_structure WHERE content.id_object = $id_object AND content.components_structure_id = components_structure.idEOF;				$ret_cont = $db->query($sql_content);				while($row_cont = $ret_cont->fetchArray(SQLITE3_ASSOC)){					$key = $row_cont['attribute'];					$value = $row_cont['value'];					$json_string = $json_string."\"".$key."\" : \"".$value."\",";									}				$json_string = substr($json_string,0,strlen($json_string)-1)."";				$json_string = $json_string."},";							}			$json_string = substr($json_string,0,strlen($json_string)-1)."";			$json_string = $json_string."],";					}		$json_string = substr($json_string,0,strlen($json_string)-1)."";		$json_string = $json_string."}";				echo $json_string;	} else {		echo $db->lastErrorMsg();	}?>