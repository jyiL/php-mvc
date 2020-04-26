<?php
declare(strict_types=1);
/**
 * Author: user
 * Date: 2020/4/23
 * Time: 15:42
 * Email: avril.leo@yahoo.com
 */

namespace TaiFeng\Controllers\Admin;

use TaiFeng\Libs\Controller;
use TaiFeng\Models\UsersModel;

class UserController extends Controller
{
    /**
     * 登录
     */
    public function login()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET' :
                $this->template->_header = false;
                $this->template->_footer = false;
                $this->template->render('Admin/login');
                break;
            case "POST";
                $params = checkRequestParams($_POST, ['name', 'password']);

                if (!$params) throw printf('参数有误');

                if (!isName($params['name'])) {
                    throw printf('用户名必须为8-12为字母或数字');
                }

                if (!isPassword($params['password'])) {
                    throw printf('密码必须为6位数字');
                }

                $usersModel = new UsersModel();

                $params['password'] = md5Encrypt($params['password']);

                $userInfo = $usersModel->select(['id', 'name'], $params);

                if (!$userInfo) {
                    throw printf('账号或密码错误');
                }

                $_SESSION['user_info'] = $userInfo;

                $_headerUrl = APP_URL ? APP_URL . '/Admin/category/list' : '/Admin/category/list';
                header("location:{$_headerUrl}");
                break;
            default:
                break;
        }
    }

    /**
     * 注册
     */
    public function register()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET' :
                $this->template->_header = false;
                $this->template->_footer = false;
                $this->template->render('Admin/register');
                break;
            case "POST";
                $params = checkRequestParams($_POST, ['name', 'password']);

                if (!$params) throw printf('参数有误');

                if (!isName($params['name'])) {
                    throw printf('用户名必须为8-12为字母或数字');
                }

                if (!isPassword($params['password'])) {
                    throw printf('密码必须为6位数字');
                }

                $usersModel = new UsersModel();

                $params['password'] = md5Encrypt($params['password']);
                $id = $usersModel->select(['id'], ['name' => $params['name']]);

                if ($id) {
                    throw printf('账号已存在');
                }

                $params['created_at'] = date('Y-m-d H:i:s', time());
                $params['updated_at'] = date('Y-m-d H:i:s', time());
                $res = $usersModel->insert($params);

                if (!$res) {
                    throw printf('注册失败');
                }

                $userInfo = $usersModel->select(['id', 'name'], $params);

                $_SESSION['user_info'] = $userInfo;

                $_headerUrl = APP_URL ? APP_URL . '/Admin/category/list' : '/Admin/category/list';
                header("location:{$_headerUrl}");
                break;
            default:
                break;
        }
    }

    /**
     * 用户列表
     */
    public function list()
    {
        $page = $_GET['page'] ?? 1;

        // 查询数据
        $usersModel = new UsersModel();

        $list = $usersModel->selectAll('id, name, created_at', '', '');

        $this->assign('list', $list);
        $this->assign('page', $page);
        $this->template->render('Admin/list');
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        // unset token....

        unset($_SESSION['user_info']);

        $_headerUrl = APP_URL ? APP_URL . '/Admin/User/login' : '/Admin/User/login';
        header("location:{$_headerUrl}");
    }
}