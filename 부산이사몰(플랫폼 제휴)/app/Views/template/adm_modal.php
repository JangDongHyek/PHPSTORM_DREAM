<!--광고 신청 관리 > 변경-->
<div class="modal fade wide" id="planModal" tabindex="-1" aria-labelledby="planModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="planModalLabel">광고 내역 변경</h5>
            </div>
            <div class="modal-body">
                <div class="table">
                    <h4>광고 이용 정보</h4>
                    <table>
                            <colgroup>
                                <col width="auto">
                                <col width="auto">
                                <col width="auto">
                                <col width="auto">
                                <col width="auto">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>최초가입일</th>
                                <th>회사명</th>
                                <th>광고 내역</th>
                                <th>상태</th>
                                <th>만료일</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>24.01.02</td>
                                <td>부산이사몰</td>
                                <td>
                                    <p>기본 상품(+추가 2개)</p>
                                    <p>메인 노출 상품</p>
                                </td>
                                <td><strong class="">정상</strong></td>
                                <td>24.08.31<strong>(만료)</strong></td>
                            </tr>
                            </tbody>
                        </table>
                </div>
                <h4 class="txt_color">현재 서비스 중인 광고 내역 변경</h4>
                <div class="box box_colorline">
                <dl class="form_wrap">
                    <dt>기본 상품</dt>
                    <dd class="flex ai-c">
                        <input type="checkbox" id="add_arae" name="add_arae">
                        <label for="add_arae">
                            <span class="flex ai-c gap5">
                                지역추가 선택
                                <select>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                                개
                            </span>
                        </label>
                    </dd>
                </dl>
                <dl class="form_wrap">
                    <dt>광고 선택 상품</dt>
                    <dd class="select">
                        <input type="checkbox" id="main_ad" name="ad_option" value="main_ad">
                        <label for="main_ad">메인 노출 상품</label>
                        <input type="checkbox" id="premium_ad" name="ad_option" value="premium_ad">
                        <label for="premium_ad">프리미엄 광고 상품</label>
                    </dd>
                </dl>
                </div>
                <hr>
                <div class="table">
                    <div class="flex ai-c jc-sb">
                        <h4>최근 6개월 광고 내역</h4>
                        <button class="btn btn_mini btn_gray" onclick="location.href=''">전체 내역 보기</button>
                    </div>
                    <table>
                        <colgroup>
                            <col width="auto">
                            <col width="auto">
                            <col width="auto">
                            <col width="auto">
                            <col width="auto">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>결제일자</th>
                            <th>광고내역</th>
                            <th>이용기간</th>
                            <th>결제금액</th>
                            <th>결제정보</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>24.01.02</td>
                            <td>
                                <p>기본 상품(+추가 2개)</p>
                                <p>메인 노출 상품</p>
                            </td>
                            <td>24.07.30<br>~24.08.30</td>
                            <td>400,000원</td>
                            <td>국민카드(7019)</td>
                        </tr>
                        <tr>
                            <td colspan="10" class="noDataAlign">등록된 내역이 없습니다.</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>-->
                <button type="button" class="btn btn-primary">변경 완료</button>
            </div>
        </div>
    </div>
</div>

