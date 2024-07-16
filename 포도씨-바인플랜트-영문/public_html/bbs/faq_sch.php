<?
include_once('./_common.php');
$g5['title'] = 'Search Results';
include_once('./_head.php');


?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#container{padding:0 0 140px;}
    .highlight {color:#275dd7;}
</style>

<div id="area_community" class="faq">
    <div id="area_faq" class="sch">
		<div class="community_cate">
			<div class="inr v3">
				<ul class="area_history">
						<li><a href="<?=G5_BBS_URL?>/cscenter.php">CS Center</a></li>
						<li class="current"><a href="javascript:;">Search Results</a></li>
					</ul>	
				<div class="box_sch">
					<form name="fsearchbox">
						<input type="text" placeholder="검색하기" name="search" id="search" value="<?=$search?>">
						<input type="hidden" name="page" id="page" value="1">
						<button type="submit"></button>
					</form>
				</div>
			</div>
		</div>	

		<div class="inr v3">

			<div class="area_box">
				<h3><span id="cnt">0</span> results for "<?=$search?>"</h3>
                <!--ajax.faq_sch_list.php-->
                <ul class="board_list"></ul>
				<div id="paging"></div>
			</div>
		</div>
	</div>
</div>


<script>
    $(function() {
        faqSchList();
    });

    // 리스트
    function faqSchList(page) {
        if(page == undefined) { page = 1; }
        $('#page').val(page);

        $.ajax({
            url : g5_bbs_url + "/ajax.faq_sch_list.php",
            data: {page : $('#page').val(), search: $('#search').val()},
            type: 'POST',
            cache: false,
            async: false,
            dataType: 'html',
            success : function(data) {
                if(data){
                    $('.board_list').html(data);

                    if($('#total_count').text() != 0) {
                        $('#cnt').text(number_format($('#total_count').text())); // 검색 건수

                        var search = $('#search').val();
                        $(".board_list .subject").highlight(search); // 검색어 있을 시 하이라이트
                        $(".board_list .contents").highlight(search); // 검색어 있을 시 하이라이트

                        // 페이징 처리 -- 하단에 페이지 표시
                        ajaxGetPaging();
                    }
                    else {
                        $('.board_list').before('<h3 class="nodata">No search result found.</h3>');
                    }
                }
            },
            error : function(err) {
                swal(err.status);
            }
        });
    }

    // 페이징 처리 -- 페이지 클릭 시 동작 이벤트
    function get_page(page) {
        faqSchList(page);
    }
</script>
<?
include_once('./_tail.php');
?>