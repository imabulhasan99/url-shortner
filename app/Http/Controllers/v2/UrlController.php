<?php

namespace App\Http\Controllers\v2;


use App\Models\v2\Url as Urls;
use App\Http\Resources\UrlResource;
use App\Http\Controllers\Controller;
use App\Services\v2\UrlCreateService;
use App\Http\Requests\UrlCreateRequest;
use Symfony\Component\HttpFoundation\Response;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userUrls = Urls::where("user_id", auth()->user()->id)->get();
        $urlCollection = UrlResource::collection($userUrls);
       return \response()->json([$urlCollection], Response::HTTP_FOUND,[], JSON_UNESCAPED_SLASHES);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UrlCreateRequest $request, UrlCreateService $service)
    {
        $url = $service->create($request->validated(), $request->user());
        return $url;
    }

    public function redirect($shorturl){
        $urlExistorNot = Urls::where('short_url', $shorturl)->first();
        if($urlExistorNot){
            $urlExistorNot->increment('views');
            return redirect($urlExistorNot->full_url);
        }
        abort(404,'URL Not Found');
    }

   
 
}
