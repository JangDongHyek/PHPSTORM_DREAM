<?php
$pid = "counselor";
include_once("./app_head.php");

// 카운슬러 목록
$list = getCounselorList();

?>
<script>
    // 신고하기 모달
    function reportCounselor(mb_no) {
        let f = document.reportFrm;
        f.target_no.value = mb_no;
        f.content.value = "";

        $("#Decla").modal();
    }

    // 신고하기 등록
    function reportSubmit(f) {
        if (f.content.value == "") {
            swal("신고 내용을 입력해 주세요.");
            return false;
        }

        $.ajax({
            type : "POST",
            url : g5_bbs_url + "/ajax.app_update.php",
            data : {content: f.content.value, target_no: f.target_no.value, mode: 'counselorReport'},
            dataType : "json",
        }).done(function(data, textStatus, xhr) {
            if (data.result) {
                swal("카운슬러 신고가 완료되었습니다.").then(function () {
                    $("#Decla").modal('hide');
                });
            }
            else swal("카운슬러 신고에 실패했습니다. 잠시 후 다시 시도해 주세요.");
        }).fail(function(data, textStatus, errorThrown) {
            swal("카운슬러 신고에 실패했습니다. 잠시 후 다시 시도해 주세요.");
        });

        return false;
    }
</script>

<div id="counselor">
    <div class="info">
        <h3>카운슬러 상담신청 <i class="fa-sharp fa-solid fa-message-check"></i></h3>
        <p>카운슬러를 통해 소개팅 설명,방법 및 소개팅 진행을 받을수 있습니다.<br>
            <strong>ON/OFF</strong> 를 통해 출근 여부를 확인 하실 수 있고 실시간 상담을 통해 실시간 소개팅을 도와 드립니다 :) 소개팅 상담은 카운슬러 상담시간/출퇴근 확인,양해 부탁드립니다.</p>
    </div>
    <ul class="list">
        <?
        foreach ($list AS $key=>$row) { //while($row = sql_fetch_array($result)) {
            $class = $row['work_on'];
            $profile_img = ($row['mb_img'] && file_exists(MB_IMG_PATH."/".$row['mb_img']))? MB_IMG_URL."/{$row['mb_img']}" : "";

            // 1:1상담신청 링크
            $helper_link = "javascript:alert('상담신청 준비중입니다.');";
            if ($row['mb_2'] != "") {
                $helper_link = preg_replace("/\s+/","", $row['mb_2']);
            }
        ?>
        <li class="<?=$class?>">
            <!--출근여부 class : on/off-->
            <div class="left">
                <div class="photo btn_in">
                    <?if ($profile_img != "") { // 이미지 존재 ?>
                    <p><img src="<?=$profile_img?>"></p>
                    <?} else { // 이미지 없음?>
                    <div class="noimg"></div>
                    <?}?>
                    <a class="onoff"><?=strtoupper($row['work_on'])?></a>
                </div>
                <div class="num">
                    <p>매칭성공횟수</p>
                    <strong><?=number_format(getMatchingCnt($row['mb_id']))?></strong>
                </div>
                <a class="btn small" href="<?=$helper_link?>">1:1상담신청</a>
            </div>
            <div class="right">
                <div class="title">
                    <div>
                        <p class="name"><span>Counselor.</span> <strong><?=$row['mb_name']?></strong></p>
                        <dl>
                            <dt>출근시간</dt>
                            <dd><?=$row['work_time']?></dd>
                        </dl>
                        <dl>
                            <dt>카카오ID</dt>
                            <dd><?=$row['kakao_id']?></dd>
                        </dl>
                    </div>
                    <a href="javascript:void(0)" onclick="reportCounselor(<?=$row['mb_no']?>)"><i class="fa-solid fa-siren-on"></i></a>
                </div>
                <div class="greet"><?=$row['mb_profile']?></div>
            </div>
        </li>
        <?}?>

        <?/*
        <li class="on">
            <!--출근여부 class : on/off-->
            <div class="left">
                <div class="photo btn_in">
                    <p><img src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMDAyMDhfNDIg%2FMDAxNTgxMTM1NjMyMjAw.OTxV9AqNw1Uu3v4eoZ7yftSlDlB4DSaIc0ZTa1DcHvEg.xU7-LmEQwvV0qW3o8UTHV8QCNgiohGuLje7w38f4WzYg.JPEG.umibada0901%2FIMG_4190.jpg&type=a340"></p>
                    <a class="onoff">ON</a>
                </div>
                <div class="num">
                    <p>매칭성공횟수</p>
                    <strong>1,713</strong>
                </div>
                <a class="btn small">1:1상담신청</a>
            </div>
            <div class="right">
                <div class="title">
                    <div>
                        <p class="name"><span>Counselor.</span> <strong>지아</strong></p>
                        <dl>
                            <dt>출근시간</dt>
                            <dd>PM 12:00 - PM0 9:00</dd>
                        </dl>
                        <dl>
                            <dt>카카오ID</dt>
                            <dd>yeonin112</dd>
                        </dl>
                    </div>
                    <a data-toggle="modal" href="#Decla"><i class="fa-solid fa-siren-on"></i></a>
                </div>
                <div class="greet">저에 대한 문의사항은 채널을 통해 문의 부탁드려요
                    죽어있는 연애세포 살리기 장인! 실패없는 소개팅을
                    도와드릴 카운슬러 지아입니다.
                    카톡 남겨주시면 출근 후 친절히 상담 도와 드리겠습니다!
                    회원님의 연애세포를 소생시켜드릴게요
                    소중한 인연 열심히 도와드릴게요</div>
            </div>
        </li>
        <li class="off">
            <div class="left">
                <div class="photo btn_in">
                    <p><img src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMDAyMDhfNDIg%2FMDAxNTgxMTM1NjMyMjAw.OTxV9AqNw1Uu3v4eoZ7yftSlDlB4DSaIc0ZTa1DcHvEg.xU7-LmEQwvV0qW3o8UTHV8QCNgiohGuLje7w38f4WzYg.JPEG.umibada0901%2FIMG_4190.jpg&type=a340"></p>
                    <a class="onoff">OFF</a>
                </div>
                <div class="num">
                    <p>매칭성공횟수</p>
                    <strong>1,713</strong>
                </div>
                <a class="btn small">1:1상담신청</a>
            </div>
            <div class="right">
                <div class="title">
                    <div>
                        <p class="name"><span>Counselor.</span> <strong>지아</strong></p>
                        <dl>
                            <dt>출근시간</dt>
                            <dd>PM 12:00 - PM0 9:00</dd>
                        </dl>
                        <dl>
                            <dt>카카오ID</dt>
                            <dd>yeonin112</dd>
                        </dl>
                    </div>
                    <a data-toggle="modal" href="#Decla"><i class="fa-solid fa-siren-on"></i></a>
                </div>
                <div class="greet">저에 대한 문의사항은 채널을 통해 문의 부탁드려요
                    죽어있는 연애세포 살리기 장인! 실패없는 소개팅을
                    도와드릴 카운슬러 지아입니다.
                    카톡 남겨주시면 출근 후 친절히 상담 도와 드리겠습니다!
                    회원님의 연애세포를 소생시켜드릴게요
                    소중한 인연 열심히 도와드릴게요</div>
            </div>
        </li>
        */?>
    </ul>
</div>

<!--신고모달-->
<div class="modal fade in" id="Decla" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-backdrop fade"></div>
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i class="fa-light fa-xmark"></i></span></button>
                    <h4 class="modal-title">신고하기</h4>
                </div>
                <div class="modal-body" id="report_frm">
                    <form name="reportFrm" method="post" autocomplete="off" onsubmit="return reportSubmit(this)">
                        <input type="hidden" name="target_no" value="">
                        <textarea name="content" placeholder="신고 내용을 입력해주세요" style="height: 200px;"></textarea>
                        <input type="submit" value="신고접수" class="btn">
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>


<?php
include_once ("./app_tail.php");
?>
