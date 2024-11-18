/* 광고 */
// 아이프레임 리사이징
function resizeIframe(obj) {
	obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
}

// 광고등록 - 팝업열기
function adRegiter(page) {
	var pop_w = 600,
		pop_h = 400,
		left = Math.floor((window.innerWidth - pop_w) / 2),
		top = Math.floor((window.innerHeight - pop_h) / 2);

	window.open("./ad_form.php?ad_page="+page, "광고등록", "width="+pop_w+"px,height="+pop_h+"px,top="+top+",left="+left+",scrollbars=yes");	
}
// 광고등록 - 팝업닫기
function adPopClose() {
	//ad_popup.close();
	window.open('about:blank','_self').close(); 
	opener.location.reload();
}