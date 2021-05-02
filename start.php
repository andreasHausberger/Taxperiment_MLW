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

        <li class="list-group-item"> Auto Save for Audits: When the site will disappear, the most recent values are saved. (Audit is still performed as expected)</li>
        <li class="list-group-item"> Info whether audit is prefiled correctly (with button) or via auto-save (see above) is saved. </li>
        <li class="list-group-item"> Audit text input field no longer auto-completes or auto-suggests. </li>
        <li class="list-group-item"> Adapted Style for Sliders: No more horizontal scrolling. </li>
        <li class="list-group-item"> Slider page does no longer display a modal dialogue after timer finishes. </li>

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

    <p class="versionText">Demo Version 1.4.8 (May 2021)</p>

</div>

<?php require_once("public/templates/footer.php"); ?>
