$(document).ready(function(){
	$('.hide').hide();
	$('#11').hide();
	$('#21').hide();
	$('#31').hide();
	$('#41').hide();
	$('#51').hide();
	$('#61').hide();
	$('#71').hide();
	$('#1').click(function(){
		$('#11').slideToggle();
	});
	$('#2').click(function(){
		$('#21').slideToggle();
	});
	$('#3').click(function(){
		$('#31').slideToggle();
	});
	$('#4').click(function(){
		$('#41').slideToggle();
	});
	$('#5').click(function(){
		$('#51').slideToggle();
	});
	$('#6').click(function(){
		$('#61').slideToggle();
	});
	$('#7').click(function(){
		$('#71').slideToggle();
	});
	/*================color============*/
	$('.product-color-input').hide();
	$('.id-product-color-js').hide();
	var j=$('.product-color-input').val();
	var i=Number(j);
	if(i==1){
		$("#del-color").hide();
	}
	if(i>1){
		$("#del-color").show();
	}	
	$("#add-color").click(function(){
		i+=1;
		var div="#add-color"+(i-1);
		$(div).after("<div id='add-color"+(i)+"' style='margin-top:10px;'><label class='label-color' >Tên màu</label><input type='text' name='mau"+(i)+"' placeholder='Tên màu' required='required' class='group-input-color'><br><br><label class='label-color'>Ảnh</label><input type='file' name='link"+(i)+"' placeholder='Link' required='required' class='group-input-color' style='margin-left: 46px;'><hr></div>");
		$("#del-color").show();
	});
	$("#del-color").click(function(){
		var div="#add-color"+(i);
		$(div).remove();
		i-=1;
		if(i==1){
			$("#del-color").hide();
		}
	});
	/*=============loaisp============*/
	$("#gioitinh_select").change(function(){
		var a = $("select[name='gioitinh']").val();
		$.get("ajaxloai.php",{idloai:a},function(data){
			$("#addloai").html(data);
		});
	});
});