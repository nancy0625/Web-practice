<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\User;

class Login extends \think\Controller
{
    //显示注册页面
    public function login(){      
        return $this->fetch();
    }
    public function forget(){
        return $this->fetch();
    }

	 public function loginDo()
    {
        if (!request()->isPost()) {
            $this->redirect("index");
        } else {
            if (session('authority')) {
                session(null);
            }
            $username = $_POST['username'];
            $passcode = $_POST['password'];
            // 计算摘要
            $password2 = md5($passcode);
            
            $user = new User();
            // 根据用户名和密码去查询帐号表
            $data = array(
                'user_name' => $username,
                'user_pwd' => $password2
            );
           
            // 返回单记录，或者为空
           $result = $user->get($data);
            if ($result) {
                // 使用 authority 保存用户和权限信息
                $authority = array(
                    'userName' => $username,
                    /*'role' => 'manager'*/
                );
                session('authority', $authority);
                $this->success('登录成功', url("index/index/in"));
            } else {
                $this->error('登录失败,用户名或密码错误!', url("index/login/login"));
            }
        }
    }
      public function update(){
         if (!request()->isPost()) {
            $this->redirect("index");
        } else {
            
            $username=\think\Request::instance()->post('username'); // 获取某个post变量username
            $password=input('post.password');
            $password1=input('post.repass');

            if(md5($password)!=md5($password1)){
            $this->error('重置失败,密码不一致!', url("index/login/login"));
        
            }
        
            // 计算摘要
            $password2 = md5($password1);
            
            $user = new User();
            // 根据用户名和密码去查询帐号表
            $data = array(
                'user_name' => $username,
               
            );
           
            // 返回单记录，或者为空
            $result = $user->get($data);
            if ($result) {
                // 使用 更新密码
              
               $rus = $user->where(" user_name = '$username' ")->setField('user_pwd',"$password2");
               if($rus != false){
                 $this->success('重置成功', url("index/index/index"));
               }else {
                $this->error('重置失败!', url("index/login/login"));
            }
               
            } else{
                $this->error('查无此用户，请核对是否输入正确', url("index/login/forget"));
            }
        }
        
    }
   

}