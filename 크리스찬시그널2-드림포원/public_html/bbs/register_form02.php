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
	.mbskin .title_top{
		margin-top: 50px;
	}
</style>

<div class="mbskin">
    <ul class="profilecate cf">
        <li><a href="javascript:void(0);">배우자 정보</a></li>
        <li class="active"><a href="javascript:void(0);" onclick="save('register_form02.php');">신앙정보</a></li>
        <li><a href="javascript:void(0);" onclick="save('register_form03.php');">나의정보</a></li>
        <li><a href="javascript:void(0);" onclick="save('register_form04.php');">사진정보</a></li>
        <li><a href="javascript:void(0);" onclick="save('register_form05.php');">학벌/연봉/재산정보</a></li>
        <li><a href="javascript:void(0);" onclick="save('register_form06.php');">서류정보</a></li>
    </ul>
    
	<h2 class="title_top">
		<span class="point">나의 신앙 정보</span>를 입력하세요
	</h2>
	<div class="regi_info">
		<p>상대방에게 <strong class="point">무료</strong>로 공개되는 내용입니다. 빠짐없이 꼼꼼하게 입력해주세요</p>
		<!--	<p>무료로 열람가능합니다. 마음에 드시는 분은 찜목록으로 이동가능 합니다.</p>-->

		<span>복수선택 가능</span>
	</div>

	<article class="box-article">
		<div id="join_info01">
			<dl class="sec02">
				<dd class="sec02_00">
					<input type="radio" name="sec02_01" id="sec02_01_01" value="교회를 다녀본적 없지만 기회가 되면 다닐 생각이 있어요">
					<em></em>
					<label for="sec02_01_01">교회를 다녀본적 없지만 기회가 되면 다닐 생각이 있어요</label>
				</dd>
				<dd class="sec02_00">
					<input type="radio" name="sec02_01" id="sec02_01_02" value="교회를 다니고 있어요">
					<em></em>
					<label for="sec02_01_02">교회를 다니고 있어요</label>
				</dd>
			</dl>
			<dl class="sec02">
				<dt>교회를 다닌 기간</dt>
				<dd>
					<input type="checkbox" name="sec02_02" id="sec02_02_01" value="모태신앙">
					<label for="sec02_02_01">모태신앙</label>
					<input type="checkbox" name="sec02_02" id="sec02_02_02" value="5년 이하">
					<label for="sec02_02_02">5년 이하</label>
					<input type="checkbox" name="sec02_02" id="sec02_02_03" value="5~10년">
					<label for="sec02_02_03">5~10년</label>
					<input type="checkbox" name="sec02_02" id="sec02_02_04" value="10~15년">
					<label for="sec02_02_04">10~15년</label>
					<input type="checkbox" name="sec02_02" id="sec02_02_05" value="15~20년">
					<label for="sec02_02_05">15~20년</label>
					<input type="checkbox" name="sec02_02" id="sec02_02_06" value="25년 이상">
					<label for="sec02_02_06">25년 이상</label>
				</dd>
			</dl>
			<dl class="sec02">
				<dt>봉사</dt>
				<dd>
					<input type="checkbox" name="sec02_03" id="sec02_03_01" value="해본적 없지만 기회가 되면 하고싶다.">
					<label for="sec02_03_01">해본적 없지만 기회가 되면 하고싶다.</label>
					<input type="checkbox" name="sec02_03" id="sec02_03_02" value="한가지를 봉사하고 있다.">
					<label for="sec02_03_02">한가지를 봉사하고 있다.</label>
					<input type="checkbox" name="sec02_03" id="sec02_03_03" value="두가지를 봉사하고 있다.">
					<label for="sec02_03_03">두가지를 봉사하고 있다.</label>
					<input type="checkbox" name="sec02_03" id="sec02_03_04" value="과거에 했지만 지금 잠깐 쉬고있다.">
					<label for="sec02_03_04">과거에 했지만 지금 잠깐 쉬고있다.</label>
					<input type="checkbox" name="sec02_03" id="sec02_03_05" value="상관없음">
					<label for="sec02_03_05">상관없음</label>
				</dd>
			</dl>
			<dl class="sec02">
				<dt>십일조 여부</dt>
				<dd>
					<input type="checkbox" name="sec02_04" id="sec02_04_01" value="하고있다.">
					<label for="sec02_04_01">하고있다.</label>
					<input type="checkbox" name="sec02_04" id="sec02_04_02" value="하지않는다.">
					<label for="sec02_04_02">하지않는다.</label>
				</dd>
			</dl>
			<dl class="sec02">
				<dt>감사헌금 여부</dt>
				<dd>
					<input type="checkbox" name="sec02_05" id="sec02_05_01" value="하고있다.">
					<label for="sec02_05_01">하고있다.</label>
					<input type="checkbox" name="sec02_05" id="sec02_05_02" value="하지않는다.">
					<label for="sec02_05_02">하지않는다.</label>
				</dd>
			</dl>
			<dl class="sec02_2">
				<dt>다니는 교회정보 입력
					<span class="sm">
						<input type="checkbox" name="info_op" id="info_op" value="공개"><em></em>
						<label for="info_op">공개</label>
					</span>
				</dt>
				<dd>
					<input type="text" placeholder="교회이름을 입력해주세요">
					<input type="text" placeholder="담임목사님 성함을 입력해주세요">
					<input type="text" placeholder="교회위치를 입력해주세요">
				</dd>
			</dl>
		</div>
		
		<button onclick="location.href='./register_form03.php'" class="btn_submit ft_btn">다음 단계</button>
	</article>
</div>


<?php
include_once('./_tail.php');
?>
