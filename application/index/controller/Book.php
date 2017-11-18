<?php
namespace app\index\controller;

use app\index\model\TouserModel;
use think\Session;

class Book extends Base
{
    public function index()
    {
        return $this->fecth();
    }

    public function getallclassmates()
    {
        $touser = new TouserModel;
        $cardno = Session::get('cardno');
        $info = $touser->getallclassmates($cardno);
        return $info;
    }
}