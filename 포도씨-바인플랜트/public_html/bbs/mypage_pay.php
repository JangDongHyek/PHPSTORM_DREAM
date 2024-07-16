<?
include_once('./_common.php');
$name = "mypage";
$g5['title'] = '상품판매 대금관리';
include_once('./_head.php');
?>

<? if($name=="mypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="<?php echo $member['mb_category'] == '일반' ? 'mypage' : 'cmypage'; ?>">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
    /*.v3 {background: darkgray;}*/
</style>

    <input type="hidden" name="mode" id="mode" value="sales">
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
						<h3>판매대금관리</h3>

						<div class="pay_type">
							<ul class="pay_list">
								<li class="total">
                                    <span>총 판매대금</span><h3 class="number"><?=number_format($member['sales_proceeds_acc'])?></h3><span>원</span>
								</li>
							</ul>
						</div>

						<div class="box_cont">
							<div class="box_top">
								<ul class="tabs">
									<li class="active" rel="tab1"><span>판매내역</span></li>
                                    <li rel="tab2"><span>출금내역</span></li>
								</ul>
                                <div class="flex js">
                                    <div>
                                        <div class="filter">
                                            <select class="year" id="year" name="year" onchange="mypage_pay();"></select>
                                            <select class="month" id="month" name="month" onchange="mypage_pay();">
                                                <?php for($i=1; $i<=12; $i++) { ?>
                                                <option value="<?=$i?>" <?php echo date('m') == $i ? 'selected' : ''; ?>><?=$i?>월</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="chk">
                                    <input type="checkbox" id="all_view" name="all_view"><label for="all_view">전체목록</label>
                                    </div>
                                </div>
							</div>
							<div class="tab_container">
								<div id="tab1" class="tab_content">
									<div class="box_cont">
										<div class="table_wrap">
											<ul class="tbl_hd tbl">
												<li class="data w15">판매일</li>
                                                <li class="data w15">구매자</li>
												<li class="type w2">카테고리</li>
												<li class="cont w4">제목</li>
												<li class="price w1">금액</li>
											</ul>
                                            <!--ajax.mypage_pay_list.php-->
											<ul class="tbl_cont_wrap sales_list"></ul>
										</div>
									</div>
								</div>
                                <div id="tab2" class="tab_content" style="display: none;">
                                    <div class="box_cont">
                                        <div class="table_wrap">
                                            <ul class="tbl_hd tbl">
                                                <li class="state w1">상태</li>
                                                <li class="data w2">신청일</li>
                                                <li class="account w3">은행 / 계좌번호 / 예금주</li>
                                                <li class="price w2">금액</li>
                                                <li class="data2 w2">지급일시</li>
                                            </ul>
                                            <!--ajax.mypage_pay_list.php-->
                                            <ul class="tbl_cont_wrap withdraw_list"></ul>
                                        </div>
                                    </div>
                                </div>
                                <div id="paging"></div>
							</div>
						</div>
					</div>
				</div>

                <div class="withdraw_info bunker">
                    <?php if($member['mb_level'] == 2) {
                    ?>
                    <a class="btn_withdraw" href="<?=G5_BBS_URL?>/mypage_pay_withdraw.php">출금신청하기</a>
                    <?php
                    } else if($member['mb_level'] == 3) {
                    ?>
                    <span style="font-weight: bold;">※ 판매로 얻은 벙커는 podosea 내 사용 및 선물하기 외에 사용이 불가합니다.</span>
                    <?php
                    }
                    ?>
                </div>

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
    mypage_pay(1); // 리스트

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
                $('#mode').val('sales');
            } else {
                $('#mode').val('withdraw');
            }

            mypage_pay(1); // 리스트
        }
    });

    $("#all_view").click(function() {
        if(this.checked) $(".filter").hide();
        else $(".filter").show();
        mypage_pay(1);
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

// 판매내역 리스트
function mypage_pay(page) {
    if(page == undefined) { page = 1; }
    $('#page').val(page);

    var all_view = $("#all_view").is(":checked") ? "Y" : "N";

    $.ajax({
        url : g5_bbs_url + "/ajax.mypage_pay_list.php",
        data: {page : $('#page').val(), mode : $('#mode').val(), year : $('#year').val(), month : $('#month').val(), all_view: all_view},
        type: 'POST',
        cache: false,
        async: false,
        success : function(data) {
            if(data){
                var mode = $('#mode').val();
                console.log(mode);
                $('.'+mode+'_list').html(data);

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
    mypage_pay(page);
}
</script>

<?
include_once('./ajax.get_page.php');
include_once('./_tail.php');
?>
