<?php
include_once('../common.php');
include_once(G5_PATH.'/head.php');
$rutilo_construction = "SELECT * FROM `rutilo_construction`";
$con_query=sql_query($rutilo_construction);
while($cont_data=sql_fetch_array($con_query)){
$video[]=$cont_data;
}
?>

<div class="width-fixed">
	<section class="section03">	
		<header>
            <div id="player">
             <div id="player_screen">
                 <iframe src="https://www.youtube.com/embed/OKPZPWJUgew" width="100%" height="680px" frameborder="0" allowfullscreen="true"></iframe>
             </div>
            </div><!-- player -->
            <div id="playerTxt">
                <div class="videoTxt">
                    <h1 class="videoh1">루틸로 No 101</h1>
                    <p class="videop1">고품질 놀라운 성능 본  컬러의 색상을 되살린다.</p>
                 </div>
            </div>
		</header>
		<div class="width-fixed">
		<article class="construction">  
            <div id="list">
               <?php for($i=0;$i<count($video);$i++){ ?>
                <div class="movs">
                   <div class="img"><div><div><a href="#"><img src="<?php echo G5_DATA_URL."/construction/".$video[$i]['photo']; ?>" alt="image" /></a><em></em></div></div></div>
                    <div class="videoTxt">
                        <h1><?php echo $video[$i]['title']; ?></h1>
                        <p><?php echo $video[$i]['content']; ?></p>
                    </div>
                    <div class="url"><iframe src="<?php echo $video[$i]['videolink']; ?>"></iframe></div>
                </div>
                <?php } ?>
            </div>   
		</article>
		</div>		
	</section>	
</div>
<script>
$('#list .movs a').on('click', function(e) {
    e.preventDefault();
    var $itemx = $(this).parents("div.movs") // 클릭된 a 의 부모요소 중 div.movs라는 요소를 찾아 $itemx 로 지정합니다.
    var $itemx_tit = $itemx.find("").html(); // 간직한 $itemx 요소에 dt를 찾아 그 안의 내용을 $itemx_tit으로 지정합니다. 
    var $itemx_desc = $itemx.find("div.videoTxt").html(); // 간직한 $itemx 요소에서 div.desc를 찾아 그 안의 내용을 $itemx_desc로 지정합니다.
    var $itemx_url = $itemx.find("div.url iframe").attr("src"); // 간직한 $itemx 요소에서 div.url 안에 있는 iframe을 찾아, 그 주소를 $itemx_url 로 지정합니다.
    var $sc_top = $(document).scrollTop(); // 사실 없어도 되지만, 플레이어 영역이 스크롤되어 감춰졌을 때 제대로 보여주기 위해서 지정합니다. 문서가 얼마나 스크롤되었는지 지정합니다.
    var $player_top = $('#player').offset().top // 문서 내에서 플레이어 영역의 세로 위치가 어디 쯤에 위치하는지를 지정합니다.
//    console.log($itemx); 
//    console.log($itemx_tit);
//    console.log($itemx_desc);
//    console.log($itemx_url); 
    $('#player_screen .top_img').hide(); // 커버 이미지 숨김. 
    $('#player_screen iframe').attr("src",$itemx_url+"?rel=0" + "&autoplay=1"); // 플레이어 영역의 iframe에 아까 지정해두었던 iframe주소와 자동실행 코드를 넣어줍니다. 동영상이 재생됩니다.
    $('#player_screen iframe').show(); // 만약 iframe이 감춰져 있었다면, 이 코드를 통해 보여지게 됩니다.  
    $('#playerTxt div.videoTxt').html( $itemx_desc ); // 플레이어 영역의 설명 부분에 썸네일에 있던 설명을 그대로 가져와 넣어줍니다.
    if ( $player_top < $sc_top) { // 만약 플레이어 영역의 높이값보다 페이지를 더 아래로 스크롤했을 경우,
    $('html, body').animate({ scrollTop: $player_top }, "fast"); // 현재 보고있는 페이지를 플레이어 영역이 다 보일 때까지 스크롤 합니다.
    }
    else { return false } // 만약 플레이어 영역의 높이값이 화면에 보인다면, 그냥 관둡니다.
});


</script>

<?php
include_once(G5_PATH.'/tail.php');
?>
