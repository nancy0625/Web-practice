<?php
namespace app\index\controller;



class User extends \think\Controller
{
	//显示注册页面
	public function reg(){		
		return $this->fetch();
	}

	
    public function insert(){

		$u=new \app\index\model\User();
		$username=\think\Request::instance()->post('username'); // 获取某个post变量username
		$password=input('post.password');
		$password1=input('post.repass');
		$gender= input('post.gender'); //性别
		$email=input('post.email');
		if (md5($password)==md5($password1)){
			$sql=$u->where('user_name',$username)->find();
			if($sql){
				echo '<h1>该用户已存在. 点击此处 <a href="javascript:history.back(-1);">返回</a></h1>';
			}else{
				$data['user_name']=$username;
				$data['user_pwd']=md5($password);
				$data['user_sex']=$gender;
				$data['user_email']=$email;
				$u->insert($data); // 插入数据库
				$this->success("<h1>注册成功</h1>","index/index/index");
			}
		}else{
			echo '<h1>两次密码不一样. 点击此处 <a href="javascript:history.back(-1);">返回</a></h1>';
		}		
    }

    public function insert2(){
    	$data['user_name']=\think\Request::instance()->post('username'); // 获取某个post变量username
    	$data['user_truename']=input('post.truename');
    	$data['user_tel']=input('post.tel');
    	$data['user_qq']=input('post.qq');
    	$data['user_address']=input('post.address');
    	$data['user_yb']=input('post.yb');
		$data['user_pwd']=input('post.password');
		$data['repass']=input('post.repass');
		$data['user_sex']=input('post.gender'); //性别
		$data['user_email']=input('post.email');

		$validate = \think\Loader::validate('User');
		if(!$validate->check($data)){
			//echo '<h1>'.$validate->getError().' 点击此处 <a href="javascript:history.back(-1);">返回</a></h1>';
			$this->error($validate->getError());
		}

		$u=new \app\index\model\User();
		$u->user_name=\think\Request::instance()->post('username');
		$u->user_truename=(input('post.truename'));
		$u->user_tel=(input('post.tel'));
		$u->user_qq=(input('post.qq'));
		$u->user_address=(input('post.address'));
		$u->user_yb=(input('post.yb'));
		$u->user_pwd=md5(input('post.password'));
		$u->user_sex=input('post.gender'); //性别
		$u->user_email=input('post.email');
		$u->save();
		$this->success("<h1>注册成功</h1>","index/index/index");
    }

     public function edit()
    {
    	// 获取用户名
        $userName = session('authority')['userName'];
        $this->assign('userName', $userName);
        $user =new \app\index\model\User();
        // 学生信息
        $us = $user->where(" user_name = '$userName' ")->find();
       
        $id = $us['user_id'];

        // 根据用户名和密码去查询帐号表
        
        $query = array(
            'user_id' => $id
        );
        $row = $user->get($query);
        $this->assign('row', $row);
        return view();
       
    }

    public function editdo()
    {
        $data = input('post.');
        $user =new \app\index\model\User();
        $res = $user->save($data,array(
            'user_id' => $data['user_id']));
        if ($res > 0) {
            $this->success("修改成功！！！",url('index/index/in'));
        } else {
            $this->success("修改失败！！！",url('index/user/edit'));
        }
    }


		/*$u=new \app\index\model\User();
		$data['user_pwd']=md5(input('post.password'));
		$u->strict(false)->insert($data); // 插入数据库
		$this->success("<h1>注册成功</h1>","index/index/index");*/	


}