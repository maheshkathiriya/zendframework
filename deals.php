<?php session_start();
//echo $_SESSION['store_acces_id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php ob_start();
//print_r($_SESSION); exit;
?>

<?php
$_SESSION['page']="deals";
require 'head.php';
if (isset($_SESSION['restaurant_admin']))
{
	$restaurant_id = $_SESSION['restaurant_admin'];
	//echo $path_edit;
	//echo $restaurant_id;
	//echo $isFull;
}

$cate = mysql_query( "SELECT cat_id,name,type FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	while($getres=mysql_fetch_array($cate))
	{
	  
	  //$getproduct=mysql_query('SELECT product_id,name FROM '.TBL_PRODUCTS.' WHERE cat_id=  "'.$getres['cat_id'].'"');
	  $arr[] = array(
           'cat_id' => $getres['cat_id'],
           'name' =>$getres['name'],
					 'type' =>$getres['type']
        );
		
	}				


  // fetch deals category from deals_category table
	$get_cat = mysql_query( "SELECT * FROM ".TBL_DEALS_CATEGORY."");
	$qthird=mysql_query('SELECT cat_id,name,type FROM '.TBL_PRODUCT_CATEGORIES.' WHERE status="1" AND type!="N" AND store_id= '.$_SESSION['store_acces_id'].'');
	
	// fetch deals category listing from category table
	$category = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	$varone = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	$vartwo = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	$varthree = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	$varoneedit = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	$vartwoedit = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	/*$varthreeedit = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");*/
	
	
	$get_type_four_edit = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	$cat = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	$editcat = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	$editcatgetone = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	$getcat_4 = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	
	
	$query2 = mysql_query('SELECT * FROM '.TBL_DEALS.' where store_id= "'.$_SESSION['store_acces_id'].'" AND restaurant_id="'.$_SESSION['restaurant_admin'].'"');
	
	//echo 'SELECT * FROM '.TBL_DEALS.'where store_id= "'.$_SESSION['store_acces_id'].'" AND restaurant_id="'.$_SESSION['restaurant_admin'].'"'; exit;
	if($query2)
    $count = mysql_num_rows($query2);	
	//echo $count;
	
?>
	<div id="info-box"><label style="font-size:16px;font-weight:bold;">Deals Listing</label>
     <div>You currently have&nbsp;<font size="5" color="#666666">(<font color="#FF3300">
         <?php if(isset($count))echo $count?>
          </font>)&nbsp;</font><?php if(isset($count)>1){echo "Deals";} else {echo "Deal";}?>
          <?php if($isFull) { ?>
          <br />
          <a name="add_record" href="<?php echo $path_add; ?>">Click here to add new Deal</a>
         <?php } ?>
          
         </div>
        </div>
          <?php
        if($isFull)
		{
        ?> 
         <!-- Form to add records -->
        <div id="box-add" class="hidden">
          <h2>Add New Deal</h2>
          <form method="post" action="<?php echo $path_add?>" name="add_deal_form">
          <input type="hidden"  value="0" id="count_atr" name="cnt_attr">
          <input type="hidden"  value="0" id="count_atr2" name="cnt_attr2">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="form-field-label">Deal Name<span class="star">*</span> :</td>
                <td class="form-field-input"><input name="dealname" type="text" /></td>
              </tr>
              
              <tr>
				     <td class="form-field-label">Description :</td>
				     <td class="form-field-input"><textarea name="corptel" rows="6"></textarea></td>
			        </tr>
              
              <tr>
                <td class="form-field-label">Days<span class="star">*</span> :</td>
                <td class="form-field-input">
                	  <input name="days[]" id="day_all" type="checkbox"  value="0"  />&nbsp;All&nbsp;&nbsp;
                    <input name="days[]" class="day" id="day_chk1" type="checkbox"  value="1" />&nbsp;Mon&nbsp;&nbsp;
                    <input name="days[]" class="day" id="day_chk2" type="checkbox"  value="2" />&nbsp;Tue&nbsp;&nbsp;
                    <input name="days[]" class="day"  id="day_chk3"type="checkbox" value="3" />&nbsp;Wed&nbsp;&nbsp;
                    <input name="days[]" class="day"  id="day_chk4" type="checkbox"  value="4" />&nbsp;Thu&nbsp;&nbsp;
                    <input name="days[]" class="day"  id="day_chk5"type="checkbox"  value="5" />&nbsp;Fri&nbsp;&nbsp;
                    <input name="days[]" class="day"  id="day_chk6"type="checkbox"  value="6" />&nbsp;Sat&nbsp;&nbsp;
                    <input name="days[]" class="day"  id="day_chk7"type="checkbox" value="7" />&nbsp;Sun&nbsp;&nbsp;
                </td>
              </tr>
			  <tr>
                <td class="form-field-label">Date <span class="star">*</span> :</td>
                <td class="form-field-input">From:&nbsp;<input type="text" name="start_date" id="datepicker_f" readonly="readonly" style="width:90px;"/>&nbsp;&nbsp;&nbsp;To:&nbsp;<input type="text" name="end_date" id="datepicker_t" readonly="readonly" style="width:90px;"/></td>
              </tr>
              <tr>
                <td class="form-field-label">Time&nbsp;:</td>
                <td class="form-field-input">From:&nbsp;<input type="text" name="start_time" readonly="readonly" id="time_f" style="width:90px;"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To:&nbsp;<input type="text" id="time_t" name="end_time" readonly="readonly" style="width:90px;"/></td>
              </tr>
               
              <tr>
                <td class="form-field-label">Deal Type<span class="star">*</span> :</td>
                <td class="form-field-input"><select name="deal_cat_type" onchange="func(this.value);">
                <option value="">Select Deal Type</option>
                <?php while($row=mysql_fetch_array($get_cat)) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['cat_name']; ?></option>
                <?php } ?>
                </select>
               	</td>
                </tr>
                <tr>
               
                
              </tr></table>
                
             <table id="tr1" style="display:none;">
             <tr>
                <td class="form-field-label">BuyOne(Category)<span class="star">*</span> :</td>
                <td class="form-field-input">
                <select name="buyone" id="buyonegetone_1" onchange="byonegetone(this.value,this.id)">
                <option value="">Select Category</option>
                <?php while($res=mysql_fetch_array($category)) { ?>
                <option value="<?php echo $res['cat_id']; ?>"><?php echo $res['name']; ?></option>

                <?php } ?>
                </select>
                </td>
								<td id="ajax_buyonegetone_1"></td>
								<td><input type="hidden" id="buyone_txt" name="buyone_txt" value=""/></td>
                </tr>
                <tr>
                <td class="form-field-label">GetOne(Category)<span class="star">*</span> :</td>
                <td class="form-field-input">
                <select name="getone" id="buyonegetone_2" onchange="byonegetone(this.value,this.id)">
                <option value="">Select Category</option>
                <?php while($row=mysql_fetch_array($cat)) { ?>
                <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['name']; ?></option>

                <?php } ?>
                </select>
                </td>
								<td id="ajax_buyonegetone_2"></td>
								<td><input type="hidden" name="getone_txt" id="getone_txt"/></td>
                </tr>
                </table>
                <table id="dis_cat" style="display:none;">
                <tr>
                <td class="form-field-label">Discount Type<span class="star">*</span> :</td>
                <td class="form-field-input">
                <select name="discount_ty">
                <option value="">Select Discount Type</option>
                <option value="percentage">Discount In Percentage</option>
                <option value="price">Discount In Price</option>
                
                </select>
                <td class="form-field-label">Amount<span class="star">*</span> :</td>
                <td class="form-field-input"><input type="text" name="discount_price" /></td>
                </tr>
                
                </table>
                
                <table id="deal3" style="display:none;">
                <tr>
                <td class="form-field-label">Deal Price<span class="star">*</span> :</td>
                <td class="form-field-input"><input type="text" name="deal_amount" /></td>
                </tr>
                <tr>
                <td class="form-field-label">select Category<span class="star">*</span> :</td>
                <td class="form-field-input" >
                <select name="discount_type[0]" id="t0" onchange="getval_third(this.value)">
								<option value="">Select Category</option>
								<?php while($re=mysql_fetch_array($qthird)) { ?>
                
                
                <option value="<?php echo $re['cat_id'].",".$re['type']; ?>"><?php echo $re['name']; ?></option>
								<?php } ?>
								</select></td>
								<td class="form-field-input" id="third" name="third">
                </td>
								</tr>
                </table>
                <div id="add_new_attr">
                </div>
								
                
                <table id="deal4" style="display:none;">
                <tr>
                <td class="form-field-label">Deal Price<span class="star">*</span> :</td>
                <td class="form-field-input"><input type="text" name="deal_p" /></td>
                </tr>
                <tr>
								
								<tr>
                <td class="form-field-label">Variable one :</td>
                <td class="form-field-input">
								<select name="var1" id="1" onchange="getscombo(this.value,this.id);">
								<option value="">select Category</option>
								<?php while($resgetone=mysql_fetch_array($varone)) { ?>
								<option value="<?php echo $resgetone['cat_id']; ?>"><?php echo $resgetone['name']; ?> </option>
								<?php } ?></select><input type="hidden"  value="" id="var1_pro_id_1" name="var1_pro_id_1"/></td>
								<td id="ajax_1"></td>
								<td id="pro_1"></td>
								<td id="pro2_1"></td>
								<td>
								Quantity :
								<input type="text" name="quan1" style="width:50px;"/>
								</td>
								</tr>
								<tr>
								<td class="form-field-label">Variable two :</td>
                <td class="form-field-input">
								<select name="var2" id="2" onchange="getscombo(this.value,this.id);">
								<option value="">select Category</option>
								<?php while($resgettwo=mysql_fetch_array($vartwo)) { ?>
								<option value="<?php echo $resgettwo['cat_id']; ?>"><?php echo $resgettwo['name']; ?> </option>
								<?php } ?></select><input type="hidden"  value="" id="var1_pro_id_2" name="var1_pro_id_2"/>
								</td>
								<td id="ajax_2"></td>
								<td id="pro_2"></td>
								<td id="pro2_2"></td>
								<td>
								Quantity :
								<input type="text" name="quan2" style="width:50px;"/>
								</td>
                </tr>
								<tr>
								<td class="form-field-label">Variable three :</td>
                <td class="form-field-input">
								<select name="var3" id="3" onchange="getscombo(this.value,this.id);">
								<option value="">select Category</option>
								<?php while($resgetthree=mysql_fetch_array($varthree)) { ?>
								<option value="<?php echo $resgetthree['cat_id']; ?>"><?php echo $resgetthree['name']; ?> </option>
								<?php } ?></select><input type="hidden"  value="" id="var1_pro_id_3" name="var1_pro_id_3"/></td>&nbsp;&nbsp;
								<td id="ajax_3"></td>
								<td id="pro_3"></td>
								<td id="pro2_3"></td>
								<td>
								Quantity :
								<input type="text" name="quan3" style="width:50px;"/>
								</td>
								
							 </tr>
							 
							 <tr>
								
							  <td class="form-field-label">Variable four :</td>
                <td class="form-field-input">
								<select name="var4" id="4" onchange="getscombo(this.value,this.id);">
								<option value="">select Category</option>
								<?php for($i=0;$i<count($arr); $i++) { ?>
								<option value="<?php echo $arr[$i]['cat_id']; ?>"><?php echo $arr[$i]['name']; ?> </option>
								<?php } ?></select><input type="hidden"  value="" id="var1_pro_id_4" name="var1_pro_id_4"/></td>&nbsp;&nbsp;
								<td id="ajax_4"></td>
								<td id="pro_4"></td>
								<td id="pro2_4"></td>
								<td>
								Quantity :
								<input type="text" name="quan4" style="width:50px;"/>
								</td>
								</tr>
								<tr>
									<td class="form-field-label">Variable five :</td>
                <td class="form-field-input">
								<select name="var5" id="5" onchange="getscombo(this.value,this.id);">
								<option value="">select Category</option>
								<?php for($i=0;$i<count($arr); $i++) { ?>
								<option value="<?php echo $arr[$i]['cat_id']; ?>"><?php echo $arr[$i]['name']; ?> </option>
								<?php } ?>
								</select><input type="hidden"  value="" id="var1_pro_id_5" name="var1_pro_id_5"/></td>
								<td id="ajax_5"></td>
								<td id="pro_5"></td>
								<td id="pro2_5"></td>
								<td>
								Quantity :
								<input type="text" name="quan5" style="width:50px;"/>
								</td>
								</tr>
								<tr>
								<td class="form-field-label">Variable six :</td>
                <td class="form-field-input">
								<select name="var6" id="6" onchange="getscombo(this.value,this.id);">
								<option value="">select Category</option>
								<?php for($i=0;$i<count($arr); $i++) { ?>
								<option value="<?php echo $arr[$i]['cat_id']; ?>"><?php echo $arr[$i]['name']; ?> </option>
								<?php } ?>
								</select><input type="hidden"  value="" id="var1_pro_id_6" name="var1_pro_id_6"/></td>&nbsp;&nbsp;
								<td id="ajax_6"></td>
								<td id="pro_6"></td>
								<td id="pro2_6"></td>
								<td>
								Quantity :
								<input type="text" name="quan6" style="width:50px;"/>
								</td>
								
							 </tr>
							 
							 <tr>
								
							  <td class="form-field-label">Variable seven :</td>
                <td class="form-field-input">
								<select name="var7" id="7" onchange="getscombo(this.value,this.id);">
								<option value="">select Category</option>
								<?php for($i=0;$i<count($arr); $i++) { ?>
								<option value="<?php echo $arr[$i]['cat_id']; ?>"><?php echo $arr[$i]['name']; ?> </option>
								<?php } ?></select><input type="hidden"  value="" id="var1_pro_id_7" name="var1_pro_id_7"/></td>&nbsp;&nbsp;
								<td id="ajax_7"></td>
								<td id="pro_7"></td>
								<td id="pro2_7"></td>
								<td>
								Quantity :
								<input type="text" name="quan7" style="width:50px;"/>
								</td>
								</tr>
								<tr>
									<td class="form-field-label">Variable eight :</td>
                <td class="form-field-input">
								<select name="var8" id="8" onchange="getscombo(this.value,this.id);">
								<option value="">select Category</option>
								<?php for($i=0;$i<count($arr); $i++) { ?>
								<option value="<?php echo $arr[$i]['cat_id']; ?>"><?php echo $arr[$i]['name']; ?> </option>
								<?php } ?>
								</select><input type="hidden"  value="" id="var1_pro_id_8" name="var1_pro_id_8"/></td>
								<td id="ajax_8"></td>
								<td id="pro_8"></td>
								<td id="pro2_8"></td>
								<td>
								Quantity :
								<input type="text" name="quan8" style="width:50px;"/>
								</td>
								</tr>
								<tr>
								<tr id="variable_9" >
								<td class="form-field-label">Variable nine :</td>
                <td class="form-field-input">
								<select name="var9" id="9" onchange="getscombo(this.value,this.id);">
								<option value="">select Category</option>
								<?php for($i=0;$i<count($arr); $i++) { ?>
								<option value="<?php echo $arr[$i]['cat_id']; ?>"><?php echo $arr[$i]['name']; ?> </option>
								<?php } ?>
								</select><input type="hidden"  value="" id="var1_pro_id_9" name="var1_pro_id_9"/>
								<input type="hidden"  value="" id="var1_pro_id_9" name="var1_pro_id_9"/>
								</td>&nbsp;&nbsp;
								<td id="ajax_9"></td>
								<td id="pro_9"></td>
								<td id="pro2_9"></td>
								<td>
								Quantity :
								<input type="text" name="quan9" style="width:50px;"/>
								</td>
								
							 </tr>
							 
							 </tr>
							 
							 <tr>
								
							  <td class="form-field-label">Variable ten :</td>
                <td class="form-field-input">
								<select name="var10" id="10" onchange="getscombo(this.value,this.id);">
								<option value="">select Category</option>
								<?php for($i=0;$i<count($arr); $i++) { ?>
								<option value="<?php echo $arr[$i]['cat_id']; ?>"><?php echo $arr[$i]['name']; ?> </option>
								<?php } ?></select><input type="hidden"  value="" id="var1_pro_id_10" name="var1_pro_id_10"/></td>&nbsp;&nbsp;
								<td id="ajax_10"></td>
								<td id="pro_10"></td>
								<td id="pro2_10"></td>
								<td>
								Quantity :
								<input type="text" name="quan10" style="width:50px;"/>
								</td>
								</tr>
								<tr>
									<td class="form-field-label">Variable eleven :</td>
                <td class="form-field-input">
								<select name="var11" id="11" onchange="getscombo(this.value,this.id);">
								<option value="">select Category</option>
								<?php for($i=0;$i<count($arr); $i++) { ?>
								<option value="<?php echo $arr[$i]['cat_id']; ?>"><?php echo $arr[$i]['name']; ?> </option>
								<?php } ?>
								</select><input type="hidden"  value="" id="var1_pro_id_11" name="var1_pro_id_11"/></td>
								<td id="ajax_11"></td>
								<td id="pro_11"></td>
								<td id="pro2_11"></td>
								<td>
								Quantity :
								<input type="text" name="quan11" style="width:50px;"/>
								</td>
								</tr>
								<tr>
								<td class="form-field-label">Variable twelve :</td>
                <td class="form-field-input">
								<select name="var12" id="12" onchange="getscombo(this.value,this.id);">
								<option value="">select Category</option>
								<?php for($i=0;$i<count($arr); $i++) { ?>
								<option value="<?php echo $arr[$i]['cat_id']; ?>"><?php echo $arr[$i]['name']; ?> </option>
								<?php } ?>
								</select><input type="hidden"  value="" id="var1_pro_id_12" name="var1_pro_id_12"/></td>&nbsp;&nbsp;
								<td id="ajax_12"></td>
								<td id="pro_12"></td>
								<td id="pro2_12"></td>
								<td>
								Quantity :
								<input type="text" name="quan12" style="width:50px;"/>
								</td>
								
							 </tr>
							 
							 <tr>
								
							  <td class="form-field-label">Variable thirteen :</td>
                <td class="form-field-input">
								<select name="var13" id="13" onchange="getscombo(this.value,this.id);">
								<option value="">select Category</option>
								<?php for($i=0;$i<count($arr); $i++) { ?>
								<option value="<?php echo $arr[$i]['cat_id']; ?>"><?php echo $arr[$i]['name']; ?> </option>
								<?php } ?></select><input type="hidden"  value="" id="var1_pro_id_13" name="var1_pro_id_13"/></td>&nbsp;&nbsp;
								<td id="ajax_13"></td>
								<td id="pro_13"></td>
								<td id="pro2_13"></td>
								<td>
								Quantity :
								<input type="text" name="quan13" style="width:50px;"/>
								</td>
								</tr>
								<tr>
									<td class="form-field-label">Variable fourteen :</td>
                <td class="form-field-input">
								<select name="var14" id="14" onchange="getscombo(this.value,this.id);">
								<option value="">select Category</option>
								<?php for($i=0;$i<count($arr); $i++) { ?>
								<option value="<?php echo $arr[$i]['cat_id']; ?>"><?php echo $arr[$i]['name']; ?> </option>
								<?php } ?>
								</select><input type="hidden"  value="" id="var1_pro_id_14" name="var1_pro_id_14"/></td>
								<td id="ajax_14"></td>
								<td id="pro_14"></td>
								<td id="pro2_1"4></td>
								<td>
								Quantity :
								<input type="text" name="quan14" style="width:50px;"/>
								</td>
								</tr>
								<tr>
								<td class="form-field-label">Variable fifteen :</td>
                <td class="form-field-input">
								<select name="var15" id="15" onchange="getscombo(this.value,this.id);">
								<option value="">select Category</option>
								<?php for($i=0;$i<count($arr); $i++) { ?>
								<option value="<?php echo $arr[$i]['cat_id']; ?>"><?php echo $arr[$i]['name']; ?> </option>
								<?php } ?>
								</select><input type="hidden"  value="" id="var1_pro_id_15" name="var1_pro_id_15"/></td>&nbsp;&nbsp;
								<td id="ajax_15"></td>
								<td id="pro_15"></td>
								<td id="pro2_15"></td>
								<td>
								Quantity :
								<input type="text" name="quan15" style="width:50px;"/>
								</td>
								
							 </tr>
								
                <tr>
								
                <td class="form-field-label">No. Of Quantity <span class="star">*</span> :</td>
                <td class="form-field-input"> <input type="text" name="selection[0]" id="selfour0"/></td>
                
                
                <td class="form-field-label" style="text-align:left;">For Category</td>
                <td class="form-field-input">
                
                <select name="cat_type[0]" id="check0" onchange="getval_four(this.value,this.id);">
                <option value="">Select Category</option>
								<?php while($result=mysql_fetch_array($getcat_4)) { ?>
                                
                <option value="<?php echo $result['cat_id'];?>"><?php echo $result['name'];?></option>
                 <?php } ?></select>
								 </td>
								 <td class="form-field-input" id="getp0"></td>
                 
                <td class="form-field-input" id="citydiv0" name="citydiv0">
                <a id='add_more_attr' style='cursor:pointer; position:relative;top:0px; left:0px;' onclick="javascript: add_option();"><img src='image/add.png'/></a>

                </tr>
                </table>
                <div id="add_new_attr2">
                </div>
				<table id="deal5" style="display:none;">
                <tr> 
                <td class="form-field-label">Discount Type<span class="star">*</span> :</td>
                <td class="form-field-input" >
                
                <select name="discount_type_five">
				<option value="">Select Type</option>
                <option value="percentage">Percentage</option>
				<option value="sum">Sum</option></select>
                </tr>
			   
			   <tr>
                <td class="form-field-label">Value(off)<span class="star">*</span> :</td>
                <td class="form-field-input"><input type="text" name="amount_value" /></td>
                </tr>
                <tr>
                <td class="form-field-label">Amount Over<span class="star">*</span> :</td>
                <td class="form-field-input"><input type="text" name="amount_over"/></td>
				</tr>
                </table>
								
								<table>
								<tr>
                <td class="form-field-label">Status<span class="star">*</span> :</td>
                <td class="form-field-input"><input name="deal_status" id="active" type="radio" value="1" checked="checked" />&nbsp;Active&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="deal_status" id="inactive" type="radio" value="0" />&nbsp;Inactive</td>
              </tr>
								</table>
				
                
        <input name="save" type="image" src="image/button_save.png" />
                  <input name="cancel" type="image" src="image/button_cancel.png" />
        </form>
        </div>
        <!-- Form Ends here -->
         <?php
        }
        ?>
		 <!-- Form to edit records -->
         <div id="box-edit" class="hidden">
          <div id="content">
            <h2>Edit Deals</h2>
            <form method="post" action="<?php echo $path_edit?>">
			<input type="hidden" name="deal_three_option">
			<input type="hidden" name="deal_four_option">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="form-field-label">Deal Name<span class="star">*</span> :</td>
                <td class="form-field-input"><input name="dealsname" type="text" /></td>
              </tr>
              
              <tr>
				     <td class="form-field-label">Description :</td>
				     <td class="form-field-input"><textarea name="desc" rows="6"></textarea></td>
			        </tr>
              
              <tr>
                <td class="form-field-label">Days<span class="star">*</span> :</td>
                <td class="form-field-input">
                	  
                    <input name="days[]" id="day_all_edit" type="checkbox"  value="0"  />&nbsp;All&nbsp;&nbsp;
				    <input name="days[]" class="day_edit" id="day_edit1" type="checkbox"  value="1" id="day1" />&nbsp;Mon&nbsp;&nbsp;
                    <input name="days[]" class="day_edit" id="day_edit2" type="checkbox"  value="2" id="day2" />&nbsp;Tue&nbsp;&nbsp;
                     <input name="days[]" class="day_edit" id="day_edit3" type="checkbox" value="3" id="day3" />&nbsp;Wed&nbsp;&nbsp;
                     <input name="days[]" class="day_edit" id="day_edit4" type="checkbox"  value="4" id="day4" />&nbsp;Thu&nbsp;&nbsp;
                     <input name="days[]" class="day_edit" id="day_edit5" type="checkbox"  value="5" id="day5" />&nbsp;Fri&nbsp;&nbsp;
                     <input name="days[]" class="day_edit" id="day_edit6" type="checkbox"  value="6" id="day6" />&nbsp;Sat&nbsp;&nbsp;
                     <input name="days[]" class="day_edit" id="day_edit7" type="checkbox" value="7" id="day7" />&nbsp;Sun&nbsp;&nbsp;
                </td>
              </tr>
			  <tr>
                <td class="form-field-label">Date:<span class="star">*</span> :</td>
                <td class="form-field-input">From:&nbsp;<input type="text" name="start_date_edit"   readonly="readonly" style="width:90px;"/>&nbsp;&nbsp;&nbsp;To:&nbsp;<input type="text" name="end_date_edit" id="datepicker_edit_t" readonly="readonly" style="width:90px;"/></td>
              </tr>
              <tr>
                <td class="form-field-label">Time:</td>
                <td class="form-field-input">From:&nbsp;<input type="text" name="start_time" readonly="readonly" id="time_edit_f" style="width:90px;"/>&nbsp;&nbsp;&nbsp;To:&nbsp;<input type="text" id="time_edit_t" name="end_time" readonly="readonly" style="width:90px;"/></td>
              </tr>
               
			  
			   <tr>
				     <td class="form-field-label">Deal Type :</td>
				     <td class="form-field-input"><input type="text" name="deal_type_desc" readonly="readonly"/></td>
			        </tr>
              
              <tr>
              <tr>
                
                
              </tr></table>
             <div id="showdiv" style="display:none;">  
             <table>
            
             <tr>
                <td class="form-field-label">BuyOne(Category)<span class="star">*</span> :</td>
                <td class="form-field-input">
                <select name="buyoneedit" id="edit_buyone_1" onchange="byonegetoneedit(this.value,this.id)">
                <option value="">Select Category</option>
                <?php while($res=mysql_fetch_array($editcat)) { ?>
                <option value="<?php echo $res['cat_id']; ?>"><?php echo $res['name']; ?></option>

                <?php } ?>
                </select>
                </td>
								
								<td id="ajaxedit_buyonegetone_1"></td>
								<td>
								<input type="hidden" id="buyone_txtedit" name="buyone_txtedit" value=""/>
								</td>
                </tr>
                
                <tr>
                <td class="form-field-label">GetOne(Category)<span class="star">*</span> :</td>
                <td class="form-field-input">
                <select name="getoneedit" id="edit_buyone_2" onchange="byonegetoneedit(this.value,this.id)">
                <option value="">Select Category</option>
                <?php while($row=mysql_fetch_array($editcatgetone)) { ?>
                <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['name']; ?></option>

                <?php } ?>
                </select></td>
								<td id="ajaxedit_buyonegetone_2"></td>
                <td><input type="hidden" id="getone_txtedit" name="getone_txtedit" value=""/></td>
                </tr>
                
                
                <tr>
                <td class="form-field-label"><input name="did" type="hidden" value="" />
                <td class="form-field-label"><input name="dealtypeid" type="hidden" value="" /></td><td class="form-field-input"></td><td class="form-field-input"></td></tr></table></div>
                
                <div id="dealtype2" style="display:none;">
                <table>
                <tr>
                <td class="form-field-label">Discount Type<span class="star">*</span> :</td>
                <td class="form-field-input">
                <select name="discount_type">
                <option value="">Select Discount Type</option>
                <option value="percentage">Discount In Percentage</option>
                <option value="price">Discount In Price</option>
                
                </select>
                <td class="form-field-label">Amount<span class="star">*</span> :</td>
                <td class="form-field-input"><input type="text" name="discount_price_edit" /></td>
                </tr>
                </table>
                </div>
           <div id="SELECTOR"></div>
				<div id="SELECTOR_THREE"></div>
                <div id="add_new_attr2"></div>
				<div id="dealtype5" style="display:none;">
                <table>
                <tr>
                <td class="form-field-label">Discount Type<span class="star">*</span> :</td>
                <td class="form-field-input">
                <select name="discount_type_five_edit">
                <option value="">Select Discount Type</option>
                <option value="percentage">Percentage</option>
                <option value="sum">Sum</option>
                
                </select>
               <tr>
                <td class="form-field-label">Value(off)<span class="star">*</span> :</td>
                <td class="form-field-input"><input type="text" name="amount_value_edit" /></td>
                </tr>
                <tr>
                <td class="form-field-label">Amount Over<span class="star">*</span> :</td>
                <td class="form-field-input"><input type="text" name="amount_over_edit"/></td>
				</tr>
                </table>
                </div>
								
								<table>
								<tr>
                <td class="form-field-label">Status<span class="star">*</span> :</td>
                <td class="form-field-input"><input name="deal_stat" id="editactivestatus" type="radio" value="1" />&nbsp;Active&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="deal_stat" id="editinactivestatus" type="radio" value="0" />&nbsp;Inactive</td>
              </tr>
								</table>
                
        
        <input name="save" type="image" src="image/button_save.png" />
                  <input name="cancel" type="image" src="image/button_cancel.png" />
         
            </form>
          </div>
        </div>
        <!-- Form Ends here --> 
        
        <!-- Box - Error Start -->
        <div id="box-error" class="hidden">
          <div id="content"></div>
        </div>
        <!-- Box - Error End --> 
        
        <!-- Records Start Here -->
        <div id="records">
          <table width="100%" border="0" cellspacing="1" cellpadding="0" id="table_to_sort">
            <thead>
		<tr>
			<th width="90">Deal Name</th>
			<th width="110">Deal Type</th>
      <th width="50">Description</th>
      <th width="90">Start Date</th>
      <th width="70">End Date</th>
      <th width="70">Start time</th>      
      <th width="70">End Time</th>
      <th width="50">Status</th>
      <th width="50">Action</th>
           
		</tr>
	</thead>
  <tbody>
<?php
     
	if(isset($count) > 0)
	{
		$i = 0;
		while($row = mysql_fetch_assoc($query2))
		{
			$i++;
			$get_deal_cat_type= mysql_query( "SELECT cat_name FROM ".TBL_DEALS_CATEGORY." where id=".$row['deal_cat_id']."");
			$get_deal_cat_type_res=mysql_fetch_array($get_deal_cat_type);
			
			 $getdealtype=mysql_query( "SELECT * FROM ".TBL_DEALS_TYPE_BOGOF." where deal_id=".$row['id']."");
			
			$getdealcat=mysql_query( "SELECT cat_name FROM ".TBL_DEALS_CATEGORY." where id=".$row['deal_cat_id']."");
			$gdct=mysql_fetch_array($getdealcat);
			if($row['deal_cat_id']==3)
			{
			 $getdeal_three=mysql_query( "SELECT * FROM ".TBL_DEALS_PRODUCT_PACKAGE." where deal_id=".$row['id']."");
			 $get_counter_three=mysql_num_rows($getdeal_three);
			}
			else { $get_counter_three =""; }
			if($row['deal_cat_id']==4)
			{
			$varoneedit = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	$vartwoedit = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	$varthreeedit = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	$varfouredit = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	$varfiveedit = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	$varsixedit = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	$varsevenedit = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	$vareightedit = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	$varnineedit = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	$vartenedit = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	$varelevenedit = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	$vartwelveedit = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	$varthirteenedit = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	$varfourteenedit = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	$varfifteenedit = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
	
	
			 $getdeal_four=mysql_query("SELECT * FROM ".TBL_DEALS_COMBO." where deal_id=".$row['id']." AND selection_option ='default'");
			 $getdeal_v1=mysql_query("SELECT * FROM ".TBL_DEALS_COMBO." where deal_id=".$row['id']." AND selection_option ='v1'");
			 $getdeal_v2=mysql_query("SELECT * FROM ".TBL_DEALS_COMBO." where deal_id=".$row['id']." AND selection_option ='v2'");
			 $getdeal_v3=mysql_query("SELECT * FROM ".TBL_DEALS_COMBO." where deal_id=".$row['id']." AND selection_option ='v3'");
			 $getdeal_v4=mysql_query("SELECT * FROM ".TBL_DEALS_COMBO." where deal_id=".$row['id']." AND selection_option ='v4'");
			 $getdeal_v5=mysql_query("SELECT * FROM ".TBL_DEALS_COMBO." where deal_id=".$row['id']." AND selection_option ='v5'");
			 $getdeal_v6=mysql_query("SELECT * FROM ".TBL_DEALS_COMBO." where deal_id=".$row['id']." AND selection_option ='v6'");
			 $getdeal_v7=mysql_query("SELECT * FROM ".TBL_DEALS_COMBO." where deal_id=".$row['id']." AND selection_option ='v7'");
			 $getdeal_v8=mysql_query("SELECT * FROM ".TBL_DEALS_COMBO." where deal_id=".$row['id']." AND selection_option ='v8'");
			 $getdeal_v9=mysql_query("SELECT * FROM ".TBL_DEALS_COMBO." where deal_id=".$row['id']." AND selection_option ='v9'");
			 $getdeal_v10=mysql_query("SELECT * FROM ".TBL_DEALS_COMBO." where deal_id=".$row['id']." AND selection_option ='v10'");
			 $getdeal_v11=mysql_query("SELECT * FROM ".TBL_DEALS_COMBO." where deal_id=".$row['id']." AND selection_option ='v11'");
			 $getdeal_v12=mysql_query("SELECT * FROM ".TBL_DEALS_COMBO." where deal_id=".$row['id']." AND selection_option ='v12'");
			 $getdeal_v13=mysql_query("SELECT * FROM ".TBL_DEALS_COMBO." where deal_id=".$row['id']." AND selection_option ='v13'");
			 $getdeal_v14=mysql_query("SELECT * FROM ".TBL_DEALS_COMBO." where deal_id=".$row['id']." AND selection_option ='v14'");
			 $getdeal_v15=mysql_query("SELECT * FROM ".TBL_DEALS_COMBO." where deal_id=".$row['id']." AND selection_option ='v15'");
			 if(isset($getdeal_four)){$get_counter=mysql_num_rows($getdeal_four);}
			}
			else { $get_counter=""; }
			if($row['deal_cat_id']==5)
			{
			 $getdeal_five=mysql_query( "SELECT * FROM ".TBL_FLAT_DISCOUNT_DEALS." where deal_id=".$row['id']."");
			 //$get_counter_three=mysql_num_rows($getdeal_three);
			}
			
			if ($row['status'] == 1)
			{
				$status = 'Active';
			}
			else
			{
				$status = 'InActive';
			}
			$pieces = explode(",", $row['available_days']);
			
			$cntel=count($pieces);
			?>
		<tr class="<?php echo $i % 2 ? 'row_one_record' : 'row_two_record' ?>" dID="<?php echo $row['id'];?>"avail="<?php echo $row['status'];?>" desc = "<?php echo $row['description'];?>" dealtypeid="<?php echo $row['deal_cat_id'];?>">
		
		
		
		 <td cl="dealname"><?php echo $row['deal_name'];?></td>
	  <td cl="deal_cat_name"><?php echo $gdct['cat_name'];?></td>
      <td style="display:none;" width="50" cl="deal_id"><?php echo $row['id'];?></td>
      <td style="display:none;" width="50" cl="deal_cat_id"><?php echo $row['deal_cat_id'];?></td>
      <td style="display:none;" width="50" cl="deal_p"><?php echo $row['deal_price'];?></td>
      <td style="display:none;" width="50" cl="desc"><?php echo $row['description'];?></td>
	  <td width="50" cl="description"><a class="Show_description">Description</a></td>
      <td style="display:none;" cl="start_date_e"><?php echo $row['start_date'];?>
      <td style="display:none;" cl="end_date_e"><?php echo $row['end_date'];?>
      <td cl="start"><?php echo date('d-m-Y',strtotime(str_replace("/",".",$row['start_date'])));?>
      <td cl="end"><?php echo date('d-m-Y',strtotime(str_replace("/",".",$row['end_date'])));?>
      <td cl="start_time"><?php echo $row['start_time'];?>
      <td cl="end_time"><?php echo $row['end_time'];?>
      <td style="display:none;" cl="len"><?php echo $cntel;?>
      <td style="display:none;" cl="pie"><?php echo json_encode($pieces);?></td>
      <td width="50" cl="status"><?php echo $status;?></td>
	  
      <?php foreach($pieces as $k=>$v)
      { ?>
      <td style="display:none;" cl="pieces<?php echo $v;?>"> <?php echo $v;?></td>
       <?php } ?>
      
      <td width="50"><img class="edit" src="image/edit.png" width="20" height="20" /><?php if($isFull) { ?><img class="delete" src="image/delete.png" width="20" height="20" /><?php } ?></td>
     
		
		
      <?php while($rows = mysql_fetch_assoc($getdealtype)){ ?>
      
      <td style="display:none;" width="50" cl="buy_one_id"><?php echo $rows['buy_one_cat_id'];?></td>
      <td style="display:none;" width="50" cl="discount_type"><?php echo $rows['discount_type'];?></td>
      <td style="display:none;" width="50" cl="discount_amount"><?php echo $rows['discount_amount'];?></td>
	  
      <td style="display:none;" width="50" cl="get_one_id"><?php echo $rows['get_one_cat_id'];?></td>
      <?php }  ?>
	  
	   <?php if(isset($getdeal_five)) { while($row_five = mysql_fetch_assoc($getdeal_five)){ ?>
      
      <td style="display:none;" width="50" cl="d_t_five"><?php echo $row_five['discount_type'];?></td>
      <td style="display:none;" width="50" cl="d_t_v_five"><?php echo $row_five['discount_type_value'];?></td>
      <td style="display:none;" width="50" cl="amount_over_five"><?php echo $row_five['amount_over'];?></td>
	  
      <td style="display:none;" width="50" cl="get_one_id"><?php echo $rows['get_one_cat_id'];?></td>
      <?php } } ?>
	  
      <td style="display:none;" width="50" cl="get_html">
	  <table>
	  <tr>
			<td class="form-field-label">Deal Price<span class="star">*</span> :</td>
            <td class="form-field-input"><input type="text" name="deal_amount_edit" value="<?php echo $row['deal_price']; ?>" /></td>
			</tr>
			<tr <?php while($val1=mysql_fetch_array($getdeal_v1)) { if($val1['selection_option']=='v1') { ?>>
			<td class="form-field-label">Variable one :</td>
			<td class="form-field-input" id="one_<?php echo $row['id']; ?>">
			<select name="var1edit" id="v1_<?php echo $row['id']; ?>" onchange="getseditcombo(this.value,this.id);"><option value="">Select Category </option>
			<?php while($resedit=mysql_fetch_array($varoneedit)) { ?>		
			<option value="<?php echo $resedit['cat_id'];  ?>" <?php echo ($val1['product_id']==$resedit['cat_id']) ? 'selected="selected"':''?>/><?php echo $resedit['name']; ?></option>
			<?php } ?></select>
			
			</td>
			<td id="ajaxedit_1"><?php 
			$query=mysql_query('SELECT type FROM '.TBL_PRODUCT_CATEGORIES.' WHERE cat_id = "'.$val1['product_id'].'"');
			$res=mysql_fetch_array($query);
				if($res['type']=="g"){ ?> <?php } else { ?>
				
				<select name="getsize[]" id="gets">
				<option value="any" <?php if($val1['size_name']=="any") {?> selected="selected" <?php } ?>>Any Size</option>
			<option value="personal" <?php if($val1['size_name']=="personal") {?> selected="selected" <?php } ?>>Personal(4 Slices)</option>
			<option value="small" <?php if($val1['size_name']=="small") {?> selected="selected" <?php } ?>>Small(6 Slices)</option>
			<option value="medium" <?php if($val1['size_name']=="medium") {?> selected="selected" <?php } ?>>Medium(8 Slices)</option>
			<option value="large" <?php if($val1['size_name']=="large") {?> selected="selected" <?php } ?>>Large(10 Slices)</option>
				<?php } ?>
	
</select>
			
			</td><?php } else { }?>
			<td id="pro_edit_1">
			<select name="getpro_edit_1[]" id="pro_edit_drp1_1" onchange="change_product_edit_sel(this.id,this.value)"><?php 
			$pro1 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val1['product_id'].'"'); 
			while($info=mysql_fetch_array($pro1))
			{?><option value="<?php echo $info['product_id'] ?>" <?php if($val1['product_one']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			
			<td id="pro2_edit_1">
			<select name="getpro_edit_2[]" id="pro_edit_drp2_2"><?php 
			$pro2 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val1['product_id'].'"'); 
			while($info=mysql_fetch_array($pro2))
			{?><option value="<?php echo $info['product_id'] ?>" <?php if($val1['product_two']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			<td>
								Quantity :
								<input type="text" name="quanedit1" style="width:50px;" value="<?php echo $val1['quantity'];?>"/>
								<input type="hidden"  value="<?php echo $val1['product_id']; ?>" id="var1_edit_pro_id_1" name="var1_pro_id_1"/>
								</td>
			</tr>
			 <?php } ?>
			
			
			<tr<?php while($val2=mysql_fetch_array($getdeal_v2)) { if($val2['selection_option']=='v2') { ?>>
			<td class="form-field-label">Variable two :</td>
			<td class="form-field-input" id="two_<?php echo $row['id']; ?>">
			<select name="var2edit" id="v2_<?php echo $row['id']; ?>" onchange="getseditcombo(this.value,this.id);"><option value="">Select Category </option>
			<?php while($resedittwo=mysql_fetch_array($vartwoedit)) { ?>
			<option value="<?php echo $resedittwo['cat_id']; ?>"<?php echo ($val2['product_id']==$resedittwo['cat_id']) ? 'selected="selected"':''?>/><?php echo $resedittwo['name']; ?></option>
			<?php } ?></select>
			</td>
			
			<td id="ajaxedit_2">
			<?php 
			$query=mysql_query('SELECT type FROM '.TBL_PRODUCT_CATEGORIES.' WHERE cat_id = "'.$val2['product_id'].'"');
			$res=mysql_fetch_array($query);
				if($res['type']=="g"){ ?> <?php } else { ?>
				
				<select name="getsize[]" id="gets">
				<option value="any" <?php if($val2['size_name']=="any") {?> selected="selected" <?php } ?>>Any Size</option>
			<option value="personal" <?php if($val2['size_name']=="personal") {?> selected="selected" <?php } ?>>Personal(4 Slices)</option>
			<option value="small" <?php if($val2['size_name']=="small") {?> selected="selected" <?php } ?>>Small(6 Slices)</option>
			<option value="medium" <?php if($val2['size_name']=="medium") {?> selected="selected" <?php } ?>>Medium(8 Slices)</option>
			<option value="large" <?php if($val2['size_name']=="large") {?> selected="selected" <?php } ?>>Large(10 Slices)</option>
				<?php } ?>
	
</select>
			
			</td><?php } else { }?>
			<td id="pro_edit_2">
			<select name="getpro_edit_1[]" id="pro_edit_drp1_2" onchange="change_product_edit_sel(this.id,this.value)"><?php 
			$pro1 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val2['product_id'].'"'); 
			while($info=mysql_fetch_array($pro1))
			{?><option value="<?php echo $info['product_id'] ?>" <?php if($val2['product_one']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			
			<td id="pro2_edit_2">
			<select name="getpro_edit_2[]" id="pro_edit_drp2_2"><?php 
			$pro2 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val2['product_id'].'"'); 
			while($info=mysql_fetch_array($pro2))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val2['product_two']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			<td>
								Quantity :
								<input type="text" name="quanedit2" style="width:50px;" value="<?php echo $val2['quantity'];?>"/>
								<input type="hidden"  value="<?php echo $val2['product_id']; ?>" id="var1_edit_pro_id_2" name="var1_pro_id_2"/>
								</td>
			</tr>
			 <?php } ?>
			</tr>
			
			
			<tr<?php while($val3=mysql_fetch_array($getdeal_v3)) { if($val3['selection_option']=='v3') { ?>>
			<td class="form-field-label">Variable three :</td>
			<td class="form-field-input" id="three_<?php echo $row['id']; ?>">
			<select name="var3edit" id="v3_<?php echo $row['id']; ?>" onchange="getseditcombo(this.value,this.id);"><option value="">Select Category </option>
			<?php while($reseditthree=mysql_fetch_array($varthreeedit)) { ?>
			<option value="<?php echo $reseditthree['cat_id']; ?>"<?php echo ($val3['product_id']==$reseditthree['cat_id']) ? 'selected="selected"':''?>/><?php echo $reseditthree['name']; ?></option>
			<?php } ?></select>
			</td>
			<td id="ajaxedit_3">
			
			<?php 
			$query=mysql_query('SELECT type FROM '.TBL_PRODUCT_CATEGORIES.' WHERE cat_id = "'.$val3['product_id'].'"');
			$res=mysql_fetch_array($query);
				if($res['type']=="g"){ ?> <?php } else { ?>
				
				<select name="getsize[]" id="gets">
				<option value="any" <?php if($val3['size_name']=="any") {?> selected="selected" <?php } ?>>Any Size</option>
			<option value="personal" <?php if($val3['size_name']=="personal") {?> selected="selected" <?php } ?>>Personal(4 Slices)</option>
			<option value="small" <?php if($val3['size_name']=="small") {?> selected="selected" <?php } ?>>Small(6 Slices)</option>
			<option value="medium" <?php if($val3['size_name']=="medium") {?> selected="selected" <?php } ?>>Medium(8 Slices)</option>
			<option value="large" <?php if($val3['size_name']=="large") {?> selected="selected" <?php } ?>>Large(10 Slices)</option>
				<?php } ?>
		</select>	
			</td><?php } else { }?>
			<td id="pro_edit_3">
			<select name="getpro_edit_1[]" id="pro_edit_drp1_3" onchange="change_product_edit_sel(this.id,this.value)"><?php 
			$pro1 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val3['product_id'].'"'); 
			while($info=mysql_fetch_array($pro1))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val3['product_one']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			
			<td id="pro2_edit_3">
			<select name="getpro_edit_2[]" id="pro_edit_drp2_3"><?php 
			$pro2 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val3['product_id'].'"'); 
			while($info=mysql_fetch_array($pro2))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val3['product_two']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			<td>
								Quantity :
								<input type="text" name="quanedit3" style="width:50px;" value="<?php echo $val3['quantity'];?>"/>
								<input type="hidden"  value="<?php echo $val3['product_id']; ?>" id="var1_edit_pro_id_3" name="var1_pro_id_3"/>
								</td>
			</tr>
			 <?php } ?>
			</tr>
			
			<tr<?php while($val4=mysql_fetch_array($getdeal_v4)) { if($val4['selection_option']=='v4') { ?>>
			<td class="form-field-label">Variable four :</td>
			<td class="form-field-input" id="four_<?php echo $row['id']; ?>">
			<select name="var4edit" id="v4_<?php echo $row['id']; ?>" onchange="getseditcombo(this.value,this.id);"><option value="">Select Category </option>
			<?php while($reseditfour=mysql_fetch_array($varfouredit)) { ?>
			<option value="<?php echo $reseditfour['cat_id']; ?>"<?php echo ($val4['product_id']==$reseditfour['cat_id']) ? 'selected="selected"':''?>/><?php echo $reseditfour['name']; ?></option>
			<?php } ?></select>
			</td>
			<td id="ajaxedit_4">
			<?php
			$query=mysql_query('SELECT type FROM '.TBL_PRODUCT_CATEGORIES.' WHERE cat_id = "'.$val4['product_id'].'"');
			$res=mysql_fetch_array($query);
				if($res['type']=="g"){ ?> <?php } else { ?>
				
				<select name="getsize[]" id="gets">
				<option value="any" <?php if($val4['size_name']=="any") {?> selected="selected" <?php } ?>>Any Size</option>
			<option value="personal" <?php if($val4['size_name']=="personal") {?> selected="selected" <?php } ?>>Personal(4 Slices)</option>
			<option value="small" <?php if($val4['size_name']=="small") {?> selected="selected" <?php } ?>>Small(6 Slices)</option>
			<option value="medium" <?php if($val4['size_name']=="medium") {?> selected="selected" <?php } ?>>Medium(8 Slices)</option>
			<option value="large" <?php if($val4['size_name']=="large") {?> selected="selected" <?php } ?>>Large(10 Slices)</option>
				<?php } ?>
		</select>
			
			
			</td><?php } else { }?>
			<td id="pro_edit_4">
			<select name="getpro_edit_1[]" id="pro_edit_drp1_4" onchange="change_product_edit_sel(this.id,this.value)"><?php 
			$pro1 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val4['product_id'].'"'); 
			while($info=mysql_fetch_array($pro1))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val4['product_one']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			
			<td id="pro2_edit_4">
			<select name="getpro_edit_2[]" id="pro_edit_drp2_4"><?php 
			$pro4 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val4['product_id'].'"'); 
			while($info=mysql_fetch_array($pro4))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val4['product_two']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			<td>
								Quantity :
								<input type="text" name="quanedit4" style="width:50px;" value="<?php echo $val4['quantity'];?>"/>
								<input type="hidden"  value="<?php echo $val4['product_id']; ?>" id="var1_edit_pro_id_4" name="var1_pro_id_4"/>
								</td>
			</tr>
			 <?php } ?>
			</tr>
			
			
			<tr<?php while($val5=mysql_fetch_array($getdeal_v5)) { if($val5['selection_option']=='v5') { ?>>
			<td class="form-field-label">Variable Five :</td>
			<td class="form-field-input" id="five_<?php echo $row['id']; ?>">
			<select name="var5edit" id="v5_<?php echo $row['id']; ?>" onchange="getseditcombo(this.value,this.id);"><option value="">Select Category </option>
			<?php while($reseditfive=mysql_fetch_array($varfiveedit)) { ?>
			<option value="<?php echo $reseditfive['cat_id']; ?>"<?php echo ($val5['product_id']==$reseditfive['cat_id']) ? 'selected="selected"':''?>/><?php echo $reseditfive['name']; ?></option>
			<?php } ?></select></td>
			<td id="ajaxedit_5">
			<?php
			$query=mysql_query('SELECT type FROM '.TBL_PRODUCT_CATEGORIES.' WHERE cat_id = "'.$val5['product_id'].'"');
			$res=mysql_fetch_array($query);
				if($res['type']=="g"){ ?> <?php } else { ?>
				
				<select name="getsize[]" id="gets">
				<option value="any" <?php if($val5['size_name']=="any") {?> selected="selected" <?php } ?>>Any Size</option>
			<option value="personal" <?php if($val5['size_name']=="personal") {?> selected="selected" <?php } ?>>Personal(4 Slices)</option>
			<option value="small" <?php if($val5['size_name']=="small") {?> selected="selected" <?php } ?>>Small(6 Slices)</option>
			<option value="medium" <?php if($val5['size_name']=="medium") {?> selected="selected" <?php } ?>>Medium(8 Slices)</option>
			<option value="large" <?php if($val5['size_name']=="large") {?> selected="selected" <?php } ?>>Large(10 Slices)</option>
				<?php } ?>
		</select>
			
			</td><?php } else { }?>
			<td id="pro_edit_5">
			<select name="getpro_edit_1[]" id="pro_edit_drp1_5" onchange="change_product_edit_sel(this.id,this.value)"><?php 
			$pro1 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val5['product_id'].'"'); 
			while($info=mysql_fetch_array($pro1))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val5['product_one']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			
			<td id="pro2_edit_5">
			<select name="getpro_edit_2[]" id="pro_edit_drp2_5"><?php 
			$pro2 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val5['product_id'].'"'); 
			while($info=mysql_fetch_array($pro2))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val5['product_two']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			<td>
								Quantity :
								<input type="text" name="quanedit5" style="width:50px;" value="<?php echo $val5['quantity'];?>"/>
								<input type="hidden"  value="<?php echo $val5['product_id']; ?>" id="var1_edit_pro_id_5" name="var1_pro_id_5"/>
								</td>
			</tr>
			 <?php } ?>
			</tr>
	
			
			<tr<?php while($val6=mysql_fetch_array($getdeal_v6)) { if($val6['selection_option']=='v6') { ?>>
			<td class="form-field-label">Variable Six :</td>
			<td class="form-field-input" id="six_<?php echo $row['id']; ?>">
			<select name="var6edit" id="v6_<?php echo $row['id']; ?>" onchange="getseditcombo(this.value,this.id);"><option value="">Select Category </option>
			<?php while($reseditsix=mysql_fetch_array($varsixedit)) { ?>
			<option value="<?php echo $reseditsix['cat_id']; ?>"<?php echo ($val6['product_id']==$reseditsix['cat_id']) ? 'selected="selected"':''?>/><?php echo $reseditsix['name']; ?></option>
			<?php } ?></select>
			
			</td>
			<td id="ajaxedit_6">
			<?php
			$query=mysql_query('SELECT type FROM '.TBL_PRODUCT_CATEGORIES.' WHERE cat_id = "'.$val6['product_id'].'"');
			$res=mysql_fetch_array($query);
				if($res['type']=="g"){ ?> <?php } else { ?>
				
				<select name="getsize[]" id="gets">
				<option value="any" <?php if($val6['size_name']=="any") {?> selected="selected" <?php } ?>>Any Size</option>
			<option value="personal" <?php if($val6['size_name']=="personal") {?> selected="selected" <?php } ?>>Personal(4 Slices)</option>
			<option value="small" <?php if($val6['size_name']=="small") {?> selected="selected" <?php } ?>>Small(6 Slices)</option>
			<option value="medium" <?php if($val6['size_name']=="medium") {?> selected="selected" <?php } ?>>Medium(8 Slices)</option>
			<option value="large" <?php if($val6['size_name']=="large") {?> selected="selected" <?php } ?>>Large(10 Slices)</option>
				<?php } ?>
		</select>
			
			</td><?php } else { }?>
			<td id="pro_edit_6">
			<select name="getpro_edit_1[]" id="pro_edit_drp1_6" onchange="change_product_edit_sel(this.id,this.value)"><?php 
			$pro1 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val6['product_id'].'"'); 
			while($info=mysql_fetch_array($pro1))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val6['product_one']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			
			<td id="pro2_edit_6">
			<select name="getpro_edit_2[]" id="pro_edit_drp2_6"><?php 
			$pro2 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val6['product_id'].'"'); 
			while($info=mysql_fetch_array($pro2))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val6['product_two']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			<td>
								Quantity :
								<input type="text" name="quanedit6" style="width:50px;" value="<?php echo $val6['quantity'];?>"/>
				<input type="hidden"  value="<?php echo $val6['product_id']; ?>" id="var1_edit_pro_id_6" name="var1_pro_id_6"/>				
								</td>
			</tr>
			 <?php } ?>
			</tr>
			
			<tr<?php while($val7=mysql_fetch_array($getdeal_v7)) { if($val7['selection_option']=='v7') { ?>>
			<td class="form-field-label">Variable Seven :</td>
			<td class="form-field-input" id="seven_<?php echo $row['id']; ?>">
			<select name="var7edit" id="v7_<?php echo $row['id']; ?>" onchange="getseditcombo(this.value,this.id);"><option value="">Select Category </option>
			<?php while($reseditseven=mysql_fetch_array($varsevenedit)) { ?>
			<option value="<?php echo $reseditseven['cat_id']; ?>"<?php echo ($val7['product_id']==$reseditseven['cat_id']) ? 'selected="selected"':''?>/><?php echo $reseditseven['name']; ?></option>
			<?php } ?></select>
			
			</td>
			<td id="ajaxedit_7">
			<?php
			$query=mysql_query('SELECT type FROM '.TBL_PRODUCT_CATEGORIES.' WHERE cat_id = "'.$val7['product_id'].'"');
			$res=mysql_fetch_array($query);
				if($res['type']=="g"){ ?> <?php } else { ?>
				
				<select name="getsize[]" id="gets">
				<option value="any" <?php if($val7['size_name']=="any") {?> selected="selected" <?php } ?>>Any Size</option>
			<option value="personal" <?php if($val7['size_name']=="personal") {?> selected="selected" <?php } ?>>Personal(4 Slices)</option>
			<option value="small" <?php if($val7['size_name']=="small") {?> selected="selected" <?php } ?>>Small(6 Slices)</option>
			<option value="medium" <?php if($val7['size_name']=="medium") {?> selected="selected" <?php } ?>>Medium(8 Slices)</option>
			<option value="large" <?php if($val7['size_name']=="large") {?> selected="selected" <?php } ?>>Large(10 Slices)</option>
				<?php } ?>
		</select>
			
			</td><?php } else { }?>
			<td id="pro_edit_7">
			<select name="getpro_edit_1[]" id="pro_edit_drp1_7" onchange="change_product_edit_sel(this.id,this.value)"><?php 
			$pro1 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val7['product_id'].'"'); 
			while($info=mysql_fetch_array($pro1))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val7['product_one']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			
			<td id="pro2_edit_7">
			<select name="getpro_edit_2[]" id="pro_edit_drp2_7"><?php 
			$pro2 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val7['product_id'].'"'); 
			while($info=mysql_fetch_array($pro2))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val7['product_two']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			<td>
								Quantity :
								<input type="text" name="quanedit7" style="width:50px;" value="<?php echo $val7['quantity'];?>"/>
			<input type="hidden"  value="<?php echo $val7['product_id']; ?>" id="var1_edit_pro_id_7" name="var1_pro_id_7"/>	
								</td>
			</tr>
			 <?php } ?>
			</tr>
			
			<tr<?php while($val8=mysql_fetch_array($getdeal_v8)) { if($val8['selection_option']=='v8') { ?>>
			<td class="form-field-label">Variable Eight :</td>
			<td class="form-field-input" id="eight_<?php echo $row['id']; ?>">
			<select name="var8edit" id="v8_<?php echo $row['id']; ?>" onchange="getseditcombo(this.value,this.id);"><option value="">Select Category </option>
			<?php while($resediteight=mysql_fetch_array($vareightedit)) { ?>
			<option value="<?php echo $resediteight['cat_id']; ?>"<?php echo ($val8['product_id']==$resediteight['cat_id']) ? 'selected="selected"':''?>/><?php echo $resediteight['name']; ?></option>
			<?php } ?></select>
			
			</td>
			<td id="ajaxedit_8">
			<?php
			$query=mysql_query('SELECT type FROM '.TBL_PRODUCT_CATEGORIES.' WHERE cat_id = "'.$val8['product_id'].'"');
			$res=mysql_fetch_array($query);
				if($res['type']=="g"){ ?> <?php } else { ?>
				
				<select name="getsize[]" id="gets">
				<option value="any" <?php if($val8['size_name']=="any") {?> selected="selected" <?php } ?>>Any Size</option>
			<option value="personal" <?php if($val8['size_name']=="personal") {?> selected="selected" <?php } ?>>Personal(4 Slices)</option>
			<option value="small" <?php if($val8['size_name']=="small") {?> selected="selected" <?php } ?>>Small(6 Slices)</option>
			<option value="medium" <?php if($val8['size_name']=="medium") {?> selected="selected" <?php } ?>>Medium(8 Slices)</option>
			<option value="large" <?php if($val8['size_name']=="large") {?> selected="selected" <?php } ?>>Large(10 Slices)</option>
				<?php } ?>
		</select>
			
			</td><?php } else { }?>
			<td id="pro_edit_8">
			<select name="getpro_edit_1[]" id="pro_edit_drp1_8" onchange="change_product_edit_sel(this.id,this.value)"><?php 
			$pro1 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val8['product_id'].'"'); 
			while($info=mysql_fetch_array($pro1))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val8['product_one']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			
			<td id="pro2_edit_8">
			<select name="getpro_edit_2[]" id="pro_edit_drp2_8"><?php 
			$pro2 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val8['product_id'].'"'); 
			while($info=mysql_fetch_array($pro2))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val8['product_two']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			<td>
								Quantity :
								<input type="text" name="quanedit8" style="width:50px;" value="<?php echo $val8['quantity'];?>"/>
				<input type="hidden"  value="<?php echo $val8['product_id']; ?>" id="var1_edit_pro_id_8" name="var1_pro_id_8"/>				
								</td>
			</tr>
			 <?php } ?>
			</tr>
			
			<tr<?php while($val9=mysql_fetch_array($getdeal_v9)) { if($val9['selection_option']=='v9') { ?>>
			<td class="form-field-label">Variable Nine :</td>
			<td class="form-field-input" id="nine_<?php echo $row['id']; ?>">
			<select name="var9edit" id="v9_<?php echo $row['id']; ?>" onchange="getseditcombo(this.value,this.id);"><option value="">Select Category </option>
			<?php while($reseditnine=mysql_fetch_array($varnineedit)) { ?>
			<option value="<?php echo $reseditnine['cat_id']; ?>"<?php echo ($val9['product_id']==$reseditnine['cat_id']) ? 'selected="selected"':''?>/><?php echo $reseditnine['name']; ?></option>
			<?php } ?></select>
			
			</td>
			<td id="ajaxedit_9">
			
			<?php
			$query=mysql_query('SELECT type FROM '.TBL_PRODUCT_CATEGORIES.' WHERE cat_id = "'.$val9['product_id'].'"');
			$res=mysql_fetch_array($query);
				if($res['type']=="g"){ ?> <?php } else { ?>
				
				<select name="getsize[]" id="gets">
				<option value="any" <?php if($val9['size_name']=="any") {?> selected="selected" <?php } ?>>Any Size</option>
			<option value="personal" <?php if($val9['size_name']=="personal") {?> selected="selected" <?php } ?>>Personal(4 Slices)</option>
			<option value="small" <?php if($val9['size_name']=="small") {?> selected="selected" <?php } ?>>Small(6 Slices)</option>
			<option value="medium" <?php if($val9['size_name']=="medium") {?> selected="selected" <?php } ?>>Medium(8 Slices)</option>
			<option value="large" <?php if($val9['size_name']=="large") {?> selected="selected" <?php } ?>>Large(10 Slices)</option>
				<?php } ?>
		</select>
			
			</td><?php } else { }?>
			<td id="pro_edit_9">
			<select name="getpro_edit_1[]" id="pro_edit_drp1_9" onchange="change_product_edit_sel(this.id,this.value)"><?php 
			$pro1 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val9['product_id'].'"'); 
			while($info=mysql_fetch_array($pro1))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val9['product_one']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			
			<td id="pro2_edit_9">
			<select name="getpro_edit_2[]" id="pro_edit_drp2_9"><?php 
			$pro2 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val9['product_id'].'"'); 
			while($info=mysql_fetch_array($pro2))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val9['product_two']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			<td>
								Quantity :
								<input type="text" name="quanedit9" style="width:50px;" value="<?php echo $val9['quantity'];?>"/>
			<input type="hidden"  value="<?php echo $val9['product_id']; ?>" id="var1_edit_pro_id_9" name="var1_pro_id_9"/>					
								</td>
			</tr>
			 <?php } ?>
			</tr>
			
			<tr<?php while($val10=mysql_fetch_array($getdeal_v10)) { if($val10['selection_option']=='v10') { ?>>
			<td class="form-field-label">Variable Ten :</td>
			<td class="form-field-input" id="ten_<?php echo $row['id']; ?>">
			<select name="var10edit" id="v10_<?php echo $row['id']; ?>" onchange="getseditcombo(this.value,this.id);"><option value="">Select Category </option>
			<?php while($reseditten=mysql_fetch_array($vartenedit)) { ?>
			<option value="<?php echo $reseditten['cat_id']; ?>"<?php echo ($val10['product_id']==$reseditten['cat_id']) ? 'selected="selected"':''?>/><?php echo $reseditten['name']; ?></option>
			<?php } ?></select>
			
			</td>
			<td id="ajaxedit_10">
			<?php
			$query=mysql_query('SELECT type FROM '.TBL_PRODUCT_CATEGORIES.' WHERE cat_id = "'.$val10['product_id'].'"');
			$res=mysql_fetch_array($query);
				if($res['type']=="g"){ ?> <?php } else { ?>
				
				<select name="getsize[]" id="gets">
				<option value="any" <?php if($val10['size_name']=="any") {?> selected="selected" <?php } ?>>Any Size</option>
			<option value="personal" <?php if($val10['size_name']=="personal") {?> selected="selected" <?php } ?>>Personal(4 Slices)</option>
			<option value="small" <?php if($val10['size_name']=="small") {?> selected="selected" <?php } ?>>Small(6 Slices)</option>
			<option value="medium" <?php if($val10['size_name']=="medium") {?> selected="selected" <?php } ?>>Medium(8 Slices)</option>
			<option value="large" <?php if($val10['size_name']=="large") {?> selected="selected" <?php } ?>>Large(10 Slices)</option>
				<?php } ?>
		</select>
			
			
			</td><?php } else { }?>
			<td id="pro_edit_10">
			<select name="getpro_edit_1[]" id="pro_edit_drp1_10" onchange="change_product_edit_sel(this.id,this.value)"><?php 
			$pro1 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val10['product_id'].'"'); 
			while($info=mysql_fetch_array($pro1))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val10['product_one']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			
			<td id="pro2_edit_10">
			<select name="getpro_edit_2[]" id="pro_edit_drp2_5"><?php 
			$pro2 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val10['product_id'].'"'); 
			while($info=mysql_fetch_array($pro2))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val10['product_two']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			<td>
								Quantity :
								<input type="text" name="quanedit10" style="width:50px;" value="<?php echo $val10['quantity'];?>"/>
			<input type="hidden"  value="<?php echo $val10['product_id']; ?>" id="var1_edit_pro_id_10" name="var1_pro_id_10"/>					
								</td>
			</tr>
			 <?php } ?>
			</tr>
			
			<tr<?php while($val11=mysql_fetch_array($getdeal_v11)) { if($val11['selection_option']=='v11') { ?>>
			<td class="form-field-label">Variable Eleven :</td>
			<td class="form-field-input" id="eleven_<?php echo $row['id']; ?>">
			<select name="var11edit" id="v11_<?php echo $row['id']; ?>" onchange="getseditcombo(this.value,this.id);"><option value="">Select Category </option>
			<?php while($resediteleven=mysql_fetch_array($varelevenedit)) { ?>
			<option value="<?php echo $resediteleven['cat_id']; ?>"<?php echo ($val11['product_id']==$resediteleven['cat_id']) ? 'selected="selected"':''?>/><?php echo $resediteleven['name']; ?></option>
			<?php } ?></select>
			
			</td>
			<td id="ajaxedit_11">
			<?php
			$query=mysql_query('SELECT type FROM '.TBL_PRODUCT_CATEGORIES.' WHERE cat_id = "'.$val11['product_id'].'"');
			$res=mysql_fetch_array($query);
				if($res['type']=="g"){ ?> <?php } else { ?>
				
				<select name="getsize[]" id="gets">
				<option value="any" <?php if($val11['size_name']=="any") {?> selected="selected" <?php } ?>>Any Size</option>
			<option value="personal" <?php if($val11['size_name']=="personal") {?> selected="selected" <?php } ?>>Personal(4 Slices)</option>
			<option value="small" <?php if($val11['size_name']=="small") {?> selected="selected" <?php } ?>>Small(6 Slices)</option>
			<option value="medium" <?php if($val11['size_name']=="medium") {?> selected="selected" <?php } ?>>Medium(8 Slices)</option>
			<option value="large" <?php if($val11['size_name']=="large") {?> selected="selected" <?php } ?>>Large(10 Slices)</option>
				<?php } ?>
		</select>
			
			</td><?php } else { }?>
			<td id="pro_edit_11">
			<select name="getpro_edit_1[]" id="pro_edit_drp1_11" onchange="change_product_edit_sel(this.id,this.value)"><?php 
			$pro1 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val11['product_id'].'"'); 
			while($info=mysql_fetch_array($pro1))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val11['product_one']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			
			<td id="pro2_edit_11">
			<select name="getpro_edit_2[]" id="pro_edit_drp2_11"><?php 
			$pro2 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val11['product_id'].'"'); 
			while($info=mysql_fetch_array($pro2))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val11['product_two']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			<td>
								Quantity :
								<input type="text" name="quanedit11" style="width:50px;" value="<?php echo $val11['quantity'];?>"/>
		<input type="hidden"  value="<?php echo $val11['product_id']; ?>" id="var1_edit_pro_id_11" name="var1_pro_id_11"/>						
								</td>
			</tr>
			 <?php } ?>
			</tr>
			
			<tr<?php while($val12=mysql_fetch_array($getdeal_v12)) { if($val12['selection_option']=='v12') { ?>>
			<td class="form-field-label">Variable Twelve :</td>
			<td class="form-field-input" id="twelve_<?php echo $row['id']; ?>">
			<select name="var12edit" id="v12_<?php echo $row['id']; ?>" onchange="getseditcombo(this.value,this.id);"><option value="">Select Category </option>
			<?php while($resedittwelve=mysql_fetch_array($vartwelveedit)) { ?>
			<option value="<?php echo $resedittwelve['cat_id']; ?>"<?php echo ($val12['product_id']==$resedittwelve['cat_id']) ? 'selected="selected"':''?>/><?php echo $resedittwelve['name']; ?></option>
			<?php } ?></select></td>
			<td id="ajaxedit_12">
			<?php
			$query=mysql_query('SELECT type FROM '.TBL_PRODUCT_CATEGORIES.' WHERE cat_id = "'.$val12['product_id'].'"');
			$res=mysql_fetch_array($query);
				if($res['type']=="g"){ ?> <?php } else { ?>
				
				<select name="getsize[]" id="gets">
				<option value="any" <?php if($val12['size_name']=="any") {?> selected="selected" <?php } ?>>Any Size</option>
			<option value="personal" <?php if($val12['size_name']=="personal") {?> selected="selected" <?php } ?>>Personal(4 Slices)</option>
			<option value="small" <?php if($val12['size_name']=="small") {?> selected="selected" <?php } ?>>Small(6 Slices)</option>
			<option value="medium" <?php if($val12['size_name']=="medium") {?> selected="selected" <?php } ?>>Medium(8 Slices)</option>
			<option value="large" <?php if($val12['size_name']=="large") {?> selected="selected" <?php } ?>>Large(10 Slices)</option>
				<?php } ?>
		</select>
			
			</td><?php } else { }?>
			<td id="pro_edit_12">
			<select name="getpro_edit_1[]" id="pro_edit_drp1_12" onchange="change_product_edit_sel(this.id,this.value)"><?php 
			$pro1 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val12['product_id'].'"'); 
			while($info=mysql_fetch_array($pro1))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val12['product_one']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			
			<td id="pro2_edit_12">
			<select name="getpro_edit_2[]" id="pro_edit_drp2_12"><?php 
			$pro2 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val12['product_id'].'"'); 
			while($info=mysql_fetch_array($pro2))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val12['product_two']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			<td>
								Quantity :
								<input type="text" name="quanedit12" style="width:50px;" value="<?php echo $val12['quantity'];?>"/>
			<input type="hidden"  value="<?php echo $val12['product_id']; ?>" id="var1_edit_pro_id_12" name="var1_pro_id_12"/>
								</td>
			</tr>
			 <?php } ?>
			</tr>
			
			<tr<?php while($val13=mysql_fetch_array($getdeal_v13)) { if($val13['selection_option']=='v13') { ?>>
			<td class="form-field-label">Variable Thirteen :</td>
			<td class="form-field-input" id="thirteen_<?php echo $row['id']; ?>">
			<select name="var13edit" id="v13_<?php echo $row['id']; ?>" onchange="getseditcombo(this.value,this.id);"><option value="">Select Category </option>
			<?php while($reseditthirteen=mysql_fetch_array($varthirteenedit)) { ?>
			<option value="<?php echo $reseditthirteen['cat_id']; ?>"<?php echo ($val13['product_id']==$reseditthirteen['cat_id']) ? 'selected="selected"':''?>/><?php echo $reseditthirteen['name']; ?></option>
			<?php } ?></select></td>
			<td id="ajaxedit_13">
			<?php
			$query=mysql_query('SELECT type FROM '.TBL_PRODUCT_CATEGORIES.' WHERE cat_id = "'.$val13['product_id'].'"');
			$res=mysql_fetch_array($query);
				if($res['type']=="g"){ ?> <?php } else { ?>
				
				<select name="getsize[]" id="gets">
				<option value="any" <?php if($val13['size_name']=="any") {?> selected="selected" <?php } ?>>Any Size</option>
			<option value="personal" <?php if($val13['size_name']=="personal") {?> selected="selected" <?php } ?>>Personal(4 Slices)</option>
			<option value="small" <?php if($val13['size_name']=="small") {?> selected="selected" <?php } ?>>Small(6 Slices)</option>
			<option value="medium" <?php if($val13['size_name']=="medium") {?> selected="selected" <?php } ?>>Medium(8 Slices)</option>
			<option value="large" <?php if($val13['size_name']=="large") {?> selected="selected" <?php } ?>>Large(10 Slices)</option>
				<?php } ?>
		</select>
			
			</td><?php } else { }?>
			<td id="pro_edit_13">
			<select name="getpro_edit_1[]" id="pro_edit_drp1_13" onchange="change_product_edit_sel(this.id,this.value)"><?php 
			$pro1 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val13['product_id'].'"'); 
			while($info=mysql_fetch_array($pro1))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val13['product_one']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			
			<td id="pro2_edit_13">
			<select name="getpro_edit_2[]" id="pro_edit_drp2_13"><?php 
			$pro2 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val13['product_id'].'"'); 
			while($info=mysql_fetch_array($pro2))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val13['product_two']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			<td>
								Quantity :
								<input type="text" name="quanedit13" style="width:50px;" value="<?php echo $val13['quantity'];?>"/>
			<input type="hidden"  value="<?php echo $val13['product_id']; ?>" id="var1_edit_pro_id_13" name="var1_pro_id_13"/>			
								</td>
			</tr>
			 <?php } ?>
			</tr>
			
			<tr<?php while($val14=mysql_fetch_array($getdeal_v14)) { if($val14['selection_option']=='v14') { ?>>
			<td class="form-field-label">Variable Fourteen :</td>
			<td class="form-field-input" id="fourteen_<?php echo $row['id']; ?>">
			<select name="var14edit" id="v14_<?php echo $row['id']; ?>" onchange="getseditcombo(this.value,this.id);"><option value="">Select Category </option>
			<?php while($reseditfourteen=mysql_fetch_array($varfourteenedit)) { ?>
			<option value="<?php echo $reseditfourteen['cat_id']; ?>"<?php echo ($val14['product_id']==$reseditfourteen['cat_id']) ? 'selected="selected"':''?>/><?php echo $reseditfourteen['name']; ?></option>
			<?php } ?></select></td>
			<td id="ajaxedit_14">
			<?php
			$query=mysql_query('SELECT type FROM '.TBL_PRODUCT_CATEGORIES.' WHERE cat_id = "'.$val14['product_id'].'"');
			$res=mysql_fetch_array($query);
				if($res['type']=="g"){ ?> <?php } else { ?>
				
				<select name="getsize[]" id="gets">
				<option value="any" <?php if($val14['size_name']=="any") {?> selected="selected" <?php } ?>>Any Size</option>
			<option value="personal" <?php if($val14['size_name']=="personal") {?> selected="selected" <?php } ?>>Personal(4 Slices)</option>
			<option value="small" <?php if($val14['size_name']=="small") {?> selected="selected" <?php } ?>>Small(6 Slices)</option>
			<option value="medium" <?php if($val14['size_name']=="medium") {?> selected="selected" <?php } ?>>Medium(8 Slices)</option>
			<option value="large" <?php if($val14['size_name']=="large") {?> selected="selected" <?php } ?>>Large(10 Slices)</option>
				<?php } ?>
		</select>
			</td><?php } else { }?>
			<td id="pro_edit_14">
			<select name="getpro_edit_1[]" id="pro_edit_drp1_14" onchange="change_product_edit_sel(this.id,this.value)"><?php 
			$pro1 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val14['product_id'].'"'); 
			while($info=mysql_fetch_array($pro1))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val14['product_one']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			
			<td id="pro2_edit_14">
			<select name="getpro_edit_2[]" id="pro_edit_drp2_14"><?php 
			$pro2 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val14['product_id'].'"'); 
			while($info=mysql_fetch_array($pro2))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val14['product_two']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			<td>
								Quantity :
								<input type="text" name="quanedit14" style="width:50px;" value="<?php echo $val14['quantity'];?>"/>
			<input type="hidden"  value="<?php echo $val14['product_id']; ?>" id="var1_edit_pro_id_14" name="var1_pro_id_14"/>					
								</td>
			</tr>
			 <?php } ?>
			</tr>
			
			<tr<?php while($val15=mysql_fetch_array($getdeal_v15)) { if($val15['selection_option']=='v15') { ?>>
			<td class="form-field-label">Variable Fifteen :</td>
			<td class="form-field-input" id="fifteen_<?php echo $row['id']; ?>">
			<select name="var15edit " id="v15_<?php echo $row['id']; ?>" onchange="getseditcombo(this.value,this.id);"><option value="">Select Category </option>
			<?php while($reseditfifteen=mysql_fetch_array($varfifteenedit )) { ?>
			<option value="<?php echo $reseditfifteen['cat_id']; ?>"<?php echo ($val15['product_id']==$reseditfifteen['cat_id']) ? 'selected="selected"':''?>/><?php echo $reseditfifteen['name']; ?></option>
			<?php } ?></select></td>
			<td id="ajaxedit_15">
			<?php
			$query=mysql_query('SELECT type FROM '.TBL_PRODUCT_CATEGORIES.' WHERE cat_id = "'.$val15['product_id'].'"');
			$res=mysql_fetch_array($query);
				if($res['type']=="g"){ ?> <?php } else { ?>
				
				<select name="getsize[]" id="gets">
				<option value="any" <?php if($val15['size_name']=="any") {?> selected="selected" <?php } ?>>Any Size</option>
			<option value="personal" <?php if($val15['size_name']=="personal") {?> selected="selected" <?php } ?>>Personal(4 Slices)</option>
			<option value="small" <?php if($val15['size_name']=="small") {?> selected="selected" <?php } ?>>Small(6 Slices)</option>
			<option value="medium" <?php if($val15['size_name']=="medium") {?> selected="selected" <?php } ?>>Medium(8 Slices)</option>
			<option value="large" <?php if($val15['size_name']=="large") {?> selected="selected" <?php } ?>>Large(10 Slices)</option>
				<?php } ?>
		</select>
			
			</td><?php } else { }?>
			<td id="pro_edit_15">
			<select name="getpro_edit_1[]" id="pro_edit_drp1_15" onchange="change_product_edit_sel(this.id,this.value)"><?php 
			$pro1 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val15['product_id'].'"'); 
			while($info=mysql_fetch_array($pro1))
			{?><option value="<?php echo $info['product_id'] ?>"<?php if($val5['product_one']==$info['product_id']) {?> selected="selected" <?php } ?>><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			
			<td id="pro2_edit_15">
			<select name="getpro_edit_2[]" id="pro_edit_drp2_15"<?php if($val5['product_two']==$info['product_id']) {?> selected="selected" <?php } ?>><?php 
			$pro2 = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$val15['product_id'].'"'); 
			while($info=mysql_fetch_array($pro2))
			{?><option value="<?php echo $info['product_id'] ?>"><?php echo $info['name']; ?></option><?php } ?></select>
			</td>
			<td>
								Quantity :
								<input type="text" name="quanedit15" style="width:50px;" value="<?php echo $val15['quantity'];?>"/>
			<input type="hidden"  value="<?php echo $val15['product_id']; ?>" id="var1_edit_pro_id_15" name="var1_pro_id_15"/>				
								</td>
			</tr>
			 <?php } ?>
			</tr>
	        
      <?php  $eq2=0;
			for($r=0; $r<$get_counter; $r++) 
			{ 
			while($re=mysql_fetch_array($getdeal_four))
			{
			$eq2++;
			$cate = mysql_query( "SELECT * FROM ".TBL_PRODUCT_CATEGORIES." where type!='N' AND status='1' AND store_id= '".$_SESSION['store_acces_id']."'");
			
			while($cateres=mysql_fetch_array($cate))
			{
		   $get = mysql_query('SELECT name,product_id FROM '.TBL_PRODUCTS.' WHERE cat_id = "'.$cateres['cat_id'].'"');
			 while($getproduct=mysql_fetch_array($get))
			 {
			     $getarr[] = array(
           'product_id' => $getproduct['product_id'],
           'name' =>$getproduct['name']
        );
			   
			 }
			 
		  }
			
		
			 ?>
			<input type="hidden" name="upd_id[]" value="<?php echo $re['id']; ?> ">
			
			<tr>
            <td class="form-field-label">No. of Selection<span class="star">*</span> :</td>
			<td class="form-field-input"><input type="text" name="opt[]" id="edit_qty_four<?php echo $eq2; ?>" value="<?php echo $re['quantity']?>"/></td>
			<td class="form-field-label" style="text-align:left;">For Category</td>
                <td class="form-field-input" >
			
			
			<select name="cat[]">
			<?php foreach($getarr as $k=>$v){
				
				?>
      <option value="<?php echo $v['product_id']; ?>" <?php if($v['product_id']==$re['product_id']) { ?> selected="selected" <?php } ?>><?php echo $v['name']; ?></option>
      <?php } ?></select> <?php  }} ?></td></tr></table></td>
	  
	  <?php /*?><?php if(isset($getdeal_v1)) { $resone=mysql_fetch_array($getdeal_v1); } ?>
		<td style="display:none;" width="50" cl="vone"><?php echo $resone['product_id'];?></td>
		
		<?php if(isset($getdeal_v2)) { $restwo=mysql_fetch_array($getdeal_v2); } ?>
		<td style="display:none;" width="50" cl="vtwo"><?php echo $restwo['product_id'];?></td>
      
		<?php if(isset($getdeal_v3)) { $resthree=mysql_fetch_array($getdeal_v3); } ?>
		<td style="display:none;" width="50" cl="vthree"><?php echo $resthree['product_id'];?></td>
		
		<?php if(isset($getdeal_v4)) { $resfour=mysql_fetch_array($getdeal_v4); } ?>
		<td style="display:none;" width="50" cl="vfour"><?php echo $resfour['product_id'];?></td>
		
		<?php if(isset($getdeal_v5)) { $resfive=mysql_fetch_array($getdeal_v5); } ?>
		<td style="display:none;" width="50" cl="vfive"><?php echo $resfive['product_id'];?></td>
		
		<?php if(isset($getdeal_v6)) { $ressix=mysql_fetch_array($getdeal_v6); } ?>
		<td style="display:none;" width="50" cl="vsix"><?php echo $ressix['product_id'];?></td>
		
		<?php if(isset($getdeal_v7)) { $resseven=mysql_fetch_array($getdeal_v7); } ?>
		<td style="display:none;" width="50" cl="vseven"><?php echo $resseven['product_id'];?></td>	
		
		<?php if(isset($getdeal_v8)) { $reseight=mysql_fetch_array($getdeal_v8); } ?>
		<td style="display:none;" width="50" cl="veight"><?php echo $reseight['product_id'];?></td>	
		
		<?php if(isset($getdeal_v9)) { $resnine=mysql_fetch_array($getdeal_v9); } ?>
		<td style="display:none;" width="50" cl="vnine"><?php echo $resnine['product_id'];?></td>	
		
		<?php if(isset($getdeal_v10)) { $resten=mysql_fetch_array($getdeal_v10); } ?>
		<td style="display:none;" width="50" cl="vten"><?php echo $resten['product_id'];?></td>	
		
		<?php if(isset($getdeal_v11)) { $reseleven=mysql_fetch_array($getdeal_v11); } ?>
		<td style="display:none;" width="50" cl="veleven"><?php echo $reseleven['product_id'];?></td>	
		
		<?php if(isset($getdeal_v12)) { $restwelve=mysql_fetch_array($getdeal_v12); } ?>
		<td style="display:none;" width="50" cl="vtwelve"><?php echo $restwelve['product_id'];?></td>	
		
		<?php if(isset($getdeal_v13)) { $resthirteen=mysql_fetch_array($getdeal_v13); } ?>
		<td style="display:none;" width="50" cl="vthirteen"><?php echo $resthirteen['product_id'];?></td>	
		
		<?php if(isset($getdeal_v14)) { $resfourteen=mysql_fetch_array($getdeal_v14); } ?>
		<td style="display:none;" width="50" cl="vfourteen"><?php echo $resfourteen['product_id'];?></td>	
		
		<?php if(isset($getdeal_v15)) { $resfifteen=mysql_fetch_array($getdeal_v15); } ?>
		<td style="display:none;" width="50" cl="vfifteen"><?php echo $resfifteen['product_id'];?></td>	<?php */?>
	  <!-- For Deal three-->
	  
		<td style="display:none;" width="50" cl="get_html_three">
	  <table>
	  <tr>
			<td class="form-field-label">Deal Price<span class="star">*</span> :</td>
            <td class="form-field-input"><input type="text" name="deal_amount_edit" value="<?php echo $row['deal_price']; ?>" /></td>
			</tr>
          <?php
							 
					
	
					   $eq=0;
						 for($r=0; $r<$get_counter_three; $r++) 
			       {
						  while($re=mysql_fetch_array($getdeal_three))
							{ 
							 $eq++;
							 				 
						
			//echo "<pre>"; print_r($re); exit; // end
			 ?>
			<input type="hidden" name="upd_id" value="<?php echo $re['id']; ?>" />
			
			<tr>
            <td class="form-field-label">Category Is<span class="star">*</span> :</td>
			
				<td class="form-field-input">
			
			
			  
				
			 <select name="cats[]" id="productdrop" onchange="getval_edit(this.value,this.id);">
			 
			 
	  
	  <?php 
	  
			foreach($arr as $v){
				
				?>
				
      
	  <option value="<?php echo $v['cat_id'].",".$v['type']; ?>"<?php if($v['cat_id']==$re['cat_id']) { ?> selected="selected" <?php  } ?>/>
	 <?php echo $v['name'];  ?>
	  
	  
	   </option>
      <?php } ?></select>
			</td>
		<td class="form-field-input" id="deal_edit_third"></td>	
		
<td class="form-field-input" id="old_deal" <?php if($re['size_name']=="") { ?>style="display:none;" <?php } else { ?>style="display:block;<?php } ?>">
			<select name="new" id="new_third" >
			<option value="any" <?php if($re['size_name']=="any") {?> selected="selected" <?php } ?>>Any Size</option>
			<option value="personal" <?php if($re['size_name']=="personal") {?> selected="selected" <?php } ?>>Personal(4 Slices)</option>
			<option value="small" <?php if($re['size_name']=="small") {?> selected="selected" <?php } ?>>Small(6 Slices)</option>
			<option value="medium" <?php if($re['size_name']=="medium") {?> selected="selected" <?php } ?>>Medium(8 Slices)</option>
			<option value="large" <?php if($re['size_name']=="large") {?> selected="selected" <?php } ?>>Large(10 Slices)</option>
			</select>
			
			</td> 
			<?php  }
			 } ?>
	  </tr>
		</table>
		
		
		</td> 
	 
      
	  
	  
	  <!-- end deal three -->
		
	  <td style="display:none;" width="50" cl="deal_cat_type"><?php echo $get_deal_cat_type_res['cat_name'];?></td>
	   <?php if($row['deal_cat_id']==3 || $row['deal_cat_id']==4)
			{ ?>
	  <td style="display:none;" width="50" cl="deal_three_option"><?php echo $get_counter_three;?></td> <?php } ?>
	  <td style="display:none;" width="50" cl="deal_four_option"><?php echo $get_counter;?></td>
	  
      
      
      
     	
			
		</tr>
<?php 
	}
	}
	if($count==0)
	{?>
		<tr class="row_one">
			<td colspan="11" height="55px"><center><b>There is no any deals available in database yet!</b></center></td>			
		</tr>
<?php
	}?>
	</tbody>	
    <?php
?>
</table>

</div>

        <!-- Records End Here --> 
        <!-- Records End Here -->
<?php include 'imagebank_popup.php';?>
<div id="dialog1" title="Product Images" align="center">  
  <center>
  	<div id="result_image"></div> 
   </center>
</div>
<div id="dialog2" title="Deal Description" style="color:#093">
	<div id="result_desc"></div>   
</div>
<div id="dialog3" title="Product Icon Images" align="center">  
  <center>
  	<div id="result_icon_image"></div> 
   </center>
</div>
<div id="loading" class="loading" style="display:none;"><img src="image/loading45.gif" class="loading" /></div>   
   </body>
</html>
