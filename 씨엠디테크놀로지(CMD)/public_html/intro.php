<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.sub.php');
?>
<style>
    #intro{width: 100%; height: 100vh; 
        display: flex; align-items: center; justify-content: space-between;}
    #intro li{transition: all 1s; width: calc(100% / 2); height: 100%; padding:0px; overflow: hidden;}
    #intro li .bg{width: 100%; height: 100%; object-fit: cover; transition: all 1s; filter:grayscale(100%);}
    #intro .inner{display: block; width: 100%; height: 100%; color: #fff; position: relative; padding: 4%;
        background-position: 50%; background-repeat: no-repeat; background-size:cover;
        position: absolute; left: 0; top: 0;}

    #intro .inner p{}

    #intro .inner .textWrap{position: absolute; top:50%; transform: translateY(-50%); left: 10%; right: 10%;}
    #intro .inner .logo img{height: 50px;}
    #intro .inner .text{font-size:3em; font-weight: 700; color: #fff; font-family: 'GmarketSans'; line-height: 1.2em; margin: 15px 0 30px 0;}
    #intro .inner .btn{border-radius: 0; font-size: 1.1em; padding: 10px 20px;}

    #intro .left .inner{background: rgba(0,0,0,0.6);}
    #intro .right .inner{background: rgba(0,0,0,0.6); text-align: right;}
    #intro .inner .btn{background-color:transparent; color: #fff; border: 1px solid rgba(255,255,255,0.8);  }

    #intro li:hover .bg{transition: all 0.5s; width: 120%; height: 120%; margin: -10%; filter:grayscale(0%);}
    #intro li:hover .inner{transition: all 0.5s;}
    #intro li:hover .inner p{opacity: 1;}
    #intro li .btn:hover{background-color:#1c3d88; color: #fff; border: 1px solid #1c3d88; }

    @media (max-width:1200px) {
        #intro{display: block; font-size: 0.8em;}
        #intro li{width:100%; height: calc(100vh / 2);}

    }
    
    @media (max-width:750px){
        #intro .inner .text{font-size: 2em;}

    }
</style>

<ul id="intro">
    <li class="left wow fadeInDownBig animated" data-wow-delay="0s" data-wow-duration="1.5s">
        <img src="<?php echo G5_THEME_IMG_URL ?>/intro/bg1.jpg" class="bg">
         <a class="inner wow fadeInUpBig animated" data-wow-delay="1s" data-wow-duration="1.5s" href="<?php echo G5_URL ?>/index2.php">
            <div class="textWrap">
                <p class="logo"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.svg"></p>
                <p class="text">CMD TECHNOLOGY<br>
                    ROBOT AUTOMATION</p>
                <p class="btn">사이트 바로가기 →</p>
            </div>
        </a>
    </li>

    <li class="right wow fadeInDownBig animated" data-wow-delay="0.5s" data-wow-duration="1.5s">
        <img src="<?php echo G5_THEME_IMG_URL ?>/intro/bg2.jpg" class="bg">
        <a class="inner wow fadeInUpBig animated" data-wow-delay="1.5s" data-wow-duration="1.5s" href="<?php echo G5_URL ?>/fsw/">
            <div class="textWrap">
                <p class="logo"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_fsw.svg"></p>
                <p class="text">CMD ROBOTICS<br>
                    FSW 마찰교반용접</p>
                <p class="btn">사이트 바로가기 →</p>
            </div>
        </a>
    </li>
</ul>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>
