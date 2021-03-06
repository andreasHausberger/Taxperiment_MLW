<?php

function getNavBar()
{

    echo '
    <nav class="navbar">
          <div class="navbarImageContainer">
            <img class="navbar-brand" src="/public/img/Uni_Logo_2016.png" alt="">
          </div>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div>
            <ul class="nav nav-tabs nav-fill">

              <li class="nav-item active">
                <a class="nav-link" href="/index.php">Home <span class="sr-only">(current)</span></a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/resources/index.php?page=designer">Designer <span class="sr-only">(current)</span></a>
              </li>

              <li class="nav-item dropdown">
                 <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                  Experiment Data
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="/backend/page/data_list.php">View Data</a>
                  <a class="dropdown-item" href="/resources/index.php?page=download">Download Data</a>
                </div>
              </li>

              <li class="nav-item">
               <a class="nav-link" href="/public/include/experiment/feedback.php">Questionnaire Demo</a>
              </li>
            </ul>
          </div>
    </nav>
';
}

/**
 * @param $paraArray
 * @param DatabaseHelper $paraDatabaseHelper
 * @return string
 */
function createDataTableList($paraArray, $paraDatabaseHelper = null) {
    $html = "<ul class='list-group'>";

    foreach ($paraArray as $row) {
        $name = $row["table"];
        $displayName = $row["display_name"];

        $editSymbol = $row["read_only"] ? "" : "<i class='fas fa-edit'></i>";
        $downloadHTML = "";

        if ($paraDatabaseHelper) {
            $downloadHTML = $paraDatabaseHelper->createDownloadButton($name, $name, $displayName);
        }


        $rowHtml = "
            <li class='list-group-item'>
                <div class='row'>
                <div class='col-6'>
                    <a href='/backend/page/data_detail.php?page=$name'> $displayName</a>
                </div>
                <div class='col-6'>
                    <span>
                       $downloadHTML
                    </span>
                </div>
                </div>
            </li>";
        $html .= $rowHtml;
    }

    $html .= "</ul>";

    return $html;
}

/**
 * Creates a html warning template. Can be implemented flexibly.
 * @param $paraTitle
 * @param $paraMessage
 */
function createWarningHTML($paraTitle, $paraMessage) {

    $html = "
    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <h4>$paraTitle</h4>
        $paraMessage
    </div>
    ";

    return $html;

}