<?php
include_once('./_common.php');
?>

<form name="fsearch" id="fsearch" method="post" action="<?=G5_BBS_URL?>/company_search.php">
    <input type="hidden" id="sch_tag" name="sch_tag" value="">
    <input type="hidden" id="sch_txt" name="sch_txt" value="">
    <input type="hidden" id="filter1" name="filter1" value="">
    <input type="hidden" id="filter2" name="filter2" value="">
</form>

<script>
    $(document).ready(function () {
        // 리뷰순/평점순/거래순 (웹)
        $(".sort_list li").click(function () {
            click_event('sort_list', $(this), 'selected', 'orderby');
        });

        // 리뷰순/평점순/거래순 (모바일)
        $(".sort_list_mobile li").click(function () {
            click_event('sort_list_mobile', $(this), 'active', 'orderby');

            $('.msort_list span').text($(this)[0]['innerText']);
            $('#listModal').modal('hide');
        });

        // 필터1 (웹)
        $('.filter1 li').click(function () {
            click_event('filter1', $(this), 'active', 'filter1');
        });

        // 필터2 (웹)
        $('.filter2 li').click(function () {
            click_event('filter2', $(this), 'active', 'filter2');
        });

        // ** 뷰 화면에서 검색 시 **
    });
</script>