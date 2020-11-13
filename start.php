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
        <li class="list-group-item">Fix: Correct saving & processing of Visual Cue data</li>
        <li class="list-group-item">Visual Cue Box now has a Pointer as cursor</li>
        <li class="list-group-item">Martin's Changes as of 12.11.2020, 19:20</li>
    </ul>
    <hr>
    <div class="btn btn-primary" data-toggle="modal" data-target="#expModal">
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

    <p class="versionText">Staging Version 1.2.14 (November 2020)</p>

</div>

<?php require_once("public/templates/footer.php"); ?>
