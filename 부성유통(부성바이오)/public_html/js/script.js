//---------------------------메인 텍스트 게시물 추출 -----------------------------------
var main_tab_more = new Array();
main_tab_more[1] = "../bbs/list.php?bbs_id=noticee";
main_tab_more[2] = "../bbs/list.php?bbs_id=freee";
main_tab_more[3] = "../bbs/list.php?bbs_id=dataa";
main_tab_more[4] = "../bbs/list.php?bbs_id=free";
function main_tab_over(num){
	for(i=1;i<=4;i++){
		if(i == num){
			document.getElementById("main_tab_img" + i).src = "../images/main/m_tab_over" + i + ".gif";
			document.getElementById("main_c_tab" + i).style.display = "block";
			//document.getElementById("main_tab_group").setAttribute("num",i);
		}else{
			document.getElementById("main_tab_img" + i).src = "../images/main/m_tab" + i + ".gif";
			document.getElementById("main_c_tab" + i).style.display = "none";
		}
	}
}
function main_tab_out(){
	var num = document.getElementById("main_tab_group").getAttribute("num");
	for(i=1;i<=4;i++){
		if(i == num){
			document.getElementById("main_tab_img" + i).src = "../images/main/m_tab_over" + i + ".gif";
			document.getElementById("main_c_tab" + i).style.display = "block";
		}else{
			document.getElementById("main_tab_img" + i).src = "../images/main/m_tab" + i + ".gif";
			document.getElementById("main_c_tab" + i).style.display = "none";
		}
	}
}
function main_tab_click(num){
	for(i=1;i<=4;i++){
		if(i == num){
			document.getElementById("main_tab_img" + i).src = "../images/main/m_tab_over" + i + ".gif";
			document.getElementById("main_c_tab" + i).style.display = "block";
			document.getElementById("main_tab_group").setAttribute("num",i);
			document.getElementById("main_tab_img4").href = main_tab_more[i];
		}else{
			document.getElementById("main_tab_img" + i).src = "../images/main/m_tab" + i + ".gif";
			document.getElementById("main_c_tab" + i).style.display = "none";
		}
	}
}

//---------------------------메인 갤러리 게시물 추출 -----------------------------------
