<?php
namespace Admin\Controller;
use Think\Controller;
include "Application\Common\Common\functions.php";
class AdminController extends Controller {
    public function index(){
		$this->dispaly();
	}
	
	public function adminList(){
		$where=array();
        
        $page_count = trim(I('page_count'));//每页总条数

		if($page_count == ''){
			$page_count = 10;
		}
		$count = M('admins')->where($where)->count();

		$real_page  = trim(I('real_page'));//当前页

		if($real_page == ''){
			$real_page = 1;
		}
		$first_page = $page_count*($real_page-1);
		$last_page = $page_count*($real_page);

		$order="ORDER BY `admin_id` DESC";
		$res = M('admins')->where($where)->limit($first_page,$last_page)->order($order)->select();
        
        if($res){
        	$data = array('status'=>success,'data'=>array('list'=>$res,'count'=>$count));
        }else{
        	$data = array('status'=>error,'data'=>array('msg'=>'无数据！'));
        }

        echo json_encode($data);
	}

	public function addAdmin(){
		$admin_name = trim(I('admin_name'));
		$role_id = trim(I('role_id'));
		$password = trim(I('password'));

		if($admin_name == '' || $role_id == '' || $password == ''){
			$data = array('status'=>error,'msg'=>'必填参数错误！');
		}else{
			$real_name = trim(I('real_name'));
			$store_id = trim(I('store_id'));
			$tel = trim(I('tel'));
            
            if(!verifyMobile($tel)){
            	$data = array('status'=>error,'data'=>array('msg'=>'联系电话格式错误！'));
            }

            $mobile = trim(I('mobile'));

            if(!verifyMobile($mobile)){
            	$data = array('status'=>error,'data'=>array('msg'=>'手机号码格式错误！'));
            }

            $email = trim(I('email'));

            if(!verifyEmail($email)){
            	$data = array('status'=>error,'data'=>array('msg'=>'邮箱格式错误！'));
            }

            $where = array('admin_name'=>$admin_name);
            $res = M('admins')->where($where)->find();
            if($res){
            	$data = array('status'=>error,'data'=>array('msg'=>'用户已存在！'));
            }else{
            	$add_data = array(
            		'admin_name'=>$admin_name,
            		'role_id'=>$role_id,
            		'password'=>$password,
            		'real_name'=>$real_name,
            		'store_id'=>$store_id,
            		'tel'=>$tel,
            		'mobile'=>$mobile,
            		'email'=>$email,
            	);
            	$add_res = M('admins')->add($add_data);
            	if($add_data){
            		$data = array('status'=>success,'msg'=>'用户添加成功！');
            	}else{
            		$data = array('status'=>error,'msg'=>'用户添加失败！');
            	}
            }
		}
		echo json_encode($data);
	}

}