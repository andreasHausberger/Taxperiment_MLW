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

        <li class="list-group-item">Feedback: No Headline, shows all lines for all Audits. </li>
        <li class="list-group-item">Feedback: Wording "Payment of Missing Tax". </li>
        <li class="list-group-item">Tax Payment: Validation of Inputs. </li>
        <li class="list-group-item">Audit: Wording for "Fine". </li>
        <li class="list-group-item">Slider: Only displays "Time's Up" </li>


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

    <p class="versionText">Demo Version 1.4.6 (February 2021)</p>

</div>

<?php require_once("public/templates/footer.php"); ?>
