<?php
// Define 파일이 제대로 Load 됐는지 확인용
define("JL_CHECK",true);
define("JL_Version",1.5);

// 최상단 폴더의 이름
define("JL_ROOT_DIR","public_html");

// Jl.js 위치 지정
define("JL_JS","/jl");

// 스마트에디터 사용시 경로지정 HuskyEZCreator.js
define("JL_EDITOR_JS","/plugin/editor/smarteditor2/js/HuskyEZCreator.js");

// 스마트에디터 사용시 경로지정 SmartEditor2Skin.html
define("JL_EDITOR_HTML","/plugin/editor/smarteditor2/SmartEditor2Skin.html");

// Vue component 폴더 지정
define("JL_COMPONENT","/component");

// DB 설정
define("JL_HOSTNAME","localhost");
define("JL_USERNAME","exam");
define("JL_PASSWORD","pass");
define("JL_DATABASE","exam");

/*
업데이트 노트
1. 5.2에서도 사용가능하게 업데이트
1.2 JlApi 추가
1.3 JlService 추가 JlApi 변경 및 간소화
1.4 Jl.php 세션 토큰 추가 JlService에 검증부분 추가
1.5 개발환경 자동으로 구하는거 추가 및 Jl CI변수 제거에 따른 로직코드 변경
*/

?>