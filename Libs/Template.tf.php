<?php
declare(strict_types=1);
/**
 * Author: user
 * Date: 2020/4/23
 * Time: 15:26
 * Email: avril.leo@yahoo.com
 */

namespace TaiFeng\Libs;

class Template
{
    protected $variables = array();
    protected $_controller;
    protected $_action;

    /**
     * 是否插入页头
     */
    private $_header = true;

    /**
     * 是否插入页尾
     */
    private $_footer = true;

    /**
     * @param string $controller
     * @param string $action
     */
    public function __construct(string $controller, string $action)
    {
        $this->_controller = str_replace('\\', '/', $controller);
        $this->_action = $action;
    }
    /**
     * 分配变量
     *
     * @param string $name
     * @param string $value
     */
    public function assign($name, $value)
    {
        $this->variables[$name] = $value;
    }

    /**
     * 渲染显示
     *
     * @param string $path
     */
    public function render(string $path)
    {
        extract($this->variables);
        $defaultHeader = APP_PATH . 'applications' . DIRECTORY_SEPARATOR . 'Template'
            . DIRECTORY_SEPARATOR . 'header.php';
        $defaultFooter = APP_PATH . 'applications' . DIRECTORY_SEPARATOR . 'Template'
            . DIRECTORY_SEPARATOR . 'footer.php';
        $controllerHeader = APP_PATH . 'applications' . DIRECTORY_SEPARATOR . 'Template'
            . DIRECTORY_SEPARATOR . $this->_controller . DIRECTORY_SEPARATOR . 'header.php';
        $controllerFooter = APP_PATH . 'applications' . DIRECTORY_SEPARATOR . 'Template'
            . DIRECTORY_SEPARATOR . $this->_controller . DIRECTORY_SEPARATOR . 'footer.php';

        // 页头文件
        if ($this->_header) {
            if (file_exists($controllerHeader)) {
                include_once ($controllerHeader);
            } else {
                include_once ($defaultHeader);
            }
        }
        // 页内容文件
        include_once (APP_PATH . 'applications' . DIRECTORY_SEPARATOR . 'Template' . DIRECTORY_SEPARATOR . $path . '.php');

        // 页脚文件
        if ($this->_footer) {
            if (file_exists($controllerFooter)) {
                include_once ($controllerFooter);
            } else {
                include_once ($defaultFooter);
            }
        }
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}