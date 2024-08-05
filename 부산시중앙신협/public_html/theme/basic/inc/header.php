
			<h1><a href="<?php echo G5_URL ?>"><span class="blind">JNGK에 오신것을 환영합니다.</span></a></h1>
			<div class="allBoxWrap">
				<a href="#" class="menu-trigger">
					<span></span>
					<span></span>
					<span></span>
				</a>
				<div class="allBox">
					<ul id="all_ul">
						<?php
						$sql = " select *
									from {$g5['menu_table']}
									where me_use = '1'
									  and length(me_code) = '2'
									order by me_order, me_id ";
						$result = sql_query($sql, false);
						$gnb_zindex = 999; // gnb_1dli z-index 값 설정용

						for ($i=0; $row=sql_fetch_array($result); $i++) {
						?>
						<li class="all_li" style="z-index:<?php echo $gnb_zindex--; ?>">
						<span><?php echo $row['me_name'] ?></span>
							<?php
							$sql2 = " select *
										from {$g5['menu_table']}
										where me_use = '1'
										  and length(me_code) = '4'
										  and substring(me_code, 1, 2) = '{$row['me_code']}'
										order by me_order, me_id ";
							$result2 = sql_query($sql2);

							for ($k=0; $row2=sql_fetch_array($result2); $k++) {
								if($k == 0)
									echo '<ul>'.PHP_EOL;
							?>
								<li><a href="<?php echo G5_URL.$row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" ><?php echo $row2['me_name'] ?></a></li>
							<?php
							}

							if($k > 0)
								echo '</ul>'.PHP_EOL;
							?>
						</li>
						<?php
						}

						if ($i == 0) {  ?>
							<li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
						<?php } ?>
					</ul>
				</div>
			</div>

			<nav id="gnb">
				<h2>메인메뉴</h2>
				<ul id="gnb_1dul">
					<?php
					$sql = " select *
								from {$g5['menu_table']}
								where me_use = '1'
								  and length(me_code) = '2'
								order by me_order, me_id ";
					$result = sql_query($sql, false);
					$gnb_zindex = 999; // gnb_1dli z-index 값 설정용

					for ($i=0; $row=sql_fetch_array($result); $i++) {
					?>
					<li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>">
						<a href="<?php echo G5_URL.$row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?><span></span></a>
						<?php
						$sql2 = " select *
									from {$g5['menu_table']}
									where me_use = '1'
									  and length(me_code) = '4'
									  and substring(me_code, 1, 2) = '{$row['me_code']}'
									order by me_order, me_id ";
						$result2 = sql_query($sql2);

						for ($k=0; $row2=sql_fetch_array($result2); $k++) {
							if($k == 0)
								echo '<ul class="gnb_2dul">'.PHP_EOL;
						?>
							<li class="gnb_2dli"><a href="<?php echo G5_URL.$row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
						<?php
						}

						if($k > 0)
							echo '</ul>'.PHP_EOL;
						?>
					</li>

					<?php
					}

					if ($i == 0) {  ?>
						<li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
					<?php } ?>


						<!-- /요기 걍 추가 -->
						<li class="gnb_1dli" style="z-index:992">
						<a href="#" class="gnb_1da">커뮤니티<span></span></a>
						<ul class="gnb_2dul" >
							<li class="gnb_2dli"><a href="https://blog.naver.com/jngolf" target="_blank" class="gnb_2da">블로그</a></li>
							<li class="gnb_2dli"><a href="https://www.youtube.com/channel/UCDODvfS_TBTXvGhjQ-yyh0A" target="_blank" class="gnb_2da">유튜브</a></li>
						</ul>
					</li>
				</ul>
			</nav>
    			

			
