<?php

function getNavBar()
{
    echo '
    <nav class="navbar navbar-expand-md navbar-light bg-light">
  <a class="navbar-brand" href="#">Taxperiment</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/resources/library/designer_100beta/index.html">Designer <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="/resources/library/designer_100beta/index.html" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Experiment Data
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">View Data</a>
          <a class="dropdown-item" href="#">Download Data</a>
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