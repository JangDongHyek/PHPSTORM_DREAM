//-------------------------------------------------------------------//
//  프로그램명 : gmEditor v1.0
//-------------------------------------------------------------------//
//  최초 개발 완료일 : 2006-01-05
//  개발사 및 저작권자 : PHP몬스터
//  웹사이트 : http://www.phpmonster.co.kr
//  개 발 자 : 박요한 (misnam@gmail.com)
//-------------------------------------------------------------------//
//                           카피라이트
//-------------------------------------------------------------------//
//  본 프로그램은 무료 프로그램으로 배포됩니다.
//  gmEditor는 GNU General Public License(GPL) 를 따릅니다.
//  보다 자세한 내용은 LICENSE를 참조하십시요.
//  참고: http://korea.gnu.org/people/chsong/copyleft/gpl.ko.html
//-------------------------------------------------------------------//
//                           개발환경
//-------------------------------------------------------------------//
//  지원 OS : IE 5.5 이상
//  IE 외의 환경에서는 올바로 작동하지 않을 수 있습니다.
//-------------------------------------------------------------------//


var str = "<STYLE>\nbody,td,a {font-size :9pt;}\np{margin-top:3px;margin-bottom:3px;}\n</STYLE>\n";
var gmFrame = frames.gmEditor;


// 이전 내용이 있으면 가져옴
function Edit_Modify(contentName,contentValue){
	return eval("document." + contentName + "." + contentValue + ".value");
}


// HTML,TEXT 모드 체크
function chkMode(){
	if(document.getElementById('ModeType').checked==true) return true;
	return false;
}


// HTML,TEXT 모드 전환
function HTMLMode(){
	gmFrame.focus();

	if(chkMode()) {
		gmFrame.document.body.innerText = gmEditor.document.body.innerHTML;
		editorBox.style.display = 'none';
	}
	else {
		gmFrame.document.body.innerHTML = gmEditor.document.body.innerText;
		editorBox.style.display = 'block';
	}
}


// 폼 전송시 입력받을 값
function SubmitHTML(){
	if(chkMode()) return gmFrame.document.body.innerText;
	else return gmFrame.document.body.innerHTML;
}


// 각종 HTML 삽입
function HTMLPaste(key){
	gmFrame.focus();

	if(chkMode()) return false;
	past = gmFrame.document.selection.createRange();	
	past.pasteHTML(key);
}


// 빈문서 불러오기
function newDoc(){
	gmFrame.focus();
	gmFrame.document.open("text/html");
	gmFrame.document.write(str);
	gmFrame.document.close();
}


// 이미지 첨부
function Image_update(){
	return window.open(_editor_url+'/upfile.htm?url='+_editor_url,'_editor_tb','staus=no, width=463, height=183,scrollbars=no,toolbar=no,menubar=no');
}


// 모달상자
function createHTML(opt,key){
	var width; var height; var filename;

	switch(key){
		case 1: // 테이블 삽입
			width = '328'; height = '255'; filename = 'table.htm';
		break;

		case 2: // 특수문자 삽입
			width = '232'; height = '335'; filename = 'characteristic.htm';
		break;

		case 3: // 아이콘 삽입
			width = '208'; height = '275'; filename = 'emotions.htm?url='+_editor_url;
		break;

		case 4: // 글꼴 삽입
			width = '191'; height = '355'; filename = 'fontname.htm';
		break;

		case 5: // 미디어 삽입
			width = '273'; height = '200'; filename = 'media.htm';
		break;

		case 6: // 플래쉬 삽입
			width = '273'; height = '200'; filename = 'flash.htm';
		break;

		case 7: // 글자색 삽입
			width = '245'; height = '260'; filename = 'color1.htm';
		break;

		case 8: // 글자 배경색 삽입
			width = '245'; height = '260'; filename = 'color2.htm';
		break;

		case 9: // 글자 크기 삽입
			width = '388'; height = '335'; filename = 'fontsize.htm';
		break;
	}

	var val = showModalDialog(_editor_url+'/'+filename,null,'dialogWidth:' + width + 'px;dialogHeight:' + height + 'px;dialogLeft:center;diallogTop:center;help:no;status:no;');

	if(val){
		gmFrame.focus();
		if((key=='4') || (key=='7') || (key=='8') || (key=='9')) {
			window.htmltrue(opt,val);
		}
		else {
			window.HTMLPaste(val);
		}
	}
	return false;
}


function htmlfalse(key){
	gmFrame.focus();
	gmFrame.document.execCommand(key, false, null);
	return false;
}
function htmltrue(key,val){
	gmFrame.focus();
	gmFrame.document.execCommand(key, true, val);
	return false;
}


gmFrame.document.write(str);
gmFrame.document.write(Edit_Modify(contentName,contentValue));

gmFrame.document.designMode = "On";
