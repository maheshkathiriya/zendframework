
function dealsBuyeOneGetOne(id,key) { 
	//alert('welcome');
	
	
	
	var host = window.location.href;
 	var lasturl = host.split("/").pop(-1);
	
	$('#dealIds').val(id);
	
	var dealtype = $('#dealtype_'+id).val();
	var dealName = $('#dealName_'+id).val(); 
	var buyOneCatId = $('#buyOneCatId_'+id).val(); //alert(buyOneCatId);
	var getOneCatId = $('#getOneCatId_'+id).val(); //alert(getOneCatId);	
	var dealtype_distype = $('#dealtype_distype_'+id).val();
	var deal_discription = $('#deal_dis_'+id).val();
	var dealtype_dis_amt = $('#dealtype_dis_amt_'+id).val();
	var buyone_size_name = $('#buyone_size_name_'+id).val();
	var getone_size_name = $('#getone_size_name_'+id).val();
	
	//$("#loader").fadeIn();
	$.ajax({
			type: "POST",
			url : "/menu/getMenuCategoryProductDealsAjax",
			data: "dealName="+dealName+"&id="+id+"&buyOneCatId="+buyOneCatId+"&getOneCatId="+getOneCatId+"&dealdis="+deal_discription+"&dealtype_distype="+dealtype_distype+"&dealtype="+dealtype+"&dealtype_dis_amt="+dealtype_dis_amt+"&buyone_size_name="+buyone_size_name+"&getone_size_name="+getone_size_name,
			success: function (response) { 
				if (lasturl=='menu') {
					unsetDealsbogo();
				} else if(lasturl=='choosedeal') {
					window.location.href='/menu';
				} 
				$("#loaderdeal").fadeOut();
				$( ".dialogdeals" ).html(response);
				$( ".dialogdeals" ).dialog( "open" );	
				$(".dialogdeals .menu_content").mCustomScrollbar();
				$(".common_sidecart_customise").mCustomScrollbar();
				$("#tabs_deals").tabs();
				$("#tabs_deals").tabs({ disabled: [ 1, 2, 3, 4,5,6,7,8,9,10,11,12,13,14,15 ] });
				//$("#loader").fadeOut();
				$('#mycarousel1').jcarousel({scroll: 1});
			},	
				
		});
}

function unsetDealsbogo(){
	$.ajax({
			type: "POST",
			url : "/deals/dealbogoSessionUnset"
	});
}

// Add TO Cart  children(".shopp-price ").find('label').html(total)
function addtocarts_bogof(pr_id,pr_name,pr_price,productType,type,pro_json_id,tab_no,count,checked) { 
	var pr_price = 0;
	if($("#deals_"+tab_no+"_total_price_"+pr_id).html() == undefined) {
		pr_price = 0;
	} else {
		pr_price = $("#deals_"+tab_no+"_total_price_"+pr_id).html();	
	}	
		if($('.com_order button').attr('class') == 'order') {
			$('.com_order button').removeClass('order').addClass('addcart');
		}
		product_name 	= pr_name;
		cart_add_bogof(pr_id,pr_price,productType,type,checked,tab_no,pro_json_id,count);	
}
//Add Selected Buye One Get One To Cart
function cart_add_bogof(pr_id,pr_price,productType,type,checked,tab_no,pro_json_id,count) { //alert(pr_price);	
//alert(type); alert(tab_no);

	$('#dealnextpizza').css('display','block');
	
	var tabsid = 0;
		$('#tabs_deals').children('.ui-tabs-nav').children().each(function(){	
			if($(this).attr('aria-selected')=="true"){
				tabsid = $(this).attr('id');
			}
		});
	var tabId = tabsid.split('_');
	
	$('#tabs_deals').tabs('enable', 1)
	if (tabId[1] == 1) { 
		var buyarray =$.parseJSON($('#buyArray').val());
		$('#sidebar_container .customise_cart .common_sidecart_customise .cart_customise_deal li').each(function() {
      var liId = $(this).attr('id').split("_");
				if ($(this).attr('types') == 'g') {	
					$('#cart_'+liId[1]+'_'+liId[2]+'_1').remove();
				} else if ($(this).attr('types') == 'p') {
					$('#cart_'+liId[1]+'_'+liId[2]+'_1').remove();
				}
    });
	}else if (tabId[1] == 2){ 
		var getarray = $('#getArray').val(); 		 
		$('#sidebar_container .customise_cart .common_sidecart_customise .cart_customise_deal li').each(function(i) {
      var liId = $(this).attr('id').split("_");
				if ($(this).attr('types') == 'g') {	
					$('#cart_'+liId[1]+'_'+liId[2]+'_2').remove();
				} else if ($(this).attr('types') == 'p') {
					$('#cart_'+liId[1]+'_'+liId[2]+'_2').closest('li').remove();
				}
		});
	}
	
if(type=='g')
{	
	if ($(".deals_"+tab_no+"_product_option_selected_span_"+pr_id).attr('id') === undefined) {
		var pro_id_array =[];
		pro_id_array[8]= 0;	
	} else {
		var pro_id_array = $(".deals_"+tab_no+"_product_option_selected_span_"+pr_id).attr('id').split("_");
	}	
	
	if(count!=0)
	{
	var json_pro_grup_id = $.parseJSON(pro_json_id);
	var ArrayS= [];
	$.each(json_pro_grup_id, function( i,item ) {
		
		 var pro_op_g_v_name =  $(".deals_"+tab_no+"_product_option_selected_span_"+item).html();
		 var jsondata_group_option = $.parseJSON($('#deals_'+tab_no+'_product_grup_option_json_'+item).val());
			$.each(jsondata_group_option, function( i,item ) {
				
				if(pro_op_g_v_name==item.name)
				{
				ArrayS.push(item.id);
		 		ArrayS.push(item.product_group_id);
		 		ArrayS.push(item.price);
		 		ArrayS.push(1);
		 		ArrayS.push('shaggy');
		 		ArrayS.push(item.name);
		 		ArrayS.push(1);
				}
			});
			
	});
	
	$('#sidebar_container .customise_cart .common_sidecart_customise .cart_customise_deal').append("<li id=cart_"+pr_id+"_"+pro_id_array[8]+"_"+tabId[1]+" types='g' prqty="+pr_id+" prprice="+pr_price+" ><div class='shopp' id='each_"+pr_id+"_"+pro_id_array[8]+"_"+tabId[1]+"'><div class='item_"+pr_id+"_"+pro_id_array[8]+"_"+tabId[1]+"'><span class='smalltext'>1x <label>"+product_name+"</label></span></div><span class='shopp-quantity'></span><div class='shopp-price'><span class='shoprice'><label></label></span></div></div><input type='hidden' id='array_"+pr_id+"_"+pro_id_array[8]+"_"+tabId[1]+"' class='customArray_mulgrup' value='"+JSON.stringify(ArrayS)+"'></li>");
	}
	else
	{
		$('#sidebar_container .customise_cart .common_sidecart_customise .cart_customise_deal').append("<li id=cart_"+pr_id+"_"+pro_id_array[8]+"_"+tabId[1]+" types='g' prqty="+pr_id+" prprice="+pr_price+" ><div class='shopp' id='each_"+pr_id+"_"+pro_id_array[8]+"_"+tabId[1]+"'><div class='item_"+pr_id+"_"+pro_id_array[8]+"_"+tabId[1]+"'><span class='smalltext'>1x <label>"+product_name+"</label></span></div><span class='shopp-quantity'></span><div class='shopp-price'><span class='shoprice'><label></label></span></div></div></li>");
	}

} 
else 
{ 	foodtype="pizza";
		var jdata=$.parseJSON($('.wrap').find('li[id="'+pr_id+'"]').find('input[id="addcustomisedefault"]').val());
		var proarray2=new Array();
		var proarray3=new Array();
		$.each(jdata, function( i,item ) {
			var pr=new Array();
			pr.push(item[0]);pr.push(item[1]);pr.push(item[2]);pr.push(item[3]);pr.push(item[4]);
			pr.push(item[5]);//alert(pr.toSource());
			var fl=1;
			proarray2.push(pr);
		});
		
			var pro_id_array = $(".deal_"+tab_no+"_product_option_selected_span_"+pr_id).attr('id').split("_");
			
			var listlength=$('#sidebar_container #sidebar .common_sidecart .cart_customise_deal li').length;
			var linenum=tabId[1]; //listlength+1; //alert(pr_id);alert(pro_id_array[6]);
			var cartkey="cart_"+pr_id+"_"+pro_id_array[6]+"_2";
			//alert(tabId[1]);
			$('#sidebar_container .customise_cart .common_sidecart_customise .cart_customise_deal').append("<li id='cart_"+pr_id+"_"+pro_id_array[6]+"_"+linenum+"' class='myitems' types='p' prqty="+pr_id+" prprice="+pr_price+"><div class='shopp' id='each_"+pr_id+"_"+pro_id_array[6]+"_"+linenum+"'><div class='item_"+pr_id+"_"+pro_id_array[6]+"_"+linenum+"'><span class='smalltext'>1x <label>"+product_name+"</label></span></div><span class='shopp-quantity'></span><div class='shopp-price'><span class='shoprice'><label></label></span></div></div><input type='hidden' id='productdata' value='"+JSON.stringify(proarray2)+"'/></li>");
	
	}
	 list = [];
	$("#sidebar_container .customise_cart .common_sidecart_customise .cart_customise_deal").children('li').each(function(){
			list.push($(this).attr('prprice'));
			//alert($(this).attr('prprice'));
	 });
	//alert('d'); alert($("#dealtype").val());
	//alert(list[1]);
	var dis_type = $("#dealtype_distype").val();
	var dis_amt = $("#dealtype_dis_amt").val();
	//alert(dis_type);alert(dis_amt);
	if($("#dealtype").val()==1)
	{
	$('.cart-total-customise span').text(parseFloat(Math.max.apply(Math, list)).toFixed(2));
	} else if ($("#dealtype").val()==3) {
		//alert('WEEK END DEALS');
	} else if ($("#dealtype").val()==4) {
		//alert('Combo Deals');
	} else {
		if(!list[1])
		{
			//alert(list[0]);	
			$('.cart-total-customise span').text(parseFloat(list[0]).toFixed(2));
		}
		else
		{
			if(dis_type=='percentage')
			{ //alert(list[0]);alert(list[1]);
				var mxprice = parseFloat(Math.max.apply(Math, list)).toFixed(2);
				var minprice = parseFloat(Math.min.apply(Math, list)).toFixed(2);
				//var send = list[1]-(list[1]*(dis_amt/100));
				var send = mxprice -(mxprice*(dis_amt/100));
				
				$('.cart-total-customise span').text((parseFloat(minprice)+parseFloat(send)).toFixed(2));
			}
			else
			{
				var mxprice = parseFloat(Math.max.apply(Math, list)).toFixed(2);
				var minprice = parseFloat(Math.min.apply(Math, list)).toFixed(2);
				
				$('.cart-total-customise span').text((parseFloat(minprice)+parseFloat(mxprice-dis_amt)).toFixed(2));
			
			}
		}
	}
}

var flag_deal = 2;
var prod_idd = 1;
var exist = 0;

//***********customise deals Buye One And Get One Free.**********//
function addcart_deal_bogof(){
/*if ($("#sidebar_container .customise_cart .common_sidecart_customise .cart_customise_deal li").size() == 0) {
		jConfirm('No option selected. Please Select Some.');
		return false;
} 
else 
{ */
 		
		var tabsid = 0;
		var tabnext= 16;
		$('#tabs_deals').find('.ui-tabs-nav').children().each(function(){	
			if($(this).attr('aria-selected')=="true"){
				tabsid = $(this).attr('id');
				if ($(this).next().attr('id')===undefined) {tabnext='tabs_0_li';}else{
				tabnext = $(this).next().attr('id');
				//alert(tabnext);
				}
			}
		});
		var tabId = tabsid.split('_');
		var tabnextId = tabnext.split('_');
		var pr_id = tabId[1];
		
		/** 
		 * Combo Deal Validation 
		 */
		//alert($('#dealtype').val());
		//alert(tabId[1]);
	if ($('#dealtype').val()==4) {	
		if (tabnextId[1]!=0 || tabId[1] !=0)
		{ 	
				var flag=false;
				$('#tabs-'+tabId[1]).find('.wrap').children('li').each(function(index, element) {
					if($(this).find('#check_'+$(this).attr('id')).prop('checked')==true)
					{flag=true;}
				});
			
			if(flag==false)
			{
				$('#dealscombolimit #errdeal').html($.trim($('#tab_'+tabId[1]).text()));
				$("#pr_notes").css('display','block');
				$("#dealscombolimit").fadeIn(50);
				positionPopup();
				return false;
			}
			if(flag==true)
			{
				var defaultpr = $('#tabs-0').find('.wrap').children('li').length;
				if (tabnextId[1] !=0) {				
					var tabadd = parseInt(tabId[1])+parseInt(1);
					$('#dealscombolimit #errdeal').html($.trim($('#tab_'+tabadd).text()));
					$("#pr_notes").css('display','block');
					$("#dealscombolimit").fadeIn(50);
					return false;
				}
			}
		}
	}else if($('#dealtype').val()!=4){
		var defaultpr = $('#tabs-0').find('.wrap').children('li').length;
				if ($('.tabvalidation').length != $(".customise_cart .common_sidecart_customise .cart_customise_deal").children('li').length- defaultpr)
				{ 
					var tabadd = parseInt(tabId[1])+parseInt(1);
					
					var flag=false;
					$('#tabs-'+tabId[1]).find('.wrap').children('li').each(function(index, element) {
						if($(this).find('#check_'+$(this).attr('id')).prop('checked')==true)
						{flag=true;}
					});
					
					if(flag==true){
						$('#dealscombolimit #errdeal').html($.trim($('#tab_'+tabadd).text()));
						$("#pr_notes").css('display','block');
						$("#dealscombolimit").fadeIn(50);
						return false;
					}else{
					
					$('#dealscombolimit #errdeal').html($.trim($('#tab_'+tabId[1]).text()));
					$("#pr_notes").css('display','block');
					$("#dealscombolimit").fadeIn(50);
					return false;
					}
				}
	}
		//end
		//alert('aa');
		var prgoptionid	= pr_id;
		var dealId = $('#dealIds').val();
		var cartkey = 'cart_'+dealId+'_'+prod_idd+'_deal';
		var quantitys = 1;
		var dealName = $('.cart_customise_deal .deal_name').html();
		var price = $('.cart-total-customise').find('span').html();
		var jsonGroupOption = [];
		var selected_item = dealId;
		var k = 0;
		var flagd='';
		var qty = 0
		non_cart();
			
		$('#cart_info li').each(function() {
			 var li_id = $(this).attr('id').replace("cart_","");
			 if($(".item_"+li_id).html()==dealName){
				 exist=1;
				 return false;
			 }
		});
		
if (exist == 1) 
{
	
$(".customise_cart .common_sidecart_customise .cart_customise_deal").children('li').each(function(){
			var liId = $(this).attr('id').split("_");
			
			var pr_qty = 1;
			
			if ($(this).attr('prqtycomb') == undefined) {
				pr_qty = 1;
			}else{
				pr_qty = $(this).attr('prqtycomb');
			}
			
			
			if ($(this).attr('types') == 'g') {			
				var pr_name 	= $('.item_'+liId[1]+'_'+liId[2]+'_'+liId[3]).children().find('label').html();
				
				jsonGroupOption+='&groupOption['+k+'][pr_id]='+liId[1];
				jsonGroupOption+='&groupOption['+k+'][prod_id]='+liId[2];
				jsonGroupOption+='&groupOption['+k+'][tab_id]='+liId[3];
				jsonGroupOption+='&groupOption['+k+'][pr_name]='+pr_name;
				jsonGroupOption+='&groupOption['+k+'][pr_qty]='+pr_qty;
				jsonGroupOption+='&groupOption['+k+'][pr_type]=g';
				if ($('.customArray').val() !== undefined) {
					
				 if ($('.customArray').attr('id').replace('array_','') == $(this).attr('id').replace('cart_','')) {	
			  	jsonGroupOption+='&groupOption['+k+'][generic_session]='+JSON.stringify($.parseJSON($('.customArray').val()));	
					jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][custom_gen]=custm'; //1
				 }
			 }
			if ($('.customArray_mulgrup').val() !== undefined){ 
			 if($('.customArray_mulgrup').attr('id').replace('array_','') == $(this).attr('id').replace('cart_','')){
					jsonGroupOption+='&groupOption['+k+'][generic_session]='+JSON.stringify($.parseJSON($('.customArray_mulgrup').val()));
			 }
			}
			} else if ($(this).attr('types') == 'p') {
				var pr_name 	= $('.item_'+liId[1]+'_'+liId[2]+'_'+liId[3]).children().find('label').html();
				jsonGroupOption+='&groupOption['+k+'][pr_id]='+liId[1];
				jsonGroupOption+='&groupOption['+k+'][prod_id]='+liId[2];
				jsonGroupOption+='&groupOption['+k+'][tab_id]='+liId[3];
				jsonGroupOption+='&groupOption['+k+'][pr_name]='+pr_name;
				jsonGroupOption+='&groupOption['+k+'][pr_qty]='+pr_qty;
				jsonGroupOption+='&groupOption['+k+'][pr_type]=p';
				jsonGroupOption+='&groupOption['+k+'][pizza_session]='+JSON.stringify($.parseJSON($(this).children('#productdata').val()));
			}
			k++;
		});		
	var addnew = 0;
	var countli = '';
	$.ajax({
		type: "POST",
		url: "/menu/managecartdeals",
		data: jsonGroupOption,
		success: function(rr){
		$('.arrayDeals').each(function() { 					 
				 	if ($(this).val() == rr) {
						 
							countli = $(this).attr('cartKey');
							exist = 0;
							flag_deal = 1;
							addnew = 'match';
					}
				 });
			 
				 if (addnew == 'match') {
					
					prod_idd = countli;
					var j = 0;	
					cartkey = 'cart_'+dealId+'_'+prod_idd+'_deal';
			
			$(".customise_cart .common_sidecart_customise .cart_customise_deal").children('li').each(function(){
						
			   var liId 				= $(this).attr('id').split("_");
				
				var pr_qty = 1;
			
				if ($(this).attr('prqtycomb') == undefined) {
					pr_qty = 1;
				}else{
					pr_qty = $(this).attr('prqtycomb');
				}

				
				if ($(this).attr('types') == 'g') {			
				var pr_name 	= $('.item_'+liId[1]+'_'+liId[2]+'_'+liId[3]).children().find('label').html();
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_id]='+liId[1];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][prod_id]='+liId[2];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][tab_id]='+liId[3];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_name]='+pr_name;
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_qty]='+pr_qty;
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_type]=g';
				if ($('.customArray').val() !== undefined) {
				 if ($('.customArray').attr('id').replace('array_','') == $(this).attr('id').replace('cart_','')) {	
			  jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][generic_session]='+JSON.stringify($.parseJSON($('.customArray').val()));	
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][custom_gen]=custm'; //2
				 }
				}
				if($('.customArray_mulgrup').val() !== undefined){
				if($('.customArray_mulgrup').attr('id').replace('array_','') == $(this).attr('id').replace('cart_','')){
					 jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][generic_session]='+JSON.stringify($.parseJSON($('.customArray_mulgrup').val()));
				 }	
				}
			} else if ($(this).attr('types') == 'p') {
				var pr_name 	= $('.item_'+liId[1]+'_'+liId[2]+'_'+liId[3]).children().find('label').html();
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_id]='+liId[1];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][prod_id]='+liId[2];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][tab_id]='+liId[3];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_name]='+pr_name;
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_qty]='+pr_qty;
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_type]=p';
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pizza_session]='+JSON.stringify($.parseJSON($(this).children('#productdata').val()));
			}
			j++;
		});	
					
					var quantity = $('#each_'+dealId+'_'+prod_idd+'_deal').children(".shopp-quantity").html();
					quantity = parseInt(quantity) + 1;
			  var priceq 	= parseFloat($('#each_'+dealId+'_'+prod_idd+'_deal').children(".shopp-price").find('label').html()).toFixed(2);
				var total 	 =parseFloat(parseFloat(price) * parseInt(quantity)).toFixed(2);
				$('#each_'+dealId+'_'+prod_idd+'_deal').children(".shopp-price ").find('label').html(total);
				$('#each_'+dealId+'_'+prod_idd+'_deal').children(".shopp-quantity").html(quantity+'x');
				var pr_total = parseFloat($('.cart-total span').html()).toFixed(2);
				pr_total = parseFloat(parseFloat(pr_total)-parseFloat(priceq)).toFixed(2);
				pr_total = parseFloat(parseFloat(pr_total)+parseFloat(total)).toFixed(2);
				$('.cart-total span').html(pr_total);
				$('#total-hidden-charges').val(pr_total);
					
					 $.ajax({
						type: "POST",
						url: "/menu/managecart",
						data: 'data['+cartkey+'][pr_id]='+dealId+'&data['+cartkey+'][pro_id]='+prod_idd+'&data['+cartkey+'][pr_quan]='+$('#each_'+dealId+'_'+prod_idd+'_deal').children(".shopp-quantity").html().slice(0, -1)+'&data['+cartkey+'][pr_name]='+dealName+'&data['+cartkey+'][pr_price]='+(parseFloat(price).toFixed(2)*parseInt($('#each_'+dealId+'_'+prod_idd+'_deal').children(".shopp-quantity").html().slice(0, -1))).toFixed(2)+jsonGroupOption+'&data['+cartkey+'][sessiondata]='+selected_item+'&data['+cartkey+'][pro_type]=deal'
						});
				 }else{
					 
					prod_idd = parseInt($('.arrayDeals').length) + 1;
					
					var j = 0;	
					cartkey = 'cart_'+dealId+'_'+prod_idd+'_deal';
					$(".customise_cart .common_sidecart_customise .cart_customise_deal").children('li').each(function(){
			var liId 				= $(this).attr('id').split("_");
			if ($(this).attr('types') == 'g') {			
				var pr_name 	= $('.item_'+liId[1]+'_'+liId[2]+'_'+liId[3]).children().find('label').html();
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_id]='+liId[1];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][prod_id]='+liId[2];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][tab_id]='+liId[3];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_name]='+pr_name;
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_qty]=1';
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_type]=g';
				if ($('.customArray').val() !== undefined) { 
				 if ($('.customArray').attr('id').replace('array_','') == $(this).attr('id').replace('cart_','')) {	
			  jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][generic_session]='+JSON.stringify($.parseJSON($('.customArray').val()));
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][custom_gen]=custm'; //3
				 }
				}
				if($('.customArray_mulgrup').val() !== undefined){
				if ($('.customArray_mulgrup').attr('id').replace('array_','') == $(this).attr('id').replace('cart_','')){
					 jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][generic_session]='+JSON.stringify($.parseJSON($('.customArray_mulgrup').val()));
				 }	
				}
				
			} else if ($(this).attr('types') == 'p') {
				var pr_name 	= $('.item_'+liId[1]+'_'+liId[2]+'_'+liId[3]).children().find('label').html();
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_id]='+liId[1];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][prod_id]='+liId[2];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][tab_id]='+liId[3];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_name]='+pr_name;
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_qty]=1';
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_type]=p';
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pizza_session]='+JSON.stringify($.parseJSON($(this).children('#productdata').val()));
			}
			j++;
		});		
					
					var pr_total = parseFloat($('.cart-total span').html()).toFixed(2);
					pr_total = parseFloat(parseFloat(pr_total)+parseFloat(price)).toFixed(2);
					$('.cart-total span').html(pr_total);
					$('#total-hidden-charges').val(pr_total);
					
					$('#sidebar .cart-info').append("<li id=cart_"+dealId+"_"+prod_idd+"_deal><div class='shopp' id='each_"+dealId+"_"+prod_idd+"_deal'><div class=item_"+dealId+"_"+prod_idd+"_deal>"+dealName+"</div><span class='shopp-quantity'>1x</span><div class='shopp-price'><span class='shoprice'>"+currencySymbol+"<label>"+parseFloat(price).toFixed(2)+"</label></span><img src='/images/remove_button.png' class='remove' /></div></div></li>");
					$(".common_sidecart").mCustomScrollbar('update');
					
					$.ajax({
						type: "POST",
						url: "/menu/managecart",
						data: 'data['+cartkey+'][pr_id]='+dealId+'&data['+cartkey+'][pro_id]='+prod_idd+'&data['+cartkey+'][pr_quan]='+$('#each_'+dealId+'_'+prod_idd+'_deal').children(".shopp-quantity").html().slice(0, -1)+'&data['+cartkey+'][pr_name]='+dealName+'&data['+cartkey+'][pr_price]='+(parseFloat(price).toFixed(2)*parseInt($('#each_'+dealId+'_'+prod_idd+'_deal').children(".shopp-quantity").html().slice(0, -1))).toFixed(2)+jsonGroupOption+'&data['+cartkey+'][sessiondata]='+selected_item+'&data['+cartkey+'][pro_type]=deal'
						});
				 }
		}
	});
			
}
else
{
	if(flag_deal == 1 || exist == 0)
	{ 
		var j = 0;	
		$(".customise_cart .common_sidecart_customise .cart_customise_deal").children('li').each(function(){
			var liId 				= $(this).attr('id').split("_");
			var pr_qty = 1;
			
			if ($(this).attr('prqtycomb') == undefined) {
				pr_qty = 1;
			}else{
				pr_qty = $(this).attr('prqtycomb');
			}
			
			if ($(this).attr('types') == 'g') {			
		
				var pr_name 	= $('.item_'+liId[1]+'_'+liId[2]+'_'+liId[3]).children().find('label').html();
							
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_id]='+liId[1];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][prod_id]='+liId[2];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][tab_id]='+liId[3];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_name]='+pr_name;
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_qty]='+pr_qty;
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_type]=g';
				if ($('.customArray').val() !== undefined) {
					
				 	if ($('.customArray').attr('id').replace('array_') == $(this).attr('id').replace('cart_')) {	
			 		 jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][generic_session]='+JSON.stringify($.parseJSON($('.customArray').val()));
					 jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][custom_gen]=custm'; //4
					 }					 
				}
				if ($('.customArray_mulgrup').val() !== undefined) {	
					if($('.customArray_mulgrup').attr('id').replace('array_') == $(this).attr('id').replace('cart_')){
						 jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][generic_session]='+JSON.stringify($.parseJSON($('.customArray_mulgrup').val()));
					 }
				}
			} else if ($(this).attr('types') == 'p') {
				var pr_name 	= $('.item_'+liId[1]+'_'+liId[2]+'_'+liId[3]).children().find('label').html();
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_id]='+liId[1];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][prod_id]='+liId[2];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][tab_id]='+liId[3];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_name]='+pr_name;
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_qty]='+pr_qty;
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pr_type]=p';
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+j+'][pizza_session]='+JSON.stringify($.parseJSON($(this).children('#productdata').val()));
			}
			j++;
		});		
					
			var pr_total = parseFloat($('.cart-total span').html()).toFixed(2);
			pr_total = parseFloat(parseFloat(pr_total)+parseFloat(price)).toFixed(2);
			
			$('.cart-total span').html(pr_total);
			$('#total-hidden-charges').val(pr_total);
			
			$('#sidebar .cart-info').append("<li id=cart_"+dealId+"_"+prod_idd+"_deal><div class='shopp' id='each_"+dealId+"_"+prod_idd+"_deal'><div class=item_"+dealId+"_"+prod_idd+"_deal>"+dealName+"</div><span class='shopp-quantity'>1x</span><div class='shopp-price'><span class='shoprice'>"+currencySymbol+"<label>"+parseFloat(price).toFixed(2)+"</label></span><img src='/images/remove_button.png' class='remove' /></div></div></li>");
	 	$(".common_sidecart").mCustomScrollbar('update');
	 	$.ajax({
			type: "POST",
			url: "/menu/managecart",
			data: 'data['+cartkey+'][pr_id]='+dealId+'&data['+cartkey+'][pro_id]='+prod_idd+'&data['+cartkey+'][pr_quan]='+$('#each_'+dealId+'_'+prod_idd+'_deal').children(".shopp-quantity").html().slice(0, -1)+'&data['+cartkey+'][pr_name]='+dealName+'&data['+cartkey+'][pr_price]='+(parseFloat(price).toFixed(2)*parseInt($('#each_'+dealId+'_'+prod_idd+'_deal').children(".shopp-quantity").html().slice(0, -1))).toFixed(2)+jsonGroupOption+'&data['+cartkey+'][sessiondata]='+selected_item+'&data['+cartkey+'][pro_type]=deal'
			});
	}
}
$(".common_sidecart").mCustomScrollbar('update');
		$( ".dialogdeals" ).dialog( "close" );
}

/*
 * Combo Deals
*/ 
 // Product and Packages Add and Edit
function comboDeals(id){ //alert(cartKey);
	//$("#loader").fadeIn();
	$('#dealIds').val(id);
	
	var price = $('#dealPrice_'+id).val();
	var dealName = $('#dealName_'+id).val();
	var dealDesc = $('#dealDesc_'+id).val(); 
	var dealId = $('#dealId_'+id).val(); 
	var jsonGroupOption = [];
	var selected_item = dealId;
	var k = 0;
	var qty = 1;	
	//session store add to cart
	var cartkey = "cart_"+dealId+'_0_deal';
	// Deals Session Key Exist
	$('.cartDeals').each(function() {
		if ($(this).val() == cartkey) {
			qty = parseInt($(this).attr('qty')) + 1;
		}
  });
	
	$('.com_pr_'+dealId).each(function(){
			var liId 				= $(this).val().split("_");
			var qtys;			
			if ($(this).attr('prTypes') == 'g') {	
				qtys = (parseInt(liId[2]) * parseInt(qty));
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+k+'][pr_id]='+liId[0];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+k+'][prod_id]='+liId[1];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+k+'][pr_name]='+liId[3];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+k+'][pr_qty]='+qtys;
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+k+'][pr_type]=g';
				
			} else if ($(this).attr('prTypes') == 'p') {
				
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+k+'][pr_id]='+liId[1];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+k+'][prod_id]='+liId[2];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+k+'][pr_numli]='+liId[3];
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+k+'][pr_name]='+pr_name;
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+k+'][pr_qty]=1';
				jsonGroupOption+='&data['+cartkey+'][groupOption]['+k+'][pr_type]=p';
			}
			k++;
		});			
	 
	$.ajax({
		type: "POST",
		url: "/menu/managecart",
		data: 'data['+cartkey+'][pr_id]='+dealId+'&data['+cartkey+'][pro_id]=0&data['+cartkey+'][pr_quan]='+qty+'&data['+cartkey+'][pr_name]='+dealName+'&data['+cartkey+'][pr_price]='+(parseFloat(price)*parseInt(qty))+jsonGroupOption+'&data['+cartkey+'][pr_notes]=mk&data['+cartkey+'][pro_type]=deal&data['+cartkey+'][pro_option_name]='+dealName,
		success: function(){
			window.location.href='/menu';
		}
	});
}
//=========================Multi Group Option Add==========================================
function deals_genric_group_chnge(pro_id,product_option_name,product_option_price,product_id,pro_op_val_id,tab_no)
{
	if(product_option_name.length>11)
	{
		product_option_name =  substr_replace(''+product_option_name+'', '...', 11);
	}
	else
	{
		product_option_name =  product_option_name;
	}
	
	option_name = product_option_name;
	$(".deals_"+tab_no+"_product_option_selected_span_"+pro_id).html(product_option_name);
	$(".option_menu").css("display","none");
	var json_pro_grup_id = $.parseJSON($('#deals_'+tab_no+'_prod_grup_op_id_'+product_id).val());
	var currency = $("#restaurant_setting_paypalCurrencySymbol").val();
	var def_gr_o_id_hiddin = $("#deals_"+tab_no+"_pro_def_grup_"+product_id).val();
	 var pro_op_va_price = 0;
	 var com_id_setting = 0;
	 
	 $.each(json_pro_grup_id, function( i,item ) {
		var pro_op_g_v_name =  $(".deals_"+tab_no+"_product_option_selected_span_"+item).html();

		
	 var jsondata_group_option = $.parseJSON($('#deals_'+tab_no+'_product_grup_option_json_'+item).val());
		 
		$.each(jsondata_group_option, function( i,item ) {//alert(goid);alert(id);
			if(pro_op_g_v_name==item.name)
			{
				pro_op_va_price +=parseFloat(item.price);
			}
			
			if(item.product_group_id == def_gr_o_id_hiddin && pro_op_g_v_name==item.name && pro_id != def_gr_o_id_hiddin)
			{
				 com_id_setting = item.id;
			}
			
			if(item.product_group_id != def_gr_o_id_hiddin && pro_op_g_v_name==item.name && pro_id != def_gr_o_id_hiddin)
			{
				if(product_option_name == item.name && item.is_default == 1)
				{
					pro_op_val_id =com_id_setting;	
				}
			}
			
		});
	});
	
	var def_gr_o_id_hiddin = $("#deals_"+tab_no+"_pro_def_grup_"+product_id).val();
	
	$(".deals_"+tab_no+"_product_option_selected_span_"+def_gr_o_id_hiddin).attr('id','deals_'+tab_no+'_product_option_selected_span_id_'+product_id+'_'+ product_id+def_gr_o_id_hiddin+pro_op_val_id);
	var total_product_option = (parseFloat(product_option_price)+parseFloat(pro_op_va_price)).toFixed(2); //+ parseFloat($("#product_price_"+product_id).val());
	$("#deals_"+tab_no+"_product_display_price_"+product_id).html(currency+'<label id="deals_'+tab_no+'_total_price_'+product_id+'">'+total_product_option+'</label>');
}

// deal_customise menu Tabs Next Button
function deals_tabsnextbutton1(s) {
	
	var selected = $("#tabs_dealsnew").tabs("option", "active");//alert(selected);
	var lasttabid = $('.ui-tabs-panel').last().attr('id');
	var firsttabid = $('.ui-tabs-panel').first().attr('id');//alert(lasttabid1);
	$(".ui-tabs-panel").each(function(i){var $curr = $("#"+this.id+"");
		if(this.id==firsttabid)
		{
		  $("div #"+$curr.attr('id')).children('.next_button').children('#prev').css('display','none');
		}
		else if(this.id==lasttabid){
			$("div #"+$curr.attr('id')).children('.next_button').children('#next').css('display','none');
			$("div #"+$curr.attr('id')).children('.next_button').children('#prev').css('display','block');
		}
		else
		{
		   $("div #"+$curr.attr('id')).children('.next_button').children('#prev').css('display','block');
		}
		if($("#"+this.id).is(':visible'))
		{
			customiseImages($("#"+$curr.attr('id')+"_li a").attr('imagename'));
		}
	});
	return false;
}
function deals_tabsnextbutton() {
	//alert('s');
	//alert("dsa");
	var selected = $("#tabs_dealsnew").tabs("option", "active");//alert(selected);
    $("#tabs_dealsnew").tabs("option", "active", selected + 1);
	var lasttabid = $('.ui-tabs-panel').last().attr('id');
	var firsttabid = $('.ui-tabs-panel').first().attr('id');//alert(lasttabid);alert(firsttabid);
	$(".ui-tabs-panel").each(function(i){
		var $curr = $("#"+this.id+"");
		if(this.id==firsttabid)
		{
		  $("div #"+$curr.attr('id')).children('.next_button').children('#prev').css('display','none');
		}
		else if(this.id==lasttabid){
			$("div #"+$curr.attr('id')).children('.next_button').children('#next').css('display','none');
			$("div #"+$curr.attr('id')).children('.next_button').children('#prev').css('display','block');
		}
		else
		{
		   $("div #"+$curr.attr('id')).children('.next_button').children('#prev').css('display','block');
		}
		
	});
	return false;
}

// customise menu Tabs Prev Button
function deals_tabsprevbutton() {
	var selected = $("#tabs_dealsnew").tabs("option", "active");//alert(selected);
    $("#tabs_dealsnew").tabs("option", "active", selected - 1);
	var lasttabid = $('.ui-tabs-panel').last().attr('id');
	var firsttabid = $('.ui-tabs-panel').first().attr('id');//alert(lasttabid1);
	$(".ui-tabs-panel").each(function(i){var $curr = $("#"+this.id+"");
		if(this.id==firsttabid)
		{
		  $("div #"+$curr.attr('id')).children('.next_button').children('#prev').css('display','none');
		}
		else if(this.id==lasttabid){
			$("div #"+$curr.attr('id')).children('.next_button').children('#next').css('display','none');
			
			$("div #"+$curr.attr('id')).children('.next_button').children('#prev').css('display','block');
		}
		else
		{
		   $("div #"+$curr.attr('id')).children('.next_button').children('#prev').css('display','block');
		}
		
	});
	return false;
}
function deals_groupoptionvalue_chnge(pro_gp_op_id , def_pro_gp_op_id , pro_gp_op_name , pro_gp_op_price , pro_group_price , pro_group_name , pro_group_id,pro_name)
{
	//alert(pro_gp_op_id);
	//alert(pro_name);
	$(".product_option_selected_span_"+pro_group_id).html(pro_gp_op_name);
	var currencySymbol = $("#restauransettingpaypalCurrencySymbol").val();
	var total_product_Grp_option_value = (parseFloat(pro_group_price)+parseFloat(pro_gp_op_price)).toFixed(2);
	$(".product_group_option_value_price_"+pro_group_id).html(currencySymbol+total_product_Grp_option_value);
	$("#add_custom_button_"+pro_group_id).html('');
	var total_pro_grup_price = (parseFloat(pro_group_price)+parseFloat(pro_gp_op_price));
	//alert(total_pro_grup_price);
		var  pro_group_val_id="'"+ pro_group_id+"'"; var pro_group_option_name = "'"+pro_group_name+"-"+pro_gp_op_name+"'"; var pro_group_val_price = "'"+total_pro_grup_price+"'"; var pro_group_val_name ="'"+pro_name+"'"; //var pro_group_val_id ="'"+pro_gp_op_id+"'";
		var pro_group_op_val_id ="'"+ def_pro_gp_op_id +"'"; var pro_def_op_val_id = "'"+pro_gp_op_id+"'";
		
		
		if ($("#tab_"+def_pro_gp_op_id).attr('ismultiple') == 1) 
		{
			//alert("Multi");	
			$("#add_custom_button_"+pro_group_id).append('<button class="add_custom" style="float:none !important;" onclick="addtocart_customisemenu_deals('+pro_group_val_id+'  , '+pro_group_option_name+' , '+pro_group_val_price+' , '+pro_group_val_name+' , '+pro_group_op_val_id+' , '+pro_def_op_val_id+')"><img src="images/add_button.png" alt="Add"/></button>');
		} 
		else 
		{
			//alert("singal");	
			$("#add_custom_button_"+pro_group_id).append('<button class="add_custom" style="float:none !important;" onclick="addtocart_customisemenu_deals('+pro_group_val_id+'  , '+pro_group_option_name+' , '+pro_group_val_price+' , '+pro_group_val_name+' , '+pro_group_op_val_id+' , 1)"><img src="images/add_button.png" alt="Add"/></button>');
		}
}

//customise menu Remove to cart products 
$(function() {	
	$('.remove_customise_deals').livequery('click', function() {
		var pr_quan_total= parseFloat($(this).parent().children(".shopp-price .shoprice").find('label').html()).toFixed(2);
		var pr_total 		 = parseFloat($('.cart-total-customise-g span').html()).toFixed(2);
		var pr_pro_id		 = $(this).parent().parent().attr('id').replace('each_','');
		var quantity  	 = $('#each_'+pr_pro_id).children(".shopp-quantity").html().slice(0, -1);
		var product_name = $('.item_'+pr_pro_id).html();
		if(quantity == 1 ) {
			if(pr_quan_total == pr_total) {	
				$('.cart-total-customise-g span').html(0);
				$("#cart-total-customise").css('display','block');
			}else{
				prev_charges_tol = parseFloat(pr_total - pr_quan_total).toFixed(2);
				$('.cart-total-customise-g span').html(prev_charges_tol);
			}
				$(this).parent().parent().remove();
				$("#cart_"+pr_pro_id).closest('li').remove();
					quantity = 0;					
				if($(".cart_customise").children('li').length == 0)
				{					
					if($('.customise_layout #sidebar_container .com_order button').attr('class') == 'addcart')
					{
						$('.customise_layout #sidebar_container .com_order button').removeClass('addcart').addClass('order');
						$('.customise_layout #sidebar_container .com_order button').removeAttr('onclick');
						$('input[name=Quantity]').attr('disabled','disabled');
						$('input[name=Quantity]').val(0);
					}
				}
				$(".common_sidecart").mCustomScrollbar('update');
		}	else {
				var total_quantity = quantity;
				var qua_price 		 = parseFloat(parseFloat(pr_quan_total) / parseInt(total_quantity)).toFixed(2); 
				var shop_price_qua = parseFloat(parseFloat(pr_quan_total) - parseFloat(qua_price)).toFixed(2); 
						$('#each_'+pr_pro_id).children(".shopp-price").find('label').html(shop_price_qua);
				var shop_total 		 = parseFloat(parseFloat(pr_total)-parseFloat(qua_price)).toFixed(2);
						$('.cart-total-customise-g span').html(shop_total);
						$('#total-hidden-charges-customise').val(shop_total);
						quantity = parseInt(quantity)-parseInt(1);
						$('#each_'+pr_pro_id).children(".shopp-quantity").html(quantity+'x');
		}
	});
});

function closePopup(clss){	
	$( "."+clss ).dialog( "close" );	
}

/*** Deals Popup ****/
function deals_popup(id) {
	$("#pr_notes").css('display','block');
	$("#dealpopup_"+id).fadeIn(50);
 	positionPopup();
}
/****close popup****/
function closenotepopup(){												 
	$(".dialognotes").fadeOut(50);
	$("#pr_notes").css('display','none');
}
//position the popup at the center of the page
function positionPopup(){
  if(!$(".dialognotes").is(':visible')){
    return;
  } 
  $(".dialognotes").css({
      left: ($(window).width() - $('.dialognotes').width()) / 2,
      top: ($(window).width() - $('.dialognotes').width()) / 7,
      position:'absolute'
  });
}
//maintain the popup at center of the page when browser resized
$(window).bind('resize',positionPopup);

/***********************COMBO DEALS 15 VARIABLE *****************/

function addtocarts_combomk(pr_id,pr_name,pr_price,productType,type,pro_json_id,tab_no,count,checked) 
{ //alert('mahesh');
//alert(checked);

	var pr_price = 0;
	if($("#deals_"+tab_no+"_total_price_"+pr_id).html() == undefined) {
		pr_price = 0;
	} else {
		pr_price = $("#deals_"+tab_no+"_total_price_"+pr_id).html();	
	}	
		if($('.com_order button').attr('class') == 'order') {
			$('.com_order button').removeClass('order').addClass('addcart');
		}
		product_name 	= pr_name;
		cart_add_combomk(pr_id,pr_price,productType,type,checked,tab_no,pro_json_id,count);	
}



function cart_add_combomk(pr_id,pr_price,productType,type,checked,tab_no,pro_json_id,count) 
{ //alert(pr_id); alert(productType); alert(tab_no);
	
	/*var tabsid = 0;
		$('#tabs_deals').find('.ui-tabs-nav').children().each(function(){	
			if($(this).attr('aria-selected')=="true"){
				tabsid = $(this).attr('id');
			}
		});
	var tabId = tabsid.split('_');*/	
	
	var tabsid = 0;
	var anyprd = 0;
	$('#tabs_deals').find('.ui-tabs-nav').children().each(function(){	
			if($(this).attr('aria-selected')=="true"){
				tabsid = $(this).attr('id');
				anyprd = $(this).attr('anyprd');
			}
		});
	var tabId = tabsid.split('_');
	//var tabId =$( "#tabs_deals"  ).tabs("option", "active");

	var prQuentity = $('#catQuenty_'+tabId[1]).val();
	//alert(anyprd);
	
	//Any
	
if (anyprd == 0) 
{	prQuentity=1;
	if (checked==true) 
	{
		var num = $('#tabs-'+tabId[1]+' input:checkbox:checked').length;
		
		if ($('#catQuenty_'+tabId[1]).val() < num){
			jAlert('<span class="alert_msg">You must Select at least '+$('#catQuenty_'+tabId[1]).val()+' Quantity</span>','Sorry');
			$('#check_'+pr_id).attr("checked",false);
			
			return false;
		}		
	}else{ 		
		if (type == 'g') {	
			$('#cart_'+pr_id+'_0_'+tabId[1]).remove();
		} else if (type == 'p') {
			var pro_id_array = $(".deal_"+tab_no+"_product_option_selected_span_"+pr_id).attr('id').split("_");
			$('#cart_'+pr_id+'_'+pro_id_array[6]+'_'+tabId[1]).remove();
		}
	
		$(".common_sidecart_customise").mCustomScrollbar('update');
		return false;
	}	
}

	//end any
	var activetab = parseInt($.trim(tabId[1]));
		//$('#tabs_deals').tabs('enable', activetab);
	if(activetab==6){
		
			for(var i=0;i<activetab;i++)
			{				
				$('#tabs_deals').tabs('enable', i);
			}
		$('#tabs_deals').tabs('enable', activetab);
	}else{$('#tabs_deals').tabs('enable', activetab);} 	


if (anyprd != 0) 
{	
	if (tabId[1] == tabId[1]) { 
		var buyarray =$.parseJSON($('#buyArray').val());
		$('#sidebar_container .customise_cart .common_sidecart_customise .cart_customise_deal li').each(function() {
      var liId = $(this).attr('id').split("_");
				if ($(this).attr('types') == 'g') {	
					$('#cart_'+liId[1]+'_'+liId[2]+'_'+tabId[1]).remove();
				} else if ($(this).attr('types') == 'p') {
					$('#cart_'+liId[1]+'_'+liId[2]+'_'+tabId[1]).remove();
				}
    });
	}else if (tabId[1] == tabId[1]){ 
		var getarray = $('#getArray').val(); 		 
		$('#sidebar_container .customise_cart .common_sidecart_customise .cart_customise_deal li').each(function(i) {
      var liId = $(this).attr('id').split("_");
				if ($(this).attr('types') == 'g') {	
					$('#cart_'+liId[1]+'_'+liId[2]+'_'+tabId[1]).remove();
				} else if ($(this).attr('types') == 'p') {
					$('#cart_'+liId[1]+'_'+liId[2]+'_'+tabId[1]).closest('li').remove();
				}
		});
	}
}

if(type=='g')
{	 
	if ($(".deals_"+tab_no+"_product_option_selected_span_"+pr_id).attr('id') === undefined) {
		var pro_id_array =[];
		pro_id_array[8]= 0;	
	} else {
		var pro_id_array = $(".deals_"+tab_no+"_product_option_selected_span_"+pr_id).attr('id').split("_");
	}	
	
	if(count!=0)
	{
	var json_pro_grup_id = $.parseJSON(pro_json_id);
	var ArrayS= [];
	$.each(json_pro_grup_id, function( i,item ) {
		
		 var pro_op_g_v_name =  $(".deals_"+tab_no+"_product_option_selected_span_"+item).html();
		 var jsondata_group_option = $.parseJSON($('#deals_'+tab_no+'_product_grup_option_json_'+item).val());
			$.each(jsondata_group_option, function( i,item ) {
				
				if(pro_op_g_v_name==item.name)
				{
				ArrayS.push(item.id);
		 		ArrayS.push(item.product_group_id);
		 		ArrayS.push(item.price);
		 		ArrayS.push(1);
		 		ArrayS.push('shaggy');
		 		ArrayS.push(item.name);
		 		ArrayS.push(1);
				}
			});
			
	});
	
	$('#sidebar_container .customise_cart .common_sidecart_customise .cart_customise_deal').append("<li id=cart_"+pr_id+"_"+pro_id_array[8]+"_"+tabId[1]+" types='g' prqtycomb="+prQuentity+" prqty="+pr_id+" prprice="+pr_price+" ><div class='shopp' id='each_"+pr_id+"_"+pro_id_array[8]+"_"+tabId[1]+"'><div class='item_"+pr_id+"_"+pro_id_array[8]+"_"+tabId[1]+"'><span class='smalltext'>"+prQuentity+"x <label>"+product_name+"</label></span></div><span class='shopp-quantity'></span><div class='shopp-price'><span class='shoprice'><label></label></span></div></div><input type='hidden' id='array_"+pr_id+"_"+pro_id_array[8]+"_"+tabId[1]+"' class='customArray_mulgrup' value='"+JSON.stringify(ArrayS)+"'></li>");
	}
	else
	{
		$('#sidebar_container .customise_cart .common_sidecart_customise .cart_customise_deal').append("<li id=cart_"+pr_id+"_"+pro_id_array[8]+"_"+tabId[1]+" types='g' prqtycomb="+prQuentity+" prqty="+pr_id+" prprice="+pr_price+" ><div class='shopp' id='each_"+pr_id+"_"+pro_id_array[8]+"_"+tabId[1]+"'><div class='item_"+pr_id+"_"+pro_id_array[8]+"_"+tabId[1]+"'><span class='smalltext'>"+prQuentity+"x <label>"+product_name+"</label></span></div><span class='shopp-quantity'></span><div class='shopp-price'><span class='shoprice'><label></label></span></div></div></li>");
	}
$(".common_sidecart_customise").mCustomScrollbar('update');
} 
else 
{ 	foodtype="pizza";
		var jdata=$.parseJSON($('.wrap').find('li[id="'+pr_id+'"]').find('input[id="addcustomisedefault"]').val());
		var proarray2=new Array();
		var proarray3=new Array();
		$.each(jdata, function( i,item ) {
			var pr=new Array();
			pr.push(item[0]);pr.push(item[1]);pr.push(item[2]);pr.push(item[3]);pr.push(item[4]);
			pr.push(item[5]);//alert(pr.toSource());
			var fl=1;
			proarray2.push(pr);
		});
		
			var pro_id_array = $(".deal_"+tab_no+"_product_option_selected_span_"+pr_id).attr('id').split("_");
			
			var listlength=$('#sidebar_container #sidebar .common_sidecart .cart_customise_deal li').length;
			var linenum=tabId[1]; //listlength+1; //alert(pr_id);alert(pro_id_array[6]);
			var cartkey="cart_"+pr_id+"_"+pro_id_array[6]+"_2";
			//alert(tabId[1]);
			$('#sidebar_container .customise_cart .common_sidecart_customise .cart_customise_deal').append("<li id='cart_"+pr_id+"_"+pro_id_array[6]+"_"+linenum+"' class='myitems' prqtycomb="+prQuentity+" types='p' prqty="+pr_id+" prprice="+pr_price+"><div class='shopp' id='each_"+pr_id+"_"+pro_id_array[6]+"_"+linenum+"'><div class='item_"+pr_id+"_"+pro_id_array[6]+"_"+linenum+"'><span class='smalltext'>"+prQuentity+"x <label>"+product_name+"</label></span></div><span class='shopp-quantity'></span><div class='shopp-price'><span class='shoprice'><label></label></span></div></div><input type='hidden' id='productdata' value='"+JSON.stringify(proarray2)+"'/></li>");
	
	$(".common_sidecart_customise").mCustomScrollbar('update');
	}
	 list = [];
	$("#sidebar_container .customise_cart .common_sidecart_customise .cart_customise_deal").children('li').each(function(){
			list.push($(this).attr('prprice'));
			//alert($(this).attr('prprice'));
	 });
	//alert('d'); alert($("#dealtype").val());
	//alert(list[1]);
	var dis_type = $("#dealtype_distype").val();
	var dis_amt = $("#dealtype_dis_amt").val();
	if($("#dealtype").val()==1)
	{
	$('.cart-total-customise span').text(parseFloat(Math.max.apply(Math, list)).toFixed(2));
	} else if ($("#dealtype").val()==3) {
		//alert('WEEK END DEALS');
	} else if ($("#dealtype").val()==4) {
		//alert('Combo Deals');
	} else {
		if(!list[1])
		{
			//alert(list[0]);	
			$('.cart-total-customise span').text(parseFloat(list[0]).toFixed(2));
		}
		else
		{
			if(dis_type=='percentage')
			{
				var send = list[1]-(list[1]*(dis_amt/100));
				$('.cart-total-customise span').text((parseFloat(list[0])+parseFloat(send)).toFixed(2));
			}
			else
			{
				$('.cart-total-customise span').text((parseFloat(list[0])+parseFloat(list[1]-dis_amt)).toFixed(2));
			}
		}
	}
	
}

// Buy One Get One Deals Next Button
function tabsnextbuttondealsp() {
	
	var s=parseInt($("#tabs_deals").tabs("option", "active"))+1;
	$( "#tabs_deals" ).tabs({
		activate: function( event, ui ) {
			$('.listbox').mCustomScrollbar("destroy");
			$('.listbox').mCustomScrollbar();
		}
	});
	
	var selected = $("#tabs_deals").tabs("option", "active");//alert(selected);
    $("#tabs_deals").tabs("option", "active", selected + 1);
	var lasttabid = $('.ui-tabs-panel').last().attr('id');
	var firsttabid = $('.ui-tabs-panel').first().attr('id');//alert(lasttabid);alert(firsttabid);
	$(".ui-tabs-panel").each(function(i){
		var $curr = $("#"+this.id+"");
		if(this.id==firsttabid)
		{
		  $("div #"+$curr.attr('id')).children('.next_button').children('#prev').css('display','none');
		}
		else if(this.id==lasttabid){
			$("div #"+$curr.attr('id')).children('.next_button').children('#next').css('display','none');
			$("div #"+$curr.attr('id')).children('.next_button').children('#prev').css('display','block');
		}
		else
		{
		   $("div #"+$curr.attr('id')).children('.next_button').children('#prev').css('display','block');
		}
		
	});
	return false;
	
}

// Buy One Get One Deals Back Button
function tabsprevbuttondealsp() {
	var selected = $("#tabs_deals").tabs("option", "active");//alert(selected);
    $("#tabs_deals").tabs("option", "active", selected - 1);
	var lasttabid = $('.ui-tabs-panel').last().attr('id');
	var firsttabid = $('.ui-tabs-panel').first().attr('id');//alert(lasttabid1);
	$(".ui-tabs-panel").each(function(i){var $curr = $("#"+this.id+"");
		if(this.id==firsttabid)
		{
		  $("div #"+$curr.attr('id')).children('.next_button').children('#prev').css('display','none');
		}
		else if(this.id==lasttabid){
			$("div #"+$curr.attr('id')).children('.next_button').children('#next').css('display','none');
			$("div #"+$curr.attr('id')).children('.next_button').children('#prev').css('display','block');
		}
		else
		{
		   $("div #"+$curr.attr('id')).children('.next_button').children('#prev').css('display','block');
		}
		
	});
	return false;
}
