<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>

<div id="idx_wrapper">
    <!--pc메인슬라이더 시작-->
    <div id="visual">
        <div id="slogan">
            <div class="img01"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_txt01.png" alt="" /></div>
            <div class="img02"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_txt02.png" alt="" /></div>
        </div><!--//slogan -->
        <div id="mslogan">
            <div class="img01"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_txt01.png" alt="" /></div>
            <div class="img02"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_txt02.png" alt="" /></div>
        </div><!--//mslogan -->
        <ul class="sliderbx">
        	<li></li>
        	<li></li>
            <li></li>
        </ul><!--.sliderbx-->
    </div><!-- //visual -->
</div><!--  #idx_wrapper -->

<div id="middle">
	<div class="title">
    	<h2>GreenySystem <strong>Business Intoduce</strong></h2>
        <p>GreenySystem Business Intoduce</p>
    </div>
    
    <ul>
    	<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business04_eng">
        	<div class="cicon"><img src="<?php echo G5_THEME_IMG_URL ?>/main/cont_icon04.png" alt="" /></div>
        	<dt>ITAD(IT ASSET DISPOSITION) Industry</dt>
            <dd>Waste IT equipment with terminated depreciation or preservation time</dd>
			<p>IDC, Personal IT equipment, Networking/Telecom, Parts, Monitor/Display, Cable and code, Media, Office equipment/Partner</p>
			<a class="m_more">+</a>
        </a></li>
    	<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business01_1_eng">
        	<div class="cicon"><img src="<?php echo G5_THEME_IMG_URL ?>/main/cont_icon01.png" alt="" /></div>
        	<dt>Business for Re-using Useless IT Equipment</dt>
            <dd>Storage service for coping actively with the sales institutions' disposal IT equipment security issue and lack of the storage space</dd>
			<p>Asset is processed based on the company work process when sales are carried out after saving assets of the customer who requested storage service safely</p>
			<a class="m_more">+</a>
        </a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business02_1_eng">
        	<div class="cicon"><img src="<?php echo G5_THEME_IMG_URL ?>/main/cont_icon02.png" alt="" /></div>
        	<dt>Hard Disk(HDD,SSD)<br>Processing</dt>
            <dd>Complementing the limitations of general data processing and physical destruction</dd>
			<p>Leasing client PCs, servers, and storage / Returning / Transfer / Solution for information leakage during disposal</p>
			<a class="m_more">+</a>
        </a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business03_eng">
        	<div class="cicon"><img src="<?php echo G5_THEME_IMG_URL ?>/main/cont_icon03.png" alt="" /></div>
        	<dt>E-scrap Crushing<br>Distribution</dt>
            <dd>E-scrap Crushing Distribution</dd>
			<p>Board and parts such as semiconductor, PC, communication equipment, network equipment, repeater and others </p>
			<a class="m_more">+</a>
        </a></li>
    </ul>
    
</div><!--#middle-->

<div id="middle2">
	<ul class="cf">
    	<div class="bbs col-xsm12 col-sm-6">
			<h1>NOTICE <span>News &amp; Notice</span></h1>
        	<?php echo latest("theme/basic", "notice", 8, 90); ?>
        </div>
    	<div class="company col-xsm12 col-sm-6">
			<h1>PROMOTE VIDEO <span>GreenySystem Video</span></h1>
<div style="position:relative;height:0;padding-bottom:56.21%"><iframe src="https://www.youtube.com/embed/CbIMIrBvir4?ecver=2" style="position:absolute;width:100%;height:100%;left:0" width="641" height="360" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
        </div>
    </ul>
</div>

<div id="middle3">
	<div id="middle3_1">
		<div class="sitemap">
			<h1>Company</h1>
			<ul>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet01_eng">CEO Greeting</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet02_eng">Organization</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet03_eng">Work Process</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=ceri_eng">Certificate / Patent</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet04_eng">Facility status</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet05_eng">Directions</a></li>
			</ul>
		</div>
		<div class="sitemap">
			<h1>Business</h1>
			<ul>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business04_eng">ITAD Industry</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business01_1_eng">Business for Re-using Useless IT Equipment</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business02_1_eng">Hard Disk(HDD,SSD,M-SATA) Processing</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business03_eng">E-scrap Crushing Distribution</a></li>
			</ul>
		</div>
		<div class="sitemap">
			<h1>Free IT Asset Evaluation</h1>
			<ul>
				<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=freeit_eng">FREE IT Asset evaluation</a></li>
			</ul>
		</div> 
		<div class="sitemap">
			<h1>Customers</h1>
			<ul>
				<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice_eng">Notice</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=refrence_eng">Reference</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=qa_eng">Q&amp;A</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=contactus_eng">Contact Us</a></li>
			</ul>
		</div>
	</div>	
</div>	



<?php
include_once(G5_PATH.'/tail.php');
?>