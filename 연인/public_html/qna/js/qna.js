/* 아이프레임 */
function resizeIframe(obj) {
	//obj.style.height = (obj.contentWindow.document.body.scrollHeight + 20)+ 'px'; 
	iFrameResize({
		// Disable if using size method with custom dimensions.
		autoResize: true,

		// Override the body background style in the iFrame.
		bodyBackground: null,

		// Override the default body margin style in the iFrame.
		// A string can be any valid value for the CSS margin attribute, 
		// for example '8px 3em'. A number value is converted into px.
		bodyMargin: null,
		bodyMarginV1: 0,
		bodyPadding: null,

		// When set to true, only allow incoming messages from the domain 
		// listed in the src property of the iFrame tag. If your iFrame 
		// navigates between different domains, ports or protocols; 
		// then you will need to disable this option.
		checkOrigin: true,

		// If enabled, a window.parentIFrame object is created in the iFrame 
		// that contains methods outlined
		enablePublicMethods: true,

		// 'bodyOffset' | 'body<a href="https://www.jqueryscript.net/tags.php?/Scroll/">Scroll</a>' | 'documentElementOffset' | 'documentElementScroll' | 
		// 'max' | 'min' | 'grow' | 'lowestElement'
		heightCalculationMethod: 'offset',

		// The default value is equal to two frame refreshes at 60Hz
		interval: 32,

		// Setting the log option to true will make the scripts in both the host page 
		// and the iFrame output everything they do to the JavaScript console 
		// so you can see the communication between the two scripts.
		log: false,

		// Set maximum height/width of iFrame.
		maxHeight: Infinity,
		maxWidth: Infinity,

		// Set minimum height/width of iFrame.
		minHeight: 0,
		minWidth: 0,

		// Enable scroll bars in iFrame.
		scrolling: false,

		// Resize iFrame to content height.
		sizeHeight: true,

		// Resize iFrame to content width.
		sizeWidth: false,

		// Set the number of pixels the iFrame content size has to change by, 
		// before triggering resize of the iFrame.
		tolerance: 0,

		// Called when iFrame is closed via parentIFrame.close() method.
		closedCallback: function () { },

		// Initial setup callback function.
		initCallback: function () { },

		// Receive message posted from iFrame with the parentIFrame.sendMessage() method.
		messageCallback: function () { },

		// Function called after iFrame resized.
		resizedCallback: function () { },

		// Called before the page is repositioned after a request from the iFrame
		scrollCallback: function () { 
			return true; 
		}
	});
}


/* view */
// 문의삭제
function deleteQst(idx) {
	if (!confirm("해당 질문을 삭제하시겠습니까? 삭제된 데이터는 복구되지 않습니다.")) return false;
	var err_msg = "삭제에 실패하였습니다. 다시 시도해 주세요.";
	var obj = {mode: 'delete', idx: idx};
	var del_file = [];

	$.each($('input[name="files[]"]'), function(index, el) {
		del_file.push($(el).val());
	});
	obj.del_file = del_file;

	$.ajax({
		type : "post",  
		url : "./write_update.php",
		data : obj,
		dataType : "json",  
		
	}).done(function(data, textStatus, xhr) {
		console.log(data);
		if (data.result) {
			alert("삭제가 완료되었습니다.");
			history.replaceState({data: "replaceState"}, "", g5_url + "/qna/list.php");
			location.reload();
		} else {
			alert(err_msg);
		}
	}).fail(function(data, textStatus, errorThrown) {
		alert(err_msg);
	}).always(function() {
	});
}