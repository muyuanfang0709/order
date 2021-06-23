<?php


namespace app\ordering\controller;

/**
 * 汤琪轩
 */
use think\Controller;
use think\Db;
use app\ordering\model\User as Usermodel;


class Information extends Base
{
    /*
     * 密码修改
     */
    public function pwdModify(){
        if (input('post.')) {
            if (isset($_SESSION['user'])) {
                $user = Usermodel::where('user', $_SESSION['user'])->find();
                $oldpwd = input('post.oldpwd');
                    $newpwd = input('post.newpwd');
                    if (!$newpwd){
                        return json(['data'=> 4]);
                    }else{
                        if (md5($oldpwd) == $user['password']) {
                            $ret = Usermodel::where('user', $_SESSION['user'])->update([
                                'password' => md5($newpwd)
                            ]);
                            if ($ret) {
                                return json(['data' => 1]);
                            }else {
                                return json(['data' => 0]);
                            }
                        }else{
                            return json(['data' => 2]);
                        }
                    }
            }else{
                return json(['data' => 3]);
            }
        }
        return $this->fetch('Information/pwdModify');
    }
}

