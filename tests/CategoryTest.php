<?php


use App\Models\Category;
use Dingo\Api\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CategoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetList()
    {
        $response = $this->call(Request::METHOD_GET,'/api/categories');

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testCreate()
    {
        $params = ['name' => Str::random(255)];

        $response = $this->call(Request::METHOD_POST, '/api/categories/create', $params);

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $params = [
            'id' => Category::query()->inRandomOrder()->first('id')->id,
            'name' => Str::random(255)
        ];

        $response = $this->call(Request::METHOD_PUT, '/api/categories/update', $params);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testDelete()
    {
        $params = [
            'id' => Category::query()->inRandomOrder()->first('id')->id
        ];

        $response = $this->call(Request::METHOD_DELETE, '/api/categories/delete', $params);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}
