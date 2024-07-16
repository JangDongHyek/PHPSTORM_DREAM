<?php
include_once('./_common.php');
?>

<form name="fsearch" id="fsearch" method="post" action="<?=G5_BBS_URL?>/help_list.php">
    <input type="hidden" id="state" name="state" value="">
    <input type="hidden" id="category" name="category" value="">
    <input type="hidden" id="date" name="date" value="">
    <input type="hidden" id="sch_tag" name="sch_tag" value="">
    <input type="hidden" id="sch_txt" name="sch_txt" value="">
</form>

<script>
    //work tab
    $(document).ready(function () {
        // 인기순/최신순/벙커순 (웹)
        $(".sort_list li").click(function () {
            click_event('sort_list', $(this), 'selected', 'orderby');

            /*$(".sort_list li").removeClass("selected");
            $(this).addClass("selected");
            $('#orderby').val($(this)[0]['innerText']);
            help_list(); // 리스트*/
        });

        // 인기순/최신순/벙커순 (모바일)
        $(".sort_list_mobile li").click(function () {
            click_event('sort_list_mobile', $(this), 'active', 'orderby');

            $('.msort_list span').text($(this)[0]['innerText']);
            $('#listModal').modal('hide');
        });

        // 카테고리(웹)
        $('.box_cate li').click(function () {
            click_event('box_cate', $(this), 'active', 'category');

            /*$(".box_cate li").removeClass("active");
            $(this).addClass("active");
            $('#category').val($(this)[0]['innerText']);
            help_list(); // 리스트*/
        });

        // 카테고리(모바일)
        $('.cate_list li').click(function () {
            if($(location).attr('pathname').indexOf('help_write') != -1) {
                console.log('write');
                click_event('cate_list', $(this), 'active', 'he_category', 'mobile');
            } else {
                console.log('list');
                click_event('cate_list', $(this), 'active', 'category', 'mobile');
            }

            var add_text = '';
            if ($(this)[0]['innerText'] == '전체') {
                add_text += '<i></i>';
            }
            $('.mbox_cate span').html(add_text + $(this)[0]['innerText'])
            $('#cateModal').modal('hide');
        });

        // 기간검색
        $('.date li').click(function () {
            click_event('date', $(this), 'selected', 'date');

            /*$('.date li').removeClass('selected');
            $(this).addClass("selected");
            $('#date').val($(this)[0]['innerText']);
            help_list(); // 리스트*/
        });


        // ** 뷰 화면에서 검색 시 **
        if ($('#date').val() != '') {
            // 기간
            $('.date li').removeClass('selected');
            $('.date li').each(function () {
                if ($(this)[0]['innerText'] == $('#date').val()) {
                    $(this).addClass('selected');

                    $('.box .select').text($(this)[0]['innerText']);
                    $('li:contains("'+$(this)[0]['innerText']+'")').addClass('selected');
                }
            });
        }

        if ($('#category').val() != '') {
            // 카테고리(웹)
            $('.box_cate li').removeClass('active');
            $('.box_cate li').each(function () {
                // console.log($(this)[0]['innerText']);
                if ($(this)[0]['innerText'] == $('#category').val()) {
                    $(this).addClass('active');
                }
            });

            // 카테고리(모바일)
            $('.cate_list li').removeClass('active');
            $('.cate_list li').each(function () {
                if ($(this)[0]['innerText'] == $('#category').val()) {
                    $(this).addClass('active');
                }
            });
        }
    });
</script>