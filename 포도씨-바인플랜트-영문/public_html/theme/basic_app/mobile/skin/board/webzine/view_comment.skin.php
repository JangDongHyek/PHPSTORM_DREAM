<script>
var $fviewcomment = '';
function view_comment_skin(form){
	<?php if($is_guest) echo chk_captcha_js(); ?>
	set_comment_token(form);
}
</script>

<section id="view-comment-skin">

	<h1>코멘트 <?php echo number_format($view['wr_comment']); ?>건</h1>

	<?php if($is_comment_write){ ?>
	<div id="fviewcomment" class="fviewcomment">
		<form name="fviewcomment" method="post" action="<?php echo $comment_action_url; ?>" onsubmit="return view_comment_skin(this);">
			<p>
				<textarea id="wr_content" name="wr_content" required></textarea>
			</p>
			<p>
				<label>
					<input type="checkbox" id="wr_secret" name="wr_secret" value="secret" />
					비밀글
				</label>
				<button type="submit">저장</button>
				<input type="hidden" id="w" name="w" value="c" />
				<input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>" />
				<input type="hidden" name="wr_id" value="<?php echo $wr_id; ?>" />
				<input type="hidden" id="comment_id" name="comment_id" value="" />
				<input type="hidden" name="sca" value="<?php echo $sca; ?>" />
				<input type="hidden" name="sfl" value="<?php echo $sfl; ?>" />
				<input type="hidden" name="stx" value="<?php echo $stx; ?>" />
				<input type="hidden" name="spt" value="<?php echo $spt; ?>" />
				<input type="hidden" name="sst" value="<?php echo $sst; ?>" />
				<input type="hidden" name="sod" value="<?php echo $sod; ?>" />
				<input type="hidden" name="page" value="<?php echo $page; ?>" />
			</p>
			<?php if($is_guest){ ?>
			<div>
				<input type="text" name="wr_name" placeholder="이름" required />
				<input type="password" name="wr_password" placeholder="비밀번호" required />
				<?php echo $captcha_html; ?>
			</div>
			<?php } ?>
		</form>
	</div>
	<?php } ?>

	<ul>
		<?php foreach($list as $rows){ ?>
		<li id="c_<?php echo $rows['wr_id']; ?>" style="padding-left: <?php echo strlen($rows['wr_comment_reply']) * 20; ?>px;">
			<h1>
				<i class="fa fa-user"></i>
				<?php echo $rows['name']; ?>
				<?php if($is_ip_view) echo "({$rows['ip']})"; ?>
				<i class="fa fa-clock-o"></i>
				<?php echo $rows['wr_datetime']; ?>
			</h1>
			<h2>
				<?php
				if(strstr($rows['wr_option'], 'secret')){
					echo '비밀글';
				}
				echo $rows['content'];
				?>
			</h2>
			<?php if($rows['is_del'] || $rows['is_edit'] || $rows['is_reply']){ ?>
			<p>
				<?php if($rows['is_del']){ ?>
				<a href="<?php echo $rows['del_link']; ?>" class="delete">
					<i class="fa fa-trash-o fa-lg"></i>
				</a>
				<?php } ?>
				<?php if($rows['is_edit']){ ?>
				<span class="update" data-wr-id="<?php echo $rows['wr_id'] ?>">
					<i class="fa fa-pencil-square-o fa-lg"></i>
				</span>
				<?php } ?>
				<?php if($rows['is_reply']){ ?>
				<span class="reply" data-wr-id="<?php echo $rows['wr_id'] ?>">
					<i class="fa fa-reply fa-lg"></i>
				</span>
				<?php } ?>
			</p>
			<?php } ?>
			<div id="fviewcomment<?php echo $rows['wr_id']; ?>" class="fviewcomment">
			</div>
			<input type="hidden" id="wr_secret<?php echo $rows['wr_id']; ?>" value="<?php echo strstr($rows['wr_option'], 'secret'); ?>" />
			<textarea id="wr_content<?php echo $rows['wr_id']; ?>" style="display: none;"><?php echo get_text($rows['content1'], 0); ?></textarea>
		</li>
		<?php } ?>
	</ul>

</section>