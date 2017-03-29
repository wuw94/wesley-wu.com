function HamburgerButtonToggle()
{
	var x = document.getElementById("navbar_id");
    if (x.className === "navbar")
    {
        x.className += " toggled_on";
    }
    else if (x.className === "navbar toggled_on")
    {
        x.className = "navbar";
    }

    else if (x.className === "navbar_title")
    {
    	x.className += " toggled_on";
    }
    else if (x.className === "navbar_title toggled_on")
    {
    	x.className = "navbar_title";
    }
}