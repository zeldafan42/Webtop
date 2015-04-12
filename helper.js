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

function crop(image)
{
	$("#popupContent").html("<img id='imageToCrop' src='uploads/" + image + "'/>");
	$("#popupContent").append("<div id='crop'></div>");
	$("#popupContent").css("overflow","scroll");
	$("#popupContent").css("position","relative");
	$("#imageToCrop").css("float","none");
	$("#crop").css("position","absolute");
	$("#crop").css("background-color","rgba(255,0,0,0.5)");
	$("#crop").css("width","100px");
	$("#crop").css("height","100px");
	$("#crop").css("top","10px");
	$("#crop").css("left","10px");
	$("#crop").resizable({handles: "all", containment:"parent", stop:function(event, ui){cropLink(image)});
	
}

function cropLink(image)
{
	imagewidth = parseInt($("#imageToCrop").css("width"));
	alert(imagewidth);

	/*imageheight = $("#imageToCrop").css("height");
	imageheight = imagewidth.substring(0, str.Length - 2);
	
	cropLeft = $("#crop").css("left");
	cropLeft = cropLeft.substring(0, str.Length - 2);
	cropTop = $("#crop").css("left");
	cropTop = cropLeft.substring(0, str.Length - 2);
	
	
	
	$("#crop").html("<a href='index.php?cropImg=" + image + "&" )*/
}