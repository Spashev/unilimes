<?php

namespace App\Services;

use App\Http\Repositories\Users\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UploadFile
{
    public function __construct(private UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getByFilter(array $data, int $limit): LengthAwarePaginator
    {
        return $this->userRepository->filter($data, $limit);
    }

    public function getCategoryUserLikedStatistic(): array
    {
        return $this->userRepository->categoryUserLikedStatistic();
    }
}
