getCurrentWidth=$(window).width(),$(window).resize(function(){function e(){var e=jQuery('<div style="width: 100%; height:200px;">test</div>'),t=jQuery('<div style="width:200px;height:150px; position: absolute; top: 0; left: 0; visibility: hidden; overflow:hidden;"></div>').append(e),i=e[0],n=t[0];jQuery("body").append(n);var o=i.offsetWidth;t.css("overflow","scroll");var a=n.clientWidth;return t.remove(),o-a}getWidth=$(window).width(),scrollB=e(),realWidth=getWidth-scrollB,offset=$(".top-nav > ul").offset(),$(".top-nav > ul > li.fw").each(function(){var e=$(this).next("div");$(this).hover(function(){$(this).find("a").addClass("fw-hovered"),e.css("width",realWidth),e.css("left",-offset.left),e.slideDown("fast")},function(){$(this).find("a").removeClass("fw-hovered"),e.slideUp("fast")})}),$(".top-nav > ul div.top-nav-mega-full-width").bind("mouseenter",function(){$(this).stop(!0,!0),$(this).prev("li").find("a").addClass("fw-hovered")}).bind("mouseleave",function(){$(this).stop(!0,!0).slideUp("fast"),$(this).prev("li").find("a").removeClass("fw-hovered")}),getCurrentWidth==getWidth?($(".social-media").css("visibility","visible"),$("#onResize").remove()):($(".social-media").css("visibility","hidden"),$("head").append('<link rel="stylesheet" type="text/css" id="onResize" href="css/onresize.css">'))}),$(document).ready(function(){function e(){var e=jQuery('<div style="width: 100%; height:200px;">test</div>'),t=jQuery('<div style="width:200px;height:150px; position: absolute; top: 0; left: 0; visibility: hidden; overflow:hidden;"></div>').append(e),i=e[0],n=t[0];jQuery("body").append(n);var o=i.offsetWidth;t.css("overflow","scroll");var a=n.clientWidth;return t.remove(),o-a}function t(){var e=!1;return function(t){(/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(t)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(t.substr(0,4)))&&(e=!0)}(navigator.userAgent||navigator.vendor||window.opera),e}var i=$(".shop-item").length;$("p.itemcount").text("You have "+i+" item(s)."),$(function(){$(".item-remove > a").on("click",function(){$(this).parent().parent().remove();var e=$(".item-remove").length;$("p.itemcount").text("You have "+e+" item(s).")})}),getWidth=$(window).width(),scrollB=e(),realWidth=getWidth-scrollB,offset=$(".top-nav > ul").offset(),$(".top-nav > ul > li.fw").each(function(){var e=$(this).next("div"),t=navigator.userAgent.toLowerCase().indexOf("chrome")>-1;$(this).hover(function(){$(this).find("a").addClass("fw-hovered"),e.css("width",realWidth),t?e.css("left",-offset.left-12):(e.css("left",-offset.left),$(".top-nav > ul > li > ul.top-nav-mega-2.top-nav-rtl").css("left","-533px")),e.stop(!0,!0).slideDown("fast")},function(){$(this).find("a").removeClass("fw-hovered"),e.stop(!0,!0).slideUp("fast")})}),$(".top-nav > ul div.top-nav-mega-full-width").bind("mouseenter",function(){$(this).stop(!0,!1),$(this).prev("li").find("a").addClass("fw-hovered"),$(".curtain").css("visibility","visible"),$(".curtain").stop(!0,!1).fadeIn(200)}).bind("mouseleave",function(){$(this).stop(!0,!0).slideUp("fast"),$(this).prev("li").find("a").removeClass("fw-hovered"),$(".curtain").stop(!0,!0).fadeOut(250)});var n="st-effect-1",o=(n.substr(n.length-1),document.getElementById("main-container")),a=(t()?"touchstart":"click","login-effect"),s=document.getElementById("login-container");searchEffect="search-effect",searchContainer=document.getElementById("search-container"),shopEffect="shop-effect",shopContainer=document.getElementById("shop-container"),$("#brien-button").bind("click",function(e){$(o).hasClass("reveal-hidden-menu")?($(o).removeClass("reveal-hidden-menu"),$(".curtain").stop(!1,!1).fadeOut(250)):(e.stopPropagation(),e.preventDefault(),o.className="main-container",$(o).addClass(n),setTimeout(function(){$(o).addClass("reveal-hidden-menu")},25),$(".curtain").css("visibility","visible"),$(".curtain").stop(!1,!1).fadeIn(200))}),$("#login-form").click(function(){$(s).delay(800).toggleClass(a),$(searchContainer).removeClass(searchEffect),$(shopContainer).removeClass(shopEffect)}),$(".search-toggle").click(function(){$(searchContainer).delay(800).toggleClass(searchEffect),$(s).removeClass(a),$(shopContainer).removeClass(shopEffect)}),$(".shop-toggle").click(function(){$(shopContainer).delay(800).toggleClass(shopEffect),$(searchContainer).removeClass(searchEffect),$(s).removeClass(a)}),$(".side-menu-effect-toggle").change(function(){n=this.value}),$(".top-nav ul ul li:has(li)").find(" > a").css({"background-image":"url(img/icon-right.png)","background-repeat":"no-repeat","background-position":"130px 15px"}),$("body").tooltip({selector:'[data-toggle="tooltip"]'}),$(".social-media > a").attr({"data-placement":"bottom","data-toggle":"tooltip"}),$(".top-nav > ul > li").hover(function(){$(".curtain").css("visibility","visible"),$(".curtain").stop(!1,!1).fadeIn(200)},function(){$(".curtain").stop(!1,!1).fadeOut(250)})});

