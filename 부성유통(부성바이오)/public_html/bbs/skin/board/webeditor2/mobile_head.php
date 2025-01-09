<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
<title>모바일홈페이지</title>
<link rel="stylesheet" type="text/css" href="<?=$skin_board_url?>board.css"/>
<link rel="stylesheet" type="text/css" href="../mobile/css/m_style.css" />
</head>

<body>
<!-- 탑메뉴-->
<? include '../mobile/top.htm'; ?>
<!--// 탑메뉴-->
<!--2DEPTH MENU -->
<!--<?if($bbs_id == "pro_gal01" || $bbs_id == "pro_gal02" || $bbs_id == "pro_gal03"){?>
<div class="subm2">
		<dl>
		 <dd><a href="../bbs/mobile_list.php?bbs_id=pro_gal01" <?if($bbs_id == "pro_gal01"){?>class="on"<?}?>>아파트</a></dd>
		<dd><a href="../bbs/mobile_list.php?bbs_id=pro_gal02" <?if($bbs_id == "pro_gal02"){?>class="on"<?}?>>학원/학교/모텔/상가</a></dd>
		<dd><a href="../bbs/mobile_list.php?bbs_id=pro_gal03" <?if($bbs_id == "pro_gal03"){?>class="on"<?}?>>도배/장판/씽크대/목작업</a></dd>
		</dl>
</div>
<?}?>-->
<div class="subm">
		<dl>
		 	<dd><a href="../bbs/mobile_view.php?bbs_id=casee&doc_num=34&ss[fc]=27" class="on">극복사례</a></dd>
		</dl>
</div>
<div style="padding:3px; text-align:center;">
<form id="form1" name="form1" method="post" action="">
      <select name="select" onchange="window.open(this.options[this.selectedIndex].value,'_self')">
        <option>----------병명을 선택해주세요----------</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=34&ss[fc]=27">폐암</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=50&ss[fc]=28">간암</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=65&ss[fc]=29">췌장암</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=66&ss[fc]=30">직장암</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=36&ss[fc]=31">자궁암</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=37&ss[fc]=32">갑상선암</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=38&ss[fc]=33">위암</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=52&ss[fc]=34">난소암</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=39&ss[fc]=35">백혈병</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=40&ss[fc]=36">대장암</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=46&ss[fc]=37">유방암</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=55&ss[fc]=38">뇌암</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=42&ss[fc]=39">담도암</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=44&ss[fc]=40">방광암</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=45&ss[fc]=2">B형간염, 간질환</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=15&ss[fc]=3">고혈압</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=49&ss[fc]=41">심장질환</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=56&ss[fc]=4">신부전증</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=16&ss[fc]=5">갱년기장애</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=53&ss[fc]=6">뇌혈관장애</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=17&ss[fc]=7">알레르기</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=18&ss[fc]=8">아토피</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=19&ss[fc]=9">피부미용(여드름)</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=64&ss[fc]=10">다이어트</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=63&ss[fc]=11">변비</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=62&ss[fc]=12">위장장애</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=20&ss[fc]=13">관절질환</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=21&ss[fc]=14">백발 흑모화</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=22&ss[fc]=15">빈혈</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=23&ss[fc]=16">고지혈증</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=61&ss[fc]=17">기미 주근깨</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=43&ss[fc]=18">검버섯</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=24&ss[fc]=19">만성피로</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=25&ss[fc]=20">당뇨병</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=26&ss[fc]=21">만성두통</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=27&ss[fc]=22">신경계질환</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=60&ss[fc]=23">통풍</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=59&ss[fc]=24">여성질환</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=58&ss[fc]=25">눈질환</option>
        <option value="../bbs/mobile_view.php?bbs_id=casee&doc_num=57&ss[fc]=26">치질</option>
      </select>
</form>
</div>

<!--//2DEPTH MENU -->
<div class="board_list">

<SCRIPT LANGUAGE="JavaScript">
<!--
function img_new_window(name,title) {
	if(name=='')
		return;
	var x=screen.width/2-150/2; //창을 화면 중앙으로 위치 
	var y=(screen.height-30)/2-150/2;
	window.open('<?=$skin_board_url?>img_view.php?image='+name+'&title='+title,'','width=150,height=150,scrollbars=1,resizable=1,top='+y+',left='+x)
}
//-->
</SCRIPT>
<!--<div class="board_login">
	<span>
		<? if(!$mb){?>
		<?=$a_login?><IMG src="<?=$skin_site_url?>images/head_img01.gif" border=0></a>
		<? }else{?>
		<?=$a_logout?><IMG src="<?=$skin_site_url?>images/head_img06.gif" border=0></a>
		<? }?>
	</span>
</div>-->

