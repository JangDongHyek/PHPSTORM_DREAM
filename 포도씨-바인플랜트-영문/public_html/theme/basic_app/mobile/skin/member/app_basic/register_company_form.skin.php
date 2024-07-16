 <?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css?v='.G5_CSS_VER.'">', 0);

//$readonly = '';
//if($w == 'u' || !empty($sns)) { // 수정 || sns로그인
//    $readonly = 'readonly';
//}

$mb_id = $member['mb_id'];
//if($w == '' && $sns == 'kakao') { $mb_id = $id.'@k'; }
//else if($w == '' && $sns == 'naver') { $mb_id = substr($id, 0, 10).'@n'; }

$mb_name = $member['mb_name'];
if(!empty($sns) && !empty($name)) { $mb_name = $name; }
$mb_hp = $member['mb_hp'];
if(!empty($sns) && !empty($_GET['mobile'])) { $mb_hp = $_GET['mobile']; }
$mb_email = $member['mb_email'];
if(!empty($sns) && !empty($email)) { $mb_email = $email; }
?>
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
 <style>
#ft_copy{ display:none;}
@media screen and (min-width:767px) {
	#ft_copy{ display:block;}
}
#mb_photo {position: absolute; left: -999px; top: -999px;}
</style>


<div class="mbskin">

    <form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w;?>">
    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
	<input type="hidden" name="mb_level" id="mb_level" value="<? if($w == '') { echo 3; } else { echo $member['mb_level']; } ?>">
	<input type="hidden" name="mb_group" value="<?=$mb_group?>">
    <input type="hidden" name="mb_category" value="기업">
    <input type="hidden" name="company" value="<?=$company?>">
    <input type="hidden" name="mb_no" value="<?=$member['mb_no']?>">
    <input type="hidden" name="sns" value="<?=$sns?>">
    <input type="hidden" name="sns_id" value="<?=$id?>">

	<article class="box-article">
		<h1 class="logo">
			<img src="<?php echo G5_THEME_IMG_URL ?>/app/logo2.svg" alt="PODOSEA">
		</h1>
		<div id="area_join">
			<div id="join_info">
			<h2><?php if($w == ""){ ?>Sign Up as Podosea Member<? }else { ?>Check and edit member information<?php } ?> <p></h2>
				<div class="box-body">
					<dl class="row">
						<dt>ID</dt>
						<dd>
							<div class="input">
								<input type="text" name="mb_id" value="<?=$mb_id?>" id="reg_mb_id" class="regist-input" minlength="3" maxlength="20" <?=$readonly?> placeholder="Enter ID">
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>

                    <?php if(empty($sns)) { // sns로그인은 비밀번호 필요없음?>
                    <dl class="row">
                        <dt>Password</dt>
                        <dd>
                            <div class="input">
                                <input type="password" name="mb_password" id="reg_mb_password" class="regist-input" minlength="4" maxlength="20" placeholder="Enter Password">
                            </div>
                        </dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>

                    <dl class="row password">
                        <dt>Verify Password</dt>
                        <dd>
                            <div class="input">
                                <input type="password" name="mb_password_re" id="reg_mb_password_re" class="regist-input" minlength="4" maxlength="20" placeholder="Please Enter It Again">
                            </div>
                        </dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>
                    <?php } ?>

					<!--<dl class="row">
						<dt>이름</dt>
						<dd>
							<div class="input">
                                <input type="text" name="mb_name" value="<?/*=$mb_name*/?>" id="reg_mb_name" class="regist-input f_empty" <?/*=$readonly*/?> placeholder="이름을 입력해 주세요.">
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>-->

					<dl class="row hp">
						<dt>E-mail</dt>
						<dd>
							<div class="input <?php if($w == "" && empty($_GET['sns'])) { ?>v1<?php } ?>">
                                <input <?=$w=='u' ? 'style="width: 100% !important;"' : ''; ?> type="text" name="mb_email" id="reg_mb_email" class="regist-input f_empty" minlength="3" maxlength="50" placeholder="Enter Email" value="<?=$mb_email?>">
								<?php if($w == '' && empty($_GET['sns'])) { ?><button type="button" class="btn_hp" onclick="email_certification();">Certify</button><?php } ?>
							</div>
						</dd>
						<dd class="error col-xs-12 email"></dd>
					</dl>

                    <!-- 국가로 변경 -->
                    <dl class="row">
                        <dt>Country</dt>
                        <dd>
                            <div class="input">
                                <select id="mb_company_si" name="mb_company_si">
                                    <option value="">Please select a country</option>
                                    <?php foreach ($arr_country_code as $code=>$value) { ?>
                                    <option value="<?=$value[1]?>" <?php echo $member['mb_company_si'] == $value[1] ? 'selected' : '';?>><?=$value[1]?></option>
                                    <? } ?>
                                </select>
                            </div>
                        </dd>
                    </dl>

					<dl class="row">
						<dt>Phone number</dt>
						<dd>
							<div class="input">
								<input type="tel" name="mb_hp" value="<?=$mb_hp?>" id="reg_mb_hp" class="regist-input" placeholder="Enter Mobile Phone Number">
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>

					<dl class="row">
						<dt>Name of company</dt>
						<dd>
							<div class="input">
								<input type="tel" name="mb_company_name" value="<?php echo $member['mb_company_name'] ?>" id="reg_mb_company_name" class="regist-input" placeholder="Enter Name of Company">
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>

					<dl class="row">
						<dt>Company Address</dt>
						<dd>
							<div class="input">
								<input type="text" name="mb_addr1" id="reg_mb_addr1" class="regist-input" minlength="3" maxlength="50" placeholder="Address" value="<?php echo $member['mb_addr1']; ?>">
							    <!--<input type="hidden" name="mb_zip" id="reg_mb_zip" value="<?/*=$member['mb_zip']*/?>">-->
                                <input type="hidden" name="mb_addr1_lat" id="reg_mb_addr_lat" value="<?=$member['mb_addr1_lat']?>">
                                <input type="hidden" name="mb_addr1_lng" id="reg_mb_addr_lng" value="<?=$member['mb_addr1_lng']?>">
							</div>
							<div class="input v2">
							<input type="text" name="mb_addr2" id="reg_mb_addr2" class="regist-input" minlength="1" maxlength="50" placeholder="Detailed Address" value="<?php echo $member['mb_addr2']; ?>">
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>

					<dl class="row e_add v1">
						<dt>ZIP Code</dt> <!--우편번호-->
						<dd>
							<div class="input">
							<input type="text" name="mb_zip" id="mb_zip" class="regist-input" minlength="1" maxlength="50" placeholder="" value="<?php echo $member['mb_zip']; ?>">
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>

					<dl class="row e_add v2">
						<dt>Town/City</dt> <!--도시-->
						<dd>
							<div class="input">
							<input type="text" name="mb_addr3" id="reg_mb_addr3" class="regist-input" minlength="1" maxlength="50" placeholder="" value="<?php echo $member['mb_addr3']; ?>">
							</div>
						</dd>
						<dd class="error col-xs-12"></dd>
					</dl>
				</div>

			</div><!--//join_info-->


		</div>

		<? if ($w == "") { ?>
		<div id="area_join">
        <div id="join_agr">
        <h2>Terms of Service Agreement</h2>
			<div class="cek_all">
				 <label class="selector">
					<input type="checkbox" id="all_chk" name="all_chk">
					<span><i></i>I agree.</span>
				</label>
			</div>
            <div class="box-body">
				<dl class="row agree-row">
                    <dd class="chk_ico" data-for="reg_req3">
                        <input type="checkbox" name="reg_req[]" id="reg_req3" value="0" onclick="ag_check(this)">
                        <label for="reg_req3"><span></span><em>I am 14 Years and Older (Required)</em></label>
                        <!-- <i></i> 이용약관 동의 (필수) -->
                    </dd>
                </dl>

                <dl class="row agree-row">
                    <dd class="col-xs-8 chk_ico" data-for="reg_req1">
                        <input type="checkbox" name="reg_req[]" id="reg_req1" value="0" onclick="ag_check(this)">
                        <label for="reg_req1"><span></span><em>I agree to the terms of Service (Required)</em></label>
                      	<!-- <i></i> 이용약관 동의 (필수) -->
                    </dd>
                    <dd class="col-xs-4 text-right"><input type="button" value="View Contant" class="btn btn-agr"></dd>
                    <!--dd class="col-xs-12 agr_textarea"><textarea readonly>< ?php echo get_text($config['cf_stipulation']) ?></textarea></dd-->
                    <dd class="col-xs-12 agr_textarea"><div class="inr">
<div class="policy_view">
	<h2>Terms of Service</h2>
	<h3>Article 1 (Purpose)</h3>
	<p>
		The purpose of this Terms of Service is to prescribe the conditions of use, provisions, and any other items between VinePlant Inc. (hereinafter referred to as ‘Company’) and its members regarding the use of Internet related services of the online website (hereinafter referred to as ‘Website’) managed by the Company.
	</p>

	<h3>Article 2 (Definition of Terms)</h3>
	<p>The definitions of terms used in this Terms of Service are as follows:</p>
	<ul>
		<li>1. ‘Website’ refers to the virtual business domain or the website ((<a href="http://podosea.com">http://podosea.com</a>) operated by the ‘Company’ to provide service to the ‘Member’ using computers and other IT equipment; This service includes mobile application for smartphones and other portable devices.
		</li>
		<li>2. ‘Service’ refers to the features including search for company, making business requests, recruitment, Q&amp;A for specialized information, year-round business community and all other services provided by ‘Company’ through the operation of the Website.
		</li>
		<li>3. ‘Member’ refers to the ‘Corporate Member’ who has agreed to this Terms of Service to enter into an agreement with the ‘Company’.
		</li>
		<li>4. ‘Corporate Member’ refers to registered corporation and personal business owner that have registered company information and can use services provided by the Website including make business requests, register job postings, etc. ‘Corporate Member’ can be distinguished between Premium and basic membership. Premium members have priority for top search results, business request matching, upgrade for Corporate Homepage within the Website, and other benefits.
		</li>
		<li>5. ‘Non-Member’ refers to users using the services provided by ‘Company’ who are not signed up as a ‘Member’.
		</li>
		<li>6. ‘ID’ refers to the combination of characters and numbers chosen by the ‘Member’ upon signing up for the identification and use of service by the Member.</li>
		<li>7. ‘Password’ refers to the combination of characters and numbers chosen by the ‘Member’ to confirm that the person who intends to use the services of ‘Company’ is whom the ID has been granted to, and thereby protecting the rights and interests of the ‘Member’.</li>
		<li>8. ‘Content’ refers to symbols, characters, figures, colors, voice, speech, audio, image, video, or any combination of the aforementioned created and uploaded to the ‘Website’ by the ‘Member’. The ‘Content’ is uploaded to each category (ex: Corporate RFQ, Search for Company, Career, Help Me, Community etc.) or miscellaneous domains of the Website</li>
	</ul>

	<h3>Article 3 (Clarification and Revision of Terms of Service)</h3>
	<ul>
		<li>1. The ‘Company’ shall display the contents of the Terms of Service, place of business, name of representative, business registration number, contact details etc. on the front page or use other means to notify the ‘Member’.</li>
		<li>2. The ‘Company’ may revise the contents of this Terms of Service within the constraints of Acts concerning the regulations, the Framework Act on Telecommunications, the Telecommunications Business Act, Acts concerning the Promotion of Information and Communication Network Utilization, the Personal Information Protection Act, and other Acts of relevance</li>
		<li>3. The ‘Company’, in the event the Terms of Service are revised, shall notify, along with the current Terms of Service, the reason for revision and the effective date thereof 7 days before the effective date, until the day before. However, any revisions greatly affecting the rights and duties of the ‘Member’ shall be notified 30 days before the effective date.</li>
		<li>4. The ‘Member’ reserves the right to refuse the revised Terms of Service. The ‘Member’ may express the refusal of the revised Terms of Service within 15 days of the notice. In the event the ‘Member’ refuses the revised terms, the ‘Company’, the service provider, may set a period of 15 days to terminate the agreement with the ‘Member’ provided that prior notification is given. If the ‘Member’ does not express any refusal, or uses the service after the effective date of the revision pursuant to the preceding paragraph, it will be considered as an act of consent.</li>
	</ul>

	<h3>Article 4 (Interpretation of Terms of Service)</h3>
	<ul>
		<li>1. Any matters not prescribed within these terms shall be pursuant with the Acts concerning regulations, the Framework Act on Telecommunications, the Telecommunications Business Act, Acts concerning the Promotion of Information and Communication Network Utilization, and other Acts of relevance.</li>
		<li>2. In the event the ‘Member’ and the ‘Company’ enter an agreement separate from the Terms of Service, the former shall take precedent.</li>
	</ul>

	<h3>Article 5 (Establishing User Agreement)</h3>
	<ul>
		<li>
		1. The ‘Company’ shall consider the act of clicking the “I agree” or “Confirm” button by any potential users of the services upon reading this Terms of Service and the Privacy Policy as applying for the use of service.
		</li>
		<li>
2. For the application pursuant to paragraph 1, the ‘Company’ may, depending on the type of the ‘Member’, request identification through an expert organization. The ‘Member’ shall provide the legal name, birth date, contact details, etc. needed for identification. In the case of the Corporate Member’, the business name and business registration number shall be provided, and the ‘Company’ may additionally request the Business Registration Certificate for the verification of the business proprietor information. If the business name and/or business registration number registered is found to be false, or the business for the corresponding business registration number is suspended or discontinued, the ‘Corporate Member’ concerned may not claim any rights. Any agencies or organizations without a business registration number may go through a separate process as decided the ‘Company’ for a User Agreement.
		</li>
		<li>3. Following the use application (Sign up) process by the ‘Member’, the User Agreement shall be established when the ‘Company’ notifies the ‘Member’ through online notification or by electronic mail.</li>
	</ul>

	<h3>Article 6 (Acceptance and Limitation of Use Application)</h3>
	<ul>
		<li>
		1. By principle the ‘Company’ shall, regarding customers who have applied for use pursuant to the preceding Article, approve the use of service provided that there is no work or technical hindrance.
		</li>
		<li>
		2. The ‘Company’ shall not approve application for use in cases applicable to the following. If one of the following found to be applicable afterwards, the ‘Company’ shall terminate the User Agreement.
			<ul>
				<li>1) Use of a falsified name or the name of an another person;</li>
				<li>2) Use of a falsified business name and registration number and/or information of another business;</li>
				<li>3) Use of falsified information for the User Agreement</li>
				<li>4) Failure to submit information that the ‘Company’ requires;</li>
				<li>5) The applicant is under 15 years of age;</li>
				<li>6) The rejection of the application is due to causes attributable to user;</li>
				<li>7) Violation of other miscellaneous items during sign up;</li>
				<li>8) Use of service if for fraudulent purposes.</li>
			</ul>
		</li>
		<li>3. The ‘Company’ may withhold approval for cases applicable to the following until the cause of the withholding is resolved:
			<ul>
				<li>1) The ‘Company’ lacks the facility for accommodation;</li>
				<li>2) The ‘Company’ is under technical difficulties;</li>
				<li>3) Other causes attributable to the ‘Company’</li>
			</ul>
		</li>
	</ul>

	<h3>Article 7 (Content of Service)</h3>
	<ul>
		<li>
			1. The ‘Company’ may provide the services as prescribed in Article 2 (2), and the contents are as follows:
			<ul>
				<li>1) Service for registering of business requests and quotation inquiry</li>
				<li>2) Service for searching company information and other related services</li>
				<li>3) Service regarding communication and interaction between users</li>
				<li>4) Service regarding job posting and personnel recruitment information</li>
				<li>5) Service regarding Q&amp;A for specialized field of knowledge</li>
				<li>6) All miscellaneous services provided to the ‘Member’ by the ‘Company’ through additional development or partnership agreements</li>
			</ul>
		</li>
		<li>2. The ‘Company’ may add or make changes to its services. However, the ‘Company’ shall notify the ‘Member’ of the addition and/or change in advance.</li>
	</ul>

	<h3>Article 8 (Service Hours)</h3>
	<ul>
		<li>
			1. The ‘Company’ shall provide service 24 hours per day, all year round except in the case of special circumstances. However, the ‘Company’ may allot a time frame for the use of certain services depending on the type or characteristics of said services, and the time frame shall be notified to the ‘Member’ by the ‘Company’ in advance.
		</li>
		<li>
			2. ‘Company’ may temporarily stop service for the duration of updating and processing data, maintenance for troubleshooting, circuit failure and other circumstances, and, in the case of tasks planned in advance, the reason and time of service interruption shall be notified. Provided, that, the ‘Company’ may notify users after the incident in the event of force majeure.
		</li>
	</ul>

	<h3>Article 9 (Visibility of Member Information and Resume)</h3>
	<ul>
		<li>
			1. In the event any information regarding the ‘Corporate Member’ is made visible through the “Search for Company” feature, Corporate RFQs, or job postings, the company information shall be written accurately in order to assist the judgment of the ‘Member’ viewing the corresponding company. The ‘Corporate Member’ shall guarantee the integrity and legality of all information, quotation and other materials it provides.
		</li>
		<li>
			3. The ‘Corporate Member’ shall hold all responsibility in the event the terms of the preceding paragraph are violated by the ‘Corporate Member’.
		</li>
		<li>
			4. The ‘Company’ may make visible the registered company information and job postings of the ‘Corporate Member’ through a method determined by the ‘Company’.
		</li>
	</ul>

	<h3>Article 10 (Service Through Partnership)</h3>
	<ul>
		<li>
			1. The ‘Company’ may provide access to company information of the ‘Corporate Member’ to various Internet websites and offline media including newspapers and magazines that has a partnership with ‘Company’.
		</li>
		<li>
			2. The ‘Company’ shall notify in advance the possible registration with external websites and media through partnership, and the list of partner websites shall be viewable within the Website at all times. Provided, that, any media list created not directly by the ‘Company’ but by the partner after receiving CSV, DB, XML, or API files from the ‘Company’ may be viewed from a partnership list separate from these terms.
		</li>
		<li>
			3. Any changes to the website due to partnership shall be notified in advance before proceeding.
		</li>
	</ul>

	<h3>Article 11 (Price of Service)</h3>
	<ul>
		<li>
			1. Although the sign up of ‘Member’ and the use of service shall require no payment in principle, certain services may be usable through payment. Services requiring payment shall provide a more effective visibility of relevant information to a ‘Member’ visiting the Website or provide more efficient use of various other services. The applicable services are as follows:
			<ul>
				<li>1) ‘Premium Corporate Membership’ service </li>
				<li>2) Banner advertisement of the ‘Corporate Member’ within the Website</li>
			</ul>
		</li>
		<li class="line">
			2) Banner advertisement of the ‘Corporate Member’ within the Website
2. For services requiring payment, the ‘Company’ shall adhere to the regulations stipulated regarding the cost and method of payment for said services. The price for the ‘Premium Membership’ service, provided to the ‘Corporate Member’, may be inquired through contact with the ‘Company’.<br>
Contact method: service@vineplant.net
		</li>
		<li>
			3. The ‘Company’ may change the cost of services requiring payment pursuant to the type and duration of said service, and may do so without prior notification. Provided, that, any payment or changes prior to the revision shall not be applied retroactively.
		</li>
		<li>
			4. After applying for paid services, if the service is canceled due to the circumstances of the ‘Member’, the ‘Company’ may impose a refund fee within the amount pursuant to the “Guidelines for the Protection of Digital Content Users”.
		</li>
		<li>
			5. Regarding the use of free and certain paid services, the ‘Company’ may not be held responsible for the damages incurred during the transaction between two users except in cases arising from the intentional or gross negligence of the ‘Company’.
		</li>
	</ul>

	<h3>Article 12 (Method of Payment)</h3>
	<ul>
		<li>
			1. The ‘Member’ may choose one of the following methods defined by the ‘Company’ :
			<ul>
				<li>1) Credit card</li>
				<li>2) Mobile phone</li>
				<li>3) Prepaid card</li>
				<li>4) Real time wire transfer</li>
				<li>5) Additional payment method specified by the ‘Company’ including but not limited to: other electronic means of payment, etc. (e.g.: gift certificates, coupons, other affiliate points, etc.)</li>
			</ul>
		</li>
		<li>
			2. Premium services provided to the ‘Corporate Member’ of Premium Membership may be paid through wire transfer only. The ‘Company’ shall issue a tax invoice to the ‘Corporate Member’ for the payment.
		</li>
		<li>
			3. The ‘Company’ shall not be held responsible, with the exception of intentional or gross negligence, for any losses arising from the information and from anything related to the information thereof entered by the ‘Member’ relating to monetary transaction.
		</li>
	</ul>


	<h3>Article 13 (Adjustment of Usage Fee Error)</h3>
	<p>In the case of any errors regarding the usage fee, the ‘Company’ shall, by request of the ‘Member’ or through advanced notice, take the following measures;</p>
	<ul>
		<li>1. The amount overpaid shall be refunded for any overpayment. This shall be conducted using the same method used for said overpayment. Provided, that, advanced notice shall be given in the case the refund cannot be conducted using the same method as the payment.</li>
		<li>2. In the event the overpayment is arising from causes attributable to the ‘Member’, the ‘Member’ shall burden, within a reasonable scope, the costs incurred by the ‘Company’ for refunding the corresponding amount.</li>
		<li>3. In the event the ‘Member’ awaiting refund holds any unpaid fees, the refund shall be deducted from said unpaid amount.
		</li>
		<li>4. In the case of underpayment, the ‘Company’ may request any unpaid fees to the ‘Member’ immediately upon confirmation of fact.
		</li>
	</ul>

	<h3>Article 14 (Notification to Member)</h3>
	<ul>
		<li>1. The ‘Company’ may send the ‘Member’ notifications through the Website page during application for use of service or through the email address submitted during sign up.</li>
		<li>2. The ‘Company’ may, in the case of notifications to unspecified number of ‘Members’, post the notification on the Website for a period of more than 7 days as an alternative to individual notification.</li>
	</ul>

	<h3>Article 15 (Suspension of Service)</h3>
	<ul>
		<li>1. The ‘Company’ may suspend service for the following reasons:
			<ul>
				<li>1) Maintenance of equipment etc. as notified to ‘Member’ by ‘Company’ in advance</li>
				<li>2) The contracted telecommunication service provider ceases providing telecommunication services</li>
				<li>3) Services cannot be provided due to force majeure such as power outage, accident, natural disasters, war, service overload, etc.</li>
			</ul>
		</li>
		<li>2. In the case of suspension of service as prescribed in paragraph 1 of the preceding Article, the Website shall notify the Member as prescribed in article 15. Provided, that, in the event the service is suspended due to the state of the Website being beyond control and advanced notice is not possible, this shall not be applicable.</li>
	</ul>

	<h3>Article 16 (Integrated Membership)</h3>
	<ul>
		<li>1. The ‘Member’ may, by using a single integrated account (ID and password), use the ‘Website’ as prescribed in Article 2 (1) of the Terms of Service, and the services of additional websites provided by the ‘Company’.</li>
		<li>2. The ‘Company’ may, in order to provide an integrated service using a single account, improve or change the Website or service by linking the service information of each website, etc.</li>
		<li>3. In the event the ‘Company’ creates additional websites following the initial application for use of service from the ‘Member’, this Terms of Service shall be applied unless otherwise stated. The ‘Company’ may share information regarding the provision of new services or creation of a new website through posting on the website, or by email notification to the ‘Member’.</li>
	</ul>

	<h3>Article 17 (Provision of Information and Posting of Advertisements)</h3>
	<ul>
		<li>1. The ‘Company’ may provide the ‘Member’ with various information that is deemed necessary for the use of services, or for the purpose of improving or introducing services for the ‘Member’ through means including email, letter mail, SMS, etc.</li>
		<li>2. The ‘Company’ may post relevant information or advertisement to the service page, homepage etc. of the website, and the ‘Member’ may refuse the ‘Company’ emails, SMS, etc. containing advertisements</li>
		<li>3. The ‘Company’ shall not be held responsible for any loss or damages incurred by the ‘Member’ participating in, communicating, or conducting transaction regarding the promotional activities of the advertisers provided through these services.</li>
		<li>4. The "Member" participating in this service shall be considered to have consented to the posting of advertisements visible during the use of service.</li>
	</ul>

	<h3>Article 18 (Content Responsibility and the Company’s Right to Edit)</h3>
	<ul>
		<li>1. The ‘Member’ shall create content based on facts, and the content shall be, by principle, created by the ‘Member’.</li>
		<li>2. The ‘Company’ may, in the event the content created by the ‘Member’ does not violate the conditions prescribed in the ‘Content Deletion Regulation’ and Article 23 Duties of the Member, conduct filtering processes pursuant to the method provided at the ‘Website’. In the event there is a violation of ‘Content Deletion Regulation’ and Duties of the Member during this process, the content shall, without prior notification of the ‘Member’, be deleted from the ‘Website’</li>
		<li>3. In the event content include any mistypes, omissions, uses of phrases and/or contents contrary to social norms, or is clearly based on false information, the corresponding content may be deleted or corrected at the discretion of the ‘Company’.</li>
		<li>4. In the event the ‘Company’ receives any requests for deletion of content due to falsified information and/or defamatory nature of the content uploaded by the ‘Member’, the ‘Company’ may delete or otherwise render said materials of the ‘Member’ hidden to public without prior notice. The ‘Member’ shall be notified through email or other means after the deletion or hiding of post.</li>
		<li>5. In the event the ‘Content’ of the ‘Member’ use phrases and/or contents contrary to social norms, materials clearly based on false information, libel or degrade specific persons, use abusive language, advertise with intentions to gain profit, infringe copyright, expose personal information, contain obscene or antisocial content, or in any way violates relevant Acts and Agreements, the ‘Company’ may delete or edit the offending material at any time.</li>
		<li>6. If the ‘Member’ desires to delete any ‘Content’ he/she uploaded upon the voluntary deletion of his/her account, the ‘Member’ shall delete the contents in person beforehand. All Members shall be considered to have agree to this.</li>
		<li>7. If the ‘Member’ incurs damages or otherwise cause problems to him/herself or others by uploading any content or by using materials uploaded by others, the ‘Member’ shall be held responsible, and the ‘Company’ shall not be held responsible.</li>
	</ul>

	<h3>Article 19 (Rights and Use of Content)</h3>
	<ul>
		<li>1. Any copyright or other intellectual property rights pertaining to the copyright materials created by the ‘Company’ shall be held by its creator. The ‘Company’ shall claim rights to use all content the moment it has been uploaded.</li>
		<li>2. All rights and responsibilities pertaining to posts created by the ‘Member’ shall be held by the ‘Member’.</li>
		<li>3. Content created by the ‘Member’ may be used as statistical data of trends for related industries, and may be distributed through the press through media. However, any personal information that may be used to identify individuals shall be excluded.</li>
		<li>4. The ‘Company’ shall not be held responsible for any civil or criminal proceedings when the ‘Content’ of the ‘Member’ infringe upon the copyrights of any persons or programs. The party infringing upon the said copyright shall exempt ‘Company’ from all legal responsibilities, and be responsible for compensation regarding all damages incurred by the ‘Company’.</li>
		<li>5. All ‘Content’ created by the ‘Member’ may be used by the ‘Company’ for advertisement of its services. Provided, that, the ‘Company’ shall exclude personal information when using the content, and strive to protect the creator’s rights to the best of its abilities.</li>
	</ul>

	<h3>Article 20 (Duties of the Company)</h3>
	<ul>
		<li>1. The ‘Company’ shall, as prescribed in this Terms of Service, provide a continued and stable service to the best of its abilities.</li>
		<li>2. The ‘Company’ shall process complaints from the ‘Member’ immediately upon reception. In the case the complaints cannot be processed immediately, the reason for delay and the date upon which the expected processing date shall be notified to the ‘Member’ through the service page or other means.</li>
		<li>3. When service is suspended due to force majeure such as natural disasters or system disability, the ‘Company’ shall not be held responsible for damages. Provided, that, it shall recover data and recover normal operation of services to the best of its abilities.</li>
		<li>4. The ‘Company’ shall store transaction records of payments and records of ‘Content’ for a period of 1 year or more. Provided, that, an exception is made for members not qualified for membership.</li>
	</ul>

	<h3>Article 21 (Protection of Member Personal Information)</h3>
	<p>
		The ‘Company’ shall, to the best of its abilities, provide the ‘Member’ with protection of his/her private information. Protection of personal information of the ‘Member’ shall be pursuant to the Promotion of Information and Communications Network Utilization and Acts relating to information protection, and the ‘Privacy Policy’ shall be provided on the ‘Website’.
	</p>

	<h3>Article 23 (Duties of the Member)</h3>
	<ul>
		<li>1. The ‘Member’ shall adhere to related Acts, the provisions prescribed herein, and miscellaneous items notified by the ‘Company’, and shall not conduct acts that hinder the operations of the ‘Company’.</li>
		<li>2. The ‘Member’ may not copy, reproduce, translate, publish, broadcast, or otherwise use information obtained during the use of services, or provide said information to 3rd parties without the prior consent of the ‘Company’.</li>
		<li>3. The ‘Member’ shall not use the services provided by the ‘Company’ for uses other than view company information and knowledge sharing, and may not engage in any of the following acts.
			<ul>
				<li>1) Fraudulent use of other Members’ ID</li>
				<li>2) Any acts intended as, or related to criminal activities</li>
				<li>3) Any acts of defamation or offense of others</li>
				<li>4) Infringement of intellectual property or other rights</li>
				<li>5) Hacking and/or circulating computer virus</li>
				<li>6) Continuous transmission of specific content such as information that is commercial in nature, etc. against the will of other parties</li>
				<li>7) Any acts disrupting or have the potential to disrupt the stability of the service</li>
				<li>8) Any activities profiting from the use of the Website’s information and services</li>
				<li>9) Any other acts that may harm the social order, morality or otherwise violate related Acts.</li>
			</ul>
		</li>
		<li>4. The ‘Member’ may not redistribute any information obtained through the ‘Website’ prior to the permission of the ‘Company’ and the affected parties, and the ‘Member’ is solely responsible for the management when this information is printed, copied, etc.</li>
		<li>5. Any paid services requested by the ‘Member’ shall create bond for the ‘Company’ and debt for the ‘Member’. The ‘Member’ must make the corresponding payment within the specified date.</li>
		<li>6. The ‘Member’ shall personally manage the prevention of information loss for password, etc. when making payment through credit card Provided, that, the ‘Member’ shall not be held responsible for any information loss arising from fault within the ‘Website’.</li>
		<li>7. The ‘Member’ shall comply with laws relating to the use of service, the Terms of Service, detailed guideline, service use guide, and any notified announcements by the company, and regularly check for these items.</li>
	</ul>

	<h3>Article 23 (Duties of Member Regarding ID and Password)</h3>
	<ul>
		<li>1. The ‘Member’ shall hold all responsibility for the ID and password.</li>
		<li>2. The ‘Member’ may not allow any 3rd parties to use his/her ID and password, and shall hold all responsibility thereof.</li>
		<li>3. In the event the ID and password of the ‘Member’ is stolen or used by a 3rd party, the ‘Member’ shall, immediately upon becoming aware of the situation, immediately notify the ‘Company’ and follow the provided instructions. For any damages incurred by the delay of the ‘Member’ in notifying the ‘Company’ upon becoming aware of the above situation, the ‘Company’ shall not have any obligation of compensation.</li>
	</ul>

	<h3>Article 24 (Deletion of Account and Termination of User Agreement)</h3>
	<ul>
		<li>1. The ‘Member’ may request the deletion of his/her account at any time. The request may be made through features available in the ‘Website’, or by sending an email to the following address: cs@vineplant.net</li>
		<li>2. Posts uploaded by the ‘Member’ shall not be deleted upon the deletion of the account, as stated in Article 19 (1).</li>
		<li>3. In the event when the ‘Member’ violate the Terms of Service or the Use Policy of individual services, the ‘Company’ may restrict use through incremental measures such as give warning, temporary suspension, permanent suspension, etc. or terminate the User Agreement. Provided, that, the ‘Company’ may suspend service, terminate account, delete job postings etc. without prior agreement for cases applicable to the following:
			<ul>
				<li>1) The ‘Member’ did not faithfully fulfill the duties prescribed herein</li>
				<li>2) Failure to pay the prescribed fee for the use of paid services</li>
				<li>3) Repeated payment/cancellation of paid services with ill intent</li>
				<li>4) Social issues caused by using information in a field inappropriate for the purpose of this service</li>
				<li>5) The information submitted by the ‘Member’ is incorrect and/or falsified</li>
				<li>6) Information registered during sign up as ‘Corporate Member’ does not match the business registration certificate</li>
				<li>7) Use of a stolen 3rd party business registration number and/or name to falsify company information, or using business registration number of suspended or closed businesses</li>
				<li>8) Registration of company name without, in the case of branch or sales office, etc., specifying the branch office accurately, or the use of HQ business registration number despite possessing a separate business registration number when signing up as ‘Corporate Member’</li>
				<li>9) Failure to sign up as ‘Corporate Member’ or register job postings pursuant to the instructions of this service</li>
				<li>10) Using Member ID or IDs to register duplicate company information, job postings, etc. that are identical in substance</li>
				<li>11) Defamation of this service</li>
				<li>12) Miscellaneous violations of relevant Acts or if otherwise deemed necessary by the administrator for normal operation of the Website.</li>
			</ul>
		</li>
		<li>4. The ‘Member’ may file an objection regarding the procedure the ‘Company’ has undertaken for the suspension of service and other restrictions related to the use of service pursuant to paragraph 3 of this Article. The ‘Company’ shall allow ‘Member’ to resume the use of its services when the objection is deemed justified.</li>
		<li>5. If normal paid services are not provided during its use by the ‘Member’ due to causes attributable to the ‘Company’, the ‘Member’ may request the cancellation of said service, and in the event of paid services with a set period of use, the refund shall be calculated as the number of days not used to the date of cancellation, with payment calculated in a per day basis. For paid services with set number of uses, refund shall be calculated per the number of uses remaining. Provided, that, in the event of postings with falsified or defective information, the paid advertisement fee shall not be refunded.</li>
		<li>6. The ‘Company’ shall delete all member information when an account is terminated, unless stipulated by Commercial Act, Act on Consumer Protection in Electronic Commerce, and other relevant Acts, in which case the information shall be stored for period pursuant to the relevant Acts.
</li>
		<li>7. For the protection of personal information, the ‘ID’ of the ‘Member’ shall be categorized as a “sleeper account’ and suspended when the ‘Member’ does not log in for one year. In this instance, the ‘Company’ shall notify the Member through email, written note, or SMS 30 days before execution of process. After the ‘Member’ verifies his/her identification, the use of the ‘Website’ shall be available in the event he/she expresses the intention to use the services.</li>
	</ul>

	<h3>Article 25 (Compensation for Damages)</h3>
	<ul>
		<li>1. In the event the ‘Company’ inflicts damages to the ‘Member’, or is otherwise attributable for any damages arising from services provided by the "Company", the "Company" shall compensate the user for the damages.</li>
		<li>2. In the event the ‘Member’ inflicts damages to the ‘Company’ and other 3rd parties arising from violations of the provisions herein, or cause damages to the ‘Company’ and other 3rd parties due to causes attributable to the ‘Member’, said ‘Member’ shall compensate for the damages.</li>
		<li>3. The ‘Company’ shall not be held responsible for any compensation when damages attributable to other users are inflicted on the ‘Member’.</li>
	</ul>

	<h3>Article 26 (Exemption)</h3>
	<ul>
		<li>1. When the ‘Company’ cannot provide its services due to force majeure such as natural disasters or any equivalent incidents, the ‘Company’ shall be exempt from damages incurred by the customers, provided there is no applicable intent or gross negligence.</li>
		<li>2. The ‘Company’ shall be exempt from liability for any difficulties experienced by the ‘Member’ during the use of services due to causes attributable to the ‘Member’.</li>
		<li>3. He ‘Company’ shall be exempt from liability for any lack of expected monetary profits during the use of its services, or damages incurred from using information obtained through the services.</li>
		<li>4. The ‘Company’ shall be exempt from liability for the information, data, integrity, accuracy of facts, etc. relating to the service, unless under a special circumstance where the ‘Company’ clearly was aware of the falsity beforehand.</li>
		<li>5. The ‘Company’ shall be exempt from liability for any measures it may have taken pursuant to this Terms of Service and relevant Acts.</li>
		<li>6. The ‘Company’ shall be exempt from liability for any damages regarding the use of service, provided there is no intent for gross negligence from the ‘Company’</li>
		<li>7. The ‘Company’ shall be exempt from liability for any damages when the contracted telecommunication service provider ceases to provide telecommunication services or provides service in an abnormal manner.</li>
		<li>8. The ‘Company’ shall only provide access to RFQs and quotations, an advertisement platform, Q&amp;A between users, a community platform, and other miscellaneous services. Therefore, when a mutual transaction is made between users via the services, the users involved hold sole responsible for the performance of their obligation, and not the ‘Company’.</li>
		<li>9. The ‘Company’ shall be exempt from liability regarding the use of services that are free of charge, unless stipulated under relevant Acts.
</li>
		<li>10. In the event of a dispute between Members, the ‘Company’ shall be exempt from liability for any and all legal issues arising between the parties involved, provided there is no intent or gross negligence.</li>
	</ul>

	<h3>Article 27 (Relationship with Advertisers and Linked Websites)</h3>
	<ul>
		<li>1. The Privacy Policy and Terms of Service is not applicable to websites other than the official ‘Company’ website or website links attached in emails.</li>
		<li>2. The ‘Company’ shall not be held responsible for any loss or damages incurred by the ‘Member’ participating in, communicating, or transacting with advertisers and their promotional activities through the advertisements provided through this service or linked in emails</li>
	</ul>

	<h3>Article 28 (Restriction of Transfer)</h3>
	<p>The ‘Member’ may not lend, transfer, or otherwise bestow the rights to use this service to a 3rd party.</p>

	<h3>Article 29 (Confidentiality)</h3>
	<ul>
		<li>1. The ‘Member’ and the ‘Company’ shall not disclose to 3rd parties any and all information relating to all involved parties and/or the information of other users obtained during the use of this service.</li>
		<li>2. This Article shall survive and remain in effect even after the termination or cancellation of the User Agreement or the termination of service.</li>
	</ul>

	<h3>Article 30 (Dispute Settlement)</h3>
	<ul>
		<li>1. The ‘Company’ and the ‘Member’ shall make every effort to find an amicable solution to a dispute.</li>
		<li>2. If the parties involved, notwithstanding the preceding paragraph, decide to resolve the dispute through lawsuit, said lawsuit shall be brought to the court of jurisdiction under the address of the ‘Company’.
Addendum</li>
	</ul>

	<h3></h3>
	<ul>
		<li> - The Terms of Service shall be effective as of January 5, 2022.</li>
	</ul>
</div>
</div></dd>
                </dl>

                <dl class="row agree-row">
                    <dd class="col-xs-9 chk_ico" data-for="reg_req2">
                        <input type="checkbox" name="reg_req[]" id="reg_req2" value="0" onclick="ag_check(this)">
                        <label for="reg_req2"><span></span><em>I agree to Privacy Policy (Required)</em></label>
                        <!--<i></i> 개인정보처리방침 동의 (필수) -->
                    </dd>
                    <dd class="col-xs-3 text-right"><input type="button" value="View Contant" class="btn btn-agr"></dd>
                    <!--dd class="col-xs-12 agr_textarea"><textarea readonly>< ?php echo get_text($config['cf_privacy']) ?></textarea></dd-->
                    <dd class="col-xs-12 agr_textarea"><div class="inr v3">
<div class="policy_view">
	<h2>Privacy Policy</h2>
	<div class="box">
		<p>
		VinePlant Inc. (hereinafter referred to as the ‘Company’) shall consider the security of its users’ personal information of utmost importance, and as such the ‘Company’ shall faithfully perform its duty to protect the personal information online provided by the user the moment said user access the services of the ‘Company’s website (hereinafter referred to as the ‘Website’). The ‘Company’ shall act in accordance with the “Personal Information Protection Act”, “Act on Promotion of Information and Communications Network Utilization and Information Protection”, and other privacy policies pertaining to private information.
		</p>

		<p>
		The Company shall state the Privacy Policy as follows, so as to notify the user what kind of information they are providing for the ‘Company’, how they are being used, and what kind of measures are taken for the protection of personal information. The Company’s Privacy Policy may be subject to change due to changes in Acts, public notices and/or internal policies, and revisions shall be posted on the service page or notified to the user. Please check the Privacy Policy regularly when visiting the Website.
		</p>

		<p>
		The user may refuse to agree to any terms below regarding the collection, use, consignment, etc. of personal information. However, please note that certain or all services may not be available if the user refuses agreement.
		</p>
	</div>
	<h3>Article 1 (Collection and Use of Personal Information)</h3>
	<ul>
		<li>1. The Company may collect personal information for the following reasons, and shall not use this information otherwise for any other purposes.
			<ul>
				<li>
					1) Management of membership <br>
					Verification of personal identification for membership service, confirming members’ intent during sign up/management/deletion of account, response to customer inquiries, delivering new information and notices, and confirmations regarding violations of Acts and Terms of Service
				</li>
				<li>
					2) Fulfillment of contract regarding the provision of service and adjustment of payment for the use of services <br>
					Self-authentication, identification for personalized service of each member, communication between members, purchasing and payment transaction, delivery of product and/or documentary evidence of expenditure, prevention of illegal and unauthorized use
				</li>
				<li>
					3) Development of service and use in marketing/advertising <br>
					Developing new services, providing personalized service, service guidance and use recommendations, determination of statistics and frequency of user access for service improvement and development of new services, advertisement using statistical characteristics, providing event information and participation opportunities
				</li>
				<li>
					4) Statistical analysis to identify industry trends, data analysis for advancing the quality of service
				</li>
			</ul>
		</li>
		<li>2. The purpose of the use of personal information based on category is as follows:
			<ul>
				<li>1) Name, ID, password: identification of members for the use of membership services, sign up/maintenance/deletion of account</li>
				<li>2) Email address, phone number: send notice, means of seamless communication for handling of complaints etc., notification of new services, products and events, etc.</li>
				<li>3) Credit card information (Name of credit card company, 16-digit card number, card expiry date, name and date of birth of card holder): payment for services and other additional services</li>
				<li>4) Bank account details: Identification and confirmation of bank account</li>
				<li>5) Miscellaneous category: Data and marketing needed to provide personalized service</li>
				<li>6) Voice recordings during customers’ interaction with Customer Service: Improve the standards of customer service</li>
			</ul>
		</li>
	</ul>

	<h3>Article 2 (Collected Personal Information)</h3>
	<ul>
		<li>1. The Company may, for the purpose of providing services, collect the following information during the membership sign up process by the user.
			<ul>
				<li>
				 Corporate Members <br>
				- Required: ID, password, email, mobile phone number, business registration number, business name, name of representative, business address <br>
				- Optional: main phone and fax number
				</li>
			</ul>
		</li>
		<li>2. The following is the required information collected by the Company when members use and/or receive refund for any paid service:<br>
		Name, email, mobile phone number, payment details (credit card payment details: name of credit card company, card number, card expiry date, password, card verification number, etc. and other payment records) Wire transfer: virtual account number, etc. and other payment records</li>
		<li>4. The following information is collected automatically during the use of service or conduction of business:<br>
			IP address, cookies, time of visit, service use record, record of bad connection, access log, payment record, Internet environment, phone call record if members used Customer Service</li>
		<li>5. The Company may request the user to enter personal information when joining events and surveys. The information may be used for statistical analysis, giveaways etc. The user can agree to receive advertisement messages by text or other means, and may receive a request for personal information input if participating in event and giveaways provided with the mail sent.</li>
		<li>6. The Company may not collect information that may infringe upon the basic human rights of the user. When the company has to inevitably collect such information, the company shall ask for the user permission beforehand.</li>
		<li>7. The Company, for any and all reasons, shall not use nor leak the information submitted by the user for purposes not mentioned beforehand.</li>
	</ul>

	<h3>Article 3 (Method of Collection)</h3>
	<ul>
		<li>1. The Company may collect personal information through the Website sign up process, the editing of member information, documents, phone and/or fax, use of service, payment, offers from affiliate companies, email, joining events, inquiry to customer support, uploading of posts, etc.</li>
		<li>2. Regarding the Privacy Policy and Terms of Service provided by the company, the user may express consent to the collection of personal information by pressing the ‘I Agree’ button. The user is deemed to have consented thereof when pressing the ‘I Agree’ button.</li>
	</ul>

	<h3>Article 4 (The Storage and Use Period of Collected Personal Information)</h3>
	<p>
		The user’s personal information shall, by principle, be disposed without delay upon achieving the purpose of use. However, the following data shall be stored for the specified period:
	</p>
	<ul>
		<li>1. Storage of data pursuant to the Company’s internal policies
			<ul>
				<li>
				 - Record of fraudulent use (fraudulent sign up, disciplinary records and other records of service use including suspension of service, and any other violations of the Website operation principle)<br>
				Stored data: name, ID, contact details, record of fraudulent use (service use record, login history, cookies, IP connection details)<br>
				Purpose of storage: prevention of fraudulent sign up and usage<br>
				Period of storage: 6 months
				</li>
			</ul>
		</li>
		<li>2. Storage of data due to relevant Acts
			<ul>
				<li>The Company shall store the data when the need arises, as stipulated within the Commercial Act, Act on Consumer Protection in Electronic Commerce, etc., and other relevant Acts, for a period stipulated in the said Acts. In this instance, the company shall use the data only for the purpose of storing the data, and period of storage is as follows:</li>
				<li>
					 - Records regarding the Agreement, cancellation, etc.<br>
					Purpose of storage: Act on Consumer Protection in Electronic Commerce and other relevant Acts.<br>
					Period of storage: 5 years
				</li>
				<li>
					 - Records on payment and supply of goods etc.<br>
					Purpose of storage: Act on Consumer Protection in Electronic Commerce and other relevant Acts.<br>
					Period of storage: 5 years
				</li>
				<li>
					 - Records on e-finance transactions<br>
					urpose of storage: Electronic Financial Transactions Act<br>
					Period of storage: 5 years
				</li>
				<li>
					 - Records on user complaints and handling of disputes<br>
					Purpose of storage: Act on Consumer Protection in Electronic Commerce and other relevant Acts.<br>
					Period of storage: 3 years
				</li>
				<li>
					 - Website visit history<br>
					Purpose of storage: Communication Secret Protection Act<br>
					Period of storage: 3 months
				</li>
			</ul>
		</li>
		<li>
		3. For the protection of personal information, the user's account setting, via linkage of email, shall be categorized as a ‘sleeper account’ if the user does not use the Website for one year, and suspend the use of said account. In addition, in accordance with the ‘Personal Information Expiry Policy’, the personal information of members who has not used this service for at least one year shall be stored separately or deleted. In this instance, the Company shall notify the user through email or SMS 30 days before the execution of the measure. After the user verifies his/her identification, the use of the Website shall be available if he/she expresses the intention to use the provided services.
		</li>
	</ul>

	<h3>Article 5 (Provision of Personal Information to 3rd Parties)</h3>
	<ul>
		<li>1. The Company shall use the user’s personal information within the scope defined by Article 1, and shall not use said information beyond the scope prescribed in the same Article without the consent of the user. The user’s personal information shall, in principle, not be disclosed to any 3rd parties. However, exceptions are as follows:
			<ul>
				<li>1) If the user has consented beforehand</li>
				<li>2) If considered necessary during payment for service</li>
				<li>3) If the user directly consents to providing personal information to outside affiliate services</li>
				<li>4) If the Company is obligated to submit personal information in pursuant to relevant Acts</li>
				<li>5) If the information is made non-specific and shared with advertisers, partners, research organizations, etc. for statistical analysis, academic research, and market research</li>
				<li>6) If an imminent risk to the life and/or safety of the user is identified and needs to be resolved.</li>
			</ul>
		</li>
	</ul>

	<h3>Article 6 (Outsourcing the Processing of Personal Information)</h3>
	<ul>
		<li>
		1. The Company may outsource some of its tasks to provide a more convenient and improved service. The Company may outsource some of its tasks necessary to provide service, and stipulates necessary matters for the contracted company regarding the safe processing of personal information, pursuant to the Personal Information Protection Act. If the user does not use any services that the contracted company would be tasked with, the user’s personal information shall not be provided to said company.
		</li>
		<li>
			2. Details on the contracted company and outsourced tasks are as follows. The period of storage and use shall be until the deletion of account or the outsourcing contract.
			<div class="area_table">
				<span>&lt;Domestic and Foreign Companies&gt;</span>
				<table class="table v1">
					<colgroup>
						<col style="width:50%">
						<col style="width:30%">
						<col style="width:20%">
					</colgroup>
					<thead>
						<tr>
							<th>Outsourced task details </th>
							<th>contracted company </th>
							<th>period of storage and use</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Electronic payment service</td>
							<td>
								Infinisoft. Co., Ltd.<br>
								NICE Payments Co., Ltd.<br>
								Danal Co., Ltd.<br>
								Kakao Pay Corp.<br>
								Viva Republica Co., Ltd.<br>
								Naver Financial Corp.
							</td>
							<td rowspan="4">Until deletion of account or outsourcing contract</td>
						</tr>
						<tr>
							<td>Self-authentication service</td>
							<td>
								Danal Co., Ltd.<br>
								Infinisoft. Co., Ltd.
							</td>
						</tr>
						<tr>
							<td>SMS/LMS, email, notification message</td>
							<td>NHN Co., Ltd.<br>
								Biztalk Co., Ltd.</td>
						</tr>
						<tr>
							<td>Data storage and system management</td>
							<td>Infinisoft. Co., Ltd.
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</li>
	</ul>

	<h3>Article 7 (Personal Information Disposal Process and Method)</h3>
	<p>The user’s personal information shall, by principle, be disposed without delay upon achieving the purpose of use. The Company’s process and method for the termination of personal information is as follows.</p>
	<ul>
		<li>
			1. Disposal Process<br>
			 - All information entered by the user for sign up, etc. shall be moved to a separate DB (in the case of paper documents, it shall be stored in a separate filing cabinet). For the protection of the information (refer to Period of Storage and Use), it shall be stored for a certain period after which it shall be disposed pursuant to internal policy and other relevant Acts.<br>
			 - The aforementioned personal information shall not be used for purposes other than storage, unless required by relevant Acts.
		</li>
		<li>
			2. Disposal Method<br>
			 - Personal information printed on paper shall be disposed using a paper shredder or by burning.<br>
			 - Personal information saved as files shall be deleted using a method as so it cannot be recovered.
		</li>
		<li>
			3. The Company shall dispose the information as prescribed in this Article, notwithstanding user requests to edit or delete said information or to delete the account.
		</li>
		<li>
			4. As stated in Article 2 of the Privacy Policy, all personal information stored for temporary purposes (surveys, events, etc.) shall be disposed using method identical to the above when the purpose of said information is achieved.
		</li>
	</ul>

	<h3>Article 8 (Installation, Management and Refusal of Automatic Personal Information Collection Device)</h3>
	<ul>
		<li>
			1. Cookies are sent from the server used for website operation to the user’s browser, after which it is saved on the user’s computer as a very small text file. Cookies are used to support a faster and more convenient use of websites, and also used to provide personalized service.
		</li>
		<li>
			2. The Company uses the cookie method for the verification of members. These shall be automatically deleted and not saved on a computer after logout. Therefore, if you are in public or using a computer that may be used by others, please log out after accessing and using the account of the Website.
		</li>
		<li>
			3. The purpose of cookies are to save and maintain loading of the user’s information in order to provide personalized service. The server reads the contents of the cookies stored on the user's device when the Website is visited to maintain the user's preference and provide personalized service. Cookies help the user to access websites while maintaining the user’s settings for a convenient experience. In addition, it is used to provide optimized advertising and other information personalized to the user’s need using the user’s Internet history and user habit.
		</li>
		<li>
			4. Cookies do not save any names, phone numbers or any other identification information, and the user is always provided options for the use of cookies. Therefore, the user may set the option to allow all cookies in the web browser, be notified each time cookies are saved, or refuse all cookies. However, the web experience may become inconvenient if the user decides to refuse all cookies, and the use of certain services during the login process may become difficult.
		</li>
		<li>
			Examples of cookie settings <br>
			1) Microsoft Edge <br>
			Tools menu on the top of web browser &gt; Internet options &gt; Personal information &gt; Settings
		</li>
		<li>
			2) Google Chrome <br>
			Settings menu on the right of web browser &gt; Security and Privacy &gt; Cookies and other site data
		</li>
	</ul>

	<h3>Article 9 (Technical and Administrative Measure for Protection of Personal Information)</h3>
	<p>The user’s personal information shall, by principle, be disposed without delay upon achieving the purpose of use. The Company’s process and method for the termination of personal information is as follows.</p>
	<ul>
		<li>
			1. The company shall, in processing the user's personal information, prevent the loss, theft, leakage, external attack, hacking, etc. of information, and take technical/administrative and physical measures for security.
		</li>
		<li>
			2. The following are the technical/administrative and physical measures taken by the company.
			<ul>
				<li>1) Establish and implement separate internal management plan for the safe processing of personal information.</li>
				<li>2) Minimize the number of staff handling personal information in order to control access to the information. The staff members in charge receive regular training in regards to security, and are frequently inspected for compliance with this policy.</li>
				<li>3) The protection of user’s personal information using a password in order to safely store and transmit personal information. By encrypting files and various data, important data is protected using separate security features, and encrypted communication (SSL) is used to transmit personal information safely across the network.</li>
				<li>4) In order to respond to any infringement of personal information and prevent forgery and falsification, a personal information handler shall access the personal information processing system and save the date accessed, process log, etc. when processing personal information, and will store separately to prevent forgery, theft, loss or disposal.</li>
				<li>5) The company shall use a vaccine program to prevent any damages to the personal information, and the program shall be updated periodically. The installation and update of security programs for personal information are also monitored.</li>
				<li>6) To respond to hacking attempts, all data is stored in a high security data center. Access to personal information data is restricted by dividing the access rights. </li>
				<li>7) For the safe storage of personal information, security equipment is used to block intrusion from outside, and intrusion detection system are installed to detect unlawful entries. The Company is taking additional physical measures such as the use of separate storage facility, installing lock devices, etc.</li>
			</ul>
		</li>
		<li>
			3. The Company shall protect the personal information of the user to the best of its abilities. However, the Company is not responsible for any problems from the leakage of personal information such as email (or other account information set by the user through linkage with external services such as FaceBook, etc.), password, etc. arising from user negligence, as well as those occurring from the inherent risks of the Internet.
		</li>
	</ul>

	<h3>Article 10 (Banner and Linked Websites)</h3>
	<p>
		The website may host various banners and links. The banners and links are connected to external websites for the purposes of contractual obligation between the Company and advertisement providers, or to reveal the source of its contents. In the case the user click the links hosted on this website to move to an external website, the privacy policy of the external website is unrelated to this Website. Please check the policy of any external websites separately. The Privacy Policy of this Website shall not be effective on any external websites linked on this Website.
	</p>

	<h3>Article 11 (User’s Rights and Exercise Method)</h3>
	<ul>
		<li>
			1. The user and their legal representative may view, disclose, process, modify, or delete any information relating to themselves or any minors at any time. The user and their legal representative may inquire/edit/delete account (withdraw consent) regarding their personal information through 'Manage member information'. By contacting the person in charge of personal information protection through email, the Company shall take action after the identification process.
		</li>
		<li>
			2. The Company shall not use or share any personal information that has been requested for correction until the correction has been made. Moreover, if erroneous personal information has already been provided to any 3rd parties, the Company shall notify those parties without delay as to make the corrections.
		</li>
		<li>
			3. The Company shall, in regards to deleted personal information through the request of the user, process the personal information as prescribed in Article 4 (The Storage and Use Period of Collected Personal Information) and be made inaccessible or otherwise unable to be used for other purposes.
		</li>
		<li>
			4. The Company shall not collect any personal information of minors under the age or 14. However, in the case the personal information of a minor under the age of 14 has been collected, legal rights for a legal representative to process the said personal information is guaranteed.
		</li>
	</ul>

	<h3>Article 12 (Compliance to European Union General Data Protection Regulation)</h3>
	<ul>
		<li>
			1. The Company shall comply with the European Union General Data Protection Regulation and the member states of the European Union. The following may be applied for the user of the service within the European Union.
		</li>
		<li>
			2. The Company shall use the collected personal information only for the purposes prescribed in Article 1, and shall notify the user of this fact in advance, and ask for consent. In accordance to GDPR and other relevant Acts, the Company may process the user’s personal information if applicable to any one of the following.

			<ul>
				<li> - Consent of the subject of information</li>
				<li> - If the data is necessary for entering or performing the contract with subject of information</li>
				<li> - If needed to fulfill legal obligations</li>
				<li> - If processing is required for significant gains of the subject of information</li>
				<li> - For the pursuit of the company’s legitimate interests (except when the interests, rights or freedoms of the subject of information are more important than those interests)</li>
			</ul>
		</li>
		<li>
			3. Guaranteeing the rights of users in the European Union: In accordance with applicable Acts such as GDPR, the user may request to transfer their personal information to another administrator, or refuse the processing of their personal information Furthermore, the user holds the right to file a complaint with the data protection authority. In addition, the Company may use personal information to provide marketing such as events and advertisements, and shall seek the user's consent in advance. The user may withdraw their consent at any time as they wish. Requests relating to the matters above shall be processed without delay. Contact shall be made through Customer Service through written documents, phone or email. The Company shall not use or share any personal information that has been requested for correction until the correction has been made.
		</li>
	</ul>

	<h3>Article 13 (Information on Personal Information Manager and Administrator)</h3>
	<p>The Company shall, for the handling of user inquiries, complaints, etc., designate a personal information manager and administrator as below.</p>
	<ul>
		<li>Name: Hyeong-uk Kim</li>
		<li>Department/Position: Management Department/Manager</li>
		<li>Email: master@podosea.com</li>
		<li>Phone number: 070-7843-0031</li>
	</ul>
	<p>Please contact the following organization if you need to report on other miscellaneous infringement of personal information.</p>
	<ul>
		<li>Personal Information Infringement Report Center (privacy.kisa.or.kr / 118 without area code)</li>
		<li>Cyber​Investigation Division, Supreme Prosecutors' Office (www.spo.go.kr / 1301 without area code)</li>
		<li>National Police Agency, Cyber​Investigation Bureau (police.go.kr / 182 without area code)</li>
	</ul>

	<h3>Article 14 (Obligation of Notification Before Revision)</h3>
	<ul>
		<li>1. For any addition, deletion, or modification of the contents of this Privacy Policy, the user shall be notified at least 7 days before the effective date.</li>
		<li>
		2. However, for changes concerning the collection of personal information, the purpose of use, or any other significant changes concerning user rights, the user shall be notified at least 30 days in advance, and additional consent may be required if necessary.
		<br><br>
		Date of Notice: January 10, 2022<br>
		Date of Effect: January 17, 2022
		</li>
	</ul>
</div>
</div></dd>
                </dl>

				<dl class="row agree-row">
                    <dd class="chk_ico" data-for="reg_req4">
                        <input type="checkbox" name="reg_req[]" id="reg_req4" value="0" onclick="ag_check(this)">
                        <label for="reg_req4"><span></span><em>I agree to receive notifications about service information and events (optional)</em></label>
                    </dd>
                </dl>

				<!--<dl class="row agree-row">
                    <dd class="chk_ico" data-for="reg_req5">
                        <input type="checkbox" name="reg_req[]" id="reg_req5" value="0" onclick="ag_check(this)">
                        <label for="reg_req5"><span></span><em>장기 미접속시 계정활성상태 유지합니다 (선택)</em></label>
                    </dd>
                </dl>-->
            </div>
        </div>
        </div><!--//join_chk-->ㄱ
		<? } ?>

		<div class="btn_confirm">
			<input type="submit" class="btn_submit ft_btn" id="pay_submit" value="<?php echo $w==''?'Sign up complete!':'Changing information'; ?>" accesskey="s">
		</div>
	</article>
    </form>
</div>

<!-- 다음주소 -->
<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
	<div class="add_title">
		<h2>Find address</h2>
		<div class="btn_close2" onclick="closeDaumPostcode()" alt="닫기 버튼">
			<span></span>
			<span></span>
		</div>
	</div>
	<img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
</div>

 <script>
 if (!'<?=$private?>') {
     // F12 버튼 방지
     $(document).ready(function () {
         $(document).bind('keydown', function (e) {
             if (e.keyCode == 123 /* F12 */) {
                 e.preventDefault();
                 e.returnValue = false;
             }
         });
     });

     // 마우스 우클릭 방지
     document.onmousedown = function (event) {
         if (event.button == 2) {
             return false;
         }
     };
 }
 </script>

<!--<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?/*=$kakao_javascript_key*/?>&libraries=services"></script>-->
<script>
function ag_check(obj){
	if(obj.value == "0"){
		obj.value = "1";
	}else{
		obj.value = "0";
	}
}

$(function (){
    // 약관동의 전체체크
    $("#all_chk").click(function() {
        if($("#all_chk").prop("checked")) {
            $("input[type=checkbox]").prop("checked",true);
            $("input[type=checkbox]").val("1");
        } else {
            $("input[type=checkbox]").prop("checked",false);
            $("input[type=checkbox]").val("0");
        }
    });

    $('input[name^=reg_req]').click(function() {
        if($("input[name^='reg_req']:checked").length == 4) {
            $('#all_chk').prop("checked", true);
        } else {
            $('#all_chk').prop("checked", false);
        }
    });

	// 아이디 체크
	$("#reg_mb_id").keyup(function (){
		var mb_id = $(this).val();
		var state = $(this).parents(".row").find(".status_ico");
		var err = $(this).parents(".row").find(".error");

		// 아이디 정규표현식
		var regId = /^[a-z0-9_]{3,15}$/;

		if (regId.test(mb_id)){
			var msg = reg_mb_id_check();
			if (msg) {
				state.removeClass("pas").addClass("err");
				err.addClass("on").html(msg);
			} else {
				state.removeClass("err").addClass("pas");
				err.html("");
			}
		}else{
			state.removeClass("pas").addClass("err");
			err.addClass("on").html("The ID can be 3 to 15 digits, including lowercase letters and numbers.");
		}
	});

	$("#reg_mb_password").keyup(function (){
		var mb_password = $(this);
		var mb_password_re = $("#reg_mb_password_re");
		var state = mb_password.parents(".row").find(".status_ico");
		var err = mb_password.parents(".row").find(".error");

		if (mb_password.val() != "" && mb_password_re.val() != "") {
			// 바뀌면 무조건 틀렸다로 표시.
			if(mb_password_re.val() != mb_password.val()){
				state.removeClass("pas").addClass("err");
				err.addClass("on").html("Password is different.");
			}else{
				state.removeClass("err").addClass("pas");
				err.html("");
			}
		} else if (mb_password.val().length < 8) {
			state.removeClass("pas").addClass("err");
			err.addClass("on").html("Please enter a password of at least 8 characters.");
		} else {
			state.removeClass("err").addClass("pas");
			err.html("");
		}

        // 비밀번호 정규식 체크
        var chk_flag = mbPasswordChk(mb_password.val());
        if(!chk_flag) {
            state.removeClass("pas").addClass("err");
            err.addClass("on").html("Please enter at least 8 characters by combining at least two types of English letters, numbers, and special characters.");
        } else {
            state.removeClass("err").addClass("pas");
            err.html("");
        }
	});

	$("#reg_mb_password_re").keyup(function (){
		var mb_password_re = $(this).val();
		var mb_password = $("#reg_mb_password").val();
		var state = $(this).parents(".row").find(".status_ico");
		var err = $(this).parents(".row").find(".error");

		// 비밀번호 정규표현식
		var regPassword = /^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

		if(mb_password == mb_password_re){
			state.removeClass("err").addClass("pas");
			err.html("");
		}else{
			state.removeClass("pas").addClass("err");
			err.addClass("on").html("The password is different.");
		}
	});

	$("#reg_mb_name").keyup(function (){
		var mb_name = $(this).val();
		var reg_mb_name = $(this);
		var state = $(this).parents(".row").find(".status_ico");
		var err = $(this).parents(".row").find(".error");

		// 이름 정규표현식
		var regName = /^[가-힣]{2,4}|[a-zA-Z]{2,10}\s[a-zA-Z]{2,10}$/;

		if (regName.test(mb_name)){
			state.removeClass("err").addClass("pas");
			err.html("");
		}else{
			state.removeClass("pas").addClass("err");
			err.addClass("on").html("Please enter at least 2 Korean characters only.");
		}
	});

	/*$("#reg_mb_hp").keyup(function (){
		var mb_hp = $(this).val();
		var reg_mb_hp = $(this);
		var state = $(this).parents(".row").find(".status_ico");
		var err = $(this).parents(".row").find(".error");

		// 휴대폰 정규표현식
		// /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/
		//var regHp = /^\d{10,12}$/;
        var regHp = /^([0-9]{3,4})-?([0-9]{3,4})-?([0-9]{4})$/;

		if (regHp.test(mb_hp)){
			state.removeClass("err").addClass("pas");
			err.html("");
		}else{
			state.removeClass("pas").addClass("err");
			err.addClass("on").html("Please enter only 10 to 12 digits for your mobile number.");
		}

	}).keydown(function (event) {
		var key = event.charCode || event.keyCode || 0;
		$text = $(this);
		if (key !== 8 && key !== 9) {
			if ($text.val().length === 3) {
				$text.val($text.val() + '-');
			}
			if ($text.val().length === 8) {
				$text.val($text.val() + '-');
			}
		}

		return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
	});*/

    /*$("#reg_mb_company_tel").keyup(function (){
        var mb_hp = $(this).val();
        var reg_mb_hp = $(this);
        var state = $(this).parents(".row").find(".status_ico");
        var err = $(this).parents(".row").find(".error");

        var regHp = /^([0-9]{3,4})-?([0-9]{3,4})-?([0-9]{4})$/;

        if (regHp.test(mb_hp)){
            state.removeClass("err").addClass("pas");
            err.html("");
        }else{
            state.removeClass("pas").addClass("err");
            err.addClass("on").html("대표전화는 10 ~ 12자리 숫자만 입력해 주세요.");
        }

    }).keydown(function (event) {
        var key = event.charCode || event.keyCode || 0;
        $text = $(this);
        if (key !== 8 && key !== 9) {
            if ($text.val().length === 3) {
                $text.val($text.val() + '-');
            }
            if ($text.val().length === 8) {
                $text.val($text.val() + '-');
            }
        }

        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    });*/

    /*$("#reg_mb_company_fax").keydown(function (event) {
        var key = event.charCode || event.keyCode || 0;
        $text = $(this);
        if (key !== 8 && key !== 9) {
            if ($text.val().length === 3) {
                $text.val($text.val() + '-');
            }
            if ($text.val().length === 8) {
                $text.val($text.val() + '-');
            }
        }

        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    });*/

	// $("#reg_mb_addr1").on("focusin", execDaumPostcode);

	$("#reg_mb_addr2").keyup(function (){
		var state = $(this).parents(".row").find(".status_ico");
		var err = $(this).parents(".row").find(".error");
		if ($(this).val().length > 0) {
			state.removeClass("err").addClass("pas");
			err.html("");
		} else {
			state.removeClass("pas").addClass("err");
			err.addClass("on").html("Please enter your detailed address.");
		}
	});

	$("#reg_mb_email").keyup(function (){
		// 공백제거
		$(this).val($(this).val().replace(/ /gi, ''));
		var mb_email = $(this).val();
		var state = $(this).parents(".row").find(".status_ico");
		var err = $(this).parents(".row").find(".error");

		// 이메일 정규표현식
		var regEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;

		if (regEmail.test(mb_email)){
			var msg = reg_mb_email_check();
			if (msg) {
				state.removeClass("pas").addClass("err");
				err.addClass("on").html(msg);
			} else {
				state.removeClass("err").addClass("pas");
				err.html("");
			}
		}else{
			state.removeClass("pas").addClass("err");
			err.addClass("on").html("Please enter the correct e-mail format.")
			return false;
		}
	});

	// 내용보기
	$(".btn-agr").click(function (){
		var dis = $(this).parents(".row").find(".agr_textarea").css("display");
		if(dis == "none")
			$(this).parents(".row").find(".agr_textarea").slideDown(100);
		else
			$(this).parents(".row").find(".agr_textarea").slideUp(100);
	});

	// 약관동의
	$(".agree-row dd:first-child").click(function (){
		var ford = $(this).data("for");
		var targ = $("#" + ford);

		if(targ.val() == "1"){
			$(this).find("i").removeClass("nochk").addClass("chk");
			//targ.val("0");
		}else{
			$(this).find("i").removeClass("chk").addClass("nochk");
			//targ.val("1");
		}
	});
});

// submit 최종 폼체크
function fregisterform_submit(f){
	// 필수 체크박스
	// 조건들 확인

	// 회원아이디 검사
	if (f.w.value == "") {
		var msg = reg_mb_id_check();
		if (msg) {
			swal(msg);
			f.mb_id.focus();
			return false;
		}
	}

    if(f.w.value == "" && f.sns.value == "") {
        if (f.mb_password.value.length < 8) {
            swal('Please enter a password of at least 8 characters.');
            f.mb_password.focus();
            return false;
        }

        if (f.mb_password.value != f.mb_password_re.value) {
            swal('Passwords are not the same.');
            f.mb_password_re.focus();
            return false;
        }

        if (f.mb_password.value.length > 0) {
            if (f.mb_password_re.value.length < 8) {
                swal('Please enter a password of at least 8 characters.');
                f.mb_password_re.focus();
                return false;
            }
        }
    }

	// 이메일중복체크
	var msg = reg_mb_email_check();
	if (msg) {
		swal(msg);
		f.mb_email.focus();
		return false;
	}

    // 이메일 인증
    if(f.w.value == "" && f.sns.value == "") {
        email_certification_check();
        if (!certify) {
            swal('Please verify your email.');
            return false;
        }
    }

    if(f.mb_company_si.value == "") { // 국가 없을 시
        swal('Please enter your country.');
        f.mb_company_si.focus();
        return false;
    }

    if(f.mb_hp.value == "") { // 휴대폰 없을 시
        swal('Please enter your phone number.');
        f.mb_hp.focus();
        return false;
    }

    if(f.mb_company_name.value == "") { // 회사명 없을 시
        swal('Please enter your name of company.');
        f.mb_company_name.focus();
        return false;
    }

    if(f.mb_addr1.value == "") { // 주소 없을 시
        swal('Please enter your company address.');
        f.mb_addr1.focus();
        return false;
    }

    if(f.mb_zip.value == "") { // 주소 없을 시
        swal('Please enter your PLZ.');
        f.mb_zip.focus();
        return false;
    }

    if(f.mb_addr3.value == "") { // 주소 없을 시
        swal('Please enter your town/city.');
        f.mb_addr3.focus();
        return false;
    }

	// 필수필드 입력검사
	var obj = {};
	var submit = true;
	if (f.w.value == "") obj.reg_mb_id = "ID";
    if(f.sns.value == "") {
        obj.reg_mb_password = "Password";
        obj.reg_mb_password_re = "Confirm password";
    }
	obj.reg_mb_hp = "Mobile number";
    obj.reg_mb_company_name = "Name of company"
    obj.reg_mb_email = "E-mail";
	obj.reg_mb_addr1 = "Company adress";
	obj.reg_mb_addr2 = "Detailed address";
    obj.reg_mb_addr3 = "Town/City";
    obj.reg_mb_zip1 = "ZIP Code";

	for (var prop in obj) {
		var el = $('#'+prop);
		if (el.parents(".row").find(".status_ico").hasClass("err") && submit) {
            swal('Check your'  + obj[prop]);
			el.focus();
			submit = false;
		}
	}
	if (!submit) {
		return false;
	}

	/*if(f.mb_zip.value == "") { // 우편번호 없을 시
	    swal('Please enter your company address.');
	    return false;
    }*/

	if (f.w.value == "") {
        if($("#reg_req3").val()!="1"){
            swal("Check I am over 14 years old (required).");
            return false;
        }
		if($("#reg_req1").val()!="1"){
			swal("Check the agreement to the terms and conditions (required).");
			return false;
		}
		if($("#reg_req2").val()!="1"){
			swal("Check the agreement to the privacy policy (required).");
			return false;
		}
	}

	return true;
}

/* 다음주소 */
var element_layer = document.getElementById('layer');

function closeDaumPostcode() {
	element_layer.style.display = 'none';
}

function execDaumPostcode() {
	new daum.Postcode({
		oncomplete: function(data) {
			//console.log(data);
			document.getElementById("reg_mb_addr1").value = data.roadAddress;
			document.getElementById("reg_mb_zip").value = data.zonecode;
			console.log(data.zonecode);
			document.getElementById("reg_mb_addr2").focus();

			element_layer.style.display = 'none';

			// chk처리
			var state = $("#reg_mb_addr1").parents(".row").find(".status_ico");
			state.removeClass("err").addClass("pas");

            // 위도/경도
            var geocoder = new kakao.maps.services.Geocoder();
            var callback = function(result, status) {
                if (status === kakao.maps.services.Status.OK) {
                    console.log(result[0].y);
                    console.log(result[0].x);
                    document.getElementById("reg_mb_addr_lat").value = result[0].y; // 위도
                    document.getElementById("reg_mb_addr_lng").value = result[0].x; // 경도
                }
            };
            geocoder.addressSearch(data.roadAddress, callback);
		},
		width : '100%',
		height : '100%',
		maxSuggestItems : 5
	}).embed(element_layer);

	element_layer.style.display = 'block';
	initLayerPosition();
}

<?php /*
// 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
// resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
// 직접 element_layer의 top,left값을 수정해 주시면 됩니다. */ ?>
function initLayerPosition(){
	var width = Math.round($(window).width() * 0.9);
	var height = Math.round($(window).height() * 0.8);
	var borderWidth = 1;

	// 위에서 선언한 값들을 실제 element에 넣는다.
	element_layer.style.width = width + 'px';
	element_layer.style.height = height + 'px';
	element_layer.style.border = borderWidth + 'px solid';
	// 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
	element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
	element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
}

// 이메일 인증메일 발송
function email_certification() {
    // 이메일중복체크
    var msg = reg_mb_email_check();
    if (msg) {
        swal(msg);
        $('#reg_mb_email').val().focus();
        return false;
    }

    $.ajax({
        url : g5_bbs_url + "/ajax.email_certification.php",
        data : { reg_mb_email : $('#reg_mb_email').val() },
        type : 'POST',
        success : function(data) {
            if(data == '') {
                swal('A verification email has been sent.');
                $('.btn_hp').text('reCertify');
            }
            else if(data == 'fail1') {
                swal('This e-mail address is already in use.');
            }
            else if(data == 'success') { // 인증완료
                $('#reg_mb_email').parents(".row").find(".status_ico").removeClass("err").addClass("pas");
                $('#reg_mb_email').parents(".row").find(".error").html("Email verification is complete.");
                certify = true;
            }
            else if(data == 'fail2') { // 미인증
                certify = false;
            }
        },
        err : function(err) {
            swal(err.status);
        }
    });
}

// 이메일 인증체크
var certify = false;
function email_certification_check() {
    $.ajax({
        url : g5_bbs_url + "/ajax.email_certification_check.php",
        data : { reg_mb_email : $('#reg_mb_email').val() },
        type : 'POST',
        async : false,
        success : function(data) {
            if(data == 'success') { // 인증완료
                certify = true;
            }
            else if(data == 'fail') { // 미인증
                certify = false;
            }
        },
        err : function(err) {
            swal(err.status);
        }
    });
}
</script>
