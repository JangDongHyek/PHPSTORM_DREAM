<?
	$l_cols="0";
?>
<style type="text/css">
  body, table, tr, td {font-size:14px;color: #000000;font-family:"돋움",Dotum;margin:auto;}
  img {border:0 none;vertical-align:top;}
  a {color: #000000; text-decoration: none}
  a:hover {color: #000000; text-decoration: none}
  #wrap { width:100%; }
  #wrap_contents { position:relative; width:320px;margin:auto; }
  #bgm { position:absolute; top:30px; left:10px; width:33px; height:34px;  z-index:999;}
</style>

<STYLE TYPE="text/css">
	#content { position:relative; width:100%; background: url(./images/gallery/bg_gallery.png) no-repeat; text-align:center }
	#bi { position:relative; width:295px; height:245px; border:0px none; overflow:hidden;margin:0px auto;display:none}
	#bi1 { position:relative; display:none;width:258px; height:50px;margin:0px auto; }
	#it { position:relative;  width:257px; height:11px; text-align:center;margin:0px auto; }
	#si { position:relative; height:57px; }
	#bleft { position:relative; top:3px; float:left; width:40px; height:56px; }
	#bright { position:relative; top:3px; float:right; width:40px; height:56px; }
	.scrollable {	float:left;overflow:hidden;width: 240px;height: 62px;position:relative; }
	.scrollable .items {clear:both;width:20000em;position:absolute;left:0px;}
	.scrollable img {border:#ccc 1px solid;padding:2px;float:left;margin:3px;width:68px;height: 50px;cursor:pointer; background-color:#fff;-moz-border-radius: 0px; -webkit-border-radius: 0px}
	.scrollable .active {z-index: 9999;position: relative;border: #000 2px solid; }
	a.disabled { opacity : 0.3;}

	.ti { font-size:11px; font-family:"돋움",Dotum; }
</STYLE>
<!--<script type="text/javascript">
window.addEventListener("load", function(){
setTimeout(loaded, 100);

}, false);

function loaded(){
	window.scrollTo(0, 1);
}
</script>-->

	<script type="text/javascript" src="<?=$skin_board_url?>js/include.js"></script>

<script type="text/javascript">
<!--
var mySlideShow;

window.addEvent('domready',function(){
mySlideShow = new SlideShow('slides',{
delay: 2000,			// 이미지 지연 속도
duration: '1000',		// 이미지 오버랩 간격
autoplay: true
});

jq("#browsable").scrollable();
jq(".items img").click(function() {
mySlideShow.show(mySlideShow.slides[this.id]);
});

});
function showImg(file,title,doc_num,bbs_id){
	var img_view=document.getElementById("img_view");
	var strHtml="";
	if(doc_num){
		strHtml+="<img src='"+file+"' width=258 height=250></a><br>"+title;
		strHtml+="<br><a href='./mobile_view.php?bbs_id="+bbs_id+"&doc_num="+doc_num+"'>";
		
		if("<?=$mb?>"){
			strHtml+="<input type=checkbox value="+doc_num+" name=rg_doc_num id=rg_doc_num>";
		}
		strHtml+="<img src='<?=$skin_board_url?>/images/view.gif' alt='상세보기'/></a>";
	}
	img_view.innerHTML=strHtml;
}
function img_modify(){
	var rg_doc_num=document.getElementById("rg_doc_num");
	if(rg_doc_num.checked){
		location.href="mobile_edit.php?bbs_id=<?=$bbs_id?>&doc_num="+rg_doc_num.value;
	}else{
		alert("체크 박스를 체크하신 후에 수정하실 수 있습니다..");
	}
}
function img_delete(){
	var rg_doc_num=document.getElementById("rg_doc_num");
	if(rg_doc_num.checked){
		location.href="mobile_delete.php?bbs_id=<?=$bbs_id?>&doc_num="+rg_doc_num.value;
	}else{
		alert("체크 박스를 체크하시고 삭제하시면 됩니다.");
	}
}
//-->
</script>
<link rel="stylesheet" href="<?=$skin_board_url?>css/image-slideshow.css" type="text/css">
 <? /*  
	
	<input type="hidden" name="skin_board_url" id="skin_board_url" value="<?=$skin_board_url?>">
<div id="dhtmlgoodies_slideshow">
	<div id="previewPane">
		<img src="#" id="imageBig">
		<span id="waitMessage">Loading image. Please wait</span>	
		<div id="largeImageCaption"></div>
	</div>
	<div id="galleryContainer">
		<div id="arrow_left"><img src="<?=$skin_board_url?>images/arrow_left.gif" width="25"></div>
		<div id="arrow_right"><img src="<?=$skin_board_url?>images/arrow_right.gif" width="25"></div>
		<div id="theImages">
*/?>
<div id="img_view" style=""></div>

<div id="wrap">
<div id="wrap_contents" style="text-align:center">
	<div id="bgm"></div>
		<div id="content" style="text-align:center">
          <div id="bi">
            <div id="bi1">
              <div id="slides">