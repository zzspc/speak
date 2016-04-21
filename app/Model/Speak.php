<?php
namespace App\Model;

use System\Lib\DB;

class Speak extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table='speak';
        $this->fields=array('user_id','name','face1','face2','addtime','status');
    }

    function getList($data)
    {
        $data['status']=1;
        return DB::table($this->table)->where($data)->orderBy('id')->all();
    }
    function add($data = array())
    {
        $data=$this->filterFields($data);
        $data['addtime'] = date('Y-m-d H:i:s');
        $data['status'] =1;
        return DB::table($this->table)->insert($data);
    }

    function edit($data = array())
    {
        $id=$data['id'];
        unset($data['id']);
        $data=$this->filterFields($data);
        return DB::table($this->table)->where('id=?')->bindValues($id)->limit(1)->update($data);
    }

    function del($data)
    {
        return $this->dirty(array('id'=>$data['id']));
    }



    public function logList($data)
    {
        $data['status']=1;
        return DB::table('speak_log')->where($data)->orderBy('id')->all();
    }
    public function logAdd($data)
    {
        $data['addtime'] = date('Y-m-d H:i:s');
        $data['status'] =1;
        return DB::table('speak_log')->insert($data);
    }
    public function logEdit($data)
    {
        $id=$data['id'];
        unset($data['id']);
        $data['is_self']=$data['is_self'];
        $data['content']=$data['content'];
        return DB::table('speak_log')->where('id=?')->bindValues($id)->limit(1)->update($data);
    }

    function speaklog_del($data)
    {
        return $this->dirty(array('id'=>$data['id']),'speak_log');
    }
}