<?PHP

const CMS_NAME	= "basic-bootstrap-cms";

$subdir = $subdir = array_key_exists("SUBDIR", $_SERVER) ? $_SERVER["SUBDIR"] : "";
$root = $_SERVER["DOCUMENT_ROOT"] . "/$subdir";
$cms = "/" . $subdir . CMS_NAME;
require_once("db.php");
require_once("bootstrap.php");

class IconText {
	public $icon;
	public $text;
	
	function __construct($icon, $text){
		$this->icon = $icon;
		$this->text = $text;
	}
	
	function as_text($icon_first=true){
		if($icon_first){
			return '<span class="fa ' . $this->icon . '"></span> ' . $this->text;
		}
		return $this->text . ' <span class="fa ' . $this->icon . '"></span>';
	}
}

class IconTextLink extends IconText {
	public $link;
	
	function __construct($icon, $text, $link){
		parent::__construct($icon, $text);
		$this->link = $link;
	}
	
	function as_text($icon_first=true, $class="nav-link"){
		return '<a class="' . $class . '" href=' . $this->link . '>' . parent::as_text($icon_first) . '</a>';
	}
}


function get_root(){
	global $root;
	return $root;
}

function redirect($url){
	header("location:$url");
	die("Redirecting to $url...");
}

// Checks if logged in from cookie
function check_account($db){
	if(!isset($_COOKIE["token"])){
		return null;
	}
	return $db->get_account_by_token($_COOKIE["token"]);
}

// Redirects to $redirect_false if not logged in and redirects to $redirect_true if logged in. Won't redirect if the respetive parameter is null
function process_account($account, $redirect_false, $redirect_true){
	if($account and $redirect_true){
		redirect($redirect_true);
	}else if (!$account and $redirect_false){
		redirect($redirect_false);
	}
}


?>