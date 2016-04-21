<?php
namespace App\Controller;

use App\Model\Speak;

class SpeakController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->Speak=new Speak();
    }

    public function index()
    {
        $speak_id=(int)$_GET['speak_id'];
        $data['speak']=$this->Speak->getOne(array('id'=>$speak_id));
        $data['list']=$this->Speak->logList(array('speak_id'=>$speak_id));
        $this->view('speak',$data);
    }
}