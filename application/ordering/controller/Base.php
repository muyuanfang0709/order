<?php


namespace app\ordering\controller;


use app\ordering\model\Access;
use app\ordering\model\Food;
use app\ordering\model\Page;
use app\ordering\model\Role;
use app\ordering\model\User;
use think\App;
use think\Controller;
use think\facade\Db;

/*
 * 苏家龙
*/

class Base extends Controller
{
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        //登陆状态判断
        $this->CheakLogin();


        //权限判断
        // $_SESSION["role"] = 1;
        if($this->request->action()!='Iframe') {
            $access = Access::where('role',$_SESSION["role"])->select();
            $judge = false;
            foreach ($access as $key => $a) {
                //echo $key;
                $pagechoice = Page::where('id', $a['page'])->find();
                if(isset($pagechoice['action'])){
//                    if(substr(strtolower($this->request->action()),-2)=="ok"){
//                        $judge = true;
//                        break;
//                    }
                    if (strtolower($this->request->controller()) == strtolower($pagechoice['controller'])
                        && strtolower($this->request->action()) == strtolower($pagechoice['action'])) {
                        $judge = true;
                        break;
                    }
                }
            }
            if (!$judge) {
//                echo substr(strtolower($this->request->action()),-2);
//                echo '很抱歉您没有权限操作该模块(-测试用-)  页面方法为：'.$this->request->controller().'/'.$this->request->action(). '权限等级:';
//                echo $_SESSION['role'];
//                echo '权限列表';
//                foreach ($access as $key => $a) {
//                    $pagechoice = Page::where('id', $a['page'])->find();
//                    dump($pagechoice);
//
//                }
                 echo "<script>alert('很抱歉，您没有权限操作该模块！');history.go(-1);</script>";   //跳转
            }
        }

    }
    //登陆状态判断     CheakLogin()
    protected function CheakLogin(){

        if (!session_id()) session_start();

        if (!isset($_SESSION['user'])) {
            //重定向
            $_SESSION["role"]=0;
            $this->redirect('login/login');
        }

    }
    public function index()
    {
        return 0;
    }

}