<?
header('Content-Type: application/json');
$dsn = getenv('MYSQL_DSN');
$user = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');
$pdo = new PDO($dsn, $user, $password);

if ( !strcasecmp('POST', $_SERVER['REQUEST_METHOD']) ) {
	$json_str = file_get_contents('php://input');
	$json_obj = json_decode($json_str, true);
	$title = $json_obj["title"];
	$text = $json_obj["text"];
	$my_sql_query = $pdo->prepare("INSERT INTO News_list (title, text) VALUES (?,?)");
	$my_sql_query->execute([$title,$text]);
	$query = $pdo->prepare("SELECT * FROM News_list ORDER BY id DESC LIMIT 1");
	$query->execute();
	$row= $query->fetch(PDO::FETCH_ASSOC);
	echo "news added";
	echo json_encode($row);
}
$pdo = null;

?>
