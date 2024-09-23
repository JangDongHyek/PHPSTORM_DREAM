<div id="acco">
    <div class="tabs">
        <div class="tab">
            <input type="checkbox" id="chck1">
            <label class="tab-label" for="chck1">대관 문의</label>
            <div class="tab-content">
                <div class="pay-warp">
                    <h6>담당자 정보</h6>
                    <div class="pay2-wrap">
                        <input id="rentName" type="text" placeholder="이름(회사명)" value="<?=$member['mb_name']?>">
                        <input id="rentTel" type="text" placeholder="연락처" value="<?=$member['mb_hp']?>">
                        <input id="rentEmail" type="text" placeholder="이메일" value="<?=$member['mb_email']?>">
                    </div>
                    <hr>
                    <div class="time">
                        <div class="calendar-wrap">
                            <h6>대관희망일</h6>
                            <div id="calendar" class="calendar-container"></div>
                        </div>
                        <div class="calendar-time">
                            <h6>희망 대관시간</h6>
                            <div class="time-wrap">
                                <? 
                                $TIME = [3, 6, 12];
                                foreach($TIME as $key=>$data){                                
                                ?>
                                <div class="timeTab <?=($key == 1)? 'active' : ''?>" data-time="<?=$data?>" onclick="selectedTime($(this))">
                                    <p><?=$data?>시간</p>
                                </div>
                                <? } ?>               
                            </div>
                            <h6>안내사항</h6>
							<p>- 희망하는 일자에 이미 예약이 완료된 경우 희망일 이용이 불가할 수 있습니다.</p>
							<p>- 예약일 조정은 문의 후 상담을 통해 조정 가능합니다.</p>
							<p>- 기타 문의 및 요청사항에 2순위 희망일을 기재해주시면 더욱 원활한 상담이 가능합니다.</p>
                        </div>
                    </div>
                    <!--time-->
                </div>

                <div class="pay-warp">
                    <div class="pay2-wrap">
                        <div>
                            <h6>세팅 필요 여부</h6>
                            <p>* 미선택시 공간대관만 진행되며, 모든 행사에 관한 준비는 대관시간에 포함입니다.</p>
                            <label class="form-control">
                                <input type="radio" name="isSetting" class="isSetting" value="Y">
                                선택
                            </label>
                            <label class="form-control">
                                <input type="radio" name="isSetting" class="isSetting" value="N">
                                미선택
                            </label>
                        </div>
                        <div>
                            <h6>클리닝 필요 여부</h6>
                            <p>* 미선택시 모든 클리닝은 대관자 부담이며 불이행시 추가 금액 발생할 수 있습니다</p>
                            <label class="form-control">
                                <input type="radio" name="isCleaning" class="isCleaning" value="Y">
                                선택
                            </label>
                            <label class="form-control">
                                <input type="radio" name="isCleaning" class="isCleaning" value="N">
                                미선택
                            </label>
                        </div>
                    </div>
                    <hr>

                    <div class="pay2-wrap">
                        <? if($floor == 1 || $floor == 2){ ?>
                        <div>                            
                            <? if($floor == 1){ ?>
                            <div>
								<h6>글라스 렌탈</h6>
								<input id="glassRental" type="text" placeholder="필요수량 기입(숫자)">
							</div>
                            <? }else if($floor == 2){ ?>
                                <h6>글라스 렌탈</h6>
                                <? 
                                $GLASS_RENTAL = ["Standard(48잔)", "Double(48잔이상 100잔 이하)", "Mega(100잔 이상)"]; 
                                foreach($GLASS_RENTAL as $key=>$data){ 
                                ?>
                                <label class="form-control">
                                    <input type="radio" name="glassRental" class="glassRental" value="<?=$data?>">
                                    <?=$data?>
                                </label>
                                <? } ?>
                            <? } ?>
                        </div>
                        <? } ?>
                        <div>
                            <h6>인원</h6>
                            <input type="text" id="person" placeholder="진행자, 참석자 포함">
                        </div>
                    </div>
                    <hr>
                    

                    <div class="pay2-wrap">
                        <div>
                            <h6>행사 유형</h6>
                            <input type="text" id="category" placeholder="클래스, 세미나, 직원교육, 파티 등 기입">
                        </div>
                        <div>
                            <h6>당일 상세 일정</h6>
                            <input type="text" id="detailSchedule" placeholder="시간 별 이벤트, 동선 등 상세사항 기입">
                        </div>
                    </div>
                    <hr>
                    <h6>기타 문의 및 요청사항</h6>
                    <textarea id="request" placeholder="구비물품 외 필요 사항 요청"></textarea>
                </div>
                <!--pay-warp-->

                <button type="button" class="submit" onclick="onSumbitRental(<?=$floor?>)">대관신청</button>
            </div>
        </div>
    </div>
</div>

<link href="<?=G5_THEME_CSS_URL; ?>/calendar.css<?=LASTEST_FILE_VER?>" rel="stylesheet" type="text/css">
<!--캘린더.css-->
<link href="<?=G5_THEME_CSS_URL; ?>/theme.css<?=LASTEST_FILE_VER?>" rel="stylesheet" type="text/css">
<!--캘린더(theme).css-->

<script src="<?=G5_THEME_JS_URL?>/assets/rent.js<?=LASTEST_FILE_VER?>"></script>
<!--렌트공통.js-->
<script src="<?=G5_THEME_JS_URL ?>/calendar.js"></script>
<!--캘린더.js-->