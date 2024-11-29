<?php
$sub_menu = "210100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

/** 팀장 - 프로관리 ==> 레슨현황 **/

$mb_no = $_GET['mb_no'];

$mb = get_member_no($mb_no);

$lesson_info = sql_fetch(" select * from g5_lesson where lesson_code = '{$mb['lesson_code']}' ");

$sql_search = '';
if (!empty($_GET['start_date'])) {
    //$start_date = str_replace('-', '.', $_GET['start_date']);
    $sql_search .= " and (date_format(ld.lesson_date, '%Y-%m-%d') >= '{$start_date}') ";
}
if (!empty($_GET['end_date'])) {
    //$end_date = str_replace('-', '.', $_GET['end_date']);
    $sql_search .= " and (date_format(ld.lesson_date, '%Y-%m-%d') <= '{$end_date}') ";
}

$today = date('Y.m.d');
$year = date('Y');
$month = date('m');

$sql_search2 = '';
if(empty($_GET['start_date']) && empty($_GET['end_date'])) {
    $sql_search2 .= " and ld.lesson_date like '{$year}.{$month}%' ";
}

$sql = " select 
         count(*) as cnt
         from g5_lesson_diary as ld
         left join g5_member as mb on mb.mb_no = ld.mb_no 
         where ld.pro_mb_no = '{$mb_no}' {$sql_search} {$sql_search2} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

//$rows = $config['cf_page_rows'];
$rows = 15;
$total_page = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 레슨일지정보
$sql = " select 
         ld.*, mb.mb_name, mb.mb_id_no
         from g5_lesson_diary as ld
         left join g5_member as mb on mb.mb_no = ld.mb_no 
         where ld.pro_mb_no = '{$mb_no}' {$sql_search} {$sql_search2}
         order by ld.idx desc limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);

$listall = '<a href="' . $_SERVER['SCRIPT_NAME'] . '?mb_no=' . $mb_no . '" class="ov_listall">전체목록</a>';

$last_day = date('t', strtotime(date('Y-m'))); // 월의 마지막 일자

$colspan = 7;

// 총 레슨건 -- 총 예약건으로 판한
$sql = " select count(*) as reser_total_count 
         from g5_lesson_reser as re 
         left join g5_member as mb on mb.mb_no = re.mb_no 
         where re.pro_mb_no = '{$mb_no}' and re.reser_date like '{$year}.{$month}%' and (re.reser_state = '예약완료' || re.reser_state = '노쇼') ";
$reser_total_count = sql_fetch($sql)['reser_total_count'];

// 오늘 레슨
$sql = " select count(*) as today_reser_count from g5_lesson_reser as re 
         left join g5_member as mb on mb.mb_no = re.mb_no
         where lr.pro_mb_no = '{$mb_no}' and re.reser_date = date_format(curdate(), '%Y.%m.%d') and re.reser_date like '{$year}.{$month}%' and (re.reser_state = '예약완료' || re.reser_state = '노쇼') ";
$today_reser_count = sql_fetch($sql)['today_reser_count'];

// 레슨 취소
$sql = " select count(*) as reser_cancel_count from g5_lesson_reser as re 
         left join g5_member as mb on mb.mb_no = re.mb_no
         where re.pro_mb_no = '{$mb_no}' and re.reser_state = '예약취소' and re.reser_date like '{$year}.{$month}%' ";
$reser_cancel_count = sql_fetch($sql)['reser_cancel_count'];

// 레슨 완료 -- reser_idx가 있으면 레슨 완료로 판단
$sql = " select count(*) as reser_ok_count 
         from g5_lesson_diary as ld
         left join g5_member as mb on mb.mb_no = ld.mb_no
         where ld.pro_mb_no = '{$mb_no}' and ld.lesson_date like '{$year}.{$month}%' and ld.reser_idx is not null ";

$reser_ok_count = sql_fetch($sql)['reser_ok_count'];

$g5['title'] .= $mb['mb_category'] . '관리';
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
?>

<style>
.btn_adm_pro_ok {
    display: inline-block;
    line-height: 35px;
    background: #f3d421;
    color: #333;
    font-size: 1.2em;
    font-weight: 600;
    border: 1px solid #f3d421;
    width: 100px;
    margin: 0 5px;
    text-align: center;
    border-radius: 30px;
}

#lere_modal .modal-content .close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 40px;
    opacity: 1;
    text-shadow: 0;
    z-index: 10;
}
</style>

<!--동영상재생모달 시작-->
<div id="lere_modal">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="video_stop();"><span aria-hidden="true">&times;</span></button>
                <div class="modal-body">
                </div>
            </div><!--.modal-body-->
        </div>
    </div>
</div><!--#lere_modal2-->
<!--동영상재생모달 끝-->

<div id="tab_box">
    <ul class="tab">
        <li class="" id="tab0"><a href="javascript:void(0);" onclick="tabClick('pro_view_member.php');">유효회원</a></li>
        <li class="current" id="tab1"><a href="javascript:void(0);">레슨현황</a></li>
        <li class="" id="tab2"><a href="javascript:void(0);" onclick="tabClick('pro_view_tab2.php');">스케줄관리</a></li>
        <!--<li class="" id="tab3"><a href="javascript:void(0);" onclick="tabClick('pro_view_tab3.php');">휴무관리</a></li>-->
        <li class="" id="tab3"><a href="javascript:void(0);" onclick="tabClick('pro_view_atta.php');">근태관리</a></li>
        <!--<li class="" id="tab4"><a href="javascript:void(0);" onclick="tabClick('pro_view_tab5.php');">신규/재등록 현황</a></li>-->
        <li class="" id="tab5"><a href="javascript:void(0);" onclick="tabClick('pro_view_sales.php');">매출관리</a></li>
    </ul>
</div><!--#tab_box-->

<!--프로 프로필영역 시작//-->
<div class="adm_pro_info">
    <div class="apro_img">
        <?
        $sql = " select * from g5_member_img where mb_no = '{$mb['mb_no']}' ";
        $file = sql_fetch($sql);

        if (!empty($file['img_file'])) {
            ?>
            <img src="<?= G5_DATA_URL ?>/file/member/<?= $file['img_file'] ?>">
            <?
        } else {
            ?>
            <img src="<?php echo G5_ADMIN_URL; ?>/img/mem_noimg.gif"/>
            <?php
        }
        ?>
    </div><!--.apro_img-->
    <div class="apro_name">
        <?php /*?><span style="font-weight: bold;margin-right: 10px;"><?=$mb_state?></span>
        <span><?=$mb['mb_id_no']?></span> <?php */ ?>
        <?= $mb['mb_name'] ?> <span><?= $mb['mb_category'] ?></span>
    </div><!--.apro_name-->
    <div style="text-align: center;">
        <input type="button" class="btn_adm_pro_ok" value="정보수정" onclick="location.href='<?=G5_ADMIN_URL?>/pro_form.php?w=u&mb_no=<?=$mb_no?>'">
    </div>
</div><!--.adm_pro_info-->
<!--//프로 프로필영역 끝-->


<!--레슨현황 시작//-->
<!--레슨현황-->
<div id="les_state">
    <div class="lre_list_tit">레슨현황</div><!--.lre_list_tit-->
    <div class="les_sdate">기간 : <?=date('Y-m').'-'.'01'?> ~ <?=date('Y-m').'-'.$last_day?></div>
    <div class="les_sbox">
        <ul>
            <li><p>총 레슨건</p><span><?=$reser_total_count?></span></li>
            <li class="lsg"><p>레슨 취소</p><span><?=$reser_cancel_count?></span></li>
            <li class="lsg"><p>레슨 완료</p><span><?=$reser_ok_count?></span></li>
            <li class="lsb">
                <div class="lsb_d"><?=date('Y.m.d')?></div>
                <div class="lsb_today">오늘레슨 <strong><?=$today_reser_count?></strong></div>
            </li>
        </ul>
    </div><!--.les_sbox-->
</div><!--#les_state-->


<div id="lesson_reslist">
    <div class="lre_list_tit">레슨내역
    </div><!--.lre_list_tit-->
    <p>총 <?php echo number_format($total_count) ?> 건 / <?= $listall ?></p>

    <!--기간검색-->
    <form id="fsearch" name="fsearch" method="get">
        <input type="hidden" id="mb_no" name="mb_no" value="<?= $mb_no ?>">
        <div class="lre_ldate">
            <input type="date" name="start_date" value="<?= $_GET['start_date'] ?>" class="input_ldate"/> ~ <input type="date" name="end_date" value="<?= $_GET['end_date'] ?>" class="input_ldate"/>
            <input type="submit" class="btn_ldate" value="검색">
        </div><!--.lre_ldate-->
    </form>

    <!--예약자 리스트 테이블-->
    <form action="ajax.approval_state_change.php" method="post">
        <div class="tbl_head02 tbl_wrap mb_tbl">
            <table>
                <caption><?php echo $g5['title']; ?> 목록</caption>
                <colgroup>
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="*">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                <tr>
                    <th>No.</th>
                    <th>레슨일</th>
                    <th>회원명</th>
                    <th>레슨내용</th>
                    <th>회차</th>
                    <th>동영상</th>
                    <th>레슨진행상황</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $k = $total_count - ($rows * ($page - 1));
                for ($i = 0; $row = sql_fetch_array($result); $i++) {
                    $video_sql = " select * from g5_lesson_video where diary_idx = '{$row['idx']}' ";
                    $video = sql_fetch($video_sql);
                    $video_src = '';
                    if($video['img_file'] && file_exists(G5_DATA_PATH . '/file/lesson/' . $video['img_file'])) {
                        $video_src = G5_DATA_URL . '/file/lesson/' . $video['img_file'];
                    }
                ?>
                    <tr>
                        <td><?= $k ?></td>
                        <td><?= $row['lesson_date']?></td>
                        <td><?= $row['mb_name']?></td>
                        <td><?= $row['lesson_contents']?></td>
                        <td><?= $row['lesson_count']?>회차</td>
                        <td><?php if($video['img_file'] && file_exists(G5_DATA_PATH . '/file/lesson/' . $video['img_file'])) { ?><a onclick="video_play('<?=$row['idx']?>', '<?=$video_src?>');"><i class="fas fa-play-circle" style="font-size: 1.5em;"></i></a><?php } ?></td>
                        <td>완료</td>
                    </tr>
                <?php
                    $k--;
                }
                if($i == 0)
                    echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
                ?>
                </tbody>
            </table>
        </div>

        <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?' . $qstr . '&amp;mb_no=' . $mb_no ."&start_date=".$_REQUEST['start_date']."&end_date=".$_REQUEST['end_date'].'&amp;page='); ?>
    </form>

</div><!--#lesson_reslist-->

<!--<div class="tbl_frm03">
        <table>
        <caption><?php /*echo $g5['title']; */ ?></caption>
        <colgroup>
            <col class="grid_5">
            <col>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th scope="row"><label for="mb_hp">휴대전화<?php /*echo $sound_only */ ?></label></th>
            <td><? /*=$mb['mb_hp']*/ ?></td>
        </tr>
        <tr>
            <th scope="row"><label for="mb_addr">주소<?php /*echo $sound_only */ ?></label></th>
            <td><? /*=$mb['mb_addr1']*/ ?> <? /*=$mb['mb_addr2']*/ ?></td>
        </tr>
        <tr>
            <th scope="row"><label for="mb_email">이메일<?php /*echo $sound_only */ ?></label></th>
            <td><? /*=$mb['mb_email']*/ ?></td>
        </tr>
        <tr>
            <th scope="row"><label for="mb_birth">생년월일<strong class="sound_only">필수</strong></label></th>
            <td><? /*=$mb['mb_birth']*/ ?></td>
        </tr>
        <tr>
            <th scope="row"><label for="mb_center">센터/아카데미<?php /*echo $sound_only */ ?></label></th>
            <td><? /*=$mb['mb_center']*/ ?></td>
        </tr>
        <?php /*if($mb['mb_category'] == '회원') { */ ?>
        <tr>
            <th scope="row"><label for="mb_charge_pro">담당프로<?php /*echo $sound_only */ ?></label></th>
            <td><? /*=$mb['mb_charge_pro']*/ ?></td>
        </tr>
        <?php /*} */ ?>
        <tr>
            <th scope="row"><label for="mb_id">아이디<?php /*echo $sound_only */ ?></label></th>
            <td><? /*=$mb['mb_id']*/ ?></td>
        </tr>
        <tr>
            <th scope="row"><label for="mb_reg_date">등록일자<?php /*echo $sound_only */ ?></label></th>
            <td><? /*=$mb['mb_reg_date']*/ ?></td>
        </tr>
        <?php /*if($mb['mb_category'] == '회원') { */ ?>
        <tr>
            <th scope="row"><label for="mb_wish">가장 개선하고 싶은 부분이나<br>담당 프로에게 바라는 점<strong class="sound_only">필수</strong></label></th>
            <td><? /*=$mb['mb_wish']*/ ?></td>
        </tr>
        <?php /*} */ ?>
        </tbody>
        </table>
    </div>-->

<div class="adm_mw_btn">
    <a href="<?= G5_ADMIN_URL ?>/pro_list.php" class="btn_adm_cancel">목록</a>
</div>
<!--//레슨현황 끝-->


<script>
    function tabClick(tab) {
        if (tab == 'pro_view_tab5.php') {
            alert('준비중입니다.');
            return false;
        }

        var lv = '';
        if(tab == 'pro_view_sales.php') {
            lv = '&lv=당일매출';
        }
        location.replace(g5_admin_url + '/' + tab + '?mb_no=<?=$mb_no?>'+lv);
    }

    // 동영상 재생 (레슨일지idx, 동영상경로)
    function video_play(idx, video) {
        $('#myModal').modal('show');
        $('#myModal .modal-body').html('<video id="videoPlay" width="100%" height="500" autoplay controls src="'+video+'"></video>');
        $('#videoPlay')[0].play();
    }

    $('#myModal').on('hide.bs.modal', function(e){
        $('#videoPlay')[0].pause();
        // e.stopImmediatePropagation();
    });

    function video_stop() {
        $('#videoPlay')[0].pause();
    }
</script>

<?php
include_once('./admin.tail.php');
?>
