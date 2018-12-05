<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 19.11.18
 * Time: 10:01
 */

require_once('./resources/config.php');

require_once (TEMPLATES_PATH . "/header.php");

?>

<div>
    <h1>Welcome to Mouselab Web</h1>
    <h2> This is the main page content </h2>

    <div>
        <iframe src="./resources/library/mlwebphp_100beta/mlweb_start_random.html" frameborder="0"></iframe>
    </div>
</div>

<?php require_once(TEMPLATES_PATH . "/footer.php");
