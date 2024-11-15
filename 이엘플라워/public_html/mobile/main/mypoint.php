<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";
?>
<?
if( !$UnameSess &&  !$NonMemberName ){
	echo "
		<meta http-equiv='refresh' content='0; URL=../main/login.html?url=$url'>
	";
	exit;
}
?>

<?
include "../../market/include/getmartinfo.php";
//include "../../market/include/head_alltemplate.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="euc-kr" />
		<title></title>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no;" />
		<link rel="apple-touch-icon" href="http://img.orga.co.kr/images/mobile/apple-touch-icon.png" />
        <link rel="shortcut icon" href="http://img.orga.co.kr/images/mobile/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="../css/m_style.css" />
		<script type="text/JavaScript" src="../js/jquery-1.7.min.js"></script>
		<script type="text/javascript">
			document.createElement('header');
			document.createElement('nav');
			document.createElement('section');
			document.createElement('article');
			document.createElement('footer');
			
			function check_submit() {

				var query = document.searchForm.searchTerm.value;

				if(query != ''){
					document.searchForm.submit();
				} else {
					alert("검색어를 입력하세요");
					document.searchForm.searchTerm.focus(); 
					return;
				}	
			}			
		</script>
		
		
    
    <script type="text/javascript">
    </script>

	</head>
	<body>
	<? include("../include/top.html"); ?>

		

<section id="content">
			<article id="contentSubTitle">
				<div class="cate_list">
					<h2>&nbsp;&nbsp;<a href="../">홈</a> > 적립금내역</h2>
				</div>
			</article>
        <article id="productReview">
            <h3>&nbsp;&nbsp;적립금내역</h3>


			<table class="orderForm mt10 mb20">
                    <tr>
												<th>적립일</th>
                        <th>상태</th>
                        <th>내역</th>
                        <th>포인트</th>
                  </tr>
									<?
									$SQL = "select * from $BonusTable where mart_id ='$mart_id' and id = '$UnameSess' order by num desc";
									$dbresult = mysql_query($SQL, $dbconn);
									$numRows = mysql_num_rows($dbresult);
									if ($cnfPagecount == "") $cnfPagecount = 20;
									if ($page == "") $page = 1;
									$skipNum = ($page - 1) * $cnfPagecount;

									$prev_page = $page - 1;
									$next_page = $page + 1;

									$total_page = ($numRows - 1) / $cnfPagecount;
									$total_page = intval($total_page)+1;

									if($page % 10 == 0)
									$start_page = $page - 9;
									else
									$start_page = $page - ($page % 10) + 1;

									$end_page = $start_page + 9;
									if($end_page >= $total_page)
										$end_page = $total_page;
									$prev_start_page = $start_page - 10;
									$next_start_page = $start_page + 10;

									$sum = 0;
									for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
										if ($i >= $numRows) break;
										mysql_data_seek($dbresult, $i);
										$ary=mysql_fetch_array($dbresult);
										$num = $ary[num];
										$mart_id = $ary[mart_id];
										$id = $ary[id];
										$t_title = $ary[t_title];
										$provider_id = $ary[provider_id];
										$write_date = $ary[write_date];
										$write_date = substr($write_date,0,10);
										$bonus = $ary[bonus];
										$content = nl2br($ary[content]);
										$order_num = $ary[order_num];
										
										if( $bonus > 0 ){
											$bonum_stats = "적립";
										}else{
											$bonum_stats = "사용";
										}
										$bonus_str = number_format($bonus);
										$write_date = str_replace("-","",$write_date);
										$write_date_str = substr($write_date,0,4)."-".substr($write_date,4,2)."-".substr($write_date,6,2);
										$sum = $sum + $bonus;
										$j = $i + 1;

										$year = substr($write_date,0,4); //쿠폰 지급년도
										$month = substr($write_date,4,2); //쿠폰 지급월

										$num_month = $month + 6; // 6월달 후
										$num_month = sprintf("%02d",$num_month);
										if( $num_month == 0 ){
											$year = $year - 1;
											$num_month = 12;
										}
										if( $num_month > 12 ){
											$year = $year + 1;
											$num_month = $num_month - 12;
										}

										if($bonus != 0){
											if( $provider_id && $t_title ){
												$bonus_end = "&nbsp;&nbsp; <b><font color='#E67D0E'>[포인트 만료일 : {$year}년 {$num_month}월]</font></b>";
											}else{
												$bonus_end = "";
											}
											
									?>
																							<tr>
																								<td align="center"><?=$write_date_str?></td>
																								<td class="mypage_1"><?=$point_arr[$ary[mode]]?></td>
																								<td><?=$content?> <?=$bonus_end?></td>
																								<td align="center" class="price"><?=$bonus_str?>
																									원</td>
																							</tr>
																							<?
											if(($i + 1) < ($cnfPagecount+$skipNum) && ($i + 1 < $numRows)){
									?>
																							<tr>
																								<td colspan="4" height="1" bgcolor="E5E5E5"></td>
																							</tr>
																							<?
											}
									?>
																							<?
										}
									}
									?>
	             

			</table>
            </div>

        </article>
		
    </section>

 
 
<? include("../include/bottom.html"); ?>
	</body>
</html>