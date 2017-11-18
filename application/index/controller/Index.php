<?php
namespace app\index\controller;

use think\Session;

class Index extends Base
{
    public function index()
    {
        return $this->fetch();
    }

    public function getcardno()
    {
        return Session::get('cardno');
    }
}
