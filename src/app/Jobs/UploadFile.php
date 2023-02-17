<?php

namespace App\Jobs;

use App\Services\UploadCsv;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UploadFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $file;
    private const PUBLIC_PATH = "/usr/share/nginx/html/project/storage/app/public/";

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function handle(): void
    {
        $filePath = self::PUBLIC_PATH . $this->file;
        UploadCsv::load($filePath);
    }
}
