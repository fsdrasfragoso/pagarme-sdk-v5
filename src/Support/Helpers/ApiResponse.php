
<?php
namespace FragosoSoftware\PagarmeSdk\Support\Helpers;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse
{
    /**
     * Retorna uma resposta de sucesso.
     *
     * @param mixed $data
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function success($data = null, int $statusCode = 200): JsonResponse
    {
        return new JsonResponse([
            'status' => 'success',
            'data' => $data
        ], $statusCode);
    }

    /**
     * Retorna uma resposta de erro.
     *
     * @param string $message
     * @param int $statusCode
     * @param array $errors
     * @return JsonResponse
     */
    public static function error(string $message, int $statusCode = 400, array $errors = []): JsonResponse
    {
        return new JsonResponse([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors
        ], $statusCode);
    }
}
