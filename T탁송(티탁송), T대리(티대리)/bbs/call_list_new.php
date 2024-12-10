<?
/*************************************
드라이버 콜접수내역
 * 1. 기사
 * - 인덱스
 * - 콜접수내역 (내콜만)
 * 2. 고객
 * - 운행내역
*************************************/
include_once('./_common.php');
include_once(G5_THEME_MOBILE_PATH.'/head.php');

$mode = $_REQUEST['m']; // m==my : 내콜만
$sort = ($_GET['sort']=="1"||$_GET['sort']=="2")? $_GET['sort'] : "1"; //1:최근순 2:근거리순

$sql_common = "FROM g5_call A WHERE A.is_public = 'Y'";
$sql_order = "";

// 조건추가
if ($is_driver) { // 1)기사
    if ($mode == "my") { // 콜접수내역(내콜만)
        $sql_common .= " AND A.driver_id = '{$member['mb_id']}'";
    } else { // 인덱스
        $sql_common .= " AND (A.call_status IN ('0', 'R') OR (A.call_status = '1' AND A.driver_id = '{$member['mb_id']}') )";
    }

    // 정렬&거리추가
    $sql_order = "HAVING distance <= {$member['mb_distance']} ";
    if ($sort == "1") {
        $sql_order .= "ORDER BY (CASE A.call_status WHEN '2' THEN 2 ELSE 1 END) ASC, idx DESC";
    } else {
        $sql_order .= "ORDER BY (CASE A.call_status WHEN '2' THEN 2 ELSE 1 END) ASC, distance ASC";
    }

} else {    // 2)고객
    $sql_common .= " AND A.mb_id = '{$member['mb_id']}'";
    $sql_order = "ORDER BY idx DESC";
}


// 범위 쿼리 추가
// $sql_common .= "";

// 리스트
$sql = "SELECT A.*,
    (6371*acos(cos(radians({$cur_lat}))*cos(radians(A.start_lat))*cos(radians(A.start_lng)
    -radians({$cur_lng}))+sin(radians({$cur_lat}))*sin(radians(A.start_lat)))) AS distance
    {$sql_common} {$sql_order}";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);
//echo $sql;

$empty_txt = ($mode == "my")? "콜접수내역이 없습니다." :  "콜 대기중입니다.";
$wrap_id = ($is_driver)? "driver_wrap" : "user_wrap";

// 고객 콜요청후 '전화'를 누른경우 tel: 실행
$run_call = ($_GET['call']=="1" && !$is_driver)? "T" : "F";
?>
<style>
    #container {min-height: 640px; background: #000;}
</style>

<script>
    var run_call = "<?=$run_call?>";

    $(function() {
        getCallList();

        setInterval(function() {
            //console.log('5초마다 목록 재실행');
            getCallList();
        }, 5000);

        if (run_call == "T") {
            history.replaceState({data: "replaceState"}, "", g5_bbs_url + "/call_list_new.php?m=my");
            location.href = "tel:1599-1009";
        }
    });

    // 콜내역 호출
    function getCallList() {
        let obj = {};
        obj.mode = document.querySelector("input[name=mode]").value;
        obj.sort = document.querySelector("input[name=sort]").value;
        obj.lat = document.querySelector("input[name=lat]").value;
        obj.lng = document.querySelector("input[name=lng]").value;

        $.ajax({
            type : "post",
            url : "./ajax.call_list_new.php",
            data : obj,
            dataType : "html",
        }).done(function(data, textStatus, xhr) {
            $("#req_list_load").html(data);
            console.log('getCallList() complete');

        }).fail(function(data, textStatus, errorThrown) {
            let tag = "<li><div style='color: #FFF; padding: 20px; font-size: 1.15em;'>";
            tag += "콜내역을 불러오는데 실패하였습니다.<br>다시 시도해 주세요.</div></li>";
            $("#req_list_load").html(tag);

        }).always(function() {

        });
    }

    // 상세페이지 이동
    function getCallView(idx) {
        let url = g5_bbs_url + "/call_view.php?idx=" + idx;
        location.href = url;
    }

    /*function callStatusUpdate() {
        let idxes = document.getElementsByName("idx[]");
        let list = [];
        for (let i=0; i<idxes.length; i++) {
            list.push(document.getElementsByName('idx[]')[i].value);
        }

        $.post("./ajax.call_list_status.php", {idx_list: list} ).done(function(json) {
            let data = JSON.parse(json);
            console.log(data);
        }, "json").fail(function() {
            ;
        });
    }*/
</script>

<div id="<?=$wrap_id?>">
    <input type="hidden" name="mode" value="<?=$mode?>">
    <input type="hidden" name="sort" value="<?=$sort?>">
    <input type="hidden" name="lat" value="<?=$cur_lat?>">
    <input type="hidden" name="lng" value="<?=$cur_lng?>">

    <?
    if ($is_driver) {
        $tab_url = "./call_list_new.php?";
        if ($mode == "my") $tab_url .= "m=my&";
    ?>
    <div class="sort">
        <a href="javascript:void(0);" onclick="location.reload();">새로고침</a>
        <a href="<?=$tab_url?>sort=1" <?if($sort=="1"){?>class="active"<?}?>>최근순</a>
        <a href="<?=$tab_url?>sort=2" <?if($sort=="2"){?>class="active"<?}?>>근거리순</a>
    </div>
    <?}?>

    <div id="req_list">
        <?if ($is_driver) {?>
        <ul class="title">
            <li>
                <div class="km">거리</div>
                <div class="info">경로</div>
                <div class="info3">출발일시</div>
                <div class="info2">요금</div>
            </li>
        </ul>
        <?}?>

        <!-- 콜내역 -->
        <ul id="req_list_load">
            <!-- ./ajax.call_list_new.php -->
        </ul>
    </div>
</div>

<?
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>