<?
// addon 디렉토리만 사용가능하도록 해킹방지등.
//	$source[] = '/\.\.\//';
//	$target[] = '';
	$source[] = '/^\//';
	$target[] = '';

	require_once("include/lib.inc.php");
	if($bbs_id != '') require_once("include/bbs.lib.inc.php");

	// addon 디렉토리만 사용가능하도록 해킹방지등.
	$file = preg_replace($source, $target, $file);
	
	// 파일의 절대경로를 구하여 비교한다.
	$addon_realpath = realpath($site_addon_path);
	$addon_file_realpath = realpath($site_addon_path."$file");

	$addon_realpath_len = strlen(realpath($addon_realpath));
	
	if($addon_realpath != substr($addon_file_realpath,0,$addon_realpath_len)) {
		$addon_file_realpath='';
	}	
	
	include($skin_site_path."head.php");
	// 에드온 처리
	if ($file && file_exists($addon_file_realpath)) 
		include($addon_file_realpath);
	include($skin_site_path."foot.php");
?>
