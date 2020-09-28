<?php


namespace totum\common\controllers;

use Psr\Http\Message\ServerRequestInterface;
use totum\common\Auth;

trait WithAuthTrait
{
    protected function __run($action, ServerRequestInterface $request)
    {
        $this->User = Auth::webInterfaceSessionStart($this->Config);

        if (!$this->User) {
            $this->__UnauthorizedAnswer();
        } else {
            $this->__actionRun($action, $request);
        }
    }

    protected function __UnauthorizedAnswer()
    {
        /*TODO check header sends*/
        header('HTTP/1.0 401 Unauthorized');
        header('location: /Auth/Login');
        die;
    }
}