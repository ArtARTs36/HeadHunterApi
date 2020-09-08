<?php

namespace ArtARTs36\HeadHunterApi\Tests;

use ArtARTs36\HeadHunterApi\Support\EntityContainer;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function setUp()
    {
        parent::setUp();

        EntityContainer::reset();
    }
}
