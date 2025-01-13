****************************************************************************************************************

ITFORONE 패치내역

****************************************************************************************************************
****************************************************************************************************************

※ 주의사항 
  - 각각의 폴더명 / 파일명 으로 지정
  - ^ 일 경우 폴더명이 아니라 분류

****************************************************************************************************************

- public_html 
	└ config.php 변경
		└ line: 224					// 본인 아이피 상수 추가
		└ line: 225					// 그누보드 컨피그 설정 추가
	└ commone.php 변경
		└ line: 366					// 주석처리
		└ line: 371, 372			// $_SERVER['REMOTE_ADDR'] 삭제
	└ ^ shop path					// 경로설정 (쇼핑몰 경로로 바로가기)
		└ index.php 변경			// 상단 수정
		└ head.php 변경				// 상단 수정
		└ tail.php 변경				// 상단 수정
		└ mobile
			└ index.php 변경		// 상단 수정
			└ head.php 변경			// 상단 수정
			└ tail.php 변경			// 상단 수정

****************************************************************************************************************

// 아이티포원에 맞게 변경
- install					
	└ install_config.php 변경
		└ install_manager.php 추가
	└ install_db.php 변경				// 전반적으로 변경
	└ gnuboard5.sql 변경				// 전반적으로 변경
	└ gnuboard5_shop.sql 변경			// 옵션 저장 sql 추가
	
****************************************************************************************************************

- lib
	└ common.lib.php 변경
		└ line: 138 ~ 144 			// 앱 쿠키생성
		└ Line: 340, 412, 414, 432	// getList() 를 adm/bbs 에서도 사용 할 수 있도록 변경(url 링크변경)
		└ line: 795 				// lets080 슈퍼어드민 설정
		└ line: 3360 ~ 3372			// ip 체크
		└ line: 3374 ~ 3403			// submenu 추가
		└ line: 3405 ~ 3426			// json encode, decode 추가
		
****************************************************************************************************************

- adm
	└ admin.menu100.php 변경	
		└ line: 9					// 서브메뉴관리 추가
	└ admin.menu300.php 변경	
		└ line: 11					// 내용관리저장 추가
	└ admin.menu900.php 변경	
	└ admin.head.php 변경				// 몇몇 메뉴들 lets080 만 보일수 있도록 수정
		└ line: 79
	└ admin.lib.php
		└ line: 367					// lets080 토큰오류 무시
	└ ^ menu						// 작업량이 기존 것으로 많아 일괄 변경
		└ menu_form.php 변경	
		└ menu_form_update.php 변경	
		└ menu_list.php 변경	
		└ menu_list_update.php 변경
	└ ^ submenu
		└ submenu_form.php 추가	
		└ submenu_form_update.php 추가	
		└ submenu_list.php 추가	
		└ submenu_list_update.php 추가
	└ ^ board						// orderby 추가
		└ board_form.php 변경
			└ line: 113, 114		// 기본폴더를 테마폴더로 변경
			└ line: 774 ~ 788
		└ board_form_update.php 변경
			└ line: 154	
	└ ^ content						// 내용저장 가능토록
		└ contentform.php 변경		
			└ line: 33, 53, 54		// 기본폴더를 테마폴더로 변경
			└ line: 80			
			└ line: 213 ~ 248		
		└ ajax.contentsave_update.php 추가
		└ contentsaveform.php 추가
		└ contentsaveformupdate.php 추가
		└ contentsavelist.php 추가
	└ menu_form.php				// 메뉴 설정 후 창 안꺼지도록 (디자인 요청)
		└ line: 155, 156 
	└ submenu_form.php			// 위와 동일
		└ line: 181, 182

	// 관리자페이지 게시판 사용 가능 세팅
	└ bbs 추가				
		└ admin.lib.php
			└ line: 455 ~ 458			// 상수 추가
		
****************************************************************************************************************

- admin
	└ shop_admin
		└ itemform.php 변경
		└ ajax.itemoptionsave.php 추가
		└ itemoptionsaveform.php 추가
		└ itemoption.php 변경
			└ line: 217
		
****************************************************************************************************************

- bbs
	└ login_check.php 변경
		└ line: 9					// 로그인
		└ line: 62					// $_SERVER['REMOTE_ADDR'] 삭제
		└ line: 65					// set_cookie_app 추가
		└ line: 70					// set_cookie_app 추가
	└ login_auto.php 추가
	└ logout.php
		└ line: 11					// set_cookie_app 추가
	└ write_update.php
		└ line: 120 ~ 123			// order by 사용
		└ line: 277, 278, 393, 394	// sql_common 문 및 sql_orderby 문 추가	
	└ list.php
		└ line: 48, 63 ~ 69, 178	// sql_search 문 변경
		
****************************************************************************************************************

- theme
	└ basic 변경						// ITFORONE 테마로 변경
	└ gnu_basic 추가					// 그누보드 기본 테마

