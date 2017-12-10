<?php
namespace app\index\controller;


class Help extends \think\Controller
{
   
    public function help()
    {
        
        $help=new \app\index\model\Help();
    	$data1 = $help->select();
        $this->assign('help',$data1);
        return view();
    }
   
}
