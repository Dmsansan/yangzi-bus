<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<title>登陆</title>
	<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
</head>
<script>
	function login(){
		//alert(21313);
		var username = document.getElementById("username").val;
		var password = document.getElementById("password").val;
		$.ajax({ 
			type:"post",	
			url:"Home/Login/login", 
			data:{"username":username,"password":password},
			dataType:"json",
			success: function(response){
        		window.location.href="Home/Index/index";
      		}
      	});
	}
</script>
<body>
	用户名：<input type="text" name="username" id="username">
	密码：<input type="password" name="password" id="password">
	<input type="submit" name="dosubmit" id="submit" onclick="login()">
</body>
</html>