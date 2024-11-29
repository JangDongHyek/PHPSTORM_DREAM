<?php
if (!defined('_GNUBOARD_')) exit;

$begin_time = get_microtime();

include_once(G5_PATH.'/head.sub.php');

function print_menu1($key, $no)
{
    global $menu;

    $str = print_menu2($key, $no);

    return $str;
}

function print_menu2($key, $no)
{
    global $menu, $auth_menu, $is_admin, $auth, $g5;

    $str .= "<ul class=\"gnb_2dul\">";
    for($i=1; $i<count($menu[$key]); $i++)
    {
        if ($is_admin != 'super' && (!array_key_exists($menu[$key][$i][0],$auth) || !strstr($auth[$menu[$key][$i][0]], 'r')))
            continue;

        if (($menu[$key][$i][4] == 1 && $gnb_grp_style == false) || ($menu[$key][$i][4] != 1 && $gnb_grp_style == true)) $gnb_grp_div = 'gnb_grp_div';
        else $gnb_grp_div = '';

        if ($menu[$key][$i][4] == 1) $gnb_grp_style = 'gnb_grp_style';
        else $gnb_grp_style = '';

        $str .= '<li class="gnb_2dli"><a href="'.$menu[$key][$i][2].'" class="gnb_2da '.$gnb_grp_style.' '.$gnb_grp_div.'">'.$menu[$key][$i][1].'</a></li>';

        $auth_menu[$menu[$key][$i][0]] = $menu[$key][$i][1];
    }
    $str .= "</ul>";

    return $str;
}

// 팀장, 프로, 관리자 로그인 시 가로 모드
if($member['mb_level'] > 7) {
?>
<script src="<?php echo G5_JS_URL ?>/common.js?v=<?=G5_JS_VER?>"></script>
<script>
    <?php if( 0 < strpos($_SERVER['HTTP_USER_AGENT'],"OSJNGK")) { ?>
    webkit.messageHandlers.scriptHandler.postMessage(false); // 가로모드
    <?php } else if($android_flag) { ?>
    window.Android.landscape();
    <?php } ?>
</script>
<?php
}
?>

<script>
var tempX = 0;
var tempY = 0;

function imageview(id, w, h)
{

    menu(id);

    var el_id = document.getElementById(id);

    //submenu = eval(name+".style");
    submenu = el_id.style;
    submenu.left = tempX - ( w + 11 );
    submenu.top  = tempY - ( h / 2 );

    selectBoxVisible();

    if (el_id.style.display != 'none')
        selectBoxHidden(id);
}
</script>
<script type="text/javascript">
    // 푸시 및 앱 버전정보
    function fcmKey(token, agent, version1, version2) {
        $.ajax({
            type : "post",
            url : g5_bbs_url + "/ajax.fcm_key.php",
            data : {token : token, agent: agent, version1: version1, version2: version2},
        }).done(function(data, textStatus, xhr) {
        });
    }

    // 푸시 및 앱 버전정보 (iOS)
    function fcmKey2(token, agent, version1, version2) {
        $.ajax({
            url: g5_bbs_url + "/ajax.token.register.php",
            data: {token: token, agent: agent, version1: version1, version2: version2},
            dataType: "html",
            type: "POST",
            success: function (data) {
            }
        });
    }
</script>
<div id="to_content"><a href="#container">본문 바로가기</a></div>

<header id="hd">
    <div id="hd_wrap">
        <h1><?php echo $config['cf_title'] ?></h1>

        <div id="logo">
            <a href="<?php echo G5_ADMIN_URL ?>"><img src="<?php echo G5_URL ?>/img/logo.png" alt="<?php echo $config['cf_title'] ?> 관리자"></a>

            <div class="logo_txt">
            <?php if($member['mb_level'] == 10) { ?>관리자<?php } ?>
            <?php if($member['mb_level'] == 9) { ?>팀장<?php } ?>
            <?php if($member['mb_level'] == 8) { ?>프로<?php } ?>
            <!--<a href="<?php /*echo G5_BBS_URL */?>/logout.php" style="font-size: 10px;">로그아웃(테스트)</a>-->
            </div><!--.logo_txt-->
        </div>

        <ul id="tnb">
            <!--<li><a href="<?php /*echo G5_ADMIN_URL */?>/member_form.php?w=u&amp;mb_id=<?php /*echo $member['mb_id'] */?>">관리자정보</a></li>-->
            <? if($_SESSION['ss_mb_id']=="lets080"){ ?>
			<li><a href="<?php echo G5_ADMIN_URL ?>/config_form.php">기본환경</a></li>
            <li><a href="<?php echo G5_ADMIN_URL ?>/service.php">부가서비스</a></li>
            <? } ?>
			<?php /*?><li style="font-weight:900;"><a href="<?php echo G5_URL ?>/" target="_blank">사이트바로가기</a></li><?php */?>
            <?php if(defined('G5_USE_SHOP')) { ?>
            <li><a href="<?php echo G5_ADMIN_URL ?>/shop_admin/configform.php">쇼핑몰환경</a></li>
            <li><a href="<?php echo G5_SHOP_URL ?>/">쇼핑몰</a></li>
            <?php } ?>
            <li id="tnb_logout"><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
        </ul>

        <nav id="gnb">
            <h2>관리자 주메뉴</h2>
            <?php
            $gnb_str = "<ul id=\"gnb_1dul\" class=\"scroller\" >";
            foreach($amenu as $key=>$value) {
                $href1 = $href2 = $target = '';
                if ($menu['menu'.$key][0][2]) {
                    if ($key=="800") $target = 'target="_balnk"';
                    $href1 = '<a href="'.$menu['menu'.$key][0][2].'" class="gnb_1da" '.$target.'>';
                    $href2 = '</a>';
                } else {
                    continue;
                }
                $current_class = "";
                if (isset($sub_menu) && (substr($sub_menu, 0, 3) == substr($menu['menu'.$key][0][0], 0, 3)))
                    $current_class = " gnb_1dli_air";
                $gnb_str .= '<li class="gnb_1dli'.$current_class.'">'.PHP_EOL;
                $gnb_str .=  $href1 . $menu['menu'.$key][0][1] . $href2;
                $gnb_str .=  print_menu1('menu'.$key, 1);
                $gnb_str .=  "</li>";
            }
            $gnb_str .= "</ul>";
            echo $gnb_str;
            ?>
        </nav>

    </div><!--#hd_wrap-->




</header>
<?php if($sub_menu) { ?>
<div id="lnb_wrap">
    <ul id="lnb">
    <?php
    $menu_key = substr($sub_menu, 0, 3);
    $nl = '';
    foreach($menu['menu'.$menu_key] as $key=>$value) {
        if($key > 0) {
            if ($is_admin != 'super' && (!array_key_exists($value[0],$auth) || !strstr($auth[$value[0]], 'r')))
                continue;

            if($value[3] == 'cf_service')
                $svc_class = ' class="lnb_svc"';
            else
                $svc_class = '';

            echo $nl.'<li><a href="'.$value[2].'"'.$svc_class.'>'.$value[1].'</a></li>';
            $nl = PHP_EOL;
        }
    }
    ?>
    </ul>
</div> <!--#lnb_wrap-->
<?php } ?>

<div id="wrapper">

    <div id="container">
       <?php /*?> <div id="text_size">
            <!-- font_resize('엘리먼트id', '제거할 class', '추가할 class'); -->
            <button onclick="font_resize('container', 'ts_up ts_up2', '');"><img src="<?php echo G5_ADMIN_URL ?>/img/ts01.gif" alt="기본"></button>
            <button onclick="font_resize('container', 'ts_up ts_up2', 'ts_up');"><img src="<?php echo G5_ADMIN_URL ?>/img/ts02.gif" alt="크게"></button>
            <button onclick="font_resize('container', 'ts_up ts_up2', 'ts_up2');"><img src="<?php echo G5_ADMIN_URL ?>/img/ts03.gif" alt="더크게"></button>
        </div><?php */?>


        <div class="cont_title"><?php echo $g5['title'] ?></div>
