<?
include_once('./_common.php');
$g5['title'] = '서비스등록';
include_once('./_head.php');
$name = "item_write";

//서비스정보
$idx = $_REQUEST['idx'];
$sql = "select * from new_item where i_idx = '{$idx}' ";
$view = sql_fetch($sql);

if ($view['i_idx'] == ""){
    $view = $_REQUEST;
}

$sql = "select * from new_cancel_rule where cr_category1 = '{$view["i_ctg"]}' ";
$popup_result = sql_fetch($sql);

?>

<? if($name=="item_write") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="item_write">
<?}?>

<style>
	#ft_menu{display:none;}
</style>

<!-- 취소 및 환불규정 모달팝업/카테고리별로 환불 규정 내용이 달라집니다. 현재는 1차카테고리(디자인) > 2차카테고리(웹툰.캐릭터)를 임의로 선택하고 등록가정임-->
<div id="basic_modal">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    <h4 class="modal-title" id="myModalLabel">취소 및 환불 규정 보기</h4>
                </div>
                <div class="modal-body">
                    <div class="cont ref" style="white-space: pre-wrap;"><?= isset($popup_result['cr_content']) ? $popup_result['cr_content']: "등록안됨";?></div><!--cont-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">확인하였습니다</button>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 취소 및 환불규정 모달팝업 -->


	<div id="item_write">
            <div class="inr v2">
			<h3>서비스등록</h3>
			<div class="snb">
				<ul class="list_step">
                    <li id="">
                        <a href="javascript:tab_click(1)">
                            <em>1</em>
                            <span>기본정보</span>
                        </a>
                    </li>
                    <li id="" class="active">
                        <a href="javascript:tab_click(2)">
                            <em>2</em>
                            <span>서비스 설명</span>
                        </a>
                    </li>
                    <li id="">
                        <a href="javascript:tab_click(3)">
                            <em>3</em>
                            <span>이미지 등록</span>
                        </a>
                    </li>
				</ul>
			</div>
			<div class="box_list">				
				<div class="box_content">
					<div class="box_write02">
						<h4>서비스설명</h4>
						<div class="cont">
							<!-- 에디터 넣어주세요~! -->
							<textarea name = "i_content" placeholder="전문인 소개(경력 및 이력), 작업 가능 분야, 작업 제공 절차, 서비스 특징에 대해서 의뢰인이 이해하기 쉽도록 정확하게 작성해 주세요. &#13;&#10;외부연락처(전화번호 및 카톡ID, 이메일, 외부링크)는 노출하실 수 없습니다."><?=$view['i_content']?></textarea>
						</div>
					</div>
					<!--<div class="box_write02">
						<h4>수정·재진행</h4>
						<div class="cont">
							<textarea name = "i_update_content"><?/*=$view['i_update_content']*/?></textarea>
						</div>
					</div>-->
					<div class="box_write02">
						<h4>취소 및 환불 규정</h4>
						<div class="cont">
							<div class="box_refund">
								<span>취소 및 환불규정은 판매하시는 서비스의 관련 법령에 따라 일괄 적용됩니다.</span>
								<div data-toggle="modal" data-target="#myModal" class="btn_info">취소 및 환불규정 보기</div>
							</div>
						</div>
					</div>
                    <div class="box_write02">
                        <h4>자주 묻는 질문</h4>
                        <div class="cont faq">
                            <div class="faq_active">
                                <dl class="box_gray">
                                    <a class="del"><i class="fa-regular fa-trash"></i></a>
                                    <dt><strong>Q.</strong><input type="text" placeholder="자주 묻는 질문을 입력해주세요"></dt>
                                    <dd><strong>A.</strong><textarea type="text" placeholder="답변을 입력해주세요"></textarea></dd>
                                </dl>
                            </div>
                            <button class="btn_add"><i class="fa-light fa-plus"></i> 질문 추가</button>
                        </div>
                    </div>
                    <div class="box_write02">
                        <h4>상품 정보 제공 고지</h4>
                        <div class="cont">
                            <div class="box_gray">
                                <dl class="grid2">
                                    <dt>서비스 제공자</dt>
                                    <dd><input type="text" placeholder="서비스 제공자"></dd>
                                    <dt>취소·환불 조건</dt>
                                    <dd><input type="text" placeholder="최소 및 환불 규정 참조"></dd>
                                    <dt>인증·허가사항</dt>
                                    <dd><input type="text" placeholder="상품 상세 참조"></dd>
                                    <dt>취소·환불방법</dt>
                                    <dd><input type="text" placeholder="취소 및 환불 규정 참조"></dd>
                                    <dt>이용조건</dt>
                                    <dd><input type="text" placeholder="상품 상세 참조"></dd>
                                    <dt>소비자 상담전화</dt>
                                    <dd><input type="text" placeholder="예) (고객센터)1234-1234"></dd>
                                </dl>
                            </div>
                        </div>
                    </div>

                </div>
			</div>
			<div id="area_btn">
			
				<a class="btn_prev" href="javascript:tab_click(1)">이전</a>
				<a class="btn_next" href="javascript:tab_click(3)">다음</a>
			</div>
		</div>
	</div>


<script>


    function fsave_submit2() {
        var msg = "";
        var is_submit = true;

        //2단계보다 큰 단계로 넘어 갈 경우.
        if ($('#click_tab').val() > 2 ) {
            //i로 시작하는 input value 빈값찾기
            $.each($(".inr [name^='i_']"), function (index, item) {

                if ($(this).attr('name') == "i_content") {
                    msg = "서비스설명을 입력해주세요.";

                } else {
                    msg = "수정 재진행 사항을 입력해주세요.";
                }

                if ($(this).val() == "") {
                    swal(msg);
                    is_submit = false;
                }

            });
        }

        if (is_submit) {
            css_block_none($('#click_tab').val());
        }


    }

</script>

