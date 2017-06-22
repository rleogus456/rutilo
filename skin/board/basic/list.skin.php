<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 7;
//if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;

if (preg_match('/(iPhone|Android|iPod|BlackBerry|IEMobile|HTC|Server_KO_SKT|SonyEricssonX1|SKT)/', 
$_SERVER['HTTP_USER_AGENT']) ) {
    define('BROWSER_TYPE', 'M'); // mobile    
} else {
    define('BROWSER_TYPE', 'W'); // web (iPad 는 웹으로 간주)
}
if(BROWSER_TYPE == "M")
{
   $colspan = 5;
}
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<style>
    tr.answer{display: none;border: 3px solid #ccc;background: #eee;border-radius: 10px;}
    td.answer{padding: 30px}
    td.answer >div.question span{font-size: 30px ; margin-right: 20px;font-weight: bold;}
    td.answer >div.question{margin-bottom: 30px;font-size: 17px}
    td.answer >div.answer span{font-size: 30px ; margin-right: 20px;font-weight: bold}
    td.answer >div.answer{font-size: 17px}
</style>
<div class="width-fixed">
	<section class="section03" style="margin-bottom:0px">
		<header>
			<h4><?php echo $board['bo_subject'] ?></h4>
			<p class="sectionP">루틸로를 이용하시면서 생기는 모든 궁금증 물어보세요</a></p>   
		</header>
	</section>
<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">
    <!-- 게시판 카테고리 시작 { -->
    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>
        
    <!-- } 게시판 카테고리 끝 -->

<!--     게시판 페이지 정보 및 버튼 시작 {-->
    <div class="bo_fx">
        <div id="bo_list_total">
            <p>총 <span class="red"><?php echo number_format($total_count) ?></span>건</p>
<!--            <?php echo $page ?> 페이지-->
        </div>

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
<!--
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
            <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
            <?php if ($reply_href) { ?><li><a href="<?php echo $reply_href ?>" class="btn_b01">답변</a></li><?php } ?>
-->
        </ul>
        <?php } ?>
    </div>
<!--     } 게시판 페이지 정보 및 버튼 끝 -->

    <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">
    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
            <colgroup>
                <col width="8%">
                <col width="12%">
                <col width="40%">
                <col width="12%">
                <col width="10%">
                <col width="10%" class="mobile">
                <col width="8%" class="mobile">
            </colgroup>
        <thead>
            <tr>                
                <th scope="col">번호</th>     
                <th scope="col">분류</th>
                <th scope="col">제목</th>            
                <th scope="col">글쓴이</th> 
                <th scope="col" class="mobile"><?php echo subject_sort_link('wr_datetime', $qstr2, 1) ?>등록일</a></th>
                <th scope="col">상태</a></th>
                <th scope="col" class="mobile"><?php echo subject_sort_link('wr_hit', $qstr2, 1) ?>조회</a></th>
                <?php if ($is_good) { ?><th scope="col"><?php echo subject_sort_link('wr_good', $qstr2, 1) ?>추천</a></th><?php } ?>
                <?php if ($is_nogood) { ?><th scope="col"><?php echo subject_sort_link('wr_nogood', $qstr2, 1) ?>비추천</a></th><?php } ?> 
            </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $i<count($list); $i++) {  ?>
        <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?> question">
            <td class="td_num">
            <?php
            if ($list[$i]['is_notice']) // 공지사항
                echo '<strong>공지</strong>';
            else if ($wr_id == $list[$i]['wr_id'])
                echo "<span class=\"bo_current\">열람중</span>";
            else
                echo $list[$i]['num'];
             ?>
            </td>
            <td class="td_name sv_use"><?php echo $list[$i]['ca_name']; ?></td> 
            <td class="td_subject"><?php echo $list[$i]["wr_subject"]; ?>
              <!--<div id="faq" >
                    <ul>                      
                        <li <?php /*if($i==0) { */?> class="active" <?php /*}*/?>>
                            <h4 style="cursor:pointer">
                                <span></span><?php /*echo $list[$i]["wr_subject"]; */?>
                            </h4>
                            <?php
/*                              $reply_href=$list[$i]['href'];
                                $c_id=$list[$i]["wr_id"];                                
                                $sql = "select wr_id, wr_content from $write_table where wr_parent = '$c_id' and wr_is_comment = '1' ";
                                $cmt = sql_fetch($sql);
                                $c_wr_content = $cmt['wr_content'];
                            */?>
                            <div>
                                <span></span>
                                <?php /*if($c_wr_content){ */?>
                                    Re: <?php /*echo $c_wr_content; */?>
                                <?php /*}else {
                                    echo $list[$i]['wr_content'];
                                } */?>
                            </div>
                        </li>
                    </ul>
                </div>-->
            </td>
        <?php 
            $reply_href=$list[$i]['href'];
            $c_id=$list[$i]["wr_id"];                                
            $sql = "select wr_id, wr_content from $write_table where wr_parent = '$c_id' and wr_is_comment = '1' ";
            $cmt = sql_fetch($sql);
            $c_wr_content = $cmt['wr_content'];
         ?>
            <td class="td_name sv_use"><?php echo $list[$i]['wr_name'] ?></td>
            <td class="td_date mobile"><?php echo $list[$i]['datetime'] ?></td>
            <td class="td_date">
                <?php if($is_admin){?>
                    <?php if(!$c_wr_content){ ?>
                        <a href="<?php echo $reply_href ?>" >댓글등록</a>
                    <?php }else{ ?>
                        <a href="<?php echo $reply_href ?>" style="color:#fe1e1e;font-weight:bold" >답변완료</a>
                    <?php } ?>
                <?php }elseif($is_member){ ?>
                    <?php if($c_wr_content){ ?>
                        <a href="<?php echo $reply_href ?>" style="color:#fe1e1e;font-weight:bold" >답변완료</a>
                    <?php }else{?>
                        <a href="<?php echo $reply_href ?>" >미답변</a>
                    <?php } ?>
                <?php } ?>
            </td>
             <td class="td_num mobile"><?php echo $list[$i]['wr_hit'] ?></td>
            <?php if ($is_good) { ?><td class="td_num"><?php echo $list[$i]['wr_good'] ?></td><?php } ?>
            <?php if ($is_nogood) { ?><td class="td_num"><?php echo $list[$i]['wr_nogood'] ?></td><?php } ?> 
        </tr>
  
        <tr class="answer">
            <td colspan="<?php echo $colspan ?>" class="answer" id="ans">
                <?php
                $sql = "select wr_id, wr_content from $write_table where wr_parent = ".$list[$i]["wr_id"]." and wr_is_comment = '1' ";
                $cmt = sql_fetch($sql);
                ?>
                <div class="question"><span>Q</span><?php echo $list[$i]['wr_content'];?></div>
                <?php if($cmt['wr_content']){?>
                <div class="answer"><span>A</span><?php echo $cmt['wr_content'];?></div>
                <?php }?>
            </td>
        </tr>
        <?php } ?>
        <?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">         
        <ul class="btn_bo_user">
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
        </ul>
    </div>
    <?php } ?>
    </form>
</div>
</div>
<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages;  ?>

<!-- 게시판 검색 시작 {
<fieldset id="bo_sch">
    <legend>게시물 검색</legend>

    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
        <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
        <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
        <option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
        <option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
        <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
        <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input required" size="15" maxlength="20">
    <input type="submit" value="검색" class="btn_submit">
    </form>
</fieldset>
 } 게시판 검색 끝 -->

<?php if ($is_checkbox) { ?>
<script>
//function status_Info(){	
//	$.post(g5_url+"/bbs/write.php?bo_table=questions",{"":""},function(data){
//		$(".msg").html(data);
//		msg_active();
//	});
//    return false;
//}

function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;
    
 
return false;
    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<script type="text/javascript">
	$(function(){
		$("#faq li h4").click(function(){
			var p=$(this).parent();
			var pindex=p.index();
			var len=$("#faq li").length;
			if(p.hasClass("active")){
				p.find("div").css("min-height","0");
				p.find("div").slideUp(function(){
					p.removeClass("active");
				});
			}else{
				p.find("div").css("min-height","123px");
				p.find("div").slideDown(function(){
					p.addClass("active");
				});
			}
		});
	});
	$(document).ready(function(){                     
	    $("tr.question").click(function(){
           $(this).next().toggle();
           $(this).click(function(){               
               if($(this).next().attr(this,style) == "display: table-row;"){
                   $(this).next().toggle();
                   $(this).next().addClass("active");
               }
           })
       });
    });
</script>
<!-- } 게시판 목록 끝 -->
