<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.sub.php');
?>
<style>
    #intro{width: 100%; height: 100vh; background: #333; position: relative;
        display: flex; align-items: center; justify-content: space-between;background: url("img/intro/intro_bg.png") center center no-repeat; background-size: cover}
	#intro .txt {position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 92%; max-width: 1300px; padding:0 20px; border-left: 1px solid #ffffff80; color: #fff }
	#intro .txt h3 {font-family: 'SUIT Variable', sans-serif;font-size: 2.5em; margin-bottom: 15px}
	#intro .txt p {font-family: 'SUIT Variable', sans-serif;font-size: 1.4em; padding-bottom: 50vh; padding-top: 20px}
	#intro .txt p a {opacity: 0.5; color: #fff; padding-right: 15px; font-weight: 800 }
	#intro .txt p a:hover {opacity: 1;text-decoration: underline}
    @media (max-width:1400px) {

    }
    @media (max-width:1100px) {
    }
    @media (max-width:900px){
			#intro .txt h3 {font-size: 2.2em;}
    }
</style>
<div id="intro">
	<div class="txt">
	<h3>DOWOON</h3>
	<h3><strong>A space where you can fully focus on your taste</strong></h3>
		 <p><a href="<?php G5_PATH ?>index2.php">KOREAN</a>
   <a href="<?php G5_PATH ?>index2.php">ENGLISH</a></p>
	</div>
  
</div>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>
