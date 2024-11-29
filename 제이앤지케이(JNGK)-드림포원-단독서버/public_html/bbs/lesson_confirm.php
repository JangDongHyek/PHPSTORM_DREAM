<?php
include_once('./_common.php');

$g5['title'] = '나의 레슨예약';
include_once('./_head.php');

// -- 검색
$sql_search = '';
if(!empty($_GET['search_name'])) {
    $sql_search .= " and (le.lesson_name like '%{$_GET['search_name']}%' or mb.mb_charge_pro like '%{$_GET['search_name']}%') ";
}
if(!empty($_GET['search_st_date'])) {
    $start_date = str_replace('-','.',$_GET['search_st_date']);
    $sql_search .= " and (re.reser_date >= '{$start_date}') ";
}
if(!empty($_GET['search_ed_date'])) {
    $end_date = str_replace('-','.',$_GET['search_ed_date']);
    $sql_search .= " and (re.reser_date <= '{$end_date}') ";
}
if(!empty($_GET['search_state'])) {
    $sql_search .= " and re.reser_state = '{$_GET['search_state']}' ";
}
// -- 검색

$sql = " select count(*) as cnt 
         from g5_lesson_reser as re 
         left join g5_member as mb on mb.mb_no = re.mb_no 
         left join g5_lesson le on le.lesson_code = mb.lesson_code and le.center_code = mb.center_code
         where re.mb_no = {$member['mb_no']} {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

//$rows = $config['cf_page_rows'];
$rows = 8;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select re.*, mb.mb_charge_pro, lesson_name, lesson_count
         from g5_lesson_reser as re
         left join g5_member mb on mb.mb_no = re.mb_no
         left join g5_lesson le on le.lesson_code = mb.lesson_code and le.center_code = mb.center_code
         where re.mb_no = {$member['mb_no']} {$sql_search} 
         order by re.reser_date desc, re.reser_time desc
         limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);
?>

<link rel="stylesheet" href="<?= G5_CSS_URL ?>/style.css">

<style>
#less_search_top{ background:#f3d421; padding:10px 10px; font-size:13px; height:45px;}
#hd_sch_open{ position:absolute; top:0px; right:0px; border:0; background:#d1b516; color:#fff; font-size:1.5em; width:45px; height:45px; text-align:center;}
#sch_close{ position:absolute; top:0px; right:0px; border:0; background:#d1b516; color:#fff; font-size:1.5em; width:45px; height:45px; text-align:center;}
.hd_div{ display:none;}

#less_search{ background:#f3d421; padding:10px 10px;}	
.le_sea01{ margin-bottom:5px;}
.le_sea01:after{ display:block; content:""; clear:both;}
.le_sea01 .input_search{ float:left; border:0; background:#fff; border-radius:5px 0 0 5px; padding:0 10px; height:33px; width:calc(100% - 37px);}
#less_search .btn_search{ float:left; font-family:"Font Awesome 5 Pro"; font-size:1.1em; border:0; width:37px; height:33px; background:#fff; border-radius:0 5px 5px 0;}

.le_sea02{ margin-bottom:5px;}
.le_sea02:after{ display:block; content:""; clear:both;}
.le_sea02 .input_search2{ float:left; border:0; background:#fff; border-radius:5px; padding:0 10px; width:calc(50% - 28px); height:33px; display:inline-block;}
.le_sea02 p{ float:left;text-align:center; width:15px; line-height:33px;}
#less_search .btn_search2{ font-family:"Font Awesome 5 Pro"; font-size:1.1em; border:0; width:37px; height:33px; background:#444; border-radius:5px; color:#fff;}
.le_sea02 .btn_search2{ float:left; margin-left:3px;}

.le_sea03:after{ display:block; content:""; clear:both;}
.le_sea03 .le_sea03_t{ float:left; font-size:1em; line-height:33px; font-weight:bold; color:#222; width:80px; background:#d1b516; border-radius:5px; text-align:center;}
.le_sea03 .le_sea03_c{ float:left; width:calc(100% - 85px); margin-left:5px;}
.le_sea03 .le_sea03_c:after{ display:block; content:""; clear:both;}
.le_sea03 .select_search{ float:left; height:33px; border:0; background-image:url(../img/select_arrow.gif); background-repeat:no-repeat; background-position:95% center;background-size:10px auto; width:calc(100% - 40px); margin-right:3px;}
.le_sea03 .btn_search2{ float:left;}
</style>

<div id="less_lbox">
    <div id="less_search_top"><p>원하는 날짜/레슨명/예약상태를 검색할 수 있습니다.</p></div>
    <button type="button" id="hd_sch_open" class="hd_opener"><i class="fal fa-search"></i><span class="sound_only">열기</span>
    </button>

    <div id="hd_sch" class="hd_div">

        <form method="get">
            <!--검색영역 시작-->
            <div id="less_search">
                <div class="le_sea01">
                    <input type="text" name="search_name" id="search_name" placeholder="레슨명, 프로명을 입력하세요" class="input_search"/>
                    <!--<input type="submit" value="&#xf002" class="btn_search"/>-->
                </div> <!--.le_sea01-->

                <div class="le_sea02">
                    <input type="date" name="search_st_date" id="search_st_date" class="input_date input_search2"/>
                    <p>~</p>
                    <input type="date" name="search_ed_date" id="search_ed_date" class="input_date input_search2"/>
                    <!--<input type="submit" value="&#xf002" class="btn_search2"/>-->
                </div> <!--.le_sea02-->

                <div class="le_sea03">
                    <div class="le_sea03_t">예약상태</div>
                    <div class="le_sea03_c">
                        <select class="select_basic select_search" id="search_state" name="search_state">
                            <option value="">전체</option>
                            <option value="예약완료">예약완료</option>
                            <option value="예약취소">예약취소</option>
                            <option value="노쇼">노쇼</option>
                            <option value="예약대기">예약대기</option>
                        </select>
                        <input type="submit" value="&#xf002" class="btn_search2"/>
                    </div>
                </div> <!--.le_sea03-->
            </div><!--#less_search-->
            <!--검색영역 끝-->
            <button type="button" id="sch_close" class="hd_closer"><i class="fal fa-times"></i><span class="sound_only">닫기</span></button>
        </form>

    </div>

    <script>
        $(function () {
            $(".hd_opener").on("click", function () {
                var $this = $(this);
                var $hd_layer = $this.next(".hd_div");

                if ($hd_layer.is(":visible")) {
                    $hd_layer.hide();
                    $this.find("span").text("열기");
                } else {
                    var $hd_layer2 = $(".hd_div:visible");
                    $hd_layer2.prev(".hd_opener").find("span").text("열기");
                    $hd_layer2.hide();

                    $hd_layer.show();
                    $this.find("span").text("닫기");
                }
            });

            $(".hd_closer").on("click", function () {
                var idx = $(".hd_closer").index($(this));
                $(".hd_div:visible").hide();
                $(".hd_opener:eq(" + idx + ")").find("span").text("열기");
            });
        });
    </script>
</div>
<!-- 모바일 장바구니/검색버튼 끝{ -->


<!--리스트-->
<div class="less_list">
<?php
for($i=0; $row=sql_fetch_array($result); $i++) {
    $state_class = "";
    if($row['reser_state'] == '예약완료') { $state_class = "btn_less_ok"; }
    else if($row['reser_state'] == '예약대기') { $state_class = "btn_less_wait"; }
    else if($row['reser_state'] == '예약취소') { $state_class = "btn_less_no"; }
    else { $state_class = "btn_less_no"; }
?>
<div class="less_lbox">
    <div class="less_tit"><?=$row['lesson_name']?> <?=$row['lesson_count']?>
        <div class="less_pro"><?=$row['mb_charge_pro']?> 프로</div>
    </div>
    <div class="less_info">
        <p>예약일 <span><?=$row['reser_date']?></span></p>
        <p>예약시간 <span><?=$row['reser_time']?></span></p>
    </div><!--.less_info-->
    <div class="btn_less <?=$state_class?>"><?=$row['reser_state']?></div>
</div><!--.less_lbox-->
<?php
}
?>
</div>

<!--게시물페이징-->
<div id="paging">
    <div class="page_box">
        <ul>
        <?php echo get_paging_mod(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;mb_no='.$mb_no.'&amp;page='); ?>
        </ul>
        <!--<ul>
            <li><span><a><i class="fal fa-angle-double-left"></i></a></span></li>
            <li><span class="page_now"><a>1</a></span></li>
            <li><span><a>2</a></span></li>
            <li><span><a>3</a></span></li>
            <li><span><a><i class="fal fa-angle-double-right"></i></a></span></li>
        </ul>-->
    </div><!--.page_box-->
</div><!--#paging-->
</div><!--#less_lbox-->

<!--레슨정보가 없을경우-->
<?php /*?> <?php if ($count == 0) { ?>
    <div class="no_les_list">
        <i class="fal fa-comments"></i> 레슨예약 정보가 없습니다.
    </div>
<?php } ?><?php */?>


<script>
    function lesson_search() {
        $.ajax({
            url : g5_bbs_url + "/ajax.lesson_search.php",
            data: { name : $('#search_name').val(), st_date : $('#search_st_date').val(), ed_date : $('#search_ed_date').val(), state : $('#search_state').val() },
            type: 'POST',
            success : function(data) {
                if(data){
                    location.replace(g5_bbs_url+'/lesson_confirm.php');
                    $('.less_list').html(data);
                }
            },
        });
    }
</script>

<?php
include_once('./_tail.php');
?>