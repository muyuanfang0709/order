<?php


namespace app\ordering\controller;


use app\ordering\model\Food;
use app\ordering\model\OrderInfo;
use app\ordering\model\User;
use app\ordering\model\Order;
use think\App;
use think\Controller;
use think\Db;

class Dishes extends Base
{

    //下个星期菜表
    public function dishesNextWeek()
    {
//        $data = input('post.food_name');
//        if ($data){
//            return json(['data'=>1]);
//        }
        if (!input('post.')) {
            $info = Order::where('1=1')->order('order_id desc')->find();
            $max = $info['order_id'];

            $orderinfo=OrderInfo::where('order_id',$max)->order('day')->select();

            $food = Food::select();
            $inderinfofood='';
            foreach ($orderinfo as $key=>$o) {                  //提取当周数据   提取order_info的food数据
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

            return view('dishesNextWeek', [
                'orderinfo'=>$orderinfo,
                'food' => $food,
                'foodday'=>$foodday,
                'max'=>$max,
            ]);
        }
        else {

            $data = input('post.');
            $user = User::where('state', 1)->select();                 //state=1   存在

            $info = Order::where('1=1')->order('order_id desc')->find();
            $max = $info['order_id'];


            //$a=implode('|', $data);
            $food = Food::select();

            //判断是否为新菜，是则添加
            $new=['0','0','0'];

            foreach($food as $f){
                if($data['food_name1']==$f['name']){
                    $new[0]=1;
                }
                if($data['food_name2']==$f['name']){
                    $new[1]=1;
                }
                if($data['food_name3']==$f['name']){
                    $new[2]=1;
                }
            }

            if($new[0]==0){
                $newfood1=[
                    'name'=>$data['food_name1']
                ];
                $food = new Food();
                $food->save($newfood1);
            }
            if($new[1]==0){
                $newfood2=[
                    'name'=>$data['food_name2']
                ];
                $food = new Food();
                $food->save($newfood2);
            }
            if($new[2]==0){
                $newfood3=[
                    'name'=>$data['food_name3']
                ];
                $food = new Food();
                $food->save($newfood3);
            }


            $food = Food::select();
            //food_name转化为id后组合为str储存
            foreach($food as $f){
                if($data['food_name1']==$f['name']){
                    $data['food_name1']=$f['food_id'];
                }
                if($data['food_name2']==$f['name']){
                    $data['food_name2']=$f['food_id'];
                }
                if($data['food_name3']==$f['name']){
                    $data['food_name3']=$f['food_id'];
                }
            }

            $c = [$data['food_name1'],$data['food_name2'],$data['food_name3']];
            $a = implode('|', $c);

            $orderinfo['state'] = 1;
            $orderinfo['day'] = $data['time'];
            $orderinfo['order_id'] = $max;
            $orderinfo['week'] = $max;
            $orderinfo['food'] = $a;


            foreach ($user as $u) {
                if ($u['user'] == $_SESSION['user']) {
                    $orderinfo['create_user'] = $u['uid'];
                    break;
                }
            }
            $orderinfo1 = new OrderInfo();
            $orderinfo1->save($orderinfo);

        }


        $this->redirect('dishesNextWeek');
    }

    /*
      * 删除菜品
      */
    public  function deletefood(){
        $id = input('get.food_id');
        $ret = Food::where('food_id',$id)->delete();
        if ($ret) {
            return json(['data'=>1]);
        } else {
            return json(['data'=>0]);
        }
    }
    /**
     * 删除菜单信息
     */
    public  function deleteorderinfo($time){
        $ret = OrderInfo::where('day',$time)->delete();
        if ($ret) {
            return json(['data'=>1]);
        } else {
            // return json($day);
            return json(['data'=>0]);
        }
        //$this->redirect('dishesNextWeek');
    }

    /*
     * 添加新菜判断
     */
    public  function addNewDishes(){
        if(input('post.addfoods')){
            $food = input('post.addfoods');
            $ret = Food::select();
            $a=1;
            foreach ($ret as  $key){
                if($key['name'] == $food){
                    $a=0;
                }
            }
            if ($a==1) {
                Food::insert([
                    'name' => $food,
                    'create_time' => date('Y-m-d H:i:s')
                ]);
                return json(['data' => 1]);
            } else {
                return json(['data' => 0]);
            }
        }
        return $this->fetch('Dishes/addNewDishes');
    }

    /*
     * 菜品列表
     */
    public function menuList()
    {
        if(isset($_GET['page'])){
            $p=$_GET['page'];}
        else{
            $p=1;
        }
        $data= Food::order('food_id')->paginate(7);
        $page = $data->render();
        $this->assign('data',$data);
        $this->assign('page',$page);
        $this->assign('p',$p);
        return $this->fetch('menuList');
    }

    /*
     * 添加新的订单号*/

    public function addOrder(){
        $createtime = date('y-m-d h:i:s', time());
        $order = [
            'create_time' => $createtime,
            'state' => 1,
        ];
        $or = new Order();
        $or->save($order);
        return json(['data' => 1]);
    }


}