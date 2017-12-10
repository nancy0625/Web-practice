<?php
namespace app\index\controller;
use think\Db;

class Index  extends \think\Controller
{
    public function index()
    {
        $book = new \app\index\model\Book();
		$data= $book->field('book_id, book_name, book_newprice ,book_img')->where('book_issepprice=1')->select();
		$this->assign('tejiabook',$data);	
		return $this->fetch();	
    }
     public function in()
    {
        $book = new \app\index\model\Book();
        $data= $book->field('book_id, book_name, book_newprice ,book_img')->where('book_issepprice=1')->select();
        $this->assign('tejiabook',$data);   
        return $this->fetch();  
    }
     public function index1()
    {
        // 获取用户名
        $userName = session('authority')['userName'];
        // 查询学生表
        $user = new \app\index\model\User();
        $result = $user->all();
        // 传递模板参数
        $this->assign('userName', $userName);
        $this->assign('menuName', 'index');
        $this->assign('result', $result);
        return view();
    }

    
     public function loginout()
    {
        session(null);
        $this->success('退出成功', url("index/login/login"));
    }
}
