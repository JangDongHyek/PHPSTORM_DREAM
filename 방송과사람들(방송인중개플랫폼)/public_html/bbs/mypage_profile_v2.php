<?
include_once('./_common.php');
$name = "cmypage";
$pid = "mypage_form";
$g5['title'] = '전문가 프로필관리';
include_once('./_head.php');

$mb = get_member($member[mb_id]);

if($mb == null) alert("로그인 해주세요", G5_URL);

?>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
<style>
    @media screen and (max-width:1024px) {
        #area_my{display: none;}
        #ft{display: none;}
    }


    /*프로필 스텝위자드*/
    #profile_form.tab-content{margin: 0; padding: 0;}
    .sw>.progress{margin-bottom: 4px;}
    .sw>.progress>.progress-bar{background: #0c0cba;}

    .sw-theme-basic{border: 0;}
    .sw-theme-basic>.nav .nav-link{margin-right: 0; display: flex;align-items: center; padding: 1rem;}
    .sw>.nav .nav-link>span{line-height: 1.2em;}
    .sw-theme-basic>.nav .nav-link.active{background:#0c0cba; color: #fff!important;}
    .sw-theme-basic>.nav .nav-link.active::after{background:#0c0cba!important;}
    .sw-theme-basic>.nav .nav-link.done{color: #ccc!important; background: #eee;}
    .sw-theme-basic>.nav .nav-link.done::after{background: #ddd;}

    .sw>.tab-content>.tab-pane{visibility:visible; min-height: 200px; padding: 2rem;}
    .sw>.tab-content>.tab-pane{}

    #smartwizard .btn_confirm{display: flex; gap: 4px; padding: 0.5em 1em;}
    #smartwizard .btn_confirm button{width: 100%; height: auto}
    #smartwizard .btn_confirm .btn_submit{width: 100%; border-radius: 5px!important; padding:13px 10px; font-size: 15px!important; letter-spacing:-0.2px!important; font-weight: 500; background: #0c0cba}

    @media screen and (max-width:1024px) {
        #smartwizard .btn_confirm{position: fixed; background: #fff; width: 100%; left: 0; bottom: 0; z-index: 998;}

    }
    @media screen and (max-width: 640px){
        .sw>.nav{flex-direction: unset!important; flex-wrap:nowrap;}
        .sw>.nav .nav-link>span{display: none;}
        .sw-theme-basic>.nav .nav-link{margin-right: 0; text-align: center;}
        .sw>.nav .nav-link>.num {
            font-size: 1em;
            text-align: center;
            width: 100%;
        }
    }
</style>

    <div id="area_mypage" class="profile">
		<div class="inr">
			<div id="mypage_wrap">
				<?php include_once('./mypage_info.php'); ?>

				<div class="mypage_cont">
					<div class="box">
						<h3><?= ($member["mb_level"] > '2') ? "전문가 프로필" : "프로필 관리" ?></h3>

                        <!--재작업-->
                        <!-- SmartWizard html -->
                        <div id="smartwizard">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <ul class="nav">
                                <li class="nav-item"><a class="nav-link" href="#step-1"><div class="num">1</div> <span>기본정보</span></a></li>
                                <li class="nav-item"><a class="nav-link" href="#step-2"><div class="num">2</div> <span>전문/상세분야</span></a></li>
                                <li class="nav-item"><a class="nav-link" href="#step-3"><div class="num">3</div> <span>학력 전공/자격증</span></a></li>
                                <li class="nav-item"><a class="nav-link" href="#step-4"><div class="num">4</div> <span>경력기간/사항</span></a></li>
                                <li class="nav-item"><a class="nav-link" href="#step-5"><div class="num">5</div> <span>희망 시급</span></a></li>
                                <li class="nav-item"><a class="nav-link" href="#step-6"><div class="num">6</div> <span>상주 여부</span></a></li>
                                <li class="nav-item"><a class="nav-link" href="#step-7"><div class="num">7</div> <span>프로젝트 이력</span></a></li>
                            </ul>

                            <div id="profile_form" class="tab-content">
                                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    <div>
                                        <h4>기본정보</h4>
                                        <dl>
                                            <dt>닉네임</dt>
                                            <dd><input type="text" id="mb_nick" placeholder="활동명 or 회사명" value="<?=$member['mb_nick']?>"></dd>
                                        </dl>
                                        <dl>
                                            <dt>연락 가능한 번호</dt>
                                            <dd><input type="text" id="" placeholder="000-0000-0000" value=""></dd>
                                        </dl>

                                        <dl>
                                            <dt>연락 가능 시간 설정</dt>
                                            <dd>
                                                <div class="flex">
                                                    <select name="call_hour_1" class="select text-center" id="call_hour_1" title="시간">
                                                        <option value="">시간</option>
                                                        <?php
                                                        for ($i = 1; $i <= 24; $i++) {
                                                            $selected = ($member['start_time_h'] == $i) ? 'selected' : '';
                                                            echo '<option value="' . sprintf("%02d", $i) . '" ' . $selected . '>' . sprintf("%02d", $i) . '시</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <span>-</span>
                                                    <select name="call_hour_2" class="select text-center" id="call_hour_2" title="시간">
                                                        <option value="">시간</option>
                                                        <?php
                                                        for ($i = 1; $i <= 24; $i++) {
                                                            $selected = ($member['end_time_h'] == $i) ? 'selected' : '';
                                                            echo '<option value="' . sprintf("%02d", $i) . '" ' . $selected . '>' . sprintf("%02d", $i) . '시</option>';
                                                        }
                                                        ?>
                                                    </select>

                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>안심번호</dt>
                                            <dd><input type="text" placeholder="서비스를 등록하시면 자동으로 부여됩니다." disabled></dd>
                                        </dl>
                                        <dl>
                                            <dt>안심번호 공개여부</dt>
                                            <dd class="select">
                                                <input type="radio" id="only_clients" name="security_number" disabled>
                                                <label for="only_clients">내 서비스를 결제한 의뢰인에게만 공개</label>
                                                <input type="radio" id="all_members" name="security_number" disabled>
                                                <label for="all_members">미결제 회원에게도 공개</label>
                                            </dd>
                                        </dl>
                                    </div>
                                    <div>
                                        <h4>인증정보</h4>
                                        <dl>
                                            <dt>실명</dt>
                                            <dd><input type="text" id="" placeholder="실명 입력" value=""></dd>
                                        </dl>
                                        <dl>
                                            <dt>주민등록번호</dt>
                                            <dd><input type="text" id="" maxlength="13" placeholder="주민등록번호 입력"></dd>
                                        </dl>
                                        <dl>
                                            <dt>주민등록번호</dt>
                                            <dd>
                                                <select>
                                                    <option>토스뱅크</option>
                                                </select>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>수입금 출금 계좌</dt>
                                            <dd><input type="text" id="" maxlength="13" placeholder="수입금 출금 계좌 입력"></dd>
                                        </dl>
                                    </div>
                                </div>
                                <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    <div>
                                        <h4>전문분야 및 상세 분야를 선택해 주세요</h4>
                                        <dl>
                                            <dd>
                                                <button class="select openModalBtn" data-modal="modal1">전문분야</button>

                                                <div id="modal1" class="modal">
                                                    <div class="modal-content">
                                                        <div class="modal-title">
                                                            <h5>전문 분야를 선택해 주세요</h5>
                                                            <span class="close"><i class="fa-light fa-xmark"></i></span>
                                                        </div>
                                                        <div class="modal-scroll">
                                                            <div class="select">
                                                                <input type="radio" id="" name="" checked><label for="">디자인</label>
                                                                <input type="radio" id="" name=""><label for="">마케팅</label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-btn">
                                                            <button>선택하기</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                            <dd>
                                                <button class="select openModalBtn" data-modal="modal2">상세분야</button>
                                                <div id="modal2" class="modal">
                                                    <div class="modal-content">
                                                        <div class="modal-title">
                                                            <h5>상세분야를 선택해 주세요<span class="txt_blue">최대5개</span></h5>
                                                            <span class="close"><i class="fa-light fa-xmark"></i></span>
                                                        </div>
                                                        <div class="modal-scroll">
                                                            <div class="select">
                                                                <input type="checkbox" id="" name="" checked><label for="">로고디자인</label>
                                                                <input type="checkbox" id="" name=""><label for="">브랜드 디자인·가이드</label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-btn">
                                                            <button>선택하기</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </dd>
                                            <dd>(*최대 3개를 선택해 주세요)</dd>
                                        </dl>
                                        <dl>
                                            <dt class="flex"><strong>디자인</strong><a class="del">전체삭제</a></dt>
                                            <dd class="tag">
                                                <span>웹·모바일 디자인 <a class="del"><i class="fa-light fa-xmark"></i></a></span>
                                                <span>마케팅 디자인 <a class="del"><i class="fa-light fa-xmark"></i></a></span>
                                                <span>캐릭터 ·일러스트 <a class="del"><i class="fa-light fa-xmark"></i></a></span>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt class="flex"><strong>문서·글쓰기</strong><a class="del">전체삭제</a></dt>
                                            <dd class="tag">
                                                <span>스토리텔링 <a class="del"><i class="fa-light fa-xmark"></i></a></span>
                                                <span>산업별 전문 글작성 <a class="del"><i class="fa-light fa-xmark"></i></a></span>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                                <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                    <div>
                                        <h4>학력전공</h4>
                                        <dl>
                                            <dt>학교명</dt>
                                            <dd><input type="text" id="" placeholder="학교명 입력" value=""></dd>
                                        </dl>
                                        <dl>
                                            <dt>전공</dt>
                                            <dd><input type="text" id="" placeholder="전공 입력" value=""></dd>
                                        </dl>
                                        <dl>
                                            <dt>상태</dt>
                                            <dd><select>
                                                    <option>이수</option>
                                                    <option>졸업</option>
                                                    <option>재학</option>
                                                    <option>휴학</option>
                                                </select></dd>
                                        </dl>
                                        <dl>
                                            <dt>증빙자료 첨부(선택)</dt>
                                            <dd>
                                                <div id="addFile">
                                                    <a class="btn">파일 첨부</a>
                                                    <span>증빙자료 파일 첨부</span>
                                                </div>
                                            </dd>
                                        </dl>
                                        <div class="box_blue" id="tip">
                                            <p>TIP</p>
                                            <ul>
                                                <li>증빙 자료 첨부하시면 담당자 검토후 확인 마크<i class="fa-sharp fa-solid fa-badge-check"></i>를 달아드립니다.</li>
                                                <li><strong>첨부가능자료 : 재학증명서, 졸업증명서,성적증명서</strong></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div>
                                        <h4>보유 자격증</h4>
                                        <dl>
                                            <dt>자격증명</dt>
                                            <dd><input type="text" id="" placeholder="자격증명 입력" value=""></dd>
                                        </dl>
                                        <dl>
                                            <dt>발급기관</dt>
                                            <dd><input type="text" id="" placeholder="발급기관 입력" value=""></dd>
                                        </dl>
                                        <dl>
                                            <dt>발급일</dt>
                                            <dd><input type="date" id="" value=""></dd>
                                        </dl>
                                        <dl>
                                            <dt>증빙자료 첨부(선택)</dt>
                                            <dd>
                                                <div id="addFile">
                                                    <a class="btn">파일 첨부</a>
                                                    <span>증빙자료 파일 첨부</span>
                                                </div>
                                            </dd>
                                        </dl>
                                        <div class="box_blue" id="tip">
                                            <p>TIP</p>
                                            <ul>
                                                <li>증빙 자료 첨부하시면 담당자 검토후 확인 마크<i class="fa-sharp fa-solid fa-badge-check"></i>를 달아드립니다.</li>
                                                <li><strong>첨부가능자료 : 자격증사본</strong></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">Step content</div>
                                <div id="step-5" class="tab-pane" role="tabpanel" aria-labelledby="step-5">Step content</div>
                                <div id="step-6" class="tab-pane" role="tabpanel" aria-labelledby="step-6">Step content</div>
                                <div id="step-7" class="tab-pane" role="tabpanel" aria-labelledby="step-7">Step content</div>
                            </div>

                            <div class="btn_confirm">
                                <button class="btn btn-prev" onclick="$('#smartwizard').smartWizard('prev')">이전</button>
                                <button id="next-btn" class="btn_submit" onclick="$('#smartwizard').smartWizard('next')">저장하고 다음</button>
                            </div>
                        </div>

                        <!-- JavaScript -->
                        <script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>

                        <!--재작업-->

					</div>

                </div>
				<!-- 마이페이지에만 나오는 메뉴 -->
				<?php include_once('./mypage_menu.php'); ?>
			</div>
		</div>

    </div>



<?
include_once('./_tail.php');
?>

