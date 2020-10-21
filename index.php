<?PHP

$root = $_SERVER["DOCUMENT_ROOT"] . "/" . (array_key_exists("SUBDIR", $_SERVER) ? $_SERVER["SUBDIR"] : "");
require_once("$root/basic-bootstrap-cms/content.php");

?>
<html lang="en">

	<head>
		<?=get_content("head")?>
	</head>
	
	<body>
		<?=get_content("header", array("brand"=>"r.s.c"))?>
		
		<div class="container">
			<h2>This is a test page</h2>
			<?=bootstrap_grid(array("this", "is", "a", "test", "grid"), 2,2)?>
			<?=bootstrap_alert("This is a test alert")?>
			<?=bootstrap_button("Button without link")?>
			<?=bootstrap_button("Button with link", "#")?>
			<?=bootstrap_card_list("Test card list", array("Item 1", "Item 2", "Item 2"))?>
		</div>
	</body>

	<?=get_content("footer")?>
</html>