<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
$arr_wr2 = explode('|',$write['wr_2']);
$arr_wr2 = array_filter($arr_wr2);
$arr_wr14 = explode('|',$write['wr_14']);
$arr_wr14 = array_filter($arr_wr14);
$arr_wr20 = explode('|',$write['wr_20']);
$arr_wr24 = explode('|',$write['wr_24']);
$arr_wr26 = explode('|',$write['wr_26']);
$sql="select * from g5_member where (mb_16 = '심판' or mb_16 = '대회관계자') and mb_17 = 1";
$result_smb = sql_query($sql);
$cnt_result = ceil(sql_num_rows($result_smb)/10);

function paging_self($cur_page, $total_page){		
		$str="";
		if($cur_page>1){		
        $str .= '<a href="javascript:void(0);" onclick="paging_list(1);"  class="pg_page pg_start">처음</a>'.PHP_EOL;	
		}
		if($cur_page>1)
		$str .= '<a href="javascript:void(0);" onclick="paging_list('.($cur_page-1).');" class="pg_page pg_prev">이전</a>'.PHP_EOL;  
		

	if($total_page <= $cur_page+2){
			$display_last = $total_page;
		}
		else{
			$display_last = $cur_page+2;
		}
		if($cur_page-2 >= 1){
			$display_start = $cur_page-2;
		}
		else{
			$display_start = 1;
		}



	for($i=$display_start; $i<=$display_last; $i++){

		if($i == $cur_page)
		  $str .= '<span class="sound_only">열린</span><strong class="pg_current">'.$i.'</strong><span class="sound_only">페이지</span>'.PHP_EOL;
		else     $str .= '<a href="javascript:void(0);" onclick="paging_list('.$i.');" class="pg_page">'.$i.'<span class="sound_only">페이지</span></a>'.PHP_EOL;
		
	}
	if($cur_page<$total_page){
	   $str .= '<a href="javascript:void(0);" onclick="paging_list('.($cur_page+1).');" class="pg_page pg_next">다음</a>'.PHP_EOL;
	}
	if($cur_page<$total_page){    
        $str .= '<a href="javascript:void(0);" onclick="paging_list('.$total_page.');" class="pg_page pg_end">맨끝</a>'.PHP_EOL;
	}     

    if ($str)
        return "<nav class=\"pg_wrap\"><span class=\"pg\">{$str}</span></nav>";
    else
        return "";
	}

?>

<section id="bo_w">

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
	<input type="hidden" name="wr_9" id="wr_9" value="<?php echo $write['wr_9']?>">
	<input type="hidden" name="wr_10" id="wr_10" value="<?php echo $write['wr_10']?>">

    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            $option .= PHP_EOL.'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'.PHP_EOL.'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= PHP_EOL.'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'.PHP_EOL.'<label for="html">html</label>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= PHP_EOL.'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'.PHP_EOL.'<label for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= PHP_EOL.'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'.PHP_EOL.'<label for="mail">답변메일받기</label>';
        }
    }

    echo $option_hidden;
    ?>
    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption><?php echo $g5['title'] ?></caption>
        <tbody>

	  <?php if ($is_orderby && $w=='u') { ?>
        <tr>
            <th scope="row"><label for="wr_orderby">우선순위</label></th>
            <td><input type="text" name="wr_orderby" value="<?php echo $orderby ?>" placeholder="높은값이 가장 위로 노출됩니다. " id="wr_orderby" class="frm_input" size="30"></td>
        </tr>
        <?php } ?>

        <tr>
            <th scope="row"><label for="wr_subject">지점명<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required"></td>
        </tr>
		

		<tr>
            <th scope="row"><label for="wr_1">전화번호<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" class="frm_input" value="<?=$write['wr_1']?>" name="wr_1"/></td>
        </tr>
				<tr>
            <th scope="row"><label for="wr_2">진료시간<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" class="frm_input" value="<?=$write['wr_2']?>" name="wr_2"/></td>
        </tr>

		<tr>
            <th scope="row"><label for="wr_content">주소<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_content" required value="<?=$write['wr_content']?>" id="input_content" size="50" class="frm_input" readonly placeholder="주소를 입력해주세요"/>&nbsp;<input type="text" name="wr_3" id="detailaddr" value="<?=$write['wr_3']?>"size="50" class="frm_input" placeholder="상세주소 입력해주세요"/></td>
        </tr>

<?
/*
?>
        <tr>
            <th scope="row">지점사진</th>
            <td>
                <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> :  용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                <?php if ($is_file_content) { ?>
                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input">
                <?php } ?>
                <?php if($w == 'u' && $file[$i]['file']) { ?>
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i; ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')'; ?> 파일 삭제</label>
                <?php } ?>
            </td>
        </tr>
<?
*/
?>

        </tbody>
        </table>
    </div>

    <div class="btn_confirm">
        <input type="submit" value="작성완료" id="btn_submit" class="btn_submit" accesskey="s">
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">취소</a>
    </div>
    </form>
</section>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=4d32fa97bb676df7f136e32d304145fc&libraries=services,clusterer,drawing"></script>
<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>


<script>


$("#input_content").click(function(){		
	var geocoder = new kakao.maps.services.Geocoder();
	 new daum.Postcode({
        oncomplete: function(data) {
		geocoder.addressSearch(data.roadAddress, function(result, status) {
			 if (status === kakao.maps.services.Status.OK) {	
				 
						var temp_y = result[0].y;
						var temp_x = result[0].x;
						xidx = temp_x.indexOf('.');
						yidx = temp_y.indexOf('.');

						temp_x = temp_x.substr(0,xidx+7);
						temp_y = temp_y.substr(0,yidx+7);

				       $("#wr_9").val(temp_y);
					   $("#wr_10").val(temp_x);					   

			 }});
			$("#input_content").val(data.roadAddress);			
		}
 }).open();
});




function fwrite_submit(f)
{
    <?php //echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

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
	if(!f.wr_subject.value){
		alert("대회명을 입력하세요");
		return false;
	}
	if(!f.wr_content.value){
		alert("주소를 입력하세요");
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

    <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}
</script>

