<?php
include_once('./_common.php');
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

// 로그인중인 경우 회원가입 할 수 없습니다.
if ($is_member) {
    goto_url(G5_URL);
}

// 세션을 지웁니다.
set_session("ss_mb_reg", "");

$g5['title'] = '프로필 등록';
include_once('./_head.php');

?>

<style>
	#ft{
		display: none;
	}
.b_rdo{
	display: flex;
	flex-wrap: wrap;
}
.b_rdo .st{
	width: calc(50% - 4px);
	position: relative;
/*	margin: 0 2px 4px;*/
}
.b_rdo .st.spec{
	width: 100%;
}
.b_rdo .st > div{
	border: 2px solid #f1f1f1;
    width: 100%;
    box-shadow: 2px 2px 0 rgb(0 0 0 / 2%);
    border-radius: 3px;
    padding: 20px;
}
.b_rdo .st .bx{
	position: relative;
}
.b_rdo .st h2{
	display: inline;
	margin: 3px 0 0;
	text-align: left;
	font-size: 1em;
}
.b_rdo .st .scon{
    font-size: 0.83em;
    font-weight: 500;
    color: #fe8ea6;
    margin-top: 8px;
}
.b_rdo input[type="radio"]{
	position: absolute;
	top: 0;
	left: 0;
	opacity: 0;
}
.b_rdo .st p{
	position: absolute;
	right: 20px;
	top: 20px;
}
.b_rdo .st p img{
	width: 50px;
	height: auto;
}
	.b_rdo .st{
		margin: 0 2px 4px;
	}
	
	
	.mbskin .title_top{
		margin-top: 50px;
	}
</style>

<div class="mbskin">
    <ul class="profilecate cf">
        <li class="active"><a href="javascript:void(0);">배우자 정보</a></li>
        <li><a href="javascript:void(0);" onclick="save('register_form02.php');">신앙정보</a></li>
        <li><a href="javascript:void(0);" onclick="save('register_form03.php');">나의정보</a></li>
        <li><a href="javascript:void(0);" onclick="save('register_form04.php');">사진정보</a></li>
        <li><a href="javascript:void(0);" onclick="save('register_form05.php');">학벌/연봉/재산정보</a></li>
        <li><a href="javascript:void(0);" onclick="save('my_profile06.php');">서류정보</a></li>
    </ul>
    
    
	<h2 class="title_top">
		<span class="point">희망하는 배우자 정보</span>를 입력하세요
	</h2>
	<div class="regi_info">
		<p>상대방에게 <strong class="point">무료</strong>로 공개되는 내용입니다. 빠짐없이 꼼꼼하게 입력해주세요</p>
		<!--	<p>무료로 열람가능합니다. 마음에 드시는 분은 찜목록으로 이동가능 합니다.</p>-->

		<span>복수선택 가능</span>
	</div>

	<article class="box-article">
		<div id="join_info01">
			<dl class="sec01">
				<dt>희망하는 직업</dt>
				<dd>
					<input type="checkbox" name="sec01_01" id="sec01_01_01" value="회사원">
					<label for="sec01_01_01">회사원</label>
					<input type="checkbox" name="sec01_01" id="sec01_01_02" value="사업가">
					<label for="sec01_01_02">사업가</label>
					<input type="checkbox" name="sec01_01" id="sec01_01_03" value="자영업">
					<label for="sec01_01_03">자영업</label>
					<input type="checkbox" name="sec01_01" id="sec01_01_04" value="교육계">
					<label for="sec01_01_04">교육계</label>
					<input type="checkbox" name="sec01_01" id="sec01_01_05" value="서비스업">
					<label for="sec01_01_05">서비스업</label>
					<input type="checkbox" name="sec01_01" id="sec01_01_06" value="기타">
					<label for="sec01_01_06">기타</label>
					<input type="checkbox" name="sec01_01" id="sec01_01_07" value="상관없음">
					<label for="sec01_01_07">상관없음</label>
					<input type="checkbox" name="sec01_01" id="sec01_01_08" value="직접기재">
					<label for="sec01_01_08">직접기재</label>
				</dd>
				<dd class="sec01_01_06">
					<input type="text" placeholder="희망하는 직업을 입력하세요">
				</dd>
			</dl>
			<dl class="sec01">
				<dt>희망하는 키</dt>
				<dd>
					<input type="checkbox" name="sec01_02" id="sec01_02_01" value="155cm ~ 160cm">
					<label for="sec01_02_01">155cm ~ 160cm</label>
					<input type="checkbox" name="sec01_02" id="sec01_02_02" value="160cm ~ 165cm">
					<label for="sec01_02_02">160cm ~ 165cm</label>
					<input type="checkbox" name="sec01_02" id="sec01_02_03" value="165cm ~ 170cm">
					<label for="sec01_02_03">165cm ~ 170cm</label>
					<input type="checkbox" name="sec01_02" id="sec01_02_04" value="170cm ~ 175cm">
					<label for="sec01_02_04">170cm ~ 175cm</label>
					<input type="checkbox" name="sec01_02" id="sec01_02_05" value="175cm ~ 180cm">
					<label for="sec01_02_05">175cm ~ 180cm</label>
					<input type="checkbox" name="sec01_02" id="sec01_02_06" value="180cm ~ 185cm">
					<label for="sec01_02_06">180cm ~ 185cm</label>
					<input type="checkbox" name="sec01_02" id="sec01_02_07" value="185cm ~ 190cm">
					<label for="sec01_02_07">185cm ~ 190cm</label>
					<input type="checkbox" name="sec01_02" id="sec01_02_08" value="190cm ~ 195cm">
					<label for="sec01_02_08">190cm ~ 195cm</label>
					<input type="checkbox" name="sec01_02" id="sec01_02_09" value="195cm ~ 200cm">
					<label for="sec01_02_09">195cm ~ 200cm</label>
					<input type="checkbox" name="sec01_02" id="sec01_02_10" value="200cm ~">
					<label for="sec01_02_10">200cm ~</label>
					<input type="checkbox" name="sec01_02" id="sec01_02_11" value="상관없음">
					<label for="sec01_02_11">상관없음</label>
				</dd>
			</dl>
			<dl class="sec01">
				<dt>희망하는 학벌</dt>
				<dd>
					<input type="checkbox" name="sec01_03" id="sec01_03_01" value="고졸">
					<label for="sec01_03_01">고졸</label>
					<input type="checkbox" name="sec01_03" id="sec01_03_02" value="초대졸">
					<label for="sec01_03_02">초대졸</label>
					<input type="checkbox" name="sec01_03" id="sec01_03_03" value="대졸">
					<label for="sec01_03_03">대졸</label>
					<input type="checkbox" name="sec01_03" id="sec01_03_04" value="대학원졸">
					<label for="sec01_03_04">대학원졸</label>
					<input type="checkbox" name="sec01_03" id="sec01_03_05" value="유학">
					<label for="sec01_03_05">유학</label>
					<input type="checkbox" name="sec01_03" id="sec01_03_06" value="상관없음">
					<label for="sec01_03_06">상관없음</label>
				</dd>
			</dl>
			<dl class="sec01">
				<dt>희망하는 연봉</dt>
				<dd>
					<input type="checkbox" name="sec01_04" id="sec01_04_01" value="1000 ~ 2000">
					<label for="sec01_04_01">1000 ~ 2000</label>
					<input type="checkbox" name="sec01_04" id="sec01_04_02" value="2000 ~ 3000">
					<label for="sec01_04_02">2000 ~ 3000</label>
					<input type="checkbox" name="sec01_04" id="sec01_04_03" value="3000 ~ 4000">
					<label for="sec01_04_03">3000 ~ 4000</label>
					<input type="checkbox" name="sec01_04" id="sec01_04_04" value="4000 ~ 5000">
					<label for="sec01_04_04">4000 ~ 5000</label>
					<input type="checkbox" name="sec01_04" id="sec01_04_05" value="5000 ~ 6000">
					<label for="sec01_04_05">5000 ~ 6000</label>
					<input type="checkbox" name="sec01_04" id="sec01_04_06" value="6000 ~ 7000">
					<label for="sec01_04_06">6000 ~ 7000</label>
					<input type="checkbox" name="sec01_04" id="sec01_04_07" value="7000 ~ 8000">
					<label for="sec01_04_07">7000 ~ 8000</label>
					<input type="checkbox" name="sec01_04" id="sec01_04_08" value="8000 ~ 9000">
					<label for="sec01_04_08">8000 ~ 9000</label>
					<input type="checkbox" name="sec01_04" id="sec01_04_09" value="9000 ~ 10000">
					<label for="sec01_04_09">9000 ~ 10000</label>
					<input type="checkbox" name="sec01_04" id="sec01_04_10" value="상관없음">
					<label for="sec01_04_10">상관없음</label>
				</dd>
			</dl>
			<dl class="sec01">
				<dt>희망하는 근무형태</dt>
				<dd>
					<input type="checkbox" name="sec01_05" id="sec01_05_01" value="주말휴무">
					<label for="sec01_05_01">주말휴무</label>
					<input type="checkbox" name="sec01_05" id="sec01_05_02" value="평일중 휴무">
					<label for="sec01_05_02">평일중 휴무</label>
					<input type="checkbox" name="sec01_05" id="sec01_05_03" value="상관없음">
					<label for="sec01_05_03">상관없음</label>
				</dd>
			</dl>
			<dl class="sec01">
				<dt>희망하는 스타일</dt>
				<dd>
					<input type="checkbox" name="sec01_06" id="sec01_06_01" value="스윗한 사람">
					<label for="sec01_06_01">스윗한 사람</label>
					<input type="checkbox" name="sec01_06" id="sec01_06_02" value="따뜻하고 배려심많은 사람">
					<label for="sec01_06_02">따뜻하고 배려심많은 사람</label>
					<input type="checkbox" name="sec01_06" id="sec01_06_03" value="리더쉽한 사람">
					<label for="sec01_06_03">리더쉽한 사람</label>
					<input type="checkbox" name="sec01_06" id="sec01_06_04" value="세심하고 잘챙겨주는 사람">
					<label for="sec01_06_04">세심하고 잘챙겨주는 사람</label>
					<input type="checkbox" name="sec01_06" id="sec01_06_05" value="상관없음">
					<label for="sec01_06_05">상관없음</label>
					<input type="checkbox" name="sec01_06" id="sec01_06_06" value="기타">
					<label for="sec01_06_06">기타</label>
				</dd>
				<dd class="sec01_06_06">
					<input type="text" placeholder="희망하는 스타일을 입력해주세요">
				</dd>
			</dl>
			<dl class="sec01">
				<dd class="b_rdo cf">
					<div class="st">
						<div>
							<input type="radio" name="join_type" id="person_1" value="초혼" checked>
							<em></em>
							<div class="bx"><h2 class="tit">나는 초혼입니다.</h2></div>
						</div>
					</div>
					<div class="st">
						<div>
							<input type="radio" name="join_type" id="person_2" value="재혼">
							<em></em>
							<div class="bx"><h2 class="tit">나는 재혼입니다.</h2></div>
						</div>
					</div>
					<div class="st spec">
						<div>
							<input type="radio" name="join_type" id="person_2" value="장애인">
							<em></em>
							<div class="bx">
								<h2 class="tit">나는 장애인입니다.</h2>
								<div class="scon">최고의 장애는 마음속에 있는 두려움입니다.<br />마음을 조금 더 열면 좋은 인연이 더 가까이 옵니다.</div>
							</div>
							<p><img src="<?php echo $member_skin_url;?>/img/info_ico03.png" alt="" /></p>
						</div>
					</div>
				</dd>
			
			</dl>
			<dl class="sec01">
				<dt>희망하는 상대의 결혼 여부</dt>
				<dd>
					<input type="checkbox" name="sec01_07" id="sec01_07_01" value="초혼">
					<label for="sec01_07_01">초혼</label>
					<input type="checkbox" name="sec01_07" id="sec01_07_02" value="재혼">
					<label for="sec01_07_02">재혼</label>
					<input type="checkbox" name="sec01_07" id="sec01_07_03" value="상관없음">
					<label for="sec01_07_03">상관없음</label>
				</dd>
			</dl>
		</div>
		
		<button onclick="location.href='./register_form02.php'" class="btn_submit ft_btn">다음 단계</button>
	</article>
</div>


<?php
include_once('./_tail.php');
?>
