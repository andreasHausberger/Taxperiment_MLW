

<?php
$showNav = true;

require_once ($_SERVER["DOCUMENT_ROOT"] . "/code/requirements_all.php");
require_once ($_SERVER["DOCUMENT_ROOT"] . "/backend/backend_config.php");
require_once ($_SERVER["DOCUMENT_ROOT"] . "/code/code_ui.php");

require_once( $_SERVER["DOCUMENT_ROOT"] . '/resources/config.php');

require_once( $_SERVER["DOCUMENT_ROOT"] . "/public/templates/header.php");

$db = new Database();

$helper = new DatabaseHelper( $db );
?>
<h1>Database Tables</h1>

<?php
echo createDataTableList($dataTables, $helper);


require_once( $_SERVER["DOCUMENT_ROOT"] . "/public/templates/footer.php");