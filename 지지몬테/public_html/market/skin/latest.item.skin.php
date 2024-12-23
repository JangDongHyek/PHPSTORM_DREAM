<?
/*----------------------------------------------------------------------------- 
 *	제작자 : 여성술
 *	제작일 : 2006. 12. 22
 *	이메일 : heroyeo@hanmail.net
 *	파일명 : latest.item.skin.php
 *	
 *	최근상품보기
 -----------------------------------------------------------------------------*/
?>
<STYLE type=text/css>#floater {
	VISIBILITY: visible; POSITION: absolute
}
</STYLE>

<script language="JavaScript">
<!--

self.onError=null; 
currentX = currentY = 0; 
whichIt = null; 
lastScrollX = 0; lastScrollY = 0; 
NS = (document.layers) ? 1 : 0; 
IE = (document.all) ? 1: 0; 

function heartBeat() { 

	if(IE) { 
		diffY = document.body.scrollTop; 
		diffX = 0; 
	} 
	if(NS)
	{
		diffY = self.pageYOffset;
		diffX = self.pageXOffset;
	} 
	if(diffY != lastScrollY)
	{ 
		percent = .1 * (diffY - lastScrollY); 
		if(percent > 0)
			percent = Math.ceil(percent); 
		else
			percent = Math.floor(percent); 

		if(IE)
			document.all.floater.style.top = parseInt(document.all.floater.style.top) + percent; 
		if(NS)
			document.floater.top += percent; 
			lastScrollY = lastScrollY + percent; 
	}
}

function GoWing() {
	document.all.floater.style.display = "block";
	setInterval("heartBeat()",1);
}

var oldLoadHandlerMover = window.onload;
window.onload = new Function("{if (oldLoadHandlerMover != null) oldLoadHandlerMover(); GoWing();}");
<?
if($_COOKIE[latest_items])
{
	//echo $latest_items;
	$arr_item = explode("|",$_COOKIE[latest_items]);
	$cnt = count($arr_item);
}else
	$cnt = 0;	
?>
							count = 0;
							max = <?=$cnt?>-3;
							move = 0;
							divheight = 79;

							function upPrdWings(wingsprd){
								if(<?=$cnt?><3){
									return;
								}else{
									if(count==0){
										return;
									}else{
										count--;
										move = move + divheight;
										if(count != max){
											wingsprd.style.top = move;
										}
									}
								}
							}

							function downPrdWings(wingsprd){
								if(<?=$cnt?><3){
									return;
								}else{
									if(count==max){
										return;
									}else{
										count++;
										move -= divheight;
										if(count != max+1){
											wingsprd.style.top = move;
										}
									}
								}
							}


-->
</script>
<script language="javascript"> 
function myFavorite(){ 
<?
if( !$UnameSess){
	echo "
		
		alert('로그인을 하셔야 합니다.');
		location.href='../member/login.html?url=$url'
		exit;
		
	";
	
}

	$SQL = "select * from $MartMngInfoTable where mart_id ='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if(mysql_num_rows($dbresult)>0){
		$row = mysql_fetch_array($dbresult);
		$bookmark_bonus_ok = $row["bookmark_bonus_ok"];
		$init_bookmark_bonus = $row["init_bookmark_bonus"];
	}

	if($bookmark_bonus_ok == "t" && $init_bookmark_bonus > 0){ //적립금 사용할때만 지급
		$SQL = "select * from $BonusTable where mart_id ='$mart_id' and id='$UnameSess' and mode='b'";
		$dbresult = mysql_query($SQL, $dbconn);
		if(mysql_num_rows($dbresult)>0){
		?>
			window.external.AddFavorite('<?=$home_dir?>', document.title) 
			exit;
			
		<?
			
		}else{
			
			$write_date = date("Ymd H:i:s");
			$content = "즐겨찾기 추가 적립금"; 
			$SQL = "insert into $BonusTable (mart_id, id, write_date, bonus, content, mode) ".
			"values ('$mart_id', '$UnameSess', '$write_date', '$init_bookmark_bonus', '$content', 'b')";
			$dbresult = mysql_query($SQL, $dbconn);
			
			$SQL = "update $Mart_Member_NewTable set bonus_total = bonus_total + $init_bookmark_bonus 
			where username='$username' and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
		}
	}
?>
window.external.AddFavorite('<?=$home_dir?>', document.title) 
//alert('즐겨찾기 포인트가 적립되었습니다.');
//location.href='../mypage/point.html';
} 
</script>
<div id="floater" style='position:absolute; margin:0px auto; padding:0px 0px 0px 0px; top:0px; left:50%; z-index:9999;'>
<div style='position:fixed; top:194px; left:50%; margin-left:520px;'>
<table width="73" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed;">
  <tr>
    <td><img src="../images2/quick.png" border="0" usemap="#Maptop" /></td>
  </tr>
    <tr>
    <td></a></td>
  </tr>
</table>
</div>


<map name="Maptop" id="Maptop">
  <area shape="rect" coords="58,457,105,500" href="#" />
  <area shape="rect" coords="36,359,88,393" href="#" />
</map>
