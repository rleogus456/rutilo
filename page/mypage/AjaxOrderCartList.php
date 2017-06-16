<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';

$sMod = $_POST['sMod']; 
$sId = $_POST['sId']; 

if ($sMod == "D") {
	sql_query( "DELETE FROM ShopCartInfo WHERE UID='" . $_SESSION['loginUID'] . "' AND Id='" . $sId . "'"); 
}else if($sMod == "AD"){
	sql_query( "DELETE FROM ShopCartInfo WHERE UID='" . $_SESSION['loginUID'] . "'");
}

$n = 0;

$nR = sql_query( "SELECT A.Id, A.PackID, A.PackCount, A.PID, A.Count, A.Color, A.Volume, B.KrName, B.EnName, B.ShopCate00Id, B.ShopCate01Id, B.ShopCate02Id, B.ShopCate03Id, B.MainImg, C.Name, C.InPrice,C.CMPrice,C.BZPrice,C.RV,C.InPriceNo,C.CMPriceNo,C.BZPriceNO,C.InPriceVAT,C.CMPriceVAT, C.PV FROM ShopCartInfo A INNER JOIN ShopProductInfo B, ConfigProduct C WHERE A.UID='" . $_SESSION['loginUID'] . "' AND A.PackID=B.PID AND A.PackID=C.PID ORDER BY A.Id DESC");
while ($nRow = sql_fetch_array($nR)) { $n++;
	$sCate = getProductCategory($nRow['ShopCate00Id'], $nRow['ShopCate01Id'], $nRow['ShopCate02Id'], $nRow['ShopCate03Id']);
	$arPID = explode(",", $nRow['PID']);
	$arCount = explode(",", $nRow['Count']);
	$arColor = explode(",", $nRow['Color']);
	$arVolume = explode(",", $nRow['Volume']);
	$option = sql_fetch("SELECT * FROM ConfigProduct WHERE PID = '".$nRow["PackID"]."'");
	$totalPrice += ($nRow['Price']*$nRow['PackCount']);
	$totalPV += ($nRow['PV']*$nRow['PackCount']);
	?>
	<tr >
		<td class="chk"><input type="checkbox" name="orderPro" id="orderPro" onclick="$.setOrderPrice();" value="<?=$nRow['Id']?>" checked></td>			
		
		<td style="width:70%;text-align:left" onclick="location.href='<?php echo G5_URL?>/page/mall/view.php?sPID=<?=$nRow["PackID"]?>'">
				<div class="left"><img src="<?=(strlen($nRow['MainImg'])>0?"/shop/images/upload/".$nRow['MainImg']:"/shop/images/ProductNoneImage.png")?>" valign="middle" ></div>
				<div class="right"><p><?=str_replace("&gt; ","",$sCate)?></p>
				<h3><?=(strlen($nRow['KrName'])>0?$nRow['KrName']:$nRow['Name'])?></h3>
				<!-- <?=(strlen($nRow['EnName'])>0?" (".$nRow['EnName'].")":"")?> -->
								
				<?php if ($nRow['Comment']) {?>
					<?=$nRow['Comment']?>
				<?php } else { ?>
					&nbsp;
				<?php } ?>
				</div>
		</td>
		<td align="Left" style="padding:5px;">
			<input type="text" name="count" value="<?=$nRow['PackCount']?>" class="input04" style="width:50%"/>
		</td>
		<!-- <td style="padding:10px;">
			<?php
			if ($option['ColorCount']!=1) {
				$optionColor = explode(",",$option["Color"]);
			?>
				<select name="color" id="color">
					<option value="">색상선택</option>
					<?php for($j=0;$j<sizeof($optionColor);$j++){?>
					<option value="<?=$optionColor[$j]?>" <?php if(strpos($optionColor[$j],$nRow['Color'])!==false){echo "selected";}?>><?=$optionColor[$j]?></option>
					<?php } ?>
				</select>
			<?php }?>
			<?php
			if ($option['VolumeCount']!=1){ 
				$optionVolume = explode(",", $option["Volume"]);
			?>
				<select name="color" id="color">
					<option value="">사이즈선택</option>
					<?php for($j=0;$j<sizeof($optionVolume);$j++){?>
					<option value="<?=$optionVolume[$j]?>" <?php if(strpos($optionVolume[$j],$nRow['Volume'])!==false){echo "selected";}?>><?=$optionVolume[$j]?></option>
					<?php } ?>
				</select>
			<?php }?>
		</td> -->
		<td><span><?=number_format($nRow['Price']*$nRow['PackCount'])?> 원</span> <br> <span class="PV"><?=number_format($nRow['PV']*$nRow['PackCount'])?> PV</span></td>
		<td class="last">	
			<input type="button" value="삭제" class="delete_btn" onclick="$.showCartList('D', '<?=$nRow['Id']?>')"  />
		<!-- <div class="divGrayButtonAuto" onclick="$.showCartList('D', '<?=$nRow['Id']?>')">삭제하기</div> -->
		</td>
	</tr>
	<?php } ?>
	<tr style="display:none;"><td><input type="hidden" value="<?=$totalPrice?>" name="totalPrice" />
		<input type="hidden" value="<?=$totalPV?>" name="totalPV" /></td></tr>
<?php
if ($n == 0) { ?>
	<tr><td colspan="5" class="listContentTr last">쇼핑카트에 담겨진 제품이 없습니다.</td></tr>
<?php } ?>
<script type="text/javascript">
$.setOrderPrice();
</script>