<?php
$sub_menu = "100290";
include_once('./_common.php');


if ($is_admin != 'super')
    alert_close('최고관리자만 접근 가능합니다.');

$g5['title'] = '서브메뉴 추가';
include_once(G5_PATH.'/head.sub.php');

// 코드
if($new == 'new' || !$code) {
    $code = base_convert(substr($code,0, 2), 36, 10);
    $code += 36;
    $code = base_convert($code, 10, 36);
}
?>

<div id="submenu_frm" class="new_win">
    <h1><?php echo $g5['title']; ?></h1>

    <form name="fsubmenuform" id="fsubmenuform">

    <div class="new_win_desc">
        <label for="sm_type">대상선택</label>
        <select name="sm_type" id="sm_type">
            <option value="board">게시판</option>
            <option value="content">내용관리</option>
        </select>
    </div>

    <div id="submenu_result"></div>

    </form>

</div>

<script>
$(function() {
    $("#submenu_result").load(
        "./submenu_form_search.php"
    );

    $("#sm_type").on("change", function() {
        var type = $(this).val();

        $("#submenu_result").empty().load(
            "./submenu_form_search.php",
            { type : type }
        );
    });

    $(document).on("click", "#add_manual", function() {
        var sm_name = $.trim($("#sm_name").val());
        var sm_link = $.trim($("#sm_link").val());
        var sm_tid = $.trim($("#sm_tid").val());

        add_submenu_list(sm_name, sm_link, sm_tid, "<?php echo $code; ?>", 0);
    });

    $(document).on("click", ".add_select", function() {
        var sm_name = $.trim($(this).siblings("input[name='subject[]']").val());
        var sm_link = $.trim($(this).siblings("input[name='link[]']").val());
        var sm_tid = $.trim($(this).siblings("input[name='sm_tid[]']").val());

        add_submenu_list(sm_name, sm_link, sm_tid, "<?php echo $code; ?>", 1);
    });
});

function add_submenu_list(name, link, sm_tid, code, stat)
{
	var sm_type = $("#sm_type").val();
    var $submenulist = $("#submenulist", opener.document);
    var ms = new Date().getTime();
    var sub_menu_class;
    <?php if($new == 'new') { ?>
    sub_menu_class = " class=\"td_category\"";
    <?php } else { ?>
    sub_menu_class = " class=\"td_category sub_menu_class\"";
    <?php } ?>
	var stat_select0, stat_select1;
	if(stat == 0) stat_select0 = "selected";
	if(stat == 1) stat_select1 = "selected";

    var list = "<tr class=\"submenu_list submenu_group_<?php echo $code; ?>\">";
	list += "<td class=\"td_mng\">";
	list += "<label for=\"sm_tid_"+ms+"\" class=\"sound_only\">아이디<strong class=\"sound_only\"> 필수</strong></label>";
	list += "<input type=\"text\" name=\"sm_tid[]\" value=\""+sm_tid+"\" id=\"sm_tid_"+ms+"\" required class=\"required frm_input\">";
	list += "</td>";
	list += "<td class=\"td_mng\">";
	list += "<label for=\"sm_tid_"+ms+"\" class=\"sound_only\">분류<strong class=\"sound_only\"> 필수</strong></label>";
	list += "<select name=\"sm_type[]\">";
	list += "<option value=\"board\"";
	if(sm_type == "board")		list += " selected ";
	list += ">게시판</option>";
	list += "<option value=\"content\"";
	if(sm_type == "content")	list += " selected ";
	list += ">내용관리</option>";
	list += "</select>";
	list += "</td>";		
    list += "<td"+sub_menu_class+">";
    list += "<label for=\"sm_nasm_"+ms+"\"  class=\"sound_only\">서브메뉴<strong class=\"sound_only\"> 필수</strong></label>";
    list += "<input type=\"hidden\" name=\"code[]\" value=\"<?php echo $code; ?>\">";
    list += "<input type=\"text\" name=\"sm_name[]\" value=\""+name+"\" id=\"sm_nasm_"+ms+"\" required class=\"required frm_input full_input\">";
    list += "</td>";
    list += "<td>";

    <?php if($new == 'new') { ?>
    list += "<label for=\"sm_link_"+ms+"\"  class=\"sound_only\">링크<strong class=\"sound_only\"> 필수</strong></label>";
    list += "<input type=\"hidden\" name=\"sm_link[]\" value=\"-\" id=\"sm_link_"+ms+"\"> -";
    <?php } else { ?>
    list += "<label for=\"sm_link_"+ms+"\"  class=\"sound_only\">링크<strong class=\"sound_only\"> 필수</strong></label>";
    list += "<input type=\"text\" name=\"sm_link[]\" value=\""+link+"\" id=\"sm_link_"+ms+"\" required class=\"required frm_input full_input\">";
    <?php } ?>

    list += "</td>";
	
    list += "<td class=\"td_mng\">";
    list += "<label for=\"sm_course_"+ms+"\"  class=\"sound_only\">경로</label>";
    list += "<select name=\"sm_course[]\" id=\"sm_course_"+ms+"\">";
	list += "<option value=\"0\" "+stat_select0+">절대</option>";
    list += "<option value=\"1\" "+stat_select1+">상대</option>";
    list += "</select>";
    list += "</td>";

    list += "<td class=\"td_mng\">";
    list += "<label for=\"sm_target_"+ms+"\"  class=\"sound_only\">새창</label>";
    list += "<select name=\"sm_target[]\" id=\"sm_target_"+ms+"\">";
    list += "<option value=\"self\">사용안함</option>";
    list += "<option value=\"blank\">사용함</option>";
    list += "</select>";
    list += "</td>";
    list += "<td class=\"td_numsmall\">";
    list += "<label for=\"sm_order_"+ms+"\"  class=\"sound_only\">순서<strong class=\"sound_only\"> 필수</strong></label>";
    list += "<input type=\"text\" name=\"sm_order[]\" value=\"0\" id=\"sm_order_"+ms+"\" required class=\"required frm_input\" size=\"5\">";
    list += "</td>";
    list += "<td class=\"td_mngsmall\">";
    list += "<label for=\"sm_use_"+ms+"\"  class=\"sound_only\">PC사용</label>";
    list += "<select name=\"sm_use[]\" id=\"sm_use_"+ms+"\">";
    list += "<option value=\"1\">사용함</option>";
    list += "<option value=\"0\">사용안함</option>";
    list += "</select>";
    list += "</td>";
    list += "<td class=\"td_mngsmall\">";
    list += "<label for=\"sm_mobile_use_"+ms+"\"  class=\"sound_only\">모바일사용</label>";
    list += "<select name=\"sm_mobile_use[]\" id=\"sm_mobile_use_"+ms+"\">";
    list += "<option value=\"1\">사용함</option>";
    list += "<option value=\"0\">사용안함</option>";
    list += "</select>";
    list += "</td>";
    list += "<td class=\"td_mngsmall\">";
    <?php if($new == 'new') { ?>
    list += "<button type=\"button\" class=\"btn_add_subsubmenu\">추가</button>";
    <?php } ?>
    list += "<button type=\"button\" class=\"btn_del_submenu\">삭제</button>";
    list += "</td>";
    list += "</tr>";

    var $submenu_last = null;

    if(code)
        $submenu_last = $submenulist.find("tr.submenu_group_"+code+":last");
    else
        $submenu_last = $submenulist.find("tr.submenu_list:last");

	if($submenu_last.size() > 0) {
        $submenu_last.after(list);
    } else {
        if($submenulist.find("#empty_submenu_list").size() > 0)
            $submenulist.find("#empty_submenu_list").remove();

        $submenulist.find("table tbody").append(list);
    }

    $submenulist.find("tr.submenu_list").each(function(index) {
        $(this).removeClass("bg0 bg1")
            .addClass("bg"+(index % 2));
    });

    window.close();
}
</script>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>