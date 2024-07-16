<?php
$sub_menu = "215100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if ($w == 'u') {
    $cr = sql_fetch(" select cr.*, mb.mb_company_name from g5_career_recruit as cr left join g5_member as mb on mb.mb_id = cr.mb_id where cr.idx = {$idx} ");

    $term = $cr['cr_always'] == 'Y' ? '상시채용' : $cr['cr_stdate'].'~'.$cr['cr_eddate'];
} else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}

$g5['title'] .= '채용공고';
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

<form name="fcareer" id="fcareer" method="post" enctype="multipart/form-data">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div class="tbl_frm01 tbl_wrap">
        <h1 class="subj">* 채용정보</h1>
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col width="10%">
                <col width="*">
                <col width="10%">
                <col width="*">
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="mb_company_name">회사명<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="mb_company_name" value="<?php echo $cr['mb_company_name'] ?>" id="mb_company_name" class="frm_input" size="100"></td>
                <th scope="row"><label for="cr_subject">제목<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="cr_subject" value="<?php echo $cr['cr_subject'] ?>" id="cr_subject" class="frm_input" size="100"></td>
            </tr>
            <tr>
                <th scope="row"><label for="cr_site">채용공고사이트<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="cr_site" value="<?php echo $cr['cr_site'] ?>" id="cr_site" class="frm_input" size="100"></td>
                <th scope="row"><label for="cr_stdate">접수기간<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="cr_stdate" value="<?php echo $term ?>" id="cr_stdate" class="frm_input" size="100"></td>
            </tr>
            <tr>
                <th scope="row"><label for="cr_work_type">근무형태<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="cr_work_type" value="<?php echo $cr['cr_work_type'] ?>" id="cr_work_type" class="frm_input" size="100"></td>
                <th scope="row"><label for="cr_work_position">직책<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="cr_work_position" value="<?php echo $cr['cr_work_position'] ?>" id="cr_work_position" class="frm_input" size="100"></td>
            </tr>
            <tr>
                <th scope="row"><label for="cr_work_salary">연봉<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="cr_work_salary" value="<?php echo $recruit_salary[$cr['cr_work_salary']] ?>" id="cr_work_salary" class="frm_input" size="100"></td>
                <th scope="row"><label for="cr_work_addr">근무지<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="cr_work_addr" value="<?php echo $cr['cr_work_addr'] ?>" id="cr_work_addr" class="frm_input" size="100"></td>
            </tr>
            <tr>
                <th scope="row"><label for="cr_manager">채용담당자<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="cr_manager" value="<?php echo $cr['cr_manager'] ?>" id="cr_manager" class="frm_input" size="100"></td>
                <th scope="row"><label for="cr_hp">연락처<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="cr_hp" value="<?php echo $cr['cr_hp'] ?>" id="cr_hp" class="frm_input" size="100"></td>
            </tr>
            <tr>
                <th scope="row"><label for="cr_email">이메일<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="cr_email" value="<?php echo $cr['cr_email'] ?>" id="cr_email" class="frm_input" size="100"></td>
                <th scope="row"><label for="cr_hashtag">해시태그<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="cr_hashtag" value="<?php echo $cr['cr_hashtag'] ?>" id="cr_hashtag" class="frm_input" size="100"></td>
            </tr>
            <tr>
                <th scope="row"><label for="cr_addr">회사위치<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="cr_addr" value="<?php echo $cr['cr_addr'] ?>" id="cr_addr" class="frm_input" size="100"></td>
                <th scope="row"><label for="cr_addr2">상세주소<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="cr_addr2" value="<?php echo $cr['cr_addr2'] ?>" id="cr_addr2" class="frm_input" size="100"></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="btn_confirm01 btn_confirm">
        <a href="./career_list.php?<?php echo $qstr ?>">목록</a>
    </div>
</form>

<div class="tbl_head02 tbl_wrap mb_tbl">
    <h1 class="subj">* 이력서</h1>
    <table>
        <thead>
        <tr>
            <th>No.</th>
            <th>아이디</th>
            <th>제목</th>
            <th>이름</th>
            <th>연락처</th>
            <th>이메일</th>
            <th>첨부파일</th>
            <th>지원일시</th>
            <th>이력서열람여부</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = " select * from g5_resume where recruit_idx = {$idx} order by idx ";
        $result = sql_query($sql);

        for($i=0; $row=sql_fetch_array($result); $i++) {
        ?>
        <tr>
            <td><?=$i+1?></td>
            <td><?=$row['mb_id']?></td>
            <td><?=$row['re_subject']?></td>
            <td><?=$row['re_name']?></td>
            <td><?=$row['re_hp']?></td>
            <td><?=$row['re_email']?></td>
            <td>
            <?php
            $filecount = sql_fetch(" select count(*) as count from g5_resume_file where resume_idx = {$row['idx']}; ")['count'];
            if($filecount > 0) {
                $file_sql = " select * from g5_resume_file where resume_idx = {$row['idx']} order by idx; ";
                $file_result = sql_query($file_sql);
                for($j=0; $file=sql_fetch_array($file_result); $j++) {
                ?>
                <span class="fileName"><a style="text-decoration: underline;" href="<?=G5_DATA_URL?>/file/resume/<?=$file['img_file']?>" download="<?=$file['img_source']?>"><?=$file['img_source']?></a></span><br>
                <?php
                }
            }
            else {
            ?>
                -
            <?php
            }
            ?>
            </td>
            <td><?=substr($row['wr_datetime'],0,16)?></td>
            <td><?=$row['read_yn'] == 'Y' ? '열람' : '';?></td>
        </tr>
        <?php
        }
        if($i==0) {
        ?>
        <tr>
            <td colspan="9">이력서가 없습니다.</td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>

<script>
$(function() {
    $("input").attr('readonly', true);
    $("textarea").attr('readonly', true);
    $('#input_id').attr('readonly', false);
});

// 견적보내기 (팝업)
function estimate() {
    window.open('./popup.estimate.php?idx=<?=$idx?>', "", "left=350, top=100, status=0, width=450, height=550" );
}

// 의뢰전달하기 (팝업)
function inquiryPass() {
    $('#passModal').appendTo("body").modal('show');
}

// 아이디/회사명 검색
function search_id(f) {
    if (f.input_id.value.length < 2) {
        alert('검색어를 2자 이상 입력하세요.');
        f.input_id.focus();
        return false;
    }

    $.ajax({
        type : "get",
        url : "./ajax.id_search.php",
        data : {"id": f.input_id.value, mb_id: '<?=$cr['mb_id']?>', mode: "company"},
        dataType : "html",
        async : false,
        success : function(data) {
            $("#srch_result").html(data);
        },
        error : function(xhr,status,error) {
            console.log(error);
        },
        complete : function() {
            return false;
        }
    });

    return false;
}

// 아이디/회사명 검색 선택 - 의뢰전달
function select_id(mb_id) {
    $.ajax({
        url: "./ajax.inquiry_pass",
        data: {idx: '<?=$idx?>', mb_id: mb_id},
        type: "post",
        success: function(data) {
            if(data == 'success') {
                alert('의뢰가 전달되었습니다.');
                location.reload();
            } else {
                alert('의뢰가 이미 전달되었습니다.');
                //$('#passModal').modal('hide');
            }
        },
    })
}

</script>

<?php
include_once('./admin.tail.php');
?>