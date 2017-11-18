<?php
namespace app\index\controller;

use app\index\model\TouserModel;
use think\Controller;
use think\Request;

class Edit extends Controller
{
    public function index()
    {
        $postData = Request::instance()->get();

        $this->assign('cardno', $postData['tousercardno']);
        return $this->fetch();
    }

    public function edit()
    {
        $postData = Request::instance()->post();

        $touser = new TouserModel;
        $data = ([
            'tocardno' => $postData['cardno'],
            'realname' => $postData['realname'],
            'egname' => $postData['egname'],
            'birthday' => $postDatap['birthday'],
            'birthplace' => $postData['birthplace'],
            'height' => $postData['height'],
            'weight' => $postData['weight'],
            'bloodtype' => $postData['bloodtype'],
            'constellation' => $postData['constellation'],
            'zodiac' => $postData['zodiac'],
            'specialty' => $postData['soecialty'],
            'mantra' => $postData['mantra'],
            'advantage' => $postData['advantage'],
            'disadvantage' => $postData['disadvantage'],
            'wish' => $postData['wish'],
            'favoritesport' => $postData['favoritesport'],
            'nastything' => $postData['nastything'],
            'message' => $postData['message']
        ]);
        $touser->save($data);
        $user = Userinfo::where('cardno', $postData['cardno'])->find();
        $user->totalnum = $user->totalnum + 1;
        $user->save();
        if ($touser === false||$user === false) {
            return ['code' => -1, 'msg' => $this->getError(), 'data' => $touser];
        } else {
            return ['code' => 0, 'msg' => 'Success', 'data' => $touser];
        }
    }
}

