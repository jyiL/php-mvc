<?php
declare(strict_types=1);
/**
 * Author: user
 * Date: 2020/4/24
 * Time: 10:28
 * Email: avril.leo@yahoo.com
 */

namespace TaiFeng\Controllers\Admin;

use TaiFeng\Libs\Controller;
use TaiFeng\Models\CategoryModel;

class CategoryController extends Controller
{
    /**
     * 分类列表
     */
    public function list()
    {
        $page = $_GET['page'] ?? 1;

        $categoryModel = new CategoryModel();

        $list = $categoryModel->category();

        $this->assign('list', $list);
        $this->assign('page', $page);
        $this->template->render('Category/list');
    }

    /**
     * 新建分类
     */
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST')
            throw printf('非法访问');

        // 检查字段
        $params = checkRequestParams($_POST, ['name', 'parent_id']);

        if (!$params) throw printf('参数有误');

        $categoryModel = new CategoryModel();

        $params['created_at'] = date('Y-m-d H:i:s', time());

        $params['updated_at'] = date('Y-m-d H:i:s', time());

        $res = $categoryModel->insert($params);

        if (!$res) {
            throw printf('新建失败');
        }

        header('location:/Admin/Category/list');
    }

    /**
     * 修改分类
     */
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST')
            throw printf('非法访问');

        // 检查字段
        $params = checkRequestParams($_POST, ['name', 'id']);

        if (!$params) throw printf('参数有误');

        $categoryModel = new CategoryModel();

        $params['updated_at'] = date('Y-m-d H:i:s', time());

        $id = $params['id'];
        unset($params['id']);

        $res = $categoryModel->update($id, $params);

        if (!$res) {
            throw printf('更新失败');
        }

        header('location:/Admin/Category/list');
    }

    /**
     * 删除分类
     */
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw printf('非法访问');

        // 检查字段
        $params = checkRequestParams($_POST, ['id']);

        if (!$params) throw printf('参数有误');

        $categoryModel = new CategoryModel();

        if (!$categoryModel->select(['id'], $params))
            throw printf('分了不存在');

        if ($categoryModel->select(['id'], ['parent_id' => $params['id']])) {
            throw printf('当前分类存在子分类不允许删除');
        }

        $res = $categoryModel->delete((int)$params['id']);

        if (!$res) {
            throw printf('删除失败');
        }

        header('location:/Admin/Category/list');
    }
}