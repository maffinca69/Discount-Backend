<?php


use App\Models\Category;
use App\Models\City;
use App\Models\Partner;
use Dingo\Api\Http\Request;
use Dingo\Api\Http\Response;
use Illuminate\Support\Str;

class PartnerTest extends TestCase
{
    public function testGetList()
    {
        $response = $this->call(Request::METHOD_GET, '/api/partners');

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testCreate()
    {
        $city = City::query()->create(['name' => Str::random()]);
        $category = Category::query()->create(['name' => Str::random(), 'icon' => Str::random()]);

        $params = [
            'name' => 'Test',
            'info' => Str::random(),
            'description' => Str::random(),
            'logo_url' => Str::random(),
            'min_discount' => 1,
            'max_discount' => 10,
            'cities' => [
                $city->id
            ],
            'categories' => [
                $category->id
            ]
        ];

        $response = $this->call(Request::METHOD_POST, '/api/partners/create', $params);

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $partnerId = Partner::query()->inRandomOrder()->first()->id;
        $params = [
            'id' => $partnerId,
            'name' => Str::random(255),
            'description' => Str::random(255),
            'cities' => [],
            'categories' => []
        ];

        $response = $this->call(Request::METHOD_PUT, '/api/partners/update', $params);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testDelete()
    {
        $partnerId = Partner::query()->inRandomOrder()->first()->id;

        $response = $this->call(Request::METHOD_DELETE, '/api/partners/delete', ['id' => $partnerId]);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}
