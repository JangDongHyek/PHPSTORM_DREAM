<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$row = sql_fetch("select sum(wr_content) as wr_content from {$write_table} where wr_parent = '{$wr_id}' and wr_is_comment = '1'");
$sum = $row['wr_content'];
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<section id="bo_w">
    <h2 id="container_title">에셋 <?php echo $ca_name;?></h2>
	<?php if($w=="u" && $ca_name == "판매"){ ?>
	<div>※ 최소 거래중인 <span style="color:#DA2820; font-size:1.25em; font-weight:bold;"><?php echo number_format($sum);?></span> 에셋 이상 입력하셔야합니다.</div>
	<?php } ?>
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
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
    <input type="hidden" name="ca_name" id="ca_name" value="<?php echo $ca_name ?>">
    <input type="hidden" name="wr_1" id="wr_1" value="<?php echo $wr_1 ?>">
    <input type="hidden" name="wr_sum" id="wr_sum" value="<?php echo $sum ?>">
	<div class="div_form">
		<dl>
			<dd>
				<input type="number" name="wr_subject" id="wr_subject" value="<?php echo $subject ?>" class="frm_input required" required placeholder="<?php echo $ca_name;?>에셋" style="width:100%;">
			</dd>
		</dl>
		<dl>
			<dd>
				<input type="number" name="wr_content" id="wr_content" value="<?php echo $content ?>" class="frm_input required" required placeholder="1에셋 단가" style="width:100%;">
			</dd>
		</dl>
	</div>

    <div class="text-center" style="padding:10px;">
        <input type="submit" value="작성완료" id="btn_submit" class="btn btn-primary btn-sm" accesskey="s">
    </div>
    </form>
</section>

<?php if($ca_name == "판매"){ ?>
<article class="slg-text">
    <h4>골드에셋의 무한가치 상승기준~</h4>
    <h3>초기사업자에게 드리는 디지털자산의 재테크상품으로</h3>
    <p>디지털 에셋의 가치는 회원증가에 의한 변동에 준하여 거래를 할 수 있습니다.</p>
    <img src="<?php echo $mypage_skin_url?>/img/myasset_img2.png" width="100%" alt="">
    위캐시 골드는 회원직접거래와 캐시로 충전하여 구매할 수 있으며 보유량 대비 에셋10%의 수익을 누릴 수 있습니다.
</article>
<?php } else if($ca_name == "구매"){ ?>
<article class="slg-text">
    <h4>실물거래 1,000만 회원목표</h4>
    <p>위캐시골드는 1,000만회원확보와 글로벌을 목표로 새로운 재테크의 대안으로서 주식 코인 상품등 단점극복, 
    안전성을 고려하여 발행한 디지털사잔으로 미래의 더큰 자산성장이 될 것입니다.</p>
    <img src="<?php echo $mypage_skin_url?>/img/myasset_img.png" width="100%" alt="">
    융복합 디지털에셋의 가치팽창은 스타트업 자산으로 자체거래소를 통해 
    실물경제의 즉각적 유통과 거래가 가능하며 위캐시의 성장가도에 동반팽창하는 가치의 자산입니다.
</article>
<?php } ?>
<script>

<?php if($write_min || $write_max) { ?>
// 글자수 제한
var char_min = parseInt(<?php echo $write_min; ?>); // 최소
var char_max = parseInt(<?php echo $write_max; ?>); // 최대
check_byte("wr_content", "char_count");

$(function() {
    $("#wr_content").on("keyup", function() {
        check_byte("wr_content", "char_count");
    });
});

<?php } ?>
function html_auto_br(obj)
{
    if (obj.checked) {
        result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
        if (result)
            obj.value = "html2";
        else
            obj.value = "html1";
    }
    else
        obj.value = "";
}

function fwrite_submit(f)
{
    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": f.wr_subject.value,
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (subject) {
        alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
        f.wr_subject.focus();
        return false;
    }

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        if (typeof(ed_wr_content) != "undefined")
            ed_wr_content.returnFalse();
        else
            f.wr_content.focus();
        return false;
    }

    if (document.getElementById("char_count")) {
        if (char_min > 0 || char_max > 0) {
            var cnt = parseInt(check_byte("wr_content", "char_count"));
            if (char_min > 0 && char_min > cnt) {
                alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                return false;
            }
            else if (char_max > 0 && char_max < cnt) {
                alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                return false;
            }
        }
    }
	
	<?php if($ca_name == "판매"){ ?>
	var asset = parseInt(document.getElementById("wr_subject").value);
	var myAsset = <?php echo $member['mb_asset']; ?>;
	var trAsset = <?php echo $sum; ?> + asset;

	if(myAsset < asset){
		alert("보유 에셋보다 많은 에셋을 팔 수 없습니다.");
		return false;
	}

	if(myAsset < trAsset){
		alert("이미 거래중인 에셋의 합계가 판매하려는 에셋보다 많습니다. 확인 후 다시 시도해주세요");
		return false;
	}
	<?php } ?>

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}
</script>
