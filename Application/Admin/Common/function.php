<?php
/*手机号码格式检验*/
function verifyMobile($mobile){
	$mobile_number = $mobile;
	$code = "/^1[34578]{1}\d{9}$/";
	$res = preg_match($code, $mobile_number);
	if($res){
		return true;
	}else{
		return false;
	}
}
/*邮箱格式验证*/
function verifyEmail($email){
	$email_number = $email;
	$code = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
	$res = preg_match($code,$email_number);
	if($res){
		return true;
	}else{
		return false;
	}
}