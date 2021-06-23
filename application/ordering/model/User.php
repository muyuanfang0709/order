<?php


namespace app\ordering\model;


use think\Model;

class User extends Model
{
    protected $pk = 'uid';
    protected $auto =['password','state'];
    protected function setPasswordAttr($value)
    {
        return md5($value);
    }

    protected function setStateAttr()
    {
        return "1";
    }

    public function getRoleidAttr($value)
    {
        switch ($value) {
            case '1':
                return '系统管理员';
                break;
            case '2':
                return '点餐管理员';
                break;
            case '3':
                return '点餐维护员';
                break;
            case '4':
                return '普通用户';
                break;
            default:
                return '保密';
                break;
        }
    }
    public function getDepidAttr($value)
    {
        switch ($value) {
            case '1':
                return '工程部';
                break;
            case '2':
                return '营运部';
                break;
            case '3':
                return '生产部';
                break;
            case '4':
                return '行政部';
                break;
            case '5':
                return '财务部';
                break;
            default:
                return '保密';
                break;
        }
    }

}