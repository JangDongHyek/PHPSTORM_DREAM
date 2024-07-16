<?php
include_once('./_common.php');

$g5['title'] = '기업 프로필 업데이트';
include_once('./_head.php');

loginCheck($member['mb_id'], '기업');
?>

<link rel="stylesheet" href="<?=G5_THEME_URL?>/mobile/skin/member/app_basic/style.css?v=<?= G5_CSS_VER ?>">
<style>
	.profile_top .list_step > li.active:before{width:80%;}
	.profile_content h3{text-align:center !important;}
    #join_info dl.add .input input {margin:unset !important;}
    .goods, .brand {border: unset !important;}
</style>

<div class="mbskin">
	<article class="box-article">
		<h3>기업 프로필 업데이트</h3>
        <form method="post" autocomplete="off">
            <div id="area_join" class="profile">
                <div id="join_info">
                    <div class="profile_top">
                        <ul class="list_step">
                            <li>
                                <em>1</em>
                                <span>회사요약</span>
                            </li>
                            <li>
                                <em>2</em>
                                <span>회사 소개</span>
                            </li>
                            <li>
                                <em>3</em>
                                <span>인증, 카달로그, 소개영상</span>
                            </li>
                            <li class="active">
                                <em>4</em>
                                <span>취급 제품 및 브랜드</span>
                            </li>
                            <li>
                                <em>5</em>
                                <span>해시태그</span>
                            </li>
                        </ul>
                    </div>
                    <div class="profile_content">
                        <dl class="row add first">
                            <dt>취급제품 및 서비스<em>*선택</em><button type="button" onclick="add('goods');">+추가</button></dt>
                            <dd>
                                <div class="input">
                                    <ul class="catalog_list goods_list">
                                        <?php if(empty($member['mb_goods_service'])) { ?>
                                        <li class="goods_1">
                                            <button type="button" class="btn_close" onclick="del('goods', 1);"></button>
                                            <input type="text" id="mb_goods_1" name="mb_goods[]" class="regist-input goods" placeholder="취급제품 및 서비스를 입력해 주세요.">
                                        </li>
                                        <?php } ?>
                                        <?php
                                        if(!empty($member['mb_goods_service'])) {
                                            $mb_goods = explode('|', $member['mb_goods_service']);
                                            for($i=0; $i<count($mb_goods); $i++) {
                                        ?>
                                        <li class="goods_<?=$i+1?>">
                                            <button type="button" class="btn_close" onclick="del('goods', <?=$i+1?>);"></button>
                                            <input type="text" id="mb_goods_<?=$i+1?>" name="mb_goods[]" value="<?=$mb_goods[$i]?>" class="regist-input goods" placeholder="취급제품 및 서비스를 입력해 주세요.">
                                        </li>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </dd>
                        </dl>
                        <dl class="row add">
                            <dt>브랜드<em>*선택</em><button type="button" onclick="add('brand');">+추가</button></dt>
                            <dd>
                                <div class="input">
                                    <ul class="catalog_list brand_list">
                                        <?php if(empty($member['mb_brand'])) { ?>
                                        <li class="brand_1">
                                            <button type="button" class="btn_close" onclick="del('brand', 1);"></button>
                                            <input type="text" id="mb_brand_1" name="mb_brand[]" class="regist-input brand" placeholder="브랜드를 입력해 주세요.">
                                        </li>
                                        <?php } ?>
                                        <?php
                                        if(!empty($member['mb_brand'])) {
                                            $mb_brand = explode('|', $member['mb_brand']);
                                            for($i=0; $i<count($mb_brand); $i++) {
                                        ?>
                                        <li class="brand_<?=$i+1?>">
                                            <button type="button" class="btn_close" onclick="del('brand', <?=$i+1?>);"></button>
                                            <input type="text" id="mb_brand_<?=$i+1?>" name="mb_brand[]" value="<?=$mb_brand[$i]?>" class="regist-input brand" placeholder="브랜드를 입력해 주세요.">
                                        </li>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </dd>
                        </dl>
                        <div class="area_btn">
                            <a href="javascript:void(0);" class="btn_prev"><span onclick="pre_move('company_update03', '<?=$company?>');">이전단계<em class="pc">로 이동하기</em></span></a>
                            <!-- input 작성하면 다음버튼으로 나오게 해주세요 -->
                            <a href="<?php echo G5_BBS_URL ?>/profile_company_update05.php" class="btn_next active">다음</a>
                            <a href="javascript:void(0);" class="btn_confirm home active">수정완료</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
	</article>
</div>

<script>
    $(function() {
        form_check();

        // input 전부 작성 시 active 클래스 추가
        $(":input").on("change keyup", function(e) {
            form_check();
        });
    });

    // 폼체크(내용 입력 시 다음버튼 활성화)
    function form_check() {
        var goods_flag = false; // 취급제품 및 서비스 입력 확인
        $('.goods_list li input').each(function() {
            if($.trim(this.value).length != 0) {
                goods_flag = true;
            }
        });

        var brand_flag = false; // 브랜드 입력 확인
        $('.brand_list li input').each(function() {
            if($.trim(this.value).length != 0) {
                brand_flag = true;
            }
        });

        if(goods_flag || brand_flag) {
            //$('.btn_next').text('다음');
            $('.btn_next').attr('href', 'javascript:profile_update("company", "profile04", "update05", "", "<?=$company?>");'); // (구분(일반/기업), 현재프로필단계, 저장후이동경로, 파일유무, )
        } else {
            //$('.btn_next').text('건너뛰기');
            $('.btn_next').attr('href', 'javascript:pre_move("company_update05", "<?=$company?>")');
        }
        var param1 = '<?=$company?>' == 'Y' ? 'home' : 'mypage';
        $('.home').attr('href', 'javascript:profile_update("company", "profile04", "update05", "", "'+param1+'");');
    }

    // 취급제품 및 서비스 추가, 브랜드 추가
    var num1 = '<?php echo (!empty($member['mb_goods_service'])) ? count($mb_goods_service)+1 : 2; ?>';
    var num2 = '<?php echo (!empty($member['mb_brand'])) ? count($mb_brand)+1 : 2; ?>';
    var num = 0;
    function add(gubun) {
        if($('.'+gubun).length == 10) {
            swal('최대 10개까지 등록할 수 있습니다.');
            return false;
        }

        var txt = "";
        if(gubun == 'goods') { num = num1; txt = "취급제품 및 서비스" }
        else if(gubun == 'brand') { num = num2; txt = "브랜드"}

        var html = '<li class="'+gubun+'_'+num+'"><button type="button" class="btn_close" onclick="del(\''+gubun+'\','+num+');"></button><input type="text" id="mb_'+gubun+'_'+num+'" name="mb_'+gubun+'[]" class="regist-input '+gubun+'" placeholder="'+txt+'를 입력해 주세요." onkeyup="form_check();"></li>';
        $('.'+gubun+'_list').append(html);

        if(gubun == 'goods') { num1++; }
        else if(gubun == 'brand') { num2++; }
    }

    // 취급제품 및 서비스 삭제, 브랜드 삭제
    function del(gubun,num) {
        $('.'+gubun+'_'+num).remove();
    }
</script>

<?
include_once('./_tail.php');
?>
