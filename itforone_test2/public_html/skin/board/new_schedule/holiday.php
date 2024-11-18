<?php
include_once ("../../../common.php");

if ($_POST['mode']) {
    $param = array(
        'date' => str_replace("-", "", $_POST['date']),
        'name' => trim($_POST['name']),
        'h_1' => substr($_POST['date'], 0, 4),
        'h_2' => substr($_POST['date'], 6, 2),
        'h_3' => substr($_POST['date'], 8, 2),
        'idx' => (int)$_POST['idx'],
    );
    $sql = "";
    switch ($_POST['mode']) {
        case "insert" :
            $sql = "INSERT INTO hollyday SET 
                    date = '{$param['date']}', name = '{$param['name']}', h_1 = '{$param['h_1']}', h_2 = '{$param['h_2']}', h_3 = '{$param['h_3']}'";
            break;
        case "update" :
            $sql = "UPDATE hollyday SET 
                    date = '{$param['date']}', name = '{$param['name']}', h_1 = '{$param['h_1']}', h_2 = '{$param['h_2']}', h_3 = '{$param['h_3']}' 
                    WHERE idx = '{$param['idx']}'";
            break;
        case "delete" :
            $sql = "DELETE FROM hollyday WHERE idx = '{$param['idx']}'";
            break;
    }
    // echo sql_query($sql)? "등록" : "실패";
    sql_query($sql);
}


$sql = "select * from `hollyday` where date >= '20200101' order by date desc";
$result = sql_query($sql);
for($j=0; $row=sql_fetch_array($result); $j++) {
    $holiDay[] = $row;
}

?>
<style>
    #holyday {width: 50%; text-align: center; border-collapse: collapse;}
    #holyday td, th {border: 1px solid #eee; padding: 5px; }
</style>
<!-- 등록/수정 -->
<form name="holiday" method="post" action="?" autocomplete="off">
    <input type="hidden" name="mode" value="insert"/>
    <input type="hidden" name="idx" value=""/>
    <label>날짜</label>
    <input type="text" name="date" required/>
    <label>공휴일명</label>
    <input type="text" name="name" required/>
    <button type="submit">저장</button>
    <button type="button" onclick="initForm()">초기화</button>
</form>

<!-- 삭제 -->
<form name="delFrm" method="post" action="?">
    <input type="hidden" name="mode" value="delete"/>
    <input type="hidden" name="idx" value=""/>
</form>

<table id="holyday">
    <colgroup>
        <col style="width: 10%">
        <col style="width: 15%">
        <col style="width: auto">
        <col style="width: 20%">
    </colgroup>
    <tr>
        <th>No.</th>
        <th>날짜</th>
        <th>공휴일명</th>
        <th>관리</th>
    </tr>
    <?
    $listNo = count($holiDay);
    foreach ($holiDay AS $row) {
        $dateFormat = substr($row['date'], 0, 4)."-". substr($row['date'], 4, 2)."-". substr($row['date'], 6, 2);
    ?>
    <tr>
        <td><?=$listNo?></td>
        <td><?=$dateFormat?></td>
        <td><?=$row['name']?></td>
        <td>
            <button type="button" onclick="editRow(<?=$row['idx']?>, '<?=$dateFormat?>', '<?=$row['name']?>')">수정</button>
            <button type="button" onclick="deleteRow(<?=$row['idx']?>)">삭제</button>
        </td>
    </tr>
    <? $listNo--; } ?>
</table>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<!-- jquery 달력 -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script>
    const frm = document.holiday;
    const month_arr = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        day_arr = ['일', '월', '화', '수', '목', '금', '토'];

    $('input[name=date]').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd",
        yearRange: '<?=date('Y')?>:<?=date('Y')+10?>',
        showButtonPanel: true,
        showMonthAfterYear: true,
        monthNames: month_arr,
        monthNamesShort: month_arr,
        dayNames: day_arr,
        dayNamesShort: day_arr,
        dayNamesMin: day_arr,
        currentText: '오늘',
        closeText: '닫기'
    });

    const editRow = (idx, date, name) => {
        frm.mode.value = 'update';
        frm.idx.value = idx;
        frm.date.value = date;
        frm.name.value = name;
    }

    const deleteRow = (idx) => {
        if (!confirm("선택항목을 삭제하시겠습니까?")) return;

        document.delFrm.idx.value = idx;
        document.delFrm.submit();
    }

    const initForm = () => {
        frm.mode.value = 'insert';
        frm.idx.value = '';
        frm.date.value = '';
        frm.name.value = '';
        document.delFrm.idx.value = '';
    }
</script>