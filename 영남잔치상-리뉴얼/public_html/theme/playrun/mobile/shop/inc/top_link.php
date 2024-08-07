<link href="http://itforone.com/~janchisang2/theme/playrun/skin/submenu/basic/style.css?ver=171222" rel="stylesheet">
<style>
	#new_sub_cont{
		position: relative;
	}
	#lnb{
		position: absolute;
		top: 40px;
		left: 20px;
	}
	#lnb dl{
		display: flex;
	}
	.sub_contents{
		padding-top: 100px;
	}
	#lnb dd a{
		border: none;
		background: transparent;
		font-family: 'YiSunShinDotumM',sans-serif;
		color: #222;
		font-size: 1.2em;
		font-weight: 600;
		padding: 5px 11px;
/*		border-right: 1px solid #ccc;*/
		white-space: nowrap;
		position: relative;
		display: block;
		text-align: center;
	}
	#lnb dd a::after{
		content: '';
		display: inline-block;
		position: absolute;
		top: 50%;
		right: 0;
		transform: translateY(-50%);
		width: 1px;
		height: 15px;
		background: #ccc;
	}
	#lnb dd:first-child a{
		position: relative;
		padding-left: 20px;
	}
	#lnb dd:first-child a::before{
		content: '▶';
		display: inline-block;
		position:relative;
		top: 0px;
		left: 0;
		font-family: 'YiSunShinDotumM',sans-serif;
		color: #983f3f;
		font-size: 1em;
		font-weight: 900;
		margin-right: 3px;
	}
	#lnb dd a:hover, #lnb dd a.on{
/*		border: none;*/
		background: transparent;
		color: #983f3f;
		font-weight: 600;
	}
	#lnb dd:last-child a{
		border-right: none;
	}
	
	
	@media(max-width:1199px){
		#lnb.flex_wrap dl{
			display: flex;
			flex-wrap: wrap;
		}
		#lnb.flex_wrap dd{
			min-width: 25%;
		}
		#lnb.flex_wrap dd a{
			font-size: 1em;
			padding: 2.5px 5.5px;
		}
		#lnb.flex_wrap dd:first-child a::before{
			font-size: 0.7em;
		}
	}
	@media(max-width:768px){
		#lnb{
			overflow-x: scroll;
			width: 90%;
			left: 50%;
			transform: translateX(-50%);
		}
	}
</style>

<?php if($co_id=="jesa_info") {?>
<section>
    <!--서브 왼쪽메뉴 및 고객센터-->
    <div id="lnb">
        <dl>

            <dd><a href="#jesa_info1" class="on">제사의 의미</a></dd>
            <dd><a href="#jesa_info2">제사의 종류</a></dd>
            <dd><a href="#jesa_info3">제사상 진설법</a></dd>
            <dd><a href="#jesa_info4">제사 절차</a></dd>
            <dd><a href="#jesa_info5">제사 지내는 순서</a></dd>
        </dl>
    </div>
    <!--#left-->

</section>

<? } else if($co_id=="pb_info") { ?>

<section>
    <!--서브 왼쪽메뉴 및 고객센터-->
    <div id="lnb">
        <dl>
            <dd><a href="#pb_info1" class="on">폐백이란?</a></dd>
            <dd><a href="#pb_info2">폐백의 종류</a></dd>
            <dd><a href="#pb_info3">폐백 포장법</a></dd>
            <dd><a href="#pb_info4">폐백의 절차</a></dd>
        </dl>
    </div>
    <!--#left-->

</section>

<? } else if($co_id=="ibaz") { ?>
<section>
    <!--서브 왼쪽메뉴 및 고객센터-->
    <div id="lnb">
        <dl>
            <dd><a href="#ibaz1" class="on">이바지음식</a></dd>
            <dd><a href="#ibaz2">이바지음식의 종류</a></dd>
        </dl>
    </div>
    <!--#left-->

</section>

<? } else if($co_id=="gosa_info") { ?>
<section>
    <!--서브 왼쪽메뉴 및 고객센터-->
    <div id="lnb" class="flex_wrap">
        <dl>
            <dd><a href="#gosa_info1" class="on">고사의 의미</a></dd>
            <dd><a href="#gosa_info2">고사의 종류</a></dd>
            <dd><a href="#gosa_info3">고사의 준비</a></dd>
            <dd><a href="#gosa_info4">고사 축문쓰기</a></dd>
            <dd><a href="#gosa_info5">고사상 진설법</a></dd>
            <dd><a href="#gosa_info6">고사 진행절차</a></dd>
            <dd><a href="#gosa_info7">고사 약식 시나리오</a></dd>
        </dl>
    </div>
    <!--#left-->

</section>

<? } else { ?>




<?}?>