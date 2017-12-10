<?php
namespace app\index\controller;


class Connect extends \think\Controller
{
     public function position(){
        return view();
    }
    public function connect()
    {
        
        $connect=new \app\index\model\Connect();
		$data= $connect->find();
        var_dump($data);
		$this->assign('connect',$data);	
		return view();
    }
   
}
