<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

return function (): ContainerInterface {
    $builder = new ContainerBuilder();
    return $builder->build();
};
