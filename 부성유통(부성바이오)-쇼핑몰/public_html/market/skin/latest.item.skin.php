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
<div id="floater" style='position:fixed; margin:0px auto; padding:0px 0px 0px 0px; top:0px; left:50%; z-index:1;'>
<div style='position:absolute; top:176px; left:510px; width:99px;'>
<table width="99" border="0" cellpadding="0" cellspacing="0" background="../images_home/q_bg.gif" style="table-layout:fixed;">
  <tr>
    <td width="99"><a href="http://www.hexan.co.kr/" target="_blank"><img src="../images_home/quick1.gif" border="0"></a></td>
  </tr>
  <tr>
    <td><a href="http://www.hexan.co.kr/bbs/view.php?&amp;bbs_id=noticee&amp;page=&amp;doc_num=49" target="_blank"><img src="../images_home/main_banner_1.gif" border="0" /></a></td>
  </tr>
  <tr>
    <td><a href="http://www.hexan.co.kr/bbs/view.php?&amp;bbs_id=noticee&amp;page=&amp;doc_num=50" target="_blank"><img src="../images_home/main_banner_2.gif" border="0" /></a></td>
  </tr>
  <tr>
    <td width="99"><img src="../images_home/quick5.gif" onClick="upPrdWings(prdWings)" style="cursor:hand" /></td>
  </tr>
  <tr>
    <td width="99" height="238">
			<div style="position:relative; height:238px; width:99px; overflow-x:hidden; overflow-y:hidden;">
				<table width="99" id="prdWings" cellpadding="0" align="left" cellspacing="0" border="0" style="position:absolute; table-layout:fixed;">
					<tr>
						<td height=1></td>
					</tr>
		<?
			for( $i=0; $i < $cnt; $i++ ){
				$hit_sql = "select * from $ItemTable where mart_id='$mart_id' and item_no='$arr_item[$i]'";
				$hit_res = mysql_query( $hit_sql, $dbconn );
				$hit_row = mysql_fetch_array($hit_res);
		 
				$short_explain = han_cut($hit_row[short_explain],28);
				$img_sml = $hit_row[img_sml];
				$img = $hit_row[img];
				$img_big = $hit_row[img_big];

				//============================ 상품 이미지 =======================================
				if($img_sml != "" && file_exists("$Co_img_UP$mart_id/$img_sml")){
					if (strstr(strtolower(substr($img_sml,-4)),'.jpg') || strstr(strtolower(substr($img_sml,-4)),'.gif')){
						$hit_img_str = "<img src='../..$Co_img_DOWN$mart_id/$img_sml' border='0' width='50' height='50' border='0'>";
					}
					if (strstr(strtolower(substr($img_sml,-4)),'.swf')){
						$hit_img_str = "<embed src='../..$Co_img_DOWN$mart_id/$img_sml' width='50' height='50'></embed>";
					}
				}else if($img != "" && file_exists("$Co_img_UP$mart_id/$img")){
					if (strstr(strtolower(substr($img,-4)),'.jpg') || strstr(strtolower(substr($img,-4)),'.gif')){
						$hit_img_str = "<img src='../..$Co_img_DOWN$mart_id/$img' border='0' width='50' height='50' border='0'>";
					}
					if (strstr(strtolower(substr($img,-4)),'.swf')){
						$hit_img_str = "<embed src='../..$Co_img_DOWN$mart_id/$img' width='50' height='50'></embed>";
					}
				}else if($img_big != "" && file_exists("$Co_img_UP$mart_id/$img_big")){
					if (strstr(strtolower(substr($img_big,-4)),'.jpg') || strstr(strtolower(substr($img_big,-4)),'.gif')){
						$hit_img_str = "<img src='../..$Co_img_DOWN$mart_id/$img_big' border='0' width='50' height='50' border='0'>";
					}
					if (strstr(strtolower(substr($img_big,-4)),'.swf')){
						$hit_img_str = "<embed src='../..$Co_img_DOWN$mart_id/$img_big' width='50' height='50'></embed>";
					}
				}else{
					$hit_img_str = "<img src='../image/noimage_ss.gif' border='0' width='50' height='50' border='0'>";
				}
		?>

					<tr>
						<td>
							<table width="99" border="0" cellspacing="0" cellpadding="0" style='border:1 solid #CCCCCC;'>
								<tr>
										<td height="50" align="center" background="../images_home/q_bg.gif" bgcolor="#FFFFFF"><a href='../main/product_info.html?mart_id=<?=$mart_id?>&category_num=<?=$hit_row[category_num]?>&flag=<?=$flag?>&item_no=<?=$hit_row[item_no]?>'><?=$hit_img_str?></a></td>
								</tr>
								<tr>
									<td height="26" align="center" style="margin:0px;padding:0px 0px 0px 0px; height:20px; overflow-y:hidden;"><span class="text_16_s" style="height:26px; overflow-y:hidden;"><a href='../main/product_info.html?mart_id=<?=$mart_id?>&category_num=<?=$hit_row[category_num]?>&flag=<?=$flag?>&item_no=<?=$hit_row[item_no]?>'><?=$hit_row[item_name]?></a></span></td>
								</tr>
						  </table>						</td>
					</tr>
					<tr>
						<td height=1></td>
					</tr>
		<?
			}
		?>
				</table>
	  </div>		</td>
  </tr>
  <tr>
    <td><img src="../images_home/quick6.gif" onClick="downPrdWings(prdWings)" style="cursor:hand" /></td>
  </tr>
    <tr>
      <td><a href="#"><img src="../images_home/top.gif" border="0"></a></td>
    </tr>
    <tr>
    <td></a></td>
  </tr>
</table>
</div>
