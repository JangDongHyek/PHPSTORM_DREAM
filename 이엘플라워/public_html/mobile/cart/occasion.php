	
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>이엘플라워</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta http-equiv="Cache-Control" content="no-cache"/>
<meta http-equiv="Expires" content="0"/>
<meta http-equiv="Pragma" content="no-cache"/>
<meta http-equiv="imagetoolbar" content="no">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no;" />

<!-- #if expr="$HTTP_USER_AGENT=/^Mozilla/" --><!--#else -->
<meta name='description' content=''>
<meta name='keywords' content=''>



<!-- #endif -->
<script language="javascript" src="../js/common_login.js" type="text/javascript"></script>
<script language="javascript" src="../js/common.js" type="text/javascript"></script>
<script language=javascript src='../js/menu_select.js' type="text/javascript"></script>
<script type="text/javascript" src="../js/jquery-1.7.min.js"></script>
<script type="text/javascript" src="../js/jquery.slides.min.js"></script><!--메인슬라이드-->
<script type="text/javascript" src="../js/ui.js"></script><!--공통-->
<script language='JavaScript' src='../js/printEmbed.js'></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>Untitled Document</title>
<meta http-equiv="imagetoolbar" content="no">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!--
function really(){
	if(confirm("삭제하시겠습니까?")) return true;
	else return false;
}
//-->
</SCRIPT>
<style>
	.accodion{
		
		width:100%;
		float:left;
		padding-left:0px;
		height:40px;
		line-height:40px;
		cursor:pointer;
	}
	.accodion .accodion-title{
		font-size:15px;
		font-weight:bold;
		width:100%;
		float:left;
		height:40px;
		line-height:40px;
		background-color:#eeeeee;
		border:1px solid #ccc;
		
	}
	.accodion .accidon-msg{
		width:100%;
		background-color:#fff;
		
		
	}
	.accodion .accodion-msg li{
		height:25px;
		float:left;
		width:100%;
		border-bottom:1px solid #ccc;
		padding:10px;
	
	}
</style>
<script type="text/javascript">
	$(function(){
		//큰 타이틀 클릭할 때
		$(".accodion-title").bind("click",function(){
			var index=$(this).index()/2;
			$(".accidon-msg").slideUp();
			if($(".accodion-msg").eq(index).css("display")=="none"){
				$(".accodion-msg").eq(index).slideDown();
			}else{
				$(".accodion-msg").eq(index).slideUp();
			}
		});
		//내용을 클릭할 때
		$(".accodion-msg li").bind("click",function(){
			$(opener.document).find("#<?=$id?>").val($(this).html());
			self.close();
		});
	});
</script>
</head>
<script language='JavaScript' src='../printEmbed.js'></script>
<body topmargin="0" leftmargin="0">
	<div class="accodion">
		<a class="accodion-title">&nbsp;결혼</a>
		<ul class="accodion-msg" style="display:none">
			<li>祝結婚 (축결혼)</li>
			<li>祝華婚 (축화혼)</li>
			<li>祝成婚 (축성혼)</li>
			<li>祝約婚 (축약혼)</li>
			<li>結婚(결혼)을 祝賀(축하)합니다</li>
			<li>언니 그때 그 남자가 아닌가봐</li>
			<li>결혼은 너 혼자 하냐? 나도 좀 같이하자</li>
			<li>니가 가는걸 보니 우리도 희망이 있네</li>
			<li>신부친구들은 연락처를 남기시오</li>
			<li>어서와~ 결혼은 처음이지?</li>
			<li>OO야! 이제 외롭다고 울면서 전화 하지마!</li>
			<li>약한남자 박OO 숟가락 들 힘도 없는데 어떡하지</li>
			<li>재혼땐 화환 없습니다</li>
			<li>화환 두 번은 못해준다</li>
			<li>두 번째 화환은 더 크게 해줄게</li>
			<li>떨지마라! 두번째 잘하면 된다</li>
			<li>도망쳐!! 아직 늦지 않았어!</li>
			<li>오빠 결혼하면 할인해 드릴게요 자주오세요 -상남동 화이팀 룸싸룸 일동</li>
			<li>오빠 장가가서도 자주 찾아주세요 /전국노래방도우미협회</li>
			<li>OO오빠 그동안 주신 팁 고마웠어요 ^^</li>
			<li>선배에서 오빠로, 오빠에서 남편으로</li>
			<li>00아 우리 이제 헤어지는거야? ㅋ</li>
			<li>결혼과 죽음은 미룰수록 좋다</li>
			<li>니 크기에 결혼이 웬말이냐</li>
			<li>공부대신 연애하더니♡동기1호 부부탄생♡</li>
			<li>그냥 개나 키우며 살자더니 나 혹시 니 결혼 사회 보냐</li>
		</ul>
		<a class="accodion-title">&nbsp;장례</a>
		<ul class="accodion-msg" style="display:none">
			<li>삼가 故人의 冥福을 빕니다</li>
			<li>謹弔 (근조)</li>
			<li>賻儀 (부의)</li>
			<li>弔意 (조의)</li>
			<li>弔悼 (조도)</li>
			<li>追慕 (추모)</li>
			<li>追悼 (추도)</li>
			<li>慰靈 (위령)</li>
			<li>哀棹 (애도)</li>
			<li>追慕 (추모)</li>
			<li>昇華 (승화)</li>
			<li>四十九日齊 (49일제)</li>
			<li>百日脫喪 (백일탈상)</li>
			<li>甲祀 (갑사)</li>
			<li>極樂往生 (극락왕생)</li>
		</ul>
		<a class="accodion-title">&nbsp;개업·창립에 축하하는 말</a>
		<ul class="accodion-msg" style="display:none">
			<li>祝開業 (축개업)</li>
			<li>祝發展 (축발전)</li>
			<li>祝盛業 (축성업)</li>
			<li>祝繁榮 (축번영)</li>
			<li>祝移轉 (축이전)</li>
			<li>祝開場 (축개장)</li>
			<li>祝開店 (축개점)</li>
			<li>祝開院 (축개원)</li>
			<li>祝擴張移轉 (축확장이전)</li>
			<li>돈세다 잠드소서</li>
			<li>성공하면 친하게 지내자</li>
			<li>니가 마신 술만큼만 팔아라(술집개업)</li>
			<li>공부는 꼴찌. 사업은 일등</li>
			<li>공부는 꼴찌지만 돈은 일등으로 벌어라</li>
			<li>돈다발 호로록</li>
			<li>사장될 줄 알았으면 잘할걸</li>
			<li>오빠 우리 다시 만나-전여친</li>
			<li>아이스아메리카노 뜨겁게주세요 (카페)</li>
			<li>우유뺀 라떼주세요(카페)</li>
			<li>멋있는 커피! 맛있는 사장님!(카페)</li>
			<li>현금 로스팅중♥ (카페)</li>
			<li>삼가 참치/닭들의 명복을 빕니다(횟집/치킨집)</li>
			<li>초밥 사케 호로록 호로록(횟집)</li>
			<li>000 저도 참 좋아하는데요 제가 한번 먹어보겠습니다</li>
			<li>적당히 물꺼면 뭐하러 쳐먹노</li>
			<li>만수르가 돈 꾸러 오게 하소서</li>
			<li>야옹아 멍멍해봐 개업 축하축하 ♥(동물병원개원축하문구)</li>
			<li>오빠! 대박나도 나 잊지마!</li>
			<li>화분 줄게요 복근줘요(피트니스 개업식)</li>
			<li>개원을 축하하며 뜻한 일 모두 성취하시기 바랍니다</li>
			<li>開業을 祝賀합니다 (개업을 축하합니다)</li>
			<li>無窮한 發展을 祈願합니다 (무궁한 발전을 기원합니다)</li>
			<li>祝創立 (축창립)</li>
			<li>週 (주)年記念 (년기념)</li>
			<li>祝創刊 (축창간)</li>
			<li>祝創設 (축창설)</li>
			<li>창립을 축하하며 앞날의 번영을 기원합니다.</li>
			<li>祝創立○○周年 記念 (축창립○○주년 기념)</li>
		</ul>
		<a class="accodion-title">&nbsp;결혼기념일</a>
		<ul class="accodion-msg" style="display:none">
			<li>紙婚式 (지혼식/1주년)</li>
			<li>藁婚式 (고혼식/2주년)</li>
			<li>菓婚式 (과혼식/3주년)</li>
			<li>革婚式 (혁혼식/4주년)</li>
			<li>木婚式 (목혼식/5주년)</li>
			<li>花婚式 (화혼식/7주년)</li>
			<li>錫婚式 (석혼식/10주년)</li>
			<li>摩婚式 (마혼식/12주년)</li>
			<li>銅婚式 (동혼식/15주년)</li>
			<li>陶婚式 (도혼식/20주년)</li>
			<li>銀婚式 (은혼식/25주년)</li>
			<li>眞珠婚式 (진주혼식/30주년)</li>
			<li>珊湖婚式 (산호혼식/35주년)</li>
			<li>紅玉婚式 (홍옥혼식/45주년)</li>
			<li>金婚式 (금혼식/50주년)</li>
			<li>金剛婚式 (금강혼식/60주년)</li>
			<li>回婚式 (회혼식/60주년) </li>
			<li>結婚記念日을 祝賀드립니다 (결혼기념일을 축하드립니다) </li>
		</ul>
		<a class="accodion-title">&nbsp;출산</a>
		<ul class="accodion-msg" style="display:none">
			<li>祝公主誕生 (축공주탄생)</li>
			<li>祝王子誕生 (축왕자탄생)</li>
			<li>순산을 축하하며 산모의 건강을 기원합니다</li>
			<li>이제 아빠 엄마가 되셨군요. 축하합니다</li>
			<li>사랑스런 아기의 탄생을 축하합니다</li>
			<li>왕자님(공주님) 탄생을 축하합니다</li>
			<li>得男(득남,得女득녀)을 祝賀(축하)합니다</li>
			<li>祝出産 (축출산)</li>
			<li>祝順産 (축순산)</li>
			<li>祝得男 (축득남)</li>
			<li>祝得女(축득녀)</li>
		</ul>
		<a class="accodion-title">&nbsp;생일을 축하하는 말</a>
		<ul class="accodion-msg" style="display:none">
			<li>祝耳順 (축이순/60세)</li>
			<li>祝六旬 (축육순/60세)</li>
			<li>祝還甲 (축환갑/61세)</li>
			<li>祝回甲 (축회갑/61세)</li>
			<li>祝壽宴 (축수연/61세)</li>
			<li>祝進甲 (축진갑/62세)</li>
			<li>祝美壽 (축미수/66세)</li>
			<li>祝古稀 (축고희/70세)</li>
			<li>祝七旬 (축칠순/70세)</li>
			<li>祝從心 (축종심/70세)</li>
			<li>祝喜壽 (축희수/77세)</li>
			<li>祝八旬 (축팔순/80세)</li>
			<li>祝傘壽 (축산수/80세)</li>
			<li>祝米壽 (축미수/88세)</li>
			<li>祝九旬 (축구순/90세)</li>
			<li>祝卒壽 (축졸수/90세)</li>
			<li>祝白壽 (축백수/99세)</li>
			<li>祝天壽 (축천수/99세)</li>
			<li>생일을 축하합니다</li>
			<li>생신을 진심으로 축하드리며 더욱 건강하세요</li>
			<li>生辰(생신)을 祝賀(축하)드립니다</li>
			<li>아기의 첫 생일, 예쁘고 건강하게 키워주세요!</li>
			<li>아기의 첫돌을 축하하며 더욱 건강하게 자라길 기원합니다.</li>
			<li>아기의 행복한 탄생일을 축하해요!</li>
			<li>첫돌을 맞이한 아기에게 더없이 큰 사랑과 축복이 깃들기를 바랄게요!</li>
			<li>첫돌을 축하하며 더욱 건강하게 자라길 바란다.</li>
		</ul>
		<a class="accodion-title">&nbsp;입학·졸업을 축하하는 말</a>
		<ul class="accodion-msg" style="display:none">
			<li>祝入學 (축입학)</li>
			<li>祝卒業 (축졸업)</li>
			<li>祝合格 (축합격)</li>
			<li>謹慰勞功(근위노공)</li>
			<li>祝博士學位記授與 (축박사학위기수여)</li>
			<li>祝碩士學位記授與(축석사학위기수여)</li>
		</ul>
		<a class="accodion-title">&nbsp;우승·입선·당선을 축하하는 말</a>
		<ul class="accodion-msg" style="display:none">
			<li>祝優勝 (축우승)</li>
			<li>祝施 (축시)</li>
			<li>祝當選 (축당선)</li>
			<li>祝入選 (축입선)</li>
		</ul>
		<a class="accodion-title">&nbsp;전람회·음악회를 축하하는 말</a>
		<ul class="accodion-msg" style="display:none">
			<li>祝展覽會 (축전람회)</li>
			<li>祝展示會 (축전시회)</li>
			<li>祝品評會 (축품평회)</li>
			<li>祝個人展 (축개인전)</li>
			<li>祝博覽會 (축박람회)</li>
			<li>祝演奏會 (축연주회)</li>
			<li>祝獨唱會 (축독창회)</li>
		</ul>
		<a class="accodion-title">&nbsp;공연·전시회</a>
		<ul class="accodion-msg" style="display:none">
			<li>祝發表會 (축발표회)</li>
			<li>祝出版記念 (축출판기념)</li>
			<li>祝發刊 (축발간)</li>
			<li>CONGRATULATIONS</li>
		</ul>
		<a class="accodion-title">&nbsp;이사를 축하하는 말</a>
		<ul class="accodion-msg" style="display:none">
			<li>祝落成 (축낙성)</li>
			<li>祝起工 (축기공)</li>
			<li>祝着工 (축착공)</li>
			<li>祝竣工 (축준공)</li>
			<li>祝除慕式 (축제모식)</li>
			<li>祝開院 (축개원)</li>
			<li>祝開館 (축개관)</li>
			<li>祝開通 (축개통)</li>
		</ul>
		<a class="accodion-title">&nbsp;건축관계의 축하하는 말</a>
		<ul class="accodion-msg" style="display:none">
			<li>祝落成 (축낙성)</li>
			<li>祝起工 (축기공)</li>
			<li>祝着工 (축착공)</li>
			<li>祝竣工 (축준공)</li>
			<li>祝除慕式 (축제모식)</li>
			<li>祝開院 (축개원)</li>
			<li>祝開館 (축개관)</li>
			<li>祝開通 (축개통)</li>
		</ul>
		<a class="accodion-title">&nbsp;교회에서 축하하는 말</a>
		<ul class="accodion-msg" style="display:none">
			<li>祝長老長立 (축장로장립)</li>
			<li>祝洗禮 (축세례)</li>
			<li>祝獻堂 (축헌당)</li>
			<li>祝入堂 (축입당)</li>
			<li>祝牧師按手 (축목사안수)</li>
			<li>祝勸士就任 (축권사취임)</li>
			<li>祝執事按手 (축집사안수)</li>
			<li>祝牧師委任 (축목사위임)</li>
		</ul>
		<a class="accodion-title">&nbsp;환자를 위문하는 말</a>
		<ul class="accodion-msg" style="display:none">
			<li>快癒 (쾌유)</li>
			<li>祈祝快癒 (기축쾌유)</li>
			<li>回春(회춘)</li>
			<li>快癒를 祈願합니다 (쾌유를 기원합니다) </li>
		</ul>
		<a class="accodion-title">&nbsp;승진·영전·취임·퇴임</a>
		<ul class="accodion-msg" style="display:none">
			<li>祝昇進 (축승진)</li>
			<li>祝榮轉 (축영전)</li>0
			<li>祝榮進 (축영진)</li>
			<li>祝就任 (축취임)</li>
			<li>祝任官 (축임관)</li>
			<li>祝轉任 (축전임)</li>
			<li>祝移任 (축이임)</li>
			<li>祝離就任式 (축이취임식)</li>
			<li>祝進級 (축진급)</li>
			<li>祝赴任 (축부임)</li>
			<li>祝轉役 (축전역)</li>
			<li>昇進을 祝賀합니다(승진을 축하합니다)</li>
			<li>승진을 축하하오며 더 큰 영광이 있기를 기원합니다</li>
			<li>진급을 축하하며 힘찬 전진을 기대합니다</li>
			<li>榮轉을 祝賀합니다(영전을 축하합니다)</li>
			<li>赴任을 祝賀합니다(부임을 축하합니다)</li>
			<li>취임을 축하하오며 앞날의 더 큰 영광을 기원합니다.</li>
			<li>취임을 축하하며 원대한 포부 펼치시기 바랍니다.</li>
			<li>취임을 진심으로 축하하오며 뜻한바 모두 이루시기 바랍니다.</li>
			<li>취임을 경하하며 성공과 건투를 바랍니다.</li>
			<li>오늘의 뜻깊은 취임이 더 큰 영광과 기쁨으로 이어지기 바랍니다.</li>
			<li>就任을 祝賀합니다(취임을 축하합니다)</li>
			<li>취임을 경하하며 성공과 건투를 바랍니다</li>
			<li>謹祝 (근축)</li>
			<li>頌功 (송공)</li>
			<li>祝停年退任 (축정년퇴임)</li>
			<li>그간 노고에 감사드립니다</li>
			<li>앞날의 행운과 건강을 기원합니다</li>
			<li>새 인생의 출발점이 되시기 기원합니다</li>
			<li>명예로운 정년퇴임하심을 축하합니다.</li>
			<li>그간의 업적을 기리며 앞날의 행운을 기원합니다.</li>
			<li>퇴임을 맞아 앞으로 더욱 건강하시기를 기원합니다.</li>
			<li>정년퇴임하심을 축하하오며 앞으로 더욱 건강하시기를 기원합니다.</li>
			<li>영예로운 퇴임이 새 인생의 출발점이 되시기를 기원합니다.</li>
			<li>영예로운 정년퇴임이 새 인생의 출발점이 되시기를 기원합니다.</li>
			<li>그간 노고를 치하하며 앞날의 행운과 건강을 기원합니다.</li>
			<li>그간의 빛나는 업적은 우리의 자랑으로 길이 기억될 것입니다.</li>
			<li>많은 노고에 깊이 감사드립니다.</li>
		</ul>
	</div>
</body>
</html>
