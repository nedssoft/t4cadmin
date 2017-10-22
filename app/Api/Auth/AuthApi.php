<?php

namespace Factory\Api;

use Factory\Api\Api;
use App\Api\Auth\AuthProvider;


/*
|-------------------------------------------
| The AuthApi
|-------------------------------------------
| This registers the AuthProvider into the IOC
| Remember is always extends the API class from Factory\Api\Api
|
*/
class AuthApi extends Api{
    public function setUp()
    {
        $authFactory=new AuthProvider();

        $this->app->singleton($this->name(), function () use ($authFactory) {
            return $authFactory;
        });
    }

    /**
     * Returns the name of the component
     *
     * @return string
     */
    public function name()
    {
        return 'authapi';
    }
}
