<?php
include_once ("./_common.php");
/**
 * 관리자-자료실-상세페이지 (+구매/판매내역)
 */

auth_check($auth[$sub_menu], 'w');

if (!empty($idx)) {
    $rr = sql_fetch(" select * from g5_reference_room where idx = '{$idx}' ");
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

$g5['title'] .= '자료실';
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>
<style>
    .btn_submit {
        padding: 0 5px;
        height: 24px;
        border: 0;
        color: #fff;
        vertical-align: middle;
        cursor: pointer;
    }
    .btn_pass {
        background: blue;
        font-weight: bold;
    }
</style>

<form name="finquiry" id="fcompanyinquiry" method="post" enctype="multipart/form-data">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="token" value="">

        <div class="tbl_frm01 tbl_wrap">
            <h1 class="subj">* 자료상세정보</h1>
            <table>
                <caption><?php echo $g5['title']; ?></caption>
                <colgroup>
                    <col width="10%">
                    <col width="25%">
                    <col width="10%">
                    <col width="*">
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row"><label for="rr_category">카테고리<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <input type="radio" name="rr_category" value="양식/서식" <?php echo $rr['rr_category'] == '양식/서식' ? 'checked' : 'disabled';  ?> class="frm_input"><span style="margin-right: 5px;">양식/서식</span>
                        <input type="radio" name="rr_category" value="비즈니스(산업)" <?php echo $rr['rr_category'] == '비즈니스(산업)' ? 'checked' : 'disabled';  ?> class="frm_input"><span style="margin-right: 5px;">비즈니스(산업)</span>
                        <input type="radio" name="rr_category" value="보고서/회의" <?php echo $rr['rr_category'] == '보고서/회의' ? 'checked' : 'disabled';  ?> class="frm_input"><span style="margin-right: 5px;">보고서/회의</span>
                        <input type="radio" name="rr_category" value="노하우" <?php echo $rr['rr_category'] == '노하우' ? 'checked' : 'disabled';  ?> class="frm_input"><span>노하우</span>
                        <input type="radio" name="rr_category" value="리포트/논문" <?php echo $rr['rr_category'] == '리포트/논문' ? 'checked' : 'disabled';  ?> class="frm_input"><span>리포트/논문</span>
                        <input type="radio" name="rr_category" value="기타" <?php echo $rr['rr_category'] == '기타' ? 'checked' : 'disabled';  ?> class="frm_input"><span>기타</span>
                    </td>
                    <th scope="row"></th>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row"><label for="rr_subject">제목<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="rr_subject" value="<?php echo $rr['rr_subject'] ?>" id="rr_subject" class="frm_input" size="60"></td>
                    <th scope="row"></th>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row"><label for="rr_hashtag">해시태그<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="rr_hashtag" value="<?php echo $rr['rr_hashtag'] ?>" id="rr_hashtag" class="frm_input" size="60"></td>
                    <th scope="row"></th>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row"><label for="rr_contents">내용소개<strong class="sound_only">필수</strong></label></th>
                    <td><?=nl2br($rr['rr_contents'])?></td>
                    <th scope="row"></th>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row"><label for="ci_file">자료업로드<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <?php
                        $filecount = sql_fetch(" select count(*) as count from g5_reference_room_file where reference_idx = {$idx}; ")['count'];
                        if($filecount > 0) {
                            $file_sql = " select * from g5_reference_room_file where reference_idx = {$idx} order by idx; ";
                            $file_result = sql_query($file_sql);
                            for($i=0; $row=sql_fetch_array($file_result); $i++) {
                            ?>
                            <span class="fileName"><a style="text-decoration: underline;" href="<?=G5_DATA_URL?>/file/reference/<?=$row['img_file']?>" download="<?=$row['img_source']?>"><?=$row['img_source']?></a></span><br>
                            <?php
                            }
                        } else { ?>
                        <span>자료가 없습니다.</span>
                        <?php } ?>
                    </td>
                    <th scope="row"></th>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row"><label for="rr_price">가격<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="rr_price" value="<?=$rr['rr_is_free']=='Y'?'무료':number_format($rr['rr_price'])?>" id="rr_price" class="frm_input" size="60"><?=$rr['rr_is_free']=='N'?'원':''?></td>
                    <th></th>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="btn_confirm01 btn_confirm">
            <?php if(!empty($rr['podosea'])) { ?>
                <input type="button" value="의뢰전달" class="btn_submit" onclick="inquiryPass();" style="background: blue;font-weight: bold;">
            <?php } ?>
            <a href="./reference.php?<?php echo $qstr ?>">목록</a>
        </div>
    </form>

<div class="tbl_head02 tbl_wrap mb_tbl" style="width: 50%">
    <h1 class="subj">* 판매현황</h1>
    <table>
        <colgroup>
            <col width="10%">
            <col width="20%">
            <col width="20%">
        </colgroup>
        <thead>
        <tr>
            <th>No.</th>
            <th>구매자</th>
            <th>구매일</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = " select * from g5_reference_room_sale where reference_idx = {$idx} order by idx ";
        $result = sql_query($sql);

        for($i=0; $row=sql_fetch_array($result); $i++) {
            ?>
            <tr>
                <td><?=$i+1?></td>
                <td><?=$row['buy_mb_id']?></td>
                <td><?=substr($row['wr_datetime'], 0, 10)?></td>
            </tr>
            <?php
        }
        if($i==0) {
            ?>
            <tr>
                <td colspan="7">판매 현황이 없습니다.</td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<div class="tbl_head02 tbl_wrap mb_tbl" style="width: 50%">
    <h1 class="subj">* 다운로드현황</h1>
    <table>
        <colgroup>
            <col width="10%">
            <col width="20%">
            <col width="20%">
        </colgroup>
        <thead>
        <tr>
            <th>No.</th>
            <th>구매자</th>
            <th>다운로드수</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = " select mb_id, count(idx) as download_cnt from g5_reference_room_download where reference_idx = {$idx} group by mb_id order by idx ";
        $result = sql_query($sql);

        for($i=0; $row=sql_fetch_array($result); $i++) {
            ?>
            <tr>
                <td><?=$i+1?></td>
                <td><?=$row['mb_id']?></td>
                <td><?=number_format($row['download_cnt'])?></td>
            </tr>
            <?php
        }
        if($i==0) {
            ?>
            <tr>
                <td colspan="7">다운로드 현황이 없습니다.</td>
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
</script>

<?php
include_once('./admin.tail.php');
?>
