<!--관리자 주문배송관리-->
<section class="order1">
    <form name="searchFrm" autocomplete="off" method="get">
        <div class="panel">
            <p>총 <span class="green">30,745</span>개 </p>
            <div>
                <input type="date" name="sdt" value="<?=$_GET['sdt']?>" >
                <p>~</p>
                <input type="date" name="edt" value="<?=$_GET['edt']?>" onchange="changeInputDate(this.value)">
            </div>
            <div>
                <span class="select">
                    <input type="radio" id="dtr0" name="dtRange" class="green" value="0" checked="" onclick="changeDateRange(this.value)"><label for="dtr0">전체</label>
                    <input type="radio" id="dtr1" name="dtRange" class="green" value="1" onclick="changeDateRange(this.value)"><label for="dtr1">오늘</label>
                    <input type="radio" id="dtr2" name="dtRange" class="green" value="2" onclick="changeDateRange(this.value)"><label for="dtr2">이번주</label>
                    <input type="radio" id="dtr3" name="dtRange" class="green" value="3" onclick="changeDateRange(this.value)"><label for="dtr3">이번달</label>
                    <input type="radio" id="dtr4" name="dtRange" class="green" value="4" onclick="changeDateRange(this.value)"><label for="dtr4">지난달</label>
                </span>
            </div>
            <div>
                <select name="sfl">
                    <option value="oName">주문자명</option>
                    <option value="ordNo">주문번호</option>
                    <option value="rId">주문자아이디</option>
                    <option value="ptName">환자명</option>
                    <option value="cName">병원명</option>
                    <option value="item">상품명</option>
                </select>
                <input class="search-bar" name="stx" type="search" value="" placeholder="검색어를 입력하세요">
                <button type="submit" class="btn_search"><i class="fa-light fa-magnifying-glass"></i></button>
            </div>
            <span>
                <!--<button type="button" class="btn btn_grayw2 " onclick="orderExcelDownModal();">주문내역 다운</button>
                <button type="button" class="btn btn_black" onclick="commonExcelDownload('pxOrderProductTracking')">택배 송장</button>
                <button type="button" class="btn btn_sky" onclick="location.href='/file/download?path=/file/invoice_form.xlsx'">송장 업로드 양식 다운로드</button>
                <button type="button" class="btn btn_blue " onclick="document.querySelector('input[name=file]').click()">송장 업로드</button>-->
            </span>
            <div class="hide">
                <input type="file" name="file" onchange="commonExcelUpload(this, 'trackingNo')">
            </div>
        </div>
        <div class="box">
            <div class="tagbox">
            <div>
                <p><strong>그룹</strong></p>
            </div>
            <div class="group">
                <input type="hidden" name="groupIdxList" value="">
                <span>
                <input type="checkbox" name="group" id="g1" value="1">
                <label for="g1">해밀</label>
            </span>
                <span>
                <input type="checkbox" name="group" id="g2" value="2">
                <label for="g2">하늘체</label>
            </span>
                <span>
                <input type="checkbox" name="group" id="g3" value="3">
                <label for="g3">후한의원</label>
            </span>
                <span>
                <input type="checkbox" name="group" id="g4" value="4">
                <label for="g4">다이어트</label>
            </span>
                <span>
                <input type="checkbox" name="group" id="g5" value="5">
                <label for="g5">경희</label>
            </span>
                <span>
                <input type="checkbox" name="group" id="g6" value="6">
                <label for="g6">대구(잘보는)</label>
            </span>
                <span>
                <input type="checkbox" name="group" id="g9" value="9">
                <label for="g9">대구</label>
            </span>
                <span>
                <input type="checkbox" name="group" id="g12" value="12">
                <label for="g12">용인한방</label>
            </span>
                <span>
                <input type="checkbox" name="group" id="g13" value="13">
                <label for="g13">네트워크일반</label>
            </span>
                <span>
                <input type="checkbox" name="group" id="g14" value="14">
                <label for="g14">마야구(뜸)</label>
            </span>
                <span>
                <input type="checkbox" name="group" id="g15" value="15">
                <label for="g15">자연안에</label>
            </span>
                <span>
                <input type="checkbox" name="group" id="g17" value="17">
                <label for="g17">부천</label>
            </span>
                <span>
                <input type="checkbox" name="group" id="g18" value="18">
                <label for="g18">인애</label>
            </span>
                <span>
                <input type="checkbox" name="group" id="g19" value="19">
                <label for="g19">몸앤장한의원</label>
            </span>
                <span>
                <input type="checkbox" name="group" id="g21" value="21">
                <label for="g21">하늘애</label>
            </span>
                <span>
                <input type="checkbox" name="group" id="g22" value="22">
                <label for="g22">설명</label>
            </span>
                <span>
                <input type="checkbox" name="group" id="g25" value="25">
                <label for="g25">광덕안정</label>
            </span>
                <span>
                <input type="checkbox" name="group" id="g26" value="26">
                <label for="g26">광덕안정2</label>
            </span>
                <span>
                <input type="checkbox" name="group" id="g27" value="27">
                <label for="g27">허정</label>
            </span>
            </div>
            <dl class="search">
                <dt>주문상태</dt>
                <dd>
                    <select name="status">
                        <option value="" selected="">전체</option>
                        <option value="R">주문접수</option>
                        <option value="I">배송준비중</option>
                        <option value="DI">배송중</option>
                        <option value="DC">배송완료</option>
                        <option value="C">주문취소</option>
                    </select>
                </dd>
                <dt>결제수단</dt>
                <dd>
                    <select name="method">
                        <option value="" selected="">전체</option>
                        <option value="CARD">카드결제</option>
                        <option value="CASH">현금결제</option>
                        <option value="VBANK">가상계좌</option>
                        <option value="CREDIT">월말결제</option>
                    </select>
                </dd>
                <!--<dt>카테고리</dt>
                <dd>
                    <select name="cate">
                        <option value="" selected="">전체</option>
                        <option value="CA02">한방약재</option>
                        <option value="CA03">기획전</option>
                        <option value="CA04">할인상품</option>
                    </select>
                </dd>-->
            </dl>
            &nbsp;
            <button type="button" class="btn btn_gray btn_h40" onclick="location.href='/adm/orderProduct'">초기화</button>
        </div>
        </div>
    </form>

    <!--<div class="boxline caption">
        <dl>
            <dt>※ 주문상태</dt>
            <dd>주문상태가 주문접수/배송준비중 일 때, 택배사 변경시 <span>배송중</span>으로 변경됨</dd>
            <dd>주문접수 후 1주일이 경과하면 <span>배송완료</span>로 변경됨 (주문취소 제외)</dd>
        </dl>
    </div>-->

    <div class="boxline">
        <div class="flex">
            <span class="tooltip-container">
                <button type="button" class="btn btn_gray" id="modifyList">일괄 수정</button>
                <span class="tooltip right">버튼을 클릭하면 체크된 항목의<br>주문상태 / 배송정보를 일괄 수정합니다.</span>
            </span>
        </div>
        <div class="table adm">
            <table class="order">
                <colgroup>
                    <col style="width: auto">
                    <col style="width: auto">
                    <col style="width: auto">
                    <col style="width: 12%"><!--병원명-->
                    <col style="width: 8%"><!--주문상태-->
                    <col style="width: 15%"><!--주문번호-->
                    <col style="width: auto"><!--주문자정보-->
                    <col style="width: 8%"><!--결제수단-->
                    <col style="width: 8%"><!--주문금액-->
                    <col style="width: auto"><!--복용법-->
                    <col style="width: auto">
                </colgroup>
                <thead>
                <tr>
                    <th rowspan="2"><input type="checkbox" onclick="selectAllCheckbox(this, 'checkIdx')"></th>
                    <th rowspan="2">번호</th>
                    <th rowspan="2">주문일</th>
                    <th rowspan="2">병원명<br>(원장)</th>
                    <th>주문상태</th>
                    <th>주문번호</th>
                    <th>주문자정보</th>
                    <th rowspan="2">출고일자</th>
                    <th rowspan="2">결제수단</th>
                    <th rowspan="2">주문금액</th>
                    <th rowspan="2">관리</th>
                </tr>
                <tr>
                    <th>주문취소요청</th>
                    <th>상품명</th>
                    <th>배송정보</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td rowspan="2"><input type="checkbox" name="checkIdx" value="110412"></td>
                    <td rowspan="2">30745</td>
                    <td rowspan="2" class="txt_bold">23.07.24</td>
                    <td rowspan="2">무주한의원<br>(이현승)</td>
                    <td>
                        <select name="status[110412]" onchange="selectRowCheckbox(110412)">
                            <option value="R" selected="">주문접수</option>
                            <option value="I">배송준비중</option>
                            <option value="DI">배송중</option>
                            <option value="DC">배송완료</option>
                            <option value="C">주문취소</option>
                        </select>
                    </td>
                    <td>
                        <span class="txt_sky txt_under txt_bold"><a href="<?=PROJECT_URL?>/admOrderView">230724-1420-27056</a></span>
                    </td>
                    <td>
                        <dl class="order_info">
                            <dd><strong>주문자</strong> 이현승</dd>
                            <dd><strong>아이디</strong> mujuhani</dd>
                            <dd><strong>연락처</strong> 063-322-0644</dd>
                            <dd><strong>수령인</strong> 이현승</dd>
                        </dl>
                    </td>
                    <td rowspan="2">23.07.24</td>
                    <td rowspan="2">
                        <div style="margin-bottom: 5px;">카드결제</div>
                    </td>
                    <td rowspan="2">83,660원</td>
                    <td rowspan="2">
                        <button type="button" class="btn btn_black" onclick="location.href='<?=PROJECT_URL?>/admOrderView'">수정</button>
                    </td>
                </tr>
                <tr>
                    <td><strong class="txt_sky">취소요청(07.26)</strong></td>
                    <td>정맥카테터(I.V CATH)g<em> 외 3개</em>                    </td>
                    <td>
                            <div>
                                <select name="courier[110412]" onchange="selectRowCheckbox(110412)">
                                    <option value="">택배사</option>
                                    <option value="01">우체국택배</option>
                                    <option value="06">로젠택배</option>
                                    <option value="04">CJ대한통운</option>
                                    <option value="CQ">퀵서비스</option>
                                    <option value="CD">직접배송</option>
                                    <option value="CE">기타(직접수령)</option>
                                </select>
                            </div>
                            <div><input type="text" name="tno[110412]" placeholder="운송장번호 입력" value="" maxlength="50"></div>

                        <div class="track_btn_area text_left">
                        </div>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <? include_once VIEWPATH. 'component/pagination.php'; // 페이징?>
    </div>
</section>
