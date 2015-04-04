<?php

namespace Acme\DemoBundle\DataFixtures\ORM;

use Hautelook\AliceBundle\Alice\DataFixtureLoader;
use Nelmio\Alice\Fixtures;

class Loader extends DataFixtureLoader
{
    protected function getFixtures()
    {
        return  array(
            __DIR__ . '/Data/sets.yml',
            __DIR__ . '/Data/cards.yml',

        );
    }
}
