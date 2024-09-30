<?php
include_once('../common.php');

/**
 ** ajax 페이징 처리 **
 ** include 하는 파일에 page 변수와 temp_total_page 변수(ajax로 불러오는 페이지에 표시) 필요
 ** 페이지 표시할 영역 필요 : id=>paging
 ** 페이지 표시 후 temp_total_page 변수 삭제 (임시 변수)
 **/
?>

<script>
    // 페이징 처리
    function ajaxGetPaging() {
        $.ajax({
            url : "./ajax.get_page.php",
            data: {page : $('#page').val(), total_page : $('#temp_total_page').text()},
            type: 'POST',
            cache: false,
            async: false,
            success : function(data) {
                $('#paging').html(data);
                $('#temp_total_page').remove();
                $('#total_count').remove();
            },
            error : function(err) {
                swal(err.status);
            }
        });
    }
</script>