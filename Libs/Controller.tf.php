<?php
declare(strict_types=1);

/**
 * Author: user
 * Date: 2020/4/23
 * Time: 14:15
 * Email: avril.leo@yahoo.com
 */

namespace TaiFeng\Libs;

class Controller
{
    protected $controller;
    protected $action;
    protected $template;

    /**
     * @param string $controller
     * @param string $action
     */
    public function __construct(string $controller, string $action)
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->template = new Template($controller, $action);
    }

    /**
     * @param string $name
     * @param $value
     */
    public function assign(string $name, $value)
    {
        $this->template->assign($name,$value);
    }

    /**
     * 检验密码是否为字母和数字
     *
     * @param string $password
     *
     * @return bool
     */
    protected function isPassword($password) : bool
    {
        $pattern="/^[0-9a-zA-Z]{6,16}$/i";
        if(preg_match($pattern, $password)){
            return true;
        } else {
            return false;
        }
    }
}