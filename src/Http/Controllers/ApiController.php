<?php

namespace TypiCMS\Modules\Pagebanners\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Pagebanners\Models\Pagebanner;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Pagebanner::class)
            ->selectFields($request->input('fields.pagebanners'))
            ->allowedSorts(['status_translated', 'target'])
            ->allowedFilters([
                AllowedFilter::custom('target', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Pagebanner $pagebanner, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($pagebanner->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $pagebanner->setTranslation($key, $lang, $value);
                }
            } else {
                $pagebanner->{$key} = $content;
            }
        }

        $pagebanner->save();
    }

    public function destroy(Pagebanner $pagebanner)
    {
        $pagebanner->delete();
    }
}
