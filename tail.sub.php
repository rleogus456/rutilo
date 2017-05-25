<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 사용자가 지정한 tail.sub.php 파일이 있다면 include
if(defined('G5_TAIL_SUB_FILE') && is_file(G5_PATH.'/'.G5_TAIL_SUB_FILE)) {
    include_once(G5_PATH.'/'.G5_TAIL_SUB_FILE);
    return;
}
?>
<script src="<?php echo G5_JS_URL ?>/owl.carousel.js"></script>
</body>
</html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다. ?>