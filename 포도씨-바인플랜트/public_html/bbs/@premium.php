<?
include_once('./_common.php');
$name = "charge";
$g5['title'] = '프리미엄회원';
include_once('./_head.php');

?>

<? if($name=="charge") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="charge">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#ft_menu{display:none;}
	.box_cont{margin:0;}
</style>

    <div id="area_charge">
		<h2 class="title">프리미엄회원</h2>
		<div id="charge_wrap">
			<div id="box_charge">
				<h3>프리미엄회원으로 <br>업그레이드 해보세요!</h3>
				<div class="box_cont">
					<ul class="list_product premium">
						<li>	
							<label>프리미엄 회원 연회비</label>
							<h3>1,000,000<span>원</span></h3>
							<!--<input type="text" class="frm_input" id="txt_requires" name="charge_value" placeholder="충전금액">-->
						</li>
					</ul>			
				</div>

				<div class="box premium">
					<h3>결제수단</h3>
					<ul class="area_pay">
						<li>
							<div class="box_radio">
							<label for="pay01">
								
								<input type="radio" id="pay01" checked name="pay_type" value="CARD" checked>						
								<span class="radio_body"></span>
								<em>카드결제</em>
							</label>
							</div>
						</li>
						<li>
							<div class="box_radio">
							<label for="pay02">
								
								<input type="radio" id="pay02" name="pay_type" value="BANK">							
								<span class="radio_body"></span>
								<em>무통장입금</em>
							</label>
							</div>
						</li>
					</ul>
				</div>

				<div class="area_btn fixed">
					<a href="javascript:void(0);" class="btn_next">프리미엄회원 신청완료</a>
				</div>
			</div>	
	</div>

<?
include_once('./_tail.php');
?>