$(document).ready(function()
{
	var scroll_start = 0;
	var startchange = $('.navbar');
	var offset = startchange.offset();
	$(document).scroll(function()
	{
		var x = document.getElementById("navbar-id");

	    if (HasClass(x, "toggled-on"))
	    {
	        //x.className = x.className.substr(0, x.className.length - 11);
	    }
		scroll_start = $(this).scrollTop();
		if(scroll_start > offset.top)
		{
			$("*").addClass("past-main");
		}
		else
		{
			$("*").removeClass("past-main");
		}
	});
});