<?php
namespace App\Controller;

use App\Model\Taobao;
use System\Lib\DB;

class IndexController extends Controller
{
    private $token = 'vcivc';

    public function __construct()
    {
        parent::__construct();
        $this->model = new Taobao();
        $this->cates = $this->model->getCategoryList();
    }

    public function index()
    {
        $data['goods'] = $this->model->getlist();
        $data['cates']=$this->cates;
        //$this->view('index', $data);
    }

    //wap 所有分类
    public function category()
    {
        $data['title_herder']='分类';
        $data['cates'] = $this->cates;
        $this->view('category', $data);
    }
    //搜索
    public function search()
    {
        $keyword=$_GET['keyword'];
        $data['title_herder']=$keyword;
        $data['keyword']=$keyword;
        $data['cates']=$this->cates;
        $arr=array(
            'q'=>$keyword,
            'page'=>$_GET['page'],
            'pageSize'=>32
        );
        $data['goods']=$this->model->search($arr);

        if($this->is_wap){
            $this->view('goods', $data);
        }else{
            $this->view('index', $data);
        }
    }
    public function error()
    {
        $cate=trim($this->control);
        $id2=$this->input->get(1,'int');
        if($id2){
            $row=DB::table('category')->where("id=?")->bindValues($id2)->row();
        }else{
            $row=DB::table('category')->where("aside1=?")->bindValues($cate)->row();
        }
        $data['title_herder']=$row['name'];
        if($row){
            $data['goods'] = $this->model->getlist(array('categorypath'=>$row['path']));
            $data['cates']=$this->cates;
            $data['id']=$id2;
            if($this->is_wap){
                $this->view('goods', $data);
            }else{
                $this->view('index', $data);
            }
        }else{
            echo 'no';
        }
    }

    function add()
    {
        $cates=$this->cates;
        foreach ($cates as $nav) {
            if(is_array($nav['son'])){
                foreach ($nav['son'] as $sub) {
                    $cid=empty($sub['aside2'])?$nav['aside2']:$sub['aside2'];
                    $this->model->add($cid,$sub['name'], 1,$sub['id'],$sub['path']);
                }
            }
        }
        //$day1 = date('Y-m-d', time() - 3600 * 24 * 1);
        DB::table('taobaogoods')->where("addtime<?")->bindValues(date('Y-m-d'))->delete();
    }
}