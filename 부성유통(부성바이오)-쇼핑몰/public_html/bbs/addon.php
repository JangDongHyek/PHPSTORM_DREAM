<?
// addon ���丮�� ��밡���ϵ��� ��ŷ������.
//	$source[] = '/\.\.\//';
//	$target[] = '';
	$source[] = '/^\//';
	$target[] = '';

	require_once("include/lib.inc.php");
	if($bbs_id != '') require_once("include/bbs.lib.inc.php");

	// addon ���丮�� ��밡���ϵ��� ��ŷ������.
	$file = preg_replace($source, $target, $file);
	
	// ������ �����θ� ���Ͽ� ���Ѵ�.
	$addon_realpath = realpath($site_addon_path);
	$addon_file_realpath = realpath($site_addon_path."$file");

	$addon_realpath_len = strlen(realpath($addon_realpath));
	
	if($addon_realpath != substr($addon_file_realpath,0,$addon_realpath_len)) {
		$addon_file_realpath='';
	}	
	
	include($skin_site_path."head.php");
	// ����� ó��
	if ($file && file_exists($addon_file_realpath)) 
		include($addon_file_realpath);
	include($skin_site_path."foot.php");
?>
