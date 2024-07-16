<?php
include_once('./_common.php');
?>

<form name="fsearch" id="fsearch" method="post" action="<?=G5_BBS_URL?>/company_list.php">
    <input type="hidden" id="type" name="type" value="">
    <input type="hidden" id="category" name="category" value="">
    <input type="hidden" id="date" name="date" value="">
    <input type="hidden" id="sch_txt" name="sch_txt" value="">
    <input type="hidden" id="tab" name="tab" value="">
</form>

<script>
    //work tab
    $(document).ready(function () {
        // 등록순/마감순 (웹)
        $(".sort_list li").click(function () {
            click_event('sort_list', $(this), 'selected', 'orderby');
        });

        // 등록순/마감순 (모바일)
        $(".sort_list_mobile li").click(function () {
            click_event('sort_list_mobile', $(this), 'active', 'orderby');

            $('.msort_list span').text($(this)[0]['innerText']);
            $('#listModal').modal('hide');
        });

        // == 기업의뢰 ==
        // 의뢰유형(웹)
        $('.ci_type li').click(function () {
            click_event('ci_type', $(this), 'active', 'type');
        });

        // 의뢰유형(모바일)
        $('.m_ci_type li').click(function () {
            click_event('m_ci_type', $(this), 'active', 'type', 'mobile');

            var add_text = '';
            if ($(this)[0]['innerText'] == '전체') {
                add_text += '<i></i>';
            }
            $('.em_ci_type').html(add_text + $(this)[0]['innerText'])
            // $('#cateModal02').modal('hide');
        });

        // 기업의뢰-카테고리(웹)
        $('.ci_category li').click(function () {
            click_event('ci_category', $(this), 'active', 'category');
        });

        // 기업의뢰-카테고리(모바일)
        $('.m_ci_category li').click(function () {
            click_event('m_ci_category', $(this), 'active', 'category', 'mobile');

            var add_text = '';
            if ($(this)[0]['innerText'] == '전체') {
                add_text += '<i></i>';
            }
            $('.em_ci_category').html(add_text + $(this)[0]['innerText'])
            // $('#cateModal02').modal('hide');
        });

        // 기간검색
        $('.date li').click(function () {
            click_event('date', $(this), 'selected', 'date');
        });


        // == 매물리스트 ==
        // 매물유형(웹)
        $('.pr_type li').click(function () {
            click_event('pr_type', $(this), 'active', 'type');
        });

        // 매물유형(모바일)
        $('.m_pr_type li').click(function () {
            click_event('m_pr_type', $(this), 'active', 'type', 'mobile');

            var add_text = '';
            if ($(this)[0]['innerText'] == '전체') {
                add_text += '<i></i>';
            }
            $('.em_pr_type').html(add_text + $(this)[0]['innerText'])

            $('.m_pr_category1').hide();
            $('.m_pr_category2').hide();
            $('.m_pr_category3').hide();
            if($(this)[0]['innerText'] == '선박') {
                $('.m_pr_category1').show();
            } else if($(this)[0]['innerText'] == '기계장비') {
                $('.m_pr_category2').show();
            } else if($(this)[0]['innerText'] == '부품/물품') {
                $('.m_pr_category3').show();
            }
            $('#category').val('');
            $('.em_pr_category').html('전체');
            $('.m_pr_category ul li:nth-child(1)').addClass('active');
        });

        // 매물-카테고리(웹)
        $('.pr_category li').click(function () {
            click_event('pr_category', $(this), 'active', 'category');
        });

        // 매물-카테고리(모바일)
        $('.m_pr_category li').click(function () {
            click_event('m_pr_category', $(this), 'active', 'category', 'mobile');

            var add_text = '';
            if ($(this)[0]['innerText'] == '전체') {
                add_text += '<i></i>';
            }
            $('.em_pr_category').html(add_text + $(this)[0]['innerText'])
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

        var char = '';
        if($('#tab').val() == 'tab2') { // 매물리스트
            char = 'pr';
        }
        else { // 기업의뢰
            char = 'ci';
        }

        if ($('#type').val() != '') {
            // type (웹)
            $('.'+char+'_type li').removeClass('active');
            $('.'+char+'_type li').each(function () {
                if ($(this)[0]['innerText'] == $('#type').val()) {
                    $(this).addClass('active');
                }
            });

            // type (모바일)
            $('.m_'+char+'_type li').removeClass('active');
            $('.m_'+char+'_type li').each(function () {
                if ($(this)[0]['innerText'] == $('#type').val()) {
                    $(this).addClass('active');
                }
            });
        }


        if ($('#category').val() != '') {
            // 카테고리(웹)
            $('.'+char+'_category li').removeClass('active');
            $('.'+char+'_category li').each(function () {
                if ($(this)[0]['innerText'] == $('#category').val()) {
                    $(this).addClass('active');
                }
            });

            // 카테고리(모바일)
            $('.m_'+char+'_category li').removeClass('active');
            $('.m_'+char+'_category li').each(function () {
                if ($(this)[0]['innerText'] == $('#category').val()) {
                    $(this).addClass('active');
                }
            });
        }
    });
</script>