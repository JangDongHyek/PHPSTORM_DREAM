<div class="header">
	<p>운송 관리 시스템 관리자</p>
	<a href="<?=G5_BBS_URL."/logout.php?type=admin"?>">
        <button type="button" class="green">
            로그아웃
        </button>
	</a>
		
    <a href="./excel/download?mode=<?=$subPid?>&<?=$_SERVER['QUERY_STRING']?>" target="_blank">
        <button type="button" class="green2"> 
            <i class="fa-solid fa-file-excel"></i>엑셀 다운로드
        </button>
    </a>	
	
	<? if($subPid == 'index'){ /* index 전용 */ ?>
        <button type="button" class="blue" onclick="openDispatchModal()"> 
            <i class="fa-duotone fa-truck"></i>배차하기
        </button>
    <? } ?>
</div>