<?php

namespace Tests\Support\Helpers;

use PHPUnit\Framework\TestCase;
use App\Support\Helpers\JsonParser;

class JsonParserTest extends TestCase
{
    public function testEncode()
    {
        $data = ['name' => 'João Silva', 'email' => 'joao.silva@example.com'];
        $json = JsonParser::encode($data);

        $this->assertJson($json);
        $decoded = json_decode($json, true);
        $this->assertEquals($data, $decoded);
    }

    public function testDecode()
    {
        $json = '{"name": "João Silva", "email": "joao.silva@example.com"}';
        $data = JsonParser::decode($json);

        $this->assertTrue(is_array($data));
        $this->assertEquals('João Silva', $data['name']);
        $this->assertEquals('joao.silva@example.com', $data['email']);
    }

    public function testDecodeInvalidJson()
    {
        $invalidJson = '{"name": "João Silva", "email": "joao.silva@example.com"';

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid JSON data');
        
        JsonParser::decode($invalidJson);
    }
}
