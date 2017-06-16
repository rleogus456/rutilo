<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 하단 파일 경로 지정 : 이 코드는 가능한 삭제하지 마십시오.
if ($config['cf_include_tail'] && is_file(G5_PATH.'/'.$config['cf_include_tail'])) {
    include_once(G5_PATH.'/'.$config['cf_include_tail']);
    return; // 이 코드의 아래는 실행을 하지 않습니다.
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/tail.php');
    return;
}
$best_tel=sql_fetch("select * from `best_tel`");
?>
</div>
<footer id="footer" class="<?php echo $main?"":"sub_footer"; ?>">
    <div class="backRed2">
        <div class="width-fixed sitemap">
            <ul class="footerMenu">
                <li class="first">
                    <a href="<?php echo G5_URL."/page/intro.php?tab=intro"; ?>">회사소개</a>
                </li>
                <li>
                    <a href="<?php echo G5_URL."/page/product.php?tab=product"; ?>">제품소개</a>
                    <ul>
                        <li><a href="<?php echo G5_URL."/page/product.php?tab=product"; ?>">차량</a></li>
                        <li><a href="<?php echo G5_URL."/page/product.php?tab=product"; ?>">선박</a></li>
                        <li><a href="<?php echo G5_URL."/page/product.php?tab=product"; ?>">집</a></li>
                        <li><a href="<?php echo G5_URL."/page/product.php?tab=product"; ?>">의류</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo G5_URL."/page/construction.php?tab=construction"; ?>">시공방법</a>
                </li>
                <li>
                    <a href="<?php echo G5_URL."/page/detailSevice.php?tab=detailSevice"; ?>">디테일링 서비스</a>
                </li>
                <li>
                    <a href="<?php echo G5_URL."/page/trainingCenter.php?tab=trainingCenter"; ?>">트레이닝 센터</a>
                    <ul>
                        <li><a href="<?php echo G5_URL."/page/trainingCenter.php?tab=trainingCenter"; ?>">위치 지도</a></li>
                        <li><a href="<?=G5_URL?>/page/trainer.php?tab=trainingCenter">트레이너</a></li>
                        <li><a href="<?=G5_URL?>/page/trainingCourse.php?tab=trainingCenter">트레이닝 과정</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo G5_URL."/page/franchisee/franchisee.php?tab=franchisee"; ?>">루틸로 협력점</a>
                    <ul>
                        <li><a href="<?php echo G5_URL."/page/franchisee/franchisee.php?tab=franchisee"; ?>">가맹문의</a></li>
                        <li><a href="<?=G5_URL?>/page/franchisee/franchiseeStatus.php?tab=franchisee">가맹현황</a></li>
                    </ul>
                </li>
                <li class="last">
                    <a href="<?=G5_BBS_URL?>/board.php?bo_table=questions">문의게시판</a>
                </li>
            </ul>
        </div>
        <div class="width-fixed footerArea">
            <h1></h1>
            <p>
                상호 : 루틸로&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;대표 : 임상호&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;충청북도 청주시 2순환로 1480번길 24&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 고객상담센터 TEL : 070-7763-4989 / 070-7795-7989 &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; FAX : 043-211-4987<br>
                E-Mail : goldleine@naver.com &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;사업자등록번호 : 202-01-92253 &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;통신판매업 신고번호 : 2015-충북청주-0727 &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;개인정보관리 책임자 : goldleine@naver.com <br>
                Copyrightⓒ RUTILO.2017 All rights reserved.
            </p>
            <ul>
                <li class="first"><a href="<?php echo G5_URL."/page/guide/agreement.php"; ?>">개인정보취급방침</a></li>
                <li><a href="<?php echo G5_URL."/page/guide/privacy.php"; ?>">이용약관</a></li>
                <li class="last"><a href="<?php echo G5_URL."/page/guide/direction.php"; ?>">오시는길</a></li>
            </ul>
	    </div>
	</div>
</footer>
<?php
include_once(G5_PATH."/tail.sub.php");
?>