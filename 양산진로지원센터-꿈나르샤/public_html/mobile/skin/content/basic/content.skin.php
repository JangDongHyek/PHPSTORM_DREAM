<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css">', 0);

if($co_id=="guide2"){
$g5['wzp_pension_table']        = G5_TABLE_PREFIX.'wzp_pension'; // 펜션기본정보 테이블
$g5['wzp_booking_table']        = G5_TABLE_PREFIX.'wzp_booking'; // 예약정보 테이블
$g5['wzp_booking_room_table']   = G5_TABLE_PREFIX.'wzp_booking_room'; // 예약룸 테이블
$g5['wzp_booking_data_table']   = G5_TABLE_PREFIX.'wzp_booking_data'; // 예약정보 임시 테이블
$g5['wzp_room_table']           = G5_TABLE_PREFIX.'wzp_room'; // 객실정보 테이블
$g5['wzp_room_status_table']    = G5_TABLE_PREFIX.'wzp_room_status'; // 객실정보상태 테이블
$g5['wzp_room_extend_price_table']  = G5_TABLE_PREFIX.'wzp_room_extend_price'; // 객실개별요금정보 테이블 (이용요금 최우선순위적용)
$g5['wzp_season_table']         = G5_TABLE_PREFIX.'wzp_season'; // 시즌관리 테이블

$wzpconfig = sql_fetch(" select * from {$g5['wzp_pension_table']} ");
?>
<style>
.st3-form { width:calc(100% - 10px); margin:0 auto; }
.st3-form h3 {margin:15px 0 5px; line-height: 20px; font-family: "나눔바른고딕", "NanumBarunGothic"; font-size: 14pt; color:#636363; font-weight:bold;}
.box_type {width:100%;border:1px solid #9C9C9C;}
.box_type .noti {text-align:left;padding:10px 5px;}
.box_type .privacy {line-height:1.6em}
.box_type .privacy .purpose {margin:4px 0;padding:0 0 0 15px;list-style:none;}
.box_type .privacy .purpose li {margin:0;padding:0}

#price{ border-top:1px solid #444; border-left:1px solid #ccc;}
#price tr td{ padding:10px 0; font-size:14px; color:#333; text-align:center; border-right:1px solid #ccc; border-bottom:1px solid #ccc;}
#price td.title{ font-weight:bold; background:#f5f5f5; border-bottom:1px solid #999;}
#price td.title2{ font-weight:bold; background:#f9f9f9;}
#price tr.title3 td{ background:#f5f5f5; border-bottom:1px solid #999;}
#price td.title4{}
#price td.bigo{ font-weight:bold; border-bottom:1px solid #999; background:#f9f9f9;}
</style>


<div align="center" style="text-align: center; line-height: 0.5;">
	<span style="line-height: 20px; font-family: 나눔바른고딕, NanumBarunGothic; font-size: 18pt;"><span style="color: rgb(215, 78, 78);">스테이안</span> 이용안내</span>
</div>
<div align="center" style="text-align: center;">
	<font face="나눔바른고딕, NanumBarunGothic">
		<span style="color: rgb(99, 99, 99); font-size: 11pt;">스테이안을 이용하기 전, 알아야할 사항들을 안내해드립니다.</span>
	</font>
</div>

<div class="st3-form">
    
    <h3>- 기본예약안내</h3>
    <div class="box_type"><div class="noti"><?php echo $wzpconfig['pn_con_info'];?></div></div>

    <h3>- 입/퇴실 안내</h3>
    <div class="box_type"><div class="noti"><?php echo $wzpconfig['pn_con_checkinout'];?></div></div>

    <h3>- 환불규정</h3>
    <div class="box_type"><div class="noti"><?php echo $wzpconfig['pn_con_refund'];?></div></div>

</div>

<?php }else{ ?>

<article id="ctt" class="ctt_<?php echo $co_id; ?>">
    <header>
        <h1><?php echo $g5['title']; ?></h1>
    </header>

    <div id="ctt_con">
        <?php echo $str; ?>
    </div>

</article>
<?php } ?>