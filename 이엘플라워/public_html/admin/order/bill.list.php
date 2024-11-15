<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$bonus_ok  = mysql_result($dbresult, 0, "bonus_ok");	

/*SMS $SQL = "select * from $Sms_ConfigTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);
	$sms_user = $ary[sms_user];
	$sms_passwd = $ary[sms_passwd];
	$mart_name = $ary[mart_name];
	$callback_num1 = $ary[callback_num1];
	$callback_num2 = $ary[callback_num2];
	$callback_num3 = $ary[callback_num3];
	$admin_num1 = $ary[admin_num1];
	$admin_num2 = $ary[admin_num2];
	$admin_num3 = $ary[admin_num3];
	$if_money_chk_msg = $ary[if_money_chk_msg];
	$money_chk_msg = $ary[money_chk_msg];
	$if_product_send_msg = $ary[if_product_send_msg];
	$product_send_msg = $ary[product_send_msg];
	$if_order_cancel_msg = $ary[if_order_cancel_msg];
	$order_cancel_msg = $ary[order_cancel_msg];
	$if_order_cancel_msg_admin = $ary[if_order_cancel_msg_admin];
	$order_cancel_msg_admin = $ary[order_cancel_msg_admin];
}*/


	
	include "../admin_head.php";
	include "../stat/cal.php";
	if($key&&$search){
		$where = " and $key like '%$search%'";
		$qstr="&key=".$key."&search=".$search;
	}
	$countSu=15;
	$blockSu=10;
	$firstRow = ($page - 1) * $countSu;
	$firstRow<0?$firstRow=0:$firstRow=$firstRow;

	$sql="select * from shop_bill where 1 $where";
	$result=mysql_query($sql);
	$total=mysql_num_rows($result);
	$totalPage = ceil($total / $countSu);
	$totalBlock = ceil($totalPage/$blockSu);
	!$page?$page=1:$page=$page;
	$block = ceil($page / $blockSu);

	



	
	

	$sql="select * from shop_bill where 1 $where order by idx desc limit $firstRow,$countSu";
	$result=mysql_query($sql);
?>
<style>
	.page-link{
		border:1px solid #2683ff;
		color:#2683ff;
		float:left;
		min-width:15px;
		padding:5px;
		padding-top:8px;
		text-align:center;
		border-radius:5px;
	}
	.page-active{
		background-color:#2683ff;
		color:#fff;
		font-weight:bold;
	}
	.page-active:visited{
		color:#fff;
		font-weight:bold;
	}
	.page-link:hover{
		background-color:#2683ff;
		color:#fff;
		font-weight:bold;
	}
</style>
<script type="text/javascript">
	function billDelete(idx){
		var q=confirm("계산요청서를 삭제하시겠습니까? 삭제하시면 복구는 불가능합니다.");
		if(q){
			location.href="./bill.delete.php?idx="+idx+"&page=<?=$page?><?=$qstr?>";
		}
	}
	function billChange(idx){
		var q=confirm("계산요청서를 발급하시겠습니까?");
		if(q){
			location.href="./bill.change.php?idx="+idx+"&page=<?=$page?><?=$qstr?>";
		}
	}
	function billCheckChange(){
		var idxArray="";
		var q=confirm("계산요청서를 발급하시겠습니까?");
		for(var i=0;i<$('input[name=idx]').size();i++){
			if($('input[name=idx]').eq(i).prop("checked")){
				idxArray+="'"+$('input[name=idx]').eq(i).val()+"',";
			}
		}
		idxArray=idxArray.substring(0,idxArray.length-1);
		if(q){
			location.href="./bill.change.php?page=<?=$page?><?=$qstr?>&mode=all&idxArray="+idxArray;
		}
	}
	function billNoChange(idx){
		var q=confirm("계산요청서를 발급취소하시겠습니까?");
		if(q){
			location.href="./bill.no.change.php?idx="+idx+"&page=<?=$page?><?=$qstr?>";
		}
	}
	function billNoCheckChange(){
		var idxArray="";
		var q=confirm("계산요청서를 발급취소하시겠습니까?");
		for(var i=0;i<$('input[name=idx]').size();i++){
			if($('input[name=idx]').eq(i).prop("checked")){
				idxArray+="'"+$('input[name=idx]').eq(i).val()+"',";
			}
		}
		idxArray=idxArray.substring(0,idxArray.length-1);
		if(q){
			location.href="./bill.no.change.php?page=<?=$page?><?=$qstr?>&mode=all&idxArray="+idxArray;
		}
	}
	$(function(){
		$("#all-chk").bind("click",function(){
			$("input[type=checkbox]").prop("checked",$(this).prop("checked"));
		});
	});
	function billCheckDel(){
		var idxArray="";
		var q=confirm("계산요청서를 삭제하시겠습니까? 삭제하시면 복구는 불가능합니다.");
		for(var i=0;i<$('input[name=idx]').size();i++){
			if($('input[name=idx]').eq(i).prop("checked")){
				idxArray+="'"+$('input[name=idx]').eq(i).val()+"',";
			}
		}
		idxArray=idxArray.substring(0,idxArray.length-1);
		if(q){
			location.href="./bill.delete.php?page=<?=$page?><?=$qstr?>&mode=all&idxArray="+idxArray;
		}

	}
</script>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<?  include '../inc/menu4.html'; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
    <td width="990" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" background="../img/mid_bg.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="310"><img src="../img/page_title4.gif" width="326" height="81"></td>
            <td valign="top" background="../img/top_2_bg.gif"><div align="right">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">현재페이지</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">주문관리</span> &gt; <span class="text_gray2_c">계산서요청 </span> </div></td>
                </tr>
                <tr>
                  <td height="28">&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon2.gif" width="5" height="7"> <span class="title">&nbsp;관리자모드에 접속하셨습니다.</span></div></td>
                </tr>
              </table>
            </div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="990" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500">
			<!--왼쪽부분시작-->
<?
$left_menu = "4";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->		</td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>계산서요청 </b></td>
				</tr>
			</table>

			<!--내용 START~~-->
<br>

			<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top">
					고객들의 계산서 요청입니다.
				</td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#FFFFFF" height="3" align="center">
					<b><a href='bill.list.php'>[전체목록 보기]</a> </b>
				</td>
				</tr>
				<!-- 검색 폼 시작 -->
				<form action='<?=$_SERVER[PHP_SELF]?>' id='form1' name='form1' method='get'>
				<tr>
				<td valign="top" width="100%" bgColor="#ffffff" height="3" align="center">
						<table border="0" width="95%" cellspacing="0" cellpadding="0">
						<tr>
							<td>
								<table cellSpacing="0" cellPadding="0" width="100%" border="0">
								<tr>
								<td width="100%" bgColor="#cccccc">
									<table cellSpacing="1" cellPadding="3" width="100%" border="0">
									<tr>
									<td width="100%" bgColor="#f7f7f7" height="20">
										<table cellSpacing="0" cellPadding="0" width="100%" border="0">
										<tr>
											<td>&nbsp; 검색</td>
											<td>
												<select name="key">
													<option value="">==선택==</option>
													<option value="repres"<? if($key=="repres"){echo " selected";}?>>대표자명</option>
													<option value="company"<? if($key=="company"){echo " selected";}?>>회사명</option>
													<option value="order_no"<? if($key=="order_no"){echo " selected";}?>>주문번호</option>
												</select>
												<input name="search" value="<?=$search?>" class="input_03" style="width:50%"> 
											</td>
											<td>
												<button type="submit" class="admin-btn">검색</button>
											</td>
										</tr>
										</table>
									</td>
									</tr>
								</table>
								</td>
								</tr>
								</table>
							</td>
						</tr>
			  </form>
				<!-- 검색 폼 끝 -->
		  </table>

						<table border="0" width="100%" height="10" cellspacing="0" cellpadding="0">
						<tr>
							<td width="100%"></td>
						  </tr>

							<form action='' method=post>
							<input type=hidden name='flag' value='<?=$flag?>'>
							<input type='hidden' name='keyset' value='<?=$keyset?>'>
							<input type='hidden' name='searchword' value='<?=$searchword?>'>
							<input type=hidden name='QryFromDate' value='<?=$QryFromDate?>'>
							<input type=hidden name='QryToDate' value='<?=$QryToDate?>'>
							<input type=hidden name='page' value=''>

							
						</table>
	  </td>
  </tr>
					</form>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
						<table border="0" width="95%">
						<tr>
							<td width="90%" bgcolor="#999999">
								<!-- 목록 시작 -->
								<table border="0" width="100%" cellspacing="1" cellpadding="3">
								

								<form name='list' action='order_new.php' method='post'>
								
								
								<tr>
									<td width="8%" bgcolor="#FFFFFF" align="center">번호 <input type="checkbox" name="all" id="all-chk"></td>
									<td width="14%" bgcolor="#FFFFFF" align="center">주문번호</td>
									<td width="10%" bgcolor="#FFFFFF" align="center">회사명</td>
									<td width="16%" bgcolor="#FFFFFF" align="center">업태/업종</td>
									<td width="14%" bgcolor="#FFFFFF" align="center">이메일주소</td>
									<td width="14%" bgcolor="#FFFFFF" align="center">등록날짜</td>
									<td width="24%" bgcolor="#FFFFFF" align="center">설정</td>
								</tr>
								<?
									$no=$total-$firstRow;
									while($row=mysql_fetch_array($result)){
								?>
								<tr align='center'>
									<td bgcolor='#FFFFFF'><?=$no?> <input type="checkbox" name="idx" value="<?=$row[idx]?>"></td>
									<td  bgcolor='#FFFFFF'>
										<a href="./bill.view.php?idx=<?=$row[idx]?>&page=<?=$page?><?=$qstr?>">
										<?=$row[order_no]?>
										</a>
									</td>
									<td bgcolor='#FFFFFF'>
									<?=$row[company]?>
									
									</td>
									<td bgcolor='#FFFFFF'>
										<?=$row[business]?> /
										<?=$row[line]?>
									</td>
									<td bgcolor='#FFFFFF'><?=$row[res_email]?></td>
									<td bgcolor='#FFFFFF'>
										<?=date("Y-m-d",$row[regdate])?>
									</td>
									<td bgcolor='#FFFFFF' align='center'>
										<?
											if($row[status]=="0"){
										?>
										<a href="javascript:;" onclick="billChange('<?=$row[idx]?>')">[발급하기]</a>
										<? }else{?>
										<a href="javascript:;" onclick="billNoChange('<?=$row[idx]?>')">
										[<span style="color:red">발급취소</span>]
										</a>
										<? }?>
										 <a href="javascript:;" onclick="billDelete('<?=$row[idx]?>');">[삭제하기]</a>
									</td>
									</tr>
									<? $no--;}?>

								</table>
								<!-- 목록 끝 -->
							</td>
						</tr>
						<tr>
							<td align="center" style="padding:10px">
								<table  cellpadding="0" cellspacing="5">
									<tr>
										<?
											$first_page = (($block - 1) * $blockSu) + 1; // 첫번째 페이지번호
											$last_page = min($totalPage,$block * $blockSu);
											
											$prev_page = $page - 1; // 이전페이지 
											$next_page =  $page+$blockSu; // 다음페이지 
											$prev_block = $block - 1; // 이전블럭 
											$next_block = $block + 1; // 다음블럭 
											

											// 이전블럭을 블럭의 마지막으로 하려면... 
											$prev_block_page = $prev_block * $blockSu; // 이전블럭 페이지번호 
											// 이전블럭을 블럭의 첫페이지로 하려면... 
											//$prev_block_page = $prev_block * $block_set - ($block_set - 1); 
											$next_block_page = $next_block * $blockSu - ($blockSu - 1); // 다음블럭 페이지번호 
											if($blockSu<$page){?>
											
											<td><a href="?page=1<?=$qstr?>" class="page-link">처음</a></td>
											<td><a href="?page=<?=$first_page-1?><?=$qstr?>" class="page-link">이전</a></td>
										<?}
											for($i=$first_page;$i<=$last_page;$i++){
										?>
										<td><a href="?page=<?=$i?><?=$qstr?>" class="page-link<? if($i==$page){echo " page-active";}?>"><?=$i?></a></td>
										<? }
											
											if($last_page<$totalPage-1){
										?>
										<td><a href="?page=<?=$last_page+1?><?=$qstr?>" class="page-link">다음</a></td>
										<td><a href="?page=<?=$totalPage?><?=$qstr?>" class="page-link">마지막</a></td>
										<? }?>
										
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="padding:10px">
								
								<a href="javascript:;" onclick="billCheckDel()">삭제하기</a>
								<a href="javascript:;" onclick="billCheckChange()">발급하기</a>
								<a href="javascript:;" onclick="billNoCheckChange()">발급취소</a>
							</td>
						</tr>
					</table>
				</td>
				</tr>
			</table>
			
			</form>
				

			  </td>
  </tr>
</table>

<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</body>
</html>
