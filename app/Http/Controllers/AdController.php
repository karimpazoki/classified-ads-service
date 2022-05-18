<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Ad;
use App\Traits\ResponseBuilder;
use App\Http\Resources\AdResource;
use Auth;
use App\Models\Attribute;
use Illuminate\Pagination\Paginator;

class AdController extends Controller
{
    use ResponseBuilder;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * returns a list of all ads' information
     *
     * @return App\Models\Ad[]
     */
    public function index()
    {
        $currentPage = empty(request()->page) ? 1 : request()->page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
        return $this->success(['ads' => AdResource::collection(Ad::paginate(50))]);
    }

    /**
     * Returns an ad's information
     *
     * @param int ad
     *
     * @return App\Models\Ad
     */
    public function show($ad)
    {
        return $this->success(['ad' => new AdResource(Ad::findOrFail($ad))]);
    }

    /**
     * Stores new ad's information
     *
     * @param Illuminate\Http\Request $request
     *
     * @return App\Models\Ad
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'descriptipn' => 'required|string|max:2000, min:50',
            'category_id' => 'required|exists:category,id',
            'city_id' => 'required|exists:category,id',
            'is_enable' => 'required|exists:category,id',
            'attributes' => 'required|array',
            'attributes.*.id' => 'required|exists:attribute,id',
            'attributes.*.value' => 'required',
        ]);

        foreach ($request->attributes as $attribute) {
            $attr = Attribute::find($attribute->id);
            if ($attr->type !== gettype($attribute->value))
                throw new \Exception("invalid attribute value type");
            if (
                $attr->fieldType->has_item &&
                !in_array($attribute->value, $attr->items->pluck("name"))
            )
                throw new \Exception("invalid attribute value");
        }

        $data = $request->except('atributes');
        $user = Auth::user();
        $user->ads()->create($data);
        return $this->success(['ad' => new AdResource(Ad::create($request->all()))], "The ad created successfully", Response::HTTP_CREATED);
    }

    /**
     * Updates an existing ad's information
     *
     * @param Illuminate\Http\Request $request
     * @param int ad
     *
     * @return App\Models\Ad
     */
    public function update(Request $request, $ad)
    {
    }

    /**
     * Removes an existing ad
     *
     * @param int ad
     *
     * @return App\Models\Ad
     */
    public function delete($ad)
    {
        $ad = Ad::findOrFail($ad);
        $ad->delete();
        return $this->success(['ad' => new AdResource($ad)], "'{$ad->title}' ad deleted successfully", Response::HTTP_OK);
    }
}
