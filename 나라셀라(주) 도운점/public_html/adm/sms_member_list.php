<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} as M ";



$sql_search = " where M.mb_id!='lets080' AND M.mb_id!='admin' AND mb_sms = '1'  ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel' :
        case 'mb_hp' :
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($is_admin != 'super')
    $sql_search .= " and M.mb_level <= '{$member['mb_level']}' ";

if($_SESSION['ss_mb_id'] != "lets080")
	$sql_search .= " and M.mb_id != 'lets080'";

if (!$sst) {
    $sst = "M.mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " 
    SELECT count(*) as cnt          
    {$sql_common}  
    {$sql_search}
    ";

$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '마케팅 정보동의 회원관리';
include_once('./admin.head.php');

$sql = " 
    SELECT DISTINCT
        M.*    
    {$sql_common} 
    {$sql_search} 
    {$sql_order} 
    -- limit 
        -- {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

<div class="local_ov01 local_ov">
    총회원수 <?php echo number_format($total_count) ?>명
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get" style="display: flex; align-items: center;">

    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="M.mb_id" <?php echo get_selected($_GET['sfl'], "M.mb_id"); ?>>아이디</option>
        <option value="M.mb_name" <?php echo get_selected($_GET['sfl'], "M.mb_name"); ?>>이름</option>
        <option value="M.mb_1" <?php echo get_selected($_GET['sfl'], "M.mb_1"); ?>>생년월일</option>        
        <option value="M.mb_hp" <?php echo get_selected($_GET['sfl'], "M.mb_hp"); ?>>휴대폰</option>
    </select>

    <!--<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>-->
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">

    <input type="submit" class="btn_submit" value="검색" style="width: 100px; height: 30px;">
    
    <button type="button" class="btn_submit" onclick="openSmsModal()" style="width: 100px; height: 30px; margin-left:5px; background: green;">문자발송</button>
</form>

<!--
<div class="local_desc01 local_desc">
    <p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>
</div>
-->

<?php if ($is_admin == 'super') { ?>
<!--
<div class="btn_add01 btn_add">
    <a href="./member_form.php" id="member_add">회원추가</a>
</div>
-->
<?php } ?>

<form>
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div id="memberBox" class="tbl_head02 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <thead>
                <tr>
                    <th><input id="chkAll" type="checkbox" value="all"></th>
                    <th>순번</th>
                    <th>이름</th>
                    <th>휴대폰</th>
                    <th>마케팅 정보동의</th>
                    <th>가입일</th>
                    <th>최근접속일</th>
                    <th>가입경로</th>
                    <th>직업</th>
                </tr>                                
            </thead>
            <tbody>
                <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        
        $bg = 'bg'.($i%2);
    ?>

                <tr class="<?php echo $bg; ?>">
                    <td><input type="checkbox" class="chkSmsHp" value="<?=$row['mb_hp']?>"></td>
                    <td class=""><?=$result->num_rows - $i?></td>
                    <td><?=$row['mb_name']?></td>
                    <td><?=$row['mb_hp']?></td>
                    <td><?=($row['mb_sms'] == '1'? 'Y' : 'N')?></td>
                    <td><?=substr($row['mb_datetime'], 2, 14)?></td>
                    <td><?=substr($row['mb_today_login'], 2, 14)?></td>
                    <td><?=$row['mb_route']?></td>
                    <td><?=$row['mb_job']?></td>
                </tr>

                <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
            </tbody>
        </table>
    </div>

    <!--
<div class="btn_list01 btn_list">
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
</div>
-->

</form>

<div id="phoneModal" class="modal">
    <div class="phoneBoxWrap">
        <div class="phoneBox">
            <img src="<?=G5_ADMIN_URL?>/img/phone.png"/>
            <textarea id="smsText" onkeyup="checkByte()" placeholder="메시지 내용을 입력해주세요.            90Byte 초과시 LMS로 자동 전환됩니다."></textarea>
        </div>
        <p>90Byte 이상 LMS 자동 전환</p>
        <p><span id="nowByte">0</span> / <span id="maxByte">90 Byte (단문)</span></p>
        <div>
        <? foreach(ADMIN_TEL as $floor => $tel){ ?>
            <input type="radio" id="adminTel_<?=$floor?>" name="adminTel" class="adminTel" value="<?=unHyphen($tel)?>">
            <label for="adminTel_<?=$floor?>"><?=$floor?>층 <?=$tel?></label>
        <? } ?>
        </div>
        <button type="button" class="btn_submit" onclick="sendSms()">문자보내기</button>
    </div>
</div>

<script>
    
    var $smsText = $('#smsText');
    
    function openSmsModal(){
        let $chkSmsHp = $('.chkSmsHp:checked');
         
        if(!$chkSmsHp.length){
            showAlert('문자발송할 회원을<br/>한 명이상 선택해주세요.');
            return false;
        }
        
        $('#phoneModal').modal({fadeDuration: 200});
    }
    
    async function sendSms(){
        let $chkSmsHp = $('.chkSmsHp:checked'),
            $adminTel = $('.adminTel:checked'),
            hpArr = [],
            byte = countBytes($smsText.val());
        
        if(!$smsText.val()){
            showAlert('메시지 내용을 입력해주세요.', $smsText.focus());
            return;
        }else if($adminTel.val() == undefined){
            showAlert('발신번호를 선택해주세요.');
            return;
        }
        
        for(let i=0; i<$chkSmsHp.length; i++){
            hpArr.push($chkSmsHp.eq(i).val());
        }
        
        const sendSmsRes = await postJson(getAjaxUrl('admin'), {
            mode: 'sendSms',
            msg: $smsText.val(),
            hpArr: hpArr,
            sendHp : $adminTel.val(),
            byte : byte
        });
        
        if(!sendSmsRes.result){
            showAlert(sendSmsRes.msg);
            return;
        }
        
        showAlert(`총 ${hpArr.length}명의 회원에게 전송완료 되었습니다.`);
    }
    
    function checkByte(){
        let byte = countBytes($smsText.val()),
            byteText = "";
        
        if(byte <= 90){
            byteText = "90 Byte (단문)";
        }else{
            byteText = "2000 Byte (장문)";
        }
        
        $('#nowByte').text(byte);
        $('#maxByte').text(byteText);
        
        if(byte > 2000){
            netsCheck($smsText.val());
        }
    }
    
     // 텍스트의 바이트 수를 계산하는 함수
    function countBytes(text) {
        let tmpStr = new String(text),
            temp = tmpStr.length,
            tcount = 0;

        for (k=0;k<temp;k++){
            let onechar = tmpStr.charAt(k);

            if (escape(onechar).length > 4) {
                tcount += 2;
            }
            else if (onechar!='\r') {
                tcount++;
            }
        }        
        
        return tcount;
    }      
    
    function netsCheck(text){
        let tmpStr = new String(text),
            temp = tmpStr.length,            
            tcount = 0,
            max = 2000,
            isMax = false;

        for(k=0;k<temp;k++){
            let onechar = tmpStr.charAt(k);

            if(escape(onechar).length > 4) {
                tcount += 2;
            }
            else if(onechar!='\r') {
                tcount++;
            }
            if(tcount > max) {
                isMax = true;
                tmpStr = tmpStr.substring(0, k);
                $smsText.val(tmpStr);
                break;
            }
        }
        
        if(isMax){
            checkByte();
            showAlert('2000Byte를 초과하실 수 없습니다.<br/>2000Byte를 제외한 나머지 내용은 삭제처리됩니다.');   
        }                
    }
    
    $('#chkAll').on('click', function(){        
        
        if($(this).is(':checked')){
            $('.chkSmsHp').prop('checked', true);
        }else{
            $('.chkSmsHp').prop('checked', false);
        }
    });
    
    $('.chkSmsHp').on('click', function(){
        
        if($('.chkSmsHp').length == $('.chkSmsHp:checked').length){
            $('#chkAll').prop('checked', true);
        }else{
            $('#chkAll').prop('checked', false);
        }
    });
     
</script>

<?php /* echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); */ ?>

<?php
include_once ('./admin.tail.php');
?>