<?php
declare(strict_types=1);

namespace TaiFeng\Libs;

/**
 * Author: user
 * Date: 2020/4/22
 * Time: 17:02
 * Email: avril.leo@yahoo.com
 */

Class Autoloader
{
    const NAMESPACE_PREFIX = 'TaiFeng\\';
    const CONTROLLER_NAME = 'Index';
    const ACTION_NAME = 'Index';

    public function run()
    {
        spl_autoload_register(array(new self, 'autoload'));

        $this->setReporting();
        $this->filter();
        $this->route();
    }


    public function setReporting()
    {
        if (APP_DEBUG === true) {
            error_reporting(E_ALL);
            ini_set('display_errors','On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors','Off');
            ini_set('log_errors', 'On');
            ini_set('error_log', RUNTIME_PATH. 'logs/error.log');
        }
    }

    /**
     * 过滤非法字符
     */
    public function filter()
    {
        $_GET = empty($_GET) ?: $this->stripSlashesDeep($_GET);
        $_POST = empty($_POST) ?: $this->stripSlashesDeep($_POST);
    }

    /**
     * @param $value
     *
     * @return
     */
    public function stripSlashesDeep($value)
    {
        $value = is_array($value) ? array_map('static::stripSlashesDeep', $value) : addslashes($value);
        return $value;
    }

    /**
     * 路由
     */
    public function route()
    {
        $requestUrl = trim($_SERVER['REQUEST_URI'], '/');

        if (!empty($requestUrl)) {
            $requestUrl = str_replace(strstr($requestUrl, '?'), '', $requestUrl);
            $requestUrl = explode('/', $requestUrl);

            if (count($requestUrl) < 2) header('location:/error/not_found');
        }

        $actionName = empty($requestUrl) ? self::ACTION_NAME : array_pop($requestUrl);

        $controllerName = '';
        if (empty($requestUrl)) {
            $controllerName = self::CONTROLLER_NAME;
        } else {
            foreach ($requestUrl as $item) {
                $controllerName .= ucfirst($item) . '\\';
            }

            $controllerName = trim($controllerName, '\\');
        }

        $queryString = $_SERVER['QUERY_STRING'] ? explode('&', $_SERVER['QUERY_STRING']) : [];

        // 实例化
        $controller = self::NAMESPACE_PREFIX . "Controllers\\{$controllerName}Controller";

        $obj = new $controller($controllerName, $actionName);

        if (method_exists($controller, $actionName)) {
            call_user_func_array([$obj, $actionName], $queryString);
        } else {
//            throw printf((new TFException())::ACTION_IS_ERROR);
            header('location:/error/not_found');
        }
    }

    /**
     * 根据类名载入所在文件
     *
     * @param string $className
     */
    public static function autoload(string $className)
    {
        $namespacePrefixStrlen = strlen(self::NAMESPACE_PREFIX);

        if ( strncmp(self::NAMESPACE_PREFIX, $className, $namespacePrefixStrlen) === 0 ){
//            $className = strtolower($className);
            $filePath = str_replace('\\', DIRECTORY_SEPARATOR, substr($className, $namespacePrefixStrlen));

            $ucFirst = trim(substr($filePath, strrpos($filePath, '/')), '/');

            $filePath = str_replace($ucFirst, ucfirst($ucFirst), $filePath);

            $filePath = strstr($filePath, 'Libs') ? APP_PATH . $filePath . '.tf.php'
                : APP_PATH . 'applications' . DIRECTORY_SEPARATOR . $filePath . '.php';

            if (file_exists($filePath)) {
                require_once $filePath;
            } else {
//                throw printf((new TFException())::PATH_INFO_IS_ERROR);
                header('location:/error/not_found');
            }
        }
    }
}