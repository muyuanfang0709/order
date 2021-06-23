<?php


namespace app\ordering\controller;


use app\ordering\model\Order;
use app\ordering\model\Result;
use app\ordering\model\Role;
use app\ordering\model\User;
use app\ordering\model\Food;
use app\ordering\model\OrderInfo;
use think\Controller;
use think\Db;
use app\ordering\controller\Login;
use app\ordering\model\User as UserModel;
use app\ordering\model\Sta_user as StaUserModel;
class Management extends Base
{
    /**
     * 苏家龙
     *
     */
    //用户点餐
    public function userOrder()
    {
        if (!input('post.')) {
        $food=Food::select();
        $user=User::where('state','1')->select();
        $info=Order::where('1=1')->order('order_id desc')->find();
        $max =$info['order_id'];
        //echo '最高次为：'.$max;                      //当周为第 max


        $orderinfo=OrderInfo::where('order_id',$max)->order('day')->select();
        $time_z=$this->weekday($max);

        $inderinfofood='';
        foreach ($orderinfo as $key=>$o) {                  //提取当周数据   提取order_info的food数据
                $inderinfofood =$inderinfofood.'|'.$o['food'];
        }
        $foodday=explode("|", $inderinfofood);      //数据库菜单信息装化为数组储存判断

        foreach ($foodday as $key=>$d) {                      //id转化为名称name ，未关联只能循环找
            foreach ($food as $key1=>$f) {
                if($d==$f['food_id']){
                    $foodday[$key]=$f['name'];
                }

            }
        }

        $createtime=date('y-m-d',time());
        $new= strtotime($createtime);                 //当前时间
        $day=OrderInfo::where('order_id',$max)->order('day')->field('day')->select();
        foreach ($day as $key=>$d){
            $d['day']=strtotime($d['day']);
        }

            $add=array();
            foreach ($orderinfo as $key=>$o){                 //筛选符合当周的order_info_id
                array_push($add,$o['id']);
            }
            $resule=Result::where('order_info_id','in', $add)->select();     //筛选符合当周的点餐记录

            $ordering=0;
            foreach ($user as $u){                                      //是否已点餐
                if($u['user']==$_SESSION['user']) {
                    foreach ($resule as $r) {
                        if ($u['uid'] == $r['user_id']) {
                            $ordering=1;
                            break;
                        }
                    }
                }
            }

        return \view('management/userOrder',[
            'resule'=>$resule,
            'orderinfo'=>$orderinfo,
            'food'=>$food,
            'max'=>$max,
            'time'=>$time_z,
            'foodday'=>$foodday,
            'new'=>$new,
            'day'=>$day,
            'ordering'=>$ordering,
        ]);
    }
    else{
        //用户点餐完毕
        $data = input('post.');
        return dump($data);
        $user=User::select();
        $food=Food::select();
        $info=Order::where('1=1')->order('order_id desc')->find();
        $max =$info['order_id'];
        $orderinfo=OrderInfo::where('order_id',$max)->order('day')->select();

        $add=array();
        foreach ($orderinfo as $key=>$o){                 //筛选符合当周的order_info_id
            array_push($add,$o['id']);
        }
        $resule = Result::where('order_info_id','in', $add)->select();     //筛选符合当周的点餐记录

        if(isset($_SESSION['user'])) {

            foreach ($user as $u){
                if($u['user']==$_SESSION['user']) {
                    foreach ($resule as $r) {
                        if ($u['uid'] == $r['user_id']) {
                            echo "<script>alert('你已经选择过了，请勿再选！');location='userOrder';</script>";
                            return false;

                        }
                    }
                }
            }

            $judge=true;


            foreach($orderinfo as $key=>$o){
                //if(1==1){
                    if(!isset($data[$key])){
                        $judge=false;
                    }
                //}

            }
            if($judge){//判断是否未赋值
                $userid=1;
                foreach ($user as $key=>$u){
                    if($u['user']==$_SESSION['user']){
                        $userid=$u['uid'];
                    }
                }


                $state=1;
                $createtime=date('y-m-d h:i:s', time());
                $userfood =  array();
                $userfood['user_id']          =   $userid;//data['uid']
                $userfood['state']            =   $state;
                $userfood['create_time']      =   $createtime;

                $num=0;
                foreach ($data as $key=>$d) {
                    foreach ($food as $key1=>$f) {

                        if($d==$f['name']){
                            $userfood['order_info_id']    =   $add[$num];
                            $userfood['food_id']  =    $f['food_id'];

                            //$userfood->save();

                            Db::table('result')->insert($userfood,true);                    //save  二次输入报错   先用Db方式输入
                            //dump($userfood);
                            $num=$num+1;
                        }

                    }

                    //$userfood->save();
                }
                echo "<script>alert('点餐成功！');location='vieworder';</script>";
            }else{
                echo "<script>alert('请全部选择完毕！');history.go(-1);</script>";
            }
        }else{
            echo "<script>alert('请先登录！');location='login';</script>";
        }
    }
    }

    protected function weekday($max)                    //获取当周的有菜的时间 并将时间装换为星期
    {
        if(isset($max))
        {
            $orderinfo=OrderInfo::where('order_id',$max)->order('day')->select();
            $time_z=['0','0','0','0','0','0','0'];
            $weekday = array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
            $a=0;
            foreach($orderinfo as $key=>$o) {

                    $time_z[$a]=$weekday[date("w",strtotime($o['day']))];
                    $a=$a+1;

            }
            return $time_z;
        }
        else{
            return false;
        }
    }


    //查看点餐
    public function viewOrder()
    {
        //表数据调用
        $user=User::where('state',1)->select();                 //state=1   存在
        $food=Food::select();
        $info=Order::where('1=1')->order('order_id desc')->find();
        $max =$info['order_id'];
        //echo '最高次为：'.$max;                                          //order id最大值  当前周，表单

        $orderinfo=OrderInfo::where('order_id',$max)->order('day')->select();;

        $add=array();
        foreach ($orderinfo as $key=>$o){
            array_push($add,$o['id']);
        }

        $resule=Result::where('order_info_id','in', $add)->order('result_id')->paginate(10000);       //判断order_info_id在本周的    后面10000为分页，暂不调用

        $page = $resule->render();                       //分页用，暂时不调用
        if(isset($_GET['page'])){
            $p=$_GET['page'];
        }else{
            $p=1;
        }


        $time_z=$this->weekday($max);        //星期调用

        return \view('management/viewOrder',[
            'resule'=>$resule,
            'user'=>$user,
            'page'=>$page,
            'orderinfo'=>$orderinfo,
            'food'=>$food,
            'p'=>$p,
            'max'=>$max,
            'time'=>$time_z,

        ]);

    }





    //协助点餐
    public function editOrder()
    {
        if (!input('post.')) {
            $resule=Result::paginate(10000);
            $user=User::select();
            $food=Food::select();
            $info=Order::where('1=1')->order('order_id desc')->find();
            $max =$info['order_id'];
        //echo '最高次为：'.$max;                      //当周为第 max
            $orderinfo=OrderInfo::where('order_id',$max)->order('day')->select();          //当前周order_info  数据
            $time_z=$this->weekday($max);
            $inderinfofood='';                                   //提取当周数据   提取order_info的food数据
            foreach ($orderinfo as $key=>$o) {
            if($o['order_id']==$max) {
                    $inderinfofood =$inderinfofood.'|'.$o['food'];
                }
            }
        $foodday=explode("|", $inderinfofood);      //数据库菜单信息装化为数组储存判断
        foreach ($foodday as $key=>$d) {                      //id转化为名称name ，未关联只能循环找
            foreach ($food as $key1=>$f) {
                if($d==$f['food_id']){
                    $foodday[$key]=$f['name'];
                }
            }
        }

        return \view('management/editOrder',[
            'resule'=>$resule,
            'orderinfo'=>$orderinfo,
            'food'=>$food,
            'max'=>$max,
            'time'=>$time_z,
            'foodday'=>$foodday,
            'user'=>$user,
        ]);
        } else{               //提交协助点餐
            $data = input('post.');
            $food=Food::select();
            $user=User::where('state',1)->select();                 //state=1   存在
            $info=Order::where('1=1')->order('order_id desc')->find();
            $max =$info['order_id'];
            $orderinfo=OrderInfo::where('order_id',$max)->order('day')->select();          //当前周order_info  数据
            $add=array();
            foreach ($orderinfo as $key=>$o){                 //筛选符合当周的order_info_id
                array_push($add,$o['id']);
            }
            $resule=Result::where('order_info_id','in', $add)->select();     //筛选符合当周的点餐记录
            $userid=-1;
            foreach ($user as $u){
                if($u['user']==$data['user']) {
                    $userid=$u['uid'];
                    break;
                }
            }
            foreach ($resule as $a){                                         //删除原先该用户本周点餐数据
                $a->where('user_id',$userid)->delete();
            }
            $state=1;                                                            //按照输入信息重新添加数据
            $createtime=date('y-m-d h:i:s', time());
            $userfood =  array();
            $userfood['user_id']          =   $userid;
            $userfood['state']            =   $state;
            $userfood['create_time']      =   $createtime;
            $num=0;
            foreach ($data as $key=>$d) {
                foreach ($food as $key1 => $f) {
                    if ($d == $f['name']) {
                        //dump($d);
                        $userfood['order_info_id'] = $add[$num];
                        $userfood['food_id'] = $f['food_id'];
                        //echo $userfood['food_id'];
                        Db::table('result')->insert($userfood);
                        $num = $num + 1;
                    }
                }

            }
            echo "<script>alert('点餐成功！');location='vieworder';</script>";
        }
    }

        /*
         * 协助多人点餐
         */

    public function assistOrder(){

        if(!input('post.')) {
            if (!session_id()) session_start();
            //表数据调用
            $user=User::where('state',1)->select();                 //state=1   存在
            $food=Food::select();
            $info=Order::where('1=1')->order('order_id desc')->find();
            $max =$info['order_id'];
            //echo '最高次为：'.$max;                                          //order id最大值  当前周，表单

            $orderinfo=OrderInfo::where('order_id',$max)->order('day')->select();;

            $add=array();
            foreach ($orderinfo as $key=>$o){
                array_push($add,$o['id']);
            }

            $resule=Result::where('order_info_id','in', $add)->order('result_id')->paginate(10000);       //判断order_info_id在本周的    后面10000为分页，暂不调用
            $time_z=$this->weekday($max);
            $inderinfofood='';                                   //提取当周数据   提取order_info的food数据
            foreach ($orderinfo as $key=>$o) {
                if($o['order_id']==$max) {
                    $inderinfofood =$inderinfofood.'|'.$o['food'];
                }
            }
            $foodday=explode("|", $inderinfofood);      //数据库菜单信息装化为数组储存判断
            foreach ($foodday as $key=>$d) {                      //id转化为名称name ，未关联只能循环找
                foreach ($food as $key1=>$f) {
                    if($d==$f['food_id']){
                        $foodday[$key]=$f['name'];
                    }
                }
            }

            $resule=Result::where('order_info_id','in', $add)->select();     //筛选符合当周的点餐记录

            $add=array();
            foreach ($user as $u){                                      //是否已点餐

                    foreach ($resule as $r) {

                        if ($u['uid'] == $r['user_id']) {

                            array_push($add,$u['uid']);
                            break;
                        }
                    }

            }
            $noordering=User::where('state',1)->where('uid','not in',$add)->select();

            return view('assistOrder',[
                'max'=>$max,
                'time'=>$time_z,
                'resule'=>$resule,
                'orderinfo'=>$orderinfo,
                'food'=>$food,
                'foodday'=>$foodday,
                'user'=>$user,
                'noordering'=>$noordering,
            ]);
        }
        else{
                //用户点餐完毕
                $data = input('post.');
//                return json($data);
                $user=User::select();
                $food=Food::select();
                $info=Order::where('1=1')->order('order_id desc')->find();
                $max =$info['order_id'];
                $orderinfo=OrderInfo::where('order_id',$max)->order('day')->select();

                $add=array();
                foreach ($orderinfo as $key=>$o){                 //筛选符合当周的order_info_id
                    array_push($add,$o['id']);
                }
                $resule=Result::where('order_info_id','in', $add)->select();     //筛选符合当周的点餐记录




                    $judge=true;


                    foreach($orderinfo as $key=>$o){
                        //if(1==1){
                        if(!isset($data[$key])){
                            $judge=false;
                        }
                        //}

                    }
//


                        $state=1;
                        $createtime=date('y-m-d h:i:s', time());
                        $userfood =  array();
                        $userfood['user_id']          =   $data['uid'];
                        $userfood['state']            =   $state;
                        $userfood['create_time']      =   $createtime;

                        $num=0;
                        foreach ($data as $key=>$d) {
                            foreach ($food as $key1=>$f) {

                                if($d==$f['name']){
                                    $userfood['order_info_id']    =   $add[$num];
                                    $userfood['food_id']  =    $f['food_id'];

                                    //$userfood->save();

                                    Db::table('result')->insert($userfood,true);                    //save  二次输入报错   先用Db方式输入
                                    //dump($userfood);
                                    $num=$num+1;
                                }

                            }

                            //$userfood->save();
                        }
                        echo "<script>location='assistOrder';</script>";
//                    }else{
//                        echo "<script>alert('请全部选择完毕！');history.go(-1);</script>";
//                    }



        }


    }
}



