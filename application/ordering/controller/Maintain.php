<?php


namespace app\ordering\controller;


use app\ordering\model\Department;
use app\ordering\model\Food;
use app\ordering\model\OrderInfo;
use app\ordering\model\User;
use app\ordering\model\Result;
use think\Controller;
use think\Db;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;

/**
 * @author 吴家晗
 * 点餐维护
 */
class Maintain extends Controller
{

    /**
     * 用户历史点餐纪录
     */
    public function PersonnelHistory(){
        //设置需要放入数据的各个数组
        //user放入各个用户名
        //foodtime放入每人点餐时间
        //week放入星期
        //food放个每人每天点的食物
        //dep放入每人部门
        $name=array();
        $user=array();
        $foodtime=array();
        $time_w=array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
        $week=array();
        $food=array();
        $dep=array();
        $result=Db::table('result')->select();
        //查询result表，将相关值放入各个相应的数组
        foreach ($result as $re){
            array_push($user,User::where('uid',$re['user_id'])->value('user'));
            $enduser=User::where('uid',$re['user_id'])->value('dep_id');
            array_push($dep,Department::where('dep_id',$enduser)->value('name'));

            $ab=OrderInfo::where('id',$re['order_info_id'])->value('day');
            if($ab) {
                array_push($foodtime, $ab);
                array_push($week,$time_w[date("w",strtotime(end($foodtime)))]);
            }
            else{
                array_push($foodtime, '订单取消');
                array_push($week, '无');
            }
            array_push($food,Food::where('food_id',$re['food_id'])->value('name'));
        }
        $result=db('result')->paginate(7);
        $this->assign(
            [
                'user'=>$user,
                'foodtime'=>$foodtime,
                'food'=>$food,
                'week'=>$week,
                'dep'=>$dep
            ]
        );
        return  view('personnelHistor');
    }



    /**
     * 部门点餐份数记录
     */
    public function DepartStatistics(){
        //设置需要放入数据的各个数组
        //sunday放入每天各个菜品的数量
        //dishes放入每天菜单的种类
        //week放入星期
        //date放入每天的时间
        $max=OrderInfo::max('week');
        $sunday=array();
        $dishes=array();
        $time_w=array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
        $date=array();
        $week=array();
        $DataFood=OrderInfo::where('week',$max)->order('day')->select();
        //从一周各个天开始循环遍历
        foreach ($DataFood as $df){
            $food=$df['food'];
            $food=str_replace('|',' ',$food);
            $food=explode(" ",$food);
            //将菜品种类压入数组
            foreach ($food as $fd){
                array_push($dishes,Food::where('food_id',$fd)->value('name'));
            }
            array_push($date,$df['day']);
            array_push($week,$time_w[date("w",strtotime($df['day']))]);
            $food1 =0;
            $food2 =0;
            $food3 =0;
            $DataUser=Result::where('order_info_id',$df['id'])->select();
            //判断每天每个人点菜的种类,并计算数量
            foreach($DataUser as $du){
                if($du['food_id']==$food[0])
                    $food1++;
                if($du['food_id']==$food[1])
                    $food2++;
                if($du['food_id']==$food[2])
                    $food3++;
            }
            //将数量压入sunday数组
            array_push($sunday,$food1);
            array_push($sunday,$food2);
            array_push($sunday,$food3);

        }

        $this->assign(
            [
                'dishes'=>$dishes,
                'sunday'=>$sunday,
                'data'=>$date,
                'week'=>$week
            ]
        );
        return view('departStatistics');
    }



    /**
     * 未点餐用户提醒
     */
    public function UserAlerts(){
        //设置需要放入数据的各个数组
        //basename放入各个没点餐的用户名
        //depart放入用户所属的部门
        //number放入用户的电话
        $basename=array();
        $department=array();
        $number=array();
        //找到当前星期
        $max=OrderInfo::max('week');
        $user = User::where('state','1')->order('role_id')->select();
        //在user表中查找未点餐的用户，并把相关参数放入相关的数组
        foreach ($user as $us){
            $sign=DB::table('result')->order('order_info_id desc')->where('user_id',$us['uid'])->value('order_info_id');
            if($sign==""){
                array_push($basename,$us['name']);
                array_push($department,$us['dep_id']);
                array_push($number,$us['number']);
            }

            $b=Db::table('order_info')->where('id',$sign)->value('day');
            if(!(Db::table('order_info')->where('week',$max)->where('day',$b)->find())){
                array_push($basename,$us['name']);
                array_push($department,$us['dep_id']);
                array_push($number,$us['number']);
            }
        }
        $this->assign(
            [
                'basename'=>$basename,
                'department'=>$department,
                'number'=>$number
            ]
        );
        return view('userAlerts');
    }
}