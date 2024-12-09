<?php
$pid = "event";
include_once("./app_head.php");

$stx = trim($_GET['stx']);

// 이벤트 목록
$sql = "SELECT * FROM g5_bbs_basic WHERE del_yn = 'N' AND tbl_name = 'event' ";
if ($stx != "") $sql .= "AND (subject LIKE '%{$stx}%' OR content LIKE '%{$stx}%')";
$sql .= "ORDER BY idx DESC";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

?>
<script>
    let current_page = 1;       // 현재페이지
    let read_more = true;       // 더보기 가능여부
    let load_complete = true;   // 목록 호출완료 체크 변수

    $(function() {
        getList();
    });

    // 스크롤 감지 - 더보기
    $(window).scroll(function() {
        let st = $(this).scrollTop();
        if ($(window).scrollTop() == $(document).height() - $(window).height() && read_more) {
            console.log('스크롤마지막 > 다음페이지 호출=' + current_page);
            getList(current_page);
        }
    });

    // 검색
    function searchList(f) {
        let stx = f.stx.value.trim();
        f.stx.value = stx;

        if (stx != "" && stx.length < 2) {
            swal("검색어를 2자 이상 입력해 주세요.");
            return false;
        }

        current_page = 1;
        getList();
        return false;
    }

    // 목록 호출
    function getList() {
        if (!load_complete) return false;

        let data = {};
        data.page = current_page;
        data.stx = document.querySelector("input[name=stx]").value;

        $.ajax({
            type : "get",
            url : "./event_list.php",
            data : data,
            dataType : "html",
        }).done(function(data, textStatus, xhr) {
            if (current_page == 1) $("#list_load").html(data);
            else $("#list_load").append(data);
            current_page++;

            // 마지막 페이지?
            if ($("#list_load ul:last-child").data("last-page") == "Y") read_more = false;
            load_complete = true;

        }).fail(function(data, textStatus, errorThrown) {
            swal("목록을 불러오는데 실패했습니다.");
        });
    }

</script>

<div id="event" class="board list">
    <div class="area_top">
        <form method="get" autocomplete="off" onsubmit="return searchList(this)">
            <div class="sch">
                <input type="text" name="stx" placeholder="검색어를 입력해주세요"><button type="submit"><i class="fa-light fa-magnifying-glass"></i></button>
            </div>
        </form>
        <!--<div class="btn_wrap">
            <a href="event_form.php" class="btn">공지 등록하기</a>
        </div>-->
    </div>
    <div class="event" id="list_load">
        <!-- ./event_list.php -->
    </div>
</div>


<?php
include_once ("./app_tail.php");
?>