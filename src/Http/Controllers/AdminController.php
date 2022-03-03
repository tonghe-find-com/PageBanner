<?php

namespace Tonghe\Modules\Pagebanners\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use Tonghe\Modules\Pagebanners\Exports\Export;
use Tonghe\Modules\Pagebanners\Http\Requests\FormRequest;
use Tonghe\Modules\Pagebanners\Models\Pagebanner;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('pagebanners::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' pagebanners.xlsx';

        return Excel::download(new Export($request), $filename);
    }

    public function create(): View
    {
        $model = new Pagebanner();

        return view('pagebanners::admin.create')
            ->with(compact('model'));
    }

    public function edit(pagebanner $pagebanner): View
    {
        return view('pagebanners::admin.edit')
            ->with(['model' => $pagebanner]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        if( Pagebanner::where('target',$request->target)->first()){
            return redirect()->back()->with('error','該目標已存在banner');
        }


        $pagebanner = Pagebanner::create($request->validated());

        return $this->redirect($request, $pagebanner);
    }

    public function update(pagebanner $pagebanner, FormRequest $request): RedirectResponse
    {
        $pagebanner->update($request->validated());

        return $this->redirect($request, $pagebanner);
    }
}
