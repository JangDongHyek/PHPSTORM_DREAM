/*!
 *
 * Super simple wysiwyg editor v0.8.18
 * https://summernote.org
 *
 *
 * Copyright 2013- Alan Hong. and other contributors
 * summernote may be freely distributed under the MIT license.
 *
 * Date: 2020-05-20T18:09Z
 *
 */
(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory();
	else if(typeof define === 'function' && define.amd)
		define([], factory);
	else {
		var a = factory();
		for(var i in a) (typeof exports === 'object' ? exports : root)[i] = a[i];
	}
})(window, function() {
return /******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 27);
/******/ })
/************************************************************************/
/******/ ({

/***/ 27:
/***/ (function(module, exports) {

(function ($) {
  $.extend($.summernote.lang, {
    'ko-KR': {
      font: {
        bold: '굵게',
        italic: '기울임꼴',
        underline: '밑줄',
        clear: '서식 지우기',
        height: '줄 간격',
        name: '글꼴',
        superscript: '위 첨자',
        subscript: '아래 첨자',
        strikethrough: '취소선',
        size: '글자 크기'
      },
      image: {
        image: '그림',
        insert: '그림 삽입',
        resizeFull: '100% 크기로 변경',
        resizeHalf: '50% 크기로 변경',
        resizeQuarter: '25% 크기로 변경',
        resizeNone: '원본 크기',
        floatLeft: '왼쪽 정렬',
        floatRight: '오른쪽 정렬',
        floatNone: '정렬하지 않음',
        shapeRounded: '스타일: 둥근 모서리',
        shapeCircle: '스타일: 원형',
        shapeThumbnail: '스타일: 액자',
        shapeNone: '스타일: 없음',
        dragImageHere: '텍스트 혹은 사진을 이곳으로 끌어오세요',
        dropImage: '텍스트 혹은 사진을 내려놓으세요',
        selectFromFiles: '파일 선택',
        maximumFileSize: '최대 파일 크기',
        maximumFileSizeError: '최대 파일 크기를 초과했습니다.',
        url: '사진 URL',
        remove: '사진 삭제',
        original: '원본'
      },
      video: {
        video: '동영상',
        videoLink: '동영상 링크',
        insert: '동영상 삽입',
        url: '동영상 URL',
        providers: '(YouTube, Vimeo, Vine, Instagram, DailyMotion, Youku 사용 가능)'
      },
      link: {
        link: '링크',
        insert: '링크 삽입',
        unlink: '링크 삭제',
        edit: '수정',
        textToDisplay: '링크에 표시할 내용',
        url: '이동할 URL',
        openInNewWindow: '새창으로 열기'
      },
      table: {
        table: '표',
        addRowAbove: '위에 행 삽입',
        addRowBelow: '아래에 행 삽입',
        addColLeft: '왼쪽에 열 삽입',
        addColRight: '오른쪽에 열 삽입',
        delRow: '행 지우기',
        delCol: '열 지우기',
        delTable: '표 삭제'
      },
      hr: {
        insert: '구분선 삽입'
      },
      style: {
        style: '스타일',
        p: '본문',
        blockquote: '인용구',
        pre: '코드',
        h1: '제목 1',
        h2: '제목 2',
        h3: '제목 3',
        h4: '제목 4',
        h5: '제목 5',
        h6: '제목 6'
      },
      lists: {
        unordered: '글머리 기호',
        ordered: '번호 매기기'
      },
      options: {
        help: '도움말',
        fullscreen: '전체 화면',
        codeview: '코드 보기'
      },
      paragraph: {
        paragraph: '문단 정렬',
        outdent: '내어쓰기',
        indent: '들여쓰기',
        left: '왼쪽 정렬',
        center: '가운데 정렬',
        right: '오른쪽 정렬',
        justify: '양쪽 정렬'
      },
      color: {
        recent: '마지막으로 사용한 색',
        more: '다른 색 선택',
        background: '배경색',
        foreground: '글자색',
        transparent: '투명',
        setTransparent: '투명으로 설정',
        reset: '취소',
        resetToDefault: '기본값으로 설정',
        cpSelect: '색상선택'
      },
      shortcut: {
        shortcuts: '키보드 단축키',
        close: '닫기',
        textFormatting: '글자 스타일 적용',
        action: '기능',
        paragraphFormatting: '문단 스타일 적용',
        documentStyle: '문서 스타일 적용',
        extraKeys: '추가 키'
      },
      help: {
        'insertParagraph': '문단 삽입',
        'undo': '마지막 명령 취소',
        'redo': '마지막 명령 재실행',
        'tab': '탭',
        'untab': '탭 제거',
        'bold': '굵은 글자로 설정',
        'italic': '기울임꼴 글자로 설정',
        'underline': '밑줄 글자로 설정',
        'strikethrough': '취소선 글자로 설정',
        'removeFormat': '서식 삭제',
        'justifyLeft': '왼쪽 정렬하기',
        'justifyCenter': '가운데 정렬하기',
        'justifyRight': '오른쪽 정렬하기',
        'justifyFull': '좌우채움 정렬하기',
        'insertUnorderedList': '글머리 기호 켜고 끄기',
        'insertOrderedList': '번호 매기기 켜고 끄기',
        'outdent': '현재 문단 내어쓰기',
        'indent': '현재 문단 들여쓰기',
        'formatPara': '현재 블록의 포맷을 문단(P)으로 변경',
        'formatH1': '현재 블록의 포맷을 제목1(H1)로 변경',
        'formatH2': '현재 블록의 포맷을 제목2(H2)로 변경',
        'formatH3': '현재 블록의 포맷을 제목3(H3)로 변경',
        'formatH4': '현재 블록의 포맷을 제목4(H4)로 변경',
        'formatH5': '현재 블록의 포맷을 제목5(H5)로 변경',
        'formatH6': '현재 블록의 포맷을 제목6(H6)로 변경',
        'insertHorizontalRule': '구분선 삽입',
        'linkDialog.show': '링크 대화상자 열기'
      },
      history: {
        undo: '실행 취소',
        redo: '재실행'
      },
      specialChar: {
        specialChar: '특수문자',
        select: '특수문자를 선택하세요'
      }
    }
  });
})(jQuery);

/***/ })

/******/ });
});

// summernote 기본세팅 (공통)
const getSummerNoteSettings = (editorId, enableInsert, enableTable, enablePaste) => {
  let toolbar = [
    // ['style', ['style']],
    ['font', ['bold', 'underline', 'clear']],
    // ['fontname', ['fontname']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['paragraph']], //'ul', 'ol',
    // ['table', ['table']],
    // ['insert', ['link', 'picture']],
    // ['view', ['undo', 'redo']], //'fullscreen',
  ];
  // 링크 & 사진기능 사용
  if (enableInsert === true) toolbar.push(['insert', ['link', 'picture']]);
  // 표
  if (enableTable === true) toolbar.push(['table', ['table']]);
  // 에디터 되돌리기, 앞으로
  toolbar.push(['view', ['undo', 'redo']]);

  let settings = {
    height: 400,
    lang: 'ko-KR',
    toolbar: toolbar,
    fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '22', '24', '28', '30', '36', '50', '72'],
    // fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', '맑은 고딕', '굴림', '돋움', '바탕'],
    // fontNamesIgnoreCheck: [
    //     '맑은 고딕', '굴림', '돋움', '바탕' // 원하는 한글 폰트 추가
    // ],
    placeholder: '내용을 입력해 주세요',
    popover: {
      image: [
        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
        ['float', ['floatLeft', 'customFloatCenter', 'floatRight', 'floatNone']],
        ['remove', ['removeMedia']]
      ]
    },
    buttons: {
      // 이미지 툴바 가운데 정렬
      customFloatCenter: function (context) {
        let ui = $.summernote.ui;
        let button = ui.button({
          contents: '<i class="note-icon-align-center"></i>', // 아이콘 설정
          tooltip: 'Center',
          click: function () {
            let $img = $(context.invoke('restoreTarget'));
            $img.css('display', 'block');
            $img.css('margin-left', 'auto');
            $img.css('margin-right', 'auto');
            $img.css('float', 'none');

            context.invoke('editor.afterCommand'); // 팝오버를 닫음
          }
        });
        return button.render();
      }
    },
    callbacks: {
      onInit: (e) => {
        // panel 클래스 삭제 (기본스타일과 중첩됨)
        $('.note-editor.note-frame').removeClass('panel panel-default');

        let fontSize = '14'; // 기본폰트 크기
        let noteEditable = $('.note-editable');
        noteEditable.css({'font-size': fontSize + 'px'});
        const noteBtn = $('.note-btn-group.btn-group.note-fontsize');
        noteBtn.find('.dropdown-toggle').children('.note-current-fontname').text(fontSize);
      },
      onPaste: function (e) {
        // 클립보드에서 텍스트만 추출해 붙여넣기
        if (enablePaste !== true) {
          e.preventDefault();

          let text = '';
          if (e.originalEvent.clipboardData) {
            text = e.originalEvent.clipboardData.getData('text/plain');
          } else if (window.clipboardData) {
            text = window.clipboardData.getData('Text');
          }

          // 에디터에 일반 텍스트로 삽입
          document.execCommand('insertText', false, text);
        }
      },
      onImageUpload: async function(files) {
        // 파일 업로드 함수 호출
        // sendSummerNoteFile(files[0], editorId);
        for (let i = 0; i < files.length; i++) {
          await sendSummerNoteFile(files[i], editorId);
        }
      }
    }
  };

  return settings;
}

async function sendSummerNoteFile(file, editorId) {
  const formData = new FormData();
  formData.append('uploaded_file', file);
  formData.append('target', 'EDITOR');
  formData.append('createMbFolder', 'Y');

  const response = await API.fetchData('/file/upload', formData);
  if (response.result) {
    const $editor = $(`#${editorId}`);

    // 현재커서 기준 추가
    $editor.summernote('insertImage', response.source);

    // 에디터 끝에 추가
    // let editorContent = $editor.summernote('code');
    // let imgTag = '<img src="' + response.source + '"/>';
    // $editor.summernote('code', editorContent + imgTag);

  } else {
    return showError('파일첨부에 실패했습니다.');
  }
}
