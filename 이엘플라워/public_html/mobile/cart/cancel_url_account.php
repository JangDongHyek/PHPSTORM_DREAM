<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
//================== �Լ� ������ �ҷ��� ==================================================
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
					alert("�˻�� �Է��ϼ���");
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
					<h2>&nbsp;&nbsp;<a href="../">Ȩ</a> > �ֹ��ϱ� > �ǽð�������ü ����</h2>
				</div>
			</article>

			<article id="productReview">
 							
				<div class="basket">
				<h3><span class="ic"></span>�ǽð�������ü ����</h3>
				<table class="orderinfoForm mb20">
					<colgroup>
						<col width="32%" />
						<col width="68%" />
					</colgroup>
					<tbody>
						<tr>
							<th>����ڰ� �ǽð�������ü ������ ���� �Ͽ����ϴ�.<br><BR><BR><a href="../"><b>[����ȭ�����ΰ���]</b></a>
                                         
						</tr>

					</tbody>
				</table>
               


			</article>
			
		</section>


	<? include("../include/bottom.html"); ?>
	</body>
</html>