<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>

    <div id="aside">
    	<?php /*?><div><img src="<?php echo $theme_path.'/skin/submenu/'.$skin_dir.'/m_arrow.png'; ?>" /></div><?php */?>
        <div class="marrow"></div>
        <div class="dl_wrap">
            <dl>
                <dt><p>TAEJIN SYSTEM</p>
                <?php echo $title['sm_name'] ?></dt>
                <?php for($i=0; $i<$sub=sql_fetch_array($result); $i++){ ?>
                <dd><a href="<?php echo G5_URL.$sub['sm_link']?>" <?php if($sm_tid == $sub['sm_tid']){ echo "class='on'"; } ?>><?php echo $sub['sm_name'];?></a>
									
                   <?php if($sub['sm_name'] == "스마트공장 지원사업"&&$sm_tid=="smart01"){ //스마트팩토리
					echo 
					"<dl class='section hidden-sm hidden-xs'>
						<dd><a href='#section01'>스마트팩토리 개요</a></dd>
						<dd><a href='#section02'>스마트팩토리 지원사업</a></dd>
						<dd><a href='#section03'>스마트팩토리 구축사례</a></dd>
					</dl> "; 
					 }else if($sub['sm_name'] == "MES/POP"&&$sm_tid=="pro01"){
						echo 
					"<dl class='section hidden-sm hidden-xs'>
						<dd><a href='#section01'>MES (제조실행 시스템)</a></dd>
						<dd><a href='#section02'>POP (생산 시점 관리)</a></dd>
					</dl> "; 
					 }else {
			          echo ""; 
					 }
					 ?>
                </dd>
                <?php } ?>
            </dl>
        </div>
        
        <div class="left_cus">
           <p class="tel">055.366.2418</p>
           <p class="email"><span>E-mail</span>ceo@ oktjs.com</p>
           <p class="fax t_margin5"><span>FAX</span>055.366.2418</p>
        </div>
    </div>
    
