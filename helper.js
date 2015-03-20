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