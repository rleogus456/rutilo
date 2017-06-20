<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
<script src="<?php echo G5_JS_URL ?>/certify.js"></script>
<?php } ?>
<div id="main_event" class="owl-carousel">
	<?php
		for($i=0;$i<count($event_list);$i++){
			$thumb = get_list_thumbnail("event", $event_list[$i]['wr_id'], 1100, 464);
			if($thumb['src']) {
				$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
			}
			if($img_content){
	?>
		<div class="item"><a href="<?php echo G5_BBS_URL."/board.php?bo_table=event&wr_id=".$event_list[$i]['wr_id']; ?>"><?php echo $img_content; ?></a></div>
	<?php
			}
		}
		if(count($event_list)<=0){
	?>
		<div class="item"><a href="<?php echo G5_URL; ?>"><img src="<?php echo G5_IMG_URL."/slide06.jpg"; ?>" alt="" /></a></div>
		
	<?php
		}
	?>
	</div>
	
<div class="width-fixed">
       <section class="section03" style="<?php if(!$is_member){ echo "margin-bottom:0" ;}?>">
            <header style="<?php if($is_member){echo "border-bottom:3px solid #ddd";}?>">
                <?php if($is_member){
                ?>
                <div id="mypage_header">
                    <div class="mypageBoderT">
                        <div class="mypage">
                            <h1>마이페이지</h1>
                            <ul class="mypageSub">
                                <li class="cont">
                                    <a href="<?php echo G5_BBS_URL."/register_form.php?w=u"; ?>">개인정보수정</a>

                                    <ul class="subMenu menuLine">
                                        <!--<li><div class="menuLine"></div></li>-->
                                        <li><a href="<?php echo G5_URL."/page/mypage/orderHistory.php?tab=regform" ?>">주문내역</a></li>
                                        <li><a href="<?php echo G5_URL."/page/mypage/viewOrders.php?tab=regform" ?>">주문배송조회</a></li>
                                        <li><a href="<?php echo G5_URL."/page/mypage/viewReturn.php?tab=regform" ?>">반품/교환</a></li>
                                        <li><a href="<?php echo G5_URL; ?>">1:1 문의</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo G5_BBS_URL."/member_confirm.php?tab=form"?>" >회원탈퇴</a></li>
                            </ul>
                        </div>
                        <div class="mypageUser">
                            <div class="mypageImg"><img src="<?php echo G5_IMG_URL."/mypage_profile.jpg" ?>" alt="profile"></div>
                            <div>
                                <div class="mypageList">
                                    <h2><?php echo $member['mb_name']; ?> 님</h2>
                                    <p>회원님의 정보를 확인 할 수 있습니다.</p>
                                 </div>
                                 <ul class="mypageSubList1">
                                    <li class="cont tab"><a href="">마일리지 <span><?php echo $member['mb_point']; ?></span>P</a></li>
                                    <li class="last"><a href="<?php echo G5_BBS_URL."/logout.php"; ?>">로그아웃</a></li>
                                </ul>
                            </div>
                        </div>
                        </div>        
                    </div>
                 
                <?php }else{ ?>
                <h4><?php echo "회원가입"; ?></h4>
                <p><?php echo "루틸로에 오신것을 환영합니다."; ?></p>
                <?php }?>
            </header>
        </section>


	<section class="section01">	
		<div class="section01_content wrap">
			<div id="register_form">
				<form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="w" value="<?php echo $w ?>">
					<input type="hidden" name="url" value="<?php echo $urlencode ?>">
					<input type="hidden" name="agree" value="<?php echo $agree ?>">
					<input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
					<input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
					<input type="hidden" name="cert_no" value="">
					<input type="hidden" name="regid" id="regid" value="">
					<?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
					<?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
					<input type="hidden" name="mb_nick_default" value="<?php echo $member['mb_nick'] ?>">
					<input type="hidden" name="mb_nick" value="<?php echo $member['mb_nick'] ?>">
					<input type="hidden" name="mb_mailling" value="1" id="reg_mb_mailling"/>
					<input type="hidden" name="mb_sms" value="1" id="reg_mb_sms" />
					<?php }  ?>
					<div class="form_list01">
					    <h2 style="padding:30px">개인정보입력</h2>
					    <?php if($is_member){?>
					    <p class="mypageP" style="float:none;padding:0 30px 30px 30px;margin:0" ><span>> </span> <?php echo $member['mb_name'];?> 님의 회원가입 정보입니다. <br><span>> </span> 등록된 회원정보를 확인하시고 변경된 정보가 있으시면 수정해 주시기 바랍니다.</p>
					    <?php }?>	
					    <ul>
							<li>
								<div>
									<label for="reg_mb_id"><span>*</span> 아이디</label>
									<div>
										<input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> class="input01" minlength="3" maxlength="20"><input type="button" class="btn_submit" id="btnclick04" value="중복확인" style="background:#898989"/>
										<p id="msg_mb_id" class="inputMsg"><span>* 공백없는 3~15자의 영문/숫자를 조합하여 입력해야 합니다.</span> </p>									
									</div>								
								</div>
								
							</li>
							<?php if(!$is_member){ ?>
							<li>
								<div>
									<label for="reg_mb_password"><span>*</span> 비밀번호</label>
									<div>
									    <input type="password" name="mb_password" id="reg_mb_password" <?php echo $required ?> class="input01" minlength="8" maxlength="20">
									    <p id="pwCheck" class="inputMsg"><span>* 공백없는 8~16자의 영문/숫자를 조합하여 입력해야 합니다.</span> </p>		
								    </div>									
								</div>								
							</li>
							<li>
							    <div>
									<label for="reg_mb_password_re"><span>*</span> 비밀번호 확인</label>
									<div>
                                        <input type="password" name="mb_password_re" id="reg_mb_password_re" <?php echo $required ?> class="input01" minlength="3" maxlength="20">
                                        <p id="pwCheckRe" class="inputMsg"><span>* 비밀번호 확인을 위해 다시 한번 입력해 주세요.</span> </p>
									</div>									
								</div>
							</li>
							<?php } ?>
							<li>
								<div>
									<label for="reg_mb_id"><span>*</span> 성명</label>
									<div>
										<input type="text" name="mb_name" value="<?php echo $member['mb_name'] ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> class="input01" minlength="3" maxlength="20">
										<span id="msg_mb_name"></span>
										<p class="inputMsg"><span>* 한글 15자, 영문 30자까지 가능합니다.</span> </p>
									</div>
								</div>
							</li>
							<li>
								<div>
									<label for="reg_mb_hp"><span>*</span> 전화번호</label>
									<div>
										<input type="text" name="mb_hp" value="<?php echo get_text($member['mb_hp']) ?>" id="reg_mb_hp" <?php echo ($config['cf_req_hp'])?"required":""; ?> onkeyup="return number_only(this);" class="input01" maxlength="20">
									</div>
									<?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
										<input type="hidden" name="old_mb_hp" value="<?php echo get_text($member['mb_hp']) ?>">
									<?php } ?>
								</div>								
							</li>
							<li>
							    <div>
									<label for="reg_mb_email"><span>*</span> 이메일</label>
									<?php if ($config['cf_use_email_certify']) {  ?>
									<span class="frm_info">
										<?php if ($w=='') { echo "E-mail 로 발송된 내용을 확인한 후 인증하셔야 회원가입이 완료됩니다."; }  ?>
										<?php if ($w=='u') { echo "E-mail 주소를 변경하시면 다시 인증하셔야 합니다."; }  ?>
									</span>
									<?php }  ?>
									<input type="hidden" name="old_email" value="<?php echo $member['mb_email'] ?>">
									<div>
									<input type="text" name="mb_email" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="reg_mb_email" required class="input03" maxlength="100"> @ &nbsp;
<!--									<input type="text" name="mb_email2" value="<?php echo isset($member['mb_email2'])?$member['mb_email2']:''; ?>" id="reg_mb_email2" required class="input03" maxlength="100">-->
									<select class="input03" name="mb_email2" id="reg_mb_email2" style="padding:0px">
                                        <option value="">선택해주세요</option>
                                        <option value="naver.com">naver.com</option>
                                        <option value="hanmail.net">hanmail.net</option>
                                        <option value="hotmail.net">hotmail.net</option>
                                        <option value="gmail.com">gmail.com</option>
                                        <option value="nate.com">nate.com</option>
                                        <option value="yahoo.com">yahoo.com</option>
							         </select>
							         <input type="button" class="btn_submit" id="btnclick04" value="중복확인" style="background:#898989"/>
									</div>
								</div>
							</li>
							<li>
								<div>
									<label for="reg_mb_addr2"><span>*</span> 주소</label>
									<div>
										<input type="text" name="mb_addr1" value="<?php echo $member['mb_addr1'] ?>" id="reg_mb_addr1" <?php echo $required ?> <?php echo $readonly ?> class="postcodify_postcode5 input01" minlength="3" maxlength="20">
										<input type="button" class="btn_submit" id="postcodify_search_button" value="우편번호 찾기" style="background:#898989"><br>
										<input type="text" name="mb_addr2" value="<?php echo $member['mb_addr2'] ?>" id="reg_mb_addr2" <?php echo $required ?> <?php echo $readonly ?> class="postcodify_address input01 addrD" minlength="3" maxlength="100">
										<input type="text" name="mb_addr3" value="<?php echo $member['mb_addr3'] ?>" id="reg_mb_addr3" <?php echo $required ?> <?php echo $readonly ?> class="postcodify_details input01 addrD" minlength="3" maxlength="100" placeholder="상세주소">
										<span id="msg_mb_name"></span>
									</div>
								</div>
							</li>
						</ul>
						<p><span>* 는 필수입력사항입니다.</span></p>
                        <div style="clear:both"></div>
						<?php if(!$is_member) { ?>
                        <section id="fregister_term">
                            <h2 >전자상거래표준약관</h2>
                            <div class="agreement">제1조(목적)<br>이 약관은 ㈜SOL:RX이 운영하는 ㈜SOL:RX 멤버십 사이버몰(이하 “몰”이라 한다)에서 제공하는 인터넷 관련 서비스(이하 “서비스”라 한다)를 이용함에 있어 사이버몰과 이용자의 권리와 의무 및 책임사항을 규정함을 목적으로 합니다.&nbsp;<br>        ※ 「PC통신, 무선 등을 이용하는 전자거래에 대해서도 그 성질에 반하지 않는 한 이 약관을 준용합니다.」<br><br>제2조(정의)<br>① “몰” 이란 ㈜SOL:RX의 재화 또는 용역을 이용자에게 제공하기 위하여 컴퓨터등 정보통신 설비를 이용하여 재화 또는 용역을 거래할 수 있도록 설정한 가상의 영업장을 말하며, 아울러 사이버몰을 운영하는 사업자의 의미로도 사용합니다.<br>② “이용자”란 “몰”에 접속하여 이 약관에 따라 “몰”이 제공하는 서비스를 받는 ㈜SOL:RX 에이전트회원 및 비회원을 말합니다.<br>③ ‘㈜SOL:RX 에이전트회원(이하 “회원’라 한다’)라 함은 “몰”에 개인정보를 제공하여 회원등록을 하고 비즈니스키트를 구매한 자로서, “몰”의 정보를 지속적으로 제공 받으며, “몰”이 제공하는 서비스를 계속적으로 이용할 수 있는 자를 말합니다.<br><br>제3조(약관 등의 명시와 설명 및 개정)<br>① “몰”은 이 약관의 내용과 상호 및 대표자 성명, 영업소 소재지 주소(소비자의 불만을 처리할 수 있는 곳의 주소를 포함), 전화번호·모사전송번호·전자우편주소, 사업자등록번호, 통신판매업 신고번호, 개인정보관리책임자 등을 이용자가 쉽게 알 수 있도록 사이버몰의 초기 서비스화면(전면)에 게시합니다. 다만, 약관의 내용은 이용자가 연결화면을 통하여 볼 수 있도록 할 수 있습니다.<br>② “몰”은 이용자가 약관에 동의하기에 앞서 약관에 정하여져 있는 내용 중 청약철회·배송책임·환불조건 등과 같은 중요한 내용을 이용자가 이해할 수 있도록 별도의 연결화면 또는 팝업화면 등을 제공하여 이용자의 확인을 구하여야 합니다.<br>③ “몰”은 「전자상거래 등에서의 소비자보호에 관한 법률」, 「약관의 규제에 관한 법률」, 「전자문서 및 전자거래기본법」, 「전자금융거래법」, 「전자서명법」, 「정보통신망 이용촉진 및 정보보호 등에 관한 법률」, 「방문판매 등에 관한 법률」, 「소비자기본법」 등 관련 법을 위배하지 않는 범위에서 이 약관을 개정할 수 있습니다.<br>④ “몰”이 약관을 개정할 경우에는 적용일자 및 개정사유를 명시하여 현행약관과 함께 몰의 초기화면에 그 적용일자 7일 이전부터 적용일자 전일까지 공지합니다. 다만, 이용자에게 불리하게 약관내용을 변경하는 경우에는 최소한 30일 이상의 사전 유예기간을 두고 공지합니다. 이 경우 “몰”은 개정 전 내용과 개정 후 내용을 명확하게 비교하여 이용자가 알기 쉽도록 표시합니다.<br>⑤ “몰”이 약관을 개정할 경우에는 그 개정약관은 그 적용일자 이후에 체결되는 계약에만 적용되고 그 이전에 이미 체결된 계약에 대해서는 개정 전의 약관조항이 그대로 적용됩니다. 다만 이미 계약을 체결한 이용자가 개정약관 조항의 적용을 받기를 원하는 뜻을 제3항에 의한 개정약관의 공지기간 내에 “몰”에 송신하여 “몰”의 동의를 받은 경우에는 개정약관 조항이 적용됩니다.<br>⑥ 이 약관에서 정하지 아니한 사항과 이 약관의 해석에 관하여는 전자상거래 등에서의 소비자보호에 관한 법률, 약관의 규제 등에 관한 법률, 공정거래위원회가 정하는 「전자상거래 등에서의 소비자 보호지침」 및 관계법령 또는 상관례에 따릅니다.<br><br>제4조(서비스의 제공 및 변경)<br>① “몰”은 다음과 같은 업무를 수행합니다.1. 재화 또는 용역에 대한 정보 제공 및 구매계약의 체결2. 구매계약이 체결된 재화 또는 용역의 배송3. 기타 “몰”이 정하는 업무<br>② “몰”은 재화 또는 용역의 품절 또는 기술적 사양의 변경 등의 경우에는 장차 체결되는 계약에 의해 제공할 재화 또는 용역의 내용을 변경할 수 있습니다. 이 경우에는 변경된 재화 또는 용역의 내용 및 제공일자를 명시하여 현재의 재화 또는 용역의 내용을 게시한 곳에 즉시 공지합니다.<br>③ “몰”이 제공하기로 이용자와 계약을 체결한 서비스의 내용을 재화 등의 품절 또는 기술적 사양의 변경 등의 사유로 변경할 경우에는 그 사유를 이용자에게 통지 가능한 주소로 즉시 통지합니다.<br>④ 전항의 경우 “몰”은 이로 인하여 이용자가 입은 손해를 배상합니다. 다만, “몰”이 고의 또는 과실이 없음을 입증하는 경우에는 그러하지 아니합니다.<br><br>제5조(서비스의 중단)<br>① “몰”은 컴퓨터 등 정보통신설비의 보수점검·교체 및 고장, 통신의 두절 등의 사유가 발생한 경우에는 서비스의 제공을 일시적으로 중단할 수 있습니다.<br>② “몰”은 제1항의 사유로 서비스의 제공이 일시적으로 중단됨으로 인하여 이용자 또는 제 3자가 입은 손해에 대하여 배상합니다. 단, “몰”이 고의 또는 과실이 없음을 입증하는 경우에는 그러하지 아니합니다.<br>③ 사업종목의 전환, 사업의 포기, 업체 간의 통합 등의 이유로 서비스를 제공할 수 없게 되는 경우에는 “몰”은 제8조에 정한 방법으로 이용자에게 통지하고 당초 “몰”에서 제시한 조건에 따라 소비자에게 보상합니다. 다만, “몰”이 보상기준 등을 고지하지 아니한 경우에는 이용자들의 마일리지 또는 적립금 등을 “몰”에서 통용되는 통화가치에 상응하는 현물 또는 현금으로 이용자에게 지급합니다.<br><br>제6조(회원 가입)<br>① 이용자는 “몰”이 정한 가입 양식에 따라 회원정보를 기입한 후 이 약관에 동의한다는 의사표시를 함으로서 회원가입을 신청합니다.<br>② “몰”은 제1항과 같이 회원으로 가입할 것을 신청한 이용자 중 다음 각호에 해당하지 않는 한 회원으로 등록합니다.&nbsp;<br>    1. 가입신청자가 이 약관 제7조 제3항에 의하여 이전에 회원자격을 상실한 적이 있는 경우, 다만 제7조 제3항에 의한 회원자격 상실 후 3년이 경과한 자로서 “몰”의 회원재가입 승낙을 얻은 경우에는 예외로 합니다.<br>    2. 등록 내용에 허위, 기재누락, 오기가 있는 경우<br>    3. 기타 회원으로 등록하는 것이 “몰”의 기술상 현저히 지장이 있다고 판단되는 경우<br>③ 회원가입계약의 성립시기는 “몰”의 승낙이 회원에게 도달한 시점으로 합니다.<br>④ 회원은 제15조 제1항에 의한 등록사항에 변경이 있는 경우, 즉시 전자우편, 기타 방법으로 “몰”에 대하여 그 변경사항을 알려야 합니다.<br>⑤ 회원탈퇴 후 재가입시 최종 주문일로부터 6개월이 경과하여야 회원으로 재가입을 할 수 있습니다.<br><br>제7조(회원탈퇴 및 자격 상실 등)<br>① 회원은 “몰”에 언제든지 탈퇴를 요청할 수 있으며 “몰”은 즉시 회원탈퇴를 처리합니다.<br>② 회원이 다음 각호의 사유에 해당하는 경우, “몰”은 회원자격을 제한 및 정지시킬 수 있습니다.&nbsp;<br>    1. 가입 신청시에 허위 내용을 등록한 경우<br>    2. “몰”을 이용하여 구입한 재화나 용역 등의 대금, 기타 “몰”이용에 관련하여 회원이 부담하는 채무를 기일에 지급하지 않는 경우<br>    3. 다른 사람의 “몰” 이용을 방해하거나 그 정보를 도용하는 등 전자거래질서를 위협하는 경우<br>    4. “몰”을 이용하여 법령과 이 약관이 금지하거나 공서양속에 반하는 행위를 하는 경우<br>③ “몰”이 회원자격을 제한 또는 정지시킨 후, 동일한 행위가 2회이상 반복되거나 30일이내에 그 사유가 시정되지 아니하는 경우 “몰”은 회원자격을 상실시킬 수 있습니다.<br>④ “몰”이 회원자격을 상실시키는 경우에는 회원등록을 말소합니다. 이 경우 회원에게 이를 통지하고, 회원등록 말소전에 일정기간(30일)을 정하여 소명할 기회를 부여합니다.<br><br>제8조(회원에 대한 통지)<br>① “몰”이 회원에게 대한 통지를 하는 경우, 회원은 “몰”에 제출한 전자우편 주소로 할 수 있습니다.<br>② “몰”은 불특정다수 회원에 대한 통지의 경우 1주일이상 “몰” 게시판에 게시함으로써 개별통지에 갈음할 수 있습니다. 다만, 회원본인의 거래와 관련하여 중대한 영향을 미치는 사항에 대하여는 개별통지를 합니다.<br><br>제9조(구매신청)<br>① “몰”이용자는 “몰”상에서 다음 또는 이와 유사한 방법에 의하여 구매를 신청하며, “몰”은 이용자가 구매신청을 함에 있어서 다음의 각 내용을 알기 쉽게 제공하여야 합니다.<br>    1. 재화 등의 검색 및 선택<br>    2. 받는 사람의 성명, 주소, 전화번호, 전자우편주소(또는 이동전화번호) 등의 입력<br>    3. 약관내용, 청약철회권이 제한되는 서비스, 배송료, 설치비 등의 비용부담과 관련한 내용에 대한 확인<br>    4. 이 약관에 동의하고 위 3. 호의 사항을 확인하거나 거부하는 표시(예, 마우스 클릭)<br>    5. 재화 등의 구매신청 및 이에 관한 확인 또는 “몰”의 확인에 대한 동의6. 결제방법의 선택<br>② “몰”이 제 3자에게 구매자 개인정보를 제공·위탁할 필요가 있는 경우 실제 구매신청 시 구매자의 동의를 받아야 하며, 회원가입 시 미리 포괄적으로 동의를 받지 않습니다. 이 때 “몰”은 제공되는 개인정보 항목, 제공받는 자, 제공받는 자의 개인정보 이용 목적 및 보유·이용 기간 등을 구매자에게 명시하여야 합니다. 다만 「정보통신망이용촉진 및 정보보호 등에 관한 법률」 제25조 제1항에 의한 개인정보 취급위탁의 경우 등 관련 법령에 달리 정함이 있는 경우에는 그에 따릅니다.<br><br>제10조(계약의 성립)<br>① “몰”은 제9조와 같은 구매신청에 대하여 다음 각 호에 해당하면 승낙하지 않을 수 있습니다. 또한 “몰”은 미성년자의 가입이 불가하므로, 미성년자가 가입시 회원자격이 상실되며, 계약은 취소될 수 있습니다.<br>    1. 신청 내용에 허위, 기재누락, 오기가 있는 경우<br>    2. 기타 구매신청에 승낙하는 것이 “몰” 기술상 현저히 지장이 있다고 판단하는 경우<br>② “몰”의 승낙이 제12조 제1항의 수신확인통지형태로 이용자에게 도달한 시점에 계약이 성립한 것으로 봅니다.<br>③ “몰”의 승낙의 의사표시에는 이용자의 구매 신청에 대한 확인 및 판매가능 여부, 구매신청의 정정 취소 등에 관한 정보 등을 포함하여야 합니다.<br><br>제11조(지급방법)“몰”에서 구매한 재화 또는 용역에 대한 대금지급방법은 다음 각 호의 방법 중 가용한 방법으로 할 수 있습니다. 단, “몰”은 이용자의 지급방법에 대하여 재화 등의 대금에 어떠한 명목의 수수료도 추가하여 징수할 수 없습니다.<br>    1. 폰뱅킹, 인터넷뱅킹, 메일뱅킹 등의 각종 계좌이체<br>    2. 선불카드, 직불카드, 신용카드 등의 각종 카드 결제<br>    3. 온라인무통장입금<br>    4. 전자화폐에 의한 결제<br>    5. 수령 시 대금지급<br>    6. 마일리지 등 “몰”이 지급한 포인트에 의한 결제<br>    7. “몰”과 계약을 맺었거나 “몰”이 인정한 상품권에 의한 결제<br>    8. 기타 전자적 지급 방법에 의한 대금 지급 등<br><br>제12조(수신확인, 구매신청 변경 및 취소)<br>① “몰”은 이용자의 구매신청이 있는 경우 “몰”의 본인주문검색에서 확인이 가능합니다.<br>② 수신확인통지를 받은 이용자는 의사표시의 불일치 등이 있는 경우에는 수신확인통지를 받은 후 즉시 구매신청 변경 및 취소를 요청할 수 있고 “몰”은 배송 전에 이용자의 요청이 있는 경우에는 지체 없이 그 요청에 따라 처리하여야 합니다. 다만 이미 대금을 지불한 경우에는 제15조의 청약철회 등에 관한 규정에 따릅니다.<br><br>제13조(재화 등의 공급)<br>① “몰”은 이용자와 재화 등의 공급시기에 관하여 별도의 약정이 없는 이상, 이용자가 청약을 한 날부터 7일 이내에 재화 등을 배송할 수 있도록 주문제작, 포장 등 기타의 필요한 조치를 취합니다. 다만, “몰”이 이미 재화 등의 대금의 전부 또는 일부를 받은 경우에는 대금의 전부 또는 일부를 받은 날부터 3영업일 이내에 조치를 취합니다. 이때 “몰”은 이용자가 재화 등의 공급 절차 및 진행 사항을 확인할 수 있도록 적절한 조치를 합니다.<br>② “몰”은 이용자가 구매한 재화에 대해 배송수단, 수단별 배송비용 부담자, 수단별 배송기간 등을 명시합니다. 만약 “몰”이 약정 배송기간을 초과한 경우에는 그로 인한 이용자의 손해를 배상하여야 합니다. 다만 “몰”이 고의·과실이 없음을 입증한 경우에는 그러하지 아니합니다.<br><br>제14조(환급)“몰”은 이용자가 구매신청한 재화 등이 품절 등의 사유로 인도 또는 제공을 할 수 없을 때에는 지체 없이 그 사유를 이용자에게 통지하고 사전에 재화 등의 대금을 받은 경우에는 대금을 받은날로부터 3영업일 이내에 환급하거나 환급에 필요한 조치를 취합니다.<br><br>제15조(청약철회 등)<br>① “몰”과 재화 등의 구매에 관한 계약을 체결한 이용자는 「방문판매 등에 관한 법률」 및 「전자상거래 등에서의 소비자보호에 관한 법률」에 따라 청약철회를 할 수 있습니다. 해당 법률에 따르면, 계약내용에 관한 서면을 받은 날(그 서면을 받은 때보다 재화 등의 공급이 늦게 이루어진 경우에는 재화 등을 공급받거나 재화 등의 공급이 시작된 날을 말합니다)로부터 회원은 3개월, 소비자는 14일 이내에는 청약의 철회를 할 수 있습니다.<br>② 이용자는 재화 등을 배송 받은 경우 다음 각 호의 1에 해당하는 경우에는 반품 및 교환을 할 수 없습니다.&nbsp;<br>    1. 이용자에게 책임 있는 사유로 재화 등이 멸실 또는 훼손된 경우(다만, 재화 등의 내용을 확인하기 위하여 포장 등을 훼손한 경우에는 청약철회를 할 수 있습니다.)<br>    2. 이용자의 사용 또는 일부 소비에 의하여 재화 등의 가치가 현저히 감소한 경우<br>    3. 시간의 경과에 의하여 재판매가 곤란할 정도로 재화 등의 가치가 현저히 감소한 경우4. 같은 성능을 지닌 재화 등으로 복제가 가능한 경우 그 원본인 재화 등의 포장을 훼손한 경우5. 회원의 경우, 재고 보유에 관하여 다단계판매업자에게 거짓으로 보고하는 등의 방법으로 과다하게 재화 등의 재고를 보유한 경우<br>③ 제2항 제2호 내지 제4호의 경우에 “몰”이 사전에 청약철회 등이 제한되는 사실을 소비자가 쉽게 알 수 있는 곳에 명기하거나 시용상품을 제공하는 등의 조치를 하지 않았다면 이용자의 청약철회 등이 제한되지 않습니다.<br>④ 이용자는 제1항 및 제2항의 규정에 불구하고 재화 등의 내용이 표시·광고 내용과 다르거나 계약내용과 다르게 이행된 때에는 당해 재화 등을 공급받은 날부터 3개월 이내에 청약철회 등을 할 수 있습니다.<br><br>제16조(청약철회 등의 효과)<br>① “몰”은 이용자로부터 재화 등을 반환 받은 경우 3영업일 이내에 이미 지급받은 재화 등의 대금을 환급합니다. 이 경우 “몰”이 이용자에게 재화 등의 환급을 지연한 때에는 그 지연기간에 대하여 「방문판매 등에 관한 법률」 및 「전자상거래 등에서의 소비자보호에 관한 법률 시행령」에서 정하는 지연이자율을 곱하여 산정한 지연이자를 지급합니다.<br>② “몰”은 위 대금을 환급함에 있어서 이용자가 신용카드 또는 전자화폐 등의 결제수단으로 재화 등의 대금을 지급한 때에는 지체 없이 당해 결제수단을 제공한 사업자로 하여금 재화 등의 대금의 청구를 정지 또는 취소하도록 요청합니다.<br>③ “몰”은 이용자에게 청약철회 등을 이유로 위약금 또는 손해배상을 청구하지 않습니다. 다만 재화 등의 내용이 표시·광고 내용과 다르거나 계약내용과 다르게 이행되어 청약철회 등을 하는 경우 재화 등의 반환에 필요한 비용은 “몰”이 부담합니다.<br>④ 이용자가 재화 등을 제공받을 때 발송비를 부담한 경우에 “몰”은 청약철회 시 그 비용을 누가 부담하는지를 이용자가 알기 쉽도록 명확하게 표시합니다<br><br>제17조(개인정보보호)<br>① “몰”은 이용자의 개인정보 수집 시 서비스제공을 위하여 필요한 범위에서 최소한의 개인정보를 수집합니다.<br>② “몰”은 회원가입 시 구매계약이행에 필요한 정보를 미리 수집하지 않습니다. 다만, 관련 법령상 의무이행을 위하여 구매계약 이전에 본인확인이 필요한 경우로서 최소한의 특정 개인정보를 수집하는 경우에는 그러하지 아니합니다.<br>③ “몰”은 이용자의 개인정보를 수집·이용하는 때에는 당해 이용자에게 그 목적을 고지하고 동의를 받습니다.<br>④ “몰”은 수집된 개인정보를 고지한 목적 외의 용도로 이용할 수 없으며, 새로운 이용목적이 발생한 경우 또는 제 3자에게 제공하는 경우에는 이용·제공단계에서 당해 이용자에게 그 목적을 고지하고 동의를 받습니다. 다만, 관련 법령에 달리 정함이 있는 경우에는 예외로 합니다.<br>⑤ “몰”이 제3항과 제4항에 의해 이용자의 동의를 받아야 하는 경우에는 개인정보관리 책임자의 신원(소속, 성명 및 전화번호, 기타 연락처), 정보의 수집목적 및 이용목적, 제 3자에 대한 정보제공 관련사항(제공받은 자, 제공목적 및 제공할 정보의 내용) 등 「정보통신망 이용촉진 및 정보보호 등에 관한 법률」 제22조 제2항이 규정한 사항을 미리 명시하거나 고지해야 하며 이용자는 언제든지 이 동의를 철회할 수 있습니다.<br> ⑥ 이용자는 언제든지 “몰”이 가지고 있는 자신의 개인정보에 대해 열람 및 오류정정을 요구할 수 있으며 “몰”은 이에 대해 지체 없이 필요한 조치를 취할 의무를 집니다. 이용자가 오류의 정정을 요구한 경우에는 “몰”은 그 오류를 정정할 때까지 당해 개인정보를 이용하지 않습니다.<br>⑦ “몰”은 개인정보 보호를 위하여 이용자의 개인정보를 취급하는 자를 최소한으로 제한하여야 하며 신용카드, 은행계좌 등을 포함한 이용자의 개인정보의 분실, 도난, 유출, 동의 없는 제 3자 제공, 변조 등으로 인한 이용자의 손해에 대하여 모든 책임을 집니다.<br>⑧ “몰” 또는 그로부터 개인정보를 제공받은 제 3자는 개인정보의 수집목적 또는 제공받은 목적을 달성한 때에는 당해 개인정보를 지체 없이 파기합니다.⑨ “몰”은 개인정보의 수집·이용·제공에 관한 동의란을 미리 선택한 것으로 설정해두지 않습니다. 또한 개인정보의 수집·이용·제공에 관한 이용자의 동의거절 시 제한되는 서비스를 구체적으로 명시하고, 필수수집항목이 아닌 개인정보의 수집·이용·제공에 관한 이용자의 동의 거절을 이유로 회원가입 등 서비스 제공을 제한하거나 거절하지 않습니다.<br><br>제18조(“몰”의 의무)<br>① “몰”은 법령과 이 약관이 금지하거나 공서양속에 반하는 행위를 하지 않으며 이 약관이 정하는 바에 따라 지속적이고, 안정적으로 재화·용역을 제공하는데 최선을 다하여야 합니다.<br>② “몰”은 이용자가 안전하게 인터넷 서비스를 이용할 수 있도록 이용자의 개인정보(신용정보 포함)보호를 위한 보안 시스템을 갖추어야 합니다.<br>③ “몰”이 상품이나 용역에 대하여 「표시·광고의 공정화에 관한 법률」 제3조 소정의 부당한 표시·광고행위를 함으로써 이용자가 손해를 입은 때에는 이를 배상할 책임을 집니다.④ “몰”은 이용자가 원하지 않는 영리목적의 광고성 전자우편을 발송하지 않습니다.<br><br>제19조(회원의 ID 및 비밀번호에 대한 의무)<br>① 제17조의 경우를 제외한 ID와 비밀번호에 관한 관리책임은 회원에게 있습니다.② 회원은 자신의 ID 및 비밀번호를 제 3자에게 이용하게 해서는 안됩니다.③ 회원이 자신의 ID 및 비밀번호를 도난 당하거나 제 3자가 사용하고 있음을 인지한 경우에는 바로 “몰”에 통보하고 “몰”의 안내가 있는 경우에는 그에 따라야 합니다.<br><br>제20조(이용자의 의무)이용자는 다음 행위를 하여서는 안 됩니다.<br>1. 신청 또는 변경 시 허위 내용의 등록<br>2. 타인의 정보 도용<br>3. “몰”에 게시된 정보의 변경<br>4. “몰”이 정한 정보 이외의 정보(컴퓨터 프로그램 등) 등의 송신 또는 게시<br>5. “몰” 기타 제 3자의 저작권 등 지적재산권에 대한 침해<br>6. “몰” 기타 제 3자의 명예를 손상시키거나 업무를 방해하는 행위<br>7. 외설 또는 폭력적인 메시지, 화상, 음성, 기타 공서양속에 반하는 정보를 몰에 공개 또는 게시하는 행위<br><br>제21조(저작권의 귀속 및 이용제한)<br>① “몰”이 작성한 저작물에 대한 저작권 기타 지적 재산권은 “몰” 귀속합니다.<br>② 이용자는 “몰”을 이용함으로써 얻은 정보 중 “몰”에게 지적재산권이 귀속된 정보를 “몰”의 사전 승낙 없이 복제, 송신, 출판, 배포, 방송, 기타 방법에 의하여 영리목적으로 이용하거나 제 3자에게 이용하게 하여서는 안됩니다.<br>③ “몰”은 약정에 따라 이용자에게 귀속된 저작권을 사용하는 경우 당해 이용자에게 통보하여야 합니다.<br><br>제22조(분쟁해결)<br>① “몰”은 이용자가 제기하는 정당한 의견이나 불만을 반영하고 그 피해를 보상처리하기 위하여 피해보상처리기구를 설치, 운영합니다.② “몰”은 이용자로부터 제출되는 불만사항 및 의견은 우선적으로 그 사항을 처리합니다. 다만, 신속한 처리가 곤란한 경우에는 이용자에게 그 사유와 처리일정을 즉시 통보해 드립니다.
                            <br>③ “몰”과 이용자 간에 발생한 전자상거래 분쟁과 관련하여 이용자의 피해구제신청이 있는 경우에는 공정거래위원회 또는 시·도지사가 의뢰하는 분쟁조정기관의 조정에 따를 수 있습니다.<br><br>제23조(재판권 및 준거법)<br>① “몰”과 이용자 간에 발생한 전자상거래 분쟁과 관련하여 서울중앙지방법원을 전속 관할로 합니다.<br>② “몰”과 이용자 간에 제기된 전자상거래 소송에는 한국법을 적용합니다.<br><br>
                            </div>
                        </section>
                        <?php } ?>
					
					<?php if(!$w){ ?><p><input type="checkbox" name="agree" id="agree" class="check01" /><label for="agree" class="check01_label"></label><label for="agree"><a href="<?php echo G5_URL."/page/guide/agreement.php"; ?>">이용약관</a>과 <a href="<?php echo G5_URL."/page/guide/privacy.php";?>">개인정보취급방침</a>에 동의합니다.</label></p><?php } ?>
					<div class="btn_group01">						
						<input type="submit" value="<?php echo $w==''?'회원가입':'수정하기'; ?>" class="bg_darkred btn color_white grid_30" accesskey="s">
					</div>
					<?php if($is_member) {?>
                    <div class="form_list01">
					    <h2>비밀번호변경</h2>					  
					    <p class="mypageP"><span>> </span>새로운 비밀번호를 입력해 주세요. <br>
					    <span>> </span>비밀번호는 영문(대소문자구분), 숫자 특수문자(~!@#$%^&*())를 혼합하여 사용하여야 하며 두 종류 혼합 사용시 10자리 이상, 세종류 이상 혼합사용시 9자리 이상 입력해야합니다. <br>
					    <span>> </span>개인정보와 관련된 숫자 등 다른 사람이 알아낼 수 있는 비밀번호는 사용하지 마세요.</p>					    
						<ul class="borderFirst">					
						<ul style="border-top:none">											
							<li>
								<div>
									<label for="reg_mb_password"><span>*</span> 비밀번호</label>
									<div>
									    <input type="password" name="mb_password" id="reg_mb_password" <?php echo $required ?> class="input01" minlength="8" maxlength="20">
									    <p id="pwCheck" class="inputMsg"><span>* 공백없는 8~16자의 영문/숫자를 조합하여 입력해야 합니다.</span> </p>		
								    </div>									
								</div>								
							</li>
							<li>
							    <div>
									<label for="reg_mb_password_re"><span>*</span> 비밀번호 확인</label>
									<div>
                                        <input type="password" name="mb_password_re" id="reg_mb_password_re" <?php echo $required ?> class="input01" minlength="3" maxlength="20">
                                        <p id="pwCheckRe" class="inputMsg"><span>* 비밀번호 확인을 위해 다시 한번 입력해 주세요.</span> </p>
									</div>									
								</div>
							</li>				
						</ul>
                        </ul>
						<div class="btn_group01">								
					         <input type="submit" value="<?php echo '변경하기'; ?>" class="btn color_white grid_30" accesskey="s"style="background:#d81a1a">
						</div>
                    </div>
                    <?php } ?>
				</form>			
            </div>
		</div>		        
	</section>
</div>

<script>
//$("#mb_newpassword1").keyup(function() {
//		var pw = $("#mb_newpassword1").val();
//		var reg_pw = /^(?=.*[a-zA-Z])(?=.*[0-9]).{4,20}$/;
//		if (!reg_pw.test($("#mb_newpassword1").val())) {
//			var data = "숫자, 영문포함 4~20자"; $(".pwCheck").html(data); return false;
//		} else { var data = "사용가능합니다."; $(".pwCheck").html(data); }
//		if ($("#mb_newpassword1").val() != $("#mb_newpassword2").val()) {
//			var data = "비밀번호가 다릅니다."; $(".pwCheckRe").html(data); return false;
//		} else { var data = "확인되었습니다."; $(".pwCheckRe").html(data); }
//	});
//	$("#mb_newpassword2").keyup(function() {
//		if($("#mb_newpassword1").val() != $("#mb_newpassword2").val()){
//			var data = "비밀번호가 다릅니다."; $(".pwCheckRe").html(data); return false;
//		} else { var data = "확인되었습니다."; $(".pwCheckRe").html(data); }
//		if(!reg_pw.test($("#mb_newpassword1").val())){ 
//			var data = "숫자, 영문포함 4~20자"; $(".pwCheck").html(data); return false;
//		} else { var data = "사용가능합니다."; $(".pwCheck").html(data); }
//	});
$(document).ready(function(){    
	$("#reg_mb_password").keyup(function() {
		var pw = $("#reg_mb_password").val();
		var reg_pw = /^(?=.*[a-zA-Z])(?=.*[0-9]).{8,16}$/;
		if (!reg_pw.test($("#reg_mb_password").val())) {
			var data = "숫자, 영문포함 8~16자로 입력해야 합니다"; $("#pwCheck").html(data); return false;
		} else { var data = "사용가능합니다."; $("#pwCheck").html(data); }
		if($("#reg_mb_password").val() != $("#reg_mb_password_re").val()){
			var data = "비밀번호가 다릅니다."; $("#pwCheckRe").html(data); return false;
		} else { var data = "확인되었습니다."; $("#pwCheckRe").html(data); }
	});
	$("#reg_mb_password_re").keyup(function() {
		if ($("#reg_mb_password").val() != $("#reg_mb_password_re").val()) {
			var data = "숫자, 영문포함 8~16자로 입력해야 합니다"; $("#pwCheckRe").html(data); return false;
		} else { var data = "확인되었습니다."; $("#pwCheckRe").html(data); }
	});
}); 
$("#btnclick04").click(function(){
   var id = $("#reg_mb_id").val();
		$.ajax({
			url:"<?=G5_URL?>/skin/member/basic/AjaxNameCheck.php",
			data:{id:id}, method:"POST", type:false
		}).done(function(data){ $("#msg_mb_id").html(data); $("#msg_mb_id").val("Y"); });
});
$(function() 
  { 
    $("#postcodify_search_button").postcodifyPopUp(); 
  });
$(function(){
	//getRegid
	try{
		var regId = window.android.getRegid();
		console.log(regId);
		$("#regid").val(regId);
	}catch(err){
		var regId = undefined;
		console.log(err);
	}
});
$(function() {
	$("#reg_zip_find").css("display", "inline-block");

	<?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
	// 아이핀인증
	$("#win_ipin_cert").click(function() {
		if(!cert_confirm())
			return false;

		var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php";
		certify_win_open('kcb-ipin', url);
		return;
	});

	<?php } ?>
	<?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
	// 휴대폰인증
	$("#win_hp_cert").click(function() {
		if(!cert_confirm())
			return false;

		<?php
		switch($config['cf_cert_hp']) {
			case 'kcb':
				$cert_url = G5_OKNAME_URL.'/hpcert1.php';
				$cert_type = 'kcb-hp';
				break;
			case 'kcp':
				$cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
				$cert_type = 'kcp-hp';
				break;
			case 'lg':
				$cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
				$cert_type = 'lg-hp';
				break;
			default:
				echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
				echo 'return false;';
				break;
		}
		?>

		certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>");
		return;
	});
	<?php } ?>
});

// submit 최종 폼체크
function fregisterform_submit(f)
{
	// 회원아이디 검사
	if (f.w.value == "") {
		var msg = reg_mb_id_check();
		if (msg) {
			alert(msg);
			f.mb_id.select();
			return false;
		}
	}

	if (f.w.value == "") {
		if (f.mb_password.value.length < 3) {
			alert("비밀번호를 3글자 이상 입력하십시오.");
			f.mb_password.focus();
			return false;
		}
	}

	if (f.mb_password.value != f.mb_password_re.value) {
		alert("비밀번호가 같지 않습니다.");
		f.mb_password_re.focus();
		return false;
	}

	if (f.mb_password.value.length > 0) {
		if (f.mb_password_re.value.length < 3) {
			alert("비밀번호를 3글자 이상 입력하십시오.");
			f.mb_password_re.focus();
			return false;
		}
	}

	// 이름 검사
	if (f.w.value=="") {
		if (f.mb_name.value.length < 1) {
			alert("이름을 입력하십시오.");
			f.mb_name.focus();
			return false;
		}
		/*
		var pattern = /([^가-힣\x20])/i;
		if (pattern.test(f.mb_name.value)) {
			alert("이름은 한글로 입력하십시오.");
			f.mb_name.select();
			return false;
		}
		*/
		
	}

	<?php if($w == '' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
	// 본인확인 체크
	if(f.cert_no.value=="") {
		alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
		return false;
	}
	<?php } ?>
	/*
	// 닉네임 검사
	if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
		var msg = reg_mb_nick_check();
		if (msg) {
			alert(msg);
			f.reg_mb_nick.select();
			return false;
		}
	}
*/
	// E-mail 검사
//	if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
//		var msg = reg_mb_email_check();
//		if (msg) {
//			alert(msg);
//			f.reg_mb_email.select();
//			return false;
//		}
//	}

	<?php if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) {  ?>
	// 휴대폰번호 체크
	var msg = reg_mb_hp_check();
	if (msg) {
		alert(msg);
		f.reg_mb_hp.select();
		return false;
	}
	<?php } ?>

	if (typeof f.mb_icon != "undefined") {
		if (f.mb_icon.value) {
			if (!f.mb_icon.value.toLowerCase().match(/.(gif)$/i)) {
				alert("회원아이콘이 gif 파일이 아닙니다.");
				f.mb_icon.focus();
				return false;
			}
		}
	}

	if (typeof(f.mb_recommend) != "undefined" && f.mb_recommend.value) {
		if (f.mb_id.value == f.mb_recommend.value) {
			alert("본인을 추천할 수 없습니다.");
			f.mb_recommend.focus();
			return false;
		}

		var msg = reg_mb_recommend_check();
		if (msg) {
			alert(msg);
			f.mb_recommend.select();
			return false;
		}
	}

	<?php echo chk_captcha_js();  ?>

	document.getElementById("btn_submit").disabled = "disabled";

	return true;
}
  
</script>
<!-- } 회원정보 입력/수정 끝 -->