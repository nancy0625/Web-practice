<?php
namespace app\index\validate;
use think\Validate;

class User extends Validate
{
    protected $rule = [
        'user_name'  =>  'require|max:25',
        'user_truename'=>'require|max:25',
        'user_email' =>  'email',
        'user_tel'=>'^1[34578]{1}\d{9}$',
        'user_qq'=>'length:6,10',
        'user_address'=>'require|max:250',
        'user_yb'=>'length:6',
        'user_pwd'=>'length:3,25',
        'repass'=>'require|confirm:user_pwd',
        'user_name'   => 'unique:user',
    ];
}