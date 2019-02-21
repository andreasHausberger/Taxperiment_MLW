<div class="bottomContainer">
    <a href=<?php
    $uri = $_SERVER['REQUEST_URI'];
    $page = (int)substr($uri, -1);
    $newPage = $page + 1;
    $newPageString = "page=" . $newPage;

    $uri = str_replace("page=" . $page, "page=" . $newPage, $uri);
    echo $uri;
    ?> >
        <button id="continueButton" onclick="displayNextPage()">Next</button>
    </a>

</div>