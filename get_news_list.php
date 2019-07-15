<?
header('Content-Type: application/json');
$dsn = getenv('MYSQL_DSN');
$user = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');
$pdo = new PDO($dsn, $user, $password);
if ( !strcasecmp('GET', $_SERVER['REQUEST_METHOD']) ) {
	$my_sql_query = $pdo->prepare("SELECT * FROM News_list");
	if ($my_sql_query->execute()) {
		while ($row = $my_sql_query->fetch(PDO::FETCH_ASSOC)) {
			echo json_encode($row);
		}
	}
};
if ( !strcasecmp('POST', $_SERVER['REQUEST_METHOD']) ) {
	$json_str = file_get_contents('php://input');
	$json_obj = json_decode($json_str, true);
	$id = $json_obj["id"];
	$sql = "Select * from News_list where id = ?";
	$query = $pdo->prepare($sql);
	if ($query->execute([$id])) {
		 while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			echo json_encode($row); 
		 }
	}
}
$pdo = null;
?>