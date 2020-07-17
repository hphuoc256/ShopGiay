$(document).ready(function(){
	$("#account").hide();
	$(".hide").hide();
	$(".account1-1-1").click(function(){
		$("#account").slideToggle();
	});
	$(".fa-window-close-o").click(function(){
		$("#account").slideUp();
	});
	// var g = $('#numberslide').val();
	// var j=Number(g);
	// var endImg=j-1;  
	var stt=0, startImg=0,endImg=0;
	startImg= $('img.img-banner:first').attr("stt");
	endImg= $('img.img-banner:last').attr("stt");
	$("img.img-banner").each(function(){
		if($(this).is(':visible')){
			stt= $(this).attr("stt");
		}
	});
	$("#next").click(function(){
		if(stt == endImg){
			stt=-1;
		}
		next= ++stt;
		$("img.img-banner").hide();
		$("img.img-banner").eq(next).show();
		$("#banner li").removeClass('active');
		$("#banner li").eq(next).addClass('active');

	});
	$("#prev").click(function(){
		if(stt==startImg){
			stt=endImg;
			prev=stt++;
		}
		prev= --stt;
		$("img.img-banner").hide();
		$("img.img-banner").eq(prev).show();
		$("#banner li").removeClass('active');
		$("#banner li").eq(prev).addClass('active');
	});
	setInterval(function(){
		$("#next").click();
	},4000);

	$('#11').hide();
	$('#21').hide();
	$('#31').hide();
	$('#1').click(function(){
		$('#11').toggle();
	});
	$('#2').click(function(){
		$('#21').toggle();
	});
	$('#3').click(function(){
		$('#31').toggle();
	});
	$('body').append('<div id="top"><i class="fa fa-arrow-circle-up" style="font-size:48px;color:#4b9ee7"></i></div>');
	$('#top').fadeOut();
	$(window).scroll(function() { 
		if($(window).scrollTop() != 0) { 
			$('#top').fadeIn();
		} else {
			$('#top').fadeOut();
		}
	});
	$('#top').click(function() {
		$('html, body').animate({scrollTop:0},500);
	});
	/*-------------homemain------------------*/
	var i=6;
	$(".button_xemthem").click(function(){
		$.get("acmain.php",{id:i,xemthem:1},function(data){
			$("#home-main").append(data);
		});
		i+=6;
	});
	/*-----------------------signup--------------*/
	$("#province_select").change(function(){
		var t = $("select[name='province']").val();
		$.get("acmain.php",{provinceid:t},function(data){
			$("#district").html(data);
		});
	});
	/*========kiểm tra username==============*/
	$("#input_username").blur(function(){
		var u = $(this).val();
		$.get("acmain.php",{usernametest:u},function(data){
			if(data==0){
				$('#alertusername').html("Hợp lệ");
			}
			else{
				$('#alertusername').html("Đã tồn tại");
			}
		});
		alert(data);
	});
	/*========kiểm tra nhập lại mật khẩu==============*/
	$("#password_again").blur(function(){
		var pw_a = $(this).val();
		var pw=$('#password').val();
		$.post("acmain.php",{passwordtest:pw,password_againtest:pw_a},function(data){
			if(data==1){
				$('#alertpassword').html("Hợp lệ");
			}
			else{
				$('#alertpassword').html("Sai mật khẩu.Vui lòng nhập lại mật khẩu");
			}
		});
	});
	/*==================Thêm vào giỏ hàng=================*/
	$("#add_cart").click(function(){
		var idsp=$("input[name='idsp']").val();
		var size=$("select[name='size_option']").val();
		var soluong=$("input[name='soluong']").val();
		var numcolor=$("input[name='numcolor']").val();
		for(var i=1;i<=numcolor;i++){
			var colorid="#numcolor"+i;
			if($(colorid).prop('checked')==true){
				var color=$(colorid).val();
			}
		}
		$.get("acmain.php",{add_giohang:1,idsp:idsp,size_option:size,soluong:soluong,color:color},function(data){
			$('#add_cart').append(data);
		});


	});

	/*==============đăng nhập header============*/
	$("#quanli_tk").hide();
	$('.tkdangnhap').click(function(){
		$("#quanli_tk").slideToggle();
	});
	$('#submit_buy_now_no').click(function(){
		$("#account").slideToggle();
	});
	$('#add_cart_no').click(function(){
		$("#account").slideToggle();
	});
	$('#cart_no').click(function(){
		$("#account").slideToggle();
	});
	/*=======Kiểm tra submit giỏ hàng======*/
	$('#submit_thanhtoan_ok').click(function(){
		 alert("Giỏ hàng không có sản phẩm");
	})
});