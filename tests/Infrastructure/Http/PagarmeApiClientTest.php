
<?php

namespace Tests\Infrastructure\Http;

use PHPUnit\Framework\TestCase;
use App\Infrastructure\Http\PagarmeApiClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\RequestInterface;

class PagarmeApiClientTest extends TestCase
{
    private $apiClient;
    private $httpClientMock;

    protected function setUp(): void
    {
        $this->httpClientMock = $this->createMock(Client::class);
        $storeAccessToken = getenv('PAGARME_STORE_ACCESS_TOKEN') ?: 'default_test_token';
        $this->apiClient = new PagarmeApiClient($storeAccessToken, $this->httpClientMock);
    }

    public function testPostRequestSuccess()
    {
        $responseBody = ['id' => 'test_12345', 'status' => 'success'];
        $this->httpClientMock->method('post')
            ->willReturn(new Response(200, [], json_encode($responseBody)));

        $response = $this->apiClient->post('customers', ['name' => 'John Doe']);
        
        $this->assertEquals($responseBody, $response);
    }

    public function testGetRequestSuccess()
    {
        $responseBody = ['id' => 'test_12345', 'status' => 'success'];
        $this->httpClientMock->method('get')
            ->willReturn(new Response(200, [], json_encode($responseBody)));

        $response = $this->apiClient->get('customers/test_12345');
        
        $this->assertEquals($responseBody, $response);
    }

    public function testRequestExceptionHandling()
    {
        $this->httpClientMock->method('get')
            ->willThrowException(new RequestException("Error Communicating with Server", $this->createMock(RequestInterface::class)));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Request Error: Error Communicating with Server");

        $this->apiClient->get('customers/test_12345');
    }
}
