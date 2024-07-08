<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

$device=isDevice();

// 헬퍼리스트 조회
$sql = "SELECT * FROM g5_member WHERE mb_level = 10 AND mb_status = '헬퍼' AND mb_3 != 'out' ORDER BY mb_datetime DESC";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

$helper_list = array();

for ($i = 0; $i < $result_cnt; $i++) {
	$helper_list[$i] = sql_fetch_array($result);
}
?>

<style>
.vertical-alignment-helper {
    display:table;
    height: 100%;
    width: 100%;
    pointer-events:none;
}
.vertical-align-center {
    /* To center vertically */
    display: table-cell;
    vertical-align: middle;
    pointer-events:none;
}
.modal-content {
    /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
    width:90%;
    height:inherit;
    /* To center horizontally */
    margin: 0px auto;
    pointer-events:all;
}
.modal-footer{ text-align:center !important}
.modal-body textarea{border-top:0px; border-right:0px; border-left:0px;border-bottom: 1px solid #ddd; width:100%;height:100px; }
</style>

<script>
$(function() {
	// 신고하기 클릭
	$("div.siren").on("click", function() {
		var html = "",
			helper_id = $(this).data("id");

		if (g5_is_member == "") {
			getLoginPage();
			return false;
		}

		html += '<form name="reportFrm" action="./write_update.php" method="post">';
		html += '<input type="hidden" name="w" value="">';
		html += '<input type="hidden" name="page_info" value="helper">';
		html += '<input type="hidden" name="bo_table" value="report">';
		html += '<input type="hidden" name="wr_subject" value="'+ helper_id +'">';
		html += '<textarea name="wr_content" placeholder="신고 내용을 입력해주세요"></textarea>';
		html += '<input type="button" value="신고접수" class="btn_submit_decla" onclick="reportSubmit();">';
		html += '</form>';

		$("#report_frm").html(html);
	});
});

function reportSubmit() {
	var f = document.reportFrm,
		txt = f.wr_content.value;

	if (txt.length == 0) {
		alert("신고 내용을 입력해 주세요.");
		f.wr_content.focus();
		return false;
	}

	f.submit();
}

</script>


<div class="h_area">

   <div class="c_box">
      <h3>헬퍼 이용방법</h3>
      <p>원하시는 헬퍼의 프로필 상담 신청 버튼을 누르시면<br /> 담당헬퍼 카톡 연결 후, 소개팅 무료 상담 및 원하시는 이상형과의 소개를 도와드립니다. <br />상담 및 소개 진행은 헬퍼가 출근 후 가능하니 양해 부탁드립니다.♥</p>
   </div>


        <!--헬퍼 리스트-->
        <div class="h_list">
            <ul>
                <?
                foreach ($helper_list as $key=>$row) {
                    $onoff_flag = ($row['mb_3'] == "on")? "ON" : "OFF";

                    // 헬퍼이미지
                    $rs = sql_fetch("SELECT mi_img FROM g5_member_img WHERE mb_id = '{$row['mb_id']}'");
                    $img_name = $rs['mi_img'];
                    $img_url = MB_IMG_URL."/".$img_name;

                    $helper_img = getImgSquare($img_url, $base_size=100);

                    // 1:1상담신청 링크
                    $helper_link = "javascript:alert('상담신청 준비중입니다.');";
                    if ($row['mb_2'] != "") {
                        $helper_link = preg_replace("/\s+/","", $row['mb_2']);
                    }
                    ?>
                    <li class="h_box">
                        <div class="cont">
                            <div class="mem_photo">
                                <div class="mem" style="overflow:hidden;"><?=$helper_img?></div>
                                <div class="suc">매칭♥성공<span><?=number_format(getMatchingCnt($row['mb_id']))?></span></div>
                                <div class="now <?=$onoff_flag?>">
                                    <p>출근상태</p>
                                    <h6><?=$onoff_flag?></h6>
                                </div>
                            </div>
                            <div class="mem_cont">
                                <h6><span>HELPER</span><?=$row['mb_name']?></h6>
                                <p><?=$row['mb_profile']?></p>
                                <span><?=$row['mb_4']?> | <?=$row['mb_1']?></span>
                            </div>
                        </div>
                        <div class="siren" data-id="<?=$row['mb_id']?>">
                            <a data-toggle="modal" href="#Decla"><i class="fas fa-exclamation-triangle"></i> 불편신고</a>
                        </div>
                        <div class="gear <?=$onoff_flag?>">
                        </div><!-- 아이폰일 때는 자바스크립트로 연동하기 그 외는 그냥 링크 걸기 -->
                        <a class="btn_counsel" href="<?php echo $device=="ios"?"javascript:helperLink('".$helper_link."');":$helper_link;?>">1:1 상담신청</a>

                        <!-- 신고 modal -->
                        <div class="modal fade" id="Decla" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="vertical-alignment-helper">
                                <div class="modal-dialog vertical-align-center">
                                    <div class="modal-content">
                                        <div class="modal-body" id="report_frm">
                                            불러오는 중입니다.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">창닫기</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </li>
                <? } ?>
            </ul>
        </div>
        <!--//헬퍼 리스트-->
    <?/*php } else {?>
       <!--헬퍼 리스트-->
       <div class="h_list">
           <ul>
               <?
               foreach ($helper_list as $key=>$row) {
                   $onoff_flag = ($row['mb_3'] == "on")? "checked" : "";

                   // 헬퍼이미지
                   $rs = sql_fetch("SELECT mi_img FROM g5_member_img WHERE mb_id = '{$row['mb_id']}'");
                   $img_name = $rs['mi_img'];
                   $img_url = MB_IMG_URL."/".$img_name;

                   $helper_img = getImgSquare($img_url, $base_size=100);

                   // 1:1상담신청 링크
                   $helper_link = "javascript:alert('상담신청 준비중입니다.');";
                   if ($row['mb_2'] != "") {
                       $helper_link = preg_replace("/\s+/","", $row['mb_2']);
                   }
               ?>
               <li class="h_box">
                   <div class="switch_area">
                       <label class="switch">
                            <input id="mb_auto" type="checkbox" class="switch-input" <?=$onoff_flag?> disabled="disabled">
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                      </label>
                   </div>
                   <div class="mem_photo">
                       <!--<div class="mem" style="background:url(../theme/lover/img/mobile/mem.jpg); background-size:100%"></div>-->
                       <div class="mem" style="overflow:hidden;"><?=$helper_img?></div>
                       <div class="suc"><?=number_format(getMatchingCnt($row['mb_id']))?><span>매칭 성공횟수</span></div>
                   </div>
                   <div class="mem_cont">
                       <dl>
                           <dt><span>HELPER</span><?=$row['mb_name']?></dt>
                           <dd><?=$row['mb_profile']?></dd>
                           <div class="siren" data-id="<?=$row['mb_id']?>">
                                <a data-toggle="modal" href="#Decla"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/btn_siren.png" alt=""></a>
                           </div>
                           <div class="t_margin12">
                            <!-- 아이폰일 때는 자바스크립트로 연동하기 그 외는 그냥 링크 걸기 -->
                            <a class="btn_counsel" href="<?php echo $device=="ios"?"javascript:helperLink('".$helper_link."');":$helper_link;?>">1:1 상담신청</a>
                           </div>
                       </dl>
                   </div>

                  <!-- 신고 modal -->
                    <div class="modal fade" id="Decla" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="vertical-alignment-helper">
                            <div class="modal-dialog vertical-align-center">
                                <div class="modal-content">
                                    <div class="modal-body" id="report_frm">
                                        불러오는 중입니다.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">창닫기</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

               </li>
               <? } ?>
           </ul>
       </div>
       <!--//헬퍼 리스트-->

    <?php }*/?>
</div>