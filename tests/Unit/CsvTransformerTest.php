<?php

namespace Tests\Unit;

use App\Transformers\CsvRowTransformer;
use Tests\TestCase;

class CsvTransformerTest extends TestCase
{
    protected $data;

    public function setUp()
    {
        $this->data = $this->data();
    }

    protected function data()
    {
        return [
            ['id', 'name', 'description', 'date'],
            [1, 'Odit et libero impedit voluptatem deserunt', 'Numquam nihil', '2018-07-26'],
            [2, 'Velit perspiciatis', 'Perferendis in voluptates', '2018-05-30'],
            [3, 'Eum hic voluptas', 'Nobis sit tempore provident', '2021-12-03']
        ];
    }

    public function testTransformer()
    {
        $transformer = new CsvRowTransformer();
        $transformer->setHeaders($this->data[0]);
        $item = $transformer->transformItem($this->data[3]);

        $this->assertEquals('Eum hic voluptas', $item['name']);
    }
}
