jQuery(document).ready(function($) {
	$.extend({
		setKey : function(uid, key) {
			if(uid == '' || key == '') {
				$.msg('<span style="color: #ff0000;">密钥或者用户编号不能为空，请到友言官网获取密钥以及用户编号</span>');
				return false;
			}
			$.ajax({
				url : 'http://api.uyan.cc',
				type : 'get',
				dataType : 'jsonp',
				data : {mode : 'ckkey', uid : uid, key : key, sdm : window.document.domain},
				jsonp : 'cb',
				// jsonpCallback : '$.setKeyRet',
				success : function(ret) {
					if(ret.stat == true) {
						// $.post('./admin.php?page=uyan', {action : 'setkey', key : ret.key, uid : ret.uid});
						// $.get('./admin.php?page=uyan&action=setkey&key=' + ret.key + '&uid=' + ret.uid);
						var url = './admin.php?page=uyan&action=setkey&key=' + ret.key + '&uid=' + ret.uid;
						var iframe = document.createElement('iframe');
						iframe.scrolling = 'no';
						iframe.style.cssText = 'display: block !important; width: 100% !important; border: 0 none !important; overflow: hidden !important; height: 0px !important;';
						iframe.setAttribute('frameborder', '0', 0);
						document.getElementById("uyan_comment").appendChild(iframe);
						iframe.src = url;
					} else {
						$.msg('<span style="color: #ff0000;">密钥错误，请填写正确的密钥</span>');
						return false;
					}
				},
				timeout : 3000,
				error : function() {}
			});
		},
		setUid : function(uid) {
			if(uid == '') {
				$.msg('<span style="color: #ff0000;">用户编号不能为空，请注册友言账号，登陆成功后可获取用户ID</span>');
				return false;
			}
			$.ajax({
				url : 'http://api.uyan.cc',
				type : 'get',
				dataType : 'jsonp',
				data : {mode : 'ckkey', uid : uid, sdm : window.document.domain},
				jsonp : 'cb',
				success : function(ret) {
					if(ret.stat == true) {
						$('#uyan_uid').attr('disabled', true);
						$('#uyan_uid_smt').attr('disabled', true);
						$.msg('<span style="color: #0000ff;">用户编号验证成功，<span style="color: #ff0000;">现在请&nbsp;<a href="http://www.uyan.cc/comment/index/?domain=' + window.document.domain + '" target="_blank" style="color: #0000ff;">点击这里到用户后台</a>&nbsp;获取密钥并进行第二步验证</span></span>', 20000);
						$('#uyan_key').attr('disabled', false);
						$('#uyan_key_smt').attr('disabled', false);
						$('#uyan_key').focus();
					} else {
						$.msg('<span style="color: #ff0000;">用户编号错误，请填写正确的用户ID</span>');
						return false;
					}
				},
				timeout : 3000,
				error : function() {}
			});
		},
		show : function(uid, key, iUrl) {
			if(uid == '' || key == '' || iUrl == '') {
				return false;
			}
			$.ajax({
				url : 'http://api.uyan.cc',
				type : 'get',
				dataType : 'jsonp',
				data : {mode : 'ckkey', uid : uid, key : key, sdm : window.document.domain},
				jsonp : 'cb',
				success : function(ret) {
					if(ret.stat == true) {
						var iframe = document.createElement('iframe');
						iframe.scrolling = 'no';
						iframe.style.cssText = 'display: block !important; width: 100% !important; border: 0 none !important; overflow: hidden !important; height: 2000px !important;';
						iframe.setAttribute('frameborder', '0', 0);
						document.getElementById("uyan_comment").innerHTML = '';
						document.getElementById("uyan_comment").appendChild(iframe);
						iframe.src = iUrl;
					} else {
						return false;
					}
				},
				timeout : 3000,
				error : function() {}
			});
		},
		msg : function(info, time) {
			var msg = $('#uyan_msg').html();
			$('#uyan_msg').html(info);
			setTimeout(function() {$('#uyan_msg').html(msg)}, time ? time : 2500);
		},
		setCookie : function(n, v, e, p, d, s) {
			var ct = 0,
				date = new Date();
			ct = (!e) ? ct : (e * 24 * 60 * 60 * 1000);
			date.setTime(date.getTime() + ct);
			var cs = n + '=' + escape(v);
				cs += (e) ? '; expires=' + date.toGMTString() : '';
				cs += (p) ? '; path=' + p : '';
				cs += (d) ? '; domain=' + d : '';
				cs += (s) ? '; secure' : '';
			document.cookie = cs;
		},
		getCookie : function(n) {
			var s = document.cookie.indexOf(n + '='),
				l = s + n.length + 1,
				e = document.cookie.indexOf(';', l);
			if((!s) && (n != document.cookie.substring(0, n.length))) return '';
			if(s == -1) return '';
			if(e == -1) e = document.cookie.length;
			return unescape(document.cookie.substring(l, e));
		},
		delCookie : function(n) {
			$.setCookie(n, null, -1);
		},
	});
});