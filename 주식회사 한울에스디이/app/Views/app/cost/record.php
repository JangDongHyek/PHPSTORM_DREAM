<!-- 내역관리 > 수량단가 -->
</div>

<section class="record" id="app">
    <cost-record-list project_idx="<?=$project['idx']?>"></cost-record-list>

    <div class="modal fade" id="groupPriceModal" tabindex="-1" aria-labelledby="groupPriceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-wide">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                    <h5 class="modal-title" id="groupPriceModalLabel">수량단가 등록</h5>
                </div>
                <div class="modal-body">
                    <div class="form_wrap">
                        <div class="flex ai-c jc-sb">
                            <label for="" class="txt-up">카테고리 선택</label>&nbsp;&nbsp;
                        </div>
                        <select>
                            <option>콘크리트</option>
                            <option>거푸집</option>
                            <option>철근</option>
                        </select>
                        <div class="box box-gray">
                            <label for="">품명</label>
                            <div class="flex ai-c">
                                <input type="text" name="" id="" placeholder="수량 품명"/>
                            </div>
                        </div>
                        <div class="box box-white">
                            <label for="">연관</label><button class="btn btn-mini btn-gray">추가</button>
                            <div class="flex gap5 ai-c">
                                <select>
                                    <option selected>레미콘 [25-30-150]</option>
                                    <option>레미콘 [25-27-150]</option>
                                    <option>레미콘 [25-27-120]</option>
                                    <option>레미콘 [25-21-120]</option>
                                    <option>레미콘 [25-18-120]</option>
                                    <option>레미콘타설 [버림]</option>
                                    <option>레미콘타설 [무근 및 누름]</option>
                                    <option>레미콘타설 [구체]</option>
                                </select>
                                <input type="number" class="w150px" placeholder="할증(미입력시 0)">
                                <span>%</span>
                                <button class="btn btn-line">삭제</button>
                            </div>
                            <div class="flex gap5 ai-c">
                                <select>
                                    <option>레미콘 [25-30-150]</option>
                                    <option selected>레미콘 [25-27-150]</option>
                                    <option>레미콘 [25-27-120]</option>
                                    <option>레미콘 [25-21-120]</option>
                                    <option>레미콘 [25-18-120]</option>
                                    <option>레미콘타설 [버림]</option>
                                    <option>레미콘타설 [무근 및 누름]</option>
                                    <option>레미콘타설 [구체]</option>
                                </select>
                                <input type="number" class="w150px" placeholder="할증(미입력시 0)">
                                <span>%</span>
                                <button class="btn btn-line">삭제</button>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">등록 완료</button>
                </div>
            </div>
        </div>
    </div>


</section>


<?
$jl->vueLoad('app');
$jl->componentLoad("/cost/record");
$jl->componentLoad("external");
$jl->componentLoad("item");
?>