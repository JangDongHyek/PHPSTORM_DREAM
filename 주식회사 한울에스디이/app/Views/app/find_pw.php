<!--1.3 아이디/비밀번호 찾기-->
<div class="wrap_bg">
    <div class="mb_wrap">
        <div class="box-white">
            <h2>아이디/비밀번호 찾기</h2>
            <form autocomplete="off">
                <div class="find_form">
                    <div class="form">
                        <div role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#find_id" aria-controls="find_id" role="tab" data-toggle="tab" aria-expanded="true">ID찾기</a></li>
                                <li role="presentation" class=""><a href="#find_pw" aria-controls="find_pw" role="tab" data-toggle="tab" aria-expanded="false">비밀번호 찾기</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="find_id">
                                    <!--아이디찾기-->
                                    <input type="text" name="cnName" placeholder="회사명">
                                    <input type="text" name="brno1" placeholder="사업자등록번호">
                                    <input type="radio" name="level" id="lv4" value="4" checked="">
                                    <label for="lv4">시행사</label>&nbsp;&nbsp;
                                    <input type="radio" name="level" id="lv3" value="3">
                                    <label for="lv3">시공사</label>&nbsp;&nbsp;
                                    <div class="btn-wrap">
                                        <button type="button" id="btnFindId" class="btn btn-large btn-darkblue">조회하기</button>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="find_pw">
                                    <!--비밀번호찾기-->
                                    <input type="text" name="memberId" placeholder="아이디">
                                    <input type="text" name="brno2" placeholder="사업자등록번호">
                                    <div class="btn-wrap">
                                        <button type="button" id="btnFindPw" class="btn btn-large btn-darkblue">비밀번호 재설정</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>