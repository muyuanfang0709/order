<?php
//// +----------------------------------------------------------------------
//// | ThinkPHP [ WE CAN DO IT JUST THINK ]
//// +----------------------------------------------------------------------
//// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
//// +----------------------------------------------------------------------
//// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
//// +----------------------------------------------------------------------
//// | Author: liu21st <liu21st@gmail.com>
//// +----------------------------------------------------------------------
//
//use think\facade\Route;
////Route::group('admin',function (){
////    Route::rule('login','admin/user/login','get|post');
////});
//
Route::rule('/','/order/Iframe/');                 //点餐主页
//
//Route::rule('login','ordering/Login/login');          //登录ordering/
//Route::rule('loginjudgment','ordering/Login/loginjudgment');          //登录ordering/
//Route::rule('logout','ordering/Login/logout');          //登录ordering/
//
//
//Route::rule('Add/addRoleOk','ordering/Add/addRoleOk');          //提交登陆
//Route::rule('Add/roleModifyOk','ordering/Add/roleModifyOk');    //修改详情
//Route::rule('Add/deleteRole','ordering/Add/deleteRole');    //删除角色
//Route::rule('Add/addRole','ordering/Add/addRole');       //添加角色
//Route::rule('Add/editRole','ordering/Add/editRole');      //编辑角色
//Route::rule('Add/roleModify','ordering/Add/roleModify');      //修改详细页
//
//Route::rule('Dishes/deletefood','ordering/Dishes/deletefood');      //菜品列表
//Route::rule('Dishes/menuList','ordering/Dishes/menuList');      //删除菜品
//Route::rule('Dishes/dishesNextWeek','ordering/Dishes/dishesNextWeek');      //下星期选菜
//Route::rule('Dishes/dishesNextWeekOk','ordering/Dishes/dishesNextWeekOk');      //提交下星期选菜
//Route::rule('Dishes/addNewDishes','ordering/Dishes/addNewDishes');      //添加新菜
//Route::rule('Dishes/addNewDishesOk','ordering/Dishes/addNewDishesOk');      //提交添加新菜
//
//Route::rule('Maintain/userAlerts','ordering/Maintain/userAlerts');      //用户提醒
//Route::rule('Maintain/departStatistics','ordering/Maintain/departStatistics');      //部门统计
//Route::rule('Maintain/weeklyStatistics','ordering/Maintain/weeklyStatistics');      //每周点餐统计
//Route::rule('Maintain/personnelHistory','ordering/Maintain/personnelHistory');      //人员历史点餐总统计
//
//Route::rule('management/userOrder','ordering/Management/userOrder');      //用户点餐
//Route::rule('management/userOrderOk','ordering/Management/userOrderOk');      //用户点餐
//Route::rule('management/viewOrder','ordering/Management/viewOrder');      //查看点餐
//Route::rule('management/editOrder','ordering/Management/editOrder');      //编辑点餐
//Route::rule('management/editOrderOk','ordering/Management/editOrderOk');      //提交编辑点餐
//
//Route::rule('Information/pwdModify','ordering/Information/pwdModify');      //密码修改
//Route::rule('Information/pwdModifyOk','ordering/Information/pwdModifyOk');      //提交密码修改