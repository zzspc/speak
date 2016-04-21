<?php
namespace App\Controller\Admin;

use App\Model\User;
use App\Model\UserType;
use System\Lib\DB;

class UserController extends AdminController
{
    protected $User;

    public function __construct()
    {
        parent::__construct();
        $this->User = new User();

    }

    function index()
    {
        $arr = array(
            'type_id' => (int)$_GET['type_id'],
            'username' => $_GET['username'],
            'page' => (int)$_REQUEST['page'],
            'epage' => 10
        );
        $data = $this->User->getlist($arr);
        $UserType = new UserType();
        $data['usertype'] = $UserType->getList();
        $this->view('user', $data);
    }

    function add()
    {
        if ($_POST) {
            $returnmsg = $this->User->register($_POST);
            if ($returnmsg === true) {
                show_msg(array("添加成功！", '', $this->base_url('user')));
            } else {
                show_msg(array($returnmsg));
            }
            //$this->redirect('usertype');
        } else {
            $this->view('user');
        }
    }

    //编辑用户资料
    function edit()
    {
        if ($_REQUEST['user_id'] == "1") {
            show_msg(array('超级管理员禁止操作', '', $this->base_url('user')));
            exit;
        }
        if ($_POST) {
            $arr = array();
            $arr['name'] = $_POST['name'];
            $arr['tel'] = $_POST['tel'];
            $arr['qq'] = $_POST['qq'];
            $arr['address'] = $_POST['address'];
            $arr['user_id'] = (int)$_POST['user_id'];
            $this->User->edit($arr);
            show_msg(array('修改成功', '', $this->base_url('user')));
            //$this->redirect('usertype');
        } else {
            $data['row'] = DB::table('user')->where('user_id=?')->bindValues($_GET['user_id'])->row();
            $this->view('user', $data);
        }
    }

    //修改用户类型
    function edittype()
    {
        if ($_POST) {
//            if(!empty($_POST['invite_userid']))
//            {
//                $invite_userid = DB::table('user')->where('user_id=?')->bindValues($_POST['invite_userid'])->value('user_id', 'int');
//                if ($invite_userid == 0) {
//                    show_msg(array('邀请人ID不正确'));exit;
//                }
//            }
            $arr = array(
                'type_id' => (int)$_POST['type_id']
            );
            DB::table('user')->where('user_id=?')->bindValues($_GET['user_id'])->limit(1)->update($arr);
            show_msg(array('修改成功', '', $this->base_url('user')));
            //$this->redirect('usertype');
        } else {
            $UserType = new UserType();
            $data['usertype'] = $UserType->getList();
            $data['row'] = $this->User->getOne(array('user_id' => $_GET['user_id']));
            $this->view('user', $data);
        }
    }

    function updatepwd()
    {
        if ($_POST) {
            $username = $_POST['username'];
            $errorMsg = "";
            if (strlen($_POST['password']) == 0) {
                $errorMsg .= "密码不能为空！" . "<br>";
            }
            if (strlen($_POST['password']) > 15 || strlen($_POST['password']) < 6) {
                $errorMsg .= "密码长度6位到15位！" . "<br>";
            }
            if ($_POST['password'] != $_POST['sure_password']) {
                $errorMsg .= "两次输入密码不同！" . "<br>";
            }
            if (strlen($errorMsg) > 0) {
                show_msg(array($errorMsg));
            } else {
                $post = array(
                    'username' => $username,
                    'password' => $_POST['password'],
                );
                $returnmsg = $this->User->updatepwd($post);
                show_msg(array($returnmsg, '', $this->base_url('user')));;
            }
        } else {
            $data['row'] = $this->User->getOne(array('user_id' => $_GET['user_id']));
            $this->view('user', $data);
        }
    }

}