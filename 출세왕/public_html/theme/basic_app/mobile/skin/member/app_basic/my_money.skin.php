<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);

$sql_common = " from {$g5['car_wash_table']} cw
                left join g5_member mem on cw.ma_id = mem.mb_id";


$sql_search = " where 1=1 ";
$sql_search .= " and cw.ma_id = '{$member['mb_id']}' ";
if ($_REQUEST["car_date_type_name"] != ""){
    $sql_search .= "and mem.mb_name like '%". $_REQUEST["car_date_type_name"]."%'" ;
}

if ($_REQUEST["start_date"] != "" ){
    if ($_REQUEST["end_date"] == ""){
        $_REQUEST["end_date"] = G5_TIME_YMD;
    }
    $sql_search .= "and date_format(cw.wr_datetime, '%Y-%m-%d') >= '{$_REQUEST["start_date"] }'
                    AND date_format(cw.wr_datetime, '%Y-%m-%d') <= '{$_REQUEST["end_date"]}'";

    // 23.04.21 기존꺼 기간정하고 페이지넘기면 있던 오류 수정해줌 wc
    $qstr .= '&amp;start_date=' . urlencode($_REQUEST["start_date"]);
    $qstr .= '&amp;end_date=' . urlencode($_REQUEST["end_date"]);
}







if ($stx != "") {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'cw_step' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}


//정산현황 0대기 1진행 2완료  3취소
if ($_REQUEST["ma_step"] != ""){
    
    //1일떄 대기,진행은 미완목록 2,3은 완료목록으로
    if($_REQUEST["ma_step"] == 1){
        $sql_search .= "and ( ma_step = '0' or ma_step = '1' )";
    }else{
        $sql_search .= "and ( ma_step = '2' or ma_step = '3' )";
    }

    if ($ma_step)
        $qstr .= '&amp;ma_step=' . urlencode($ma_step);
}


//진행사항 필터 완료된것만
$sql_search .= "and ( cw_step = '2' or cw_step = '1')";
if($cw_step)
    $qstr .= '&amp;cw_step=' . urlencode($cw_step);


//상품명
if ($_REQUEST["car_date_type"] != ""){
    $sql_search .= "and car_date_type = '{$_REQUEST["car_date_type"]}'";
    if ($car_date_type)
        $qstr .= '&amp;car_date_type=' . urlencode($car_date_type);

    if($_GET['car_date_type'] == "3") {
        $sql_search .= " and is_payment = 'Y' ";
    }
}

//차 사이즈 필터
if ($_REQUEST["car_size"] != ""){
    $sql_search .= "and car_size = '{$_REQUEST["car_size"]}'";
    if ($car_size)
        $qstr .= '&amp;car_size=' . urlencode($car_size);
}

//날짜 오름차순 내림차순
if ($_REQUEST["complete_datetime"] != ""){
    $sql_order .= " order by complete_datetime {$_REQUEST["complete_datetime"]}";
    if ($complete_datetime)
        $qstr .= '&amp;complete_datetime=' . urlencode($complete_datetime);
}else{
    $sql_order .= " order by complete_datetime desc";
}

//끝
$sql = " select sum(ma_payment) as total_payment {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_payment = $row['total_payment'];

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = ' <a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall"><button style="border: 1px solid #ccc">전체목록</button></a>';


$sql = " select cw.* {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;




?>
<style>
    body{
        overflow: hidden;
    }
</style>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get" style="display: none">
    <label for="sfl" class="sound_only">검색대상</label>

    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <span id="stx_span" style="display: inline"><input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class=" frm_input"></span>


    <input type="submit" class="btn_submit" value="검색">

    <input type ="hidden" id="sst" name="sst" value="">
    <input type ="hidden" id="sod" name="sod" value="">

    <input type ="hidden" id="cw_step" name="cw_step" value="<?= $_REQUEST['cw_step']?>" >
    <input type ="hidden" id="ma_step" name="ma_step" value="<?= $_REQUEST['ma_step']?>" >
    <input type ="hidden" id="car_date_type" name="car_date_type" value="<?= $_REQUEST['car_date_type']?>" >
    <input type ="hidden" id="car_size" name="car_size" value="<?= $_REQUEST['car_size']?>" >
    <input type ="hidden" id="complete_datetime" name="complete_datetime" value="<?= $_REQUEST['complete_datetime']?>" >


</form>

<div id="my_reser">
    
	<!--상단카테고리-->
    <ul class="cate cf cateFlex">
        <li <?=($_REQUEST['car_date_type'] == 3 || $_REQUEST['car_date_type'] == '') ?  'class="active"' : '';?>><a href="<?=G5_BBS_URL?>/my_money.php?car_date_type=3&ma_step=<?= $_REQUEST['ma_step']?>">외부세차 1회</a></li>
        <li <?=($_REQUEST['car_date_type'] == 5) ?  'class="active"' : '';?>><a href="<?=G5_BBS_URL?>/my_money.php?car_date_type=5&ma_step=<?= $_REQUEST['ma_step']?>">실내세차 1회</a></li>
        <li <?=($_REQUEST['car_date_type'] == 4) ?  'class="active"' : '';?>><a href="<?=G5_BBS_URL?>/my_money.php?car_date_type=4&ma_step=<?= $_REQUEST['ma_step']?>">기업세차</a></li>
        <li <?=($_REQUEST['car_date_type'] == 1) ?  'class="active"' : '';?>><a href="<?=G5_BBS_URL?>/my_money.php?car_date_type=1&ma_step=<?= $_REQUEST['ma_step']?>">정기세차 맛보기</a></li>
        <li <?=($_REQUEST['car_date_type'] == 2) ?  'class="active"' : '';?>><a href="<?=G5_BBS_URL?>/my_money.php?car_date_type=2&ma_step=<?= $_REQUEST['ma_step']?>">정기세차</a></li>
    </ul>

    
    <ul class="filter">
        <li <?=($_REQUEST['ma_step'] == 2 || $_REQUEST['ma_step'] == '') ?  'class="active"' : '';?>><a onclick="sst_change2(2,'ma_step')">정산완료</a></li>
        <li <?=($_REQUEST['ma_step'] == 1) ?  'class="active"' : '';?>><a onclick="sst_change2(1,'ma_step')">미완료</a></li>
    </ul>

    <!--내용부분--> 
    <div class="in">
        <p>총 건수 : <?=$total_count?></p>
        <p>총 정산금액 : <?=number_format($total_payment)?></p>
        <div class='cslist'>

            <?php
            $list_rows = $config['cf_page_rows'];
            $list_no = $total_count - ($list_rows * ($page - 1));
            for ($i=0; $row=sql_fetch_array($result); $i++) {
                $s_mod = '<a href="./adm_service_form.php?'.$qstr.'&amp;w=u&amp;re_url=adm_service_manager_list&amp;idx='.$row['cw_idx'].'">보기/수정</a>';
                $bg = 'bg'.($i%2);
                //mb_work 콤마단위로 끊어서 배열로 만들어줌.
                $mb_work_arr = explode(',', $row['mb_work'] );
                $manage_mb = get_member($row['ma_id']);
                ?>

                <div class='bx'>
                    <h2 class='tit'>
                        <?= $cdt_list[$row["car_date_type"]]?>
                        <strong class="size"><?= $cs_list[$row["car_size"]] ?></strong>
                    </h2>
                    <div class="tx">
                        <dl class="tx_m" <?=$_REQUEST['complete_datetime'] == 'asc' ? 'onclick="sst_change2(\'desc\',\'complete_datetime\')"' : 'onclick="sst_change2(\'asc\',\'complete_datetime\')"' ?>>
                            <dt>작업날짜</dt>
                            <dd><?=$row['complete_datetime']?></dd>
                        </dl>
                        <dl class="tx_m">
                            <dt>신청고객</dt>
                            <dd><?=$row['mb_name']?></dd>
                        </dl>
                        <!--
                        <dl class="tx_m">
                            <dt>차량정보</dt>
                            <dd><?= $row['car_no'] ?> / <?= $row['car_type'] ?> / <?= $row['car_color'] ?></dd>
                        </dl>
                        -->
                        <?php if($row['complete_cnt']){ ?>
                        <dl class="tx_m">
                            <dt>작업횟수</dt>
                            <dd><?=$row['complete_cnt']?></dd>
                        </dl>
                        <?php } ?>
                        
                        <dl class="tx_m">
                            <dt>예상금액</dt>
                            <?php if($row['complete_cnt']==0){ $row['complete_cnt'] = 1;} ?>
                            <dd><?= number_format($row['complete_cnt']*$ma_money_list[$row["car_date_type"]]) ?>
                                <?= $row["cp_id"] ? '<i class="fa-solid fa-ticket"></i>' : '' ?>
                            </dd>
                        </dl>

                        <dl class="tx_m">
                            <dt>정산금액</dt>
                            <dd>
                                <?= number_format($row['ma_payment'] * 1) ?>
                            </dd>
                        </dl>


                        <?php if(substr($row['ma_payment_datetime'],2,8) != '00-00-00'){ ?>
                            <dl class="tx_m">
                                <dt>정산일</dt>
                                <dd><?= substr($row['ma_payment_datetime'],2,8) != '00-00-00' ? substr($row['ma_payment_datetime'],2,8) : '' ?></dd>
                            </dl>
                        <?php } ?>

                    </div>
                    <div class="mini_btn cf">
                        <a href="<?php echo G5_BBS_URL ?>/my_money_view.php?<?php echo $qstr.'&amp;idx='.$row['cw_idx']?>"    style="width: 100%;" class="bt view a2">자세히보기</a>
                    </div>
                </div>

                <?php
                $list_no--;
            }
            if ($i == 0){ ?>
                <div class="service_none"><span><i class="fas fa-smile"></i></span>정산내역이 없습니다.</div>
            <?php } ?>
        </div>

        <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr."&nr=".$_REQUEST['nr'].'&amp;page='); ?>
    </div><!--in-->
</div><!--my_reser-->

<!-- 완료된서비스 -->
<script>
    $(document).ready(function() {
    });

    function sst_change2(val,sst){
        $("#"+ sst).val(val);
        $("#fsearch").submit();
    }


</script>