<?php
session_start();
require("inc/conf.php");
require("inc/func.php");
require("inc/postcodeClass.php");

if(!isADMIN())
{
	adminLOGOUT();
	echo "Please login first";
	exit();
}
if (isset($_SESSION['store_acces_id']))
{
	$store_id = $_SESSION['store_acces_id'];
}
$row = get_restaurant_by_id($_SESSION['restaurant_admin']);
?>
 <?php
    $ord_id 		= makeSafe($_GET["ord_id"]);
    $corp_id 		= makeSafe($_GET["corp_id"]); 
		$converted	='';    
   	$query 	= mysql_query("SELECT * FROM order_corporate WHERE corporate_id='".$corp_id."' AND order_id=".$ord_id);
		$query1	=	mysql_query("SELECT * FROM orders_corporate_final WHERE corporate_id='".$corp_id."' AND id=".$ord_id);			
	 	$order 	= mysql_query("SELECT * FROM order_corporate WHERE corporate_id = '".$corp_id."' AND order_id='".$ord_id."'");
	 $order1 = mysql_query("SELECT * FROM order_corporate WHERE corporate_id = '".$corp_id."' AND order_id='".$ord_id."'");
		$num= mysql_num_rows($order);
		$number_of_items=0;
	
		for($t=1;$t<=$num;$t++)
		{   
			$item=mysql_fetch_array($order1);
	    $items= unserialize($item['sessionarray']);
	    $number_of_items+= sizeof($items);
		}
				$count = mysql_num_rows($query);        
	
				$settings = general_settings(); 
				     
if($count>0)
{        
			$o = mysql_fetch_assoc($query1);
			$couponAPPLIED = $o["couponApplied"];
			$couponID = $o["couponId"];
			$requestedDATE = $o["requestedDate"];
			$requestedTIME = $o["requestedTime"];
			mysql_set_charset('utf8');
			$langquery = mysql_query("SELECT * FROM language");
			
			while($lang=mysql_fetch_assoc($langquery))
			{
				$sa[]=$lang;
				
			$da[trim(strtolower($lang['English']))]=$lang;
				  
			}
?>
<body id="order-details">
<div style="width:472px; float:left;">
<table style="font-family: Arial, Helvetica, sans-serif" width="100%">
  
<tr>
  <td colspan="2">
    <table style="border-bottom:3px solid #000;" width="100%">
      <tr>
        <td valign="middle" width="70%">
        <span id="printdata<?php echo 0;?>" style="font-size:25px; font-weight:bold;">
				<?php echo "Order Number" ;?>
				<?php $converted+='@'+"Order Number";?> <?php echo "00".$ord_id; ?>
        </span>
        <span style="font-size:29px; display:block;"><?php echo $row['restaurant_name'];?></span>
        <span style="font-size:20px;">
        <?php echo $row['address'];?>
        <br>
        <?php echo $row['city'];?>
        <br />
        <?php echo $row['domain_name'];?>
        </span>
        </td>
        <td valign="middle" width="30%"><span style="font-size:20px;"><?php echo $requestedDATE; ?></span></td>
      </tr>
    </table>  
  </td>
</tr>

<tr>
	<td colspan="2">
  	<table style="border-bottom:3px solid #000;" width="100%">
    	<tr>
      	<td>
        	<span style="font-size:20px; font-weight:bold;">
					<?php echo $da[strtolower('Number Of Items')][$settings['language']];?> : <?php echo $number_of_items;?>
          </span>
          </td>
        </tr>	
		</table>
	</td>
</tr>

<?php 
if($o["order_type"] != "collection")
{
	$glob=7;
}
else
{
	$glob=8;
}
	$price=0; 
	 
	for($i=1;$i<=$num;$i++)
	{$totalmember=0;	 
		$ord_details= mysql_fetch_array($order);
	?>	
<tr>
	<td colspan="2">
  	<table style="border-bottom:3px solid #000;" width="100%">
    	<tr>
      	<td>
        	<span style="font-size:20px;">
					Name : <?php echo $ord_details['name'];?>
          </span>
          </td>
        </tr>	
		</table>
	</td>
</tr>
		<?php	
		$number=unserialize($ord_details['sessionarray']);		
		foreach($number as $key=>$details) 
	  {  
			$price+=$details['pr_price'];
?>
	<tr>
		<td>
			<table style="font-size:20px;" width="100%">
        <tr>
					<td valign="top" width="10%" style="text-align:left;">
					<span style="font-size:25px;"><?php echo $details['pr_quan']?>X</span></td>
          <td valign="top" width="70%" style="text-align:left;">
          	<span style="display:block; font-size:25px; color:#000;" id="printdata<?php echo $global++?>">
						<?php echo $details["pr_name"];?>
						<?php $converted+='@'.$u_detail["pr_name"];?>
              </span>
          <?php 
						 if($details['pro_type']=="standard")	
							{  
								$option=$details['pro_option_name']; 
								if($option=="")
								{?>
									 <span  style="display:block; font-style:italic; font-size:20px; color:#000;" id="printdata<?php echo $glob+1;?>"><?php echo ":Regular";?></span><?php $converted+='@'."Regular";?> 		 
								<?php   }
								else {   
										?>
							<?php
									foreach($option as $pr_option)
									{	   
								 ?> 
								<span style="display:block; font-style:italic; font-size:20px; color:#000;" id="printdata<?php echo $glob++;?>">
								<?php echo ':'.$pr_option['group_op_name'];?>
								</span><?php $converted+='@'+$pr_option["group_op_name"];?>		 
								<?php }					 
							}
						}
							else
						  { 
							  $option= json_decode($details['sessiondata']);
							
			  				foreach($option as $key=>$pr_option)
				  			{ //Simple Pizza
									if (isset($details['pro_option_name']) && $details['pro_option_name']=="1") {
									 if ($key <2) {?>
			 						<span style="display:block; font-style:italic; font-size:20px; color:#000;" id="printdata<?php echo $glob++;?>"><?php echo ":".$pr_option[1];?></span>
									<?php }
										}else{?>
									<span style="display:block; font-style:italic; font-size:20px; color:#000;" id="printdata<?php echo $glob++;?>"><?php echo ":".$pr_option[1];?></span>
									<?php }?>
									<?php $converted+='@'.$pr_option[1];?>
					<?php }
				   		}
					 ?>    
          </td>
          <td width="20%" style="text-align:left;" valign="top">
          <span style="font-size:25px; font-weight:bold;">
					<?php echo $settings['paypal_currency_symbol'].number_format($details['pr_price'],2,'.','')?></span></td>
				</tr>
			
      </table>
		</td>
	</tr>
  
<?php 
		$totalmember += $details['pr_price']; 
		}
?>

<tr>
  	<td colspan="2">
    	<table style="border-bottom:3px solid #000;" width="100%">
        <tr>
        	<td valign="top" width="78%" style="text-align:left; font-size:25px;">
          <?php echo $da[strtolower('Total')][$settings['language']];?> :</td>
          
          <td valign="top" width="20%" style="text-align:left;">
          <span style="font-size:25px; font-weight:bold;">
					<?php echo $settings['paypal_currency_symbol'].number_format($totalmember,2, '.', '');?>
          </span></td>
        </tr>        		
      </table>
  	</td>
  </tr>
<?php		
	}//end main orders
?>
<?php 
	 $u_det=mysql_query("SELECT * FROM users WHERE id=".$o["user_id"]) ;
	 $u_add=mysql_query("SELECT * FROM users_address WHERE user_id=".$o["user_id"]);
	 $u_detail= mysql_fetch_assoc($u_det);
	 $u_address= mysql_fetch_assoc($u_add) ;
?>	

<tr>
  	<td colspan="2">
    	<table style="border-bottom:3px solid #000;" width="100%">
        <tr>
        	<td valign="top" width="78%" style="text-align:left; font-size:29px; font-weight:bold;">
					<?php echo $da[strtolower('Subtotal')][$settings['language']];?> :</td>
          
          <td valign="top" width="20%" style="text-align:left;" >
          <span style="font-size:25px; font-weight:bold;">
					<?php echo $settings['paypal_currency_symbol'].number_format(($price - $totalDiscount) + $total['address'], 2, '.', '');?></span></td>
        </tr>    
        
       <?php if($o['address'] !=0){ ?>
        
         <tr>
					<td valign="top" width="78%" style="text-align:left; font-size:20px;"><i>
          <?php echo $da[strtolower('Delivery Charge')][$settings['language']];?> :</i></td>
					<td valign="top" width="20%" style="text-align:left; color:#555555; font-size:25px; font-weight:bold;">
					<?php echo $settings['paypal_currency_symbol'].number_format($total['address'], 2, '.', '');?>
        	</td>
        </tr>
        <?php }?>
        
    <?php 
			$totalDiscount = 0;
			
			if(isset($total['couponApplied']) and $total['couponApplied'] =='yes') { 
			 	
				$counpan = mysql_query('select * from discount_codes where id = "'.$total['couponId'].'"');
			 	$coupanCode = mysql_fetch_assoc($counpan);
			 
			 	if ($coupanCode['theType'] == 'percent') {
				 	 $totalDiscount = ($price * $coupanCode['theAmount']) / 100	;		 
			 	}else{
				   $totalDiscount = $coupanCode['theAmount'] + $price;
			 	}
			 ?>

            		
        <tr>
        	<td valign="top" width="78%" style="text-align:left; font-style:italic; font-size:20px;">
          <?php echo $da[strtolower('Discount')][$settings['language']];?>:</td>
          
          <td valign="top" width="20%" style="text-align:left; color:#555555;">
          <span style="font-size:25px; font-weight:bold;">
          <?php echo $settings['paypal_currency_symbol'].number_format($totalDiscount, 2, '.', '');?>
          </span>
          </td>
        </tr>
    <?php } ?> 
      </table>
  	</td>
  </tr>

<tr>
  	<td colspan="2">
    	<table style="border-bottom:3px solid #000;" width="100%">
        <tr>
        	<td valign="top" width="78%" style="text-align:left; font-size:29px; font-weight:bold;">
          <?php echo $da[strtolower('Total')][$settings['language']];?> :</td>
          
          <td valign="top" width="20%" style="text-align:left;">
          <span style="font-size:25px; font-weight:bold;">
					<?php echo $settings['paypal_currency_symbol'].number_format(($price - $totalDiscount) + $total['address'], 2, '.', '');?></span></td>
        </tr>        		
      </table>
  	</td>
  </tr>

<tr>
  <td colspan="2">
    <table style="border-bottom:3px solid #ddd;" width="100%">
      <tr>
        <td>
        <span style="font-style:inherit; color:#000; display:block; border-bottom:1px solid #ddd; padding-bottom:5px; font-size:20px; font-weight:bold;">
        <?php echo $da[strtolower('Customer Info')][$settings['language']];?></span>      
        <span style="color:#000000; font-size:20px; display:block;">
        <?php //echo $o['orderTYPE'];?></span>
        <span style="color:#000000; font-size:20px; display:block; font-weight:bold;">
        <span id="printdata<?php echo 4 ;?>">
							<?php echo $u_address["address"]?></span>
								<?php $converted+='@'+$u_detail["address"];?>
				<?php //echo $o['userPOSTCODE'];?>
        <br>
        <?php echo $da[strtolower('Phone')][$settings['language']];?> : <?php echo $u_address["phone"]?>
        </span>
       </td>
      </tr>        		
    </table>
  </td>
</tr>


<tr>
  	<td colspan="2">
    	<table style="border-bottom:3px solid #ddd; font-size:20px; font-weight:bold;"width="100%">
        <tr>
        	<td><?php echo $da[strtolower('Request for')][$settings['language']];?> : </td>
          <td><?php echo $da[strtolower('ASAP')][$settings['language']];?> : <?php echo $requestedDATE;?></td>
        </tr>        		
      </table>
  	</td>
  </tr>
  
<tr>
  	<td colspan="2">
    <span  style="color:#000000; font-size:29px; font-weight:bold;">
			<?php echo $o['payment_type'];?>
			<i><?php if($o['status_payment']=='paid')
								{
									echo ' Paid';
								}else{ 
									echo ' Not Paid';
								}?>
		 </i></span></td>
  </tr>

<?php
}
else	
{
?>
  <div id="box-error" class="hidden">
		<div id="content">There is no such order!</div>
	</div>
	<!-- Box - Error End -->
<?php } ?>
</table>
<!--mahesh-->
<input type="hidden" name="lastprintval" id="lastprintval" value="<?php echo $glob;?>"/>
</div>       
</body>
</html>