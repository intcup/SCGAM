<?php

function table($t){
	$db = include('db/connect.php');
	$stm = $db->prepare($t);
	$stm->execute();
	$res = $stm->get_result();
	echo "<table>";
	echo "<thead>";
	$fields = $res->fetch_fields();
	foreach($fields as &$field){
		echo "<td>" . $field->name . "</td>";
	}
	echo "</thead>";
	echo "<tbody>";
	while($row = $res->fetch_assoc()){
		echo "<tr>";
		foreach($fields as &$field){
			echo "<td>" . $row[$field->name] . "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}

?>
