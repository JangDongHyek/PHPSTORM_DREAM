<?php
include_once('./_common.php');

$g5['title'] = '주간 식단표';
include_once('./_head.php');
?>


<style>
.box{ padding:0 5px 20px 5px;letter-spacing:0; margin-bottom:30px; border-bottom:1px solid #ddd;}
#box_wrap .box:last-child{ border-bottom:0; margin-bottom:0;}
.box .date{ font-size:1.3em;font-weight:bold; color:#222; margin-bottom:10px;}
.box .box_line{ margin-bottom:20px;}
.box .box_in{ padding:15px 20px 18px 20px; border:1px solid #e1e1e1; border-radius:10px; margin-bottom:5px;}
.box .box_in:nth-child(even){ background:#f7f7f7;}
.box .ftime{background:#118ccf; color:#fff; font-size:1.15em; font-weight:bold; padding:10px 20px; line-height:12px; border-radius:30px; margin-bottom:5px;}
.box .ftime span{ font-size:12px; font-weight:normal; display:inline-block; margin-left:5px; opacity:0.8;}
.box .fs{ font-size:1.2em; font-weight:500; color:#333; margin-bottom:10px;}
.box .fs span{ display:inline-block; position:relative;}
.box .fs span:after{ display:block; content:""; width:100%; height:5px; background:rgba(17,140,207,0.4); position:absolute; bottom:2px; left:0;}
.box .fc{ overflow-x:scroll; overflow-y:hidden; padding-bottom:5px;}
.box .fc_no{ text-align:center; color:#999; padding:10px 0;}
.box .fc ul{ max-width:100%; display:flex;}
.box .fc ul:after{ display:block; content:""; clear:both;}
.box .fc li{ float:left; padding-right:20px; margin-left:20px; border-right:1px dotted #e1e1e1;word-break: keep-all;word-wrap:break-word;}
.box .fc li:first-child{ margin-left:0}
.box .fc li:last-child{ border-right:0; padding-right:0;}

</style>
<div id="box_wrap">

	<!--하루 식단 시작//-->
    <div class="box">
        <div class="date">2021-02-15(월)</div><!--날짜표시-->

        <div class="ftime">Breakfast <span>2021-02-15(월)</span></div><!--아침/점심/저녁 , 날짜표시-->            
        <div class="box_line">
        
            <div class="box_in">
                <div class="fs"><span>Korean or Western</span></div><!--음식종류-->  
                <div class="fc"><!--식단-->  
                	<ul>
                    	<li>돌솥비빔밥<br />
                        Vegetable Bibimbap(1)<br />
                        青蔬拌饭</li>
                    	<li>옛날소시지전<br />
                        Pan Fried Egg Coated Sausages(1,3,6,7,15)<br />
                        香肠饼</li>
                    	<li>근대나물<br />
                        Seasoned Blanched Chard(6)<br />
                        凉拌菜</li>
                    	<li>포기김치<br />
                        Kimchi<br />
                        泡菜</li>
                    	<li>미역국<br />
                        Seaweed "Miyeok-Guk" Soup<br />
                        海带汤</li>
                    	<li>셀프샌드위치바<br />
                        Self-sandwich bar<br />
                        夹心面包</li>
                    	<li>요거트<br />
                        Yogurt (1)<br />
                        优格吧</li>
                    	<li>우유<br />
                        milk(2)<br />
                        牛乳</li>
                    	<li>시리얼<br />
                        Cereal(7)<br />
                        麦片</li>
                    </ul>
                </div><!--.fc-->
            </div><!--.box_in-->
        </div><!--.box_line-->

        <div class="ftime">Lunch <span>2021-02-15(월)</div><!--아침/점심/저녁 , 날짜표시-->              
        <div class="box_line">
        
            <div class="box_in">
                <div class="fs"><span>Korean</span></div><!--음식종류-->  
                <div class="fc_no"><!--등록된 식단이 없을경우-->  
                	등록된 식단이 없습니다.
                </div><!--.fc-->
            </div><!--.box_in-->
            
            <div class="box_in">
                <div class="fs"><span>Noodle</span></div><!--음식종류-->  
                <div class="fc"><!--식단-->  
                	<ul>
                    	<li>돌솥비빔밥<br />
                        Vegetable Bibimbap(1)<br />
                        青蔬拌饭</li>
                    	<li>옛날소시지전<br />
                        Pan Fried Egg Coated Sausages(1,3,6,7,15)<br />
                        香肠饼</li>
                    	<li>근대나물<br />
                        Seasoned Blanched Chard(6)<br />
                        凉拌菜</li>
                    	<li>포기김치<br />
                        Kimchi<br />
                        泡菜</li>
                    	<li>미역국<br />
                        Seaweed "Miyeok-Guk" Soup<br />
                        海带汤</li>
                    	<li>셀프샌드위치바<br />
                        Self-sandwich bar<br />
                        夹心面包</li>
                    	<li>요거트<br />
                        Yogurt (1)<br />
                        优格吧</li>
                    	<li>우유<br />
                        milk(2)<br />
                        牛乳</li>
                    	<li>시리얼<br />
                        Cereal(7)<br />
                        麦片</li>
                    </ul>
                
                </div><!--.fc-->
            </div><!--.box_in-->
        
            <div class="box_in">
                <div class="fs"><span>Western</span></div><!--음식종류-->  
                <div class="fc"><!--식단-->  
                	<ul>
                    	<li>돌솥비빔밥<br />
                        Vegetable Bibimbap(1)<br />
                        青蔬拌饭</li>
                    	<li>옛날소시지전<br />
                        Pan Fried Egg Coated Sausages(1,3,6,7,15)<br />
                        香肠饼</li>
                    	<li>근대나물<br />
                        Seasoned Blanched Chard(6)<br />
                        凉拌菜</li>
                    	<li>포기김치<br />
                        Kimchi<br />
                        泡菜</li>
                    	<li>미역국<br />
                        Seaweed "Miyeok-Guk" Soup<br />
                        海带汤</li>
                    	<li>셀프샌드위치바<br />
                        Self-sandwich bar<br />
                        夹心面包</li>
                    	<li>요거트<br />
                        Yogurt (1)<br />
                        优格吧</li>
                    	<li>우유<br />
                        milk(2)<br />
                        牛乳</li>
                    	<li>시리얼<br />
                        Cereal(7)<br />
                        麦片</li>
                    </ul>
                
                </div><!--.fc-->
            </div><!--.box_in-->
        
            <div class="box_in">
                <div class="fs"><span>Vegeterian</span></div><!--음식종류-->  
                <div class="fc"><!--식단-->  
                	<ul>
                    	<li>돌솥비빔밥<br />
                        Vegetable Bibimbap(1)<br />
                        青蔬拌饭</li>
                    	<li>옛날소시지전<br />
                        Pan Fried Egg Coated Sausages(1,3,6,7,15)<br />
                        香肠饼</li>
                    	<li>근대나물<br />
                        Seasoned Blanched Chard(6)<br />
                        凉拌菜</li>
                    	<li>포기김치<br />
                        Kimchi<br />
                        泡菜</li>
                    	<li>미역국<br />
                        Seaweed "Miyeok-Guk" Soup<br />
                        海带汤</li>
                    	<li>셀프샌드위치바<br />
                        Self-sandwich bar<br />
                        夹心面包</li>
                    	<li>요거트<br />
                        Yogurt (1)<br />
                        优格吧</li>
                    	<li>우유<br />
                        milk(2)<br />
                        牛乳</li>
                    	<li>시리얼<br />
                        Cereal(7)<br />
                        麦片</li>
                    </ul>
                
                </div><!--.fc-->
            </div><!--.box_in-->
        </div><!--.box_line-->

        <div class="ftime">Dinner <span>2021-02-15(월)</div><!--아침/점심/저녁 , 날짜표시-->                 
        <div class="box_line">
        
            <div class="box_in">
                <div class="fs"><span>Korean or Western</span></div><!--음식종류-->  
                <div class="fc"><!--식단-->  
                	<ul>
                    	<li>돌솥비빔밥<br />
                        Vegetable Bibimbap(1)<br />
                        青蔬拌饭</li>
                    	<li>옛날소시지전<br />
                        Pan Fried Egg Coated Sausages(1,3,6,7,15)<br />
                        香肠饼</li>
                    	<li>근대나물<br />
                        Seasoned Blanched Chard(6)<br />
                        凉拌菜</li>
                    	<li>포기김치<br />
                        Kimchi<br />
                        泡菜</li>
                    	<li>미역국<br />
                        Seaweed "Miyeok-Guk" Soup<br />
                        海带汤</li>
                    	<li>셀프샌드위치바<br />
                        Self-sandwich bar<br />
                        夹心面包</li>
                    	<li>요거트<br />
                        Yogurt (1)<br />
                        优格吧</li>
                    	<li>우유<br />
                        milk(2)<br />
                        牛乳</li>
                    	<li>시리얼<br />
                        Cereal(7)<br />
                        麦片</li>
                    </ul>
                
                </div><!--.fc-->
            </div><!--.box_in-->
        </div><!--.box_line-->
    </div><!--.box-->
	<!--//하루 식단 끝-->
  
  
</div><!--#box_wrap-->

<?php
include_once('./_tail.php');
?>