<?
switch ($_GET['bo_table']) {
	case "refund" : $sub_menu = "600100"; break;		// 환불요청
	case "rematch" : $sub_menu = "600200"; break;		// 리매칭신청
	case "report" : $sub_menu = "600300"; break;		// 신고게시판
	case "helper" : $sub_menu = "600400"; break;		// 헬퍼게시판
	case "b_notice" : $sub_menu = "650100"; break;		// 공지사항
	case "b_counsel" : $sub_menu = "650200"; break;		// 연애상담소
	case "b_event" : $sub_menu = "650300"; break;		// 이벤트
	case "review" : $sub_menu = "650500"; break;		// 커플후기
	default : $sub_menu = "600000";
}

?>