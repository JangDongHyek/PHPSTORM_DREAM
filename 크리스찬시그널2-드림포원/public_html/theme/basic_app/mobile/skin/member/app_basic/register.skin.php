<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
?>

<div class="mbskin agr_check">
    <form name="fregister" id="fregister" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">
        <h2 class="title_top"><strong><span class="point">가입유형</span>을 선택해 주세요.</strong></h2>
		<!-- 애플로그인 할 때 필요 -->
		<input type="hidden" name="mb_id" value="<?=$_REQUEST['mb_id']?>">
        <input type="hidden" id="secret_member" name="secret_member" value="">
        <!--<h3 class="stitle">회원가입을 위한 필수 확인요건입니다. 아래 영역을 모두 체크해 주세요.</h3>-->

        <div id="join_agr">
            <div class="b_rdo cf">
                <div class="st">
                    <label>
                        <input type="radio" name="join_type" id="person_1" value="초혼" checked>
                        <em></em>
                        <div class="bx"><h2 class="tit"><span>초혼</span>입니다.</h2></div>
                    </label>
                </div>
                <div class="st">
                    <label>
                        <input type="radio" name="join_type" id="person_2" value="재혼">
                        <em></em>
                        <div class="bx"><h2 class="tit"><span>재혼</span>입니다.</h2></div>
                    </label>
                </div>

                <div class="st spec">
                    <label>
                        <input type="radio" name="join_type" id="person_2" value="장애인">
                        <em></em>
                        <div class="bx">
                            <h2 class="tit"><span>장애인</span>입니다.</h2>
                            <div class="scon">최고의 장애는 마음속에 있는 두려움입니다.<br />마음을 조금 더 열면 좋은 인연이 더 가까이 옵니다.</div>
                            <p><img src="<?php echo $member_skin_url;?>/img/info_ico03.png" alt="" /></p>
                        </div>
                    </label>
                </div>
            </div>
        </div><!--//join_chk-->

        <div class="btn_confirm">
            <input type="submit" class="btn_submit btn btn-primary btn-lg" value="가입신청하기">
			<a data-toggle="modal" class="btn_submit btn btn-primary btn-lg secret" data-target="#myModal" href="">시크릿 회원가입</a>
        </div>

    </form>
</div>

<!-- 시크릿회원 모달팝업 -->
<div id="basic_modal">
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
        <h4 class="modal-title" id="myModalLabel">시크릿 회원가입</h4>
      </div>
      <div class="modal-body">
		<div class="area_secret">
			<ul>
				<li>
					<i>01</i>
					<span>시크릿존은 본인 정보가 일반회원이나 시크릿존회원끼리도 정보공유가 되지 않습니다.</span>
				</li>
				<li>
					<i>02</i>
					<span>시크릿존 회원은 일반회원을 볼 수 있으며, 채팅도 가능합니다. 시크릿존 회원이 일반회원에게 채팅시에 일반회원도 채팅에 응할 수 있습니다.</span>
				</li>
				<li>
					<i>03</i>
					<span>시크릿존 회원은 1차적으로 일반회원을 요청시 자유롭게 채팅이 가능하며 시크릿 회원의 채팅을 원할경우는 추가비용이 발생합니다.</span>
				</li>
				<li>
					<i>04</i>
					<span>시크릿존의 비용안내 : 회원가입비 500,000원 적용됩니다.</span>
				</li>
			</ul>
		</div>	
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="secret_join();">확인</button>
      </div>
    </div>
  </div>
</div>
</div><!--basic_modal-->
<!-- 시크릿회원 모달팝업 -->

<script>
    /*$('input[name="join_type"]').change(function() {
        var value = $(this).val();
        $("input[name='join_type']").removeAttr('checked');
        $("input[name='join_type']:radio[value='"+value+"']").attr("checked", true);
    });*/

    /*function ag_check(obj) {
        if (obj.value == "0") {
            obj.value = "1";
        } else {
            obj.value = "0";
        }
    }*/

    function fregister_submit(f) {
        /*// 가입 자격 확인
        if ($("#rept1").prop("checked") == false || $("#rept2").prop("checked") == false || $("#rept3").prop("checked") == false) {
            $('#myModal').modal('show');
            return false;
        }*/

        if($("input[name='join_type']").is(":checked")) {

            if ($('input[name="join_type"]:checked').val() == "장애인"){
                swal('준비중입니다.');
                return false;
            }

            return true;

        }
        else {
            swal('가입유형을 선택해 주세요.');
            return false;
        }

    }

    // 시크릿 회원가입
    function secret_join() {
        $('#secret_member').val('Y');
        $('#fregister').submit();
    }
</script>