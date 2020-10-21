<?PHP

const DB_CONNECTION_FILE	= "private/db.json";

const DB_USERS_TABLE			= "users";
const DB_USERS_COLUMN_ID		= "id";
const DB_USERS_COLUMN_USERNAME	= "username";
const DB_USERS_COLUMN_PASSWORD	= "password";
const DB_USERS_COLUMN_TOKEN		= "token";

class Database {
	protected $mysqli;
	
	function __construct($file=null){
		global $root;
		if(!$file){
			$file = $root . DB_CONNECTION_FILE;
		}
		$config = json_decode(file_get_contents($file), true);
		$this->mysqli = new mysqli($config["host"], $config["user"], $config["password"], $config["dbname"]);
	}
	function __destruct(){
		$this->mysqli->close();
	}
	
	function execute($query, $types=null, ...$params){
		$statement = $this->mysqli->prepare($query);
		if($types){
			$statement->bind_param($types, ...$params);
		}
		$statement->execute();
		$result = $statement->get_result();
		$statement->close();
		if($result != null && $result->num_rows > 0){
			$results = array();
			while($r = $result->fetch_array(MYSQLI_ASSOC)){
				array_push($results, $r);
			}
			return $results;
		}
		return null;
	}
	
	function get_account_by_id($user_id){
		$query = sprintf("SELECT * FROM %s WHERE %s=?", DB_USERS_TABLE, DB_USERS_COLUMN_ID);
		$accounts = $this->execute($query, "i", $user_id);
		return $accounts ? $accounts[0] : null;
	}
	function get_account_by_password($username, $password){
		$query = sprintf("SELECT * FROM %s WHERE %s=?", DB_USERS_TABLE, DB_USERS_COLUMN_USERNAME);
		$accounts = $this->execute($query, "s", $username);
		if(!$account){
			return null;
		}
		$account = $accounts[0];
		if(password_verify($password, $account[DB_USERS_COLUMN_PASSWORD])){
			return $account;
		}
		return null;
	}
	function get_account_by_token($token){
		$query = sprintf("SELECT * FROM %s WHERE %s=?", DB_USERS_TABLE, DB_USERS_COLUMN_TOKEN);
		$accounts = $this->execute($query, "s", $token);
		return $accounts ? $accounts[0] : null;
	}
}

?>