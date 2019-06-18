<?php
/* functions.inc.php */

function log_page($db,$page_name){
	if(!isset($_SESSION['id'])){
		$user_id = "0";
	} else {
		$user_id = $_SESSION['id'];
	}
	$sql = "INSERT INTO logs (user_id,page_name) VALUES ('$user_id','$page_name')";
	$result = $db->query($sql);
}

function build_select($db,$key){
	$sql = "SELECT name,value FROM keywords WHERE key_name='" . $key . "'";

	$result = $db->query($sql);

	while($row = $result->fetch_assoc()) {?>
		<option value=<?php echo '"' . $row['value'] . '"' . ">" . $row['name'] . "</option>";?>
	<?php }
}


function getSum($avg){
	$sum= round($avg, PHP_ROUND_HALF_UP);
	return $sum;} 













?>
