<?php

namespace Tests\Unit;

use App\Helpers\Coordinates;
use App\Services\CoordinatesResolverService;
use Tests\TestCase;

class CoordinatesResolverTest extends TestCase
{
    protected $addresses = [];

    public function setUp()
    {
        $this->addresses = $this->addresses();
    }

    protected function addresses()
    {
        $addresses = [
            '40 Tower Lane, Avon, Connecticut 06001, United States',
            'Grójecka Street 1/3, Warszawa, mazowieckie 02019, Poland',
            '...'
        ];

        return $addresses;
    }

    public function testIfNotEmpty()
    {
        $coordinates = (new CoordinatesResolverService($this->addresses[0]))->resolve();

        $this->assertFalse($coordinates->empty());
    }

    public function testIfEmpty()
    {
        $coordinates = (new CoordinatesResolverService($this->addresses[2]))->resolve();

        $this->assertTrue($coordinates->empty());
    }

    public function testInstanceOf()
    {
        $coordinates = (new CoordinatesResolverService($this->addresses[1]))->resolve();

        $this->assertInstanceOf(Coordinates::class, $coordinates);
    }
}
