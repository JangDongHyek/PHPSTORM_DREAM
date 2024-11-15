//SELECT -> LAYER변환
function getSelectToLayer(obj,lwidth,href) {
	obj.style.display = 'none';
	var newsb = obj.id + "_sbj";
	var newid = obj.id + "_tmp";
	var newim = obj.id + "_img";
	var LayerTag = "";

	LayerTag += "<TABLE WIDTH='"+lwidth+"' border='0' CELLSPACING=0 CELLPADDING=0 STYLE='position:absolute;cursor:default;'>";
	LayerTag += "<TR><TD>";
	LayerTag += "<TABLE BGCOLOR='#EDF5F7' height='0' border='0' border='0' WIDTH=100% CELLSPACING=1 CELLPADDING=0 STYLE='border:1 solid #B9D8DF;line-height : 0px;' onmouseover='getSelectLayerOver(this,document.all."+newim+",document.all."+newid+");' onmouseout='getSelectLayerOut(this,document.all."+newim+",document.all."+newid+");'>";
	
	LayerTag += "<TR WIDTH=100% onclick='getSelectSubLayer(document.all."+newid+",document.all."+newsb+");'>";
	LayerTag += "<TD ID='"+newsb+"' WIDTH=95% onblur='getSelectLayerBlur(this);' style='background-Color : #EDF5F7; line-height : 15px;'>&nbsp;" + "<font color='#46819A'>" + obj.options[obj.selectedIndex].text + "</font>" + "</TD>";
	LayerTag += "<TD ALIGN=RIGHT style='line-height : 0px;'><IMG border='0' ID='"+newim+"' SRC='/image/select_icon.gif' ALIGN=absmiddle></TD></TR>";
	
	LayerTag += "</TABLE>";

	LayerTag += "<TABLE onblur='getSubLayerClose(this);' ID='"+newid+"' WIDTH=100% CELLSPACING=0 CELLPADDING=0 STYLE='display:none;border:1 solid #B9D8DF;line-height : 0px;' BGCOLOR='#EDF5F7'>";

	for (var i = 0 ; i < obj.length; i++) {
		LayerTag += "<TR onmouseover='getSelectMoveLayer(this);' onmouseout='getSelectMoveLayer1(this);' onclick=\"getSelectChangeLayer(document.all."+obj.id+",document.all."+newid+",document.all."+newsb+",'"+obj.options[i].text+"','"+obj.options[i].value+"','"+href+"');\" ";

		if (obj.value == obj.options[i].value) { LayerTag += "STYLE='background:#EDF5F7;color:#FFFFFF;'><TD>&nbsp;"; }
		else { LayerTag += "STYLE='background:#FFFFFF;color:#000000;'><TD>&nbsp;"; }

		LayerTag += "<font color='#46819A'>" + obj.options[i].text + "</font>";
		LayerTag += "</TD></TR>";
	}
	LayerTag += "</TABLE>";
	LayerTag += "</TD></TR></TABLE><IMG SRC='' WIDTH='"+lwidth+"' HEIGHT=0>";

	document.write(LayerTag);
}

//서브레이어보이기
function getSelectSubLayer(obj,sobj)
{
	if(obj.style.display == 'none')
	{
		sobj.style.background = '#EDF5F7';
		sobj.style.color = '#46819A';	
		obj.style.display = 'block';
		obj.focus();
	}
	else {
		sobj.style.background = '#EDF5F7';
		sobj.style.color = '#46819A';
		obj.style.display = 'none';
	}
}

//서브레이어체크
function getSelectSubLayer1(obj)
{
	if(obj.style.display != 'none')
	{
		obj.style.display = 'none';
	}
}

//타이틀레이어 MouseOver
function getSelectLayerOver(obj,img,nobj)
{
	if (nobj.style.display == 'none')
	{
		obj.style.border = '1 solid ';
		img.style.filter = '';
	}
}

//타이틀레이어 MouseOut
function getSelectLayerOut(obj,img)
{
	obj.style.border = '1 solid #B9D8DF';
	img.style.filter = '';
}


//서브레이어 MouseOver
function getSelectMoveLayer(obj)
{
	if (obj.style.color == '#000000')
	{
		obj.style.background = '#EDF5F7';
		obj.style.color = '#000000';
	}
}
//서브레이어 MouseOut
function getSelectMoveLayer1(obj)
{
	obj.style.background = '#FFFFFF';
	obj.style.color = '#000000';
}

//새레이어선택
function getSelectChangeLayer(obj,fobj,sobj,text,value,href)
{
	fobj.style.display = 'none';
	sobj.innerHTML = '&nbsp;' + text;
	sobj.style.background = '#EDF5F7';
	sobj.style.color = '#46819A';
	sobj.focus();
	obj.value = value;
	if (href)
	{
		if (href.indexOf('submit()') != -1)
		{
			eval(href);
		}
		else {
			location.href = value;  // onChange Action
			//alert(href + value);
		}
		return false;
	}
}

//타이틀레이어 blur
function getSelectLayerBlur(obj)
{
	obj.style.background = '#EDF5F7';
	obj.style.color = '#46819A';
}

//서브레이어 닫기
function getSubLayerClose(obj)
{
	if (obj.style.display != 'none')
	{
		setTimeout("document.all." + obj.id + ".style.display = 'none';" , 200);
	}
}
