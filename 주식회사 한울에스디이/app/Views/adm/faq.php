<!--자주묻는질문-->
</div>

<section>
    <div class="area_filter flex ai-c jc-sb" id="search_form">
        <div class="flex ai-c">
            <strong class="total">총 <?=$board['count']?>건</strong>
            <select id="search_value1">
                <option value="">구분</option>
                <option value="주문/결제">주문/결제</option>
                <option value="이용방법">이용방법</option>
            </select>

            <div class="search">
                <input type="search" id="search_value2" placeholder="검색어 입력" value="" keyEvent.enter= "onSearch">
                <button type="submit" class="btn_search" onclick="onSearch()"><i class="fa-regular fa-magnifying-glass"></i></button>
            </div>
        </div>
        <div>
            <button type="button" class="btn btn_blue" onclick="location.href='./faqForm'">등록</button>
        </div>
    </div>
    
    <div class="faq_list">
        <? foreach($board['data'] as $d) { ?>
        <details>
            <summary>
                <div>
                    <div class="flex ai-c">
                        <p class="p_cate"><span class="txt_blue txt_bold"><?=$d['category']?></span></p>
                        <p class="p_date"><?=explode(' ',$d['insert_date'])[0]?></p>
                    </div>
                    <p class="p_title">Q. <?=$d['title']?></p>
                </div>
            </summary>
            <div class="details">
                <?=$d['content']?>
            </div>
        </details>
        <? } ?>

    </div>
    
    <div class="paging" id="pagination">
        <div class="pagingWrap">
            <a class="first disabled" first><i class="fa-light fa-chevrons-left"></i></a>
            <a class="prev disabled" prev><i class="fa-light fa-chevron-left"></i></a>
            <span pageEvent="onSearch">
                <a class="active" >1</a>
            </span>
            <a class="next disabled" next><i class="fa-light fa-chevron-right"></i></a>
            <a class="last disabled" last><i class="fa-light fa-chevrons-right"></i></a>
        </div>
    </div>

</section>

<?php $jl->jsLoad(); ?>

<script>
    const page = <?=$page?>;
    const total_page = <?=$board['total_page']?>;

    jl.INIT({page_id : 'pagination',page : page, total_page : total_page})

    function onSearch(page = 1) {

        let obj = jl.getFormById('search_form');
        obj['search_key1'] = 'category';
        obj['page'] = page;

        let query = jl.getUrlQuery(obj);

        window.location.href = jl.getCurrentUrl() + "?" + query;
    }
</script>
