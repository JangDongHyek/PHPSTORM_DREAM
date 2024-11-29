<?php
//$sub_menu = "210100";
include_once('./_common.php');

$mb_no = $_GET['mb_no'];
$mb = sql_fetch(" select * from g5_member where mb_no = {$mb_no}; "); // 회원 정보

$sql = " select * from g5_member_history as history where history.mb_no = {$mb_no} and lesson_idx is not null order by idx desc  ";
$result = sql_query($sql);

$g5['title'] = '상품 등록 이력';
include_once(G5_PATH.'/head.sub.php');
?>

<style>
    #mem_his_wrap .metf {
        font-size: 1.7em;
        font-weight: 500;
        padding: 0px 20px 10px 0px;
    }
</style>


<!--동영상재생모달 시작-->
<div id="lere_modal2">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-header">
                    동영상 재생
                </div>

                <div class="modal-body">

                </div>
            </div><!--.modal-body-->
        </div>
    </div>
</div><!--#lere_modal2-->
<!--동영상재생모달 끝-->


<div id="mem_his_wrap">
    <div class="metf"><?php echo $g5['title']; ?></div>

    <!--회원정보-->
    <div id="mem_his_info">
        <div class="mh_name">
            <!--회원상태-->
            <span class="mh_state">
                <?php if($mb['mb_state'] == 'new_member') { echo '<span class="mhs mhs_01">신규</span>'; } ?>
                <?php if($mb['mb_state'] == 're_member') { echo '<span class="mhs mhs_02">재등록</span>'; } ?>
                <?php if($mb['mb_state'] == 'one_point_lesson') { echo '<span class="mhs mhs_04">원포인트</span>'; } ?>
                <?php if($mb['mb_state'] == 'online') { echo '<span class="mhs mhs_03">온라인</span>'; } ?>
                <?php if($mb['mb_state'] == 'no_register') { echo '<span class="mhs mhs_03">미등록</span>'; } ?>
                <?php if($mb['mb_state'] == 'no_long_register') { echo '<span class="mhs mhs_03">휴면</span>'; } ?>
            </span>
            <!--회원상태에 따른 클래스명
            신규 mhs_01
            재등록 mhs_02
            휴면/미등록/온라인 mhs_03
            원포인트 mhs04
            -->

            <span class="mh_num"><?=$mb['mb_id_no']?></span><!--회원번호-->
            <span class="mh_t"><?=$mb['mb_name']?> 회원님</span><!--회원이름-->
        </div><!--.mh_name-->

        <div class="mh_info">
            <ul>
               <li><strong>담당프로</strong> <?=$mb['mb_charge_pro']?></li><!--담당프로-->
               <li><strong>휴대전화</strong> <?=$mb['mb_hp']?></li>
               <li><strong>주소</strong> <?=$mb['mb_addr1']?><?php if(!empty($mb['mb_addr2'])) { echo ', '.$mb['mb_addr2'];}?></li>
               <li><strong>이메일</strong> <?=$mb['mb_email']?></li>
               <li><strong>생년월일</strong> <?=$mb['mb_birth']?></li>
            </ul>
        </div><!--.mh_info-->
    </div><!--#mem_his_info-->


    <div class="mem_his_tit">레슨내역</div>

	<!--회원 레슨내역-->
    <div class="guideBox">
        <?php
        for($i=0; $row=sql_fetch_array($result); $i++) {
            $lesson_name = explode('/', $row['lesson_name']);
            $pro_name = sql_fetch(" select mb_name from {$g5['member_table']} where mb_no = '{$row['pro_mb_no']}'; ")['mb_name'];
        ?>
        <div class="mem_his_bt">
        	<div class="mh_bar">
                <div class="mhb_t"><?=$lesson_name[0]?>&nbsp;&nbsp;<?=$lesson_name[1].'/'.$lesson_name[2]?></div><!--레슨명-->
                <div class="mhb_d">등록일 <?=substr($row['reg_date'],0,10)?></div><!--등록일-->
                <div class="mhb_d">[<?=$pro_name?> 프로]</div><!--프로명-->
			</div><!--.mh_bar-->

            <div class="mh_open"><span class="textbtn">세부내역 <i class='fal fa-angle-down'></i></span></div><!--세부내역보기 버튼-->
            <div style="display:none">
                <div class="tbl_mh">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th scope="col" width="10%">회차</th>
                            <th scope="col" width="20%">날짜</th>
                            <th scope="col" width="50%">레슨내용</th>
                            <th scope="col" width="10%">동영상</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        // 레슨 일지 이력
                        $sql2 = " select diary.*, video.img_file from g5_lesson_diary as diary left join g5_lesson_video as video on video.diary_idx = diary.idx where diary.history_idx = {$row['idx']}; ";
                        $result2 = sql_query($sql2);

                        for($k=0; $diary=sql_fetch_array($result2); $k++) {
                        ?>
                            <tr>
                                <td><?=$diary['lesson_count']?>회차</td>
                                <td><?=$diary['lesson_date']?></td>
                                <td style="white-space: pre-wrap;text-align: left;"><?=$diary['lesson_contents']?></td>
                                <td>
                                    <!--동영상 있을때-->
                                    <?php
                                    if($diary['img_file'] && file_exists(G5_DATA_PATH . '/file/lesson/' . $diary['img_file'])) {
                                        $video_src = G5_DATA_URL . '/file/lesson/' . $diary['img_file'];
                                    ?>
                                        <div class="mh_movie"><img src="<?php echo G5_IMG_URL ?>/ico_movie.gif" alt="" onclick="video_play('<?=$video_src?>');"/></div>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        if($k==0) {
                        ?>
                            <tr>
                                <td colspan="4">내역이 없습니다.</td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div><!--.tbl_mh-->
            </div><!--display:none-->


        </div><!--.mem_his_bt-->
        <?php
        }
        if($i==0) {
        ?>
            이력이 없습니다.
        <?php
        }
        ?>
	</div><!--.guideBox-->
</div><!--#mem_his_wrap-->

<script>
//세부내역 열기 닫기 버튼
$(document).on("click",".guideBox .mh_open",function(){
    if ($(this).next().css('display') == "none") {
        $(this).next().show();
        $(this).children("span").html("내역닫기 <i class='fal fa-angle-up'></i>");
    } else {
        $(this).next().hide();
        $(this).children("span").html("세부내역 <i class='fal fa-angle-down'></i>");
    }
});

// 동영상 재생 (레슨일지idx, 동영상경로)
function video_play(video) {
    $('#myModal').modal('show');
    $('#myModal .modal-body').html('<video id="videoPlay" width="100%" height="500" controls src="'+video+'"></video>');
}
</script>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>
