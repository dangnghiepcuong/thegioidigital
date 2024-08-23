<?php

namespace App\Repositories\Eloquents;

use App\Models\UserMeta;
use App\Repositories\BaseRepository;

class UserMetaRepository extends BaseRepository
{
    public function model()
    {
        return new UserMeta();
    }

    public function queryMetaKeys($userId)
    {
        return $this->model()
            ->select('key')
            ->where('user_id', $userId);
    }
    public function getMetaValue($userId, $key)
    {
        return $this->model()
            ->where('user_id', $userId)
            ->where('key', $key)
            ->firstOrFail();
    }

    public function getUnserializeMetaValue($userId, $key)
    {
        $data = $this->model()
            ->where('user_id', $userId)
            ->where('key', $key)
            ->firstOrFail();

        $result = unserialize($data->value);

        return $result ?? [];
    }
}
