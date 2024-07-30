<?
include_once('./_common.php');
$g5['title'] = '서비스등록';
include_once('./_head.php');
$name = "item_write";

//재능정보
$idx = $_REQUEST['idx'];
$sql = "select * from new_item left join new_category c on i.i_ctg = c.c_idx where i_idx = '{$idx}' ";
$view = sql_fetch($sql);

$main_ctg = ctg_list(0);

//$view_ctg = ctg_info($view["i_ctg"]);

if(!$is_member){
    alert("회원이시라면 로그인 후 이용해주세요.",G5_BBS_URL.'/login.php?url='.G5_BBS_URL."/item_write01.php" );
}

$c_name = ctg_info($view['c_p_idx'])["c_name"];
$c_name2 = $view["c_name"];
?>

<? if($name=="item_write") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="item_write">
<?}?>

<style>
	#ft_menu{display:none;}
</style>
<form id="fsave" name="fsave" action="./ajax.controller.php" method="post" onsubmit="return fsave_submit()">

    <span id="tab1" style="display: block">
        <div id="item_write">
                <input type="hidden" name="click_tab" id="click_tab" value="">
                <input type="hidden" name="now_tab" id="now_tab" value="1">

                <div class="inr v2" id="inr">
                <h3>서비스등록</h3>
                <div class="snb">
                    <ul class="list_step">
                    <li id="" class="active">
                        <a href="javascript:tab_click(1)">
                            <em>1</em>
                            <span>기본정보</span>
                        </a>
                    </li>
                    <li id="">
                        <a href="javascript:tab_click(2)">
                            <em>2</em>
                            <span>서비스 설명</span>
                        </a>
                    </li>
                    <li id="">
                        <a href="javascript:tab_click(3)">
                            <em>3</em>
                            <span>이미지 등록</span>
                        </a>
                    </li>
                    </ul>
                </div>
                <div class="box_list">
                    <!--포트폴리오에서 가져오기-->
                    <div class="portfolio text-right">
                        <button data-toggle="modal" data-target="#portfolioModal" class="btn"><i class="fa-regular fa-arrow-down-to-line"></i> 포트폴리오 불러오기</button>
                        <!-- 취소 및 환불규정 모달팝업/카테고리별로 환불 규정 내용이 달라집니다. 현재는 1차카테고리(디자인) > 2차카테고리(웹툰.캐릭터)를 임의로 선택하고 등록가정임-->
                        <div id="basic_modal">
                            <div class="modal fade" id="portfolioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-xmark"></i></button>
                                            <h4 class="modal-title" id="myModalLabel">포트폴리오 불러오기</h4>
                                        </div>
                                        <div class="modal-body">
                                            <ul id="product_list">
                                                <li class="nodata">
                                                    <div class="nodata_wrap">
                                                        <div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_nodata.svg"></div>
                                                        <p>등록한 포트폴리오가 없습니다.</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="https://itforone.com:443/~broadcast/bbs/portfolio_view.php">
                                                        <div class="area_img">
                                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                                        </div>
                                                        <div class="area_txt">
                                                            <span></span><!-- 업체명 -->
                                                            <h3>영상제작</h3> <!-- 제목 -->
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://itforone.com:443/~broadcast/bbs/portfolio_view.php">
                                                        <div class="area_img">
                                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                                        </div>
                                                        <div class="area_txt">
                                                            <span></span><!-- 업체명 -->
                                                            <h3>영상제작</h3> <!-- 제목 -->
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://itforone.com:443/~broadcast/bbs/portfolio_view.php">
                                                        <div class="area_img">
                                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                                        </div>
                                                        <div class="area_txt">
                                                            <span></span><!-- 업체명 -->
                                                            <h3>영상제작</h3> <!-- 제목 -->
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://itforone.com:443/~broadcast/bbs/portfolio_view.php">
                                                        <div class="area_img">
                                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                                        </div>
                                                        <div class="area_txt">
                                                            <span></span><!-- 업체명 -->
                                                            <h3>영상제작</h3> <!-- 제목 -->
                                                        </div>
                                                    </a>
                                                </li>
                                        </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">불러오기</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--basic_modal-->
                        <!-- 취소 및 환불규정 모달팝업 -->
                    </div>
                    <!--포트폴리오에서 가져오기-->
                    <br>
                    <div class="box_write">
                        <h4>제목</h4>
                        <div class="cont">
                            <input name="i_title" id="i_title" value="<?=$view['i_title']?>" type="text" placeholder="제목을 입력해 주세요.">
                        </div>
                    </div>
                    <div class="box_write">
                        <h4>1차 카테고리</h4>
                        <div class="cont">
                            <!--<select id="category_select" onchange="area_filter(this.value);">
                                <option value=""><?/*= ( $c_name != '') ? $c_name : "카테고리를 선택해주세요." */?></option>
                                <?php /*for ($i = 0; $i < count($main_ctg); $i++){ */?>
                                    <option value="<?php /*echo $main_ctg[$i]['c_idx'] */?>"
                                        <?php /*if ($view["c_p_idx"] == $main_ctg[$i]["c_idx"]) echo "selected"; */?>>
                                        <?/*= $main_ctg[$i]['c_name'] */?>
                                    </option>
                                <?php /*} */?>
                            </select>-->
                            <div class="select_box v1">
                                <div class="box">

                                    <div class="select">
                                        <?= ( $c_name != '') ? $c_name : "카테고리를 선택해주세요." ?>
                                    </div>
                                    <ul class="list date" id="ctg_ul" >
                                        <?php for ($i = 0; $i < count($main_ctg); $i++){ ?>
                                            <li class="<? if ($view["c_p_idx"] == $main_ctg[$i]["c_idx"] ) echo "selected"; ?>"
                                                onclick="area_filter('<?php echo $main_ctg[$i]["c_idx"] ?>'); ctg_list2(this.value);"
                                                value="<?php echo $main_ctg[$i]['c_idx'] ?>"><?=$main_ctg[$i]['c_name']?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box_write">
                        <h4>2차 카테고리</h4>
                        <!--
                        <div class="cont" id="ctg_ul2">
                            <div class="select_box v1">
                                <div class="box">
                                    <div class="select">
                                        <?= ($c_name2 != '') ?$c_name2 : "카테고리를 선택해주세요." ?>
                                    </div>
                                    <input type="hidden" id="i_ctg" name="i_ctg">
                                    <ul class="list2 date" id="ctg_ul2">

                                    </ul>
                                </div>
                            </div>
                        </div>
                        -->
                        <div class="cont" id="ctg_ul2">
                        </div>
                    </div>
                    <div class="box_content">
                        <div class="box_write02">
                            <h4>서비스 타입</h4>
                            <div class="cont">
                                <div class="box_write">
                                    <h4>성별</h4>
                                    <div class="cont box">
                                        <input type="radio" name="gender" id="male"><label for="male">남자</label>
                                        <input type="radio" name="gender" id="female"><label for="female">여자</label>
                                        <input type="radio" name="gender" id="not-selected" checked><label for="not-selected">미선택</label>
                                    </div>
                                </div>
                                <div class="box_write">
                                    <h4>연령</h4>
                                    <div class="cont box">
                                        <input type="radio" id="kids" name="age-group"><label for="kids">키즈</label>
                                        <input type="radio" id="teen" name="age-group"><label for="teen">청소년</label>
                                        <input type="radio" id="twenties-thirties" name="age-group"><label for="twenties-thirties">20~30대</label>
                                        <input type="radio" id="middle-aged" name="age-group"><label for="middle-aged">중장년</label>
                                    </div>
                                </div>
                                <div class="box_write">
                                    <h4>지역</h4>
                                    <div class="cont box">
                                        <input type="checkbox" id="domestic" name="location"><label for="domestic">국내</label>
                                        <input type="checkbox" id="overseas" name="location"><label for="overseas">해외</label>
                                        <input type="checkbox" id="negotiable" name="location"><label for="negotiable">협의 또는 선택안함</label>
                                    </div>
                                </div>
                                <div class="box_write">
                                    <h4>주말 작업 가능여부</h4>
                                    <div class="cont box">
                                        <input type="checkbox" id="negotiable" name="availability"><label for="negotiable">협의가능</label>
                                        <input type="checkbox" id="possible" name="availability"><label for="possible">가능</label>
                                        <input type="checkbox" id="not-possible" name="availability"><label for="not-possible">불가능</label>
                                    </div>
                                </div>
                                <div class="box_write">
                                    <h4>작업유형</h4>
                                    <div class="cont box">
                                        <input type="checkbox" id="photo" name="media"><label for="photo">사진</label>
                                        <input type="checkbox" id="video" name="media"><label for="video">영상</label>
                                        <input type="checkbox" id="audio" name="media"><label for="audio">음향</label>
                                        <input type="checkbox" id="none-media" name="media"><label for="none-media">선택안함</label>
                                    </div>
                                </div>
                                <div class="box_write">
                                    <h4>스타일</h4>
                                    <div class="cont box">
                                        <input type="checkbox" id="person" name="category"><label for="person">인물</label>
                                        <input type="checkbox" id="object" name="category"><label for="object">사물</label>
                                        <input type="checkbox" id="product" name="category"><label for="product">제품</label>
                                        <input type="checkbox" id="clothing" name="category"><label for="clothing">의상</label>
                                        <input type="checkbox" id="car" name="category"><label for="car">자동차</label>
                                        <input type="checkbox" id="interior" name="category"><label for="interior">인테리어</label>
                                        <input type="checkbox" id="2d" name="category"><label for="2d">2D</label>
                                        <input type="checkbox" id="3d" name="category"><label for="3d">3D</label>
                                        <input type="checkbox" id="effects" name="category"><label for="effects">이펙트</label>
                                        <input type="checkbox" id="animation" name="category"><label for="animation">애니메이션</label>
                                        <input type="checkbox" id="none-cate" name="category"><label for="none-cate">선택안함</label>
                                    </div>
                                </div>
                            </div>
                        </div>         
                            <div class="box_write02">
                            <h4>검색 키워드</h4>
                            <div class="cont">
                                <div class="box_write">
                                    <div class="keyword">
                                        <div class="keyword_add">
                                            <p>검색 키워드</p>
                                            <input type="text" placeholder="키워드 입력"> <span>5/5</span> <button>추가</button>
                                        </div>
                                        <div class="keyword_list">
                                            <div class="tag">
                                                <span>배우 <a class="del"><i class="fa-light fa-xmark"></i></a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box_write02">
                            <h4>가격정보</h4>
                            <div class="cont">
                                <div class="box_write">
                                    <h4>금액(VAT 포함)</h4>
                                    <div class="cont flex price">
                                        <p class="flex"><input name="i_price" type="tel" id="i_price" value="<?=number_format($view['i_price'])?>" onkeyup = "numberWithCommas(this)" class="text-right" placeholder="금액을 입력해 주세요."><label>원</label></p>
                                        <p class="flex"><input type="checkbox" name="package" id="package"><label for="package">패키지로 가격설정</label></p>
                                    </div>
                                </div>
                                <div class="box_write package">
                                    <div class="table">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <td></td>
                                                    <th>STANDARD</th>
                                                    <th>DELUXE</th>
                                                    <th>PREMIUM</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <!--기본항목-->
                                                <tr>
                                                    <th>제목<span class="required">*</span></th>
                                                    <td><input type="text" placeholder="제목을 입력해주세요" required>0 / 20</td>
                                                    <td><input type="text" placeholder="제목을 입력해주세요" required>0 / 20</td>
                                                    <td><input type="text" placeholder="제목을 입력해주세요" required>0 / 20</td>
                                                </tr>
                                                <tr>
                                                    <th>설명<span class="required">*</span></th>
                                                    <td><textarea type="text" placeholder="상세설명을 입력해주세요" required></textarea>0 / 60</td>
                                                    <td><textarea type="text" placeholder="상세설명을 입력해주세요" required></textarea>0 / 60</td>
                                                    <td><textarea type="text" placeholder="상세설명을 입력해주세요" required></textarea>0 / 60</td>
                                                </tr>
                                                <tr>
                                                    <th>금액(VAT 포함)<span class="required">*</span></th>
                                                    <td><p class="flex"><input type="text" class="text-right" placeholder="0" required><label>원</label></p></td>
                                                    <td><p class="flex"><input type="text" class="text-right" placeholder="0" required><label>원</label></p></td>
                                                    <td><p class="flex"><input type="text" class="text-right" placeholder="0" required><label>원</label></p></td>
                                                </tr>
                                                <tr>
                                                    <th>작업 기간<span class="required">*</span></th>
                                                    <td>
                                                        <select required>
                                                            <option>선택해주세요</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select required>
                                                            <option>선택해주세요</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select required>
                                                            <option>선택해주세요</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>수정 횟수<span class="required">*</span></th>
                                                    <td>
                                                        <select required>
                                                            <option>선택해주세요</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select required>
                                                            <option>선택해주세요</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select required>
                                                            <option>선택해주세요</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            <!--기본항목-->
                                                <!--<tr>
                                                    <th>시안개수</th>
                                                    <td><input type="text" placeholder="예)최대 5개"></td>
                                                    <td><input type="text" placeholder="예)최대 5개"></td>
                                                    <td><input type="text" placeholder="예)최대 5개"></td>
                                                </tr>
                                                <tr>
                                                    <th>원본파일 제공</th>
                                                    <td><input type="checkbox" id="" name=""><label for="">제공</label></td>
                                                    <td><input type="checkbox" id="" name=""><label for="">제공</label></td>
                                                    <td><input type="checkbox" id="" name=""><label for="">제공</label></td>
                                                </tr>
                                                <tr>
                                                    <th>고해상도 파일 제공</th>
                                                    <td><input type="checkbox" id="" name=""><label for="">제공</label></td>
                                                    <td><input type="checkbox" id="" name=""><label for="">제공</label></td>
                                                    <td><input type="checkbox" id="" name=""><label for="">제공</label></td>
                                                </tr>
                                                <tr>
                                                    <th>이미지 장수<span class="required">*</span></th>
                                                    <td><input type="text" placeholder="예) 최대 50장"></td>
                                                    <td><input type="text" placeholder="예) 최대 50장"></td>
                                                    <td><input type="text" placeholder="예) 최대 50장"></td>
                                                </tr>
                                                <tr>
                                                    <th>상업적으로 이용가능</th>
                                                    <td><input type="checkbox" id="" name=""><label for="">가능</label></td>
                                                    <td><input type="checkbox" id="" name=""><label for="">가능</label></td>
                                                    <td><input type="checkbox" id="" name=""><label for="">가능</label></td>
                                                </tr>-->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box_write02">
                            <h4>추가옵션</h4>
                            <div class="cont">
                                <div class="box_ck">
                                    <ul class="area_filter" id="area_filter">
                                        <li>
                                            <div>
                                                <input type="checkbox" id="filter0<?=$i?>" name="option_arr[]" value="<?=$i?>">
                                                <label for="filter0<?=($i)?>">촬영 시간(분) 추가</label>
                                            <div>
                                            <div class="filter_active">
                                                <div class="grid4">
                                                    <input type="text" placeholder="최소 1,000"><span>원 추가시</span>
                                                    <select><option>선택해주세요</option></select><span>분 추가</span>
                                                </div>
                                                <!--패키지 일때-->
                                                <div class="grid5">
                                                    <strong>STANDARD</strong>
                                                    <input type="text" placeholder="최소 1,000"><span>원 추가시</span>
                                                    <select><option>선택해주세요</option></select><span>분 추가</span>
                                                </div>
                                                <div class="grid5">
                                                    <strong>DELUXE</strong>
                                                    <input type="text" placeholder="최소 1,000"><span>원 추가시</span>
                                                    <select><option>선택해주세요</option></select><span>분 추가</span>
                                                </div>
                                                <div class="grid5">
                                                    <strong>PREMIUM</strong>
                                                    <input type="text" placeholder="최소 1,000"><span>원 추가시</span>
                                                    <select><option>선택해주세요</option></select><span>분 추가</span>
                                                </div>
                                                <!--패키지 일때-->
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <input type="checkbox" id="filter0<?=$i?>" name="option_arr[]" value="<?=$i?>">
                                                <label for="filter0<?=($i)?>">상업적 이용 가능</label>
                                            <div>
                                        </li>
                                        <li>
                                            <div>
                                                <input type="checkbox" id="filter0<?=$i?>" name="option_arr[]" value="<?=$i?>">
                                                <label for="filter0<?=($i)?>">원본 파일 제공</label>
                                            <div>
                                        </li>
                                        <li>
                                            <div>
                                                <input type="checkbox" id="filter0<?=$i?>" name="option_arr[]" value="<?=$i?>">
                                                <label for="filter0<?=($i)?>">자막 삽입</label>
                                            <div>
                                        </li>
                                        <li>
                                            <div>
                                                <input type="checkbox" id="filter0<?=$i?>" name="option_arr[]" value="<?=$i?>">
                                                <label for="filter0<?=($i)?>">맞춤 옵션 추가</label>
                                            <div>
                                            <div class="filter_active">
                                                <div>
                                                    <dl class="grid">
                                                        <dt><label>제목</label></dt>
                                                        <dd><input type="text" placeholder="제목을 입력해주세요"></dd>
                                                        <dt><label>설명</label></dt>
                                                        <dd><input type="text" placeholder="설명을 입력해주세요"></dd>
                                                        <dt><label>추가금액</label></dt>
                                                        <dd class="flex"><input type="text" placeholder="최소1,000"><span>원 추가시</span></dd>
                                                        <dt><label>추가작업일</label></dt>
                                                        <dd class="flex"><select><option>선택해주세요</option></select><span>분 추가</span></dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div id="area_btn"><a class="btn_next" href="javascript:tab_click('2')">다음</a></div>
            </div>
        </div>
    </span>
    <span id="tab2" <!--style="display: none"-->>
        <?php include_once('./item_write02.php'); ?>
    </span>
    <span id="tab3" <!--style="display: none;"-->>
    <?php include_once('./item_write03.php');?>
    </span>
</form>
<script>
        //패키지 가격설정
        // Function to handle checkbox toggle
        function togglePackage() {
            var packageCheckbox = document.getElementById('package');
            var packageBox = document.querySelector('.box_write.package');
            var priceInput = document.getElementById('i_price');

            // Check if the package checkbox is checked
            if (packageCheckbox.checked) {
                // If checked, show the package box and disable price input
                packageBox.style.display = 'block';
                priceInput.disabled = true;
            } else {
                // If unchecked, hide the package box and enable price input
                packageBox.style.display = 'none';
                priceInput.disabled = false;
            }
        }

        // Attach togglePackage function to checkbox change event
        document.getElementById('package').addEventListener('change', togglePackage);

        // Optional: Ensure initial state reflects checkbox state on page load
        togglePackage();
    </script>

<script>
    $(document).ready(function () {
        <?php if ($ctg_key != ""){ ?>
        area_filter('<?=$view['i_ctg']?>');
        <?php } ?>
    });

    //탭 클릭시 저장 후 이동
    function tab_click(click_tab){

        var tab = $('#now_tab').val();
        if (click_tab != "complete") {
            $('#click_tab').val(click_tab);
        }

        if (tab == 1){
            fsave_submit1();
        }else if (tab == 2){
            fsave_submit2();
        }else if (tab == 3 ||click_tab == 'complete'){
            fsave_submit3(click_tab);
        }



    }

    function css_block_none(tab) {
        $("[id^='tab']").css("display","none");
        $("#tab"+tab).css("display","block");
        console.log('css'+tab);
        if (tab !='complete') {
            $('#now_tab').val(tab);
        }

    }

    function fsave_submit1() {
        var ctg_value = "";
        var submit_is = true;

        $.each($('#ctg_ul li'), function(index, item){
            var selected = $(this).attr('class');
            if (selected == "selected"){
                ctg_value = $(this).attr("value");
            }
        });
        if (ctg_value == ""){
            swal("카테고리를 선택해주세요.");
            submit_is = false;
        }

        //i로 시작하는 input value 빈값찾기
        $.each($("#inr [name^='i_']"), function(index, item){
            if ($(this).val() == "" && $(this).attr('name') != 'i_ctg'){
               swal($(this).attr('placeholder'));
               submit_is = false;
            };
        });

        if (submit_is) {
            css_block_none($('#click_tab').val());
        }
    }
    

    //카테고리별 옵션선택
    function area_filter(ctg) {

        //idx 있을 경우 카테고리 변경 시 카테고리 같을 경우에 옵션 선택 값 넣어줌
        var chk_val = "";
        if (ctg == "<?=$view['i_ctg']?>" ){
            chk_val = "<?=$view['i_option_arr']?>";
        }

        $('#i_ctg').val(ctg);

        $.ajax({
            url: g5_bbs_url+"/ajax.controller.php",
            type: "POST",
            data: {
                "ctg": ctg,
                "mode": "area_filter",
                "chk_val": chk_val,
            },
            dataType: "html",
            success: function(data) {



                if (data != "") {
                    $('#area_filter').html(data);
                }
            }
        });
    }

    //2차카테고리
    function ctg_list2(ctg) {

        $.ajax({
            url: g5_bbs_url+"/ajax.controller.php",
            type: "POST",
            data: {
                "c_p_idx": ctg,
                "mode": "ctg_list2",
            },
            dataType: "html",
            success: function(data) {

                if (data != "") {
                    $('#ctg_ul2').html(data);
                }

            }
        });
    }

</script>



<?php include_once('./_tail.php'); ?>