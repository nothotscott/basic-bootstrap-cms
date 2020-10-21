<?PHP

require_once("core.php");
require_once("db.php");

$db = new Database();
$account = check_account($db);
$account_id = $account ? $account[DB_USERS_COLUMN_ID] : null;

// Runs and returns the php file $content_name with an array of $variables included
function get_content($content_name, $variables=null){
	global $subdir, $root, $cms, $account, $account_id;
	$content_parts = pathinfo($content_name);
	$file_name = (array_key_exists("extension", $content_parts) and $content_parts["extension"] == "php") ? $content_name : ($root . CMS_NAME . "/components/" . $content_name . ".php");
	if($variables){
		foreach($variables as $variable=>$value){
			${$variable} = $value;
		}
	}
	ob_start();
	include($file_name);
	return ob_get_clean();
}
	

?>