<?php
namespace app\index\Controller;


use think\Session;

class Login extends Base
{
//    public function index()
//    {
//        return $this->fetch('login/index');
//    }
//
//    /**
//     * 用户登录
//     * @return mixed
//     */
//    public function dologin()
//    {
//        $postData = Request::instance()->post();
//
//        $salt = config('salt');
//        $salted = crypt($postData['password'], $salt);
//        $userinfo = new UserinfoModel();
//        $rel = $userinfo->userlogin($postData['username'], $salted);
//        if (!empty($rel['data'])||$rel['data']!=false) {
//            $user = $rel['data'];
//            Session::set('userinfo', $user);
//
//            apireturn($rel['code'], $rel['msg'], $rel['data'], 200);
//        }
//        $this->redirect('login/index');
//    }
//
//    /**
//     * 注销登陆
//     */
//    public function logout()
//    {
//        Session::delete('user');
//        $this->redirect('login/index');
//    }
    public function msign()
    {
        $info = json_decode(urldecode($_SERVER['HTTP_M_SIGN']), true);
        if(!$info) exit('授权被拒绝');

        Session::set('cardno',$info['cardNo']);

        $this->redirect('http://app.wutnews.net/');

        $Baseinfo = Baseinfo::where('cardno', $info['cardNo'])->select();
        if(!$Baseinfo) {
            $Baseinfo = new Baseinfo;
            $d = ([
                'cardno' => $info['cardNo'],
                'realname' => $info['realName'],
            ]);
            $Baseinfo->save($d);
        }
        //Session修改
        Session::set('cardno',$info['cardNo']);
        Session::set('name',$info['realName']);

        $this->redirect('http://app.wutnews.net/story/public/fullpage/index');


    }

    private function check($info)
    {
        $cardno = $info['cardno'];
        $appkey = $info['sign']['appKey'];
        $timestamp = $info['sign']['timestamp'];
        $nonce = $info['sign']['nonce'];
        $token = $info['sign']['token'];
        $openid = md5($appkey.$cardno);
        if($openid != $token) return false;
        $check = md5($nonce.$openid.$timestamp);
        return $check == $info['sign']['check'];
    }

    public function ias()
    {
        $info = json_decode($_POST['user'], true);
        if(!$info || empty($info['cardno'])) exit('授权被拒绝');

        $Baseinfo = Baseinfo::where('cardno', $info['cardno'])->select();
        if(!$Baseinfo) {
            $Baseinfo = new Baseinfo;
            $data = ([
                'cardno' => $info['cardno'],
                'realname' => $info['name'],
            ]);
            $Baseinfo->save($data);
        }

        Session::set('cardno',$info['cardno']);
        Session::set('realname',$info['name']);
        //Session::set('class', $info['bj']);

        if(empty($_POST['continueurl'])) $this->redirect('http://app.wutnews.net/story/public/fullpage/index');
        else $this->redirect('http://app.wutnews.net/story/public/fullpage/index');

    }
}

