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
	$.post
	(
			"positionHandler.php",
			{id: id, top: top, bottom: bottom, left: left, right: right, width: width, height: height},
			function(data){
				$('#posResult').html(data);
				}
	);
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
	$("#popupContent").html("<div id='imageToCrop'></div>")
	$("#imageToCrop").html("<img id='cropImage' src='uploads/" + image + "'/>");
	$("#imageToCrop").append("<div id='crop'></div>");
	$("#imageToCrop").css("display","inline-block");
	$("#imageToCrop").css("line-height","0px");
	$("#imageToCrop").css("overflow","hidden");
	$("#imageToCrop").css("position","absolute");
	$("#popupContent").css("overflow","scroll");
	$("#popupContent").css("position","relative");
	$("#cropImage").css("float","none");
	$("#crop").css("position","absolute");
	$("#crop").css("line-height","normal");
	$("#crop").css("background-color","rgba(255,0,0,0.5)");
	$("#crop").css("width","100px");
	$("#crop").css("height","100px");
	$("#crop").css("top","10px");
	$("#crop").css("left","10px");
	$("#crop").append("<p id='croplink'></p>")
	$("#crop").resizable
	(
		{
			handles: "all", 
			containment:"parent", 
			stop: function(event, ui)
			{
				cropLink(image);
			}
		}
	);
	
}

function cropLink(image)
{
	imageWidth = parseInt($("#cropImage").css("width"));
	imageHeight = parseInt($("#cropImage").css("height"));
	cropLeft = parseInt($("#crop").css("left"));
	cropTop = parseInt($("#crop").css("top"));	
	cropWidth = parseInt($("#crop").css("width"));
	cropHeight = parseInt($("#crop").css("height"));
	
	
	if(imageWidth >= (cropLeft + cropWidth) && imageHeight >= (cropTop + cropHeight))
	{
		$("#croplink").html("<a href='index.php?cropImg=" + image + "&cropLeft=" + cropLeft + "&cropTop=" + cropTop + "&cropWidth=" + cropWidth +"&cropHeight=" + cropHeight + "'>Crop picture</a>");
	}
	else
	{
		alert("Selection too big");
	}
}