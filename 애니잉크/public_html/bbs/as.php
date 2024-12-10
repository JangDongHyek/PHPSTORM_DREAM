<?
include_once("./_common.php");
include_once(G5_PATH."/jl/JlConfig.php");

$g5_write_new = new JlModel(array("table" => "g5_write_new"));

$check_date = $_GET['check_date'] ? $_GET['check_date'] : 1;
$wr_id = $_GET['wr_id'] ? $_GET['wr_id'] : 99999;
$page = $_GET['page'] ? $_GET['page'] : 1;
$limit = 20;
$skip = ($page - 1) * $limit;

$sql = "
SELECT *
    FROM g5_write_new
    WHERE (
        SELECT COUNT( wr_id )
            FROM g5_write_as
            WHERE g5_write_as.wr_1 = g5_write_new.wr_id
            AND g5_write_as.wr_3
            BETWEEN DATE_SUB( CURDATE( ) , INTERVAL 1 MONTH )
            AND CURDATE( )
        ) = 0
    AND wr_id < $wr_id
    ORDER BY `g5_write_new`.`wr_id` DESC
    LIMIT $limit
";


$data = $g5_write_new->query($sql);

$g5['title'] = 'A/S';
include_once(G5_THEME_PATH.'/head.php');
add_stylesheet('<link rel="stylesheet" href="'.G5_CSS_URL.'/as.css">', 0);
?>


<div id="bo_list" style="width:100%">

    <!-- 게시판 카테고리 시작 { -->
    <!-- } 게시판 카테고리 끝 -->

    <!-- 게시물 검색 시작 { -->
    <fieldset id="bo_sch">
        <legend>게시물 검색</legend>

        <form name="fsearch" method="get">
            <input type="hidden" name="bo_table" value="new">
            <input type="hidden" name="sca" value="">
            <input type="hidden" name="sop" value="and">
            <div class="shop_search" width="100%" style="padding-top:8px;">
                <table class="list_search_tbl">
                    <tbody>
                    <tr>
                        <th class="list_search_th" style="border-radius:0px 0px 0px 7px;">정기점검미체크확인</th>
                        <td class="list_search_td talign_l x210">
                            <select name="check_date" id="check_date">
                                <option value="">선택해주세요</option>
                                <? for ($i = 1; $i < 37; $i++) { ?>
                                    <option value="<?=$i?>" <?if($_GET['check_date'] == $i) echo 'selected';?> ><?=$i?>개월</option>
                                <? } ?>
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </fieldset>
    <!-- 게시물 검색 끝 } -->


    <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
        <input type="hidden" name="bo_table" value="new">
        <input type="hidden" name="sfl" value="">
        <input type="hidden" name="stx" value="">
        <input type="hidden" name="spt" value="">
        <input type="hidden" name="sca" value="">
        <input type="hidden" name="sst" value="wr_num, wr_reply">
        <input type="hidden" name="sod" value="">
        <input type="hidden" name="page" value="1">
        <input type="hidden" name="sw" value="">

        <div style="padding:5px 0 15px 0;">

            <table class="l_tbl">
                <thead>
                <tr>
                    <th class="l_th_top" colspan="10"></th>
                </tr>
                <tr>
                    <!--<th class="l_th_th x30">-->
                    <!--    <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>-->
                    <!--    <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">-->
                    <!--</th>-->
                    <th class="l_th_th x60">고객분류</th>
                    <th class="l_th_th">업체명</th>
                    <!--<th class="l_th_th x130">임대기종</th>-->
                    <th class="l_th_th x90">TEL</th>
                    <th class="l_th_th x80">계약일자</th>
                    <th class="l_th_th x80">최근점검일자</th>
                    <th class="l_th_th x80">다음점검일자</th>
                    <!--<th class="l_th_th x150">수금사항</th>-->
                    <th class="l_th_th x75">상세정보</th>
                </tr>
                </thead>
                <tbody>
                <?
                    foreach($data as $d) {
                        $wr_id = $d['wr_id'];
                ?>
                <tr>
                    <!--<td class="l_tb_td talign_c">-->
                    <!--    <label for="chk_wr_id_0" class="sound_only">--><!--</label>-->
                    <!--    <input type="checkbox" name="chk_wr_id[]" value="1907" id="chk_wr_id_0">-->
                    <!--</td>-->
                    <td class="l_tb_td talign_c"><?=$d['wr_2']?></td>
                    <td class="l_tb_td"><?=$d['wr_subject']?></td>
                    <!--<td class="l_tb_td talign_c">-->
                    <!--    <div>앱손 c579r</div><div>앱손 c579r</div>			</td>-->
                    <td class="l_tb_td talign_c"><?=$d['wr_7']?></td>

                    <td class="l_tb_td talign_c"><?=$d['wr_1']?></td>

                    <td class="l_tb_td talign_c"><?=$d['latest_check_date']?></td>

                    <td class="l_tb_td talign_c"><?=$d['next_check_date']?></td>


                    <!--<td class="l_tb_td talign_c">-->
                    <!--</td>-->
                    <td class="l_tb_td talign_c">
                        <a class="go_view_btn" style="color:#fff;" href="https://www.dreamforone.com:443/~aniink/bbs/board.php?bo_table=new&amp;wr_id=<?=$d['wr_id']?>">상세정보</a>
                    </td>
                </tr>
                <? } ?>
                </tbody>
            </table>

        </div>
    </form>

    <div>
        <span onclick="changePage(page-1)">이전</span>
        <?=$page?>
        <span onclick="changePage(page+1)">다음</span>
    </div>
</div>

<script>
    let page = <?=$page?>;
    let check_date = <?=$check_date?>;
    let wr_id = <?=$wr_id?>;

    function changePage(np) {
        if(np <= 0) {
            alert("첫번째 페이지입니다.");
            return false;
        }

        window.location.href = `?check_date=${check_date}&page=${np}&wr_id=${wr_id}`;
    }

    function handleDateChange(selectedDate) {
        window.location.href = "?check_date=" + selectedDate;
    }
    // 이벤트 리스너 추가
    document.getElementById("check_date").addEventListener("change", function () {
        const selectedValue = this.value; // 선택된 값
        handleDateChange(selectedValue); // 함수 호출
    });

</script>

<?
include_once(G5_THEME_PATH.'/tail.php');
?>
