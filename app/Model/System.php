<?php
namespace App\Model;

use System\Lib\DB;

class System extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function getlist($data=array())
    {
        $result=DB::table('system')->orderBy("`showorder`,id")->all();
        //结果转换为特定格式
        /*$items=array();
        foreach($result as $row)
        {
            $items[$row['id']]=$row;
        }*/
        return $result;
    }
    function lists()
    {
        //DB::table('system')->orderBy("`showorder`,id")->lists('value','code');
        $_system = $this->getlist();
        foreach ($_system as $key => $value){
            $system[$value['code']] = $value['value'];
        }
        return $system;
    }
    function add($data=array())
    {
        $arr['code'] = $data['code'];
        $arr['name'] = $data['name'];
        $arr['value'] = $data['value'];
        $arr['showorder'] = (int)$data['showorder'];
        $arr['style'] = (int)$data['style'];
        return DB::table('system')->insert($arr);
    }
    function edit($data=array())
    {
        $id=(int)$data['id'];
        $arr['code'] = $data['code'];
        $arr['name'] = $data['name'];
        $arr['value'] = $data['value'];
        $arr['showorder'] = (int)$data['showorder'];
        $arr['style'] = (int)$data['style'];
        return DB::table('system')->where('id=?')->bindValues($id)->limit(1)->update($arr);
    }
}