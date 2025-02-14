<?php
include_once('./_common.php');

//goto_url(G5_ADMIN_URL."/member_list.php");
//exit;

$g5['title'] = '관리자메인';
include_once ('./admin.head.php');

//$new_member_rows = 5;
$new_point_rows = 5;
$new_write_rows = 5;

$sql_common = " from {$g5['member_table']} ";

$sql_search = " where mb_approval_request = 'Y' and mb_approval = 'N'";

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if($_SESSION['ss_mb_id'] != "lets080")
	$sql_search .= " and mb_id != 'lets080'";

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];


$sql = " select * {$sql_common} {$sql_search} {$sql_order} ";
$result = sql_query($sql);
$colspan = 12;

//심사전 프로필변경 신청한사람
$sql2 = " select * {$sql_common} where mb_9 = 'N' {$sql_order} ";
$result2 = sql_query($sql2);

?>
<section>
    <h2>심사전 프로필변경목록</h2>
    <div class="tbl_head01 tbl_wrap">
        <table>
            <caption>심사요청 회원</caption>
            <thead>
            <tr>
                <th scope="col">회원아이디</th>
                <th scope="col">이름</th>
                <th scope="col">닉네임</th>
                <th scope="col">성별</th>
                <th scope="col">휴대폰번호</th>
                <th scope="col">보유만나</th>
                <th scope="col">가입일자</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($j=0; $row2=sql_fetch_array($result2); $j++)
            {
                $s_mod = '<a style="color: red" href="./member_form.php?$qstr&amp;w=u&amp;mb_id='.$row2['mb_id'].'">'.$row2['mb_id'].'</a>';
                $mb_id = $row2['mb_id'];
                $mb = get_member($mb_id);
                ?>
                <tr style="color: red">
                    <td class="td_mbid"><?php echo $s_mod ?></td>
                    <td class="td_mbname" style="color: red"><?php echo get_text($row2['mb_name']); ?></td>
                    <td class="td_mbname sv_use"><div><?php echo $mb["mb_nick"] ?></div></td>
                    <td class="td_num"><?php echo $row2['mb_sex'] ?></td>
                    <td class="td_num"><?php echo $row2['mb_hp'] ?></td>
                    <td class="td_num"><?php echo number_format($row2['cw_point']) ?></td>
                    <td class="td_num"><?php echo $row2['mb_datetime'] ?></td>

                </tr>
                <?php
            }
            if ($j == 0)
                echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
            ?>
            </tbody>
        </table>
    </div>

    <div class="btn_list03 btn_list">
        <a href="./member_list.php">회원 전체보기</a>
    </div>
</section>
<section>
    <h2>심사요청 회원목록</h2>
    <div class="local_desc02 local_desc">
        심사요청 회원수 <?php echo number_format($total_count) ?>명
    </div>

    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption>심사요청 회원</caption>
        <thead>
        <tr>
            <th scope="col">회원아이디</th>
            <th scope="col">이름</th>
            <th scope="col">닉네임</th>
            <th scope="col">성별</th>
            <th scope="col">휴대폰번호</th>
            <th scope="col">보유만나</th>
            <th scope="col">가입일자</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $row=sql_fetch_array($result); $i++)
        {

            $s_mod = '<a href="./member_form.php?$qstr&amp;w=u&amp;mb_id='.$row['mb_id'].'">'.$row['mb_id'].'</a>';
            $mb_id = $row['mb_id'];
            $mb = get_member($mb_id);
        ?>
        <tr>
            <td class="td_mbid"><?php echo $s_mod ?></td>
            <td class="td_mbname"><?php echo get_text($row['mb_name']); ?></td>
            <td class="td_mbname sv_use"><div><?php echo $mb["mb_nick"] ?></div></td>
            <td class="td_num"><?php echo $row['mb_sex'] ?></td>
            <td class="td_num"><?php echo $row['mb_hp'] ?></td>
            <td class="td_num"><?php echo number_format($row['cw_point']) ?></td>
            <td class="td_num"><?php echo $row['mb_datetime'] ?></td>

        </tr>
        <?php
            }
        if ($i == 0)
            echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
        ?>
        </tbody>
        </table>
    </div>

    <div class="btn_list03 btn_list">
        <a href="./member_list.php">회원 전체보기</a>
    </div>

</section>

<?php
$sql_common = " from new_adm_profile  ";
$sql_order = " order by ap_idx desc ";
$sql_where = " where ap_proc = 0 ";

$sql = " select count(*) as cnt {$sql_common} {$sql_where} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$colspan = 5;
?>

<section>
    <h2>프로필 수정요청 내역( * 처리구분을 완료로 변경 시 리스트에 보이지 않게 됩니다.)</h2>

    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption>최근게시물</caption>
        <thead>
        <tr>
            <th scope="col">no.</th>
            <th scope="col">처리구분</th>
            <th scope="col">사진 다운로드</th>
            <th scope="col">내용</th>
            <th scope="col">아이디</th>
            <th scope="col">요청일자</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = " select * {$sql_common} {$sql_where} {$sql_order} ";
        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $s_mod = '<a href="./member_form.php?$qstr&amp;w=u&amp;mb_id='.$row['mb_id'].'">'.$row['mb_id'].'</a>';
            $download = "";
            $sql = "select * from g5_board_file where bo_table = 'adm_apply' and wr_id = '{$row["ap_idx"]}' ";
            $file_result = sql_query($sql);
            for ($a = 0; $file = sql_fetch_array($file_result); $a++){
                $download .=  '<a href="./adm_download.php?bf_file='.$file["bf_file"].'">'.$file["bf_source"].'</a><br>';
            }
            ?>

        <tr>
            <td class="td_category"><?=$i + 1 ?></td>
            <td class="td_category">
                <select name="ap_proc" <? if ($row['ap_proc'] == '1') echo "disabled"; ?> onchange="proc_change(<?=$row['ap_idx']?>,'<?=$row['mb_id']?>',this)">
                    <option <? if ($row['ap_proc'] == '0') echo "selected"; ?> value="0">신청</option>
                    <option <? if ($row['ap_proc'] == '1') echo "selected"; ?> value="1">완료</option>
                </select>
            </td>
            <td class="td_category"><?= $download ?></td>
            <td><?= $row["ap_content"] ?></td>
            <td class="td_mbname"><div><?= $s_mod ?></div></td>
            <td class="td_datetime"><?= $row["wr_datetime"] ?></td>
        </tr>

        <?php
        }
        if ($i == 0)
            echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
        ?>
        </tbody>
        </table>
    </div>
    <div class="btn_list03 btn_list">
        <a href="./profile_request_list.php">프로필 신청내역 전체보기</a>
    </div>
</section>
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
