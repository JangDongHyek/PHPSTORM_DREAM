<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_CSS_URL.'/style.css">', 0);
?>
<style>
	.video-view{
		width:100%;
		height:100%;
		background-color:rgba(0,0,0,0.8);
		position:fixed;
		top:0px;
		left:0px;
		display:none;
		z-index:99999999;
		text-align:center;
		padding-top:100px;
	}
	.video-close{
		position:absolute;
		top:30px;
		right:50px;
		text-align:right;
		z-index:9999999999;
		color:#fff;
		font-size:40px;
		font-weight:bold;
		cursor:pointer;
	}
	.video_txt{ color:#fff; margin-top:20px; font-size:1.4em;}
	#skip{ width:100px; text-align:center; font-size:1.3em; margin:20px auto; border:2px solid #fff; line-height:40px; border-radius:10px;}
	#skip:hover{ background:#fff; color:#3d6afe !important;}
@media screen and (max-width:767px) {
	.video-view{
		padding-top:50px;
	}
	.video-close{
		top:5px;
		right:20px;
		font-size:30px;
	}
	.video-view #video{ width:95%; margin:0 auto;}
}
	
</style>
<link rel="stylesheet" href="<?=G5_CSS_URL?>/jquery.lineProgressbar.css" rel="stylesheet"/>
<script src="<?php echo G5_JS_URL?>/jquery.lineProgressbar.js"></script>
<?php if($config['cf_kakao_js_apikey']) { ?>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script src="<?php echo G5_JS_URL; ?>/kakaolink.js"></script>
<script>
    // 사용할 앱의 Javascript 키를 설정해 주세요.
    Kakao.init("<?php echo $config['cf_kakao_js_apikey']; ?>");
</script>
<?php } ?>






<!-- 상품진열 10 시작 { -->
<?php
$sql="select * from g5_write_movie m left outer join g5_board_file f on f.wr_id=m.wr_id where f.bo_table='movie' and m.wr_2 = 't'";
$result2=sql_query($sql);
$tempMovieArr=array();
while($row2=sql_fetch_array($result2)){
    if(empty($row2['wr_1'])){
       continue;
    }

    $item_no = explode(",",$row2['wr_1']);

    for($i=0; $i<count($item_no); $i++){
        $tempMovieArr[$item_no[$i]][] = G5_DATA_URL."/file/movie/".$row2[bf_file];
    }
}
for ($i=0; $row=sql_fetch_array($result); $i++) {
    if ($i == 0) {
        if ($this->css) {
            echo "<ul id=\"sct_wrap\" class=\"{$this->css}\">\n";
        } else {
            echo "<div id=\"sct_wrap_bd\"><ul id=\"sct_wrap\" class=\"sct sct_10\">\n";
        }
    }
    $movieArr = $tempMovieArr[$row['it_id']];
    shuffle($movieArr);
	$rand=rand(0,count($movieArr)-1);

    if($i % $this->list_mod == 0)
        $li_clear = ' sct_clear';
    else
        $li_clear = '';

    echo "<li class=\"col-xs-6 col-sm-3 sct_li sct_li2{$li_clear}\"><div class=\"inner-bd\">\n";

    if ($this->href) {
        if(empty($movieArr) || count($movieArr) == 0){
            echo "<div class='sct_img'><a href='" . $this->href . $row['it_id'] . "&ca_id=" . $_GET['ca_id'] . "' class='sct_a'>\n";
        } else {
            echo "<div class=\"sct_img\"><a onclick=\"viewMovie('{$this->href}{$row['it_id']}&ca_id={$_GET['ca_id']}','{$movieArr[$rand]}')\" class=\"sct_a\">\n";
        }

    }

    if ($this->view_it_img) {
        echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']), true)."\n";
    }

    if ($this->href) {
        echo "</a></div>\n";
    }
	if($row[it_1]){
		echo "<div class=\"progress\" style=\"display:none\">".$row[it_1]."%</div>";
		echo "<div class=\"progressBar\" id=\"progressBar".$i."\"></div>";
	}

    if ($this->view_it_id) {
        echo "<div class=\"sct_id\">&lt;".stripslashes($row['it_id'])."&gt;</div>\n";
    }

    if ($this->href) {
        if(empty($movieArr) || count($movieArr) == 0){
            echo "<div class=\"sct_txt\"><a href='" . $this->href . $row['it_id'] . "&ca_id=" . $_GET['ca_id'] . "' class=\"sct_a\">\n";
        } else {
            echo "<div class=\"sct_txt\"><a onclick=\"viewMovie('{$this->href}{$row['it_id']}&ca_id={$_GET['ca_id']}','{$movieArr[$rand]}')\" class=\"sct_a\">\n";
        }

    }

    if ($this->view_it_name) {
        echo stripslashes($row['it_name'])."\n";
    }


    if ($this->href) {
        echo "</a></div>\n";
    }
	
    if ($this->view_it_basic) {
		echo "<div class=\"sct_basic\">\n";
        echo stripslashes($row['it_basic'])."\n";
		echo "</div>\n";
    }

    if ($this->view_it_price) {
        echo "<div class=\"sct_cost\">\n";
        echo display_price(get_price($row), $row['it_tel_inq'])."\n";
        echo "</div>\n";
    }
	if($_GET['ca_id']=="20"){
		$btnText = "참여";	
	}else{
		$btnText = "참여";
	}

    if(empty($movieArr) || count($movieArr) == 0){
        echo "<div class=\"btn-a\"><a href=\"" . $this->href . $row['it_id'] . "\" class=\"btn btn-primary btn-shop\" style=\"color:#fff\">" . $btnText . "하기</a></div>";
    } else {
        echo "<div class=\"btn-a\"><a  onclick=\"viewMovie('{$this->href}{$row['it_id']}','{$movieArr[$rand]}')\" class=\"btn btn-primary btn-shop\" style=\"color:#fff\">{$btnText}하기</a></div>";
    }

	?>
	<script type="text/javascript">
		$(function(){
			$("#progressBar<?=$i?>").LineProgressbar({
				percentage : <?=intval($row[it_1])?>,
				fillBackgroundColor:'blue',
				height:'6px',
				width:'100%',
			});
			$("#progressBar<?=$i?> .percentCount").css("left","<?=$row[it_1]?>%");
	});
	</script>
	<?
    echo "</div></li>\n";
}

if ($i > 0) echo "</ul></div>\n";

if($i == 0) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
?>
<script type="text/javascript">
	var goUrl="";
	function viewMovie(url,href){
		goUrl=url;
		//goItem();
		$("#video-view").css("display","block");
		$("#video").attr("src",href);
		var width=($(window).width())/2;
		$("#video").attr("width",width);
		setTimeout("viewSkip()","15000");
	}

	function viewSkip(){
		$("#skip").toggle();
	}
	function goItem(){
		location.href=goUrl;
	}
	$(function(){
		$("#video-close").click(function(){
			$("#video").get(0).pause();
			$("#video-view").css("display","none");
			$("#skip").css("display","none");
		});
	});


</script>
<!-- } 상품진열 10 끝 -->
<div class="video-view" id="video-view">
	<div class="video-close" id="video-close"><i class="fal fa-times"></i></div>
	<video id="video" controls autoplay></video>
    <div class="video_txt">광고 시청은 상품 구매에 도움을 됩니다.<br />15초 후 상세페이지로 이동하실 수 있습니다!</div>
	<div id="skip" style="color:#fff;display:none;cursor:pointer" onclick="goItem()">SKIP</div>
</div>
