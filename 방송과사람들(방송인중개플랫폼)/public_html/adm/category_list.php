<?php
$sub_menu = "230100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');


$sql_common = " from new_category  ";


$sql_search = " where 1=1  ";


if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

$sql_code = "";


$sql_order = " order by c_number desc ,c_name asc";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_code} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '카테고리 관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_code} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
$colspan = 16;


?>

<style>
    .mb_tbl table {text-align: center;}

</style>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총게시글 <?php echo number_format($total_count) ?> 개
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>"></a>
</div>


<form name="fmemberlist" id="fmemberlist" action="./adm.controller.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">
    <input type="hidden" name="mode" value="category_list_update">
    <p style="margin-left: 15px">* 노출순서가 클수록 상위에 노출됩니다.</p>
    <div class="tbl_head02 tbl_wrap mb_tbl">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
            <tr>
                <!--		<th scope="col">-->
                <!--            <label for="chkall" class="sound_only">회원 전체</label>-->
                <!--            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">-->
                <!--        </th>-->
                <th>no</th>
                <th>노출순서</th>
                <th>1차 카테고리</th>
                <th>사용여부</th>
                <th>작성일</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $list_rows = 15;
            $list_no = $total_count - ($list_rows * ($page - 1));
            for ($i=0; $row=sql_fetch_array($result); $i++) {

                $s_mod = '<a href="./category_form.php?'.$qstr.'&amp;w=u&amp;idx='.$row['code_idx'].'">보기/수정</a>';

                $bg = 'bg'.($i%2);
                $mb = get_member($row['mb_id']);
                $ctg_key = array_search($row['c_p_code'], array_column($main_arr, 'code'));
                ?>
                <tr class="<?php echo $bg; ?>">
                    <!--	<td>
			<input type="hidden" name="mb_id[<?php /*echo $i */?>]" value="<?php /*echo $row['mb_id'] */?>" id="mb_id_<?php /*echo $i */?>">
            <input type="checkbox" name="chk[]" value="<?php /*echo $i */?>" id="chk_<?php /*echo $i */?>">
		</td>-->
                    <td><?=$list_no?></td>
                    <td>
                        <input name="c_idx[]" type="hidden" value="<?php echo $row['c_idx'] ?>" class="frm_input">
                        <input name="c_number[]" type="text" value="<?php echo $row['c_number'] ?>" class="frm_input">
                    </td>
                    <td><input name="c_name[]" type="text" value="<?php echo $row['c_name'] ?>" class="frm_input"></td>
                    <td>
                        <select onchange="yn_list_change(<?=$row['c_idx']?>,this.value)">
                            <?php for($i = 1 ; $i <= count($yn_list); $i++){ ?>
                                <option value="<?=$i?>" <? if ($row['c_use_yn'] == $i ) echo "selected"; ?> ><?= $yn_list[$i] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td><?=substr($row['wr_datetime'],2,8)?></td>
                </tr>


                <?php
                $list_no--;
            }
            if ($i == 0)
                echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
            ?>
            </tbody>
        </table>
    </div>

    <div class="btn_add01 btn_add" style="float: left">
        <button type="submit">저장하기</button>
    </div>
</form>


<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>
<section id="point_mng">
    <h2 class="h2_frm">카테고리 추가</h2>

    <form name="fpointlist2" method="post" id="fpointlist2" action="./adm.controller.php" autocomplete="off">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="token" value="<?php echo $token ?>">
        <input type="hidden" name="idx" id="idx" value="">
        <input type="hidden" name="mode" id="mode" value="ctg_update">

        <div class="tbl_frm01 tbl_wrap">
            <table>
                <colgroup>
                    <col class="grid_4">
                    <col>
                </colgroup>
                <tbody>

                <tr>
                    <th scope="row"><label for="c_name">카테고리 이름<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="c_name" id="c_name" class="required frm_input" size="60"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="c_number">노출순서<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="c_number" id="c_number" class="required frm_input" value="0" size="30"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="c_use_yn">사용유무<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <select name="c_use_yn" id="c_use_yn">
                            <?php for ($i = 1; $i <= count($yn_list); $i++){ ?>
                            <option value="<?php echo $i ?>"><?=$yn_list[$i]?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
               
                </tbody>
            </table>
        </div>

        <div class="btn_confirm01 btn_confirm">
            <input type="submit" value="확인" id="submit_btn" name="submit_btn" class="btn_submit">
            <input type="button" value="추가" id="add_btn" name="add_btn" onclick="add_setting()" style="display: none" class="btn_submit">
        </div>

    </form>

</section>
<script>
    $(document).ready(function () {

    })

    function fmemberlist_submit(f)
    {


        return true;
    }



    function yn_list_change(idx,val) {
        console.log(val);
        $.ajax({
            url: g5_admin_url+"/adm.controller.php",
            type: "POST",
            data: {
                "c_idx": idx,
                "c_use_yn" : val,
                "mode": "yn_list_change"
            },
            success: function(data) {
                if (data != 1){
                    alert("실패했습니다. 새로고침 후 다시 시도해주세요.");
                }else{
                    location.href = location.href
                }

            }
        });
    }

</script>

<?php
include_once ('./admin.tail.php');
?>
