<?
header('Content-Type: application/json; charset= utf-8');
$site_info = array('site'=>'mySite', 'author' => 'Victor', 'url'=>'exaple', 'id'=>0);

if ( !strcasecmp('GET', $_SERVER['REQUEST_METHOD']) ) {
	echo json_encode($site_info);
};
if ( !strcasecmp('POST', $_SERVER['REQUEST_METHOD']) ) {
	$json_str = file_get_contents('php://input');
	$json_obj = json_decode($json_str, true);
	$id = iconv('windows-1251','utf-8', $json_obj["id"]);
	echo $id;
	$site_info['id'] = 'алеша';
	echo json_encode($site_info);
}
//mb_detect_encoding
?>