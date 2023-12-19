<?php

namespace App\Services\v1;
use App\Models\v1\Url as Urls;
use App\Http\Requests\UrlCreateRequest;
use Symfony\Component\HttpFoundation\Response;

class UrlCreateService
{
    public function create($request, $user){
       
 
       $fullUrlExistsOrNot = Urls::where('full_url', 'LIKE', '%' . $request['fullurl'] . '%')
                            ->get();
            if ($fullUrlExistsOrNot->count() > 0) {
                if ($fullUrlExistsOrNot[0]['user_id'] === $user->id) {
                    return response()->json(['short_url' => url($fullUrlExistsOrNot[0]['short_url'])], Response::HTTP_CREATED);
                } else {
                    return response()->json(['message'  => 'Next forward'],200);
                }
            }
    }
}
