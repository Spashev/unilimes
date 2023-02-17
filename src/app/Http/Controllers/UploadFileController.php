<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRequest;
use App\Http\Requests\UploadFileRequest;
use App\Jobs\UploadFile;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Services\UploadFile as UploadFileService;

class UploadFileController extends Controller
{
    public function __construct(private UploadFileService $service)
    {
        $this->service = $service;
    }

    public function index(FilterRequest $request): Factory|View|Application
    {
        $query = $request->all();
        $users = $this->service->getByFilter($request->toArray(), 20);

        return view('welcome', compact('users', 'query'));
    }

    public function upload(UploadFileRequest $request): RedirectResponse
    {
        try {
            $file = $request->file('csv_file');
            $path = $file->store('csv', 'public');

            UploadFile::dispatch($path);

            return redirect()->back()->with('message', 'Dataset file uploading... plz refresh page.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
