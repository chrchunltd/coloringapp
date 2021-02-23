<?php

require_once "mdetect/Mobile_Detect.php";
$detect = new Mobile_Detect;


$which = 1;


$max = 4; // ADJUST TO TOTAL NUMBER OF PAGES


if(!empty($_REQUEST['which'])) { 

	$which = $_REQUEST['which'];

        // IF/ELSE LIST OF PAGES
	
	if($which == 1) {
    		$page = "transparent/coloring_page_01.png"; // TRANSPARENT COLORING PAGE
     		$download = "pdf/coloring_page_01.pdf"; // DOWNLOADABLE PDF, EXCLUDE THIS LINE TO REMOVE DOWNLOAD BUTTON
    	}  else if($which == 2) {
    		$page = "transparent/coloring_page_02.png";
     		$download = "pdf/coloring_page_02.pdf";
    	}  else if($which == 3) {
    		$page = "transparent/coloring_page_03.png";
     		$download = "pdf/coloring_page_03.pdf";
    	}  else if($which == 4) {
    		$page = "transparent/coloring_page_04.png";
     		$download = "pdf/coloring_page_04.pdf";
    	}
    
} else {

	// DEFAULT COLORING PAGE
        
        $which = $max;

    	$page = "transparent/coloring_page_04.png";
     	$download = "pdf/coloring_page_04.pdf";
}



if( $detect->isMobile() && !$detect->isTablet() ){
	$width = 300;
    $height = 395;
} else if( $detect->isTablet() ){
	$width = 600;
    $height = 790;
} else {
	$width = 650;
    $height = 856;
}

?>



<!DOCTYPE html>

<head>
	<title>Coloring App</title>

<meta name="viewport" content="width=device-width, initial-scale=1" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<style type="text/css" media="screen">

html, body { margin: 0; padding: 0; }

.options-contain {
    position: fixed;
    background-color: #FFF;
    width: 100%;
    bottom: 0;
    box-sizing: border-box;
    padding: 10px;
    text-align: center;
    z-index: 10;
}



.option {
    <?php if( $detect->isMobile() && !$detect->isTablet() ){ ?> width: 40px; <?php } else { ?> width: 50px; <?php } ?> 
    <?php if( $detect->isMobile() && !$detect->isTablet() ){ ?> height: 40px; <?php } else { ?> height: 50px; <?php } ?> 
    display: inline-block;
    <?php if( $detect->isMobile() && !$detect->isTablet() ){ ?> margin: 2px; <?php } else { ?> margin: 5px; <?php } ?> 
    border-radius: 10px;
    background-color: #2d2d2d;
    border: 1px solid #ccc;
    box-sizing: border-box;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    cursor: pointer;
}

.coloring-contain {



	width: <?php echo $width; ?>px;
    height: <?php echo $height; ?>px;
    position: relative;
    margin-bottom: 200px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    margin-left: auto;
    margin-right: auto;
    margin-top: 34px;
}

.selected { border: 3px solid #000; }

.outline-foreground {
	position: absolute; 
    top:0; 
    left:0; 
    right: 0; 
    bottom: 0; 
    background-position: center; 
    background-repeat: no-repeat; 
    z-index: 5; 
    pointer-events: none; 
    background-size: 100% 100%;
}

.canvasDiv {
	width: 100%;
    height: 100%;
	position: absolute;
}

</style>


</head>

<body>


<div class="options-contain">


<!-- DEFINE COLORS BELOW -->

<div class="option color-tool color-switch" data-color="#FFF" style="background-color: #FFF;"></div>
<div class="option color-tool color-switch selected" data-color="#8e53a1" style="background-color: #8e53a1;"></div>
<div class="option color-tool color-switch" data-color="#169e49" style="background-color: #169e49;"></div>
<div class="option color-tool color-switch" data-color="#2d2d2d" style="background-color: #2d2d2d;"></div>
<div class="option color-tool color-switch" data-color="#3c75bb" style="background-color: #3c75bb;"></div>
<div class="option color-tool color-switch" data-color="#f16a2d" style="background-color: #f16a2d;"></div>
<div class="option color-tool color-switch" data-color="#ec2527" style="background-color: #ec2527;"></div>
<div class="option color-tool color-switch" data-color="#ad732a" style="background-color: #ad732a;"></div>
<div class="option color-tool color-switch" data-color="#f7ed45" style="background-color: #f7ed45;"></div>
<div class="option color-tool color-switch" data-color="#f4dfc7" style="background-color: #f4dfc7;"></div>
<div class="option color-tool eraser" onclick="curTool = 'eraser'" style="background-color: #FFF; background-image: url('images/eraser.png');"></div>
<div class="option pen-tool pen-size selected" onclick="curSize = 'normal'" style="background-color: #FFF; background-image: url('images/pen-small.png');"></div>
<div class="option pen-tool pen-size" onclick="curSize = 'large'" style="background-color: #FFF; background-image: url('images/pen-medium.png');"></div>
<div class="option pen-tool pen-size" onclick="curSize = 'huge'" style="background-color: #FFF; background-image: url('images/pen-large.png');"></div>
<div class="option redraw" style="background-image: url('images/redraw.jpg');"></div>
<?php if($which != 1) { ?><a href="index.php?which=<?php echo ($which-1); ?>"><div class="option next" style="background-image: url('images/coloring_previous.jpg');"></div></a><?php } ?>
<?php if($which != $max) { ?><a href="index.php?which=<?php echo ($which+1); ?>"><div class="option prev" style="background-image: url('images/coloring_next.jpg');"></div></a><?php } ?>
<?php if($download) { ?><a target="_blank" download href="<?php echo $download; ?>"><div class="option download" style="background-color: #FFF; background-image: url('images/download_page.png');"></div></a><?php } ?>


</div>


<div class="coloring-contain" style="position: relative;">
<div class="outline-foreground" style="background-image: url('<?php echo $page; ?>');"></div>
<div id="canvasDiv" style="position: absolute; left:0; top: 0; width: 100%; height: 100%;"></div>

</div>

<script type="text/javascript">

var canvasWidth=<?php echo $width; ?>;
var canvasHeight=<?php echo $height; ?>;

var clickTool = new Array();
var curTool = "paint";

var paint=false;
var radius;

var clickSize = new Array();
var curSize = "normal";

var curColor = "#8e53a1";
var clickColor = new Array();

var canvasDiv = document.getElementById('canvasDiv');
canvas = document.createElement('canvas');
canvas.setAttribute('width', canvasWidth);
canvas.setAttribute('height', canvasHeight);
canvas.setAttribute('id', 'canvas');
canvasDiv.appendChild(canvas);
if(typeof G_vmlCanvasManager != 'undefined') {
	canvas = G_vmlCanvasManager.initElement(canvas);
}
context = canvas.getContext("2d");



$('#canvas').mousedown(function(e){
  var mouseX = e.pageX - this.offsetLeft;
  var mouseY = e.pageY - this.offsetTop;
		
  paint = true;
  addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop);
  redraw();
});



$('#canvas').mousemove(function(e){
  if(paint){
    addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
    redraw();
  }
});


$('#canvas').mouseup(function(e){
  paint = false;
});

$('#canvas').mouseleave(function(e){
  paint = false;
});



var clickX = new Array();
var clickY = new Array();
var clickDrag = new Array();


function addClick(x, y, dragging)
{
  clickX.push(x-$(".coloring-contain").offset().left);
  clickY.push(y-$(".coloring-contain").offset().top);
  clickDrag.push(dragging);
  if(curTool == "eraser"){
    clickColor.push("#FFF");
  }else{
    clickColor.push(curColor);
  }
  clickSize.push(curSize);
}




function redraw(){
  context.clearRect(0, 0, context.canvas.width, context.canvas.height); // Clears the canvas
  
  /* context.strokeStyle = "#df4b26"; */
  context.lineJoin = "round";
  /* context.lineWidth = 5; */
			
  for(var i=0; i < clickX.length; i++) {		
    context.beginPath();
    if(clickDrag[i] && i){
      context.moveTo(clickX[i-1], clickY[i-1]);
     }else{
       context.moveTo(clickX[i]-1, clickY[i]);
     }
     context.lineTo(clickX[i], clickY[i]);
     context.closePath();
     context.strokeStyle = clickColor[i];
     var radius;
     
     if(clickSize[i] == "small"){
			radius = 2;
		}else if(clickSize[i] == "normal"){
			radius = 5;
		}else if(clickSize[i] == "large"){
			radius = 10;
		}else if(clickSize[i] == "huge"){
			radius = 20;
		}else{
			alert("Error: Radius is zero for click " + i);
			radius = 0;	
		}
     
     context.lineWidth = radius;
     context.stroke();
  }
}


$(".redraw").click(function() { location.reload(); });


$(".color-switch").click(function() { curTool = "paint"; curColor = $(this).data('color'); });

$(".color-tool").click(function() { $(".color-tool").removeClass("selected"); $(this).addClass("selected"); });

$(".pen-tool").click(function() { $(".pen-tool").removeClass("selected"); $(this).addClass("selected"); });


function touchHandler(event)
{
    var touches = event.changedTouches,
        first = touches[0],
        type = "";
    switch(event.type)
    {
        case "touchstart": type = "mousedown"; break;
        case "touchmove":  type = "mousemove"; break;        
        case "touchend":   type = "mouseup";   break;
        default:           return;
    }

    // initMouseEvent(type, canBubble, cancelable, view, clickCount, 
    //                screenX, screenY, clientX, clientY, ctrlKey, 
    //                altKey, shiftKey, metaKey, button, relatedTarget);

    var simulatedEvent = document.createEvent("MouseEvent");
    simulatedEvent.initMouseEvent(type, true, true, window, 1, 
                                  first.screenX, first.screenY, 
                                  first.clientX, first.clientY, false, 
                                  false, false, false, 0/*left*/, null);

    first.target.dispatchEvent(simulatedEvent);
    event.preventDefault();
}


function init() {
    document.getElementById('canvas').addEventListener("touchstart", touchHandler, true);
    document.getElementById('canvas').addEventListener("touchmove", touchHandler, true);
    document.getElementById('canvas').addEventListener("touchend", touchHandler, true);
    document.getElementById('canvas').addEventListener("touchcancel", touchHandler, true);
}

init();

</script>


</body>

</html>