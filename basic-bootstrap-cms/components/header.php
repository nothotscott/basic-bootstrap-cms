<?PHP

$default_nav_menu = array(
	new IconTextLink("fa-home", "Home", "/home.php")
);
$default_account_menu_loggedin = array(
	new IconTextLink("fa-user", "Profile", "/profile.php"),
);
$default_account_menu_loggedout = array(
	new IconTextLink("fa-user", "Login", "/login.php"),
	new IconTextLink("fa-user-plus", "Create Account", "/register.php")
);

if(!isset($nav_menu)){
	$nav_menu = $default_nav_menu;
}
if(!isset($account_menu_loggedin)){
	$account_menu_loggedin = $default_account_menu_loggedin;
}
if(!isset($account_menu_loggedout)){
	$account_menu_loggedout = $default_account_menu_loggedout;
}


?>
<header>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<a class="navbar-brand" href="/" style="font-size: 2rem; padding-top: 0px; margin-right: 2rem;"><?=$brand?></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#scnavbar" aria-controls="scnavbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		<div class="collapse navbar-collapse" id="scnavbar">
			<ul class="navbar-nav mr-auto">
				<?PHP
					foreach($nav_menu as $item){
						$active_text = isset($active) && $active == $Item->Text ? "active" : "";
						print('<li class="nav-item ' . $active_text . '">' . $item->as_text() . '</li>');
					}
				?>
			</ul>
			<ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
				<li class="nav-item dropdown">
					<?PHP
						$loggedin = isset($account);
						$menu = $loggedin ? $account_menu_loggedin : $account_menu_loggedout;
						
						if($loggedin == true){
							print('
					<button type="button" class="dropdown-toggle btn btn-outline-info" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						' . (new IconText("fa-user-circle", $account[DB_USERS_COLUMN_USERNAME]))->as_text() . '
					</button>');
						}else{
							print('
					<button type="button" class="dropdown-toggle btn btn-outline-primary" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						' . (new IconText("fa fa-users", "Login"))->as_text() . '
					</button>');
						}
					?>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<?PHP
							foreach($menu as $item){
								print($item->as_text(true, "dropdown-item"));
							}
						?>
					</div>
				</li>
			</ul>
		</div>
		
	</nav>
</header>