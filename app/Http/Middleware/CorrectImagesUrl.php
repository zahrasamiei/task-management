<?php
/**
 * Created by PhpStorm.
 * User: zahra.samiee@zoodfood.com
 * Date: 24/12/22
 * Time: 1:35 PM
 */

namespace App\Http\Middleware;

use App\Services\Utilities\FileService;
use Illuminate\Foundation\Http\Middleware\TransformsRequest;

class CorrectImagesUrl extends TransformsRequest
{
    protected array $only = ["images", "attachments"];

    /**
     * Transform the given value.
     *
     * @param string $key
     * @param mixed  $value
     */
    protected function transform($key, $value): mixed
    {
        if (!$this->checkKey($key)) {
            return $value;
        }

        return $this->setCorrectUrl($value);
    }

    private function checkKey(string $key): bool
    {
        $flag = false;
        foreach ($this->only as $singleOnly) {
            if (preg_match(sprintf('/^%s.\d+$/i', $singleOnly), $key) == true) {
                $flag = true;
            }
        }

        return $flag;
    }

    private function setCorrectUrl(string $filename): string
    {
        $pathFragments = explode('/', parse_url($filename, PHP_URL_PATH));
        $filename = end($pathFragments);

        return FileService::getBaseImageUrlOnCdn() . $filename;
    }
}
