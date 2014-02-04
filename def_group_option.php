<?php
//error_reporting(0);
session_start();

$_SESSION['page']="def_group_option";
require 'head.php';
$pgID=$_GET['pgID'];

$q = mysql_query("SELECT * FROM ".TBL_PRODUCT_GROUP." WHERE  	product_group_id = '".$_GET['pgID']."'");
 
$Info = mysql_fetch_assoc($q);
$get_cat_id = mysql_query("SELECT cat_id FROM ".TBL_PRODUCTS." WHERE  	product_id = '".$Info['product_id']."'");

$res = mysql_fetch_assoc($get_cat_id);

$get_cat_type = mysql_query("SELECT type FROM ".TBL_PRODUCT_CATEGORIES." WHERE  cat_id = '".$res['cat_id']."'");

$result = mysql_fetch_assoc($get_cat_type);


$qu = mysql_query("SELECT product_group_id FROM ".TBL_PRODUCT_GROUP." WHERE product_id = '".$Info['product_id']."' AND (name= 'Size' or name= 'size')");
$Res = mysql_fetch_assoc($qu);
//echo "<pre>"; print_r($Res); exit;

$select =mysql_query("SELECT name,group_option_id FROM ".TBL_GROUP_OPTIONS." WHERE  product_group_id = '".$Res['product_group_id']."'");

while($r=mysql_fetch_assoc($select))
{
	$rw['group_option_id'][]=$r['group_option_id'];
	$rw['name'][]=$r['name'];
}
//echo"<pre>"; print_r($rw);
if(isset($rw['name']))
$cnt =sizeof($rw['name']); 
//echo count($r);exit;

$query = mysql_query("SELECT * FROM ".TBL_DEF_PRODUCT_GROUP." WHERE  	product_group_id = '".$pgID."'");
$count = mysql_num_rows($query);


if($count == 0)
{
?>
<!-- Box - Error Start -->
<div id="box-error">
	<div id="content">There is no such product group or Missing variable</div>
</div>
<!-- Box - Error End -->
<?php
	die();
}
else
{
	$product_group_Info = mysql_fetch_assoc($query);	
}
$query = mysql_query("SELECT * FROM ".TBL_DEF_GROUP_OPTIONS." WHERE  product_group_id = '".$pgID."' ORDER BY depth ASC");
$count = mysql_num_rows($query);

	
?>

<div id="info-box"><label style="font-size:16px;font-weight:bold;">Group Option Listing</label><div>You currently have&nbsp;<font size="5" color="#666666">(<font color="#FF3300"><?php echo $count;?></font>)</font>&nbsp;<?php if($count>1){echo "groups";}else {echo "group";}?> option in <?php echo $product_group_Info["name"];?> product Group <?php if($isFull) { ?><a name="add_record" href="<?php echo $path_add;?>"><br />Click here to add new group option</a><?php } if($isFull) {?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php } ?><a href="def_product_group.php?pID=<?php echo $product_group_Info["product_id"];?>">Click here to go back</a></div></div>
<?php   
if($isFull)
{
?>
<!-- Form to add records -->
<div id="box-add" class="hidden">
	<h2>Add New Group Option</h2>
	<form method="post" action="<?php echo $path_add;?>" name="add_form"/>
  <input type="hidden" name="group_type" value="<?php echo $Info['name']; ?>"/>
  	<table width="100%" border="0" cellspacing="8" cellpadding="0">
    	<tr>
          <td class="form-field-label">Group Option Name<span class="star">*</span> :</td>
          <td class="form-field-input"><input name="name" type="text" /></td>
      </tr>
        
      <tr>
          <td class="form-field-label">Price<span class="star">*</span> :</td>
          <td class="form-field-input"><input name="price" type="text" /></td>
      </tr>
			
     
      <tr>
				<td class="form-field-label">Status :</td>
				<td class="form-field-input"><input name="status" id="active" type="radio" value="1" checked="checked"/> Active &nbsp;<input name="status" id="inactive" type="radio" value="0"/> Inactive</td>
			</tr>
      <tr>
          <td class="form-field-label"><input name="pgid" type="hidden" value="<?php echo $pgID;?>" /></td>
          <td class="form-field-input"><input name="save" type="image" src="image/button_save.png"/>
          <input name="cancel" type="image" src="image/button_cancel.png" /></td>
      </tr>
		</table>         	
	</form>
</div>
<!-- Form Ends here -->
<?php 
	}?>

<!-- Form to edit records -->

<div id="box-edit" class="hidden">
	<div id="content">
		<h2>Edit Group Option</h2>
		<form method="post" action="<?php echo $path_edit;?>" name="edit_form">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
          <td class="form-field-label">Group Option Name<span class="star">*</span> :</td>
          <td class="form-field-input"><input name="name" type="text" /></td>
      	</tr>
      	
				<tr>
          <td class="form-field-label">Price<span class="star">*</span> :</td>
          <td class="form-field-input"><input name="price_edit" type="text" /></td>
      	</tr>
        
       
      	
          <td class="form-field-label">Status :</td>
          <td class="form-field-input"><input name="editstatus" id="editactive" type="radio" value="1" checked="checked"/> Active &nbsp;<input name="editstatus" id="editinactive" type="radio" value="0"/> Inactive</td>
				</tr> 
				<tr>
					<td class="form-field-label"><input name="pgID" type="hidden" value="<?php echo $pgID;?>" />
          <input name="goID" type="hidden" value=""/></td>
		  <input type="hidden" name="set_default" value=""/>
          	<td class="form-field-input"><input name="save" type="image" src="image/button_save.png" /><input name="cancel" type="image" src="image/button_cancel.png" /></td>
				</tr>
			</table>	
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
<table width="100%" border="0" cellspacing="1" cellpadding="0">
	<thead>
		<tr>
			<td style="text-align:left;">Group Option Name</th>
      <th width="50">Price</th>
	  <th width="50">Status</th>	
      <th width="50">Move</th>
			<th width="50">Default</th>
			<th width="50">Action</th>
			
      
		</tr>
	</thead>
    <tbody>

 <?php
 $set=null;
 
  
 
	if($count > 0)
	{
		$i = 0;
		while($row = mysql_fetch_assoc($query))
		{
			
			$i++;
			
			if ($row['status'] == 1)
			{
				$status = 'Active';
			}
			else
			{
				$status = 'InActive';
			}
			
			if($row['is_default']==1)
			{
				$def="Yes";
			}
			else
			{
				$def="No";
			}
			
			?>
		<tr class="<?php echo $i % 2 ? "row_one_record" : "row_two_record" ?>"  pgID="<?php echo $row["product_group_id"];?>" goID="<?php echo $row["group_option_id"];?>" desc = "<?php echo $row["description"];?>"  imgid = "<?php echo $row["image"];?>">
    <?php if($row["price"]=="0") { $rp="0.00"; } else { $rp= $row["price"];} ?>
	<td style="text-align:left;" cl="name"><?php echo $row["name"];?></td>
	<td width="50"  cl="price"><?php echo $rp;?></td>
	<td class="left" width="50" cl="available"><?php echo $status;?></td> 
	
	   
	
	
	  
     <td width="50"><?php if($i != 1) {?><img direction="up" class="move_up" src="image/move_up.png" width="20" height="20" /><?php } if($i != $count) {?><img direction="down" class="move_down" src="image/move_down.png" width="20" height="20" /><?php } ?></td>
		 
		 <td><input type="radio" name="sauce_def" <?php if($def=="Yes") { ?> checked="checked" <?php } ?> value="<?php echo $row['name']; ?>"  id="<?php echo $row['group_option_id']; ?>" onclick="create_default(this.id,this.value);" /></td> 
			<td width="50"><img class="edit" src="image/edit.png" width="20" height="20"/>
			<?php if($isFull) { ?>
      <img class="delete" src="image/delete.png" width="20" height="20"  /><?php } ?><?php 
if($row['image']==''){$img = 0;}else{$img = $row['image'];}			
$queryimagesel=mysql_query('SELECT * FROM imagebank_categories_image where imagebank_category_image_id IN ('.$img.')');?>
         		<div id="<?php echo  $row["group_option_id"];?>" style="display:none;">
		 				<?php								
							while($row1=mysql_fetch_array($queryimagesel))
							{ 
								if ($row['default_imagebank_categories_image_id']==$row1['imagebank_category_image_id'])
								{
									$default_imageId = $row['default_imagebank_categories_image_id'];
									$checked='checked';
								}
								else
								{
									$checked='';
								}								
								echo '<div id="img'.$row1['imagebank_category_image_id'].'" class="selected_image"><div><p class="image"><img src="../upload/menu/sml/'.$row1["image"].'" id="img'.$row1['imagebank_category_image_id'].'"></p></div><div><p class="delete_link"><a onclick="delimg('.$row1['imagebank_category_image_id'].',false,0)">Delete</a></p></div><div><p class="is_default"><input type="radio" name="default_'.$row["group_option_id"].'" '.$checked.' value='.$row1['imagebank_category_image_id'].'> Is Default</p></div></div>';
							}
						?>
						</div> 
                        <input id="<?php echo 'default_imageid'.$row['group_option_id'];?>" name="default_imageid" type="hidden" value="<?php echo isset($default_imageId) ? $default_imageId : 0; ?>" />
						<input id="<?php echo  "dbimageid".$row["group_option_id"];?>" name="dbimageid" type="hidden" value="<?php echo $row["image"]; ?>" />            
            </td>
						
						
			
			
			

	    		</tr>
<?php }
	}
	else
	{?>
		<tr class="row_one">
			 <td colspan="8" height="55px"><center><b>There is no available any Option of Product Group in database yet!</b></center></td>
		</tr>
<?php
	}?>
	</tbody>	
    <?php
?>
</table>

</div>

<!-- Records End Here -->
<?php include 'imagebank_popup.php';?>
<div id="dialog1" title="Group Option Images" align="center">  
  <center>
  	<div id="result_image"></div> 
   </center>
</div>
<div id="dialog2" title="Group Option Description" style="color:#093">
	<div id="result_desc"></div>   
</div>
<div id="loading" class="loading"><img src="image/loading45.gif" /></div>
</body>
</html>

