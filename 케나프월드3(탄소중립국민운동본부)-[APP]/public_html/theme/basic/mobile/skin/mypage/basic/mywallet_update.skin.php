<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sql_search = " and mb_id = '{$member['mb_id']}' ";

$sql = "select * from g5_wallet where wl_status = '신청' {$sql_search} order by wl_datetime desc limit 0, 1";
$row = sql_fetch($sql);

add_stylesheet('<link rel="stylesheet" href="'.$mypage_skin_url.'/style.css">', 0);
?>
<div class="wal-cotainer" id="wal_cotainer">
	<article class="wal-frm">
		<div class="wal-req">
			<dl>
				<dd class="initialism" style="color:#898989">
					<p style="font-size:1.15em; padding:0 0 10px 0;">
                    	<p style="font-size:1.2em; font-weight:600; margin-bottom:3px; color:#666;">
						케나프랜드주식회사<br/>
						기업은행 070-127990-04-012<br/>
						<?php echo $member['mb_name'];?>님 \<?php echo number_format($row['wl_money']);?> 충전신청 완료되었습니다.
					</p>
					<p><a href="<?php echo G5_BBS_URL;?>/mywallet.php" class="btn btn-danger btn-sm" style="width:100%;">내역보기</a></p>
				</dd>
			</dl>
		</div>
	</article>
	<article class="wal-frm">
    	<div class="bank_info">
        <a href="https://www.ibk.co.kr/" target="_blank"><img src="<? echo G5_THEME_IMG_URL ?>/bank/bank01.gif" alt="기업은행"></a>
        <a href="https://banking.nonghyup.com/" target="_blank"><img src="<? echo G5_THEME_IMG_URL ?>/bank/bank02.gif" alt="농협은행"></a>
        <a href="https://www.kbstar.com/" target="_blank"><img src="<? echo G5_THEME_IMG_URL ?>/bank/bank03.gif" alt="국민은행"></a>
        <a href="https://www.shinhan.com/" target="_blank"><img src="<? echo G5_THEME_IMG_URL ?>/bank/bank04.gif" alt="신한은행"></a>
        <a href="https://www.kebhana.com/" target="_blank"><img src="<? echo G5_THEME_IMG_URL ?>/bank/bank05.gif" alt="KEB외환"></a>
        <a href="https://www.kfcc.co.kr/" target="_blank"><img src="<? echo G5_THEME_IMG_URL ?>/bank/bank06.gif" alt="새마을금고"></a>
        <a href="https://www.epostbank.go.kr/" target="_blank"><img src="<? echo G5_THEME_IMG_URL ?>/bank/bank07.gif" alt="우체국"></a>
        </div>
	</article>
    <article class="slg-text">
    	<!--<h3>캐시충전재테크<br>
        특별이벤트 <strong>10%추가 적립</strong>해드립니다.</h3> -->
        <p>충전은 은행뱅킹으로 가능하며 화면 상단에 보유포인트가 표기됩니다.</p>
    </article>
</div>

<script>
$(document).ready(function (){
	$("#wal_cotainer").css("min-height", $(window).height() - 124);
});	
</script>


