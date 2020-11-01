<?php

require_once("../../../resources/templateConfig.php");

$box = $currentBox;

if (isset($_GET['subject'])) {
    $subject = $_GET['subject'];
} else {
    $subject = "anonymous";
}
if (isset($_GET['condition'])) {
    $condnum = $_GET['condition'];
} else {
    $condnum = -1;
}



?>
<!--Since the "condnum" input field is broken, we'll use our own with the name "condition". save.php is rewritten accordingly.-->

<HTML>
<HEAD>
    <TITLE>MouselabWEB Survey</TITLE>
    <script language=javascript src="/resources/library/mlwebphp_100beta/mlweb.js"></SCRIPT>
    <link rel="stylesheet" href="/resources/library/mlwebphp_100beta/mlweb.css" type="text/css">
</head>

<body onLoad="timefunction('onload','body','body')">
<script language="javascript">
    ref_cur_hit = <?php echo($condnum);?>;
    subject = "<?php echo($subject);?>";
</script>

<!--BEGIN TABLE STRUCTURE-->
<SCRIPT language="javascript">
    //override defaults
    mlweb_outtype = "CSV";
    mlweb_fname = "mlwebform";
    tag = "a0^a1`"
        + "b0^b1`"
        + "c0^c1";

    let boxArray = <?php echo json_encode($currentBox) ?>;

    let boxLabels = boxArray.label;
    let boxContents = boxArray.content;


    let taxRate = "Tax (" +  <?php echo $taxRate * 100 ?> +"%): " + <?php echo $income * $taxRate; ?> +" ECU " + "^";
    let auditProbability = <?php echo $auditProbability * 100 ?> +"% chance" + "^";
    let fineRate = "Payback + " +  <?php echo $fineRate ?> +"00%" + "`";
    let income =  <?php echo $income ?> +" ECU" + "`";
    let txt = boxContents; //auditProbability + fineRate + taxRate + income + "c0_inner^" + "c1_inner";


    state = "1^1`"
        + "1^1`"
        + "1^1";

    box = boxLabels; //"income^tax`audit^fine`sure gain^EV risky";

    CBCol = "0^0";
    CBRow = "0^0^0";
    W_Col = " <?php echo strval($widthString); ?>";
    H_Row = "<?php echo strval($heightString); ?>>";

    chkchoice = "nobuttons";
    btnFlg = 0;
    btnType = "radio";
    btntxt = "";
    btnstate = "";
    btntag = "";
    to_email = "";
    colFix = false;
    rowFix = false;
    CBpreset = false;
    evtOpen = 0;
    evtClose = 0;
    chkFrm = false;
    warningTxt = "Some questions have not been answered. Please answer all questions before continuing!";
    tmTotalSec = 60;
    tmStepSec = 1;
    tmWidthPx = 200;
    tmFill = true;
    tmShowTime = true;
    tmCurTime = 0;
    tmActive = false;
    tmDirectStart = true;
    tmMinLabel = "min";
    tmSecLabel = "sec";
    tmLabel = "Timer: ";

    //Delay: a0 a1 b0 b1 c0 c1
    delay = "0^0^0^0^0^0`"
        + "0^0^0^0^0^0`"
        + "0^0^0^0^0^0`"
        + "0^0^0^0^0^0`"
        + "0^0^0^0^0^0`"
        + "0^0^0^0^0^0";
    activeClass = "actTD";
    inactiveClass = "inactTD";
    boxClass = "boxTD";
    cssname = "mlweb.css";
    nextURL = "thanks.html";
    expname = "condition_" + <?php echo $condnum; ?>;
    randomOrder = false;
    recOpenCells = false;
    masterCond = 1;
    loadMatrices();
</SCRIPT>
<!--END TABLE STRUCTURE-->

<?php
//This is used to prepare GET variables we need for save.php
$feedback = $_GET['feedback'];
$presentation = $_GET['presentation'];
$order = $_GET['order'];

$saveURL = "/resources/library/mlwebphp_100beta/save.php?feedback=$feedback&order=$order&presentation=$presentation";
?>

<FORM name="mlwebform" id="mlwebform" onSubmit="return checkForm(this)" method="POST"
      action=<?php echo $saveURL ?>><INPUT type=hidden name="procdata" value="">
    <input type=hidden name="subject" value="">
    <input type="hidden" id="tax" name="tax" value=<?php echo $income ?>>
    <input type="hidden" id="reported_tax" name="reported_tax">
    <input type="hidden" id="actual_income" name="actual_income">
    <input type="hidden" id="net_income" name="net_income">
    <input type="hidden" id="wasAudited" name="wasAudited">
    <input type="hidden" id="wasHonest" name="wasHonest">
    <input type="hidden" id="fine" name="fine">
    <input type="hidden" name="subjectID" value=<?php echo $participantID ?>>
    <input type="hidden" name="experimentID" value=<?php echo $experimentID ?>>
    <input type="hidden" name="round" value=<?php echo $currentRound ?>>
    <input type=hidden name="expname" value="">
    <input type=hidden name="nextURL" value="">
    <input type=hidden name="choice" value="">
    <input type=hidden name="condnum" value="42">
    <input type="hidden" name="condition" value=<?php echo $condnum ?>>
    <input type=hidden name="to_email" value="">
    <input type=hidden name="nextRound" value=<?php echo $nextRound ?>>
    <input type=hidden name="nextMode" value=<?php echo $nextMode ?>>
    <!--BEGIN preHTML-->

    <!--END preHTML-->
    <!-- MOUSELAB TABLE -->
    <div class="mlwContentContainer">
        <div class="tableContainer">
<!--            <div class="signContainer">-->
<!--                <div class="container" id="signContainerInner" style="display: none">-->
<!--                    <img src="/public/img/visual_cue_background.png" class="cue-image">-->
<!--                    <img id="cue_arrow" src="/public/img/pointer_adjusted.png"class="cue-overlay">-->
<!--                </div>-->
<!--            </div>-->
            <TABLE border=1 class="mlwTrackingTable">
<!--                --><?php //echo $mlwFields ?>
                <TR>
                    <?php echo $incomeBox ?>
                    <?php echo $taxRateBox ?>
                </TR>
                <TR>
                    <?php echo $fineRateBox ?>
                    <?php echo $auditProbabilityBox ?>
                </TR>
                <TR style="height: <?php echo $cellHeight; ?>px">
                    <!--cell c0(tag:c0)-->
                    <td style="border: none" id="cue_container">
                        <div class="signContainer">
                            <div class="container" id="signContainerOuter">
                                <p>
                                    Expected Value Information
                                </p>
                            </div>
                            <div class="container" id="signContainerInner" style="display: none">
                                <img src="/public/img/visual_cue_background.png" class="cue-image">
                                <img id="cue_arrow" src="/public/img/pointer_adjusted.png"class="cue-overlay">
                            </div>
                        </div>
                    </td>
                    <TD class="leftColumnCell" id="c0Container" >
                        <DIV ID="c0_cont" style="position: relative; height: 50px; width: 100px;">
                            <DIV ID="c0_txt"
                                 STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1; visib">
                                <TABLE>
                                    <TD ID="c0_td" align=center valign=center width=95 height=45 class="actTD">
                                        sure_gain_inner
                                    </TD>
                                </TABLE>
                            </DIV>
                            <DIV ID="c0_box"
                                 STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;">
                                <TABLE>
                                    <TD ID="c0_tdbox" align=center valign=center width=95 height=45 class="boxTD">sure
                                        gain
                                    </TD>
                                </TABLE>
                            </DIV>
                            <DIV ID="c0_img"
                                 STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;">
                                <A
                                        HREF="javascript:void(0);" NAME="c0" onMouseOver="ShowCont('c0',event)"
                                        onMouseOut="HideCont('c0',event)"><IMG NAME="c0"
                                                                               SRC="/resources/library/mlwebphp_100beta/transp.gif"
                                                                               border=0 width=100
                                                                               height=50></A></DIV>
                        </DIV>
                    </TD>
                    <!--end cell-->
                    <!--cell c1(tag:c1)-->
                    <TD class="rightColumnCell" id="c1Container">
                        <DIV ID="c1_cont" style="position: relative; height: 50px; width: 100px;">
                            <DIV ID="c1_txt"
                                 STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1;">
                                <TABLE>
                                    <TD ID="c1_td" align=center valign=center width=95 height=45 class="actTD">
                                        EV_risky_inner
                                    </TD>
                                </TABLE>
                            </DIV>
                            <DIV ID="c1_box"
                                 STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;">
                                <TABLE>
                                    <TD ID="c1_tdbox" align=center valign=center width=95 height=45 class="boxTD">EV
                                        risky
                                    </TD>
                                </TABLE>
                            </DIV>
                            <DIV ID="c1_img"
                                 STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;">
                                <A
                                        HREF="javascript:void(0);" NAME="c1" onMouseOver="ShowCont('c1',event)"
                                        onMouseOut="HideCont('c1',event)"><IMG NAME="c1"
                                                                               SRC="/resources/library/mlwebphp_100beta/transp.gif"
                                                                               border=0 width=100
                                                                               height=50></A></DIV>
                        </DIV>
                    </TD>
                    <!--end cell--></TR>
            </TABLE>

        </div>
    </div>
    <!-- END MOUSELAB TABLE -->
    <!--BEGIN postHTML-->

    <!--END postHTML-->
    <!--    <INPUT type="submit" value="Next Page" onClick=timefunction('submit','submit','submit')></FORM>-->
</body>
</html>