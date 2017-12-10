<?php
namespace app\index\controller;


class Notice extends \think\Controller
{
   
    public function notice()
    {
        
        $notice=new \app\index\model\Notice();
		$data= $notice->find();
        var_dump($data);
		$this->assign('notice',$data);	
		return view();
    }
   
}
