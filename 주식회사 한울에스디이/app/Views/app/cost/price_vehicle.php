
<section class="list_table">
    <div class="area_filter flex ai-c jc-sb">
        <div class="flex ai-c">
            <strong class="total">총 4건</strong>
            <div class="search">
                <select name="sfl">
                    <option value="">품명</option>
                </select>
                <input type="search" name="stx" placeholder="검색어 입력" value="">
                <button type="submit" class="btn-search"><i class="fa-regular fa-magnifying-glass"></i></button>
            </div>
        </div>
        <button type="button" class="btn btn-darkblue" data-toggle="modal" data-target="#vehiclePriceModal">단가 등록</button>
    </div>
    <div class="table">
        <table>
            <colgroup>
                <col width="75px">
                <col width="auto">
                <col width="auto">
                <col width="auto">
                <col width="100px">
                <col width="auto">
                <col width="auto">
                <col width="auto">
                <col width="auto">
                <col width="auto">
                <col width="auto">
                <col width="auto">
                <col width="auto">
                <col width="80px">
                <col width="80px">
            </colgroup>
            <thead>
            <tr>
                <th>공종 ID</th>
                <th>산출명</th>
                <th>세부</th>
                <th>단위</th>
                <th>Q1</th>
                <th>K</th>
                <th>F</th>
                <th>E1</th>
                <th>E</th>
                <th>CM</th>
                <th>Q</th>
                <th>재료비</th>
                <th>노무비</th>
                <th>경비</th>
                <th>합계</th>
            </tr></thead>
            <tbody>

            <tr>
                <th>V201</th>
                <th>터파기</th>
                <td></td>
                <td>M3</td>
                <td>0.70</td>
                <td>0.90</td>
                <td>0.80</td>
                <td>-0.05</td>
                <td>0.65</td>
                <td>20</td>
                <td>65.52</td>
                <td>274.6</td>
                <td>773.5</td>
                <td>343.7</td>
                <td>1,391.8</td>
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
<div class="modal fade" id="vehiclePriceModal" tabindex="-1" aria-labelledby="vehiclePriceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="vehiclePriceModalLabel">중기단가 등록</h5>
            </div>
            <div class="modal-body">
                <div class="form_wrap">
                    <div class="flex ai-c jc-sb">
                        <label for="" class="txt-up">품명 선택</label>&nbsp;&nbsp;
                        <button class="btn btn-mini btn-black">품명 추가</button>
                    </div>
                    <select>
                        <option>[V201] 터파기</option>
                    </select>
                    <div class="box box-gray">
                        <label for="">공종 ID</label>
                        <div class="flex ai-c">
                            <b>V</b><input type="number" name="" id="" placeholder="000"/>&nbsp;
                        </div>
                        <label for="">품명</label>
                        <div class="flex ai-c">
                            <input type="text" name="" id="" placeholder="품명"/>
                        </div>
                    </div>
                    <button class="btn btn-mini w100 btn-black">세부 추가</button>
                    <div class="box box-white">
                        <label for="">세부</label><button class="btn btn-mini btn-line">삭제</button>
                        <div class="flex ai-c">
                            <input type="text" name="" id="" placeholder="세부명"/>
                        </div>
                        <label for="">단위</label>
                        <div class="flex ai-c gap5">
                            <input type="text" name="" id="" placeholder="단위"/>
                        </div>
                        <label for="">Q1 / K / F</label>
                        <div class="flex ai-c">
                            <input type="text" name="" id="" placeholder="Q1"/>
                            <input type="text" name="" id="" placeholder="K"/>
                            <input type="text" name="" id="" placeholder="F"/>
                        </div>
                        <label for="">E1 / E</label>
                        <div class="flex ai-c">
                            <input type="text" name="" id="" placeholder="E1"/>
                            <input type="text" name="" id="" placeholder="E"/>
                        </div>
                        <label for="">CM / Q</label>
                        <div class="flex ai-c">
                            <input type="text" name="" id="" placeholder="CM"/>
                            <input type="text" name="" id="" placeholder="Q"/>
                        </div>
                        <label for="">재료비</label>
                        <div class="flex ai-c">
                            <input type="text" name="" id="" placeholder="CM"/>
                        </div>
                        <label for="">노무비</label>
                        <div class="flex ai-c">
                            <input type="text" name="" id="" placeholder="CM"/>
                        </div>
                        <label for="">경비</label>
                        <div class="flex ai-c">
                            <input type="text" name="" id="" placeholder="CM"/>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>-->
                <button type="button" class="btn btn-primary">등록 완료</button>
            </div>
        </div>
    </div>
</div>
