<?php
$sub_submenu = "100210";
include_once('./_common.php');

check_demo();

if ($is_admin != 'super')
    alert('최고관리자만 접근 가능합니다.');

check_admin_token();

// 이전 서브메뉴정보 삭제
$sql = " delete from {$g5['submenu_table']} ";
sql_query($sql);

$group_code = null;
$primary_code = null;
$count = count($_POST['code']);

for ($i=0; $i<$count; $i++)
{
    $_POST = array_map_deep('trim', $_POST);

    $code    = $_POST['code'][$i];
    $sm_name = $_POST['sm_name'][$i];
    $sm_link = $_POST['sm_link'][$i];

    if(!$code || !$sm_name || !$sm_link)
        continue;

    $sub_code = '';
    if($group_code == $code) {
        $sql = " select MAX(SUBSTRING(sm_code,3,2)) as max_sm_code
                    from {$g5['submenu_table']}
                    where SUBSTRING(sm_code,1,2) = '$primary_code' ";
        $row = sql_fetch($sql);

        $sub_code = base_convert($row['max_sm_code'], 36, 10);
        $sub_code += 36;
        $sub_code = base_convert($sub_code, 10, 36);

        $sm_code = $primary_code.$sub_code;
    } else {
        $sql = " select MAX(SUBSTRING(sm_code,1,2)) as max_sm_code
                    from {$g5['submenu_table']}
                    where LENGTH(sm_code) = '2' ";
        $row = sql_fetch($sql);

        $sm_code = base_convert($row['max_sm_code'], 36, 10);
        $sm_code += 36;
        $sm_code = base_convert($sm_code, 10, 36);

        $group_code = $code;
        $primary_code = $sm_code;
    }

    // 서브메뉴 등록
    $sql = " insert into {$g5['submenu_table']}
                set sm_code         = '$sm_code',
                    sm_name         = '$sm_name',
                    sm_link         = '$sm_link',
                    sm_target       = '{$_POST['sm_target'][$i]}',
                    sm_order        = '{$_POST['sm_order'][$i]}',
                    sm_use          = '{$_POST['sm_use'][$i]}',
                    sm_mobile_use   = '{$_POST['sm_mobile_use'][$i]}',
                    sm_type         = '{$_POST['sm_type'][$i]}',
                    sm_tid          = '{$_POST['sm_tid'][$i]}',
                    sm_course       = '{$_POST['sm_course'][$i]}' ";
    sql_query($sql);
}


goto_url('./submenu_list.php');
?>
