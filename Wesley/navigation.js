// get the value of the bottom of the #main element by adding the offset of that element plus its height, set it as a variable
var mainbottom = $("#navbar-id").offset().top + $("#navbar-id").height();

function HamburgerButtonToggle()
{
	var x = document.getElementById("navbar-id");

    if (HasClass(x, "toggled-on"))
    {
        x.className = x.className.substr(0, x.className.length - 11);
    }
    else
    {
        x.className += " toggled-on";
    }
}

function HasClass(element, cls)
{
    return (" " + element.className + " ").indexOf(" " + cls + " ") > -1;
}