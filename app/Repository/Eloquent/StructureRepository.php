<?php

namespace App\Repository\Eloquent;

use App\Models\Structure;
use App\Repository\StructureRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class StructureRepository extends Repository implements StructureRepositoryInterface
{
    private const STRUCTURES_CACHE_EPOCH_KEY = 'structures.cache_epoch';

    protected Model $model;

    public function __construct(Structure $model)
    {
        parent::__construct($model);
    }

    public function structure($key)
    {
        return Cache::rememberForever($this->structureCacheKey($key), function () use ($key) {
            return $this->model::query()->where('key', $key)->first();
        });
    }

    public function structuresForKeys(array $keys): array
    {
        $keys = array_values(array_unique($keys));
        if ($keys === []) {
            return [];
        }
        sort($keys);

        $epoch = (int) Cache::get(self::STRUCTURES_CACHE_EPOCH_KEY, 0);
        $cacheKey = 'structures.batch.'.$epoch.'.'.md5(implode("\0", $keys));

        return Cache::rememberForever($cacheKey, function () use ($keys) {
            $rows = $this->model::query()->whereIn('key', $keys)->get()->keyBy('key');
            $out = [];
            foreach ($keys as $k) {
                $out[$k] = $rows->get($k);
            }

            return $out;
        });
    }

    public function publish($key, $content)
    {
        $result = $this->model::query()->updateOrCreate(['key' => $key], ['content' => $content]);
        Cache::forget($this->structureCacheKey($key));
        $epoch = (int) Cache::get(self::STRUCTURES_CACHE_EPOCH_KEY, 0);
        Cache::forever(self::STRUCTURES_CACHE_EPOCH_KEY, $epoch + 1);

        return $result;
    }

    protected function structureCacheKey(string $key): string
    {
        return 'structure.'.$key;
    }
}
