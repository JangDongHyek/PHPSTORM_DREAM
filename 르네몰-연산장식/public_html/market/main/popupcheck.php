<?

$sQuery = "SELECT idx, width, height, cookie, location_top, location_left FROM tblpopup Where visible=1 order by idx desc";
$rs = query($sQuery, $dbcon);

if(!mysql_num_rows($rs)){
	$popupfile = "";
}else{
	$p = 0;
	while($col=mysql_fetch_array($rs))
	{
		$idx = $col[idx];
		$no[$p] = $col[idx];
		$width = $col[width]+0+4;
		$height = $col[height]+26+4;
		$cookie[$p] = $col[cookie];
		$location_top = $col[location_top];
		if ($location_top == "")
			$location_top=0;
		$location_left = $col[location_left];
		if ($location_left == "")
			$location_left=0;
		if ($height>660){
			$scroll = "yes";
			$height = 660;
			$width += 16;
		}else
			$scroll = "no";

		$popupfile[$p] = " window.open('popup.php?idx=$idx','POPUP{$idx}','width=$width,height=$height,resizable=auto,scrollbars=$scroll ,top=$location_top,left=$location_left');";
		//echo $popupfile[$p];
		$p++;
	}
}

?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function getCookie(name) {
	var from_idx = document.cookie.indexOf(name+'=');
	if (from_idx != -1) { 
		from_idx += name.length + 1
		to_idx = document.cookie.indexOf(';', from_idx) 

		if (to_idx == -1) {
			to_idx = document.cookie.length
		}
		return unescape(document.cookie.substring(from_idx, to_idx))
	}
}

<? for($i=0; $i<count($no); $i++){ ?>
//getCookie 함수를 호출하여 쿠키값을 가져온다. 
var popCookie = getCookie("empcookie_popup<?=$no[$i]?>");
<?
	
	if ($cookie==0) { 
		echo $popupfile[$i];
	}else{
?>
		if(!popCookie){
<?
				if ($popupfile!=""){
					echo $popupfile[$i];
				}
?>
		}
<?}?>
<?}?>
//-->
</SCRIPT>