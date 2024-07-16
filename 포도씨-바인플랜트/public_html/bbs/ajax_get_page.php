<?php
include_once('./_common.php');

/**
 ** 페이징 처리 **
 ** include 하는 파일에 page 변수와 temp_total_page 변수 필요
 ** 페이지 표시할 영역 필요 : id=>paging
 ** 페이지 표시 후 temp_total_page 변수 삭제 (임시 변수)
 **/
?>

<script>
    // 페이징 처리
    function ajaxGetPaging(mode) {
        $.ajax({
            url : g5_bbs_url + "/ajax.get_page.php",
            data: {page : $('#page').val(), total_page : $('#temp_total_page').text()},
            type: 'POST',
            cache: false,
            async: false,
            success : function(data) {
                if(mode == "full") { // 전체검색 시 아이디 겹쳐서 구분
                    $('#full_paging').html(data);
                } else {
                    $('#paging').html(data);
                }
                $('#temp_total_page').remove();
                $('#total_count').remove();
            },
            error : function(err) {
                swal(err.status);
            }
        });
    }
</script>