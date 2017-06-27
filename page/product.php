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
		</article>
	</section>	
</div>
<?php
include_once(G5_PATH.'/tail.php');
?>
