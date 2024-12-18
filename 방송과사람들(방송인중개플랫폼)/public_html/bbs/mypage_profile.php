<?
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");

$name = "cmypage";
$pid = "mypage_form";
$g5['title'] = '전문가 프로필관리';
include_once('./_head.php');

$mb = get_member($member[mb_id]);

if($mb == null) alert("로그인 해주세요", G5_URL);

?>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
<style>
    @media screen and (max-width:1024px) {
        #area_my{display: none;}
        #ft{display: none;}
    }


    /*프로필 스텝위자드*/
    #profile_form.tab-content{margin: 0; padding: 0;}
    .sw>.progress{margin-bottom: 4px;}
    .sw>.progress>.progress-bar{background: #0c0cba;}

    .sw-theme-basic>.nav .nav-link{margin-right: 0; display: flex;align-items: center; padding: 1rem;}
    .sw>.nav .nav-link>span{line-height: 1.2em;}
    .sw-theme-basic>.nav .nav-link.active{background:#0c0cba; color: #fff!important;}
    .sw-theme-basic>.nav .nav-link.active::after{background:#0c0cba!important;}
    .sw-theme-basic>.nav .nav-link.done{color: #ccc!important; background: #eee;}
    .sw-theme-basic>.nav .nav-link.done::after{background: #ddd;}

    .sw>.tab-content>.tab-pane{visibility:visible; min-height: 200px; padding: 2rem;}
    .sw>.tab-content>.tab-pane{}

    #smartwizard .btn_confirm{display: flex; gap: 4px; padding: 0.5em 1em;}
    #smartwizard .btn_confirm button{width: 100%; height: auto}
    #smartwizard .btn_confirm .btn_submit{width: 100%; border-radius: 5px!important; padding:13px 10px; font-size: 15px!important; letter-spacing:-0.2px!important; font-weight: 500; background: #0c0cba}

    @media screen and (max-width:1024px) {
        #smartwizard .btn_confirm{position: fixed; background: #fff; width: 100%; left: 0; bottom: 0; z-index: 998;}

    }
    @media screen and (max-width: 640px){
        .sw>.nav{flex-direction: unset!important; flex-wrap:nowrap;}
        .sw>.nav .nav-link>span{display: none;}
        .sw-theme-basic>.nav .nav-link{margin-right: 0; text-align: center;}
        .sw>.nav .nav-link>.num {
            font-size: 1em;
            text-align: center;
            width: 100%;
        }
    }
</style>

    <div id="area_mypage" class="profile">
		<div class="inr" id="app">
            <?php include('./mypage_banner.php'); ?>
			<div id="mypage_wrap">
				<?php include_once('./mypage_info.php'); ?>

                <?if ($member['mb_level'] == 2) {?>
                    <profile-client mb_no="<?=$member['mb_no']?>"></profile-client>
                <?} else if ($member['mb_level'] == 3) {?>
                    <profile-main mb_no="<?=$member['mb_no']?>"></profile-main>
                <?}?>



                <!-- 마이페이지에만 나오는 메뉴 -->
				<?php include_once('./mypage_menu.php'); ?>
			</div>
		</div>

    </div>

<?
$jl->vueLoad();
//foreach ($jl->getDir("/component/profile") as $data) {
//    echo $data."<br>";
//}

//$jl->includeDir("/component/profile");
include_once($jl->ROOT."/component/profile/profile-client.php");
include_once($jl->ROOT."/component/profile/profile-main.php");
include_once($jl->ROOT."/component/profile/profile-section1.php");
include_once($jl->ROOT."/component/profile/profile-section2.php");
include_once($jl->ROOT."/component/profile/profile-section3.php");
include_once($jl->ROOT."/component/profile/profile-section4.php");
include_once($jl->ROOT."/component/profile/profile-section5.php");
include_once($jl->ROOT."/component/profile/profile-section6.php");
include_once($jl->ROOT."/component/profile/profile-section7.php");
include_once($jl->ROOT."/component/profile/profile-section8.php");
?>
<script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>

<script>
    $(function() {
        // Smart Wizard 초기화
        $('#smartwizard').smartWizard({
            transition: {
                animation: 'slideHorizontal' // Step content 애니메이션: none|fade|slideHorizontal|slideVertical|slideSwing|css
            },
            toolbar: {
                showNextButton: false, // 다음 버튼 표시
                showPreviousButton: false, // 이전 버튼 표시
            },
            onLeaveStep: function (obj, context) {
                // 마지막 단계에 도달한 경우 버튼 텍스트 변경
                if (context.toStep === 7) { // Step 7 is the last step
                    $('#next-btn').text('프로필 저장하기');
                } else {
                    $('#next-btn').text('저장하고 다음');
                }
            }
        });
    });
</script>



<?
include_once('./_tail.php');
?>

