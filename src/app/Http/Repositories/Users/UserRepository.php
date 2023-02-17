<?php

namespace App\Http\Repositories\Users;

use App\Http\Repositories\RepositoryInterface;
use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements RepositoryInterface
{

    public function find(int $id): Model|Collection|array|User|null
    {
        return User::findOrFail($id);
    }

    public function create(array $attributes): Model|User
    {
        return User::create($attributes);
    }

    public function filter(array $data, int $limit): LengthAwarePaginator
    {
        $query = User::query();

        if (isset($data['category'])) {
            $query->whereHas('category', function ($query) use($data) {
                return $query->where('title', '=', $data['category']);
            });
        }

        if (isset($data['birthDate'])) {
            $query->where('birthDate', $data['birthDate']);
        }

        if (isset($data['gender'])) {
            $query->where('gender', $data['gender']);
        }

        if (isset($data['ageStart']) && !isset($data['ageEnd'])) {
            $query->where('age', $data['ageStart']);
        }

        if (isset($data['ageEnd']) && !isset($data['ageStart'])) {
            $query->where('age', $data['ageEnd']);
        }

        if (isset($data['ageEnd'], $data['ageStart'])) {
            $query->whereBetween('age', [$data['ageStart'], $data['ageEnd']]);
        }

        return $query->paginate($limit);
    }

    public function categoryUserLikedStatistic(): array
    {
        $categories = Category::all();

        $result = [];
        foreach($categories as $category) {
            $result[] = [
              'title' => $category->title,
              'userLikedCount' => $category->users->count()
            ];
        }

        return $result;
    }
}
