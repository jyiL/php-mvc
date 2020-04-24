<?php
declare(strict_types=1);
/**
 * Author: user
 * Date: 2020/4/24
 * Time: 17:38
 * Email: avril.leo@yahoo.com
 */

namespace TaiFeng\Controllers;

use TaiFeng\Libs\Controller;

class ErrorController extends Controller
{
    public function not_found()
    {
        $this->template->_header = false;
        $this->template->_footer = false;
        $this->template->render('404');
    }
}