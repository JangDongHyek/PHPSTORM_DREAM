<?
include_once('./_common.php');
$g5['title'] = 'CS Center';
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
	@media screen and (max-width:768px) {
		#container{padding:0 0 60px;}
	}
	@media screen and (max-width:550px) {
		#container{padding:0 0 30px;}
	}
</style>

<div id="area_community" class="faq">

	<?php include_once('./faq_top.php'); ?>


	<div id="area_faq">
		<div class="inr v3">

			<?php if($member['mb_level'] == 10) { ?>
			<div class="btn_box">
				<a class="btn_fwrite" href="<?=G5_BBS_URL?>/faq_write.php">Writer</a>
			</div>
			<?php } ?>

			<ul class="faq_list">
				<!--<li>
					<h3>General member FAQ</h3>
					<a class="btn_more" href="<?/*=G5_BBS_URL*/?>/faq_list.php?g=m">More+</a>
					<ul class="article_list">
                        <?php
/*                        $rlt = sql_query("select * from g5_cs_faq where category like '%General%' {$sql_search} order by notice = 'Y' desc, idx asc limit 8");
                        $cnt = sql_num_rows($rlt);
                        while($row = sql_fetch_array($rlt)) {
                        */?>
                        <li><a href="<?/*=G5_BBS_URL*/?>/faq_view.php?idx=<?/*=$row['idx']*/?>"><?php /*if($row['notice'] == 'Y') { */?><i>NOTICE</i><?php /*} */?><?/*=$row['subject']*/?></a></li>
                        <?php
/*                        }
                        if($cnt == 0) {
                        */?>
                        <li class="nodata">There are no registered questions.</li>
                        <?php
/*                        }
                        */?>
					</ul>
				</li>-->
				<li style="width: 100%">
					<h3>Podosea member FAQ</h3>
					<a class="btn_more" href="<?=G5_BBS_URL?>/faq_list.php?g=c">More+</a>
					<ul class="article_list">
                        <?php
                        $rlt = sql_query("select * from g5_cs_faq where category like '%Podosea%' {$sql_search} order by notice = 'Y' desc, idx asc limit 8");
                        $cnt = sql_num_rows($rlt);
                        while($row = sql_fetch_array($rlt)) {
                        ?>
                        <li><a href="<?=G5_BBS_URL?>/faq_view.php?idx=<?=$row['idx']?>"><?php if($row['notice'] == 'Y') { ?><i>NOTICE</i><?php } ?><?=$row['subject']?></a></li>
                        <?php
                        }
                        if($cnt == 0) {
                        ?>
                        <li class="nodata">There are no registered questions.</li>
                        <?php
                        }
                        ?>
					</ul>
				</li>
				<li class="full">
					<h3>Other FAQ</h3>
					<a class="btn_more" href="<?=G5_BBS_URL?>/faq_list.php">More+</a>
					<ul class="article_list">
                        <?php
                        $rlt = sql_query("select * from g5_cs_faq where category like '%Other%' {$sql_search} order by notice = 'Y' desc, idx asc limit 8");
                        $cnt = sql_num_rows($rlt);
                        while($row = sql_fetch_array($rlt)) {
                        ?>
                        <li><a href="<?=G5_BBS_URL?>/faq_view.php?idx=<?=$row['idx']?>"><?php if($row['notice'] == 'Y') { ?><i>NOTICE</i><?php } ?><?=$row['subject']?></a></li>
                        <?php
                        }
                        if($cnt == 0) {
                        ?>
                        <li class="nodata">There are no registered questions.</li>
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
				<h3>Consultations and Inquiry</h3>
			</div>
			<div id="area_premium">
				<a onclick="chatting('admin');" style="cursor: pointer;">
					<div class="obj"><img src="<?php echo G5_IMG_URL ?>/obj_chat.svg"></div>
					<div class="txt">
						<h2>Inquire through 1:1 chat</h2>
						<em>If you’re still having difficulty with your problem, use the 1:1 chat feature for further consultation!</em>
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
