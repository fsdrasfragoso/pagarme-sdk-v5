
<?php

namespace App\Support\Helpers;

class JsonParser
{
    /**
     * Converte um array ou objeto em uma string JSON.
     *
     * @param mixed $data
     * @return string
     */
    public static function encode($data): string
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     * Decodifica uma string JSON em um array associativo.
     *
     * @param string $json
     * @return mixed
     */
    public static function decode(string $json)
    {
        return json_decode($json, true);
    }

    /**
     * Verifica se uma string é um JSON válido.
     *
     * @param string $json
     * @return bool
     */
    public static function isValid(string $json): bool
    {
        json_decode($json);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
