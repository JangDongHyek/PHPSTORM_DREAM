<?php 
    echo view('common/header_adm');
    $pid = "regiAgr";
    $header_name = "약관동의";
?>

<div id="register">
    <div class="box">
        <div class="hd_tit">스마트정비마켓 판매회원 가입</div>
        <div class="tit_wrap">
            <h1>가입을 위해 동의가 필요해요</h1>
        </div>
        <form action="" class="form_wrap agr_form_wrap" id="agree_form" name="agree_form">
            <div class="agr_wrap agr_all">
                <input type="checkbox" id="allAgr">
                <label for="allAgr">
                    <div class="label_tit">
                    <i class="fa-duotone fa-square-check"></i>
                    전체동의
                    </div>
                </label>
            </div>
            <div class="agr_wrap" id="ess_div">
                <p class="txt-sm color-blue">
                    <strong>필수 동의항목</strong>
                </p>
                <input type="checkbox" id="essAgr01" name="essAgr01" value="T">
                <label for="essAgr01">
                    <div class="label_tit">
                        <i class="fa-duotone fa-square-check"></i>
                        <span>
                            <span class="color-blue">(필수)</span>스마트정비 판매회원 이용 약관 동의
                        </span>
                    </div>
                    <a class="text-sm color-gray btn-more">
                        <i class="fa-regular fa-chevron-down"></i>
                    </a>

                    <div class="agr_text"><?php echo view('agr/essAgr01'); ?></div>
                </label>
                <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>

                <input type="checkbox" id="essAgr02" name="essAgr02" value="T">
                <label for="essAgr02">
                    <div class="label_tit">
                        <i class="fa-duotone fa-square-check"></i>
                        <span>
                            <span class="color-blue">(필수)</span>
                         전자금융거래 이용 약관
                        </span>
                    </div>
                    <a class="text-sm color-gray btn-more">
                        <i class="fa-regular fa-chevron-down"></i>
                    </a>
                    <div class="agr_text"><?php echo view('agr/essAgr02'); ?></div>
                </label>
                <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>

                <input type="checkbox" id="essAgr03" name="essAgr03" value="T">
                <label for="essAgr03">
                    <div class="label_tit">
                        <i class="fa-duotone fa-square-check"></i>
                        <span>
                            <span class="color-blue">(필수)</span>
                          개인정보 수집 및 이용에 관한 사항 동의
                        </span>
                    </div>
                    <a class="text-sm color-gray btn-more">
                        <i class="fa-regular fa-chevron-down"></i>
                    </a>
                    <div class="agr_text"><?php echo view('agr/essAgr03'); ?></div>
                </label>
                <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>

                <input type="checkbox" id="essAgr04" name="essAgr04" value="T">
                <label for="essAgr04">
                    <div class="label_tit">
                        <i class="fa-duotone fa-square-check"></i>
                        <span>
                            <span class="color-blue">(필수)</span>
                          스마트정비 마켓 판매회원의 개인정보보호 준수사항의 동의
                        </span>
                    </div>
                    <a class="text-sm color-gray btn-more">
                        <i class="fa-regular fa-chevron-down"></i>
                    </a>
                    <div class="agr_text"><?php echo view('agr/essAgr04'); ?></div>
                </label>
                <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>
                
                <input type="checkbox" id="un_essAgr02" name="un_essAgr02"  <?= get_checked($market_discount_agreement, "T")?>>
                <label for="un_essAgr02">
                    <div class="label_tit">
                        <i class="fa-duotone fa-square-check"></i>
                        <span>
                            <span class="color-blue">(선택)</span>
                            마켓 할인 지원(스마트정비 마켓서비스) 프로그램 동의
                        </span>
                    </div>
                    <a class="text-sm color-gray btn-more">
                        <i class="fa-regular fa-chevron-down"></i>
                    </a>
                    <div class="agr_text"><?php echo view('agr/sell_Agr01'); ?></div>
                </label>
                <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>

                <div class="box__section section-termsbox">
                    <div class="box__service-info js-expanded-active">
                        <button type="button" class="btn-more button__terms-more sprite__signup-seller--after" aria-expanded="true" aria-haspopup="true">
                            마켓 할인 지원(스마트정비 마켓서비스) 안내<i class="ic_arrow"></i>
                        </button>
                        <div class="box__terms-cont box__expanded-cont" aria-hidden="false">
                            <dl class="list__service-info">
<!--                                <dt class="list-title">스마트정비 마켓서비스 안내</dt>-->
<!--
                                <dd class="list-cont">
                                    <ul class="list__default"><?php echo view('agr/market_service'); ?></ul>
                                </dd>
-->
                               
                             <dd><img src="/img/common/agr_market_service.png" alt=""></dd>
                                
                            </dl>
                        </div>
                    </div>
                </div>
                
                
                
                <input type="checkbox" id="essAgr05" name="essAgr05" value="T">
                <label for="essAgr05">
                    <div class="label_tit">
                        <i class="fa-duotone fa-square-check"></i>
                           본인은 현재 스마트정비 판매 사업자 등록을 하지않은 사실을 확인합니다
                    </div>
                </label>
                <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>
                
                
                
            </div>
            <div class="agr_wrap" id="ess_div">
                
                <p class="txt-sm color-blue">
                    <strong>선택 동의항목</strong>
                </p>
                <input type="checkbox" id="un_essAgr01" name="un_essAgr01" <?= get_checked($privacy_collection_agreement, "T")?>>
                <label for="un_essAgr01">
                    <div class="label_tit">
                        <i class="fa-duotone fa-square-check"></i>
                        <span>
                            <span class="color-blue">(선택)</span>
                             개인정보 수집 및 이용에 관한 사항 동의
                        </span>
                    </div>
                    <a class="text-sm color-gray btn-more">
                        <i class="fa-regular fa-chevron-down"></i>
                    </a>
                    <div class="agr_text"><?php echo view('agr/un_essAgr01'); ?></div>
                </label>
                <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>
<!--
                <input type="checkbox" id="essAgr01">
                <label for="essAgr01">
                    <div class="label_tit">
                        <i class="fa-duotone fa-square-check"></i>
                         G마켓 구매회원 이용약관
                    </div>
                    <a class="text-sm color-gray" href="https://signup.esmplus.com/signup/terms/gmktBuyerTermsPolicy" target="_blank">
                        <i class="fa-regular fa-chevron-right"></i>
                    </a>
                </label>
                
                <input type="checkbox" id="essAgr02">
                <label for="essAgr02">
                    <div class="label_tit">
                        <i class="fa-duotone fa-square-check"></i>
                         G마켓 판매회원 이용약관
                    </div>
                    <a class="text-sm color-gray" href="https://signup.esmplus.com/signup/terms/gmktSellerTermsPolicy" target="_blank">
                        <i class="fa-regular fa-chevron-right"></i>
                    </a>
                </label>
                
                <input type="checkbox" id="essAgr03">
                <label for="essAgr03">
                    <div class="label_tit">
                        <i class="fa-duotone fa-square-check"></i>
                          옥션 이용약관
                    </div>
                    <a class="text-sm color-gray" href="https://signup.esmplus.com/signup/terms/auctionProvision" target="_blank">
                        <i class="fa-regular fa-chevron-right"></i>
                    </a>
                </label>
                
                <input type="checkbox" id="essAgr04">
                <label for="essAgr04">
                    <div class="label_tit">
                        <i class="fa-duotone fa-square-check"></i>
                          ESM PLUS 이용약관
                    </div>
                    <a class="text-sm color-gray" href="https://signup.esmplus.com/signup/terms/esmplusPolicy" target="_blank">
                        <i class="fa-regular fa-chevron-right"></i>
                    </a>
                </label>
                
                <input type="checkbox" id="essAgr05">
                <label for="essAgr05">
                    <div class="label_tit">
                        <i class="fa-duotone fa-square-check"></i>
                          전자 금융서비스 이용약관
                    </div>
                    <a class="text-sm color-gray" href="https://signup.esmplus.com/signup/terms/financeTermsPolicy" target="_blank">
                        <i class="fa-regular fa-chevron-right"></i>
                    </a>
                </label>
                
                <input type="checkbox" id="essAgr06">
                <label for="essAgr06">
                    <div class="label_tit">
                        <i class="fa-duotone fa-square-check"></i>
                           개인정보 수집 및 이용
                    </div>
                    <a class="text-sm color-gray" href="#anchor-termsment4">
                        <i class="fa-regular fa-chevron-right"></i>
                    </a>
                </label>
                
                <input type="checkbox" id="essAgr07">
                <label for="essAgr07">
                    <div class="label_tit">
                        <i class="fa-duotone fa-square-check"></i>
                           세금납부 관련 유의사항 확인
                    </div>
                    <a class="text-sm color-gray" href="#anchor-termsment5">
                        <i class="fa-regular fa-chevron-right"></i>
                    </a>
                </label>
                
                <input type="checkbox" id="essAgr08">
                <label for="essAgr08">
                    <div class="label_tit">
                        <i class="fa-duotone fa-square-check"></i>
                           만 14세 이상입니다
                    </div>
                </label>
-->
                
            </div>
            
<!--
            <div class="agr_wrap">
                <p class="txt-sm color-blue">
                    <strong>선택 동의항목</strong>
                </p>
                
                
                <input type="checkbox" id="un_essAgr02" name="un_essAgr02"  <?= get_checked($market_discount_agreement, "T")?>>
                <label for="un_essAgr02">
                    <div class="label_tit">
                        <span class="color-blue">(권장)</span>
                        마켓할인 지원 프로그램 서비스 동의
                    </div>
                    <i class="fa-duotone fa-square-check"></i>
                </label>

                <input type="checkbox" id="un_essAgr03" name="un_essAgr03" <?= get_checked($credit_card_promotion_agreement, "T")?>>
                <label for="un_essAgr03">
                    <div class="label_tit">
                        <span class="color-blue">(권장)</span>
                        신용카드사 제휴채널 프로모션 서비스 동의
                    </div>
                    <i class="fa-duotone fa-square-check"></i>
                </label>

                <input type="checkbox" id="un_essAgr01">
                <label for="un_essAgr01">
                    <div class="label_tit">
                        <i class="fa-duotone fa-square-check"></i>
                         개인정보 수집 및 이용
                    </div>
                    <a class="text-sm color-gray" href="#anchor-termsment6">
                        <i class="fa-regular fa-chevron-right"></i>
                    </a>
                </label>
                
                <input type="checkbox" id="un_essAgr02">
                <label for="un_essAgr02">
                    <div class="label_tit">
                        <i class="fa-duotone fa-square-check"></i>
                          혜택 알림 이메일, 문자, 앱 푸시 수신
                    </div>
                    <a class="text-sm color-gray" href="">
                        <i class="fa-regular fa-chevron-right"></i>
                    </a>
                </label>
                
                
                
            </div>
-->
            
            <div class="guide_wrap">
                <p class="">혜택 알림 이메일, 문자, 앱 푸시 수신 (선택) 동의는 개인정보 수집 및 이용 (선택) 동의가 필수입니다. 개인정보 수집 및 이용 (선택) 동의는 광고성 정보 수신 동의 목적으로만 활용됩니다.</p>
                <p>개인정보의 수집 및 이용 동의를 거부할 권리가 있습니다, 다만 동의를 거부하시는 경우 필수동의 거부시에는 가입이 불가능하며, 선택동의 거부시에는 일부서비스이용이 제한 될수있습니다.</p>
            </div>
            <div id="anchor-termsment" class="box__terms-important" style="display:none;">
              <button type="button" class="button__terms-more sprite__signup-seller--after" aria-expanded="false" aria-haspopup="true">
              약관 주요사항 고지
              <i class="fa-regular fa-chevron-down"></i>
              </button>
              <div class="box__terms-cont" aria-hidden="true">
                <div class="box__form-terms">
                  <p class="text__form-terms--notice">약관전문은 위의 이용약관 항목에 약관전체보기로 전문이 게시되어있습니다.</p>

                  <h5 id="anchor-termsment1" class="text__form-terms--title">(필수) G마켓 구매회원 이용약관</h5>
                  <div class="box__form-terms--group">
                    <ol class="list__decimal">
                      <li>회원의 주소 또는 e-mail주소에 도달함으로써 회사의 통지는 유효하고, 회원 정보의 변경/미 변경에 대한 책임은 회원에게 있음. (제8조)</li>
                      <li>약관이 정하는 부정거래 행위를 한 회원에 대하여 제재 조치 가능 예: 직거래, 경매 부정행위, 시스템 부정행위, 결제 부정행위, 재판매 목적의 거래행위 등. (제36조)</li>
                      <li>G마켓은 통신판매중개자로서 판매자와 구매자와의 거래에 관한 분쟁에 개입하지 않으며 어떠한 보증 및 책임도 부담하지 않음. (제6조, 제38조)</li>
                    </ol>
                  </div>

                  <h5 id="anchor-termsment2" class="text__form-terms--title">(필수) 옥션 이용약관</h5>
                  <div class="box__form-terms--group">
                    <ol class="list__decimal">
                      <li>회원에 대한 통지는 회원정보에 기재된 주소 또는 e-mail주소에 도달함으로써 통지된 것으로 보며, 정보 수정/미수정으로 인한 책임은 회원이 부담함. (제12조)</li>
                      <li>회원자격이 정지되거나 경매서비스(일반경매, 즉시구매, 고정가판매 및 공동경매 포함)의 이용 등이 제한될 수 있음. (제15조)</li>
                      <li>구매자는 물품 수령 후 7일 이내 물품의 반품 또는 교환 요청 가능. (제26조 마항)</li>
                      <li>판매예치금에서 회사에 대한 채무금을 우선 출금 및 구매자의 정당한 요청에 판매예치금에서 출금하여 구매자에게 환불 가능. (제27조의2)</li>
                      <li>서비스 제공 대가로 등록서비스이용료, 유료부가서비스이용료, 판매서비스이용료 등을 부과할 수 있음. (제30조)</li>
                      <li>옥션은 통신판매중개자로서 회원 상호간의 거래에 관여하지 않으며 어떠한 보증 및 책임도 부담하지 않음. (제16조, 제31조)</li>
                    </ol>
                  </div>

                  <h5 id="anchor-termsment3" class="text__form-terms--title">(필수) 전자금융 서비스 이용약관</h5>
                  <div class="box__form-terms--group">
                    <ol class="list__decimal">
                      <li>접근매체의 양도 · 양수, 대여 · 사용위임, 질권설정 기타 담보 제공 및 이의 알선과 접근매체를 제3자에게 누설 · 노출,방치하는 것은 금지됨. (제17조, 제21조, 제23조)</li>
                      <li>소비자가 재화 등을 공급받은 날부터 3 영업일이 지나도록 정당한 사유의 제시 없이 그 공급받은 사실을 통보하지 않는 경우 소비자의 동의 없이 판매자에게 결제대금을 지급할 수 있으며, 회사가 결제대금을 지급하기 전에 소비자가 그 결제대금을 환급 받을 사유가 발생한 경우 이를 소비자에게 환급함. (제19조)</li>
                      <li>이용자의 선불전자지급수단 잔액이 구매 취소 등의 사유 발생으로 회사가 이용자로부터 환수해야 하는 환수 대상액보다 작을 경우 회사는 당해 이용자의 선불전자지급수단을 마이너스로 처리할 수 있음. (제27조)</li>
                    </ol>
                  </div>
                  <h5 id="anchor-termsment4" class="text__form-terms--title">(필수) 개인정보 수집 및 이용</h5>
                  <div class="box__form-terms--table">
                    <table class="form__table--terms" summary="(필수) 개인정보 수집 및 이용 목적, 항목">
                      <caption>(필수) 개인정보 수집 및 이용의 표</caption>
                      <thead>
                      <tr>
                        <th scope="col">목적</th>
                        <th scope="col">항목</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td>본인여부 확인을 위한 기본정보, 통합사이트 회원 SSO연동, 계약이행 및 약관 변경 등의 고지를 위한 연락, 본인의사확인 및 민원 등의 고객불만처리</td>
                        <td>이름,ID,비밀번호,비밀번호힌트 질문/답변, 휴대폰번호,휴대폰소유자이름(대표자/담당자중 택1),고객문의연락처(미니샵/스토어노출용),팩스번호,이메일주소</td>
                      </tr>
                      <tr>
                        <td>개인/사업자 회원 본인확인</td>
                        <td>이름, 성별, 생년월일, 휴대폰번호, CI/DI, 아이핀 인증결과, 통신사, 내/외국인정보, 서비스이용기록, 기기정보, 인감증명서(국내 사업자 회원의 경우만)</td>
                      </tr>
                      <tr>
                        <td>해외사업자회원 가입시 확인을 위한 추가정보</td>
                        <td>대표자신분증, 국가</td>
                      </tr>
                      <tr>
                        <td>판매회원 서비스 제공</td>
                        <td>담당자이름,담당자전화번호,담당자 이메일주소</td>
                      </tr>
                      <tr>
                        <td>국내 판매 회원 정산</td>
                        <td>은행명,계좌번호,계좌주,G통장 비밀번호/판매예치금 비밀번호</td>
                      </tr>
                      <tr>
                        <td>해외 사업자 판매 회원 정산</td>
                        <td>국가, 은행명, 스위프트코드, 지점명, 계좌번호, 계좌주, 계좌개설 증빙자료, G통장 비밀번호/판매예치금 비밀번호</td>
                      </tr>
                      <tr>
                        <td>정산시 연락 및 안내 등을 위한 담당자 확인</td>
                        <td>담당자이름,담당자휴대폰번호,담당자 이메일주소</td>
                      </tr>
                      <tr>
                        <td>부정 이용 방지, 비인가 사용 방지, 서비스 제공 및 계약의 이행</td>
                        <td>방문일시, 서비스 이용 기록 및 기기정보</td>
                      </tr>
                      <tr>
                        <td>부정거래의 배제 (가입 후 부정거래가 확인된 경우만)</td>
                        <td>ID, 이름, 휴대폰번호, 이메일주소, 전화번호, 생년월일, CI/DI, 부정거래사유, 탈퇴 시 회원 상태값</td>
                      </tr>
                      <tr>
                        <td>맞춤형 서비스 제공, 서비스 이용 실적 통계·분석 및 설문을 통한 신규서비스 개발 및 품질 개선</td>
                        <td>필수/선택항목에서 수집한 모든항목, 서비스 이용기록, 기기정보</td>
                      </tr>
                      <tr>
                        <td colspan="2"><strong>보유기간 : 회원탈퇴 후 5일 이내 또는 법령에따른 보존기간 (단, 부정거래 확인 시 회원탈퇴 후 1년)</strong></td>
                      </tr>
                      </tbody>
                    </table>
                  </div>

                  <h5 id="anchor-termsment5" class="text__form-terms--title">(필수) 세금납부 관련 유의사항 확인(필수)</h5>
                  <div class="box__form-terms--group">
                    <ul class="list__star">
                      <li>*지속적으로 G마켓과 옥션을 통해 물품을 판매하는 판매자는 사업자 등록 후 물품을 판매하셔야 합니다.</li>
                      <li>*사업자 등록은 사업 개시 후 20일 이내에 사업장 소재지 관할 세무서에서 신청하시면 됩니다.</li>
                      <li>*사업자 등록 없이 사업을 영위하는 경우 다음과 같은 가산세 부담 등의 불이익을 받게 됩니다.</li>
                      <li>*만약 사업자 등록없이 지속적으로 물품을 판매할 경우 다음과 같은 불이익을 받으실 수 있음을 알려드립니다.
                        <ol class="list__decimal">
                          <li>사업자등록 없이 이루어진 거래에 대하여 공급가액의 1% (간이과세자는 공급대가의0.5%) 미등록 가산세 부담</li>
                          <li>사업자등록 없이 사업을 영위하는 경우, 세금계산서의 교부가 불가능하며 관련 매입세액을 공제받을 수 없음</li>
                          <li>사업자등록을 하지 아니하여 부가가치세를 신고하지 못한 사업장의 거래에 대하여는 신고불성실 가산세와 납부불성실 가산세 추가 부담
                            <ul class="list__dash">
                              <li>신고불성실 가산세: 무신고,과소신고의 경우 신고하지 아니한 납부세액의 10% 가산세 부담</li>
                              <li>납부불성실 가산세: 무납부,과소납부의 경우 미납부 또는 과소 납부세액의 1일 0.03%(연간 10.95%)의 가산세 부담</li>
                            </ul>
                          </li>
                          <li>소득세를 신고하지 않은 경우 신고불성실 가산세와 납부불성실 가산세 추가 부담(주민세 별도10%)
                            <ul class="list__dash">
                              <li>신고불성실가산세: 산출세액에서 무신고나 과소신고 해당 비율에 대하여 20% 가산세 부담</li>
                              <li>납부불성실 가산세: 무납부,과소납부의 경우 미납부 또는 과소 납부세액의 1일 0.03%(연간 10.95%)의 가산세 부담</li>
                            </ul>
                          </li>
                          <li>상기 불이익 이외에 조세범처벌법 등 관련법규에 따라 처벌</li>
                          <li>또한, G마켓과 옥션 물품을 판매한 모든 판매자들의 판매자료(현금영수증 발행내역과 카드결제내역)는 국세청의 요청에 따라 제공될 수 있음을 알려드립니다. <br>특히 과세기간(6개월)동안 판매대금이 600만원 이상인 고객께서는 반드시 사업자 등록을 해주시기 바랍니다.</li>
                        </ol>
                      </li>
                    </ul>
                  </div>

                  <h5 id="anchor-termsment6" class="text__form-terms--title">(선택) 개인정보 수집 및 이용</h5>
                  <div class="box__form-terms--table">
                    <table class="form__table--terms" summary="(선택) 개인정보 수집 및 이용, 목적, 항목">
                      <caption>(선택) 개인정보 수집 및 이용의 표</caption>
                      <thead>
                      <tr>
                        <th scope="col">목적</th>
                        <th scope="col">항목</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td>마케팅 목적의 혜택 정보 제공</td>
                        <td>이름, 아이디, 성별, 생년월일, 휴대폰 번호, 이메일 주소, 서비스이용기록, 기기정보	</td>
                      </tr>
                      <tr>
                        <td colspan="2"><strong>보유기간 : 회원탈퇴 후 5일 이내 또는 법령에따른 보존기간</strong></td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="agr_wrap agr_all">
                <input type="checkbox" id="allAgr">
                <label for="allAgr">
                    <div class="label_tit">
                    <i class="fa-duotone fa-square-check"></i>
                    전체동의
                    </div>
                </label>
            </div>
            
        </form>

       <div class="btn_wrap">
        <button type="button" onclick="" class="btn btn-gray btn-canc">취소</button>
        <button type="button" onclick="chk_agreeForm()" class="btn btn-blue btn-comp">확인</button>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
//        약관 열고닫기
        $('.agr_wrap > label').click(function(){
            $(this).children('.agr_text').slideToggle();
            $(this).find('.fa-chevron-down').toggleClass('active');
        });
        
        
        $('.button__terms-more').click(function(){
            $(this).find('i').toggleClass('active');
            $(this).next('.box__terms-cont').toggleClass('active');
        });

        $('#allAgr').change(function() {
            var isChecked = $(this).is(':checked');
            $('input[type="checkbox"]').prop('checked', isChecked);
        });
    });

    let isAjaxIng = false;
    function chk_agreeForm() {
        if(isAjaxIng) {
            return false;
        }
        isAjaxIng = true;
        $('.msg-text').hide();

        //삭제해야함
        if("<?=$pass?>" == "T"){
            location.href = "<?=base_url('/signup/infoSeller')?>";
        }


        let is_checked = $("#un_essAgr01").is(':checked');
        let privacy_collection_agreement = "F";
        if(is_checked){
            privacy_collection_agreement = "T";
        }

        let un_essAgr01_checked = $("#un_essAgr02").is(':checked');
        let market_discount_agreement = 'F';
        if(un_essAgr01_checked) {
            market_discount_agreement = 'T';
        }

        let un_essAgr02_checked = $("#un_essAgr03").is(':checked');
        let credit_card_promotion_agreement  = 'F';
        if(un_essAgr02_checked) {
            credit_card_promotion_agreement  = 'T';
        }

        let formData = new FormData($('#agree_form')[0]);
        formData.append("privacy_collection_agreement",privacy_collection_agreement);
        formData.append("market_discount_agreement",market_discount_agreement);
        formData.append("credit_card_promotion_agreement",credit_card_promotion_agreement);

        $.ajax({
            url: '<?= base_url("signup/chkAgreeForm")?>',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if(data.code == 200){
                    location.href = "<?=base_url('/signup/infoSeller')?>";
                } else {
                    err_msg(data.err_id, data.msg);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
            },
            complete: function(jqXHR, textStatus) {
                isAjaxIng = false;
            }
        });
    }
</script>

<?php echo view('common/footer'); ?>
