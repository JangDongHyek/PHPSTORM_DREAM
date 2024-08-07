<!-- signpadModal 인수증 확인 -->
<div class="modal fade" id="signpadModal" style="z-index:1041" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div id="signpadModalBody" class="modal-body">

                <div class="recipt">

                    <table class="date" border="0" width="100%">
                        <colgroup>
                            <col width="20px">
                            <col width="*">
                        </colgroup>
                        <tr>
                            <th class="">일자</th>
                            <td id="sDate" class="">2023년 01월 11일</td>
                        </tr>
                    </table>

                    <div class="list" style="min-height: 0px">
                        <table class="" border="0" width="100%">
                            <colgroup>
                                <col width="70px">
                                <col width="*">
                            </colgroup>
                            <tr>
                                <th class="">상호</th>
                                <td id="sCompanyName" class="">업체명</td>
                            </tr>
                        </table>
                    </div>
                    <div class="admin list">
                        <table class="" border="0" width="100%">
                            <colgroup>
                                <col width="70px">
                                <col width="*">
                            </colgroup>
                            <tr>
                                <th class="">납품장소</th>
                                <td id="sCompanyAddr" class="">울산광역시 남구 화합로102번길 3</td>
                            </tr>
                            <tr>
                                <th class="">담당자</th>
                                <td id="sCustomerName" class="">김홍돌</td>
                            </tr>
                            <tr>
                                <th class="">연락처</th>
                                <td id="sCustomerMbHp" class="">010-0000-0000</td>
                            </tr>
                            <input type="hidden" id="pctListParents" />                                                        
                        </table>
                    </div>
                    <div class="">
                        <h6 class="tit">인수자 서명</h6>
                        <div id="sDataUrl" class="img" style="
               background-image: url(../theme/basic_app/img/sub/sign.png);
   			   background-size: cover;
   			   background-repeat: no-repeat;
   			   background-position: center;
   			   max-width: 500px;
   			   margin: 0 auto;
   			   height: 200px;
   			  ">
                        </div>
                    </div>

                    <div class="admin list">
                        <table class="" border="0" width="100%">
                            <colgroup>
                                <col width="100px">
                                <col width="*">
                            </colgroup>
                            <th class="">배송 담당자</th>
                            <td id="sDeliveryName" class="">김철수(010-0000-0000)</td>
                            <tr>
                                <th class="">배송 완료일시</th>
                                <td id="sCompleteDate" class="">23.01.12 09:03:54</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="printSignpad" class="btn btn-primary" onclick="">출력</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>


<!-- recordModal 운행기록/납품기록 -->
<div class="modal fade" id="recordModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <input type="hidden" id="record_type" value="" />
            <input type="hidden" id="record_mb_id" value="" />

            <div id="recordModalBody" class="modal-body">
                <h5 id="recordTitle">업체명 납품기록</h5>

                <div class="admin list" style="min-height: 0px;">
                    <table class="" border="0" width="100%">
                        <colgroup>
                            <col width="70px">
                            <col width="">
                            <col width="100px">
                        </colgroup>
                        <tbody id="recordList">
                            <!--
				    <tr>
                        <th class="">23-01-13</th>
                        <td class="">배송 물품명</td>
                        <td class=""><button type="button" class="btn-5" data-toggle="modal" data-target="#Modal3">인수증 보기</button></td>
                    </tr>
                    <tr>
                        <th class="">23-01-13</th>
                        <td class="">배송 업체명</td>
                        <td class=""><button type="button" class="btn-5" data-toggle="modal" data-target="#Modal3">인수증 보기</button></td>
                    </tr>
-->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal8 배차기록 -->
<div class="modal fade" id="Modal8" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <h5>차량번호 배차기록</h5>

                <div class="admin list" style="min-height: 0px">
                    <table class="" border="0" width="100%">
                        <colgroup>

                            <col width="70px">
                            <col width="">
                        </colgroup>
                        <tr>
                            <th class="">23-01-13</th>
                            <td class="">이름(010-0000-0000)</td>
                        </tr>
                        <tr>
                            <th class="">23-01-13</th>
                            <td class="">이름(010-0000-0000)</td>
                        </tr>
                        <tr>
                            <th class="">23-01-13</th>
                            <td class="">이름(010-0000-0000)</td>
                        </tr>
                        <tr>
                            <th class="">23-01-13</th>
                            <td class="">이름(010-0000-0000)</td>
                        </tr>
                    </table>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>