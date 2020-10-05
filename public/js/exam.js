$(function() {


    let randomCondition = 0;

    let signContainer = $(".signContainer");

    let cueContainer = $("#cue_container");

    signContainer.mouseenter( function(e) {
        console.log("Mouse Over Sign Container!");
        let value = displayContentForSignContainer(condition, randomCondition, angle, true);
        ShowCont('box', e, true, value);
    });

    signContainer.mouseleave( function(e) {
        console.log("Mouse Leave Sign Container!");
        displayContentForSignContainer(condition, randomCondition, angle, false);
        HideCont('box', e, true);
    });
    //no sign box for condition 1!
    if (condition && condition == 1) {
        $(".signContainer").hide();
        cueContainer.hide();
        console.log("Hid sign container for condition 1");
    }
    else if(condition == 2) {
        $("#c0_cont").hide();
        $("#c1_cont").hide();
    }

});

function displayContentForSignContainer(condition, randomCondition, angle, mouseIsOver = false) {
    if (mouseIsOver) {
        showRotatedIndicator(angle);
    }
    else
    {
        $('#signContainerInner').hide();
    }
}

function showRotatedIndicator(angle) {
    $('#signContainerInner').show();
    let rotation = 'rotate(' + angle + 'deg)';
    document.getElementById("cue_arrow").style.transform = rotation;
}