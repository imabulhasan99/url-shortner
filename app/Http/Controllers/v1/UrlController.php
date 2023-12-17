<?php

namespace App\Http\Controllers\v1;

use PharIo\Manifest\Url;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UrlCreateRequest;
use App\Models\v1\Url as Urls;
use Symfony\Component\HttpFoundation\Response;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UrlCreateRequest $request)
    {
       $validatedUrl  = $request->validated();
       $protocolCheck = explode('//', $validatedUrl['fullurl']);
       if (count($protocolCheck) <= 1) {
            $validatedUrl['fullurl'] = 'http://'. $validatedUrl['fullurl'];
       }
       $fullUrlExistsOrNot = Urls::where('full_url', 'LIKE', '%' . $validatedUrl['fullurl'] . '%')
                            ->get();
            if ($fullUrlExistsOrNot->count() > 0) {
                if ($fullUrlExistsOrNot[0]['user_id'] === $request->user()->id) {
                    return response()->json(['short_url' => url($fullUrlExistsOrNot[0]['short_url'])], Response::HTTP_CREATED);
                } else {
                    return response()->json(['message'  => 'Next forward'],200);
                }
            }
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
