<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
?>
<section id="bo_w">
    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
	<input type="hidden" name="password" value="1234!">
	<input type="hidden" name="wr_subject" value="<?=$write['wr_subject']?>">
	<input type="hidden" name="wr_content" value="희망창업">
	<input type="hidden" name="wr_7" id="wr_7" value="<?=$write['wr_7']?>">
	<input type="hidden" name="wr_8" id="wr_8" value="<?=$write['wr_8']?>">
	<input type="hidden" name="wr_9" id="wr_9" value="<?=$write['wr_9']?>">
	<input type="hidden" name="wr_10" id="wr_10" value="<?=$write['wr_10']?>">
	<?
		//글쓰기일때 해당 링크의 경로를 담는다.
		if(!$w && $_GET['type']){
			$write['wr_homepage'] = $_GET['type'];
		}else{
			$write['wr_homepage'] = "60계치킨";
		}
	?>
	<input type="hidden" name="wr_homepage" id="wr_homepage" value="<?=$write['wr_homepage']?>">
	
	<div id="content">
    	<div class="big-title">
        	<span>매일 새 기름으로 60마리만!</span>
            <p>60계 치킨 창업하면 <br class="visible-xs"><strong>월 수익</strong>은 얼마?</p>
        </div>
		<!-- 희망지역 선택 -->
		<div id="step1" class="step">
        	<dl>
            	<dt>1. 희망창업지역은?</dt>
                <dd class="row">
                    <div class="st-img col-sm-7 col-xs-12">
                    	<img src="<?php echo $board_skin_url ?>/img/after_step_img01.gif" alt="">
                    </div>
                    <div class="st-selcet col-sm-5 col-xs-12">
                        <p class="que"><i class="fa fa-circle-o" aria-hidden="true"></i> 희망창업 <strong>지역</strong>을 선택해주세요.</p>
                        <select id="area">
                          <option value="">지역선택</option>
                          <option value="서울특별시">서울특별시</option>
                          <option value="인천광역시">인천광역시</option>
                          <option value="대전광역시">대전광역시</option>
                          <option value="대구광역시">대구광역시</option>
                          <option value="울산광역시">울산광역시</option>
                          <option value="광주광역시">광주광역시</option>
                          <option value="부산광역시">부산광역시</option>
                          <option value="세종시">세종시</option>
                          <option value="경기도">경기도</option>
                          <option value="강원도">강원도</option>
                          <option value="충청북도">충청북도</option>
                          <option value="충청남도">충청남도</option>  
                          <option value="전라북도">전라북도</option>
                          <option value="전라남도">전라남도</option>
                          <option value="경상북도">경상북도</option>
                          <option value="경상남도">경상남도</option>
                          <option value="제주도">제주도</option>
                        </select>
                    </div>
					<?if($is_admin){?>
					<div class="step-btn">
                        <a href="<?=G5_BBS_URL?>/board.php?bo_table=after"><span class="btn-w">신청내역 목록</span></a>
                    </div>
					<?}?>
                    <div class="step-btn">
                        <span class="next1 btn-n">다음 <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
                    </div>
                </dd>
            </dl>
		</div>
		<!-- 희망유형 선택 -->
		<div id="step2" class="step" style="display:none">
        	<dl>
            	<dt>2. 희망창업 유형은?</dt>
                <dd class="row">
                    <div class="st-img col-sm-7 col-xs-12">
                    	<img src="<?php echo $board_skin_url ?>/img/after_step_img02.gif" alt="">
                    </div>
                    <div class="st-selcet col-sm-5 col-xs-12">
                        <p class="que"><i class="fa fa-circle-o" aria-hidden="true"></i> 희망창업 <strong>유형</strong>을 선택해주세요.</p>
                        <select id="type">
                            <option value="">유형선택</option>
                            <option value="신규창업">신규창업</option>
                            <option value="업종전환">업종전환</option>
                        </select>
                    </div>
                    <div class="step-btn">
                        <span class="prev1 btn-p"><i class="fa fa-arrow-left" aria-hidden="true"></i> 이전</span>
                        <span class="next2 btn-n">다음 <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
                    </div>
                </dd>
            </dl>
		</div>
		<!-- 희망규모 선택 -->
		<div id="step3" class="step" style="display:none">
        	<dl>
            	<dt>3. 희망창업 규모은?</dt>
                <dd class="row">
                    <div class="st-img col-sm-7 col-xs-12">
                    	<img src="<?php echo $board_skin_url ?>/img/after_step_img03.gif" alt="">
                    </div>
                    <div class="st-selcet col-sm-5 col-xs-12">
                        <p class="que"><i class="fa fa-circle-o" aria-hidden="true"></i> 희망창업 <strong>규모</strong>를 선택해주세요.</p>
                        <select id="scale">
                            <option value="">규모선택</option>
                            <option value="20평~30평 이하">20평~30평 이하</option>
                            <option value="30평~50평 이하">30평~50평 이하</option>
                        </select>
                    </div>
                    <div class="step-btn">
                        <span class="prev2 btn-p"><i class="fa fa-arrow-left" aria-hidden="true"></i> 이전</span>
                        <span class="next3 btn-n">다음 <i class="fa fa-arrow-right" aria-hidden="true"></i></span>	
                    </div>
                </dd>
            </dl>
		</div>
		<!-- 창업 투자금액 선택 -->
		<div id="step4" class="step" style="display:none">
        	<dl>
            	<dt>4. 창업투자 가능 금액은?</dt>
                <dd class="row">
                    <div class="st-img col-sm-7 col-xs-12">
                    	<img src="<?php echo $board_skin_url ?>/img/after_step_img04.gif" alt="">
                    </div>
                    <div class="st-selcet col-sm-5 col-xs-12">
                        <p class="que"><i class="fa fa-circle-o" aria-hidden="true"></i> 창업 <strong>투자금액</strong>을 선택해주세요.</p>
                        <select id="amount">
                            <option value="">투자가능금액 선택</option>
                            <option value="1,000만원 ~ 3,000만원 이하">1,000만원 ~ 3,000만원 이하</option>
                            <option value="3,000만원 ~ 5,000만원 이하">3,000만원 ~ 5,000만원 이하</option>
                            <option value="5,000만원 ~ 1억원">5,000만원 ~ 1억원</option>
                        </select>
                    </div>
                    <div class="step-btn">
                        <span class="prev3 btn-p"><i class="fa fa-arrow-left" aria-hidden="true"></i> 이전</span>
                        <span class="next4 btn-n">다음 <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
                    </div>
                </dd>
            </dl>	
		</div>
		<script>					
		$('.next1').click(function() {
			if($('#area').val()) {
				$('#step1').css('display', 'none');
				$('#step2').css('display', '');
				$('#wr_7').val($('#area').val());
			} else {
				alert('희망창업 지역을 선택해주세요.');
				return;
			}
		});
		$('.prev1').click(function() {			
			$('#step1').css('display', '');
			$('#step2').css('display', 'none');
		});
		$('.next2').click(function() {
			if($('#type').val()) {
				$('#step2').css('display', 'none');
				$('#step3').css('display', '');
				$('#wr_8').val($('#type').val());
			} else {
				alert('희망창업 유형을 선택해주세요.');
				return;
			}
		});
		$('.prev2').click(function() {			
			$('#step2').css('display', '');
			$('#step3').css('display', 'none');
		});
		$('.next3').click(function() {
			if($('#scale').val()) {
				$('#step3').css('display', 'none');
				$('#step4').css('display', '');
				$('#wr_9').val($('#scale').val());
			} else {
				alert('희망창업 규모을 선택해주세요.');
				return;
			}
		});
		$('.prev3').click(function() {			
			$('#step3').css('display', '');
			$('#step4').css('display', 'none');
		});
		$('.next4').click(function() {
			if($('#amount').val()) {
				$('#step4').css('display', 'none');
				$('#step5').css('display', '');
				$('#wr_10').val($('#amount').val());
			} else {
				alert('창업 투자금액을 선택해주세요.');
				return;
			}
		});
		</script>
        
    <div id="step5" class="step tbl_frm01 tbl_wrap" style="display:none;">
        <table>
        <colgroup>
           <col style="width:15%" />
           <col style="width:auto" />
        </colgroup>
        <tbody>
        <tr>
            <th scope="row"><label for="wr_name">이름<strong class="sound_only">필수</strong></label></th>
            <td>
				<input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" size="10" maxlength="20" style="width:230px;" onkeyup="name_copy(this)"><br class="vislble-xs">(성함을 정확히 입력해 주시기 바랍니다.)
				<script>					
				function name_copy(name){
					document.all.wr_subject.value = name.value + " 님의 신청내역입니다.";
				}
				</script>
			</td>
        </tr>
		<tr>
            <th scope="row"><label for="wr_1">연락처<strong class="sound_only">필수</strong></label></th>
            <td>
				<select name="wr_1" id="wr_1" style="width:60px; height:26px;">
					<option value="010" <?if($write['wr_1']=="010"){echo "selected";}?>>010</option>
					<option value="011" <?if($write['wr_1']=="011"){echo "selected";}?>>011</option>
					<option value="016" <?if($write['wr_1']=="016"){echo "selected";}?>>016</option>
					<option value="017" <?if($write['wr_1']=="017"){echo "selected";}?>>017</option>
					<option value="018" <?if($write['wr_1']=="018"){echo "selected";}?>>018</option>
					<option value="019" <?if($write['wr_1']=="019"){echo "selected";}?>>019</option>
				</select>
				-
				<input type="number" name="wr_2" value="<?php echo $write['wr_2'] ?>" id="wr_2" required class="frm_input required" style="width:75px;">-
				<input type="number" name="wr_3" value="<?php echo $write['wr_3'] ?>" id="wr_3" required class="frm_input required" style="width:75px;">
				<br class="vislble-xs">(즉시 연락가능한 휴대폰 번호)
			</td>
        </tr>
        <tr>
            <th scope="row"><label for="wr_4">이메일</label></th>
            <td>
				<input type="text" name="wr_4" value="<?php echo $write['wr_4'] ?>" id="wr_4" class="frm_input required" required style="width:100px;">
				@
				<input type="text" name="wr_5" value="<?php echo $write['wr_5'] ?>" id="wr_5" class="frm_input required" required style="width:100px;">
				<select name="wr_6" id="wr_6" style="width:150px; height:26px; margin:1px 0;">
					<option value="">직접입력</option>
					<option value="empal.com" <?if($write['wr_6']=="empal.com"){echo "selected";}?>>empal.com</option>
					<option value="dreamwiz.com" <?if($write['wr_6']=="dreamwiz.com"){echo "selected";}?>>dreamwiz.com</option>
					<option value="daum.net" <?if($write['wr_6']=="daum.net"){echo "selected";}?>>daum.net</option>
					<option value="hotmail.com" <?if($write['wr_6']=="hotmail.com"){echo "selected";}?>>hotmail.com</option>
					<option value="chollian.net" <?if($write['wr_6']=="chollian.net"){echo "selected";}?>>chollian.net</option>
					<option value="freechal.com" <?if($write['wr_6']=="freechal.com"){echo "selected";}?>>freechal.com</option>
					<option value="hanafos.com" <?if($write['wr_6']=="hanafos.com"){echo "selected";}?>>hanafos.com</option>
					<option value="kebi.com" <?if($write['wr_6']=="kebi.com"){echo "selected";}?>>kebi.com</option>
					<option value="korea.com" <?if($write['wr_6']=="korea.com"){echo "selected";}?>>korea.com</option>
					<option value="lycos.co.kr" <?if($write['wr_6']=="lycos.co.kr"){echo "selected";}?>>lycos.co.kr</option>
					<option value="netian.com" <?if($write['wr_6']=="netian.com"){echo "selected";}?>>netian.com</option>
					<option value="nate.com" <?if($write['wr_6']=="nate.com"){echo "selected";}?>>nate.com</option>
					<option value="naver.com" <?if($write['wr_6']=="naver.com"){echo "selected";}?>>naver.com</option>
					<option value="netsgo.com" <?if($write['wr_6']=="netsgo.com"){echo "selected";}?>>netsgo.com</option>
					<option value="unitel.co.kr" <?if($write['wr_6']=="unitel.com"){echo "selected";}?>>unitel.co.kr</option>
					<option value="paran.com" <?if($write['wr_6']=="paran.com"){echo "selected";}?>>paran.com</option>
					<option value="hanmail.net" <?if($write['wr_6']=="hanmail.com"){echo "selected";}?>>hanmail.net</option>
					<option value="hitel.net" <?if($write['wr_6']=="hitel.com"){echo "selected";}?>>hitel.net</option>
					<option value="yahoo.co.kr" <?if($write['wr_6']=="yahoo.com"){echo "selected";}?>>yahoo.co.kr</option>
					<option value="cyworld.com" <?if($write['wr_6']=="cyworld.com"){echo "selected";}?>>cyworld.com</option>
					<option value="msn.com" <?if($write['wr_6']=="msn.com"){echo "selected";}?>>msn.com</option>
					<option value="gmail.com" <?if($write['wr_6']=="gmail.com"){echo "selected";}?>>gmail.com</option>
					<option value="hanmir.com" <?if($write['wr_6']=="hanmir.com"){echo "selected";}?>>hanmir.com</option>
				</select>
			</td>
        </tr>
        </tbody>
        </table>
		
		<?if(!$w){?>
		<section id="fregister_private">
			<h2>개인정보처리방침안내</h2>
			<textarea readonly style="resize:none; width:100%;"><?php echo get_text($config['cf_privacy']) ?></textarea>
			<fieldset class="fregister_agree">
				<input type="checkbox" name="agree1" value="1" id="agree1">
				<label for="agree1">창업 후 월 수익 분석 및 안내를 위해<br class="vislble-xs"> 아래의 '개인정보 수집 및 이용'에 동의합니다.</label>            
			</fieldset>
		</section>
		<?}?>

		<div class="btn_confirm">
			<input type="submit" value="수익 확인 요청" id="btn_submit" accesskey="s" class="btn_submit">
			<?if($is_admin){?>
			<a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">목록보기</a>
			<?}?>
		</div>
		</form>
	</div>

    <script>
	$('#wr_6').change(function() {
		$('input[name=wr_5]').val($(this).val());
	});
	
    function fwrite_submit(f)
    {
		if (!f.agree1.checked) {
            alert("개인정보처리방침안내의 내용에 동의하셔야 예약하실 수 있습니다.");
            f.agree1.focus();
            return false;
        }

        document.getElementById("btn_submit").disabled = "disabled";
        return true;
    }
    </script>

        <div id="boon">
        	<div class="title">60계 치킨만의 창업 혜택!</div>
            <div class="boon-list">
            	<dl>
                	<dt>20평 매장,
                	  <p>월매출 6,200만원</p></dt>
                    <dd>먹거리 불안감이 높아진 요즘!<br>
                    신선한 계육과 깨끗한 새기름으로 조리하여<br>
                    충성도 높은 단골을 확보한 60계치킨!</dd>
                </dl>
                <dl>
                	<dt>업종변경후<p>매출 1000% 상승</p></dt>
                    <dd>일 매출 20만원의 치킨집에서<br>
                    일 매출 200만원의 60계치킨 사장님으로 <br>
                    대박성공 업종변경!</dd>
                </dl>
            	<dl>
                	<div class="img"><img src="<?php echo $board_skin_url ?>/img/boon_icon03.gif" alt=""></div>
                	<dt>매일 식용유 1통<p>지원 프로모션</p>
                	</dt>
                    <dd>기름 한 방울이 아까운 점주님들을 위해!<br>
                    60계 치킨은 매일 새기름 1통을 지원합니다!<br>
                    (1통으로 60마리 조리가능)</dd>
                </dl>
                <dl>
                	<div class="img"><img src="<?php echo $board_skin_url ?>/img/boon_icon04.gif" alt=""></div>
                	<dt>배달 앱 마케팅<p>비용 지원 프로모션</p></dt>
                    <dd>하고 싶어도 비용 때문에 망설였던 모바일 광고!<br>
                    60계 치킨은 무상으로 모바일 마케팅을 도와드리고,<br>
                    마케팅 비용도 지원해 드립니다!</dd>
                </dl>
                <dl>
                	<div class="img"><img src="<?php echo $board_skin_url ?>/img/boon_icon05.gif" alt=""></div>
                	<dt>안정적인 창업<p>대출 지원</p></dt>
                    <dd>자금이 부족해서 창업을 포기하신다고요?<br>
                    60계 치킨은 안정적이고 창업 하실 수 있도록<br>
                    제 1금융권에서 대출을 지원해드립니다!</dd>
                </dl>
            </div>
            <p class="att"><i class="fa fa-info-circle" aria-hidden="true"></i> 상기 창업 혜택은 창업 조건에 따라 지원 내용이 달라질 수 있음을 안내드립니다.</p>
        </div>
        
	</div>

</section>
<!-- } 게시물 작성/수정 끝 -->