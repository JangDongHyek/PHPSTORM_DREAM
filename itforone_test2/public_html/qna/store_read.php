<?php
include_once("./_head.php");

$srl_no = $_GET['srl_no'];

$now_date = date("Y-m-d", time());
$now_time = date("H:i", time());

$sql = "SELECT * FROM store_receipt_list WHERE srl_no = '$srl_no' ";
$rs = sql_fetch($sql);

$sql_common = " FROM store_history WHERE (1) AND srl_no = '$srl_no' ";

// 페이징 123
$sql = " SELECT COUNT(*) AS cnt {$sql_common}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$list_rows = 10;											// 한페이지 글 개수
$total_page  = ceil($total_count / $list_rows);				// 전체페이지
if ((int)$page > $total_page) $page = $total_page;

if ($page < 1) $page = 1;
$from_record = ($page - 1) * $list_rows;					// 시작 열
$sql_limit = " LIMIT {$from_record}, {$list_rows}";			// 리스트 sql에 limit 추가

$list_page_rows = 10;										// 한블록 개수
$list_no = $total_count - ($list_rows * ($page - 1));		// 글번호(내림차순)
// $list_no = 1 + ($list_rows * ($page - 1));				// 글번호(오름차순)

$sql_orderby = "ORDER BY sh_reg_date DESC";

// 리스트
$sql = "SELECT *
		{$sql_common} {$sql_orderby} {$sql_limit}";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);


?>
    <!--datepicker-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

    <!--timepicker-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

    <script src="./js/store_datepicker.js?ver=<?=JS_VER_NUM?>"></script>
    <script src="./js/store_timepicker.js?ver=<?=JS_VER_NUM?>"></script>



    <link href="./css/store_read.css?ver=<?=CSS_VER_NUM?>" rel="stylesheet">
    <script src="./js/store_read.js?ver=<?=JS_VER_NUM?>"></script>

    <h1>스토어 등록 상세정보</h1>

    <div class="view_tbl">
        <input type="hidden" id="start_time" value="<?=substr($rs['srl_reg_time'],0,5)?>"/>
        <ul>
            <li class="half">
                <em>No.</em>
                <span>아이티포원</span>
            </li>
            <li class="half">
                <em>업체명</em>
                <span><?=$rs['srl_comp_name']?></span>
            </li>
            <li class="half">
                <em>신청일</em>
                <span><?=substr($rs['srl_reg_date'],0,10)?></span>
            </li>
            <li class="half">
                <em>신청시간</em>
                <span><?=substr($rs['srl_reg_time'],0,5)?></span>
            </li>
            <li class="half">
                <em>구분</em>
                <span><?=$rs['srl_class']?></span>
            </li>
            <li class="half">
                <em>상태</em>
                <span><?=$rs['srl_state']?></span>
            </li>
            <li class="half">
                <em>스토어계정</em>
                <span><?=$rs['srl_account_class']?></span>
            </li>
            <li class="full" style="height:45px;">
                <em>완료일</em>
                <span><?=$rs['srl_complete_date']==null ? "" : substr($rs['srl_complete_date'],0,10) ?></span>
            </li>
        </ul>
    </div>


    <div class="cont" style="margin-top:30px;">
        <h3>등록 내용</h3>
        <div class="hig210"><?=nl2br($rs['srl_content'])?></div>
    </div>

    <div class="btn_box">
        <button type="button" class="btn_style blue" onclick="move_link('./store_write.php?srl_no=<?=$srl_no?>');">수정</button>
        <button type="button" class="btn_style red" onclick="delete_link('<?=$srl_no?>','./proc/query.php');">삭제</button>
        <button type="button" class="btn_style black" onclick="move_link('./store_list.php');" >목록</button>
    </div>

    <!-- 히스토리 내역 -->
    <div class="history_li">
        <dl class="reply_area list_tbl">
            <dt class="pd10">히스토리 내역<button type="button" class="btn_pos his_btn_style green" onclick="history_on(1);" >작성</button></dt>
            <dt>
                <div class="wid5">No.</div>
                <div class="wid10">날짜</div>
                <div class="wid60">내용</div>
                <div class="wid25">기타</div>
            </dt>

            <div class="">
            <?
            if($result_cnt==0){
                echo '<dd align="center" style="padding:10px;">등록된 글이 없습니다.</dd>';
            }else{

            for($i=0;$row=sql_fetch_array($result);$i++){
                $sh_no = $row['sh_no'];
                ?>
                <dd>
                    <div class="wid5"><?=number_format($list_no)?></div>
                    <div class="wid10"><?=substr($row['sh_reg_date'],0,10)?></div>
                    <div class="wid60"><textarea class="text_auto_hig" readonly><?=$row['sh_content']?></textarea></div>
                    <div class="wid25">
                        <button type="button" onclick="history_update('<?=$sh_no?>');"  class="his_btn_style blue mg0" >수정</button>
                        <button type="button" onclick="history_delete('<?=$sh_no?>');" class="his_btn_style red mg0" >삭제</button>
                    </div>
                </dd>
            <? $list_no--;}} ?>
            </div>

            <!-- 페이징 -->
            <nav class="pg_wrap">
                <span class="pg">
                    <?php
                    $page_num = ceil($total_count / $list_rows);	// 총페이지
                    $block_num = ceil($page_num / $list_page_rows);	// 총블럭
                    $now_block = ceil($page / $list_page_rows);

                    $s_page = ($now_block * $list_page_rows) - ($list_page_rows - 1);	// 시작블록
                    if ($s_page <= 1) $s_page = 1;
                    $e_page = ($now_block * $list_page_rows);
                    if ($page_num <= $e_page) $e_page = $page_num;						// 끝블록
                    ?>
                    <?php if ($now_block > 1) { ?>
                        <a href="?page=1&srl_no=<?=$srl_no?>" class="pg_page pg_start">처음</a>
                    <?php } ?>
                    <?php
                    for ($p=$s_page; $p<=$e_page; $p++) {
                        if ($page != $p) echo '<a href="?page='.$p.'&srl_no='.$srl_no.'" class="pg_page">'.$p.'</a>';
                        else echo '<span class="sound_only">열린</span><strong class="pg_current">'.$p.'</strong>';
                    }
                    ?>
                    <?php if ($block_num > 1 && $block_num != $now_block) { ?>
                        <a href="?page=<?=$e_page+1?>&srl_no=<?=$srl_no?>" class="pg_page pg_end">맨끝</a>
                    <?php } ?>
                </span>
            </nav>

        </dl>
    </div>

    <!--  입력폼  -->
    <div id="history_frm" >
        <form action="./proc/query.php" method="post" id="history_wr_frm">
            <input type="hidden" name="val" value="history_insert" />
            <input type="hidden" name="srl_no" value="<?=$srl_no?>" />
            <input type="hidden" name="sh_no" value="" />
            <dl class="reply_area list_tbl">
                <dt id="text_update" class="pd10">히스토리 작성</dt>
                <dt>
                    <div class="wid15">날짜</div>
                    <div class="wid15">시간</div>
                    <div class="wid60">내용</div>
<!--                    <div class="wid15">기타</div>-->
                </dt>

                <dd>
                    <div class="wid15" id="wr_date"><input class="his_date_input date_picker" type="text" name="sh_reg_date" value="<?=$now_date?>" /></div>
                    <div class="wid15" id="wr_time"><input class="his_date_input " type="time" name="sh_reg_time" value="<?=$now_time?>" /></div>
                    <div class="wid60">
                        <textarea name="sh_content" id="reset_textarea" ></textarea>
                    </div>
                    <div class="wid25">
                        <button type="submit" class="his_btn_style blue mg0"  >완료</button>
                        <button type="button" class="his_btn_style red mg0" onclick="history_on(2);" >취소</button>
                    </div>
                </dd>
            </dl>
        </form>
    </div>



<?
include_once("./_tail.php");

?>
