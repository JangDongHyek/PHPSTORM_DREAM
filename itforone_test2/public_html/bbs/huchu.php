<?php
include_once('../common.php');
$g5['title'] = "도마뱀 해칭일기";
$config['cf_title'] = "";
include_once("../head.sub.php");

add_stylesheet('<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">', 0);
add_stylesheet('<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">', 1);
add_stylesheet('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">', 2);

$sql = "SELECT * FROM project_test ORDER BY first_dt ASC, round ASC";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);
?>
<style>
    /* 초기화 */
    html {position: relative; overflow-y:auto;}
    body {position: relative; margin:0 auto;padding:0 !important;font-size:0.8em; letter-spacing:0; line-height:1.6em; color:#343434; background:#FAFAFA;
        font-family: 'Noto Sans KR', sans-serif; font-weight:300; word-break:keep-all;}
    html, h1, h2, h3, h4, h5, h6, form, fieldset, img {margin:0;padding:0;border:0; font-family: 'Noto Sans KR', sans-serif;}
    h1, h2, h3, h4, h5, h6 {font-size:1em}
    article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section {display:block}
    ul, dl {margin:0;padding:0;list-style:none}
    dl dt{font-weight: 500;}
    legend {position:absolute;font-size:0;line-height:0;text-indent:-9999em;overflow:hidden}
    label, input, button, select {border-radius:4px;}
    label, input, button, select, img {vertical-align:middle; outline:none; }
    label{margin: 0;}
    input:focus,
    button:focus {outline:none;}
    input, button {margin:0;padding:0;font-size:1em;outline:none;}
    button {cursor:pointer; border: 0;}
    input[type=text], input[type=password], input[type=submit], input[type=image], button {border-radius:4px;font-size:1em;-webkit-appearance:none}
    textarea, select {font-size:1em;}
    textarea {border-radius:0;-webkit-appearance:none}
    select {margin:0; border-radius:4px;}
    p {margin:0;padding:0;word-break:keep-all}
    hr {display:none}
    pre {overflow-x:scroll;font-size:1.1em}
    a, a:link, a:visited {text-decoration:none; color: #343434}
    a:hover, a:focus, a:active {text-decoration:none; color:;}

    #list {padding: 10px;}
    #list h1 {font-size: 1.4em;}
    #list table {width: 100%; text-align: center; margin: 15px 0;}
    #list table th {padding: 5px 0;}
    #list table td {padding: 5px 0;}
    .btnWrite {display:block; background:#12bcbb; color:#fff; font-weight:600; font-size:1.5em; text-align:center; width:50px; height:50px; border-radius:50%; margin-bottom:10px; position: fixed; bottom: 10px;right: 10px;}
    .txt_green {color: #12bcbb !important;}
    .txt_orange {color: #ed633b !important;}
    #writeModal .btn {font-size: 1em; border: 0;}
    .btn-primary {background: #12bcbb;}
</style>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script>
    function closeModal() {
        $("#writeModal").modal('hide');
    }
    function openModal(idx) {
        $("#writeModal").modal();
    }

    function save() {
        let obj = {};
        obj.category = document.querySelector("input#category").value.trim();
        obj.round = document.querySelector("input#round").value;
        obj.first_dt = document.querySelector("input#first_dt").value;
        obj.hc_dt = document.querySelector("input#hc_dt").value;

        alert('test');
        return false;

        $.ajax({
            type : "post",
            url : "./huchu_ajax.php",
            data : obj,
            dataType : "json",
        }).done(function(data, textStatus, xhr) {
            // if (data.result) alert("완료 되었습니다.");
            // else alert(err_msg);

        }).fail(function(data, textStatus, errorThrown) {
            // alert(err_msg);

        }).always(function() {
            // opener.location.reload();
            // window.open('about:blank','_self').close();
        });
    }
</script>

<div id="list">
    <h1><span class="txt_green">도마뱀</span> 해칭일기</h1>
    <button type="button" onclick="openModal()" class="btnWrite">+</button>
    <table>
        <colgroup>
            <col width="*">
            <col width="*">
            <col width="20%">
            <col width="20%">
            <col width="*">
        </colgroup>
        <tr>
            <th>♥</th>
            <th>회차</th>
            <th>득알</th>
            <th>해칭일</th>
            <th>Day</th>
        </tr>
        <?if ($result_cnt == 0) { ?>
        <tr>
            <td colspan="5">등록된 알이 없어요</td>
        </tr>
        <?
        } else {
            $ymd = date("Y-m-d", time());
            for ($i = 0; $row = sql_fetch_array($result); $i++) {
                $first_dts = strtotime($row['first_dt']);

                // 득알 일자 카운팅 (1일부터 시작)
                $day_count = ((intval(strtotime($ymd) - $first_dts) / 86400)+1)."일 경과";
                $class_name = "txt_green";

                // 부화 일자 카운팅
                $hc_dts = ($row['hc_dt'])? strtotime($row['hc_dt']) : "";
                if ($row['hc_dt']) {
                    $day_count = abs(intval(($hc_dts - $first_dts) / 86400)+1)."일 부화";
                    $class_name = "txt_orange";
                }
        ?>
            <tr>
                <td><span onclick=""><?=$row['category']?></span></td>
                <td><?=$row['round']?>차</td>
                <td><?=date("y.m.d", $first_dts)?></td>
                <td><?if ($row['hc_dt']) echo date("y.m.d", strtotime($row['hc_dt'])) ?></td>
                <td><span class="<?=$class_name?>"><?=$day_count?></span></td>
            </tr>
        <?}}?>
    </table>

    <div class="modal" tabindex="-1" id="writeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!--<div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>-->
                <div class="modal-body">
                    <form name="frm1" autocomplete="off" onsubmit="return false;">
                        <input type="hidden" name="idx" value="0">
                        <div class="mb-3">
                            <label for="category" class="col-form-label">♥:</label>
                            <input type="text" class="form-control" id="category" required>
                        </div>
                        <div class="mb-3">
                            <label for="round" class="col-form-label">회차:</label>
                            <input type="number" class="form-control" id="round" required>
                        </div>
                        <div class="mb-3">
                            <label for="first_dt" class="col-form-label">득알일자:</label>
                            <input type="date" class="form-control" id="first_dt" required>
                        </div>
                        <div class="mb-3">
                            <label for="hc_dt" class="col-form-label">해칭일자:</label>
                            <input type="date" class="form-control" id="hc_dt">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">닫기</button>
                    <button type="button" class="btn btn-primary" onclick="save()">저장</button>
                </div>
            </div>
        </div>
    </div>

</div>


<?php
include_once("../tail.sub.php");
?>
