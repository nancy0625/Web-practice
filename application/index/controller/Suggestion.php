<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\User;

class Suggestion extends \think\Controller
{

    public function suggestion()
    {
    	  $userName = session('authority')['userName'];
           $this->assign('userName', $userName);
           return view();
       

    }
    public function suggestionDo(){
    	if (!request()->isPost()) {
            $this->redirect("index");
        } else {
          
           
            $question=input('post.question');
            $username = input('post.username');          
           
            $suggestion=new \app\index\model\Suggestion();
             
          
        
                // 使用 更新密码
             $data['question']=$question;
             $data['username']=$username;
               $rus = $suggestion->save($data);
               if($rus != false){
                 $this->success('反馈成功', url("index/index/in"));
               }else {
                $this->error('反馈失败了！！!', url("index/suggestion/suggestion"));
            }
               
           
        }
    }
   
}
