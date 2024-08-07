<?php
include_once('./_common.php');

$sql = " select *
           from {$g5['g5_shop_category_table']}
          where ca_id = '$ca_id'
            and ca_use = '1'  ";
$ca = sql_fetch($sql);
if (!$ca['ca_id'])
    alert('등록된 분류가 없습니다.', G5_SHOP_URL);

// 테마미리보기 스킨 등의 변수 재설정
if(defined('_THEME_PREVIEW_') && _THEME_PREVIEW_ === true) {
    $ca['ca_mobile_skin']       = (isset($tconfig['ca_mobile_skin']) && $tconfig['ca_mobile_skin']) ? $tconfig['ca_mobile_skin'] : $ca['ca_mobile_skin'];
    $ca['ca_mobile_img_width']  = (isset($tconfig['ca_mobile_img_width']) && $tconfig['ca_mobile_img_width']) ? $tconfig['ca_mobile_img_width'] : $ca['ca_mobile_img_width'];
    $ca['ca_mobile_img_height'] = (isset($tconfig['ca_mobile_img_height']) && $tconfig['ca_mobile_img_height']) ? $tconfig['ca_mobile_img_height'] : $ca['ca_mobile_img_height'];
    $ca['ca_mobile_list_mod']   = (isset($tconfig['ca_mobile_list_mod']) && $tconfig['ca_mobile_list_mod']) ? $tconfig['ca_mobile_list_mod'] : $ca['ca_mobile_list_mod'];
    $ca['ca_mobile_list_row']   = (isset($tconfig['ca_mobile_list_row']) && $tconfig['ca_mobile_list_row']) ? $tconfig['ca_mobile_list_row'] : $ca['ca_mobile_list_row'];
}

// 본인인증, 성인인증체크
if(!$is_admin) {
    $msg = shop_member_cert_check($ca_id, 'list');
    if($msg)
        alert($msg, G5_SHOP_URL);
}

$g5['title'] = $ca['ca_name'];

include_once(G5_MSHOP_PATH.'/_head.php');

// 스킨경로
$skin_dir = G5_MSHOP_SKIN_PATH;

if($ca['ca_mobile_skin_dir']) {
    if(preg_match('#^theme/(.+)$#', $ca['ca_mobile_skin_dir'], $match))
        $skin_dir = G5_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR.'/shop/'.$match[1];
    else
        $skin_dir = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/shop/'.$ca['ca_mobile_skin_dir'];

    if(is_dir($skin_dir)) {
        $skin_file = $skin_dir.'/'.$ca['ca_mobile_skin'];

        if(!is_file($skin_file))
            $skin_dir = G5_MSHOP_SKIN_PATH;
    } else {
        $skin_dir = G5_MSHOP_SKIN_PATH;
    }
}

define('G5_SHOP_CSS_URL', str_replace(G5_PATH, G5_URL, $skin_dir));
?>
<style>
	.list_Btn { margin:0 0 10px;
		display: flex;
		align-items: center;
		justify-content: center;
		}
	.list_Btn span{ font-size:1.12em; font-weight:500; margin:0 10px 0 0; word-break:keep-all; letter-spacing:-.050em}
	.list_Btn a{
		display: inline-block;
		/*background: url(../img/main_top_bnr01.jpg) no-repeat center center;*/
        background-color: #8F278A;
		background-size: cover;
		color: #FFF;
		position: relative;
		/*box-shadow: 0 -5px 5px #4c7a17 inset;*/
		font-size: 12px;
		/*border: 1px solid #3c8a00;*/
        border: 1px solid #542478;
		border-radius: 20px;
		padding:7px 12px;
		word-break: keep-all;
		}
	.list_Btn02 a{
		display: inline-block;
		background: url(../img/main_top_bnr02.jpg) no-repeat center center;
		background-size: cover;
		color: #FFF;
		position: relative;
		box-shadow: 0 -5px 5px #39785b inset;
		font-size: 15px;
		border-radius: 20px;
		padding:7px 25px;
		word-break: keep-all;
		}
	.list_Btn03 { margin:0 0 10px;
		display: flex;
		align-items: center;
		justify-content: center;
		}
	.list_Btn03 a{
		display: inline-block;
		/*background: url(../img/main_top_bnr01.jpg) no-repeat center center;*/
        background-color: #8F278A;
		background-size: cover;
		color: #FFF;
		position: relative;
		/*box-shadow: 0 -5px 5px #4c7a17 inset;*/
		font-size: 15px;
		/*border: 1px solid #3c8a00;*/
        border: 1px solid #542478;
		border-radius: 20px;
		padding:7px 27px;
		word-break: keep-all;
		}
	.event_smenu ul{ margin:0 0 10px}	
	.event_smenu ul:after{ display:block; clear:both; content:''}
	.event_smenu li{ display:inline-block; width:24%; margin:0 .5%; float:left}	
    .event_smenu li a:before {
		display: inline-block;
		color: #116f14;
		content: "▶";
		transform: translateY(-50%);
		font-size: .50em;
		font-weight: 300;
		margin: 0 5px 0 0;
		position: relative;
		top: 16px;}
	.event_smenu li a{    
		text-decoration: none;
		color: #fff !important;
		display: block;
		text-align: center;
		font-size: 1.18em;
		line-height: 35px;
		border-radius: 4px;
		background:linear-gradient(180deg, rgba(255,255,255,1) 0%, rgba(186,220,152,1) 23%, rgba(186,220,152,1) 85%, rgba(216,239,204,1) 96%, rgba(255,255,255,1) 100%);
		/*background-size: cover;
		box-shadow: 0 -5px 5px #39785b inset;*/
		border:1px solid #3b8400;
		font-weight:bold;
		color: #000 !important;
		transition:all .2s;}
	.event_smenu li a:hover{
		border:1px solid #116f14;
		background:linear-gradient(180deg, rgba(255,255,255,1) 0%, rgba(186,220,152,1) 40%, rgba(186,220,152,1) 75%, rgba(216,239,204,1) 86%, rgba(255,255,255,1) 100%);
		color: #116f14 !important;
		transition:all .2s;}
	/*.event_smenu li a{    
		text-decoration: none;
		color: #fff !important;
		display: block;
		text-align: center;
		font-size: 13px;
		line-height: 35px;
		border-radius: 20px;
		background: url(../img/main_top_bnr02.jpg) no-repeat center center;
		background-size: cover;
		color: #FFF;
		box-shadow: 0 -5px 5px #39785b inset;}*/
	
	.item-list ul{display: flex;flex-wrap: wrap;
	}
	.flex_box{ color: #7030A0;}
    .flex_box ul{ display:flex; /* display: inline-flex; */width:100%}
    .flex_box li{ display:flex; /* display: inline-flex; */align-items: center; justify-content: center; font-size:1.10em}
	.flex_box li:nth-child(1){ margin:0 5px 0 0}
    .flex_box li:nth-child(2){ margin:0 10px 0 0; word-break:keep-all}
	.flex_box li:nth-child(3){ margin-left:auto}
@media screen and (max-width:1199px) {
	.list_Btn span{margin:0 10px 10px 0}
}
@media screen and (max-width:992px) {
	.list_Btn{
		flex-direction: column;
		position: relative;
	}
	.list_Btn span{
		margin:0 0px 10px 0; 
		width:100%;
	}
	.list_Btn a{
	}
	.flex_box{
        color: #7030A0;
		flex-direction: row;
	}
	.flex_box span{
		word-break: keep-all;
	}
	.flex_box a{
		position: absolute;
		right: 0;
		bottom: 0px;
		padding: 4px 7px;
		font-size: 0.9em;
		text-align: center;
	}
}
@media screen and (max-width:767px) {
	.flex_box li{ font-size:1.0em}
    .flex_box li{ align-items: normal;}
	.flex_box li:nth-child(3){ margin-left:auto; padding:50px 0 0;}
	.event_smenu li{ display:inline-block; width:49%; margin:0 .5% 10px; float:left}
	.event_smenu li a{ font-size: 12px; }	
	}
</style>

<script>
	var g5_shop_url = "<?php echo G5_SHOP_URL; ?>";
</script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.list.js"></script>
	
	
<div id="sct">
    <?php
	$categoryMessages=[
								"10"=>"
									<div class='list_Btn flex_box'> 
									    <ul>
										   <li>■</li>
										   <li>명절 일주일전부터 명절 당일까지는 [명절차례상]세트 상품으로만 주문을 받습니다. [제사음식 주문 불가]</li>
										   <li><a href='./list.php?ca_id=20'>명절차례상 주문 바로가기</a></li>
										</ul>
								    </div>
								",
								"60"=>"
							        <div class='list_Btn flex_box'> 
									    <ul>
										   <li>■</li>
										   <li>명절 일주일전부터 명절 당일까지는 [명절차례상]세트 상품으로만 주문을 받습니다. [제사음식 주문 불가]</li>
										   <li><a href='./list.php?ca_id=20'>명절차례상 주문 바로가기</a></li>
										</ul>
								    </div>
								",
								"70"=>"
							        <div class='list_Btn flex_box'> 
									    <ul>
										   <li>■</li>
										   <li>명절 일주일전부터 명절 당일까지는 [명절차례상]세트 상품으로만 주문을 받습니다. [단품 주문 불가]</li>
										   <li><a href='./list.php?ca_id=20'>명절차례상 주문 바로가기</a></li>
										</ul>
								    </div>	
								",
								"80"=>"
							        <div class='list_Btn03'> 
										<a href='../bbs/board.php?bo_table=gall01'>영남잔치상 기원제 행사실적 보러가기</a>
								    </div>
									<div class='event_smenu'>
									    <ul>
										     <li><a href='./list.php?ca_id=a0'>기공식/준공식</a></li>
											 <li><a href='./list.php?ca_id=80'>안전기원제/개업식/이전식</a></li>
											 <li><a href='./list.php?ca_id=b0'>행사용품/답례품</a></li>
											 <li><a href='./list.php?ca_id=90'>뒷풀이음식</a></li>
										</ul>
									</div>
								",
								"90"=>"
							        <div class='list_Btn03'> 
										<a href='../bbs/board.php?bo_table=gall01'>영남잔치상 기원제 행사실적 보러가기</a>
								    </div>
									<div class='event_smenu'>
									    <ul>
										     <li><a href='./list.php?ca_id=a0'>기공식/준공식</a></li>
											 <li><a href='./list.php?ca_id=80'>안전기원제/개업식/이전식</a></li>
											 <li><a href='./list.php?ca_id=b0'>행사용품/답례품</a></li>
											 <li><a href='./list.php?ca_id=90'>뒷풀이음식</a></li>
										</ul>
									</div>
								",
								"a0"=>"
							        <div class='list_Btn03'> 
										<a href='../bbs/board.php?bo_table=gall01'>영남잔치상 기원제 행사실적 보러가기</a>
								    </div>
									<div class='event_smenu'>
									    <ul>
										     <li><a href='./list.php?ca_id=a0'>기공식/준공식</a></li>
											 <li><a href='./list.php?ca_id=80'>안전기원제/개업식/이전식</a></li>
											 <li><a href='./list.php?ca_id=b0'>행사용품/답례품</a></li>
											 <li><a href='./list.php?ca_id=90'>뒷풀이음식</a></li>
										</ul>
									</div>
								",
								"b0"=>"
							        <div class='list_Btn03'> 
										<a href='../bbs/board.php?bo_table=gall01'>영남잔치상 기원제 행사실적 보러가기</a>
								    </div>
									<div class='event_smenu'>
									    <ul>
										     <li><a href='./list.php?ca_id=a0'>기공식/준공식</a></li>
											 <li><a href='./list.php?ca_id=80'>안전기원제/개업식/이전식</a></li>
											 <li><a href='./list.php?ca_id=b0'>행사용품/답례품</a></li>
											 <li><a href='./list.php?ca_id=90'>뒷풀이음식</a></li>
										</ul>
									</div>
								",
								"40"=>"
							        <div class='list_Btn03'> 
										<a href='../bbs/board.php?bo_table=gall02'>영남잔치상 잔치음식 실물사진 보러가기</a>
								    </div>
								",
								"50"=>"
							        <div class='list_Btn02 text-center'> 
										<a>♣ 조리, 배송시간 계산! 항상 따뜻한 도시락! 천연재료로 만든 담백하고 깔끔한 맛! ♣</a>
								    </div>
								",
								"c0"=>"",
								"d0"=>"",
							];
	
	

    // 상단 HTML
    echo '<div id="sct_hhtml">'.conv_content($ca['ca_mobile_head_html'], 1).'</div>';
	$ca_id_first = substr($ca_id,0,2);
?>
<div><?php echo $categoryMessages[$ca_id_first]?></div>
<?
    $cate_skin = $skin_dir.'/listcategory.skin.php';
    if(!is_file($cate_skin))
        $cate_skin = G5_MSHOP_SKIN_PATH.'/listcategory.skin.php';

    include $cate_skin;

    // 테마미리보기 베스트상품 재설정
    if(defined('_THEME_PREVIEW_') && _THEME_PREVIEW_ === true) {
        if(isset($theme_config['ca_mobile_list_best_mod']))
            $theme_config['ca_mobile_list_best_mod'] = (isset($tconfig['ca_mobile_list_best_mod']) && $tconfig['ca_mobile_list_best_mod']) ? $tconfig['ca_mobile_list_best_mod'] : 0;
        if(isset($theme_config['ca_mobile_list_best_row']))
            $theme_config['ca_mobile_list_best_row'] = (isset($tconfig['ca_mobile_list_best_row']) && $tconfig['ca_mobile_list_best_row']) ? $tconfig['ca_mobile_list_best_row'] : 0;
    }

    // 분류 Best Item
    $list_mod = (isset($theme_config['ca_mobile_list_best_mod']) && $theme_config['ca_mobile_list_best_mod']) ? (int)$theme_config['ca_mobile_list_best_mod'] : $ca['ca_mobile_list_mod'];
    $list_row = (isset($theme_config['ca_mobile_list_best_row']) && $theme_config['ca_mobile_list_best_row']) ? (int)$theme_config['ca_mobile_list_best_row'] : $ca['ca_mobile_list_row'];
    $limit = $list_mod * $list_row;
    $best_skin = G5_MSHOP_SKIN_PATH.'/list.best.10.skin.php';

    $sql = " select *
                from {$g5['g5_shop_item_table']}
                where ( ca_id like '$ca_id%' or ca_id2 like '$ca_id%' or ca_id3 like '$ca_id%' )
                  and it_use = '1'
                  and it_type4 = '1'
                order by it_price asc
                limit 0, $limit ";
    $list = new item_list($best_skin, $list_mod, $list_row, $ca['ca_mobile_img_width'], $ca['ca_mobile_img_height']);
    $list->set_query($sql);
    $list->set_mobile(true);
    $list->set_view('it_img', true);
    $list->set_view('it_id', false);
    $list->set_view('it_name', true);
    $list->set_view('it_price', true);
    echo $list->run();

    // 상품 출력순서가 있다면
    if ($sort != "")
        $order_by = $sort.' '.$sortodr.' , it_order, it_id desc';
    else
        $order_by = 'it_order, it_id desc';


    $error = '<p class="sct_noitem">등록된 상품이 없습니다.</p>';
    // 리스트 스킨
    $skin_file = is_include_path_check($skin_dir.'/'.$ca['ca_mobile_skin']) ? $skin_dir.'/'.$ca['ca_mobile_skin'] : $skin_dir.'/list.10.skin.php';
	


    if (file_exists($skin_file)) {
?>
	
<?
        echo '<div id="sct_sortlst">';

        $sort_skin = $skin_dir.'/list.sort.skin.php';
        if(!is_file($sort_skin))
            $sort_skin = G5_MSHOP_SKIN_PATH.'/list.sort.skin.php';
        //include $sort_skin;
    
            // 상품 보기 타입 변경 버튼
        $sub_skin = $skin_dir.'/list.sub.skin.php';
        if(!is_file($sub_skin))
            $sub_skin = G5_MSHOP_SKIN_PATH.'/list.sub.skin.php';

        if(is_file($sub_skin)){
            include $sub_skin;
        }

        echo '</div>';

        // 총몇개
        $items = $ca['ca_mobile_list_mod'] * $ca['ca_mobile_list_row'];
        // 페이지가 없으면 첫 페이지 (1 페이지)
        if ($page < 1) $page = 1;
        // 시작 레코드 구함
        $from_record = ($page - 1) * $items;
        $list = new item_list($skin_file, $ca['ca_mobile_list_mod'], $ca['ca_mobile_list_row'], $ca['ca_mobile_img_width'], $ca['ca_mobile_img_height']);
        $list->set_category($ca['ca_id'], 1);
        $list->set_category($ca['ca_id'], 2);
        $list->set_category($ca['ca_id'], 3);
        $list->set_is_page(true);
        $list->set_mobile(true);
        $list->set_order_by($order_by);
        $list->set_from_record($from_record);
        $list->set_view('it_img', true);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_price', true);
        $list->set_view('sns', true);
        echo $list->run();

        // where 된 전체 상품수
        $total_count = $list->total_count;
		$total_page  = ceil($total_count / $items);
    }
    else
    {
        echo '<div class="sct_nofile">'.str_replace(G5_PATH.'/', '', $skin_file).' 파일을 찾을 수 없습니다.<br>관리자에게 알려주시면 감사하겠습니다.</div>';
    }
    ?>
	<?php
    $qstr1 .= 'ca_id='.$ca_id;
    $qstr1 .='&amp;sort='.$sort.'&amp;sortodr='.$sortodr;
    echo get_paging($config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr1.'&amp;page=');
    ?>
    <!-- <?php
    if($i > 0 && $total_count > $items) {
        $qstr1 .= 'ca_id='.$ca_id;
        $qstr1 .='&sort='.$sort.'&sortodr='.$sortodr;
        $ajax_url = G5_SHOP_URL.'/ajax.list.php?'.$qstr1.'&use_sns=1';
    ?>
    <div class="li_more">
        <p id="item_load_msg"><img src="<?php echo G5_SHOP_CSS_URL; ?>/img/loading.gif" alt="로딩이미지" ><br>잠시만 기다려주세요.</p>
        <div class="li_more_btn">
            <button type="button" id="btn_more_item" data-url="<?php echo $ajax_url; ?>" data-page="<?php echo $page; ?>">더보기 +</button>
        </div>
    </div>
    <?php } ?> -->

    <?php
    // 하단 HTML
    echo '<div id="sct_thtml">'.conv_content($ca['ca_mobile_tail_html'], 1).'</div>';
    ?>
</div>

<?php
include_once(G5_MSHOP_PATH.'/_tail.php');

echo "\n<!-- {$ca['ca_mobile_skin']} -->\n";
?>
