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
	$title = $json_obj["title"];
	$text = $json_obj["text"];
	$my_sql_query = $pdo->prepare("UPDATE News_list SET title = ?, text = ? WHERE id = ?");
	$my_sql_query->execute([$title, $text, $id]);
	$my_sql_query = $pdo->prepare("SELECT * FROM News_list WHERE id = ?");
	$my_sql_query->execute([$id]);
	while($row = $my_sql_query->fetch(PDO::FETCH_ASSOC)){
		echo json_encode($row);
	};
	
	echo "news udpated";
}
$pdo = null;
?>
