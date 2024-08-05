<? 
include_once("./_common.php");

$g5['title'] = '예약 상세';
$pid = "rev_view";
include_once('./_head.php');

?>
<link rel="stylesheet" href="<?=G5_BBS_URL?>/style.css?v=<?=G5_CSS_VER?>">
<style>
	.st_tr{
		width: 15% !important;
	}
	#mypage_wrap .con_wrap .st_co{
		font-size: 0.7em;
	}
	@media(max-width:768px){
		.st_tr{
			width: 100% !important;
		}
	}
</style>

<div class="autoW bdpd">
	<div id="mypage_wrap" class="">
		<?php include_once('./mypage_left_menu.php'); ?>
		<div class="con_wrap">


			<div id="order_form">
				<table class="area_product">
					<tr class="st_tr">
						<th class="top_info">상태</th>
						<td>
							<span class="st_co st01">이용완료</span>
						</td>
					</tr>
					<tr>
						<th class="top_info">예약정보</th>
						<td class="item">
							<a class="program_img" href="http://itforone.com/~busancu/bbs/board.php?bo_table=cucenter&wr_id=1">
								<img src="<?php echo G5_URL ?>/data/file/cucenter/3718421490_SHkqjXJV_bb105e2c7c5a6082b4c58b3d292f9dde10c1e049.jpg" alt="">
							</a>
							<div class="program_info">
								<dt class="title">문화센터 강의명</dt>
								<dd>2022.06.04~2022.08.20</dd>
								<dd>(월) 15:00 ~ 16:00</dd>
							</div>
						</td>
					</tr>
					<tr>
						<th class="top_info">신청자명</th>
						<td>
							<div class="name">
								홍길동
							</div>
						</td>
					</tr>
					<tr>
						<th class="top_info">수강료</th>
						<td>
							<div class="price01">
								<span>120,000</span> 원
							</div>
						</td>
					</tr>
					<tr>
						<th class="top_info">결제금액</th>
						<td>
							<div class="price02">
								<span class="point">120,000</span> 원
							</div>
						</td>
					</tr>

				</table>


				<div class="agree_wrap">

					<section id="pay_wrap">
						<h4 style="padding-top:0;">예약 상세내역</h4>
						<dl>
							<dt>예약내용</dt>
							<dd>더 스크린 골프</dd>
						</dl>
						<dl>
							<dt>예약장소</dt>
							<dd>스크린룸 1</dd>
						</dl>
						<dl>
							<dt>예약날짜 & 시간</dt>
							<dd>2022-06-08 (월) <span class="line"></span>16:00 ~ 18:00</dd>
						</dl>
						<dl>
							<dt>결제수단</dt>
							<dd>포인트 결제</dd>
						</dl>
						<dl>
							<dt>결제금액</dt>
							<dd><strong class="point">120,000</strong> 원</dd>
						</dl>
					</section>

				</div>
			</div>
		<a href="./rev_list.php" class="btn_payment">목록으로</a>
		</div>
	</div>
</div>

<script>

</script>

<?php
include_once('./_tail.php');
?>
