<link rel="stylesheet" type="text/css" href="../css/board.css"/>
 <style>
	.yoxview ul{
		padding-left:10px;
		padding-top:10px;
		/*margin:10 10 0 0;*/
	}
	.yoxview ul li{
		float:left;
		display:inline;
		border:1px solid #000000;
		list-style:none;
		
		
		text-align:center;
	}
  </style>
<script>
	function goView(doc_num){
		location.href="../mobile/beau2.htm?bbs_id=<?=$bbs_id?>&doc_num="+doc_num;
	}
	function img_view(url){
		document.getElementById("img_file1").src=url;
		var fr=parent.document.getElementById("ifr");
		var frbody=fr.contentWindow.document.body;
		fr.style.height=frbody.scrollHeight+(frbody.offsetHeight-frbody.clientHeight);
	}
</script>

<div id="hair_title" style="padding-left:10px">
	<ul>
		<li>
		<select name="doc_num" onchange="goView(this.value)">
		<?
		$col=0;
		$SQL="select * from $bbs_table order by rg_doc_num desc";
		$result=mysql_query($SQL);
		while($rs=mysql_fetch_array($result)){?>
		<option value="<?=$rs[rg_doc_num]?>" <? if($rs[rg_doc_num]==$doc_num){echo "selected";}?>><?=$rs[rg_title]?></option>
		<? }?>
		</select>
		</li>
	</ul>
</div><br>
<div>
<img src="<?=$rg_file1_url?>" border="0" onerror="this.src='<?=$skin_board_url?>blank_.gif'" id=img_file1 width=250>
</div>
 <div id="container">
  <div class="yoxview">
	<ul>
		<?
								
								$j=0;
								for($i=1;$i<=20;$i++){
									//${rg_file.$i._url};
									
									if(${rg_file.$i._url}){
										
							?>
		<li><img src="<?=${rg_file.$i._url}?>" border="0" width="80" onclick="img_view('<?=${rg_file.$i._url}?>')"></li>
		<? }}?>
	</ul>
  </div>
 </div>
