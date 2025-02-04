function setup_player(a) {
	$("ul.episodes li").removeClass("active");
	$("#ep_" + a).addClass("active");
}
function next_link(){
	$elm = $("ul.episodes li a.active");
	if($elm.length){
		var next_link = $elm.parent().next().find('a').attr('href');
		if(typeof(next_link) != 'undefined'){
			// auto load trang
			window.location.href = next_link;
		}
	}
	
}
var uagent = navigator.userAgent.toLowerCase();
var arrMobi = new Array('midp', 'j2me', 'avantg', 'ipad', 'iphone', 'docomo', 'novarra', 'palmos','palmsource', '240x320', 'opwv', 'chtml', 'pda', 'windows ce','mmp/','mib/', 'symbian', 'wireless', 'nokia','hand', 'mobi', 'phone', 'cdm', 'up.b', 'audio', 'sie-', 'sec-','samsung', 'htc', 'mot-', 'mitsu', 'sagem', 'sony', 'alcatel','lg', 'erics', 'vx', 'nec', 'philips', 'mmm', 'xx', 'panasonic','sharp', 'wap', 'sch', 'rover', 'pocket', 'benq', 'java', 'pt','pg', 'vox', 'amoi', 'bird', 'compal', 'kg', 'voda', 'sany','kdd', 'dbt', 'sendo', 'sgh', 'gradi', 'jb', 'dddi', 'moto', 'opera mobi', 'opera mini', 'android');
var URL_MOBILE = window.location.pathname;
isMobile = false;
for(i = 0; i < arrMobi.length; i++){
	if(uagent.indexOf(arrMobi[i]) != -1){
		isMobile = true;
		break;
	}
}