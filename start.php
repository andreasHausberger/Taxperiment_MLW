<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 19.11.18
 * Time: 10:01
 */

?>
<div>
    <h1>Welcome, researcher!</h1>
    <br>
    <p>Welcome to the redesigned Taxperiment Dashboard.</p>

    <h2>Recent Changes</h2>
    <ul class="list-group">
        <li class="list-group-item"> Added Test page. </li>
        <li class="list-group-item"> Added more security for Saving data. </li>
        <li class="list-group-item"> Changed ECU / £ Currency Key</li>
    </ul>
    <hr>
    <div class="btn btn-primary disabled" data-toggle="modal" data-target="#expModal" aria-disabled="true">
        Start Experiment with Custom Parameters
    </div>

    <div class="modal fade" id="expModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Custom Experiment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    include("./resources/library/mlwebphp_100beta/mlweb_start_random.html");
                    ?>
                    <br>

                </div>

            </div>
        </div>

    </div>

    <p class="versionText">Demo Version 1.4.10 (July 2021)</p>

</div>

<?php require_once("public/templates/footer.php"); ?>
