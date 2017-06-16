<?php
include_once('../common.php');
include_once(G5_PATH.'/head.php');
$trainer = "SELECT * FROM `rutilo_trainer`";
$query=sql_query($trainer);
while($data=sql_fetch_array($query)){
	$list[]=$data;
}
?>

<div class="width-fixed">
	<section class="section03">	
		<header>

			<h4>트레이너</h4>
<!--            <p>최고의 품질 최고의 성능으로 항상 최선을 다하는 루틸로 입니다.</p>-->

		</header>
		
		<article class="trainer">
            <div>
                <ul>
                    <?php for($j=0;$j<count($list);$j++){ ?>           
                    <li>  
                        <a href="#" onclick="trainer_Info(<?php echo $list[$j]['id'];?>)">                       
                        <div class="img"><div><div><img src="<?php echo G5_DATA_URL."/trainer/".$list[$j]['photo']; ?>" alt="image" /></div></div></div>
                        <div class="txt">									
                            <h2>트레이너 : <?php echo $list[$j]['name'];?></h2>									
                            <h3>경력 : <?php echo $list[$j]['career'];?> <br>소속 : <?php echo $list[$j]['belong'];?><br>TEL :  <?php echo $list[$j]['tel'];?></h3>	      
                            <h4>자세히</h4> 
                        </div>
                        </a>	
                    </li>    
                    <?php }?>                     
				</ul>
            </div>
         
<!--
        <h4 class="intro">루틸로를 방문해주셔서 감사합니다.</h4>
        <p>루틸로는 세계 최초 하이브리드 코팅제로, 순수 국내 기술로 개발된 루틸로 코팅제는 우수한 방수/방오 성능으로 자동차 도장면은 물론 플라스틱과 고무, 유리, 가죽, 신발, 섬유 등 일상의 모든곳에 사용할 수 있습니다.</p>
-->
          
		</article>
	</section>	
</div>
<script>
function trainer_Info(f){
	var id=f;
	$.post(g5_url+"/page/modal/trainerInfo.php",{id:id},function(data){
		$(".msg").html(data);
		msg_active();
	});
    return false;
}
</script>
<?php
include_once(G5_PATH.'/tail.php');
?>
