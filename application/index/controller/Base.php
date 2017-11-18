<?php
namespace app\index\controller;
use app\index\controller\LoginController;
use think\Controller;
use think\Session;

class Base extends Controller
{
    protected function _initialize()
    {
        if (!isset($_SESSION['cardno'])){
            $this->login();
        }else{
            $url = 'http%3a%2f%2fapp.wutnews.net%2fstory%2fpublic%2ffullpage%2findex.html';
            $this->redirect('http://ias.sso.wutnews.net/portal.php?posturl=http%3a%2f%2fapp.wutnews.net%2fstory%2fpublic%2flogin%2fias&continueurl=' . $url);
        }
    }

    protected function login()
    {
        if (isset($_SERVER['HTTP_M_SIGN'])) {
            $login = new Login;
            $login->msign();
        } else {
            $url = 'http%3a%2f%2fapp.wutnews.net%2fstory%2fpublic%2ffullpage%2findex.html';
            $this->redirect('http://ias.sso.wutnews.net/portal.php?posturl=http%3a%2f%2fapp.wutnews.net%2fstory%2fpublic%2flogin%2fias&continueurl=' . $url);
        }

    }
//    protected function _initialize()
//    {
//        if (!Session::has('user_name')) {
//            $this->redirect('login/index');
//        }
//        $this->assign('realname', empty(Session::get('panel_user.realname'))?'匿名':Session::get('panel_user.realname'));
//    }
}