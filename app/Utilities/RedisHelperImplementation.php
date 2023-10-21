<?php

namespace App\Utilities;

use App\Utilities\Contracts\RedisHelper;
use Illuminate\Support\Facades\Cache;

class RedisHelperImplementation implements RedisHelper
{
    /**
     * Store the id of a message along with a message subject in Redis.
     *
     * @param  mixed  $id
     * @param  string  $messageSubject
     * @param  string  $toEmailAddress
     *
     * @return void
     */
    public function storeRecentMessage(mixed $id, string $messageSubject, string $toEmailAddress): void
    {
        $data['messageSubject'] = $messageSubject;
        $data['toEmailAddress'] = $toEmailAddress;
        Cache::put($id, $data);
    }

    /**
     * Retrieve data from cache.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key): mixed
    {
        return Cache::get($key);
    }

    /**
     * Clear all cache data.
     *
     * @return void
     */
    public function clear(): void
    {
        Cache::flush();
    }
}
