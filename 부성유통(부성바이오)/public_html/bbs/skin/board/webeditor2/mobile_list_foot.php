<?
/******************************************************************
 ★ 파일설명 ★ 
목록하단

 ★ 스킨 제작을 위한 변수 설명 ★ 

<?=$width?> 테이블의 넓이 
<?=$skin_board_url?>
스킨 URL 
<?=$site_url?>
사이트 URL 
<?=$bbs_id?>
게시판 아이디 
<?=$print_page?>
네비게이션(페이지 이동) navigation.php 참고 
<?=$show_write_begin?>
글쓰기 
<?=$show_write_end?>
<?=$a_write?>
글쓰기 링크 
<?=$show_chk_begin?>
카트사용 
<?=$show_chk_end?>
<?=$show_admin_begin?>
글관리 
<?=$show_admin_end?>
<?=$u_board_manager?>
글관리주소 
<?=$u_search?>
검색폼 URL 
<?=$checked_sn?>
이름체크 
<?=$checked_st?>
제목체크 
<?=$checked_sc?>
내용체크 
<?=$ss[kw]?>
검색어 
<?=$u_all_list?>
전체목록보기(검색취소) ******************************************************************/ 
?> <? /*?></form> </TABLE> </TD> </TR></TABLE> <? */?>
<!-- 페이징 및 검색 기능 -->
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td align="center"><?=$print_page?></td>
	<td><? if($auth[bbs_write] || $bbs_id=="noticee") {
		if($a_write=="<RG--"){
			$a_write="<a>";
		}
	?>
	  <? if($bbs_id=="noticee"&&$_SESSION[ss_mb_level]!=10){?>
	  <? }else{?>
      <span onclick="javascript:prepareForPicker();" class="button large"><?=$a_write?>글쓰기</a></span>
	  <? }?>
	<?
	}else{
		if($auth[bbs_write]){
	?>
		<span onclick="javascript:prepareForPicker();" class="button large"><a href="../bbs/mobile_mb_login.php?url=../bbs/mobile_list.php?bbs_id=<?=$bbs_id?>">글쓰기</a></span>
	<?
		}
	}
	?></td>
</tr>
</table>

<script type="text/javascript">
var a = "<?echo($mb[mb_num]);?>";
var b = "<?echo ($bbs_id);?>";
function getAndroidVersion() {
    var ua = navigator.userAgent; 
    var match = ua.match(/Android\s([0-9\.]*)/);
    return match ? match[1] : false;
};
function prepareForPicker(){
    if(getAndroidVersion().indexOf("4.4.2") != -1 && b == "pro_sell1"){
        window.jsi.register(a, "");
        return false;
    }
}
</script>