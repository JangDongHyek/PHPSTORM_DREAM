﻿var yoxviewPath = getYoxviewPath();
var cssLink = top.document.createElement("link");
cssLink.setAttribute("rel", "Stylesheet");
cssLink.setAttribute("type", "text/css");
cssLink.setAttribute("href", yoxviewPath + "yoxview.css");
top.document.getElementsByTagName("head")[0].appendChild(cssLink);

function LoadScript(url)
{
	document.write( '<script type="text/javascript" src="' + url + '"><\/script>' ) ;
}

var jQueryIsLoaded = typeof jQuery != "undefined";

if (!jQueryIsLoaded)
    LoadScript("./jquery.min.js");
    
LoadScript("./jquery.yoxview-2.21.min.js");

function getYoxviewPath()
{
    var scripts = document.getElementsByTagName("script");
    var regex = /(.*\/)yoxview-init/i;
    for(var i=0; i<scripts.length; i++)
    {
		
        var currentScriptSrc = scripts[i].src;
        if (currentScriptSrc.match(regex))
            return currentScriptSrc.match(regex)[1];
    }
    
    return null;
}
// Remove the next line's comment to apply yoxview without knowing jQuery to all containers with class 'yoxview':
//LoadScript("./yoxview-nojquery.js"); 