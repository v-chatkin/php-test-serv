<?
echo "Hello world";
$dsn = getenv('MYSQL_DSN');
$user = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');
$pdo = new PDO($dsn, $user, $password);

$sql = "CREATE TABLE IF NOT EXISTS News_list (id int AUTO_INCREMENT PRIMARY KEY, 
									title TEXT NOT NULL,
									text TEXT NULL)";
$pdo->exec($sql);
$title = 'Тест киррилицы';
$text = 'NIGGGA';
$my_sql_query = $pdo->prepare("INSERT INTO News_list (title, text) VALUES (?,?)");
$my_sql_query->execute([$title,$text]);

$my_sql_query = $pdo->prepare("SELECT * FROM News_list");
if ($my_sql_query->execute()) {
  while ($row = $my_sql_query->fetch()) {
    echo $row['id'];
	echo "  ";
	echo $row['title'];
	echo "  ";
	echo $row['text'];
	echo "<br>";
  }
}

$pdo = null;
echo "Table MyGuests created successfully";
?>