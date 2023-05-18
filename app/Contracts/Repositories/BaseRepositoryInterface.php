<?php
/**
 * Created by PhpStorm.
 * User: Mehran.Mahmoudi@ZoodFood.Com
 * Date: 7/30/21
 * Time: 9:54 PM
 */

namespace App\Contracts\Repositories;

interface BaseRepositoryInterface
{
    public function __construct(string $model);

    public function getClass(): string;

    public function getModel(): \Illuminate\Database\Eloquent\Model;

    public function createQueryBuilder(): \Illuminate\Database\Eloquent\Builder;
}
