<?
header('Content-Type: application/json');
$dsn = getenv('MYSQL_DSN');
$user = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');
$pdo = new PDO($dsn, $user, $password);
if ( !strcasecmp('POST', $_SERVER['REQUEST_METHOD']) ) {
	$json_str = file_get_contents('php://input');
	$json_obj = json_decode($json_str, true);
	$id = $json_obj["id"];
	$my_sql_query = $pdo->prepare("SELECT * FROM News_list WHERE id = ? LIMIT 1");
	$my_sql_query->execute([$id]);
	$row = $my_sql_query->fetch(PDO::FETCH_ASSOC);
	echo json_encode($row);
	if (json_encode($row) != "false") {
		$my_sql_query = $pdo->prepare("DELETE FROM News_list where id= ?");
		$my_sql_query->execute([$id]);
		echo "news deleted";
	}
	else {
		echo "News not found";
	}
	$my_sql_query = $pdo->prepare("SELECT * FROM News_list");
	if ($my_sql_query->execute()) {
		while ($row = $my_sql_query->fetch(PDO::FETCH_ASSOC)) {
			echo json_encode($row);
		}
	}
	
}
$pdo = null;
?>