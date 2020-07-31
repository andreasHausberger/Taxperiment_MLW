<?php
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
        + "b0^b1";


    let taxRate = "Tax (" +  <?php echo $taxRate*100 ?> + "%): " + <?php echo $mostRecentScore*$taxRate; ?> + " ECU " + "^";
    let auditProbability = <?php echo $auditProbability*100 ?> + "% chance" +  "^";
    let fineRate = "Payback + " +  <?php echo $fineRate ?> + "%" + "`";
    let income =  <?php echo $mostRecentScore ?> + " ECU";

    txt = auditProbability + fineRate + taxRate + income;

    console.log(txt);

    state = "1^1`"
        + "1^1";

    box = "Audit Probability^Fine`"
        + "Tax Due^Income";

    CBCol = "0^0";
    CBRow = "0^0";
    W_Col = "250^250";
    H_Row = "80^80";

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

    //Delay: a0 a1 b0 b1
    delay = "0^0^0^0`"
        + "0^0^0^0`"
        + "0^0^0^0`"
        + "0^0^0^0";
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

$saveURL = "/resources/library/mlwebphp_100beta/save.php?condition=$condition&feedback=$feedback&order=$order&presentation=$presentation";


?>


<FORM name="mlwebform" onSubmit="return checkForm(this)" method="POST"
      action=<?php echo $saveURL?>><INPUT type=hidden name="procdata" value="">
    <input type=hidden name="subject" value="">
    <input type="hidden" id="tax" name="tax" value=<?php echo $mostRecentScore?>>
    <input type="hidden" id="reported_tax" name="reported_tax">
    <input type="hidden" id="actual_income" name="actual_income">
    <input type="hidden" id="net_income" name="net_income">
    <input type="hidden" id="wasAudited" name="wasAudited" >
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
    <!--BEGIN preHTML-->

    <!--END preHTML-->
    <!-- MOUSELAB TABLE -->
    <TABLE border=1>
        <TR>
            <!--cell a0(tag:a0)-->
            <TD align=center valign=middle>
                <DIV ID="a0_cont" style="position: relative; height: 50px; width: 200px;">
                    <DIV ID="a0_txt"
                         STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 200px; clip: rect(0px 200px 50px 0px); z-index: 1;">
                        <TABLE>
                            <TD ID="a0_td" align=center valign=center width=195 height=45 class="actTD">
                                $auditProbability
                            </TD>
                        </TABLE>
                    </DIV>
                    <DIV ID="a0_box"
                         STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 200px; clip: rect(0px 200px 50px 0px); z-index: 2;">
                        <TABLE>
                            <TD ID="a0_tdbox" align=center valign=center width=195 height=45 class="boxTD"></TD>
                        </TABLE>
                    </DIV>
                    <DIV ID="a0_img"
                         STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 200px; z-index: 5;"><A
                                HREF="javascript:void(0);" NAME="a0" onMouseOver="ShowCont('a0',event)"
                                onMouseOut="HideCont('a0',event)"><IMG NAME="a0" SRC="/resources/library/mlwebphp_100beta/transp.gif" border=0 width=200
                                                                       height=50></A></DIV>
                </DIV>
            </TD>
            <!--end cell-->
            <!--cell a1(tag:a1)-->
            <TD align=center valign=middle>
                <DIV ID="a1_cont" style="position: relative; height: 50px; width: 200px;">
                    <DIV ID="a1_txt"
                         STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 200px; clip: rect(0px 200px 50px 0px); z-index: 1;">
                        <TABLE>
                            <TD ID="a1_td" align=center valign=center width=195 height=45 class="actTD">$fineRate</TD>
                        </TABLE>
                    </DIV>
                    <DIV ID="a1_box"
                         STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 200px; clip: rect(0px 200px 50px 0px); z-index: 2;">
                        <TABLE>
                            <TD ID="a1_tdbox" align=center valign=center width=195 height=45 class="boxTD"></TD>
                        </TABLE>
                    </DIV>
                    <DIV ID="a1_img"
                         STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 200px; z-index: 5;"><A
                                HREF="javascript:void(0);" NAME="a1" onMouseOver="ShowCont('a1',event)"
                                onMouseOut="HideCont('a1',event)"><IMG NAME="a1" SRC="/resources/library/mlwebphp_100beta/transp.gif" border=0 width=200
                                                                       height=50></A></DIV>
                </DIV>
            </TD>
            <!--end cell--></TR>
        <TR>
            <!--cell b0(tag:b0)-->
            <TD align=center valign=middle>
                <DIV ID="b0_cont" style="position: relative; height: 50px; width: 200px;">
                    <DIV ID="b0_txt"
                         STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 200px; clip: rect(0px 200px 50px 0px); z-index: 1;">
                        <TABLE>
                            <TD ID="b0_td" align=center valign=center width=195 height=45 class="actTD">$taxRate</TD>
                        </TABLE>
                    </DIV>
                    <DIV ID="b0_box"
                         STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 200px; clip: rect(0px 200px 50px 0px); z-index: 2;">
                        <TABLE>
                            <TD ID="b0_tdbox" align=center valign=center width=195 height=45 class="boxTD"></TD>
                        </TABLE>
                    </DIV>
                    <DIV ID="b0_img"
                         STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 200px; z-index: 5;"><A
                                HREF="javascript:void(0);" NAME="b0" onMouseOver="ShowCont('b0',event)"
                                onMouseOut="HideCont('b0',event)"><IMG NAME="b0" SRC="/resources/library/mlwebphp_100beta/transp.gif" border=0 width=200
                                                                       height=50></A></DIV>
                </DIV>
            </TD>
            <!--end cell-->
            <!--cell b1(tag:b1)-->
            <TD align=center valign=middle>
                <DIV ID="b1_cont" style="position: relative; height: 50px; width: 200px;">
                    <DIV ID="b1_txt"
                         STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 200px; clip: rect(0px 200px 50px 0px); z-index: 1;">
                        <TABLE>
                            <TD ID="b1_td" align=center valign=center width=195 height=45 class="actTD"><?php echo "hello" ?></TD>
                        </TABLE>
                    </DIV>
                    <DIV ID="b1_box"
                         STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 200px; clip: rect(0px 200px 50px 0px); z-index: 2;">
                        <TABLE>
                            <TD ID="b1_tdbox" align=center valign=center width=195 height=45 class="boxTD"></TD>
                        </TABLE>
                    </DIV>
                    <DIV ID="b1_img"
                         STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 200px; z-index: 5;"><A
                                HREF="javascript:void(0);" NAME="b1" onMouseOver="ShowCont('b1',event)"
                                onMouseOut="HideCont('b1',event)"><IMG NAME="b1" SRC="/resources/library/mlwebphp_100beta/transp.gif" border=0 width=200
                                                                       height=50></A></DIV>
                </DIV>
            </TD>
            <!--end cell--></TR>
    </TABLE>
    <!-- END MOUSELAB TABLE -->
    <!--BEGIN postHTML-->

    <!--END postHTML-->
<!--    <INPUT type="submit" value="Next Page" onClick=timefunction('submit','submit','submit')></FORM>-->
</body>
</html>
