<?
include_once('./_common.php');
$name = "mypage";
$g5['title'] = '벙커관리';
include_once('./_head.php');

// 충전벙커
$charge_bunker = sql_fetch(" select sum(bunker) as bunker from g5_bunker_history where mb_id = '{$member['mb_id']}' and etc = 'charge' ")['bunker'];
?>

<? if($name=="mypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="<?php echo $member['mb_category'] == '일반' ? 'mypage' : 'cmypage'; ?>">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
    /*.v3 {background: darkgray;}*/
</style>

    <input type="hidden" name="mode" id="mode" value="in">
    <input type="hidden" name="page" id="page" value="1">
    <div id="area_mypage" class="bunker">
		<div class="inr v3">

			<?php
            if($member['mb_category'] == '일반') {
                include_once('./mypage_info.php');
            } else {
                include_once('./mypage_cinfo.php');
            }
            ?>

			<div id="mypage_wrap">
				<div class="mypage_cont">
					<div class="mypage_cont_wrap">
					<div class="box">
						<h3>벙커관리</h3>

						<div class="bunker_type">
							<ul class="bunker_list">
								<li class="total">
									<span>보유벙커</span>
									<h3 class="number"><?=number_format($member['mb_bunker'] + $member['mb_bunker_bonus'])?></h3>
								</li>
								<li>
                                    <span>일반벙커<!-- <em style="font-size: 12px;">(충전+적립)</em>--></span>
									<h3 class="number"><?=number_format($member['mb_bunker'])?></h3>
								</li>
								<li>
									<span>보너스벙커</span>
									<h3 class="number"><?=number_format($member['mb_bunker_bonus'])?></h3>
								</li>
							</ul>
							<em class="info">※보너스 벙커는 환전, 선물 불가하며, 서비스 이용시 에만 사용 가능합니다.</em>
						</div>

						<div class="box_cont">
							<div class="box_top">
								<ul class="tabs">
									<li class="active" rel="tab1"><span>적립내역</span></li>
                                    <li rel="tab2"><span>차감내역</span></li>
                                    <?php if($member['mb_category'] == '일반') { ?>
									<li rel="tab3"><span>출금내역</span></li>
                                    <?php } ?>
								</ul>
								<div class="filter">
									<select class="year" id="year" name="year" onchange="mypage_bunker();"></select>
									<select class="month" id="month" name="month" onchange="mypage_bunker();">
                                        <?php for($i=1; $i<=12; $i++) { ?>
                                        <option value="<?=$i?>" <?php echo date('m') == $i ? 'selected' : ''; ?>><?=$i?>월</option>
                                        <?php } ?>
									</select>
								</div>
							</div>
							<div class="tab_container">
								<div id="tab1" class="tab_content">
									<div class="box_cont">
										<div class="table_wrap">
											<ul class="tbl_hd tbl">
												<li class="data w2">적립일</li>
												<li class="type w2">종류</li>
												<li class="cont w4">내용</li>
												<li class="price w2">벙커</li>
											</ul>
                                            <!--ajax.mypage_bunker.php-->
											<ul class="tbl_cont_wrap bunker_in"></ul>
										</div>
									</div>
								</div>
                                <div id="tab2" class="tab_content" style="display: none;">
                                    <div class="box_cont">
                                        <div class="table_wrap">
                                            <ul class="tbl_hd tbl">
                                                <li class="data w2">차감일</li>
                                                <li class="type w2">종류</li>
                                                <li class="cont w4">내용</li>
                                                <li class="price w2">벙커</li>
                                            </ul>
                                            <!--ajax.mypage_bunker.php-->
                                            <ul class="tbl_cont_wrap bunker_out"></ul>
                                        </div>
                                    </div>
                                </div>
								<div id="tab3" class="tab_content" style="display: none;">
									<div class="box_cont">
										<div class="table_wrap">
											<ul class="tbl_hd tbl">
												<li class="state w1">상태</li>
												<li class="data w2">신청일</li>
												<li class="account w3">은행 / 계좌번호 / 예금주</li>
												<li class="price w2">금액</li>
												<li class="data2 w2">지급일시</li>
											</ul>
                                            <!--ajax.mypage_bunker.php-->
											<ul class="tbl_cont_wrap bunker_withdraw"></ul>
										</div>
									</div>
								</div>
                                <div id="paging"></div>
							</div>
						</div>
					</div>
				</div>

                <?php
                // 벙커 트레이더 정보
                $trader = sql_fetch(" select * from g5_bunker_trader where mb_id = '{$member['mb_id']}' and del_yn is null ");
                if(empty($trader['idx']) || $trader['state'] != '승인완료') { // 승인 거절 시에는 트레이더 정보 수정할 수 있게
                ?>
				<!-- 일반회원 마이페이지 에서만 보이게 -->
				<div class="mypage_cont_wrap last" <?php echo $member['mb_category'] != '일반' ? 'style="display:none;"' : ''; ?>>
                    <div class="box">
                        <div class="bn_bunkertrade">
                            <a href="javascript:bunkerCheck('<?=$trader['state']?>');">
                                <h2>"벙커 트레이더"로 등록하기</h2>
                                <span>※ 포도씨 회원 등급 <em class="yellow">"3등 항해사 이상 & 300,000벙커 이상 적립/보유한 회원</em>은 벙커 트레이더로 등록하여 보유 벙커를 수익화 할 수 있습니다.</span>
                                <span>※ 수익금 지급시 제세공과금 납부를 위해 <em class="yellow">추가 회원 정보 (입금 계좌, 주민등록번호 등)</em> 입력이 필요합니다.</span>
                                <?php
                                if($trader['state'] == '승인거절') { ?><i class="v2">승인거절</i><?php }
                                else if($trader['state'] == '승인대기') { ?><i>승인대기</i><?php }
                                ?>
                            </a>
                        </div>
                    </div>
				</div>
				<!-- //일반회원 마이페이지 에서만 보이게 -->
                <?php } ?>
                <?php if($trader['state'] == '승인완료') { ?>
                <div class="withdraw_info bunker">
                    <a class="btn_withdraw" href="<?=G5_BBS_URL?>/mypage_withdraw.php?flag=Y">출금신청하기</a>
                </div>
                <?php } ?>

                </div>
				<?php
                if($member['mb_category'] == '일반') {
                    include_once('./mypage_menu.php');
                } else {
                    include_once('./mypage_cmenu.php');
                }
                ?>
			</div>
		</div>
	</div>

<script>

$(document).ready(function() {
    setDateBox();
    mypage_bunker(); // 리스트

    $(".tab_content").hide();
    $(".tab_content:first").show();

    $("ul.tabs li").click(function () {
		if(!($(this).find('a').length > 0)){
			$("ul.tabs li").removeClass("active");
			$(this).addClass("active");
			$(".tab_content").hide()
			var activeTab = $(this).attr("rel");
			$("#" + activeTab).fadeIn()

            if(activeTab == 'tab1') {
                $('#mode').val('in');
            } else if(activeTab == 'tab2') {
                $('#mode').val('out');
            } else {
                $('#mode').val('withdraw');
            }

            mypage_bunker(); // 리스트
		}
    });
});

// 연도 표시
function setDateBox(){
    var dt = new Date();
    var com_year = dt.getFullYear();
    // 2021년 부터 올해 연도까지 표시
    for(var y = 2021; y <= com_year; y++){
        var selected = '';
        if(y == com_year) {
            selected = 'selected';
        }
        $("#year").append("<option value='"+ y +"' "+selected+">"+ y + " 년" +"</option>");
    }
}

// 벙커 트레이더로 등록 시 3등 항해사 이상, 30만 벙커 이상 보유하고 있는지 확인
function bunkerCheck(data) {
    if(data == '승인대기') { // 승인 대기 중인 데이터가 있음
        swal('관리자 승인대기 상태입니다.');
        return false;
    }

    $.ajax({
        url : g5_bbs_url + "/ajax.bunker_check.php",
        type: 'POST',
        success : function(data) {
            if(data == 'success'){
                location.href = g5_bbs_url+'/mypage_withdraw.php';
            } else if(data == 'fail1') {
                swal('등급 미달\n(3등 항해사 이상)');
                return false;
            } else if(data == 'fail2') {
                swal('벙커 부족\n(30만 벙커 이상 보유)');
                return false;
            }
        },
        error : function(err) {
            swal(err.status);
        }
    });
}

// 적립내역/출금내역 리스트
function mypage_bunker(page) {
    if(page == undefined) { page = 1; }
    $('#page').val(page);

    $.ajax({
        url : g5_bbs_url + "/ajax.mypage_bunker.php",
        data: {page : $('#page').val(), mode : $('#mode').val(), year : $('#year').val(), month : $('#month').val()},
        type: 'POST',
        cache: false,
        async: false,
        success : function(data) {
            if(data){
                $('.bunker_'+$('#mode').val()).html(data);

                // 페이징 처리 -- 하단에 페이지 표시
                ajaxGetPaging();
            }
        },
        error : function(err) {
            swal(err.status);
        }
    });
}

// 페이징 처리 -- 페이지 클릭 시 동작 이벤트
function get_page(page) {
    mypage_bunker(page);
}
</script>

<?
include_once('./ajax.get_page.php');
include_once('./_tail.php');
?>
