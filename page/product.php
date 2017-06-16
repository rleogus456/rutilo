<?php
include_once('../common.php');
include_once(G5_PATH.'/head.php');
$rutilo_product = "SELECT * FROM `rutilo_product`";
$product_query=sql_query($rutilo_product);
while($product_data=sql_fetch_array($product_query)){
	$list[]=$product_data;
}

?>

<div class="width-fixed">
	<section class="section03">	
		<header>

			<h4>Rutilo</h4>
            <p>새차처럼 보호와 코팅을 한번에!!</p>

		</header>
		
		<article class="product">
        	<div>
            <ul>
                    <?php for($j=0;$j<count($list);$j++){ ?>
                    <li>
                       <a href="<?php echo G5_URL."/page/view.php?tab=product&id=".$list[$j]['id']; ?>">
                        <div class="img"><div><div><img src="<?php echo G5_DATA_URL."/model/".$list[$j]['photo']; ?>" alt="image" /></div></div></div>
                        <div class="txt">									
                            <h2><?php echo $list[$j]['name'];?></h2>									
                            <h3><?php echo $list[$j]['content'];?> (<?php echo $list[$j]['type'];?>)</h3>	      
                            <h4><?php echo $list[$j]['volume'];?>ml ￦<?php echo $list[$j]['price'];?>원</h4>              							
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


<?php
include_once(G5_PATH.'/tail.php');
?>
