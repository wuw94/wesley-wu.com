// get the value of the bottom of the #main element by adding the offset of that element plus its height, set it as a variable
var mainbottom = $("#navbar-id").offset().top + $("#navbar-id").height();

function HamburgerButtonToggle()
{
	var x = document.getElementById("navbar-id");

    if (!HasClass(x, "toggled-on"))
    {
        x.className = AddClass(x, "toggled-on");
    }
    else
    {
        x.className = RemoveClass(x, "toggled-on");
    }
}

function HasClass(element, cls)
{
    return (" " + element.className + " ").indexOf(" " + cls + " ") > -1;
}

function AddClass (element, cls)
{
    return element.className += (" " + cls);
}

function RemoveClass(element, cls)
{
    if (HasClass(element, cls))
    {
        var index = (" " + element.className + " ").indexOf(" " + cls + " ");
        return element.className.substr(0, index - 1) + element.className.substr(index + cls.length, element.length);
    }
    return "INVALIDCLASS";
}