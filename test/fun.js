function show(data, wname) {
	console.debug("in:" + wname);
}
var name = "123";
var query_url = "http://dict.hjenglish.com/services/simpleExplain/jp_simpleExplain.ashx?type=jc&w="
		+ '月';
$.ajax({
	type : "get",
	async : true,
	url : query_url,
	// dataType : "jsonp",
	// jsonp : "callback",// 传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(一般默认为:callback)
	success : function(json) {
		show(json, name);
	},
	error : function(data) {
	}
});
name = "abc";
console.debug("r:" + name);

for (var i = 0; i < localStorage.length; i++) {
	var key = localStorage.key(i);
	var value = localStorage.getItem(key);
	$.post("http://localhost/jp/index.php/Home/Word/insert", {
		name : key,
		meaning : value
	}, function(data) {

	});
}