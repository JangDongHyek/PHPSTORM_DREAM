<?php
$sub_menu = "350100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$status = empty($_GET['status'])? '' : $_GET['status'];
$floor = empty($_GET['floor'])? '' : $_GET['floor'];
$isUse = empty($_GET['isUse'])? 'Y' : $_GET['isUse'];

$sql_common = " FROM class_list AS C ";
$sql_search = " WHERE 1=1 ";

if(!empty($_GET['sfl']) && !empty($_GET['stx'])){
    $sql_search .= " AND {$_GET['sfl']} LIKE '%{$_GET['stx']}%' ";
}

if(!empty($status)){
    
    if($status == 'I'){ /* 진행중 */
        $sql_search .= " AND C.eventDateTime > '{$DATE_HI}' ";
    }else if($status == 'F'){ /* 마감 */
        $sql_search .= " AND C.eventDateTime < '{$DATE_HI}' ";
    }
}

if(!empty($floor)){
    $sql_search .= " AND C.floor = '{$floor}' ";
}

$sql_search .= " AND C.isUse = '{$isUse}' ";

$sql = " 
    SELECT
        COUNT(*) as cnt
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

$g5['title'] = 'CLASS관리';
include_once('./admin.head.php');

$sql = " 
    SELECT 
        C.*
    {$sql_common}
    {$sql_search}
    ORDER BY
        C.class_idx DESC
    LIMIT 
        {$from_record}, {$rows} ";

$result = sql_query($sql);

$colspan = 16;
?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

<div class="local_ov01 local_ov">
    총 CLASS수 <?php echo number_format($total_count) ?>회
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

    <input type="hidden" name="isUse" value="<?=$isUse?>" />


    <!--상태/대관 검색-->
    <div style="padding: 10px 0px 15px 0;">
        <span class="sch_title">상태 - </span>
        <input type="radio" name="status" id="status" value="" <?=empty($status)? 'checked' : ''?>>
        <label for="status">전체</label>
        <? foreach(CLASS_STATUS as $key=>$data){ ?>
        <input type="radio" name="status" id="status<?=$key?>" value="<?=$key?>" <?=$status == $key? 'checked' : ''?>>
        <label for="status<?=$key?>"><?=$data?></label>
        <? } ?>

        <span class="sch_title"> 위치 - </span>
        <input type="radio" name="floor" id="floor" value="" <?=empty($floor)? 'checked' : ''?>>
        <label for="floor">전체</label>
        <? foreach(CLASS_FLOOR as $key=>$data){ ?>
        <input type="radio" name="floor" id="floor<?=$key?>" value="<?=$key?>" <?=$floor == $key? 'checked' : ''?>>
        <label for="floor<?=$key?>"><?=$key.'F - '.$data?></label>
        <? } ?>
    </div>

    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="C.className" <?php echo get_selected($_GET['sfl'], "C.className"); ?>>CLASS명</option>
        <option value="C.eventDate" <?php echo get_selected($_GET['sfl'], "C.eventDate"); ?>>EVENT날짜</option>
        <option value="C.maxPerson" <?php echo get_selected($_GET['sfl'], "C.maxPerson"); ?>>최대인원</option>
        <option value="C.price" <?php echo get_selected($_GET['sfl'], "C.price"); ?>>가격</option>
    </select>

    <!--<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>-->
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input" placeholder="검색어 입력">
    <input type="submit" class="btn_submit" value="검색" style="width: 100px; height: 30px;">
</form>

<!--
<div class="local_desc01 local_desc">
    <p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>
</div>
-->

<div id="appListModal" class="modal" style="width: 1000px !important; max-width: unset !important;">
    <table>
        <thead>
            <tr>
                <th>회원아이디</th>
                <th>결제타입</th>
                <th>상태관리</th>
                <th>이름</th>
                <th>생년월일</th>
                <th>휴대번호</th>
                <th>이메일</th>                
            </tr>
        </thead>
        <tbody id="appListWrap">
        </tbody>
    </table>
</div>

<?php if ($is_admin == 'super') { ?>
<div class="btn_add01 btn_add">
    <a href="./class_setting.php">CLASS 등록</a>
</div>
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
                    <th scope="col">CLASS번호</th>
                    <th scope="col">대표이미지</th>
                    <th scope="col">위치</th>
                    <th scope="col">상태</th>
                    <th scope="col">CLASS 마감시간</th>
                    <th scope="col">CLASS 진행시간</th>                    
                    <th scope="col">클래스명</th>
                    <th scope="col">최대인원</th>
                    <th scope="col">가격</th>
                    <th scope="col">내용</th>
                    <th scope="col">등록일</th>
                    <th scope="col">신청내역</th>
                    <th scope="col">관리</th>
                    <th scope="col">관리</th>
                </tr>
            </thead>
            <tbody>
                <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {        
        $bg = 'bg'.($i%2);
        
        $row = sortClassInfo($row);
        
        /* 신청내역 정원 */        
        $totalAppCnt = sql_fetch("SELECT SUM(person) AS total_persons
                                        FROM class_app_list
                                        WHERE class_idx = '{$row['class_idx']}' AND status = 'CONFIRMED'")['total_persons'];
    ?>
                <tr class="<?php echo $bg; ?>">
                    <td class=""><?=getClassNumber($row['class_idx']); ?></td>
                    <td class="">
                        <div class="img">
                            <img src="<?=$row['thumbnail']?>" />
                        </div>
                    </td>
                    <td class=""><?=$row['floor'].'F - '.CLASS_FLOOR[$row['floor']]; ?></td>
                    <td class=""><?=$row['classStatus']?></td>
                    <td class=""><?=$row['eventDateTime']; ?></td>
                    <td class=""><?=$row['eventDate']?>일 <?=$row['eventTime1']?> ~ <?=$row['eventTime2']?></td>                    
                    <td class=""><?=$row['className']; ?></td>
                    <td class=""><?=$row['maxPerson']; ?>명</td>
                    <td class=""><?=number_format($row['price']); ?>원</td>
                    <td class=""><?=nl2br($row['content']); ?></td>
                    <td class=""><?=substr($row['regDate'], 2, 14); ?></td>
                    <td class="linkApp">
                        <a href="./popup_member_list.php?class_idx=<?=$row['class_idx']?>">신청내역(<?=$totalAppCnt == ''? 0 : $totalAppCnt ?>명)</a>
                    </td>
                    <td>
                        <a href="./class_setting.php?class_idx=<?=$row['class_idx']?>" class="btn_update">수정</a>
                    </td>
                    <td>
                        <button type="button" onclick="deleteItem('class_list', 'class_idx', <?=$row['class_idx']?>, '<?=$isUse?>')" class="btn_submit btn_cancel_chk"><?=$isUse == 'Y'? '삭제' : '복구'?></button>
                    </td>
                </tr>
                <?php }
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

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page=&isUse='.$isUse.'&status='.$status.'&floor'.$floor); ?>

<script>
    const PAY_TYPE = <?=json_encode(PAY_TYPE)?>;
    const CLASS_APP_STATUS = <?=json_encode(CLASS_APP_STATUS)?>;
    
    function deleteItem(table, key, idx, isUse) {
        let typeMsg = isUse == 'Y' ? '삭제' : '복구';

        showConfirm(`[CLASS번호 - ${getClassNumber(idx)}]<br/><br/>${typeMsg}처리 하시겠습니까?`)
            .then(async (result) => {

                if (!result.value) return;

                const deleteItemRes = await postJson(getAjaxUrl('admin'), {
                    mode: 'deleteItem',
                    table: table,
                    key: key,
                    idx: idx
                });

                if (!deleteItemRes.result) {
                    showAlert(deleteItemRes.msg);
                    return;
                }

                showAlert(`${typeMsg}처리 되었습니다.`)
                    .then(() => {
                        location.reload();
                    });
            });
    }

    
    async function openAppListModal(class_idx){
        
        let appListHtml = '';
        
        const appListRes = await postJson(getAjaxUrl('class'), {
            mode: 'getAppList',
            class_idx: class_idx            
        });

        if (!appListRes.result) {
            showAlert(appListRes.msg);
            return;
        }        
        
        let list = appListRes.list;
        
        for(let i=0; i<list.length; i++){
            let detailList = list[i],
                detailListLength = detailList.length;
            
            for(let j=0; j<detailListLength; j++){
                let data = detailList[j],
                    rowspan = detailListLength,
                    isFirst = (!j);
                
                if(isFirst){
                    appListHtml += `
                    <tr>
                        <td rowspan="${rowspan}">${data.mb_id}</td>
                        <td rowspan="${rowspan}">${PAY_TYPE[data.payType]}</td>      
                        <td rowspan="${rowspan}">
                            <select onchange="changeStatus($(this), '${data.mb_id}', ${data.class_idx});">
                                ${getStatusHtml(data.status)}
                            </select>
                        </td>`;
                }
                
                appListHtml += `
                        <td>${data.name}</td>
                        <td>${data.birth}</td>
                        <td>${data.hp}</td>
                        <td>${data.email}</td>                        
                    </tr>
                `;
            }
        }
        
        
        $('#appListWrap').html(appListHtml);
        $('#appListModal').modal();
    }
    
    function getStatusHtml(status){
        let statusHtml = '';
        
        for (const key in CLASS_APP_STATUS) {          
            const data = CLASS_APP_STATUS[key];
            
            statusHtml += `<option value="${key}" ${status == key? 'selected' : ''}>${data}</option>`;
        }
        
        return statusHtml;
    }
    
    async function changeStatus($this, mb_id, class_idx) {

        const changeStatusRes = await postJson(getAjaxUrl('class'), {
            mode: 'changeStatus',
            mb_id: mb_id,
            class_idx: class_idx,
            status: $this.val()
        });
        
        if (!changeStatusRes.result) {
            showAlert(changeStatusRes.msg);
            return;
        }
    }
    
    $(function() {
        
    });
</script>
<?php
include_once ('./admin.tail.php');
?>