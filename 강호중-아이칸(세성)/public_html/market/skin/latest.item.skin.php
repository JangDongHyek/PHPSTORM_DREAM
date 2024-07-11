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
							divheight = 65;

							function upPrdWings(wingsprd){
								if(<?=$cnt?><3){
									return;
								}else{
									if(count==0){
										return;
									}else{
										count--;
										move += divheight;
										if(count != max){
											wingsprd.style.posTop += divheight;
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
											wingsprd.style.posTop = move;
										}
									}
								}
							}

function bookmark()
{
	//var frame = document.getElementById("addbookmark");
	//frame.src = "../market/main/addbookmark.php";
	window.open("../main/addbookmark.php", "bookmark");
	//alert("아직 준비중 입니다.");
	//window.external.AddFavorite('<?=$home_dir?>', document.title);
}
-->
</script>
<div id="floater" style='position:absolute; top:0px; left:50%; z-index:1;'>
<div style='position:absolute;top:81px;left:505px'>
<table width="94" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="../images/banner_1.gif" width="94" height="17" /></td>
  </tr>
  <tr>
    <td><img src="../images/banner_2.gif" width="94" height="11" onClick="upPrdWings(prdWings)" style="cursor:hand" /></td>
  </tr>
  <tr>
    <td height="100" bgcolor="#FFFFFF">
			<div style="height:197px; width:94px;overflow:hidden;">
				<table id="prdWings" cellpadding="0" align="left" cellspacing="0" border="0" style="position:absolute;table-layout:fixed;">
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
							<table width="94" border="0" cellspacing="0" cellpadding="0" style='border:1 solid #CCCCCC ;table-layout:fixed;'>
								<tr>
										<td bgcolor="#FFFFFF" align="center" height="50"><a href='../main/product_info.html?mart_id=<?=$mart_id?>&category_num=<?=$hit_row[category_num]?>&flag=<?=$flag?>&item_no=<?=$hit_row[item_no]?>'><?=$hit_img_str?></a></td>
								</tr>
								<tr>
									<td height="12" align="center"><span class="text_16_s"><a href='../main/product_info.html?mart_id=<?=$mart_id?>&category_num=<?=$hit_row[category_num]?>&flag=<?=$flag?>&item_no=<?=$hit_row[item_no]?>'><?=$hit_row[item_name]?></a></span></td>
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
    <td><img src="../images/banner_3.gif" width="94" height="11" onClick="downPrdWings(prdWings)" style="cursor:hand" /></td>
  </tr>
  <tr>
    <td><a target='_self' href="../main/"onclick="this.style.behavior='url(#default#homepage)';
this.setHomePage('<?=$home_dir?>');"><img src="../images/banner_4.gif" width="94" height="16"  border="0"></a></td>
  </tr>
    <tr>
      <td><img src="../images/banner_5.gif" width="94" height="16"  border="0" onClick="bookmark();" style="cursor:hand;"></td>
    </tr>
    <tr>
      <td><a href="#"><img src="../images/banner_6.gif" width="94" height="16" border="0"></a></td>
    </tr>
    <tr>
    <td></a></td>
  </tr>
</table>
</div>
