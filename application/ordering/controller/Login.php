<?php


namespace app\ordering\controller;
/*
 * 汤琪轩
 */
use think\Controller;
use app\ordering\model\User;

class Login extends Controller
{
    /**
     * 登陆流程
     */
    public function login()
    {
        if (input('post.')) {
            if (!session_id()) session_start();
            $data = input('post.');
            $user = new User();
            $result = $user->where('user',$data['user'])->find();
            $role = $user->where('user',$data['user'])->value('role_id');
            if ($result){
                if($result['password'] == md5($data['password'])){
                    if ($result['state'] != 0){
                        $_SESSION['user'] = $data['user'];
                        $_SESSION['role'] = $role;
                        return json(['data'=>0]);
                    }else{
                        return json(['data'=>1]);
                    }
                }else{
                    return json(['data'=>2]);
                }
            }else{
                return json(['data'=>-1]);
            }
        }
        return $this->fetch('Login/login');
    }

    /**
     * 登出
     */
    public function logout()
    {
        if (!session_id()) session_start();
        $_SESSION = array();
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        session_destroy();
        return json(['data'=> -1]);
//        $this->redirect('Login/login');
    }
}

