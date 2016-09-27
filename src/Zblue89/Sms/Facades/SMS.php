<?php
/**
 * Created by IntelliJ IDEA.
 * User: zblue89-PC
 * Date: 11/9/2016
 * Time: 11:01 AM
 */

namespace Zblue89\Sms\Facades;


use Illuminate\Support\Facades\Facade;

class SMS extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'sms';
    }
}