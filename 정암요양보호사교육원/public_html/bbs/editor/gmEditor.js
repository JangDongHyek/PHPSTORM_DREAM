//-------------------------------------------------------------------//
//  ���α׷��� : gmEditor v1.0
//-------------------------------------------------------------------//
//  ���� ���� �Ϸ��� : 2006-01-05
//  ���߻� �� ���۱��� : PHP����
//  ������Ʈ : http://www.phpmonster.co.kr
//  �� �� �� : �ڿ��� (misnam@gmail.com)
//-------------------------------------------------------------------//
//                           ī�Ƕ���Ʈ
//-------------------------------------------------------------------//
//  �� ���α׷��� ���� ���α׷����� �����˴ϴ�.
//  gmEditor�� GNU General Public License(GPL) �� �����ϴ�.
//  ���� �ڼ��� ������ LICENSE�� �����Ͻʽÿ�.
//  ����: http://korea.gnu.org/people/chsong/copyleft/gpl.ko.html
//-------------------------------------------------------------------//
//                           ����ȯ��
//-------------------------------------------------------------------//
//  ���� OS : IE 5.5 �̻�
//  IE ���� ȯ�濡���� �ùٷ� �۵����� ���� �� �ֽ��ϴ�.
//-------------------------------------------------------------------//


var str = "<STYLE>\nbody,td,a {font-size :9pt;}\np{margin-top:3px;margin-bottom:3px;}\n</STYLE>\n";
var gmFrame = frames.gmEditor;


// ���� ������ ������ ������
function Edit_Modify(contentName,contentValue){
	return eval("document." + contentName + "." + contentValue + ".value");
}


// HTML,TEXT ��� üũ
function chkMode(){
	if(document.getElementById('ModeType').checked==true) return true;
	return false;
}


// HTML,TEXT ��� ��ȯ
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


// �� ���۽� �Է¹��� ��
function SubmitHTML(){
	if(chkMode()) return gmFrame.document.body.innerText;
	else return gmFrame.document.body.innerHTML;
}


// ���� HTML ����
function HTMLPaste(key){
	gmFrame.focus();

	if(chkMode()) return false;
	past = gmFrame.document.selection.createRange();	
	past.pasteHTML(key);
}


// �󹮼� �ҷ�����
function newDoc(){
	gmFrame.focus();
	gmFrame.document.open("text/html");
	gmFrame.document.write(str);
	gmFrame.document.close();
}


// �̹��� ÷��
function Image_update(){
	return window.open(_editor_url+'/upfile.htm?url='+_editor_url,'_editor_tb','staus=no, width=463, height=183,scrollbars=no,toolbar=no,menubar=no');
}


// ��޻���
function createHTML(opt,key){
	var width; var height; var filename;

	switch(key){
		case 1: // ���̺� ����
			width = '328'; height = '255'; filename = 'table.htm';
		break;

		case 2: // Ư������ ����
			width = '232'; height = '335'; filename = 'characteristic.htm';
		break;

		case 3: // ������ ����
			width = '208'; height = '275'; filename = 'emotions.htm?url='+_editor_url;
		break;

		case 4: // �۲� ����
			width = '191'; height = '355'; filename = 'fontname.htm';
		break;

		case 5: // �̵�� ����
			width = '273'; height = '200'; filename = 'media.htm';
		break;

		case 6: // �÷��� ����
			width = '273'; height = '200'; filename = 'flash.htm';
		break;

		case 7: // ���ڻ� ����
			width = '245'; height = '260'; filename = 'color1.htm';
		break;

		case 8: // ���� ���� ����
			width = '245'; height = '260'; filename = 'color2.htm';
		break;

		case 9: // ���� ũ�� ����
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
