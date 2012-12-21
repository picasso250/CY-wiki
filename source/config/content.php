<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION'); // in fact, even if this is exucted by user, would it show anything?
/**
 * @file    common
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

$config['site']['name'] = '沃生活';

// pages need login
$config['page_need_login'] = array(
    'cate',
    'shop',
    'area');

// error info
$config['error']['info'] = array(
    'PASSWORD_EMPTY' => 'plz enter password',
    'REPASSWORD_EMPTY' => '请重新输入密码以确认',
    'NEW_PASSWORD_EMPTY' => '请输入新密码',
    'PASSWORD_NOT_SAME' => '两次输入的密码不一致，请重新输入',
    'USERNAME_EMPTY' => 'username empty',
    'USERNAME_OR_PASSWORD_INCORRECT' => '用户名或者密码不正确',
    'PASSWORD_INCORRECT' => '密码不正确',
    'USER_ALREADY_EXISTS' => '这个用户名已经被使用，请重新选择用户名',
    'REALNAME_EMPTY' => '请填写真实姓名',
    'PHONE_EMPTY' => '请填写手机号码',
    'EMAIL_EMPTY' => '请填写您的电子邮箱', );

$config['nav']['top'] = '
管理面板 shop
帮助 help 
';

$config['nav']['side'] = '
商铺管理 shop
 + 商铺管理 
分类管理 cate
 + 大类 BigCategory
 - 分类 Category
 - 类型 Type
地区管理 area
 + 地区管理
';

$config['help_text'] = '
此处内容由用户自定义
请至配置文件中修改
';
