$(document).ready(function(){
	var w=$(window).width();
	var h=$(window).height();
// 	var image=new Image();
// 	image.src="../images/bg.jpg";
// image.addEventListener("complete",evt);
// function evt(){
// var divelement = document.getElementById(你的div的id);
// divelement.style.height=(image.height*divelement.offsetWidth)/image.width +"px";
//    };
	$("#bg").attr("width",w+"px");
	$("#bg").attr("height",h+"px");
	// $(".share").click(function(){
	// 	$(".entry-share").css("display","block");
	// })
                $(".share").click(function(event){
                    //取消冒泡事件
                    event.stopPropagation();//这句是必须
                    //若css已经给divTop定位则不需要再定位
                    var offset = $(event.target).offset();$(".entry-share").css({top:offset.top+$(event.target).height+"px",left:offset.left});
                    $(".entry-share").slideToggle();
                    $("#bg").css("opacity",0.5);
                });

                 //点击空白或者其他区域时divTop隐藏
                $(document).click(function(){
                    $(".entry-share").slideUp('slow');
                    $("#bg").css("opacity",1);
                });
            //点击divTop自身隐藏
                $(".entry-share").click(function(){
                    $(this.fadeOut(1000));
                    $("#bg").css("opacity",1);
                });
});