<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TransformsRequest;

class RemoveEmojisInStrings extends TransformsRequest
{
    protected array $except = [];

    /**
     * Transform the given value.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return mixed
     */
    protected function transform($key, $value)
    {
        if (\in_array($key, $this->except, true)) {
            return $value;
        }

        $patterns = [
            '/[\x{1F600}-\x{1F64F}]/u',
            '/[\x{1F300}-\x{1F5FF}]/u',
            '/[\x{1F680}-\x{1F6FF}]/u',
            '/[\x{2600}-\x{26FF}]/u',
            '/[\x{2700}-\x{27BF}]/u',
            '/[\x{1F900}-\x{1F9FF}]/u',
        ];

        return preg_replace($patterns, ' @ ', $value);
    }
}
