<?php
$sub_menu = "100210";
include_once('./_common.php');

if ($is_admin != 'super')
    alert('최고관리자만 접근 가능합니다.');

// 서브메뉴테이블 생성
if( !isset($g5['submenu_table']) ){
    die('<meta charset="utf-8">dbconfig.php 파일에 <strong>$g5[\'submenu_table\'] = G5_TABLE_PREFIX.\'submenu\';</strong> 를 추가해 주세요.');
}

if(!sql_query(" DESCRIBE {$g5['submenu_table']} ", false)) {
    sql_query(" CREATE TABLE IF NOT EXISTS `{$g5['submenu_table']}` (
                  `sm_id` int(11) NOT NULL AUTO_INCREMENT,
                  `sm_code` varchar(255) NOT NULL DEFAULT '',
                  `sm_name` varchar(255) NOT NULL DEFAULT '',
                  `sm_link` varchar(255) NOT NULL DEFAULT '',
                  `sm_target` varchar(255) NOT NULL DEFAULT '0',
                  `sm_order` int(11) NOT NULL DEFAULT '0',
                  `sm_use` tinyint(4) NOT NULL DEFAULT '0',
                  `sm_mobile_use` tinyint(4) NOT NULL DEFAULT '0',
                  `sm_type` varchar(255) NOT NULL '',
                  `sm_tid` varchar(255) NOT NULL '',
                  `sm_course` varchar(255) NOT NULL '',
                  PRIMARY KEY (`sm_id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 ", true);
}

$sql = " select * from {$g5['submenu_table']} order by sm_id ";
$result = sql_query($sql);

$g5['title'] = "서브메뉴설정";
include_once('./admin.head.php');

$colspan = 10;
?>


<div class="local_desc01 local_desc">
    <p><strong>주의!</strong> 서브메뉴설정 작업 후 반드시 <strong>확인</strong>을 누르셔야 저장됩니다.</p>
    <p><strong>주의!</strong> 중복된 메뉴는 먼저 선언된 <strong>메뉴</strong>만 출력됩니다.</p>
</div>

<form name="fsubmenulist" id="fsubmenulist" method="post" action="./submenu_list_update.php" onsubmit="return fsubmenulist_submit(this);">
<input type="hidden" name="token" value="">

<div class="btn_add01 btn_add">
    <button type="button" onclick="return add_submenu();">서브메뉴추가<span class="sound_only"> 새창</span></button>
</div>

<div id="submenulist" class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">분류</th>
        <th scope="col">서브메뉴</th>
        <th scope="col">링크</th>
        <th scope="col">경로</th>
        <th scope="col">새창</th>
        <th scope="col">순서</th>
        <th scope="col">PC사용</th>
        <th scope="col">모바일사용</th>
        <th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $bg = 'bg'.($i%2);
        $sub_menu_class = '';
        if(strlen($row['sm_code']) == 4) {
            $sub_menu_class = ' sub_menu_class';
            $sub_menu_info = '<span class="sound_only">'.$row['sm_name'].'의 서브</span>';
            $sub_menu_ico = '<span class="sub_menu_ico"></span>';
        }

        $search  = array('"', "'");
        $replace = array('&#034;', '&#039;');
        $sm_name = str_replace($search, $replace, $row['sm_name']);
    ?>
    <tr class="<?php echo $bg; ?> submenu_list submenu_group_<?php echo substr($row['sm_code'], 0, 2); ?>">
        <td class="td_mng">
            <label for="sm_tid_<?php echo $i; ?>" class="sound_only"><?php echo $sub_menu_info; ?> 아이디<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="sm_tid[]" value="<?php echo $row['sm_tid']; ?>" id="sm_tid_<?php echo $i; ?>" required class="required frm_input">
		</td>
		<td class="td_mng">
            <label for="sm_tid_<?php echo $i; ?>" class="sound_only"><?php echo $sub_menu_info; ?> 분류<strong class="sound_only"> 필수</strong></label>
			<select name="sm_type[]">
				<option value="board" <?php if($row['sm_type']=="board") echo "selected";?>>게시판</option>
				<option value="content" <?php if($row['sm_type']=="content") echo "selected";?>>내용관리</option>
			</select>
		</td>
		<td class="td_category<?php echo $sub_menu_class; ?>">
            <input type="hidden" name="code[]" value="<?php echo substr($row['sm_code'], 0, 2) ?>">
            <label for="sm_nasm_<?php echo $i; ?>" class="sound_only"><?php echo $sub_menu_info; ?> 서브메뉴<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="sm_name[]" value="<?php echo $sm_name; ?>" id="sm_nasm_<?php echo $i; ?>" required class="required frm_input full_input">
        </td>
		<td>
			<?php if(strlen($row['sm_code']) == 4){ ?>
            <label for="sm_link_<?php echo $i; ?>" class="sound_only">링크<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="sm_link[]" value="<?php echo $row['sm_link'] ?>" id="sm_link_<?php echo $i; ?>" required class="required frm_input full_input">
			<?php }else{ ?>
			<input type="hidden" name="sm_link[]" value="-" id="sm_link_<?php echo $i; ?>"> -
			<?php } ?>
		</td>
		<td class="td_mng">
			<label for="sm_course" class="sound_only">경로<strong class="sound_only"> 필수</strong></label>
            <select name="sm_course[]" id="sm_course_<?php echo $i; ?>">
                <option value="0" <?php echo get_selected($row['sm_course'], '0', true); ?>>URL</option>
                <option value="1" <?php echo get_selected($row['sm_course'], '1', true); ?>>PATH</option>
            </select>
		</td>
        <td class="td_mng">
            <label for="sm_target_<?php echo $i; ?>" class="sound_only">새창</label>
            <select name="sm_target[]" id="sm_target_<?php echo $i; ?>">
                <option value="self"<?php echo get_selected($row['sm_target'], 'self', true); ?>>사용안함</option>
                <option value="blank"<?php echo get_selected($row['sm_target'], 'blank', true); ?>>사용함</option>
            </select>
        </td>
        <td class="td_num">
            <label for="sm_order_<?php echo $i; ?>" class="sound_only">순서</label>
            <input type="text" name="sm_order[]" value="<?php echo $row['sm_order'] ?>" id="sm_order_<?php echo $i; ?>" class="frm_input" size="5">
        </td>
        <td class="td_mng">
            <label for="sm_use_<?php echo $i; ?>" class="sound_only">PC사용</label>
            <select name="sm_use[]" id="sm_use_<?php echo $i; ?>">
                <option value="1"<?php echo get_selected($row['sm_use'], '1', true); ?>>사용함</option>
                <option value="0"<?php echo get_selected($row['sm_use'], '0', true); ?>>사용안함</option>
            </select>
        </td>
        <td class="td_mng">
            <label for="sm_mobile_use_<?php echo $i; ?>" class="sound_only">모바일사용</label>
            <select name="sm_mobile_use[]" id="sm_mobile_use_<?php echo $i; ?>">
                <option value="1"<?php echo get_selected($row['sm_mobile_use'], '1', true); ?>>사용함</option>
                <option value="0"<?php echo get_selected($row['sm_mobile_use'], '0', true); ?>>사용안함</option>
            </select>
        </td>
        <td class="td_mng">
            <?php if(strlen($row['sm_code']) == 2) { ?>
            <button type="button" class="btn_add_subsubmenu">추가</button>
            <?php } ?>
            <button type="button" class="btn_del_submenu">삭제</button>
        </td>
    </tr>
    <?php
    }

    if ($i==0)
        echo '<tr id="empty_submenu_list"><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" name="act_button" value="확인" class="btn_submit">
</div>

</form>

<script>
$(function() {
    $(document).on("click", ".btn_add_subsubmenu", function() {
        var code = $(this).closest("tr").find("input[name='code[]']").val().substr(0, 2);
        add_subsubmenu(code);
    });

    $(document).on("click", ".btn_del_submenu", function() {
        if(!confirm("서브메뉴를 삭제하시겠습니까?"))
            return false;

        var $tr = $(this).closest("tr");
        if($tr.find("td.sub_menu_class").size() > 0) {
            $tr.remove();
        } else {
            var code = $(this).closest("tr").find("input[name='code[]']").val().substr(0, 2);
            $("tr.submenu_group_"+code).remove();
        }

        if($("#submenulist tr.submenu_list").size() < 1) {
            var list = "<tr id=\"empty_submenu_list\"><td colspan=\"<?php echo $colspan; ?>\" class=\"empty_table\">자료가 없습니다.</td></tr>\n";
            $("#submenulist table tbody").append(list);
        } else {
            $("#submenulist tr.submenu_list").each(function(index) {
                $(this).removeClass("bg0 bg1")
                    .addClass("bg"+(index % 2));
            });
        }
    });
});

function add_submenu()
{
    var max_code = base_convert(0, 10, 36);
    $("#submenulist tr.submenu_list").each(function() {
        var sm_code = $(this).find("input[name='code[]']").val().substr(0, 2);
        if(max_code < sm_code)
            max_code = sm_code;
    });

    var url = "./submenu_form.php?code="+max_code+"&new=new";
    window.open(url, "add_submenu", "left=100,top=100,width=550,height=650,scrollbars=yes,resizable=yes");
    return false;
}

function add_subsubmenu(code)
{
    var url = "./submenu_form.php?code="+code;
    window.open(url, "add_submenu", "left=100,top=100,width=550,height=650,scrollbars=yes,resizable=yes");
    return false;
}

function base_convert(number, frombase, tobase) {
  //  discuss at: http://phpjs.org/functions/base_convert/
  // original by: Philippe Baumann
  // improved by: Rafał Kukawski (http://blog.kukawski.pl)
  //   example 1: base_convert('A37334', 16, 2);
  //   returns 1: '101000110111001100110100'

  return parseInt(number + '', frombase | 0)
    .toString(tobase | 0);
}

function fsubmenulist_submit(f)
{
    return true;
}
</script>

<?php
include_once ('./admin.tail.php');
?>
