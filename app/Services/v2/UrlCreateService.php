<?php

namespace App\Services\v2;
use Illuminate\Support\Str;
use App\Models\v1\Url as Urls;
use App\Http\Requests\UrlCreateRequest;
use Symfony\Component\HttpFoundation\Response;

class UrlCreateService
{
    public function create($request, $user){
        $fullUrl =  urldecode($request['fullurl']);
        $fullUrlExistsOrNot = Urls::where('full_url', $fullUrl)->first();
        if($fullUrlExistsOrNot && $fullUrlExistsOrNot['user_id'] === $user->id){
            return response()->json(['short_url' => url($fullUrlExistsOrNot['short_url'])], Response::HTTP_CREATED,[],JSON_UNESCAPED_SLASHES);
        } else {
           return $this->createUrlifNotExists($request, $user);
        }
        
    }

    private function createUrlifNotExists($request, $user){
        $shortUrl = strtolower( Str::random(5));
        $url = Urls::create([
            'full_url'  => urldecode($request['fullurl']),
            'short_url' => $shortUrl,
            'user_id'   => $user->id,
        ]);
        return response()->json(['short_url' => url($url['short_url'])] , Response::HTTP_ACCEPTED,[],JSON_UNESCAPED_SLASHES);
    }
}
