<?php

namespace App\Traits;

use App\Constants\ErrorConstants;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponseTrait
{
    protected function success(array|JsonResource $data, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return $this->response(true, $data, $statusCode);
    }

    protected function error(array $data, int $statusCode = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return $this->response(false, $data, $statusCode);
    }

    protected function exceptionError(string $message, int $errorCode, int $statusCode = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        $data = [
            'message' => __($message),
            'code'    => $errorCode,
        ];

        return $this->response(false, $data, $statusCode);
    }

    protected function errorWithExtraData(string $message, int $errorCode, array $extra, int $statusCode = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        $data = [
            'message' => __($message),
            'code'    => $errorCode,
        ];
        $data = array_merge($data, $extra);

        return $this->response(false, $data, $statusCode);
    }

    protected function unauthorized(): JsonResponse
    {
        return $this->errorWithCustomCode(ErrorConstants::UNAUTHORIZED);
    }

    protected function forbidden(): JsonResponse
    {
        return $this->errorWithCustomCode(ErrorConstants::FORBIDDEN);
    }

    protected function unprocessableEntity(array $errors = []): JsonResponse
    {
        return $this->errorWithCustomCode(ErrorConstants::UNPROCESSABLE_ENTITY, ['errors' => $errors]);
    }

    protected function notFound(): JsonResponse
    {
        return $this->errorWithCustomCode(ErrorConstants::NOT_FOUND);
    }

    protected function internalServerError(): JsonResponse
    {
        return $this->errorWithCustomCode(ErrorConstants::INTERNAL_SERVER_ERROR);
    }

    private function errorWithCustomCode(int $errorCode, array $extra = []): JsonResponse
    {
        $message = ErrorConstants::LABELS[$errorCode] ?? '';

        if ($extra !== []) {
            return $this->errorWithExtraData($message, $errorCode, $extra);
        }

        return $this->exceptionError($message, $errorCode);
    }

    private function response(bool $success, array|JsonResource $data, int $statusCode): JsonResponse
    {
        return $this->generateResponse(
            [
                'success' => $success,
                'data'    => $data,
            ],
            $statusCode
        );
    }

    private function generateResponse(array|JsonResource $data, int $statusCode): JsonResponse
    {
        if (is_array($data)) {
            $data = $this->translateResponseMessage($data);
        }

        return new JsonResponse($data, $statusCode);
    }

    private function translateResponseMessage(array $data): array
    {
        $messageKeys = [
            'message',
            'msg',
        ];

        foreach ($data as $key => $value) {
            if (in_array($key, $messageKeys)) {
                unset($data[$key]);
                $data[$key] = __($value);
            }
        }

        return $data;
    }
}
