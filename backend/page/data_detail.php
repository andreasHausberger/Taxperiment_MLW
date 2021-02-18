<?php

require_once ($_SERVER["DOCUMENT_ROOT"] . "/code/requirements_all.php");
require_once ($_SERVER["DOCUMENT_ROOT"] . "/backend/backend_config.php");

require_once( $_SERVER["DOCUMENT_ROOT"] . '/resources/config.php');

require_once( $_SERVER["DOCUMENT_ROOT"] . "/public/templates/header.php");

global $dataTables;

$db = new Database();
$page = getParamValue("page");
$helper = new DatabaseHelper( $db );
$row = $dataTables[$page];
$id = "#table_" . $row["table"];
?>
    <script>
        $(document).ready( function () {
            $.noConflict();
            $("<?php echo $id; ?>").DataTable({
                "scrollY":        "200px",
                "scrollX":        "200px",
                "scrollCollapse": true,
                "paging":         false
            });
        } );
    </script>

<h1>
    View Table <?php echo $row["display_name"]; ?>
</h1>


<?php

echo $helper->displayAsTable($row["table"], $row["select_columns"], $row["display_columns"]);

require_once( $_SERVER["DOCUMENT_ROOT"] . "/public/templates/footer.php");
