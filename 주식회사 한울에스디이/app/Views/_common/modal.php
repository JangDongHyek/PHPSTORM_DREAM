<!-- 프로젝트 이동 -->
<div class="modal fade" id="moveModal" tabindex="-1" aria-labelledby="moveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="moveModalLabel">프로젝트 이동</h5>
            </div>
            <div class="modal-body">
                <div class="form_wrap">
                    <label for="">프로젝트 선택</label>
                    <select>
                        <option>블루 워터 프라자 리모델링</option>
                        <option selected>당진 수정지구 공동 블럭</option>
                        <option>주거다지 개발</option>
                        <option>상업시설 리모델링</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 프로젝트 생성 -->
<div class="modal fade" id="projectFormModal" tabindex="-1" aria-labelledby="projectFormModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="projectFormModalLabel">프로젝트 생성</h5>
            </div>
            <div class="modal-body">
                <div class="form_wrap">
                    <label for="">프로젝트 명</label>
                    <input type="text" name="" id="" placeholder="프로젝트 명"/>
                    <label for="">공사 위치</label>
                    <input type="text" name="" id="" placeholder="공사 위치"/>
                    <p class="flex ai-c jc-sb">
                        <label for="">공사기간</label><span>(총0일)</span>
                    </p>
                    <p class="flex ai-c">
                        <input type="date" /><span>~</span><input type="date" />
                    </p>
                    <label for="">시공사 명</label>
                    <input type="text" name="" id="" placeholder="시공사 명"/>
                    <label for="">비용 예산(억원)</label>
                    <input type="text" name="" id="" placeholder="비용 예산(억원)"/>
                    <label for="">담당자 지정</label>
                    <input type="text" name="" id="" placeholder="담당자 지정" data-toggle="modal" data-target="#pmSearchModal"/>
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>-->
                <button type="button" class="btn btn-primary">생성 완료</button>
            </div>
        </div>
    </div>
</div>

<!-- 담당자 검색 -->
<div class="modal fade" id="pmSearchModal" tabindex="-1" aria-labelledby="pmSearchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="pmSearchModalLabel">담당자 지정</h5>
            </div>
            <div class="modal-body">
                <div class="search_wrap">
                    <div class="flex">
                        <input type="search" name="" id="" placeholder="아이디 or 이름으로 검색해주세요"/>
                        <button type="submit" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
                    </div>
                    <div class="sch_field" id="" style="display: block">
                            <table class="sch_field_tb" id="">
                                <tr>
                                    <th class="txt_bold">안재홍(hanul01)</th>
                                    <td>설계부</td>
                                    <td>사원</td>
                                    <td><button class="btn btn_mini2 btn_line">선택</button></td>
                                </tr>
                                <tr>
                                    <th class="txt_bold">안재홍(hanul01)</th>
                                    <td>설계부</td>
                                    <td>사원</td>
                                    <td><button class="btn btn_mini2 btn_line">선택</button></td>
                                </tr>
                                <tr>
                                    <td colspan="5"><div class="empty">검색 결과가 없습니다.</div></td>
                                </tr>
                            </table>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>-->
                <button type="button" class="btn btn-primary">선택 완료</button>
            </div>
        </div>
    </div>
</div>

<!-- 직원계정 생성 -->
<div class="modal fade" id="employeeFormModal" tabindex="-1" aria-labelledby="employeeFormModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="employeeFormModalLabel">직원계정 등록</h5>
            </div>
            <div class="modal-body">
                <div class="form_wrap">
                    <label for="">아이디</label>
                    <input type="text" name="" id="" placeholder="아이디"/>
                    <label for="">비밀번호</label>
                    <input type="password" name="" id="" placeholder="비밀번호"/>
                    <label for="">비밀번호 확인</label>
                    <input type="password" name="" id="" placeholder="비밀번호 확인"/>
                    <p class="flex ai-c">
                        <select>
                            <option>소속부서</option>
                        </select>
                        <select>
                            <option>직급</option>
                        </select>
                    </p>
                    <label for="">이름</label>
                    <input type="text" name="" id="" placeholder="이름"/>
                    <label for="">연락처</label>
                    <input type="tel" name="" id="" placeholder="연락처"/>
                    <select>
                        <option>권한을 선택해주세요</option>
                        <option>직원</option>
                        <option>관리자</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>-->
                <button type="button" class="btn btn-primary">등록 완료</button>
            </div>
        </div>
    </div>
</div>

<!-- 담당자 계정 생성 -->
<div class="modal fade" id="accountFormModal" tabindex="-1" aria-labelledby="accountFormModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="accountFormModalLabel">담당자 계정 등록</h5>
            </div>
            <div class="modal-body">
                <div class="form_wrap">
                    <label for="">소속사명</label>
                    <input type="text" name="" id="" placeholder="소속사명"/>
                    <label for="">아이디</label>
                    <input type="text" name="" id="" placeholder="아이디"/>
                    <label for="">비밀번호</label>
                    <input type="password" name="" id="" placeholder="비밀번호"/>
                    <label for="">비밀번호 확인</label>
                    <input type="password" name="" id="" placeholder="비밀번호 확인"/>
                    <label for="">이름</label>
                    <input type="text" name="" id="" placeholder="이름"/>
                    <label for="">연락처</label>
                    <input type="tel" name="" id="" placeholder="연락처"/>
                    <label for="">담당</label>
                    <input type="text" name="" id="" placeholder="담당"/>
                    <label for="">비고</label>
                    <input type="text" name="" id="" placeholder="비고"/>
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>-->
                <button type="button" class="btn btn-primary">등록 완료</button>
            </div>
        </div>
    </div>
</div>

<!-- 수량산출서 수량 등록 -->
<div class="modal fade" id="recordFormModal" tabindex="-1" aria-labelledby="recordFormModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="recordFormModalLabel">수량 등록</h5>
            </div>
            <div class="modal-body">
                <div class="form_wrap">
                    <label for="">품명</label>
                    <input type="text" name="" id="" placeholder="품명"/>
                    <label for="">규격</label>
                    <input type="text" name="" id="" placeholder="규격"/>
                    <label for="">단위</label>
                    <input type="text" name="" id="" placeholder="단위"/>
                    <label for="">수량</label>
                    <input type="text" name="" id="" placeholder="수량"/>
                    <label for="">단가</label>
                    <input type="text" name="" id="" placeholder="단가"/>
                    <label for="">금액</label>
                    <input type="text" name="" id="" placeholder="금액"/>
                    <label for="">비고</label>
                    <input type="text" name="" id="" placeholder="비고"/>
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>-->
                <button type="button" class="btn btn-primary">등록 완료</button>
            </div>
        </div>
    </div>
</div>

<!-- 다운로드 모달 -->
<div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="downloadModalLabel">파일 다운로드</h5>
            </div>
            <div class="modal-body">
                <div class="download_wrap">
                   <input type="checkbox"><label>전체 선택</label>
                   <ul>
                       <li>
                           <span><input type="checkbox" /><label>230926_TBN충남교통방송청사신축공사_건축내역서_(2).xlsx</label></span>
                           <button class="btn btn_mini btn_blue">다운로드</button>
                       </li>
                       <li>
                           <span><input type="checkbox" /><label>계룡-갑천2지구 지하주차장_공정별물량_(1).xlsx</label></span>
                           <button class="btn btn_mini btn_blue">다운로드</button>
                       </li>
                       <li>
                           <span><input type="checkbox" /><label>230926_금일 보고서.xlsx</label></span>
                           <button class="btn btn_mini btn_blue">다운로드</button>
                       </li>
                   </ul>
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>-->
                <button type="button" class="btn btn-primary">선택 다운로드</button>
            </div>
        </div>
    </div>
</div>

<!-- 작업구역 관리 -->
<div class="modal fade" id="sectionModal" tabindex="-1" aria-labelledby="sectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="sectionModalLabel">작업 구역 관리</h5>
            </div>
            <div class="modal-body">
                <div class="form_wrap">
                    <label for="">동 정보</label>
                    <div class="flex ai-c">
                        <select>
                            <option>101동</option>
                        </select>
                        <span>~</span>
                        <select>
                            <option>101동</option>
                        </select>
                    </div>
                    <label for="">층 정보</label>
                    <div class="flex ai-c">
                        <input type="text" name="" id="" placeholder="0"/>&nbsp;<span>층</span>
                    </div>
                    <label for="">구역 정보</label>
                    <div class="flex ai-c">
                        <select>
                            <option>A-1</option>
                        </select>
                        <span>~</span>
                        <select>
                            <option>A-20</option>
                        </select>
                    </div>
                    <br>
                    <div class="flex ai-c">
                        <label for="" class="txt_up">공종명 등록</label>&nbsp;&nbsp;
                        <button class="btn btn_mini btn_black">추가</button>
                    </div>
                    <ul>
                        <li class="flex ai-c"><input type="text" placeholder="공종명을 입력하세요"> <button class="btn btn_mini btn_gray">삭제</button></li>
                        <li class="flex ai-c"><input type="text" placeholder="공종명을 입력하세요"> <button class="btn btn_mini btn_gray">삭제</button></li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>-->
                <button type="button" class="btn btn-primary">등록 완료</button>
            </div>
        </div>
    </div>
</div>
