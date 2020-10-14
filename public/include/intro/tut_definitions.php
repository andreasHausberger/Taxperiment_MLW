<div class="siteContainer">

    <!--
        Anmerkung: Die Inhalte in den Containern mit den ids 'explanationCondition1' usw. werden nur für die jeweilige Condition angezeigt.
        Bitte überprüfen, ob auf den Testrechnern Javascript aktiviert ist (sollte eig. schon der Fall sein), sonst bleibt diese Seite leer.
      -->


    <div class="contentContainer">
        <div id="explanationCondition1" style="display: none">
            <embed class="svgContainer" src="/public/img/svg/Cond1/Con1-01.svg" id="svgContainer1" alt="SVG mit img Tag laden" height="575">

            <button class="definitionButton" onclick="getNextImage()" id="definitionButton1"> Next</button>

        </div>

        <div id="explanationCondition2" style="display: none">
            <embed class="svgContainer" src="/public/img/svg/Cond2/Con2-01.svg" id="svgContainer2" alt="SVG mit img Tag laden" height="575">

            <button class="definitionButton" onclick="getNextImage()" id="definitionButton2"> Next</button>

        </div>

        <div id="explanationCondition3" style="display: none">
            <embed class="svgContainer" src="/public/img/svg/Cond3/Con3-01.svg" id="svgContainer3" alt="SVG mit img Tag laden" height="575">

            <button class="definitionButton" onclick="getNextImage()" id="definitionButton3"> Next</button>

        </div>

        <div id="explanationCondition4" style="display: none">
            <embed class="svgContainer" src="/public/img/svg/Cond4/Con4-01.svg" id="svgContainer4" alt="SVG mit img Tag laden" height="575">

            <button class="definitionButton" onclick="getNextImage()" id="definitionButton4"> Next</button>

        </div>
        
        <?php
        $condition = $_GET['condition'];
        $subjectName = $_GET['sname'];
        $page = $_GET['page'];

        if (!isset($condition) || $condition <= 0) {
            echo "WARNING: COULD NOT READ CONDITION!";
            die;
        }

//        if ($condition == 4) {
//            $nextPage = intval($page) + 1;
//
//            $host = $_SERVER['HTTP_HOST'];
//            $url = $host . '/public/include/intro/index.php?condition=' . $condition . '&sname=' . $subjectName . '&page=' . $nextPage;
//
//            $ch = curl_init();
//
//            curl_setopt($ch, CURLOPT_URL, $url);
//            curl_setopt($ch, CURLOPT_HEADER, 0);
//
//            curl_exec($ch);
//
//            curl_close($ch);
//        }

        ?>

    </div>

    <script>
        let condition = <?php echo $condition ?>;
        let value = 1;
        let definitionLimit = 0;
        $(document).ready(function() {
            switch (condition) {
                case 1:
                    document.getElementById('explanationCondition1').style.display = "block";
                    definitionLimit = 22;
                    break;
                case 2:
                    document.getElementById('explanationCondition2').style.display = "block";
                    definitionLimit = 22;
                    break;
                case 3:
                    document.getElementById('explanationCondition3').style.display = "block";
                    definitionLimit = 22;
                    break;
                case 4:
                    document.getElementById('explanationCondition4').style.display = "block";
                    definitionLimit = 13;
                    break;
                default:
                    break;
            }

            checkLimit(value);
        });


            function getNextImage() {
                let newValue = value + 1;
                let zeroString = newValue < 10 ? "0" : "";
                let suffix = "-" + zeroString + newValue + ".svg";
                let newSrc = "/public/img/svg/Cond" + condition + "/Con" + condition + suffix;

                let container = document.getElementById("svgContainer" + condition);
                let clone = container.cloneNode(true);

                clone.setAttribute('src', newSrc);
                container.parentNode.replaceChild(clone, container);

                value = newValue;
                checkLimit(value);
            }

            function checkLimit(currentIndex) {
                let limit = definitionLimit;
                let pageButton = document.getElementById("continueButton");
                let definitionButton = document.getElementById("definitionButton" + condition);
                if (currentIndex <= definitionLimit) {
                    pageButton.style.display = 'none';
                }
                else {
                    definitionButton.style.display = 'none';
                    pageButton.style.display = 'block';
                }
            }

    </script>
</div>