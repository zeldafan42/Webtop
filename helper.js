function savePosition(element)
{
	var id = element.id;
	var style = element.style;
	var height = style.height;
	var top = style.top;
	var bottom = style.bottom;
	var left = style.left;
	var right = style.right;
	var width = style.width;
	$.get("positionHandler.php", {id: id, top: top, bottom: bottom, left: left, right: right, width: width, height: height});
}

function hideCmds(myElement)
{
	myElement.find(".fotoCmds").css("visibility", "hidden");

}

function showCmds(myElement)
{
	myElement.find(".fotoCmds").css("visibility", "visible");

}

/*
var drawing=false;
var x = 0;
var y = 0;
var x2 = 0;
var y2 = 0;


function loadCanvas(imgfile)
{
    var canvas = document.getElementById('myCanvas');
    var context = canvas.getContext('2d');

    // load image from data url
    var imageObj = new Image();
    imageObj.onload = function()
    {
      context.drawImage(this, 0, 0);
    };

    imageObj.src = 'localhost/Webtop/Webtop/uploads/thumbs/'+imgfile+'';
}

function startDrawing(evt)
{
	drawing = true;
	
	x  = (evt.clientX || evt.pageX);//  - board.offsetLeft;
    y = (evt.clientY || evt.pageY);// - board.offsetTop;

}

function stopDrawing()
{
	drawing = false;
	var board= document.getElementById("board");
    var context = board.getContext("2d");
	context.strokeStyle = "#FF0000";
	context.lineWidth = 2;
	context.strokeRect(x,y,x2-x,y2-y);
}


function draw(evt)
{
    
    if(drawing)
    {
        var board= document.getElementById("board");
        var context = board.getContext("2d");
        context.strokeStyle = "#FF0000";
        x2  = (evt.clientX || evt.pageX);//  - board.offsetLeft;
        y2 = (evt.clientY || evt.pageY);// - board.offsetTop;

    }
    
    
}
    */
        