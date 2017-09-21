<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
		$this->display();
	}

	public function login(){
         $admin_name = trim(I('admin_name'));
         $password = trim(I('password'));
         if($admin_name == '' || $password == ''){
            $data = array('status'=>error,'data'=>array('msg'=>'参数错误！'));
         }else{
         	$where = array('admin_name'=>$admin_name);
         	$res = M('admins')->where($where)->find();
         	if($res){
         		$password_two = $res['password'];
         		if($password == $password_two){
         			$data = array('status'=>success,'data'=>array('admin_id'=>$res['admin_id']));
         		}else{
         			$data = array('status'=>error,'data'=>array('msg'=>'密码错误！'));
         		}
         	}else{
         		$data = array('status'=>error,'data'=>arrar('msg'=>'用户不存在！'));
         	} 
         }
         echo json_encode($data);
	}

}