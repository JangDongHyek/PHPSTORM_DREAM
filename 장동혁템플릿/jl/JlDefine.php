<?php
// Define 파일이 제대로 Load 됐는지 확인용
define("JL_CHECK",true);
define("JL_Version",1.8);

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

//Vue version 2 or 3 3이 최신이다.
define("VUE_VERSION",3);
// alert을 뭐로쓸지 origin,swal
define("JL_ALERT","origin");

// session 폴더가있다면 경로 입력 CI나 그냥 세션으로 사용가능하다면 주석처리나 빈값으로 변경
define("JL_SESSION_PATH","/data/session");

//jl_session_table 컬럼
define('JL_SESSION_TABLE_COLUMNS', '{"idx":{"type":"VARCHAR","length":15,"nullable":false,"comment":"고유값"},"client_ip":{"type":"VARCHAR","length":45,"nullable":false,"comment":"사용자 아이피"},"name":{"type":"VARCHAR","length":255,"nullable":false,"comment":"세션명"},"content":{"type":"TEXT","nullable":false,"comment":"내용"},"method":{"type":"VARCHAR","length":20,"nullable":true,"comment":"요청 방식"},"response":{"type":"LONGTEXT","nullable":true,"comment":"응답 내용"},"sessions":{"type":"LONGTEXT","nullable":true,"comment":"접속자 세션 데이터"},"user_agent":{"type":"TEXT","nullable":true,"comment":"접속정보"},"browser":{"type":"VARCHAR","length":255,"nullable":true,"comment":"접속한 브라우저"},"browser_version":{"type":"VARCHAR","length":255,"nullable":true,"comment":"브라우저 버전"},"platform":{"type":"VARCHAR","length":255,"nullable":true,"comment":"접속한 플랫폼"},"is_mobile":{"type":"VARCHAR","length":7,"nullable":true,"comment":"모바일"},"in_app_browser":{"type":"VARCHAR","length":50,"nullable":true,"comment":"앱"},"status":{"type":"VARCHAR","length":7,"nullable":false,"default":"active","comment":"세션상태"},"insert_date":{"type":"DATETIME","nullable":false,"comment":"생성일"},"update_date":{"type":"DATETIME","nullable":true,"comment":"수정일"},"delete_date":{"type":"DATETIME","nullable":true,"comment":"세션만료시간"},"primary":"idx"}');

/*
업데이트 노트
1. 5.2에서도 사용가능하게 업데이트
1.2 JlApi 추가
1.3 JlService 추가 JlApi 변경 및 간소화
1.4 Jl.php 세션 토큰 추가 JlService에 검증부분 추가
1.5 개발환경 자동으로 구하는거 추가 및 Jl CI변수 제거에 따른 로직코드 변경
1.6 jl 디비 세션 자동 생성 및 로직 추가
1.7 vue3 버전 호환되게 추가 및 define vue_version 추가
1.8 define 세션공유할수있게 sessionPath 추가
*/

?>