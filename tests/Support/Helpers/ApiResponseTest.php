
<?php

namespace Tests\Support\Helpers;

use PHPUnit\Framework\TestCase;
use FragosoSoftware\PagarmeSdk\Support\Helpers\ApiResponse;

class ApiResponseTest extends TestCase
{
    public function testSuccessResponse()
    {
        $data = ['message' => 'Operação bem-sucedida'];
        $response = ApiResponse::success($data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
        $decodedContent = json_decode($response->getContent(), true);
        $this->assertEquals($data, $decodedContent);
    }

    public function testErrorResponse()
    {
        $message = 'Erro na requisição';
        $statusCode = 400;
        $response = ApiResponse::error($message, $statusCode);

        $this->assertEquals($statusCode, $response->getStatusCode());
        $this->assertJson($response->getContent());
        $decodedContent = json_decode($response->getContent(), true);
        $this->assertEquals(['error' => $message], $decodedContent);
    }

    public function testCustomStatusCode()
    {
        $message = 'Erro não autorizado';
        $statusCode = 401;
        $response = ApiResponse::error($message, $statusCode);

        $this->assertEquals($statusCode, $response->getStatusCode());
        $this->assertJson($response->getContent());
        $decodedContent = json_decode($response->getContent(), true);
        $this->assertEquals(['error' => $message], $decodedContent);
    }
}
