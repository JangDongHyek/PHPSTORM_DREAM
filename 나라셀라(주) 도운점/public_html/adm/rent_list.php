<?php
$sub_menu = "250100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$status = empty($_GET['status'])? '' : $_GET['status'];
$floor = empty($_GET['floor'])? '' : $_GET['floor'];
$isUse = empty($_GET['isUse'])? 'Y' : $_GET['isUse'];

$sql_common = " FROM rental_list AS R JOIN
                     g5_member AS M ON M.mb_id = R.mb_id ";
$sql_search = " WHERE 1=1 ";

if(!empty($_GET['sfl']) && !empty($_GET['stx'])){
    $sql_search .= " AND {$_GET['sfl']} = '{$_GET['stx']}' ";
}

if(!empty($status)){
    $sql_search .= " AND R.status = '{$status}' ";
}

if(!empty($floor)){
    $sql_search .= " AND R.floor = '{$floor}' ";
}

$sql_search .= " AND R.isUse = '{$isUse}' ";

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

$g5['title'] = 'RENT관리';
include_once('./admin.head.php');

$sql = " 
    SELECT 
        R.*,
        M.mb_name
    {$sql_common}
    {$sql_search}
    ORDER BY
        R.rental_idx DESC
    LIMIT 
        {$from_record}, {$rows} ";

$result = sql_query($sql);

$colspan = 16;
?>

<div class="local_ov01 local_ov">
    총 RENT수 <?php echo number_format($total_count) ?>회
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
   
    <input type="hidden" name="isUse" value="<?=$isUse?>"/>
                
    
    <!--상태/대관 검색-->
    <div style="padding: 10px 0px 15px 0;">
        <span class="sch_title">상태 - </span>
        <input type="radio" name="status" id="status" value="" <?=empty($status)? 'checked' : ''?>>
        <label for="status">전체</label>
        <? foreach(STATUS as $key=>$data){ ?>
        <input type="radio" name="status" id="status<?=$key?>" value="<?=$key?>" <?=$status == $key? 'checked' : ''?>>
        <label for="status<?=$key?>"><?=$data?></label>
        <? } ?>
                
        <span class="sch_title"> 위치 - </span>
        <input type="radio" name="floor" id="floor" value="" <?=empty($floor)? 'checked' : ''?>>
        <label for="floor">전체</label>
        <? foreach(RENT_FLOOR as $key=>$data){ ?>
        <input type="radio" name="floor" id="floor<?=$key?>" value="<?=$key?>" <?=$floor == $key? 'checked' : ''?>>
        <label for="floor<?=$key?>"><?=$key.'F - '.$data?></label>
        <? } ?>
    </div>
    
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="R.mb_id" <?php echo get_selected($_GET['sfl'], "R.mb_id"); ?>>회원아이디</option>
        <option value="R.floor" <?php echo get_selected($_GET['sfl'], "R.floor"); ?>>대관(층수 입력)</option>
        <option value="R.rentDate" <?php echo get_selected($_GET['sfl'], "R.rentDate"); ?>>대관날짜</option>
        <option value="R.rentName" <?php echo get_selected($_GET['sfl'], "R.rentName"); ?>>이름</option>
        <option value="R.rentTel" <?php echo get_selected($_GET['sfl'], "R.rentTel"); ?>>전화번호</option>
        <option value="R.rentEmail" <?php echo get_selected($_GET['sfl'], "R.rentEmail"); ?>>이메일</option>
        <option value="R.rentTime" <?php echo get_selected($_GET['sfl'], "R.rentTime"); ?>>시간</option>
        <option value="R.isSetting" <?php echo get_selected($_GET['sfl'], "R.isSetting"); ?>>세팅필요여부(Y/N)</option>
        <option value="R.isCleaning" <?php echo get_selected($_GET['sfl'], "R.isCleaning"); ?>>클리닝필요여부(Y/N)</option>
        <option value="R.glassRental" <?php echo get_selected($_GET['sfl'], "R.glassRental"); ?>>글라스 렌탈</option>
        <option value="R.person" <?php echo get_selected($_GET['sfl'], "R.person"); ?>>인원</option>
        <option value="R.category" <?php echo get_selected($_GET['sfl'], "R.category"); ?>>행사유형</option>
        <option value="R.detailSchedule" <?php echo get_selected($_GET['sfl'], "R.detailSchedule"); ?>>상세 일정</option>
        <option value="R.request" <?php echo get_selected($_GET['sfl'], "R.request"); ?>>기타문의</option>
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
                    <th scope="col">순번</th>
                    <th scope="col">회원이름</th>
                    <th scope="col">대관요청일</th>
                    <th scope="col">대관 층</th>                    
                    <th scope="col">신청자 성함</th>
                    <th scope="col">전화번호</th>
                    <th scope="col">이메일</th>
                    <th scope="col">시간</th>
                    <th scope="col">인원</th>
                    <th scope="col">세팅 필요 여부</th>
                    <th scope="col">행사 유형</th>
                    <th scope="col">상세 일정</th>
                    <th scope="col">기타문의</th>
                    <th scope="col">클리닝 필요 여부</th>
                    <th scope="col">글라스 렌탈</th> 
                    <th scope="col">신청일</th>
                    <th scope="col">상태</th>
                    <th scope="col">관리</th>
                </tr>
            </thead>
            <tbody>
                <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {        
        $bg = 'bg'.($i%2);
    ?>

                <tr class="<?php echo $bg; ?>">
                    <td class=""><?=($from_record + $i + 1)?></td>
                    <td class=""><?=$row['mb_name']; ?></td>
                    <td class=""><?=$row['rentDate']; ?></td>
                    <td class=""><?=$row['floor'].'F - '.RENT_FLOOR[$row['floor']]; ?></td>                    
                    <td class=""><?=$row['rentName']; ?></td>
                    <td class=""><?=$row['rentTel']; ?></td>
                    <td class=""><?=$row['rentEmail']; ?></td>    
                    <td class=""><?=$row['rentTime']; ?>시간</td>
                    <td class=""><?=$row['person']; ?></td>
                    <td class=""><?=$row['isSetting']; ?></td>
                    <td class=""><?=$row['category']; ?></td>
                    <td class=""><?=$row['detailSchedule']; ?></td>
                    <td class=""><?=nl2br($row['request']); ?></td>
                    <td class=""><?=$row['isCleaning']; ?></td>
                    <td class=""><?=$row['glassRental']; ?></td>                    
                    <td class=""><?=substr($row['regDate'], 2, 14); ?></td>
                    <td>                       
                        <select onchange="changeStatus($(this), <?=$row['rental_idx']?>);">
                            <? foreach(STATUS as $key=>$data){ ?>
                            <option value="<?=$key?>" <?=$row['status'] == $key? 'selected' : ''?>><?=$data?></option>
                            <? } ?>
                        </select>
                    </td>
                    <td>
                        <button type="button" onclick="deleteItem('rental_list', 'rental_idx', <?=$row['rental_idx']?>, '<?=$isUse?>')" class="btn_submit btn_cancel_chk"><?=$isUse == 'Y'? '삭제' : '복구'?></button>
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
    async function changeStatus($this, rental_idx) {

        const changeStatusRes = await postJson(getAjaxUrl('rent'), {
            mode: 'changeStatus',
            rental_idx: rental_idx,
            status: $this.val()
        });

        if (!changeStatusRes.result) {
            showAlert(changeStatusRes.msg);
            return;
        }
    }

    function deleteItem(table, key, idx, isUse) {
        let typeMsg = isUse == 'Y'? '삭제' : '복구';
        
        showConfirm(`[렌트번호 - ${getRentNumber(idx)}]<br/><br/>${typeMsg}처리 하시겠습니까?`)
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

    $(function() {

    });
</script>
<?php
include_once ('./admin.tail.php');
?>