<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
$franchiseeStatus = "SELECT * FROM `franch_status`";
$query=sql_query($franchiseeStatus);
while($data=sql_fetch_array($query)){
	$list[]=$data;
}
?>
<div class="width-fixed">
	<section class="section03">	
		<header>
			<h4>가맹현황</h4>
            <p>루틸로와 함께하는 가맹점입니다.</p>
		</header>		
		<article class="franchisee">
        	<div>
                <ul>
                    <?php for($j=0;$j<count($list);$j++){ ?>           
                    <li>  
                        <a href="#" onclick="status_Info(<?php echo $list[$j]['id'];?>)">                       
                        <div class="img"><div><div><img src="<?php echo G5_DATA_URL."/partner/".$list[$j]['photo']; ?>" alt="image" /></div></div></div>
                        <div class="txt">									
                            <h2><?php echo $list[$j]['title'];?></h2>									
                            <h3>주소<br> <?php echo $list[$j]['addr2'];?> <br>TEL<br><?php echo $list[$j]['tel'];?></h3>	      
                            <h4>자세히</h4> 
                        </div>
                        </a>	
                    </li>    
                    <?php }?>                     
				</ul>
            </div>
		</article>
	</section>	
</div>
<script>
function status_Info(f){
	var id=f;
	$.post(g5_url+"/page/modal/statusInfo.php",{id:id},function(data){
		$(".msg").html(data);
		msg_active();
	});
    return false;
}
</script>
<?php
include_once(G5_PATH.'/tail.php');
?>
