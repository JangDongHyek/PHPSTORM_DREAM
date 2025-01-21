<?php
$sub_menu = "400000";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');


$sql = "select count(*) as cnt
from {$g5['review_table']} rv

LEFT join g5_member ma on ma.mb_id = rv.ma_id
LEFT join new_car_wash cw on cw.cw_idx = rv.cw_idx
order by rv.wr_datetime DESC ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = ' <a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall"><button style="border: 1px solid #ccc">전체목록</button></a> ';

$g5['title'] = '건의함';
include_once('./admin.head.php');


$sql = "select cw.car_date_type car_date_type,cw.car_size car_size,rv.re_content re_content,ma.mb_name ma_name,rv.mb_id mb_id,
       cw.complete_datetime cw_complete_datetime,rv.wr_datetime wr_datetime,
       cw.cw_idx cw_idx
from {$g5['review_table']} rv

LEFT join g5_member ma on ma.mb_id = rv.ma_id
LEFT join new_car_wash cw on cw.cw_idx = rv.cw_idx
order by rv.wr_datetime DESC limit {$from_record}, {$rows} ";

$result = sql_query($sql);
$colspan = 16;

?>


<style>
    .mb_tbl table {text-align: center;}

</style>




<div class="local_ov01 local_ov">
    <?php echo $listall ?>
</div>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div class="tbl_head02 tbl_wrap mb_tbl">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
            <tr>
                <th scope="col">
                    <label for="chkall" class="sound_only">회원 전체</label>
                    <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                </th>
                <th>no</th>
                <th>서비스종류</th>
                <th>차량정보</th>
                <th>매니저성함</th>
                <th>세차완료일</th>
                <th>접수일</th>
                <th>고객아이디</th>
                <th>고객성함</th>
                <th>건의내용</th>
                <th>건의사진</th>

            </tr>
            </thead>
            <tbody>
            <?php
            $list_rows = $config['cf_page_rows'];
            $list_no = $total_count - ($list_rows * ($page - 1));
            for ($i=0; $row=sql_fetch_array($result); $i++) {
                $mb = get_member($row['mb_id']);
                // view 파일 출력
                $file = get_file($g5['review_table'], $row['cw_idx']);


                ?>
                <tr class="<?php echo $bg; ?>">
                    <td>
                        <input type="checkbox" name="chk[]" value="<?php echo $row['cw_idx'] ?>" id="chk_<?php echo $i ?>">
                    </td>
                    <td><?=$list_no?></td>
                    <td><?=$cdt_list[$row['car_date_type']]?></td>
                    <td><?=$cs_list[$row['car_size']]?></td>
                    <td><?=$row['ma_name']?></td>
                    <td><?=$row['cw_complete_datetime']?></td>
                    <td><?=substr($row['wr_datetime'],2,8)?></td>


                    <td><a href="./member_form.php?<?=$qstr?>&amp;w=u&amp;mb_id=<?=$row['mb_id']?>"><?=$row['mb_id']?></a></td>
                    <td><a href="./member_form.php?<?=$qstr?>&amp;w=u&amp;mb_id=<?=$row['mb_id']?>"><?=$mb['mb_name']?></a></td>
                    <td><?=$row['re_content']?></td>
                    <td>
                        <?php
                            if ($file['count']) {
                                for ($i = 0; $i < $file['count']; $i++) {

                                    $filename = $file[$i]['file'];
                                    $filepath = $file[$i]['path'];
                                    $filesrc = $filepath.'/'.$filename;
                                    $img_content = "<a target='_blank' href=".$filesrc."><img src='" . $filesrc . "' style='writh:100px;height:100px'></a>";
                                    echo $img_content;
                                }
                            }
                        ?>
                    </td>
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


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr."&nr=".$_REQUEST['nr'].'&amp;page='); ?>

<script>

    function numberComma(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

</script>

<?php
include_once ('./admin.tail.php');
?>
