<?
include_once('./_common.php');
$g5['title'] = '고객센터';
include_once('./_head.php');

// 고객센터

// 검색
if(!empty($search)) {
    $sql_search = " and (subject like '%{$search}%' or strip_tags(contents) like '%{$search}%') ";
}
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#container{padding:0 0 140px;}
    .highlight {color:#275dd7;}
</style>

<div id="area_community" class="faq">
	
	<?php include_once('./faq_top.php'); ?> 

	
	<div id="area_faq">
		<div class="inr v3">
			
			<?php if($member['mb_level'] == 10) { ?>
			<div class="btn_box">
				<a class="btn_fwrite" href="<?=G5_BBS_URL?>/faq_write.php">글쓰기</a>
			</div>
			<?php } ?>

			<ul class="faq_list">
				<li>
					<h3>일반회원 자주묻는 질문</h3>
					<a class="btn_more" href="<?=G5_BBS_URL?>/faq_list.php?g=m">더보기+</a>
					<ul class="article_list">
                        <?php
                        $rlt = sql_query("select * from g5_cs_faq where category like '%일반회원%' {$sql_search} order by notice = 'Y' desc, idx desc limit 8");
                        $cnt = sql_num_rows($rlt);
                        while($row = sql_fetch_array($rlt)) {
                        ?>
                        <li><a href="<?=G5_BBS_URL?>/faq_view.php?idx=<?=$row['idx']?>"><?php if($row['notice'] == 'Y') { ?><i>공지</i><?php } ?><?=$row['subject']?></a></li>
                        <?php
                        }
                        if($cnt == 0) {
                        ?>
                        <li class="nodata">등록된 질문이 없습니다.</li>
                        <?php
                        }
                        ?>
					</ul>
				</li>
				<li>
					<h3>기업회원 자주묻는 질문</h3>
					<a class="btn_more" href="<?=G5_BBS_URL?>/faq_list.php?g=c">더보기+</a>
					<ul class="article_list">
                        <?php
                        $rlt = sql_query("select * from g5_cs_faq where category like '%기업회원%' {$sql_search} order by notice = 'Y' desc, idx desc limit 8");
                        $cnt = sql_num_rows($rlt);
                        while($row = sql_fetch_array($rlt)) {
                        ?>
                        <li><a href="<?=G5_BBS_URL?>/faq_view.php?idx=<?=$row['idx']?>"><?php if($row['notice'] == 'Y') { ?><i>공지</i><?php } ?><?=$row['subject']?></a></li>
                        <?php
                        }
                        if($cnt == 0) {
                        ?>
                        <li class="nodata">등록된 질문이 없습니다.</li>
                        <?php
                        }
                        ?>
					</ul>
				</li>
				<li class="full">
					<h3>기타 자주 묻는 질문</h3>
					<a class="btn_more" href="<?=G5_BBS_URL?>/faq_list.php">더보기+</a>
					<ul class="article_list">
                        <?php
                        $rlt = sql_query("select * from g5_cs_faq where category like '%기타회원%' {$sql_search} order by notice = 'Y' desc, idx desc limit 8");
                        $cnt = sql_num_rows($rlt);
                        while($row = sql_fetch_array($rlt)) {
                        ?>
                        <li><a href="<?=G5_BBS_URL?>/faq_view.php?idx=<?=$row['idx']?>"><?php if($row['notice'] == 'Y') { ?><i>공지</i><?php } ?><?=$row['subject']?></a></li>
                        <?php
                        }
                        if($cnt == 0) {
                        ?>
                        <li class="nodata">등록된 질문이 없습니다.</li>
                        <?php
                        }
                        ?>
					</ul>
				</li>
			</ul>	
		</div>
	</div>
	<div id="arae_chat">
		<div class="inr v3">
			<div class="area_title">
				<h3>상담 및 문의</h3>
			</div>
			<div id="area_premium">
				<a onclick="chatting('admin');" style="cursor: pointer;">
					<div class="obj"><img src="<?php echo G5_IMG_URL ?>/obj_chat.svg"></div>
					<div class="txt">
						<h2>1:1 채팅 문의</h2>
						<em>문제가 해결되지 않았다면 1:1채팅을 통해 정확하게 상담받으세요!</em>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>

<?
include_once('./fchatting.php');
include_once('./_tail.php');
?>