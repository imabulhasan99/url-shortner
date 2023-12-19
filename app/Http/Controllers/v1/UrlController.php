<?php

namespace App\Http\Controllers\v1;

use PharIo\Manifest\Url;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\v1\Url as Urls;
use App\Http\Resources\UrlResource;
use App\Http\Controllers\Controller;
use App\Services\v1\UrlCreateService;
use App\Http\Requests\UrlCreateRequest;
use Symfony\Component\HttpFoundation\Response;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        /* $userUrls = Urls::where("user_id", auth()->user()->id)->get();
        return UrlResource::make([
            'fullurl'   => $userUrls['full_url'],
            'shorturl'  => $userUrls['short_url'],
            'views'     => $userUrls['views'],
        ]); */
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UrlCreateRequest $request, UrlCreateService $service)
    {
        $url = $service->create($request->validated(), $request->user());
        return $url;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
