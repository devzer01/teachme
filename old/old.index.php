<?php
/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 16/5/2560
 * Time: 15:53 น.
 */
?>


<html>

<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<form method="POST" action="/post.php">
    <div class="form-group">
        <label for="formGroupExampleInput">Word</label>
        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input">
    </div>
    <div class="form-group">
        <button>Search</button>
    </div>
</form>
<!--<div id="3dbase" class="jumbotron" style="height: 500px;">
    <div class="col-md-12"><h3>Sentence</h3>(Context based)</div>
    <div class="col-md-12">
        <div class="col-md-2">
            <h1>ไก่</h1>
        </div>
        <div class="col-md-2">
            <img src="chicken.jpg" width="100" height="100" style="display: none;" id="picture">
        </div>
        <div class="col-md-2">
            <canvas id="display" style="width: 200px; height: 200px;">

            </canvas>
        </div>
        <div class=col-md-2>
            <audio controls>
                <source src="gai.ogg" type="audio/ogg">
                Your browser does not support the audio element.
            </audio>
            <img src="open_waveform.png" width="100" height="100" id="picture">
        </div>
        <div class="col-md-2">

        </div>
    </div>
    <div class="col-md-12" style="text-align: center;">
        <a class="btn btn-primary btn-lg" href="#" role="button" id="more">Next</a>
    </div>
    <div class="col-md-4"><h3>Scientific -> Animal</h3></div>
    <div class="col-md-4"><h3>Concept -> Animal</h3></div>
    <div class="col-md-4"><h3>Social Feeling Type: Self Reflection (Fearing)</h3></div>
</div>
-->
<div id="simple" class="jumbotron" style="height: 500px;">
    <div class="col-md-12"><h3>Chicken</h3></div>
    <div class="col-md-12">
        <div class="col-md-2">
            <h1>ไก่</h1>
        </div>
        <div class="col-md-2">
            <img src="chicken.jpg" width="100" height="100" id="picture">
        </div>
        <div class="col-md-2">
            <canvas id="display" style="width: 200px; height: 200px;">

            </canvas>
        </div>
        <div class=col-md-2>
            <audio controls>
                <source src="gai.ogg" type="audio/ogg">
                <!--<source src="horse.mp3" type="audio/mpeg">-->
                Your browser does not support the audio element.
            </audio>
            <img src="open_waveform.png" width="100" height="100" id="picture">
        </div>
        <div class="col-md-2">

        </div>
    </div>
    <div class="col-md-4"><h3>Scientific -> Animal</h3></div>
    <div class="col-md-4"><h3>Concept -> Animal</h3></div>
    <div class="col-md-4"><h3>Social Feeling Type: Self Reflection (Fearing)</h3></div>
    <div class="col-md-4"><h3>Usage 12 Documents, FDR 1996-12-01 </h3></div>
</div>
--><!--//state -> paranoia
//confusion -> when an action is blocked by two intents of an extreme belief (conflicting beliefs) causing fear of judgement.
//(when experienced at higher levels of concesounous can lead to effects considered beyond the state of HumanEv1
//personal
//bound to geographic area (politcal vs land area)
//
//-->
<div id="secondary" class="jumbotron" style="height: 300px; display: none;">
    <div class="col-md-12"><h3>Mother</h3></div>
    <div class="col-md-12">
        <div class="col-md-2">
            <h1>แม่</h1>
        </div>
        <div class="col-md-2">
            <a class="btn btn-primary btn-lg" href="#" role="button" id="more">Upload picture</a>
        </div>
        <div class="col-md-2">
            <canvas id="display" style="width: 200px; height: 200px;">

            </canvas>
        </div>
        <div class=col-md-6>
            &nbsp;
        </div>
    </div>
</div>
<div id="pure" class="jumbotron" style="height: 500px; display: none;">
    <div class="col-md-12"><h3>Love</h3></div>
    <div class="col-md-12">
        <div class="col-md-2">
            <h1>ความรัก่</h1>
        </div>
        <div class="col-md-2">
            Symbol is based on To Be Determined
        </div>
        <div class="col-md-2">
            <canvas id="display" style="width: 200px; height: 200px;">

            </canvas>
        </div>
        <div class=col-md-2>
            <audio controls>
                <source src="love.ogg" type="audio/ogg">
                <!--<source src="horse.mp3" type="audio/mpeg">-->
                Your browser does not support the audio element.
            </audio>
            <img src="open_waveform.png" width="100" height="100" id="picture">
        </div>
        <div class="col-md-2">

        </div>
    </div>
    <div class="col-md-12" style="text-align: center; display: none;">
        <a class="btn btn-primary btn-lg" href="#" role="button" id="more">Next</a>
    </div>
    <div class="col-md-12"><h3>Type: Feeling (Natural) To be used in self healing</h3></div>
    <div class="col-md-12"><h3></h3></div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="application/javascript">

    var context = null;

    $(document).ready(function () {

        var  gaiPath = [
                {x: 0, y: 0},
                {x: 0, y: 100},

            ];

        $("#more").click(
           function (e) {
                $("#picture").css('display', 'block');
           }
       );

        var canvas = document.getElementById('display');
        context = canvas.getContext('2d');


        gawGai();

    });

    var progress = 0;
    var px = Math.PI / 1000 * 20;
    var jx = 1;
    var x = 0, y = 130;
    var lined;

    function gawGai() {

            //1/3 circle
            //down

            drawLine(0, 0, 20, 10, 29);
            drawLine(20, 10, 0, 20, 29);
            //drawLine(30, 25, 21, 30, 29);
            //comeback slant 0,, 20, 225
            //down

    }


    function drawLine(x1, y1, x2, y2, ani) {

        var cx = x1, cy = y1;

        lined = setInterval(function () {
            context.beginPath();
            context.arc(cy, cx, 1, 0, 2*Math.PI, false);
            context.stroke();

            if (x2 >= x1 && cx < x2) {
                cx += 1;
            } else if (x2 < x1 && cx > x2) {
                cx -= 1;
            }

            if (y2 >= y1 && cy < y2) {
                cy += 1;
            } else if (y2 < y1 && cy < y2) {
                cy -= 1;
            }

            if (cy > y2 && cx > x2) clearInterval(lined);
        }, ani);



        /*setInterval(function () {
         context.beginPath();
         context.arc(x,y,3,0,2*Math.PI);
         context.stroke();
         if (y % 2 === 0) x++;
         y++;
         });*/
    }

    function drawLine2(x1, y1, x2, y2, ani) {

        var cx = x1, cy = y1;

        var iy = 10;
        var ix = 10;

        lined = setInterval(function () {
            context.beginPath();
            console.log(cx);
            context.arc(cy,cx,1,0,2*Math.PI);
            context.stroke();

            if (cy >= y2 && cx >= x2) {
                clearInterval(lined);
            } else {
                cy += iy;
                cx += ix;
            }

        }, ani);



        /*setInterval(function () {
         context.beginPath();
         context.arc(x,y,3,0,2*Math.PI);
         context.stroke();
         if (y % 2 === 0) x++;
         y++;
         });*/
    }


</script>

</body>


</html>
