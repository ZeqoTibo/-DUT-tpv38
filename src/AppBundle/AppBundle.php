<?php

namespace AppBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Doctrine\DBAL\Driver\PDOSqlite\Driver as SqliteDriver;
use Doctrine\DBAL\Event\Listeners\MysqlSessionInit;

class AppBundle extends Bundle
{
    public function boot()
    {
        if(
            $this->
                container->
                get('doctrine.orm.entity_manager')->
                getConnection()->
                getDriver() instanceof SqliteDriver
        ) {
            $this->
                container->
                get('doctrine.orm.entity_manager')->
                getEventManager()->
                addEventSubscriber(new SqliteSessionInit(array('case_sensitive_like' => true)));
        }
    }
}
