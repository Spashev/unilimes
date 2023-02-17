<?php

namespace App\Services;

use App\Models\Category;
use App\Models\User;
use Generator;
use Illuminate\Support\Carbon;

class UploadCsv
{
    public static function load(string $fileName): void
    {
        if (!is_readable($fileName)) {
            throw new \RuntimeException(sprintf('File %s not readable', $fileName));
        }
        $dataset = self::loadCsv($fileName);
        foreach ($dataset as $data) {
            $category = Category::updateOrCreate([
                    'title' => $data['category']
                ], [
                    'title' => $data['category']
            ]);
            User::create([
                'email' => $data['email'],
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'gender' => $data['gender'],
                'birthDate' => $data['birthDate'],
                'age' => Carbon::parse($data['birthDate'])->age,
                'category_id' => $category->id
            ]);
        }
    }

    private static function loadCsv(string $fileName): Generator
    {
        if (!is_readable($fileName)) {
            throw new \RuntimeException(sprintf('File %s not readable', $fileName));
        }

        $countHeader = 0;
        $header = [];

        $file = fopen($fileName, 'rb');

        while (($row = fgetcsv($file, 4096)) !== false) {
            if (!$header) {
                $header = $row;
                $countHeader = count($header);
            } else {
                if (count($row) !== $countHeader) {
                    break;
                }
                yield array_combine($header, $row);
            }
        }
    }
}
