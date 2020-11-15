<script>
    $(document).ready(function() {
        $('#screen_height').val(screen.height);
        $('#screen_width').val(screen.width);
    });
</script>

<div class="siteContainer">
    <div class="contentContainer">
        <p>
            <span class="textSpan">
                The actual decisions will start on the next screen. Please keep in mind:<br>
                <b>Your task in every round is deciding whether to pay or not to pay the tax due.
                The displayed information will change in each round. Feedback on whether you have been audited will be shown 
                after you completed all rounds.</b> 
                <br>
                There are about 20 rounds in total. After the study ends, one round will be chosen at random and paid in GBP. 
            </span>
            <br>

        <form action="<?php echo "/public/exp_config.php?&tw=0&sname=$participant&condition=$condition"?>" method="post">
            <input type="hidden" name="screen_height" id="screen_height">
            <input type="hidden" name="screen_width" id="screen_width">
            <input type="submit" value="Next">
        </form>
        </p>
    </div>
</div>