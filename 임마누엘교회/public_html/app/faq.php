<?php
$pid = "faq";
include_once("./app_head.php");
?>
    <div id="app">
        <div id="faq">
            <div class="slogan">
                <button type="button" class="btn btn_color btn-large" onclick="location.href='./faq_form'">문답 등록</button>
            </div>
            <div class="box_radius box_white">
                <div class="list">
                    <ul>
                        <li>
                            <details>
                                <summary><span class="ask">Q</span> 질문입니다.</summary>
                                <div>
                                    <span class="answer">A</span>
                                    답변입니다.
                                    <br>
                                    <button type="button" class="btn btn_mini btn_line">수정</button>
                                    <button type="button" class="btn btn_mini btn_colorline">삭제</button>
                                </div>
                            </details>
                        </li>
                        <li>
                            <details>
                                <summary><span class="ask">Q</span> 질문입니다.</summary>
                                <div>
                                    <span class="answer">A</span>
                                    답변입니다.
                                    <br>
                                    <button type="button" class="btn btn_mini btn_line">수정</button>
                                    <button type="button" class="btn btn_mini btn_colorline">삭제</button>
                                </div>
                            </details>
                        </li>
                        <li>
                            <details>
                                <summary><span class="ask">Q</span> 질문입니다.</summary>
                                <div>
                                    <span class="answer">A</span>
                                    답변입니다.
                                    <br>
                                    <button type="button" class="btn btn_mini btn_line">수정</button>
                                    <button type="button" class="btn btn_mini btn_colorline">삭제</button>
                                </div>
                            </details>
                        </li>
                        <li>
                            <details>
                                <summary><span class="ask">Q</span> 질문입니다.</summary>
                                <div>
                                    <span class="answer">A</span>
                                    답변입니다.
                                    <br>
                                    <button type="button" class="btn btn_mini btn_line">수정</button>
                                    <button type="button" class="btn btn_mini btn_colorline">삭제</button>
                                </div>
                            </details>
                        </li>
                    </ul>
                </div>
                <div class="b-pagination-outer">
                    <ul id="border-pagination">


                        <li><a href="javascript:void(0)" class="active">1</a></li>
                        <li><a href="?page=2&amp;" class="">2</a></li>
                        <li><a href="?page=3&amp;" class="">3</a></li>
                        <li><a href="?page=4&amp;" class="">4</a></li>


                        <li><a href="?page=4&amp;">»</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>


<?php
include_once("./app_tail.php");
?>