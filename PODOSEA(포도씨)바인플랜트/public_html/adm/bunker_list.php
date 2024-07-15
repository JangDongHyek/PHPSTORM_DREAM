<?php
$sub_menu = "220100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_bunker_history ";

$sql_search = " where 1=1 and mb_id != 'admin' ";
//$sql_search .= " and podosea = 'Y' "; // 포도씨에 직접 의뢰한 건만 조회

// 구분
if(!empty($lv)) {
    $sql_search .= " and mode = '{$lv}' ";
}

// 검색
if(!empty($stx)) {
    $sql_search .= " and {$sfl} like '%{$stx}%' ";
}

if (!$sst) {
    $sst = "wr_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '벙커관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);

$colspan = 16;
?>

<style>
.mb_tbl table {text-align: center;}
.btn_submit {
    padding: 0 5px;
    height: 24px;
    border: 0;
    color: #fff;
    vertical-align: middle;
    cursor: pointer;
}
</style>

<!-- 포인트 적립/차감 모달 -->
<div class="modal fade" id="bunkerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">벙커 적립/차감</h2>
            </div>
            <div class="modal-body">
                <p>아이디</p>
                <div>
                    <form name="sfrm" autocomplete="off" onsubmit="return search_id(this);">
                        <input type="text" name="input_id" id="input_id" class="frm_input" size="20" required minlength="2">
                        <button type="submit" class="btn_submit">검색</button>
                    </form>
                </div><br/>
                <div id="srch_result" class="tbl_head02 mb_tbl"></div><br/>
                <form name="fmodalbunker" id="fmodalbunker">
                    <input type="hidden" name="reg_mb_id" id="reg_mb_id">
                    <p>
                        벙커
                        <span style="margin-left: 10px; margin-right: 10px;"><input type="radio" name="input_gubun" id="gubun1" value="일반" checked>&nbsp;<label for="gubun1">일반</label></span>
                        <span><input type="radio" name="input_gubun" id="gubun2" value="보너스">&nbsp;<label for="gubun2">보너스</label></span>
                    </p>
                    <p>
                        구분
                        <span style="margin-left: 10px; margin-right: 10px;"><input type="radio" name="input_mode" id="mode1" value="적립" checked>&nbsp;<label for="mode1">적립</label></span>
                        <span><input type="radio" name="input_mode" id="mode2" value="차감">&nbsp;<label for="mode2">차감</label></span>
                    </p>
                    <div>
                        <input type="text" name="input_bunker" id="input_bunker" class="frm_input" size="20" required minlength="2" onkeyup="number_check(this);">
                    </div><br/>
                    <p>적립/차감 사유</p>
                    <div>
                        <textarea name="input_content" id="input_content" style="resize: unset;" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn_submit" onclick="fbunker_submit();">적용</button>
                <button type="button" class="btn_frmline" data-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>아이디</option>
    <option value="contents"<?php echo get_selected($_GET['sfl'], "contents"); ?>>내용</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">

</form>

<div class="btn_add01 btn_add">
    <ul class="cate">
        <li <? if ($lv == "전체" || $lv == "") echo 'class="on"'; ?> data-lv="">전체</li>
        <li <? if ($lv == "적립") echo 'class="on"'; ?> data-lv="적립">적립</li>
        <li <? if ($lv == "차감") echo 'class="on"'; ?> data-lv="차감">차감</li>
    </ul>
    <a href="javascript:void(0)" style="visibility: hidden">벙커 적립/차감</a>
    <?php if($private) { ?>
    <!--<a href="javascript:void(0)" onclick="openPopup();">벙커 적립/차감</a>-->
    <?php } ?>
</div>

<!--<div class="local_desc01 local_desc">
    <p>* 포도씨에게 직접 의뢰한 건이 표시됩니다.</p>
</div>-->

<form name="fbunker" id="fbunker" method="post">
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
        <th>No.</th>
        <th><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
        <th>구분</th>
        <th>BUNKER</th>
        <th>내용</th>
        <th>적립/차감일</th>
	</tr>
    </thead>
    <tbody>
    <?php
    $list_no = $total_count - ($rows * ($page - 1));
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
        $txt = '';
        if($row['etc'] == 'bonus') {
            $txt .= ' (BONUS)';
        }
    ?>
	<tr class="<?php echo $bg; ?>">
        <td><?=$list_no?></td>
        <td><?=$row['mb_id']?></td>
        <td><?=$row['mode']?></td>
        <td><?=number_format($row['bunker'])?></td>
        <td><?=$row['contents'].$txt?></td>
		<td><?=substr($row['wr_datetime'],0,10)?></td>
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

<!--<div class="btn_list01 btn_list">
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
</div>-->

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&lv='.$lv.'&amp;page='); ?>

<script>
$(function() {
    if('<?=$type?>' != '') {
        $('#type').val('<?=$type?>');
    }
    if('<?=$category?>' != '') {
        $('#category').val('<?=$category?>');
    }
});

// 구분 변경
$("ul.cate li").on("click", function() {
    var level = $(this).data("lv"),
        params = "",
        sfl = $("#sfl").val(),
        stx = $("#stx").val();

    if (level != "") {
        params += "?lv=" + level;
    }

    if (stx != "") {
        params += (params == "")? "?" : "&";
        params += "sfl=" + sfl + "&stx=" + stx;
    }

    location.href = g5_admin_url + "/bunker_list.php" + params;
});

// 포인트 (숫자, 콤마)
function number_check(data) {
    $('#'+data.id).val(data.value.replace(/[^\d]+/g, ''));
    $('#'+data.id).val(data.value.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,'));
}

function openPopup() {
    $('#bunkerModal').appendTo("body").modal('show');
}

// 대상아이디 검색
function search_id(f) {
    if (f.input_id.value.length < 2) {
        alert('대상아이디를 2자 이상 입력하세요.');
        f.input_id.focus();
        return false;
    }

    $.ajax({
        type : "get",
        url : "./ajax.id_search.php",
        data : {"id" : f.input_id.value, mode: "bunker" },
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

// 대상아이디 검색 선택
function select_id(mb_id) {
    $('#reg_mb_id').val(mb_id);
    $('input[name="input_id"]').val(mb_id);
    $('#srch_result').html('');
}

// 벙커 적립/차감 적용
var is_post = false;
function fbunker_submit() {
    // if(is_post) {
    //     return false;
    // }
    // is_post = true;

    if($.trim($('#input_id').val()).length == 0) {
        alert('아이디를 입력하세요.');
        is_post = false;
        return false;
    }
    if($('#reg_mb_id').val() != $('#input_id').val()) { // 아이디 선택 후 input 내용 변경했을 시
        alert('아이디를 확인하세요.');
        is_post = false;
        return false;
    }
    if($('#input_bunker').val().replace(',','').length == 0) {
        alert('적립/차감할 벙커를 입력하세요.');
        is_post = false;
        return false;
    }

    var form = $('#fmodalbunker')[0];
    var formData = new FormData(form);

    console.log(11);
    $.ajax({
        url:  g5_admin_url + "/ajax.bunker_action.php",
        processData: false,
        contentType: false,
        data: formData,
        type: 'POST',
        async: false,
        success: function (data) {
            if(data == 'success') {
                alert('벙커가 적용되었습니다.');
                location.reload();
            }
            else if(data == 'fail') {
                alert('차감할 벙커가 부족합니다.');
            }
        },
    });
}
</script>

<?php
include_once ('./admin.tail.php');
?>
