<?php
declare(strict_types=1);

/**
 * Author: user
 * Date: 2020/4/23
 * Time: 11:26
 * Email: avril.leo@yahoo.com
 */

namespace TaiFeng\Controllers;

use TaiFeng\Libs\Controller;

class IndexController extends Controller
{
    public function index()
    {
        echo '<h1>Hello World!</h1>';
    }
}