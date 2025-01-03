<?php
// Define 파일이 제대로 Load 됐는지 확인용
define("JL_CHECK",true);

// 최상단 폴더의 이름
define("JL_ROOT_DIR","public_html");

// Jl.js 위치 지정
define("JL_JS","/assets/jl");

// 스마트에디터 사용시 경로지정
define("JL_EDITOR_JS","/plugin/editor/smarteditor2/js/HuskyEZCreator.js");

// 스마트에디터 사용시 경로지정
define("JL_EDITOR_HTML","/plugin/editor/smarteditor2/SmartEditor2Skin.html");

// CI 사용유무 체크 CI4 같은경우는 자동으로 바뀌고 3은 수동으로 바꿔줘야한다
define("JL_CI",true);

// Vue component 폴더 지정
define("JL_COMPONENT","/assets/component");

// DB 설정
define("JL_HOSTNAME","localhost");
define("JL_USERNAME","stmedi");
define("JL_PASSWORD","q61eh96w");
define("JL_DATABASE","stmedi");

define('JL_SESSION_TABLE_COLUMNS', '{"idx":{"type":"VARCHAR","length":15,"nullable":false,"comment":"고유값"},"client_ip":{"type":"VARCHAR","length":45,"nullable":false,"comment":"사용자 아이피"},"name":{"type":"VARCHAR","length":255,"nullable":false,"comment":"세션명"},"content":{"type":"TEXT","nullable":false,"comment":"내용"},"user_agent":{"type":"TEXT","nullable":true,"comment":"접속정보"},"browser":{"type":"VARCHAR","length":255,"nullable":true,"comment":"접속한 브라우저"},"browser_version":{"type":"VARCHAR","length":255,"nullable":true,"comment":"브라우저 버전"},"platform":{"type":"VARCHAR","length":255,"nullable":true,"comment":"접속한 플랫폼"},"is_mobile":{"type":"VARCHAR","length":7,"nullable":true,"comment":"모바일"},"in_app_browser":{"type":"VARCHAR","length":50,"nullable":true,"comment":"앱"},"status":{"type":"VARCHAR","length":7,"nullable":false,"default":"active","comment":"세션상태"},"insert_date":{"type":"DATETIME","nullable":false,"comment":"생성일"},"update_date":{"type":"DATETIME","nullable":true,"comment":"수정일"},"delete_date":{"type":"DATETIME","nullable":true,"comment":"세션만료시간"},"primary":"idx"}');
?>