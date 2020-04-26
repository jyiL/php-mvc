<?php
declare(strict_types=1);

namespace TaiFeng\Libs;

/**
 * Author: user
 * Date: 2020/4/22
 * Time: 16:55
 * Email: avril.leo@yahoo.com
 */

session_start();

define('FRAME_PATH', __DIR__ . DIRECTORY_SEPARATOR);

require_once APP_PATH . 'config' . DIRECTORY_SEPARATOR . 'config.php';

defined('RUNTIME_PATH') or
define('RUNTIME_PATH', APP_PATH . 'runtime' . DIRECTORY_SEPARATOR);

defined('TEMPLATE_PATH') or
define('TEMPLATE_PATH', APP_PATH .
    'applications' . DIRECTORY_SEPARATOR .
    'Template' . DIRECTORY_SEPARATOR
);

defined('APP_DEBUG') or define('APP_DEBUG', false);

require_once FRAME_PATH . 'autoloader.php';
require_once FRAME_PATH . 'tfException.php';
require_once APP_PATH . 'applications' .
    DIRECTORY_SEPARATOR . 'Helpers' .
    DIRECTORY_SEPARATOR . 'functions.php';

(new Autoloader())->run();

