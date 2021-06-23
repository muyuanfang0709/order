<?php


namespace app\ordering\controller;



use app\ordering\model\Department;
use app\ordering\model\result;
use app\ordering\model\Role;
use app\ordering\model\User;
use think\App;
use think\Controller;
use think\Db;
use think\Exception;
use think\exception\DbException;
use think\exception\PDOException;
use think\facade\Request;

/**
 * @author 吴家晗
 * 系统管理
 */
class System extends Controller
{


    /**
     * ajax测试用户名数据库是否重复
     */
    public function UserJudge($name){
        if(input('post.')){
            if(Db::table('user')->where('user',$name)->find()){
                return json(['data'=>1]);
            }
        }
    }

    /**
     * ajax测试姓名是否含有数字
     */
    public function NameJudge($name){
        if(input('post.')){
            if(preg_match('/\d+/',$name)){
                return json(['data'=>1]);
            }

        }
    }
    /**
     * ajax测试密码是否符合规范
     */
    public function PasswordJudge($name){
        if(input('post.')){
            if(!preg_match( '/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{2,10}$/u', $name )){
                return json(['data'=>1]);
            }
        }
    }
    /**
     * 添加用户
     */
    public function AddUser(){
        if(request()->isPost()){
                //获取表单值并判断
                $data=input('param.');
                if($data['user']=="")
                {
                    $this->error('账号为空,请输入账号');
                }
                if($data['password']=="")
                {
                    $this->error('密码为空，请输入密码');
                }
                if($data['name']=="")
                {
                    $this->error('用户名为空，请输入用户名');
                }
                if($data['number']=="")
                {
                    $this->error('电话号码，请输入电话号码');
                }
                $record=['user'=>$data['user'],
                    'password'=>md5($data['password']),
                    'role_id'=>$data['role_id'],
                    'name'=>$data['name'],
                    'dep_id'=>$data['dep_id'],
                    'number'=>$data['number'],
                    'state'=>1,
                    'create_time'=>date('y-m-d h:i:s', time())
                ];
                //将数据添加到数据库
                if(Db::table('user')->insert($record)){
                    return json(['data'=> 1]);
                  //  $this->success('添加用户成功',url('index'));
                }
                else{
                    return json(['data'=> 0]);
//                    $this->error('添加用户失败');
                }

        }
        else{
            return view('addUser');
        }

    }


    /**
     * 修改页面
     */
    public function userModify(){

        $userid=input('id');
        $data=User::where('uid',$userid)->find();
        $dep=Department::select();
        $role=Role::select();
        $this->assign(
            [
                'data'=>$data,
                'dep'=>$dep,
                'role'=>$role
            ]
        );
        return view('userModify');
    }

    /**
     * 编辑修改用户
     */
    public function EditorUser(){
        if(request()->isPost()){
            //获取表单相关值
            $data=input('param.');
            $DataBaseUser = User::get($data['id']);
            if ($data['user']!=""){
                $DataBaseUser -> user = $data['user'] ;
            }
            if ($data['password']!=""){
                $DataBaseUser -> password = $data['password'] ;
            }
            if ($data['user']!=""){
                $DataBaseUser -> name = $data['name'] ;
            }
            if ($data['user']!=""){
                $DataBaseUser -> number = $data['number'] ;
            }
            $DataBaseUser-> role_id = $data['role_id'];
            $DataBaseUser-> dep_id = $data['dep_id'];
            $DataBaseUser-> state = 1;
            $DataBaseUser-> create_time = date('y-m-d h:i:s', time());
            //将数据进行修改
            if($DataBaseUser->replace()->save()){
                return json(['data'=> 1]);
            }
            else{
                return json(['data'=> 0]);
            }
        }
    }



    /**
     * 删除用户
     */
    public function DeleteUser()
    {
        if (input('get.')) {
            $data = input('param.');
            $ret = Db::table('user')->where('uid', $data['id'])->update(['state' => 0]);
            if ($ret) {
                return json(['data' => 1]);
            } else {
                return json(['data' => 0]);
            }
        }
    }

    /**
     * 用户列表
     */
    public function UserList(){
            $user = User::where('state','1')->paginate(7);
            $figure=Db::table('user')->where('state','1')->column('uid');
            $page=$user->render();
            $this->assign(
                [
                    'figure'=>$figure,
                    'user'=>$user,
                    'page'=>$page
                ]
            );
            return view('userList');
    }

}