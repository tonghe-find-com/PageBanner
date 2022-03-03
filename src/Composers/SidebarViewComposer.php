<?php

namespace Tonghe\Modules\Pagebanners\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read pagebanners')) {
            return;
        }
        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Pagebanners'), function (SidebarItem $item) {
                $item->id = 'pagebanners';
                $item->icon = config('typicms.pagebanners.sidebar.icon');
                $item->weight = config('typicms.pagebanners.sidebar.weight');
                $item->route('admin::index-pagebanners');
                $item->append('admin::create-pagebanner');
            });
        });
    }
}
