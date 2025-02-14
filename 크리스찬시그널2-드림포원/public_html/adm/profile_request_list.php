<?php
$sub_menu = "270200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from new_adm_profile  ";
$sql_order = " order by ap_idx desc ";
$sql_where = " where 1 = 1 ";
//$sql_where = " where ap_proc = 0 ";

//$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_where} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '프로필 신청내역';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_where} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 8; ?>

<style>
    .mb_tbl table {text-align: center;}
    .red{
        color: red;
    }

</style>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총 프로필 신청 수 <?php echo number_format($total_count) ?>건
</div>

<!--<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_id"<?php /*echo get_selected($_GET['sfl'], "mb_id"); */?>>아이디</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php /*echo $stx */?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">

</form>-->

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div class="tbl_head02 tbl_wrap mb_tbl">
        <table>
            <caption>최근게시물</caption>
            <thead>
            <tr>
                <th scope="col">no.</th>
                <th scope="col">처리구분</th>
                <th scope="col">회원상태</th>
                <th scope="col">사진 다운로드</th>
                <th scope="col">내용</th>
                <th scope="col">아이디</th>
                <th scope="col">요청일자</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $k = $total_count-($rows*($page-1)); // 글번호
            for ($i=0; $row=sql_fetch_array($result); $i++) {




                $download = "";
                $sql = "select * from g5_board_file where bo_table = 'adm_apply' and wr_id = '{$row["ap_idx"]}' ";
                $file_result = sql_query($sql);
                for ($a = 0; $file = sql_fetch_array($file_result); $a++){
                    $download .=  '<a href="./adm_download.php?bf_file='.$file["bf_file"].'">'.$file["bf_source"].'</a><br>';
                }


                $mb2 = get_member($row['mb_id']);
                $state = '';

                $bg = '';

                if($mb2['mb_9']=='N'){
                    $s_mod = '<a href="./member_form.php?$qstr&amp;w=u&amp;mb_id='.$row['mb_id'].'" style="color:red">'.$row['mb_id'].'</a>';
                    $bg .= ' red';
                }else{
                    $s_mod = '<a href="./member_form.php?$qstr&amp;w=u&amp;mb_id='.$row['mb_id'].'">'.$row['mb_id'].'</a>';
                }

                if($mb2['mb_approval'] == 'Y') { $state = '승인'; } else if($mb2['mb_approval_request'] == 'Y') { $state = '<span style="color: red">심사 요청</span>'; }

                ?>

                <tr class="<?=$bg?>">
                    <td class="td_category"><?=$k ?></td>
                    <td class="td_category">
                        <select name="ap_proc" <? if ($row['ap_proc'] == '1') echo "disabled"; ?> onchange="proc_change(<?=$row['ap_idx']?>,'<?=$row['mb_id']?>',this)">
                            <option <? if ($row['ap_proc'] == '0') echo "selected"; ?> value="0">신청</option>
                            <option <? if ($row['ap_proc'] == '1') echo "selected"; ?> value="1">완료</option>
                        </select>
                    </td>
                    <td class="td_category"><?=$state?></td>
                    <td class="td_category"><?= $download ?></td>
                    <td><?= $row["ap_content"] ?></td>
                    <td class="td_mbname"><div><?= $s_mod ?></div></td>
                    <td class="td_datetime"><?= $row["wr_datetime"] ?></td>
                </tr>

                <?php $k--;
            }
            if ($i == 0)
                echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
            ?>
            </tbody>
        </table>
    </div>

</form>

<?php echo get_paging($rows, $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
    function proc_change(idx,mb_id,val) {

        $.ajax({
            url: g5_bbs_url+"/ajax.controller.php",
            type: "POST",
            data: {
                "idx": idx,
                "mb_id": mb_id,
                "proc" : val.value,
                "mode": "proc_change"
            },
            success: function(data) {
                if (data != 1) {
                    alert(data);

                }else{
                    alert("상태가 변경되었습니다.");
                    location.href = location.href

                }


            }
        });

    }
</script>

<?php
include_once ('./admin.tail.php');
?>

