<?php
define('_INDEX_', true);
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// 초기화면 파일 경로 지정 : 이 코드는 가능한 삭제하지 마십시오.
if ($config['cf_include_index'] && is_file(G5_PATH.'/'.$config['cf_include_index'])) {
    include_once(G5_PATH.'/'.$config['cf_include_index']);
    return; // 이 코드의 아래는 실행을 하지 않습니다.
}
if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/index.php');
    return;
}
$main=true;
include_once('./_head.php');
$best_tel=sql_fetch("select * from `best_tel`");
$now=date("Y-m-d h:i:s");
$event_sql="SELECT * FROM  `g5_write_event` WHERE  `wr_1`<='$now' and `wr_2`>='$now'";
$event_query=sql_query($event_sql);
while($event_data=sql_fetch_array($event_query)){
	$event_list[]=$event_data;
}
$notice_sql="SELECT * FROM `g5_write_notice` order by wr_id desc limit 0,5";
$notice_query=sql_query($notice_sql);
while($notice_data=sql_fetch_array($notice_query)){
	$notice_list[]=$notice_data;
}
$rutilo_product = "SELECT * FROM `rutilo_product`";
$product_query=sql_query($rutilo_product);
while($product_data=sql_fetch_array($product_query)){
	$list[]=$product_data;
}

$rutilo_construction = "SELECT * FROM `rutilo_construction`";
$con_query=sql_query($rutilo_construction);
while($cont_data=sql_fetch_array($con_query)){
	$video[]=$cont_data;
}
?>
<script type="text/javascript">
	$(function(){
		$(".beta a").click(function(){
			$(".beta").fadeOut(500);
		});
	})
</script>
<div class="">
	<?php
	if(defined('_INDEX_')) { // index에서만 실행
		include_once(G5_BBS_PATH.'/newwin.inc.php'); // 팝업레이어
	}
	?>
	<div class="width-fixed">
	<div class="wrap">
		<div id="main_banner">
        	<div class="menu">
        	    <?php for($i=0;$i<3;$i++){ ?>
				<div>
					<div class="menu1"><iframe width="100%" height="240px" src="<?php echo $video[$i]['videolink']; ?>" frameborder="0" allowfullscreen></iframe>
					<h1><span class="textRed">| </span><?php echo $video[$i]['title']; ?></h1>
					<p class="videoText"><?php echo $video[$i]['content']; ?></p>
				    </div>
				</div>
				<?php } ?>
<!--
				<div >
                    <div class="menu2"><iframe width="100%" height="240px" src="https://www.youtube.com/embed/OKPZPWJUgew" frameborder="0" allowfullscreen></iframe>
                    <h1><span class="textRed">| </span>루틸로 No 201</h1>
                    <p class="videoText">휠의 에너지를 재충전 한다.</p>
                    </div>
				</div>
				<div>
				    <div class="menu3"><iframe width="100%" height="240px" src="https://www.youtube.com/embed/OKPZPWJUgew" frameborder="0" allowfullscreen></iframe>
				    <h1><span class="textRed">| </span>루틸로 No 301</h1>
				    <p class="videoText">새차 같은 컬로톤의 재생, 광택의 스팟이 다르다.</p>
			    	</div>				   
				</div>				
-->
			</div>									
		</div>	
		</div>
	</div>
</div>
<div id="main_product">
	<div class="width-fixed wrap">
		<div>
		
			<div class="list">
				<h2>Rutilo</h2>
				<p>새차처럼 보호와 코팅을 한번에!!</p>
				<div>
				<ul>
                    <?php for($j=0;$j<5;$j++){ ?>
                    <li>
                       <a href="<?php echo G5_URL."/page/view.php?tab=product&id=".$list[$j]['id']; ?>">
                        <div class="img"><div><div><img src="<?php echo G5_DATA_URL."/model/".$list[$j]['photo']; ?>" alt="image" /></div></div></div>
                        <div class="h2back"><h3><?php echo $list[$j]['name'];?></h3></div>
                        <div class="txt">									
                            <h2><?php echo $list[$j]['name'];?></h2>									
                            <h3><?php echo $list[$j]['content'];?> (<?php echo $list[$j]['type'];?>)</h3>	      
                            <h4><?php echo $list[$j]['volume'];?>ml ￦<?php echo $list[$j]['price'];?>원</h4>              							
                        </div>
                        </a>	
                    </li>    
                    <?php }?>
				</ul>
<!--
					<ul>
					<?php
					for($j=0;$j<count($list);$j++){
							$class="";
							if($j>=4)
								$class="md_hidden";
						if($list[$j]["IndexPage"]=="Y"){
					?>
						<li<?=($class?" class='".$class."'":"")?>>
							<a href="<?php echo G5_URL."/page/mall/view.php?&sPID=".$list[$j]['PID']."&sCVIndex=".$list[$j]['CVIndex'] ?>">
								<?php if($list[$j]['out'] || ($list[$j]['number']-$list[$j]['sell'])<=0){ ?><div class="out"><i></i></div><?php } ?>
								<div class="img"><div><div><img src="/shop/images/<?=(strlen($list[$j]['MainImg'])>0?"upload/".$list[$j]['MainImg']:"ProductNoneImage.png")?>" width="100%"></div></div></div>
								<div class="txt">									
									<h4><b><?=(strlen($list[$j]['KrName'])==0?$list[$j]['Name']:$list[$j]['KrName'])?></b></h4>									
									<h3><?=number_format($list[$j]['BZPrice'])?> 원</h3>									
								</div>
							</a>
						</li>
					<?php }
						}
					?>
					</ul>
-->
				</div>
			</div>
			
		</div>
	</div>
</div>
	<?php
		$partner_sql="SELECT * FROM  `best_event` WHERE  `show` =  '1'";
		$partner_query=sql_query($partner_sql);
		while($partner_data=sql_fetch_array($partner_query)){
			$partner_list[]=$partner_data;
		}
		if(count($partner_list)>0){
	?>
	<div id="main_partner" class="owl-carousel">
	<?php for($i=0;$i<count($partner_list);$i++){ ?>
		<div class="item"><a href="<?=$partner_list[$i]["link"]?>" target="_new"><img src="<?php echo G5_DATA_URL."/partner/".$partner_list[$i]['banner']; ?>" alt="<?php echo $partner_list[$i]['name']; ?>" /></a></div>
	<?php } ?>
	</div>
	<?php } ?>	

<script type="text/javascript">
	$(function () {
		$(".tab_content").hide();
		$(".tab_content:first").show();
		$("#main_tab > div li").click(function () {
			$("#main_tab > div li").removeClass("active");
			$(this).addClass("active");
			$(".tab_content").hide()
			var activeTab = $(this).attr("rel");
			$("#" + activeTab).fadeIn()
		});
	});
	
</script>
<?php
include_once('./_tail.php');
?>
