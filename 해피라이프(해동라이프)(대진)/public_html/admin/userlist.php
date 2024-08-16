<?php
$pid = "benecafe";
$sub_menu = '200000';
include_once ('./admin.head.php');


$sql = "select * from `v5_sangjo_sub` where `type` = '$type'";
$re = sql_query($sql);
$total_count = sql_num_rows($re);

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$list_no = $total_count - ($rows * ($page - 1));

$sql = "select * from `v5_sangjo_sub` where `type` = '$type' order by `reg_date` desc limit {$from_record}, {$rows}";
$re = sql_query($sql);
?>

<div class="memberlist">
    <h4><?=$type?> 캐쉬백고객</h4>

    <div class="table_cap">
        <div>
            <!--<strong>상담결과 <span class="color-red">8개</span></strong> /--> 총 <?=number_format($total_count)?>개
        </div>

<!--        <select class="border_gray">
            <option value="4개씩보기">4개씩보기</option>
            <option value="8개씩보기">8개씩보기</option>
            <option value="12개씩보기">12개씩보기</option>
        </select>-->
    </div>
    <table>
        <thead>
        <tr>
            <!--<th>No</th>-->
            <th>캐쉬백 신청일시</th>
            <th>신청인 성명</th>
            <th>신청인 휴대폰</th>
            <th>신청인 고객사명</th>
            <th>해피라이프 이용일자</th>
            <th>이용인 성명</th>
            <th>비고</th>
        </tr>
        </thead>
        <tbody>
        <?
            if($total_count == 0){ ?>
                <tr class="nodata">
                    <td colspan="8">자료가 없습니다.</td>
                </tr>
            <?} else {
                while($row = sql_fetch_array($re)){ ?>
                    <tr>
                        <td><?=$row['reg_date']?></td>
                        <td><?=$row['mb_name']?></td>
                        <td><?=$row['mb_hp']?></td>
                        <td><?=$row['mb_company']?></td>
                        <td><?=$row['use_date']?></td>
                        <td><?=$row['use_name']?></td>
                        <td>-</td>
                    </tr>
                <?}
            }?>
        <!--<tr>
            <td>02</td>
            <td>2024-05-02</td>
            <td>김드림</td>
            <td>010-1234-6789</td>
            <td>드림포원</td>
            <td>2024-05-03</td>
            <td>김포원</td>
            <td>-</td>
        </tr>-->

        </tbody>
    </table>

    <?
        $paging_params = get_paging_params($qstr);
        echo get_paging($config['cf_write_pages'], $page, $total_page, '?'.$paging_params);
    ?>

<!--    <div class="page-controller">
        <a class="arrow left"><i class="fa-light fa-angle-left"></i></a>
        <span class="paging">1 / 1</span>
        <a class="arrow right"><i class="fa-light fa-angle-right"></i></a>
    </div>-->
</div>

<?php
include_once ('./admin.tail.php');
?>
