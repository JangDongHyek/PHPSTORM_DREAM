<!-- 내역관리 > 수량단가 -->
</div>

<section class="record">
    <section class="list_table">
        <div class="area_filter flex ai-c gap5">
            <div class="flex ai-c">
                <strong class="total">총 9건</strong>
                <div class="search">
                    <select name="sfl">
                        <option value="">품명</option>
                    </select>
                    <input type="search" name="stx" placeholder="검색어 입력" value="">
                    <button type="submit" class="btn-search"><i class="fa-regular fa-magnifying-glass"></i></button>
                </div>
            </div>
            <button class="btn btn-line male-auto"><img src="<?=base_url()?>img/common/excel_green.svg"> 업로드</button>
            <button type="button" class="btn btn-darkblue" data-toggle="modal" data-target="#groupPriceModal">항목 추가</button>
        </div>
        <div class="table">
            <table>
                <colgroup>
                    <col width="75px">
                    <col width="10%">
                    <col width="10%">
                    <col width="auto">
                    <col width="80px">
                </colgroup>
                <thead>
                <tr>
                    <th>NO.</th>
                    <th>카테고리</th>
                    <th>품명</th>
                    <th>연관</th>
                    <th>관리</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>1</th>
                    <th>콘크리트</th>
                    <td>C18_무근</td>
                    <td>
                        <ul class="flex flexwrap gap5">
                            <li>레미콘 [25-30-150] <b>* 8%</b></li>
                            <li>레미콘 [25-27-150] <b>* 8%</b></li>
                            <li>레미콘 [25-27-120] </li>
                        </ul>
                    </td>
                    <td class="text-center"><button class="btn btn-mini btn-black">수정</button></td>
                </tr>
                <tr>
                    <th>2</th>
                    <th>콘크리트</th>
                    <td>C24</td>
                    <td>
                        <ul class="flex flexwrap gap5">
                            <li>레미콘 [25-30-150] <b>* 8%</b></li>
                            <li>레미콘 [25-27-150] <b>* 8%</b></li>
                            <li>레미콘 [25-27-120] </li>
                        </ul>
                    </td>
                    <td class="text-center"><button class="btn btn-mini btn-black">수정</button></td>
                </tr>
                <tr>
                    <th>3</th>
                    <th>콘크리트</th>
                    <td>C27</td>
                    <td>
                        연관된 기초항목이 없습니다.
                    </td>
                    <td class="text-center"><button class="btn btn-mini btn-black">수정</button></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="paging">
            <div class="pagingWrap">
                <a class="first disabled"><i class="fa-light fa-chevrons-left"></i></a>
                <a class="prev disabled"><i class="fa-light fa-chevron-left"></i></a>
                <a class="active">1</a>
                <a>2</a>
                <a>3</a>
                <a>4</a>
                <a>5</a>
                <a>6</a>
                <a>7</a>
                <a class="next disabled"><i class="fa-light fa-chevron-right"></i></a>
                <a class="last disabled"><i class="fa-light fa-chevrons-right"></i></a>
            </div>
        </div>
    </section>


    <!-- -->
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
                                    <option selected>레미콘 [25-27-150]</optionselected>
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


