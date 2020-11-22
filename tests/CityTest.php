<?php


use App\Models\City;
use Dingo\Api\Http\Request;
use Dingo\Api\Http\Response;
use Illuminate\Support\Str;

class CityTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetList()
    {
        $response = $this->get('/api/cities');
        dd($response->currentUri);

        $response->assertResponseOk();
    }

    public function testCreate()
    {
        $params = ['name' => Str::random(255)];
        $response = $this->call(Request::METHOD_POST, '/api/cities/create', $params);

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $params = ['id' => City::latest()->first()->id, 'name' => Str::random(255)];
        $response = $this->call(Request::METHOD_PUT, '/api/cities/update', $params);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testDelete()
    {
        $params = ['id' => City::latest()->first()->id];
        $response = $this->call(Request::METHOD_DELETE, '/api/cities/delete', $params);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}
