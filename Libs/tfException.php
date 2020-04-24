<?php
declare(strict_types=1);

namespace TaiFeng\Libs;

/**
 * Author: user
 * Date: 2020/4/22
 * Time: 17:44
 * Email: avril.leo@yahoo.com
 */

class TFException extends \Exception
{
    const PATH_INFO_IS_ERROR = 'path is not found';
    const FRAMEWORK_ERROR = 'framework error';
    const ACTION_IS_ERROR = 'action is not found';

    public function errorMsg() : string
    {
        $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
        .': <b>'.$this->getMessage().'</b> is not a valid E-Mail address';

        return $errorMsg;
    }
}