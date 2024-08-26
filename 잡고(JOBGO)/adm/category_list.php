<?php
$sub_menu = "260100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$c_or_t = $_REQUEST['c_or_t'];
if (empty($c_or_t)){
    $c_or_t = 'ctg';
}

$sql_common = " from {$g5['code_table']}  ";


$sql_search = " where 1=1 and code_p_idx != '0' ";


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
if ($big_ctg != "") {
    $sql_code = " and code_p_idx = ".$big_ctg ;
}

if ($small_ctg != "") {
    $sql_code = " and ( code_p_idx = ".$small_ctg." or code_idx = ".$small_ctg .")";
}

//if ($c_or_t != "") {

//    $sql_code = " and code_ctg = '{$c_or_t}'";
//}

if (!$sst) {
    $sst = "code_p_idx";
//    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

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

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <input type="hidden" name="big_ctg" value="<?php echo $big_ctg ?>">
    <input type="hidden" name="small_ctg" value="<?php echo $small_ctg ?>">
    <input type="hidden" name="c_or_t" id="c_or_t_input" value="<?php echo $c_or_t ?>">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="code_name"<?php echo get_selected($_GET['sfl'], "code_name"); ?>>카테고리 이름</option>
        <? /*
        <option value="mb_nick"<?php echo get_selected($_GET['sfl'], "mb_nick"); ?>>닉네임</option>
        <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
        <option value="mb_level"<?php echo get_selected($_GET['sfl'], "mb_level"); ?>>권한</option>
        <option value="mb_email"<?php echo get_selected($_GET['sfl'], "mb_email"); ?>>E-MAIL</option>
        <option value="mb_tel"<?php echo get_selected($_GET['sfl'], "mb_tel"); ?>>전화번호</option>
        <option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰번호</option>
        <option value="mb_point"<?php echo get_selected($_GET['sfl'], "mb_point"); ?>>포인트</option>
        <option value="mb_datetime"<?php echo get_selected($_GET['sfl'], "mb_datetime"); ?>>가입일시</option>
        <option value="mb_ip"<?php echo get_selected($_GET['sfl'], "mb_ip"); ?>>IP</option>
        <option value="mb_recommend"<?php echo get_selected($_GET['sfl'], "mb_recommend"); ?>>추천인</option>
        */ ?>
    </select>

    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <span id="stx_span" style="display: inline"><input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class=" frm_input"></span>
    <input type="submit" class="btn_submit" value="검색">
</form>
<form id="fsearch2" name="fsearch2" class="local_sch01 local_sch" method="get">
    <label for="big_ctg" class="sound_only">검색대상</label>
    <div>
        재능 or 공모전
        <select name="c_or_t" id="c_or_t" onchange="ctg_change('c_or_t');">
            <option value="ctg"<?php echo get_selected($_GET['c_or_t'],'ctg') ?>>재능</option>
            <option value="competition_ctg"<?php echo get_selected($_GET['c_or_t'],'competition_ctg') ?>>공모전</option>
        </select>
        상위 카테고리
    <select name="big_ctg" id="big_ctg" onchange="ctg_change('big');">
        <option value="">상위카테고리</option>
        <?php
        $code = common_code($c_or_t,'code_ctg','json');
        for ($i = 0; $i < count($code); $i++){ ?>
            <option value="<?php echo $code[$i]['idx'] ?>"<?php echo get_selected($_GET['big_ctg'],$code[$i]['idx']) ?> ><?=$code[$i]['name']?></option>
        <?php } ?>
        <? /*
        <option value="mb_nick"<?php echo get_selected($_GET['sfl'], "mb_nick"); ?>>닉네임</option>
        <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
        <option value="mb_level"<?php echo get_selected($_GET['sfl'], "mb_level"); ?>>권한</option>
        <option value="mb_email"<?php echo get_selected($_GET['sfl'], "mb_email"); ?>>E-MAIL</option>
        <option value="mb_tel"<?php echo get_selected($_GET['sfl'], "mb_tel"); ?>>전화번호</option>
        <option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰번호</option>
        <option value="mb_point"<?php echo get_selected($_GET['sfl'], "mb_point"); ?>>포인트</option>
        <option value="mb_datetime"<?php echo get_selected($_GET['sfl'], "mb_datetime"); ?>>가입일시</option>
        <option value="mb_ip"<?php echo get_selected($_GET['sfl'], "mb_ip"); ?>>IP</option>
        <option value="mb_recommend"<?php echo get_selected($_GET['sfl'], "mb_recommend"); ?>>추천인</option>
        */ ?>
    </select>
        2차 카테고리
        <select name="small_ctg" id="small_ctg" onchange="ctg_change('small');">
            <option value="">2차 카테고리</option>

            <?php
            if ($big_ctg != "") {
                $code = common_code($big_ctg,'code_p_idx','json');
                for ($i = 0; $i < count($code); $i++){ ?>
                    <option value="<?php echo $code[$i]['idx'] ?>"<?php echo get_selected($_GET['small_ctg'],$code[$i]['idx']) ?> ><?=$code[$i]['name']?></option>
                <?php }
            }?>
        </select>
    </div>
</form>
<p style="margin-left: 20px">※ 2차 카테고리를 노출안함으로 설정할 경우, 연결된 3차 카테고리의 2차 카테고리가 비워지게 됩니다. 다시 노출로 설정할 경우 해당 2차 카테고리가 나오게 됩니다.</p>
<p style="margin-left: 20px">※ 노출순서는 숫자가 작을수록 먼저나오게 됩니다.</p>


<form name="fmemberlist" id="fmemberlist" action="./category_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="big_ctg" value="<?php echo $big_ctg ?>">
    <input type="hidden" name="small_ctg" value="<?php echo $small_ctg ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

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
                <th>2차 카테고리</th>
                <th>3차 카테고리</th>
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
                $code = common_code($row['code_p_idx'],'code_idx','json');
                $code_name = $row['code_name'];
                //2차 카테고리 일 경우 - 공모전은 2차 카테고리까지 밖에없음
                if ($code[0]['type'] == 'ctg2'|| $code[0]['type'] == 'competition_ctg'){
                    $p_code = p_common_code($row['code_p_idx']);
                //1차 카테고리 일경우
                }elseif ($code[0]['type'] == 'ctg' ){
                    $p_code = $code[0];
                    $code[0]['name'] = $row['code_name'];
                    $row['code_name'] = "";
                }
                ?>
                <tr class="<?php echo $bg; ?>">
                    <!--	<td>
			<input type="hidden" name="mb_id[<?php /*echo $i */?>]" value="<?php /*echo $row['mb_id'] */?>" id="mb_id_<?php /*echo $i */?>">
            <input type="checkbox" name="chk[]" value="<?php /*echo $i */?>" id="chk_<?php /*echo $i */?>">
		</td>-->
                    <td><?=$list_no?></td>
                    <td>
                        <input name="code_idx[]" type="hidden" value="<?php echo $row['code_idx'] ?>" class="frm_input">
                        <input name="code_number[]" type="text" value="<?php echo $row['code_number'] ?>" class="frm_input">
                    </td>
                    <td><?php echo $p_code['name']?></td>
                    <td><?php echo $code[0]['name']?></td>
                    <td><?=$row['code_name']?></td>
                    <td>
                        <select onchange="yn_list_change(<?=$row['code_idx']?>,this.value)">
                            <?php for($i = 1 ; $i <= count($yn_list); $i++){ ?>
                                <option value="<?=$i?>" <? if ($row['code_use'] == $i ) echo "selected"; ?> ><?= $yn_list[$i] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td><?=substr($row['wr_datetime'],2,8)?></td>
                </tr>

                <? /*
    <tr class="<?php echo $bg; ?>">

        <td headers="mb_list_chk" class="td_chk" rowspan="2">
            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td headers="mb_list_id" rowspan="2" class="td_name sv_use"><?php echo $mb_id ?></td>
        <td headers="mb_list_name" class="td_mbname"><?php echo get_text($row['mb_name']); ?></td>
        <td headers="mb_list_cert" colspan="6" class="td_mbcert">
            <input type="radio" name="mb_certify[<?php echo $i; ?>]" value="ipin" id="mb_certify_ipin_<?php echo $i; ?>" <?php echo $row['mb_certify']=='ipin'?'checked':''; ?>>
            <label for="mb_certify_ipin_<?php echo $i; ?>">아이핀</label>
            <input type="radio" name="mb_certify[<?php echo $i; ?>]" value="hp" id="mb_certify_hp_<?php echo $i; ?>" <?php echo $row['mb_certify']=='hp'?'checked':''; ?>>
            <label for="mb_certify_hp_<?php echo $i; ?>">휴대폰</label>
        </td>
        <td headers="mb_list_mobile" class="td_tel"><?php echo get_text($row['mb_hp']); ?></td>
        <td headers="mb_list_auth" class="td_mbstat">
            <?php
            if ($leave_msg || $intercept_msg) echo $leave_msg.' '.$intercept_msg;
            else echo "정상";
            ?>
            <?php echo get_member_level_select("mb_level[$i]", 1, $member['mb_level'], $row['mb_level']) ?>
        </td>
        <td headers="mb_list_lastcall" class="td_date"><?php echo substr($row['mb_today_login'],2,8); ?></td>
        <td headers="mb_list_grp" rowspan="2" class="td_numsmall"><?php echo $group ?></td>
        <td headers="mb_list_mng" rowspan="2" class="td_mngsmall"><?php echo $s_mod ?> <?php echo $s_grp ?></td>
    </tr>
    <tr class="<?php echo $bg; ?>">
        <td headers="mb_list_nick" class="td_name sv_use"><div><?php echo $mb_nick ?></div></td>
        <td headers="mb_list_mailc" class="td_chk"><?php echo preg_match('/[1-9]/', $row['mb_email_certify'])?'<span class="txt_true">Yes</span>':'<span class="txt_false">No</span>'; ?></td>
        <td headers="mb_list_open" class="td_chk">
            <label for="mb_open_<?php echo $i; ?>" class="sound_only">정보공개</label>
            <input type="checkbox" name="mb_open[<?php echo $i; ?>]" <?php echo $row['mb_open']?'checked':''; ?> value="1" id="mb_open_<?php echo $i; ?>">
        </td>
        <td headers="mb_list_mailr" class="td_chk">
            <label for="mb_mailling_<?php echo $i; ?>" class="sound_only">메일수신</label>
            <input type="checkbox" name="mb_mailling[<?php echo $i; ?>]" <?php echo $row['mb_mailling']?'checked':''; ?> value="1" id="mb_mailling_<?php echo $i; ?>">
        </td>
        <td headers="mb_list_sms" class="td_chk">
            <label for="mb_sms_<?php echo $i; ?>" class="sound_only">SMS수신</label>
            <input type="checkbox" name="mb_sms[<?php echo $i; ?>]" <?php echo $row['mb_sms']?'checked':''; ?> value="1" id="mb_sms_<?php echo $i; ?>">
        </td>
        <td headers="mb_list_adultc" class="td_chk">
            <label for="mb_adult_<?php echo $i; ?>" class="sound_only">성인인증</label>
            <input type="checkbox" name="mb_adult[<?php echo $i; ?>]" <?php echo $row['mb_adult']?'checked':''; ?> value="1" id="mb_adult_<?php echo $i; ?>">
        </td>
        <td headers="mb_list_deny" class="td_chk">
            <?php if(empty($row['mb_leave_date'])){ ?>
            <input type="checkbox" name="mb_intercept_date[<?php echo $i; ?>]" <?php echo $row['mb_intercept_date']?'checked':''; ?> value="<?php echo $intercept_date ?>" id="mb_intercept_date_<?php echo $i ?>" title="<?php echo $intercept_title ?>">
            <label for="mb_intercept_date_<?php echo $i; ?>" class="sound_only">접근차단</label>
            <?php } ?>
        </td>
        <td headers="mb_list_tel" class="td_tel"><?php echo get_text($row['mb_tel']); ?></td>
        <td headers="mb_list_point" class="td_num"><a href="point_list.php?sfl=mb_id&amp;stx=<?php echo $row['mb_id'] ?>"><?php echo number_format($row['mb_point']) ?></a></td>
        <td headers="mb_list_join" class="td_date"><?php echo substr($row['mb_datetime'],2,8); ?></td>
    </tr>
	*/ ?>

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
    <h2 class="h2_frm">2차 카테고리 추가</h2>

    <form name="fpointlist2" method="post" id="fpointlist2" action="./category_update.php" autocomplete="off">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="token" value="<?php echo $token ?>">
        <input type="hidden" name="idx" id="idx" value="">

        <div class="tbl_frm01 tbl_wrap">
            <table>
                <colgroup>
                    <col class="grid_4">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row"><label for="mb_id"> 재능 or 공모전 카테고리<strong class="sound_only">필수</strong></label></th>
                    <td><select name="code_ctg" onchange="pro_ctg2_change(this.value)">
                        <option value="ctg2">재능</option>
                        <option value="competition_ctg2">공모전</option>
                    </select></td>
                </tr>
                <tr>
                    <th scope="row"><label for="mb_id">1차 카테고리<strong class="sound_only">필수</strong></label></th>
                    <td> <select name="code_p_idx" id="code_p_idx" >
                            <?php
                            $code = common_code('ctg','code_ctg','json');
                            for ($i = 0; $i < count($code); $i++){ ?>
                                <option value="<?php echo $code[$i]['idx'] ?>" ><?=$code[$i]['name']?></option>
                            <?php } ?>
                            <? /*
        <option value="mb_nick"<?php echo get_selected($_GET['sfl'], "mb_nick"); ?>>닉네임</option>
        <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
        <option value="mb_level"<?php echo get_selected($_GET['sfl'], "mb_level"); ?>>권한</option>
        <option value="mb_email"<?php echo get_selected($_GET['sfl'], "mb_email"); ?>>E-MAIL</option>
        <option value="mb_tel"<?php echo get_selected($_GET['sfl'], "mb_tel"); ?>>전화번호</option>
        <option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰번호</option>
        <option value="mb_point"<?php echo get_selected($_GET['sfl'], "mb_point"); ?>>포인트</option>
        <option value="mb_datetime"<?php echo get_selected($_GET['sfl'], "mb_datetime"); ?>>가입일시</option>
        <option value="mb_ip"<?php echo get_selected($_GET['sfl'], "mb_ip"); ?>>IP</option>
        <option value="mb_recommend"<?php echo get_selected($_GET['sfl'], "mb_recommend"); ?>>추천인</option>
        */ ?>
                        </select></td>
                </tr>
                <tr>
                    <th scope="row"><label for="code_name">2차 카테고리 이름<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="code_name" id="code_name" class="required frm_input" size="60"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="code_use">사용유무<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <select name="code_use" id="code_use">
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
<section id="point_mng">
    <h2 class="h2_frm">3차 카테고리 추가</h2>

    <form name="fpointlist3" method="post" id="fpointlist3" action="./category_update.php" autocomplete="off">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="token" value="<?php echo $token ?>">
        <input type="hidden" name="idx" id="idx" value="">
        <input type="hidden" name="code_ctg" value="ctg3">


        <div class="tbl_frm01 tbl_wrap">
            <table>
                <colgroup>
                    <col class="grid_4">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row"><label for="mb_id">1차 카테고리<strong class="sound_only">필수</strong></label></th>
                    <td>  <select onchange="pro_ctg1_change(this.value)" name="" class="select" id="pro_ctg1">
                            <?= common_code('ctg','code_ctg','html')?>
                        </select></td>
                </tr>
                <tr>
                    <th scope="row"><label for="mb_id">2차 카테고리<strong class="sound_only">필수</strong></label></th>
                    <td> <select name="code_p_idx" id="ctg2_option" >

                            </select></td>
                            <? /*
        <option value="mb_nick"<?php echo get_selected($_GET['sfl'], "mb_nick"); ?>>닉네임</option>
        <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
        <option value="mb_level"<?php echo get_selected($_GET['sfl'], "mb_level"); ?>>권한</option>
        <option value="mb_email"<?php echo get_selected($_GET['sfl'], "mb_email"); ?>>E-MAIL</option>
        <option value="mb_tel"<?php echo get_selected($_GET['sfl'], "mb_tel"); ?>>전화번호</option>
        <option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰번호</option>
        <option value="mb_point"<?php echo get_selected($_GET['sfl'], "mb_point"); ?>>포인트</option>
        <option value="mb_datetime"<?php echo get_selected($_GET['sfl'], "mb_datetime"); ?>>가입일시</option>
        <option value="mb_ip"<?php echo get_selected($_GET['sfl'], "mb_ip"); ?>>IP</option>
        <option value="mb_recommend"<?php echo get_selected($_GET['sfl'], "mb_recommend"); ?>>추천인</option>
        */ ?>

                </tr>
                <tr>
                    <th scope="row"><label for="code_name">3차 카테고리 이름<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="code_name" id="code_name" class="required frm_input" size="60"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="code_use">사용유무<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <select name="code_use" id="code_use">
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
            <input type="button" value="추가" id="add_btn" name="add_btn" onclick="add_setting2()" style="display: none" class="btn_submit">
        </div>

    </form>

</section>
<script>
    $(document).ready(function () {
        pro_ctg1_change(3);

        var c_or_t = '<?= $c_or_t ?>';
        if (c_or_t == 'ctg'){
            $('#small_ctg').attr('disabled',false);
        }else{
            $('#small_ctg').attr('disabled',true);

        }
    })

    function fmemberlist_submit(f)
    {


        return true;
    }
    function ctg_change(type) {

        var big_ctg = $("#big_ctg").val();
        var c_or_t = $("#c_or_t").val();
        if (type == 'small'){
            var small_ctg = $("#small_ctg").val();
        }else{
            var small_ctg = "";
        }
        var params = "",
            sfl = $("#sfl").val(),
            stx = $("#stx").val();

        if (stx != "" || big_ctg != "" || small_ctg != ""|| c_or_t != "") {
            params += (params == "")? "?" : "&";
            params += "sfl=" + sfl + "&stx=" + stx+ "&big_ctg=" + big_ctg + "&small_ctg=" + small_ctg+ "&c_or_t=" + c_or_t;
        }

        location.href = g5_admin_url + "/category_list.php" + params;

    }

    function add_setting() {
        $('#fpointlist2 [name = idx]').val('');

        $('#fpointlist2').submit();

    }

    function add_setting2() {
        $('#fpointlist3 [name = idx]').val('');

        $('#fpointlist3').submit();

    }

    //3차카테고리 추가 시 2차 카테고리 뿌려주기
    function pro_ctg1_change(val) {


        $.ajax({
            url: g5_bbs_url+"/ajax.controller.php",
            type: "POST",
            data: {
                "pro_ctg1": val,
                "mode": "pro_ctg2_common"
            },
            dataType: "html",
            success: function(data) {
                $('#ctg2_option').html('<option value="">상세분야 선택</option>' + data);
            }
        });

    }

    //2차 카테고리 추가 시 재능 공모전 1차 카테고리 뿌려주기
    function pro_ctg2_change(val) {

        var val = val.substr(0, val.length -1);

        $.ajax({
            url: g5_bbs_url+"/ajax.controller.php",
            type: "POST",
            data: {
                "value": val,
                "mode": "code_ctg_change"
            },
            dataType: "html",
            success: function(data) {

                //2차 카테고리 추가 시
                $('#code_p_idx').html(data);

            }
        });

    }

    function yn_list_change(idx,val) {
        console.log(val);
        $.ajax({
            url: g5_bbs_url+"/ajax.controller.php",
            type: "POST",
            data: {
                "idx": idx,
                "code_use" : val,
                "mode": "yn_list_change"
            },
            success: function(data) {
                if (data != 1){
                    alert("실패했습니다. 새로고침 후 다시 시도해주세요.");
                }

            }
        });
    }

</script>

<?php
include_once ('./admin.tail.php');
?>
