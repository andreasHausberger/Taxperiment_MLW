<div class="siteContainer">
    <div class="contentContainer">
            <p class="textSpan">
                The examples are now finished. On the next page the study begins. Information on earned income, the tax rate, audit probability, and fine levels for each round will be displayed with MouselabWEB. This means that this information is hidden behind boxes. These boxes are labeled. To access the respective information, you have to move the mouse pointer over the box on the screen. As long as the pointer is over the box, it will display the information. Whenever the pointer moves out of the box, the box closes and the information is hidden again. See the example below and please make yourself familiar with how the boxes open and close.
            </p>
            <br>

            <?php
            $condition = $_GET['condition'];
            if ( $condition == 1 || $condition == 2 || $condition == 3) {
                include "../../../resources/templates/presentation_demo.php";
            }
            else {
                include "../../../resources/templates/presentation_demo_other.php";
            }
             ?>
    </div>
    <br>
</div>