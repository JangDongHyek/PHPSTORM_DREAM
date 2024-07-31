<?php
echo view('common/header_adm');
echo view('common/adm_head');
$header_name = "제품 현황";

if($w == ""){

} else {

}
?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


        <?php echo view('goods/goods_head', $this->data); ?>

        <form id="item_form" name="item_form" onkeypress="preventEnterKey(event)">
            <input type="hidden" id="goods_no" name="goods_no" value="<?=$goods_data['goods_no']?>">
            <input type="hidden" id="w" name="w" value="<?=$w?>">
            <div class="write_wrap">
                <div class="top_wrap">
                    <h1>제품 등록하기</h1>
                    <div class="btn_wrap">
                        <a href="<?=base_url('goods/')?>" class="btn btn-sm btn-gray">목록</a>
                        <!--<a href="<?/*=base_url('goods/goods_list')*/?>" class="btn btn-sm btn-pink">삭제</a>-->
                        <button type="button" onclick="save_goods()" class="btn btn-sm btn-blue">저장</button>
                    </div>
                </div>
                
                <div class="form_scroll">
                <?php //판매사이트 및 판매상태 / 상품명 / 카테고리 / 카탈로그 / 판매가 / 할인 / 할인설정 / 특정기간 할인 / 최종 판매가 / 판매기간 / 기간설정 / 부과세
                    echo view('goods/form/good_form_1', $this->data);
                ?>
                <?php // 옵션 / 재고수량 / 상품이미지
                    echo view('goods/form/good_form_2', $this->data);
                ?>
                <?php // / 상품상세설명 / 주요정보 / 인증정보 / 판매방식 / 상품정보제공고시 /
                    echo view('goods/form/good_form_3', $this->data);
                ?>
                <?php //  배송 / 반품교환 /추가구성 / 구매혜택 /
                    echo view('goods/form/good_form_4', $this->data);
                ?>
                <?php // 추가정보 / 노출채널 / 후원나눔 /
                    echo view('goods/form/good_form_5', $this->data);
                ?>
                </div>
            </div>
        </form>


<script>
    function preventEnterKey(event) {
        if (event.key === "Enter") {
            event.preventDefault();
        }
    }
</script>
<!--
    스크립트 포함하면 너무 길어서 별도로 분리
    꼼수로 js파일이 아닌 php로 해서 php변수를 넘기기 쉽게 함
-->
<?php echo view('goods/js/goods_js'); ?>
<?php
echo view('common/adm_tail');
echo view('common/footer');
?>