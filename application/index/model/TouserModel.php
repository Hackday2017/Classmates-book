<?php
namespace app\index\model;

use think\Model;

class TouserModel extends Model
{
    protected $table = 'touser';

    public function getallclassmates($cardno)
    {
        $where = ['u.cardno' => $cardno];
        $join = [['userinfo u', 't.tocardno=u.cardno']];
        $field = ['t.realname, t.egname, t.birthday, t.birthplace, t.height, t.weight, t.bloodtype, t.constellation,
         t.zodiac, t.specialty, t.mantra, t.advantage, t.disadvantage, t.wish, t.favoritesport, t.nastything, t.message'];
        try {
            $info = $this->alias('t')
                ->join($join)
                ->field($field)
                ->where($where)
                ->select();
            if ($info === false) {
                return ['code' => -1, 'msg' => $this->getError(), 'data' => $info];
            } else {
                return ['code' => 0, 'msg' => 'Success', 'data' => $info];
            }
        } catch (PDOException $e) {
            return ['code' => -1, 'msg' => $e->getMessage(), 'data' => ''];
        }
    }
}