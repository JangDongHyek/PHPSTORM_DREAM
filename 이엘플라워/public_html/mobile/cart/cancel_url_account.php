<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";
?>
<?
include "../../market/include/getmartinfo.php";
include "../../market/include/head_alltemplate.php";
unset($_SESSION["order_num"]);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="euc-kr" />
		<title></title>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no;" />
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
</head>
	<body>

<? include("../include/top.html"); ?>


 
		<section id="content">

			<article id="contentSubTitle">
				<div class="cate_list">
					<h2>&nbsp;&nbsp;<a href="../">홈</a> > 주문하기 > 실시간계좌이체 중지</h2>
				</div>
			</article>

			<article id="productReview">
 							
				<div class="basket">
				<h3><span class="ic"></span>실시간계좌이체 중지</h3>
				<table class="orderinfoForm mb20">
					<colgroup>
						<col width="32%" />
						<col width="68%" />
					</colgroup>
					<tbody>
						<tr>
							<th>사용자가 실시간계좌이체 결제를 중지 하였습니다.<br><BR><BR><a href="../"><b>[메인화면으로가기]</b></a>
                                         
						</tr>

					</tbody>
				</table>
               


			</article>
			
		</section>


	<? include("../include/bottom.html"); ?>
	</body>
</html>