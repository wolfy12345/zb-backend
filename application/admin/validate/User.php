<?php
namespace app\admin\validate;

use think\Validate;

class User extends Validate
{
    protected $rule =   [
        'login_account'  => 'require',
        'password'   => 'require',
        'truename' => 'require',
        'role_id' => 'require|gt:0'
    ];

    protected $message  =   [
        'login_account' => '登录名必填',
        'password'     => '登录密码必填',
        'truename'   => '真实名必填',
        'role_id.require'  => '角色组必选',
        'role_id.gt'  => '角色组必选'
    ];
}