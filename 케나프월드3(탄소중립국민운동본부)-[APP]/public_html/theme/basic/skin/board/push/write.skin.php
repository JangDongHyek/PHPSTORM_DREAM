<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<div id="send_book" style="width:100%; margin:0 auto;">
	<div id="num_book"></div>
</div>

<nav class="pg_wrap">
    <span class="pg" id="person_pg"></span>
</nav>

<script src="<?= G5_URL ?>/js/jquery.sms_paging.js"></script>
<script>
function overlap_check()
{
    var hp_list = document.getElementById('hp_list');
    var hp_number = document.getElementById('hp_number');
    var list = '';

    if (hp_list.length < 1) {
        alert('받는 사람을 입력해주세요.');
        hp_number.focus();
        return;
    }

    for (i=0; i<hp_list.length; i++)
        list += hp_list.options[i].value + '/';

    (function($){
        var $form = $("#form_sms");
        $form.find("input[name='send_list']").val( list );
        var params = $form.serialize();
        $.ajax({
            url: "<?=G5_BBS_URL?>/sms_write_overlap_check.php",
            cache:false,
            timeout : 30000,
            dataType:"html",
            data:params,
            success: function(data) {
                alert(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    })(jQuery);
}

var is_sms5_submitted = false;  //중복 submit방지
function sms5_chk_send(f)
{
    if( is_sms5_submitted == false ){
        is_sms5_submitted = true;
        var hp_list = document.getElementById('hp_list');
        var wr_message = document.getElementById('wr_message');
        var hp_number = document.getElementById('hp_number');
        var wr_reply = document.getElementById('wr_reply');
        var wr_reply_regExp = /^[0-9\-]+$/;
        var list = '';

        if (!wr_message.value) {
            alert('메세지를 입력해주세요.');
            wr_message.focus();
            is_sms5_submitted = false;
            return false;
        }
        if( !wr_reply_regExp.test(wr_reply.value) ){
            alert('회신번호 형식이 잘못 되었습니다.');
            wr_reply.focus();
            is_sms5_submitted = false;
            return false;
        }
        if (hp_list.length < 1) {
            alert('받는 사람을 입력해주세요.');
            hp_number.focus();
            is_sms5_submitted = false;
            return false;
        }

        for (i=0; i<hp_list.length; i++)
            list += hp_list.options[i].value + '/';

        w = document.body.clientWidth/2 - 200;
        h = document.body.clientHeight/2 - 100;
        act = window.open('sms_ing.php', 'act', 'width=300, height=200, left=' + w + ', top=' + h);
        act.focus();

        f.send_list.value = list;
        return true;
    } else {
        alert("데이터 전송중입니다.");
    }
}

function hp_list_del()
{
    var hp_list = document.getElementById('hp_list');

    if (hp_list.selectedIndex < 0) {
        alert('삭제할 목록을 선택해주세요.');
        return;
    }

    var regExp = "[_0-9a-zA-Z-]+",
        hp_number_option = hp_list.options[hp_list.selectedIndex],
        result = (hp_number_option.outerHTML.match(regExp));

    if( result !== null ){
        sms_obj.mb_id = sms_obj.array_remove( sms_obj.mb_id, result[0]);
    }
    hp_list.options[hp_list.selectedIndex] = null;
}

function book_change(id)
{
    var book_person = document.getElementById('book_person');
    var num_book    = document.getElementById('num_book');
    var menu_group  = document.getElementById('menu_group');
}

function booking(val)
{
    if (val)
    {
        document.getElementById('wr_by').disabled = false;
        document.getElementById('wr_bm').disabled = false;
        document.getElementById('wr_bd').disabled = false;
        document.getElementById('wr_bh').disabled = false;
        document.getElementById('wr_bi').disabled = false;
    }
    else
    {
        document.getElementById('wr_by').disabled = true;
        document.getElementById('wr_bm').disabled = true;
        document.getElementById('wr_bd').disabled = true;
        document.getElementById('wr_bh').disabled = true;
        document.getElementById('wr_bi').disabled = true;
    }
}

function add(str) {
    var conts = document.getElementById('wr_message');
    var bytes = document.getElementById('sms_bytes');
    conts.focus();
    conts.value+=str;
    byte_check('wr_message', 'sms_bytes');
    return;
}

function byte_check(wr_message, sms_bytes)
{
    var conts = document.getElementById(wr_message);
    var bytes = document.getElementById(sms_bytes);
    var max_bytes = document.getElementById("sms_max_bytes");

    var i = 0;
    var cnt = 0;
    var exceed = 0;
    var ch = '';

    for (i=0; i<conts.value.length; i++)
    {
        ch = conts.value.charAt(i);
        if (escape(ch).length > 4) {
            cnt += 2;
        } else {
            cnt += 1;
        }
    }

    bytes.innerHTML = cnt;

    <?php if($config['cf_sms_type'] == 'LMS') { ?>
    if(cnt > 90)
        max_bytes.innerHTML = 1500;
    else
        max_bytes.innerHTML = 90;

    if (cnt > 1500)
    {
        exceed = cnt - 1500;
        alert('메시지 내용은 1500바이트를 넘을수 없습니다.\n\n작성하신 메세지 내용은 '+ exceed +'byte가 초과되었습니다.\n\n초과된 부분은 자동으로 삭제됩니다.');
        var tcnt = 0;
        var xcnt = 0;
        var tmp = conts.value;
        for (i=0; i<tmp.length; i++)
        {
            ch = tmp.charAt(i);
            if (escape(ch).length > 4) {
                tcnt += 2;
            } else {
                tcnt += 1;
            }

            if (tcnt > 1500) {
                tmp = tmp.substring(0,i);
                break;
            } else {
                xcnt = tcnt;
            }
        }
        conts.value = tmp;
        bytes.innerHTML = xcnt;
        return;
    }
    <?php } else { ?>
    if (cnt > 80)
    {
        exceed = cnt - 80;
        alert('메시지 내용은 80바이트를 넘을수 없습니다.\n\n작성하신 메세지 내용은 '+ exceed +'byte가 초과되었습니다.\n\n초과된 부분은 자동으로 삭제됩니다.');
        var tcnt = 0;
        var xcnt = 0;
        var tmp = conts.value;
        for (i=0; i<tmp.length; i++)
        {
            ch = tmp.charAt(i);
            if (escape(ch).length > 4) {
                tcnt += 2;
            } else {
                tcnt += 1;
            }

            if (tcnt > 80) {
                tmp = tmp.substring(0,i);
                break;
            } else {
                xcnt = tcnt;
            }
        }
        conts.value = tmp;
        bytes.innerHTML = xcnt;
        return;
    }
    <?php } ?>
}

<?php
if ($mb_no) {
$row = sql_fetch("select * from {$g5['sms5_book_table']} where mb_no='$mb_no'");
?>

var hp_list = document.getElementById('hp_list');
var item    = "<?php echo $row['mb_name']?> (<?php echo $row['mb_id']?>)";
var value   = "p,<?php echo $row['mb_no']?>";

hp_list.options[hp_list.length] = new Option(item, value);

<?php } ?>

<?php
if ($fo_no) {
    $row = sql_fetch("select * from {$g5['sms5_form_table']} where fo_no='$fo_no'");
    $fo_content = str_replace(array("\r\n","\n"), "\\n", $row['fo_content']);
    echo "add(\"$fo_content\");";
}
?>

byte_check('wr_message', 'sms_bytes');
document.getElementById('wr_message').focus();
</script>

<?php

if ($wr_no)
{
    // 메세지와 회신번호
    $row = sql_fetch(" select * from {$g5['sms5_write_table']} where wr_no = '$wr_no' ");

    echo "<script>\n";
    echo "var hp_list = document.getElementById('hp_list');\n";
    //echo "add(\"$row[wr_message]\");\n";
    $wr_message = str_replace('"', '\"', $row['wr_message']);
    $wr_message = str_replace(array("\r\n","\n"), "\\n", $wr_message);
    echo "add(\"$wr_message\");\n";
    echo "document.getElementById('wr_reply').value = '{$row['wr_reply']}';\n";

    // 회원목록
    $sql = " select * from {$g5['sms5_history_table']} where wr_no = '$wr_no' and mb_no > 0 ";
    $qry = sql_query($sql);
    $tot = sql_num_rows($qry);

    if ($tot > 0) {

        $str = '재전송그룹 ('.number_format($tot).'명)';
        $val = 'p,';

        while ($row = sql_fetch_array($qry))
        {
            $val .= $row['mb_no'].',';
        }

        echo "hp_list.options[hp_list.length] = new Option('$str', '$val');\n";
    }

    // 비회원 목록
    $sql = " select * from {$g5['sms5_history_table']} where wr_no = '$wr_no' and mb_no = 0 ";
    $qry = sql_query($sql);
    $tot = sql_num_rows($qry);

    if ($tot > 0)
    {
        while ($row = sql_fetch_array($qry))
        {
            $str = "{$row['hs_name']} ({$row['hs_hp']})";
            $val = "h,{$row['hs_name']}:{$row['hs_hp']}";
            echo "hp_list.options[hp_list.length] = new Option('$str', '$val');\n";
        }
    }
    echo "</script>\n";
}
?>
<script>
$(function () {
	var book_person = document.getElementById('book_person');
        book_person.style.fontWeight   = 'bold';
});
$(function(){
    $(".box_txt").bind("focus keydown", function(){
        $("#wr_message_lbl").hide();
    });
    $(".write_scemo_btn").click(function(){
        $(".write_scemo").hide();
        $(this).next(".write_scemo").show();
    });
    $(".scemo_cls_btn").click(function(){
        $(".write_scemo").hide();
    });
});

var sms_obj={
    mb_id : [],
    el_box : "#num_book",
    person_is_search : false,
    array_remove : function(arr, item){
		$("#wr_gcm").val("");
        for(var i = arr.length; i--;) {
          if(arr[i] === item) {
              arr.splice(i, 1);
          } else {
			if($("#wr_gcm").val() == "") {
				$("#wr_gcm").val(arr[i]);
			} else {
				$("#wr_gcm").val($("#wr_gcm").val() + "," +  arr[i]);	
			}
		  }
        }
        return arr;
    },
    person_add : function(mb_no, mb_name, mb_id){
        var hp_list = document.getElementById('hp_list');
        var item    = mb_id;
        var value   = mb_name;

        for (i=0; i<hp_list.length; i++) {
            if (hp_list[i].value == value) {
                //alert('이미 같은 목록이 있습니다.');
                return;
            }
        }
        if( jQuery.inArray( mb_id , hp_list ) > -1 ){
           //alert('목록에 이미 같은 휴대폰 번호가 있습니다.');
           return;
        } else {
            this.mb_id.push( mb_id );
			if($("#wr_gcm").val() == "") {
				$("#wr_gcm").val(item);
			} else {
				$("#wr_gcm").val($("#wr_gcm").val() + "," +  item);	
			}
        }

		
        hp_list.options[hp_list.length] = new Option(item, value);
    }
};
(function($){
    $("#form_sms input[type=text], #form_sms select").keypress(function(e){
        return e.keyCode != 13;
    });
    sms_obj.fn_paging = function( hash_val,total_page,$el,$search_form ){
        $el.paging({
            current:hash_val ? hash_val : 1,
            max:total_page == 0 || total_page ? total_page : 45,
            length : 5,
            liitem : 'span',
            format:'{0}',
            next:'다음',
            prev:'이전',
            sideClass:'pg_page pg_next',
            prevClass:'pg_page pg_prev',
            first:'&lt;&lt;',last:'&gt;&gt;',
            href:'#',
            itemCurrent:'pg_current',
            itemClass:'pg_page',
            appendhtml:'<span class="sound_only">페이지</span>',
            onclick:function(e,page){
                e.preventDefault();
                $search_form.find("input[name='page']").val( page );
                var params = '';
                if( sms_obj.person_is_search ){
                    params = $search_form.serialize();
                } else {
                    params = { page: page };
                }
                sms_obj.person_select( params, "html" );
            }
        });
    }
    sms_obj.person_select = function( params, type ){
        //emoticon_list.loading(sms_obj.el_box, "./img/ajax-loader.gif" ); //로딩 이미지 보여줌
        $.ajax({
            url: "<?=G5_BBS_URL?>/ajax.sms_write_person.php",
            cache:false,
            timeout : 30000,
            dataType:type,
            data:params,
            success: function(data) {
               $(sms_obj.el_box).html(data);
               var $sms_person_form = $("#sms_person_form", sms_obj.el_box),
                   total_page = $sms_person_form.find("input[name='total_pg']").val(),
                   current_page = $sms_person_form.find("input[name='page']").val()
               sms_obj.fn_paging( current_page, total_page, $("#person_pg", sms_obj.el_box), $sms_person_form );
               $sms_person_form.bind("submit", function(e){
                   e.preventDefault();
                   sms_obj.person_is_search = true;
                   $(this).find("input[name='total_pg']").val('');
                   $(this).find("input[name='page']").val('');
                   var params = $(this).serialize();
                   sms_obj.person_select( params, "html" );
                   //emoticon_list.loadingEnd(sms_obj.el_box); //로딩 이미지 지움
               });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    }
    sms_obj.triggerclick = function( sel ){
        $(sel).trigger("click");
    }
    $("#book_person").bind("click", function(e){
        e.preventDefault();
        book_change( $(this).attr("id") );
        sms_obj.person_is_search = false;
        sms_obj.person_select( '','html' );
    });
})(jQuery);

sms_obj.person_select( '','html' );
</script>

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
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">html</label>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
        }
    }

    echo $option_hidden;
    ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <tbody>
        <?php if ($is_name) { ?>
        <tr>
            <th scope="row"><label for="wr_name">이름<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" size="10" maxlength="20"></td>
        </tr>
        <?php } ?>

        <?php if ($is_password) { ?>
        <tr>
            <th scope="row"><label for="wr_password">비밀번호<strong class="sound_only">필수</strong></label></th>
            <td><input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" maxlength="20"></td>
        </tr>
        <?php } ?>

        <?php if ($is_email) { ?>
<!--        <tr>
            <th scope="row"><label for="wr_email">이메일</label></th>
            <td><input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input email" size="50" maxlength="100"></td>
        </tr>-->
        <?php } ?>

        <?php if ($is_homepage) { ?>
<!--        <tr>
            <th scope="row"><label for="wr_homepage">홈페이지</label></th>
            <td><input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input" size="50"></td>
        </tr>-->
        <?php } ?>

        <?php if ($is_category) { ?>
        <tr>
            <th scope="row"><label for="ca_name">분류<strong class="sound_only">필수</strong></label></th>
            <td>
                <select name="ca_name" id="ca_name" required class="required" >
                    <option value="">선택하세요</option>
                    <?php echo $category_option ?>
                </select>
            </td>
        </tr>
        <?php } ?>

		<tr>
		<th scope="row" style="width:80px"><label for="wr_gcm2">받는사람<strong class="sound_only"></strong></label></th>
		</th>
        <td id="write_recv" class="write_inner">
            <select MULTIPLE name="hp_list" id="hp_list" size="30" style="height:32px; width:150px;"></select>
			<input type="hidden" name="wr_gcm" value="" id="wr_gcm" class="frm_input" size="100" maxlength="255">
			<button type="button" class="write_floater write_floater_btn" onclick="hp_list_del()">선택삭제</button>
        </td>
		</tr>
        <tr>
            <th scope="row"><label for="wr_subject">제목<strong class="sound_only">필수</strong></label></th>
            <td>
                <div id="autosave_wrapper">
                    <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required" size="50" maxlength="255">
                    <?php if ($is_member) { // 임시 저장된 글 기능 ?>
                    <script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
                    <?php if($editor_content_js) echo $editor_content_js; ?>
                    <?php } ?>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="wr_content">내용<strong class="sound_only">필수</strong></label></th>
            <td class="wr_content">
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                <?php } ?>
                <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                <?php } ?>
            </td>
        </tr>

        <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
        <tr>
            <th scope="row">파일 #<?php echo $i+1 ?></th>
            <td>
                <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                <?php if ($is_file_content) { ?>
                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
                <?php } ?>
                <?php if($w == 'u' && $file[$i]['file']) { ?>
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>

        <?php if ($is_guest) { //자동등록방지  ?>
        <tr>
            <th scope="row">자동등록방지</th>
            <td>
                <?php echo $captcha_html ?>
            </td>
        </tr>
        <?php } ?>

        </tbody>
        </table>
    </div>

	
    <div class="btn_confirm" style="text-align:center">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn btn-info btn_blue btn-sm">
        <a href="<?=G5_BBS_URL?>/board.php?bo_table=<?php echo $bo_table ?>" class="btn_frmline">취소</a>
    </div>
    </form>

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
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"<?=G5_BBS_URL?>/ajax.filter.php",
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

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->