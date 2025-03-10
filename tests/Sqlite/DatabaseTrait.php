<?php

declare(strict_types=1);

namespace Yiisoft\Rbac\Db\Tests\Sqlite;

use Yiisoft\Cache\ArrayCache;
use Yiisoft\Db\Cache\SchemaCache;
use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\Sqlite\Connection;
use Yiisoft\Db\Sqlite\Driver;
use Yiisoft\Rbac\Db\Tests\Base\Logger;

trait DatabaseTrait
{
    protected function makeDatabase(): ConnectionInterface
    {
        $pdoDriver = new Driver(dsn: 'sqlite::memory:');
        $pdoDriver->charset('UTF8MB4');

        $connection = new Connection($pdoDriver, new SchemaCache(new ArrayCache()));
        $connection->createCommand('PRAGMA foreign_keys = ON;')->execute();

        $logger = new Logger();
        $connection->setLogger($logger);
        $this->setLogger($logger);

        return $connection;
    }
}
