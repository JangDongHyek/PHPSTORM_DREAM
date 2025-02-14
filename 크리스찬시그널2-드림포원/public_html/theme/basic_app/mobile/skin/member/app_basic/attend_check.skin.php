<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);

$sql = "select * from new_attend_check where mb_id = '{$member["mb_id"]}' order by ac_idx desc limit 1";
$last_day = sql_fetch($sql)["ac_day"];


?>

<style>
	body{
		background: #fafafa;
	}
</style>
<!-- 메세지 모달팝업 -->
<div id="basic_modal">
	<!-- Modal -->
	<div class="modal fade" id="check_ok" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
					<h4 class="modal-title" id="myModalLabel">출석체크 완료</h4>
				</div>
				<div class="modal-body msg_con">
					<h3><span class="color">출석체크</span>가 되었어요</h3>
					<p>내일도 잊지말고 체크하세요!</p>
					<p>하루라도 체크를 건너뛸 경우 다시 1일차부터 체크가 돼요</p>
				</div>
				<!--msg_con-->
			</div>
		</div>
	</div>
</div>
<div id="basic_modal">
	<!-- Modal -->
	<div class="modal fade" id="check_no" tabindex="-1" check_okrole="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
					<h4 class="modal-title" id="myModalLabel">출석체크 완료</h4>
				</div>
				<div class="modal-body msg_con">
					<h3>오늘은 이미 <span class="color">출석체크</span>를 했어요</h3>
					<p>내일도 잊지말고 체크하세요!</p>
				</div>
				<!--msg_con-->
			</div>
		</div>
	</div>
</div>
<div id="basic_modal">
	<!-- Modal -->
	<div class="modal fade" id="bonus_pop" tabindex="-1" check_okrole="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
					<h4 class="modal-title" id="myModalLabel">출석체크 완료</h4>
				</div>
				<div class="modal-body msg_con">
					<a class="b_box"></a>
					<p><strong>박스</strong>를 눌러주세요</p>
				</div>
				<!--msg_con-->
			</div>
		</div>
	</div>
</div>
<!--basic_modal-->
<!-- 메세지 모달팝업 -->
<!--알람설정 시작-->
<div id="event">
	<div class="top">
		<img src="<?php echo G5_THEME_IMG_URL ?>/app/ccheck_img01.jpg" alt="">
	<a href="javascript:attend_click()">출석체크하기</a>
	</div>
	<div class="calendar">
		<h1>
			1일 출석 <span class="point">30만나</span><br>
			7일 출석시 <span class="point">보너스 30만나</span>를 드립니다!
		</h1>
		<ul id = "attend_ul">
			<li>
<!--class="on" -->
				<a>
                    <h6>1일차</h6>
					<p>30만나</p>
				</a>
			</li>
			<li>
				<a>
					<h6>2일차</h6>
					<p>30만나</p>
				</a>
			</li>
			<li>
				<a>
					<h6>3일차</h6>
					<p>30만나</p>
				</a>
			</li>
			<li>
				<a>
					<h6>4일차</h6>
					<p>30만나</p>
				</a>
			</li>
			<li>
				<a>
					<h6>5일차</h6>
					<p>30만나</p>
				</a>
			</li>
			<li>
				<a>
					<h6>6일차</h6>
					<p>30만나</p>
				</a>
			</li>
			<li>
				<a class="bonus_btn">
					<img src="<?php echo G5_THEME_IMG_URL ?>/app/event_box.png" style="width:50px; margin:0 0 10px;">
					<h6>7일차</h6>
<!--					<p>10만나 + 보너스 30만나</p>-->
				</a>
			</li>
		</ul>
	</div>
</div><!--mypage-->
<!--마이페이지 끝-->

<script>
    $(document).ready(function () {
        attend_add_class("<?=$last_day?>");
    });
    function attend_click() {
        $.ajax({
            url: g5_bbs_url + "/ajax.controller.php",
            data: {mode: "attend_check"},
            type: 'POST',
            datatype: 'json',
            success: function (data) {
                data = JSON.parse(data);
                if (data["result"] == "success") {

                    attend_add_class(data["day"]);

                    if (data["day"] == 7){
                        bonus_click();
                    }else{
                        $("#check_ok").modal();
                    }

                }else  if (data["result"] == "chk_no") {
                    $("#check_no").modal();
                }
            },
            error: function () {
                swal("통신에러입니다. 관리자에게 문의해주세요")
            }
        });
    }

    function attend_add_class(day) {
        $("#attend_ul>li>a").removeClass("on");
        for (var i=0; i < day; i++){
            $("#attend_ul>li:eq("+i+")>a").addClass("on");
        }
    }
	
	
//	7일차일때
	function bonus_click(){
		
		$('#bonus_pop').modal('show');
		$('.b_box').click(function(){
			$(this).addClass('on');
			$(this).next('p').html('<strong>축하합니다!</strong><br>30만나 + 보너스 30만나가 지급되었습니다')
		})
	}
</script>