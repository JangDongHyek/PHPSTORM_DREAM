<? /*?>			<div id="slideEnd"></div>
		</div>
	</div>
</div><!-- 페이징 및 검색 기능 -->

<? */?>
</div>
            </div>
          </div>
          <div id="si">
            <div id="bleft"><a class="prev browse left" ><img src="<?=$skin_board_url?>images/arrow_left.gif" /></a></div>
            <div id="thumb">
              <div class=scrollable id=browsable >
                <div class=items>
					<?
						$dbqry="
		SELECT `$bbs_table`.*,
						mb_icon,mb_id,mb_name,mb_nick,mb_level,mb_open_info
		FROM `$bbs_table` LEFT JOIN `$db_table_member`
			ON rg_mb_num = mb_num
		WHERE (1=1) $where_str
		$order_str
		LIMIT  $page_info[offset],$page_info[rows] ";
		$rs=query($dbqry,$dbcon);
		$im=0;
		while ($data=mysql_fetch_array($rs)) {
			extract($data);
			if($rg_file1_name && eregi('(\.gif|\.jpg|\.png|\.bmp)$',$rg_file1_name)) {
				$rg_file1_info = @getimagesize("{$bbs_data_url}{$rg_doc_num}\$1\$$rg_file1_name");
				//$rg_file1_url = "{$bbs_data_url}{$rg_doc_num}\$1\$$rg_file1_name";
				if(!file_exists( "{$bbs_data_url}"."{$rg_doc_num}\$1\$$rg_file1_name")) {
					$rg_file1_url = "{$bbs_data_url}".urlencode("{$rg_doc_num}\$1\$th2\$$rg_file1_name");
				}
				if(file_exists( "{$bbs_data_url}"."{$rg_doc_num}\$1\$$rg_file1_name")) {
					$rg_file1_url = "{$bbs_data_url}".urlencode("{$rg_doc_num}\$1\$$rg_file1_name");
				}
				$rg_file1_view = rg_img_view_tag($rg_file1_url);
				$show_file1_view_begin = '';
				$show_file1_view_end = '';
			}else
			{
				
				$rg_file1_info = NULL;
				$rg_file1_url = NULL;
				$rg_file1_view = NULL;
				$show_file1_view_begin = '<!--';
				$show_file1_view_end = '-->';
			}
			
			if($im==0){
				$rg_file_urls=$rg_file1_url;
				$rg_titles=$rg_title;
				$doc_num=$rg_doc_num;
			}
?>
                 <img src="<?=$rg_file1_url?>" width="68px" height="50px" alt="썸네일1" id=0 onclick="showImg('<?=$rg_file1_url?>','<?=$rg_title?>','<?=$rg_doc_num?>','<?=$bbs_id?>')">
		<? $im++;}?>
                 
                </div>
				<Script language="javascript">
					showImg('<?=$rg_file_urls?>','<?=$rg_titles?>','<?=$doc_num?>','<?=$bbs_id?>');
				</script>
              </div>
            </div>
            <div id="bright"><a class="next browse right"><img src="<?=$skin_board_url?>images/arrow_right.gif" /></a></div>
          </div>
        </div>  
  </div>
</div>
<div class="bbs_page">
	<span style="width:48%;text-align:right"><?=$print_page?></span>
	<span style="width:48%;text-align:right">
	<?
	if($auth[bbs_write] || $bbs_id=="noticee") {
	?>
	  <a href="javascript:img_modify()">[수정]</a>
	  <a href="javascript:img_delete()">[삭제]</a>
      <?=$a_write?><img src="<?=$skin_board_url?>images/write.gif" border=0 align="absmiddle"></a>
	<?
	}else{
		if($auth[bbs_write]){
	?>

		<a href="../bbs/mobile_mb_login.php?url=../bbs/list.php?bbs_id=<?=$bbs_id?>"><img src="<?=$skin_board_url?>images/write.gif" border=0></a>
	<?
		}
	}
	?>
	</span>
</div>