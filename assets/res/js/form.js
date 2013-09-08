var themen = [];

function toggleTextbox (element, title) {
	var themaId = $(element).attr('id');
	//case 1: thema bereits gewählt --> lösche Textbox
	if ($(element).hasClass ("active")) {
   		$("#" + themaId + "Panel").remove();
   		themen.pop(themaId);
	}
	else
	{
		if ($.inArray(themaId, themen) == -1)
		{
			themen.push(themaId);
			$("#themen").append("<div class=\"panel panel-info\" id=\"" + themaId + "Panel\"><div class=\"panel-heading\">" + title + "</div><div class=\"panel-body\"><input type=\"hidden\" name=\"themaID" + themen.length +"\" value=\"" + themaId + "\"><textarea class=\"form-control\" rows=\"3\" name=\"themaReason" + themen.length +"\"></textarea></div></div>");
		}
	}
}