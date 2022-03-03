<?php

namespace Tonghe\Modules\Pagebanners\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use Tonghe\Modules\Pagebanners\Http\Controllers\AdminController;
use Tonghe\Modules\Pagebanners\Http\Controllers\ApiController;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('pagebanners', [AdminController::class, 'index'])->name('index-pagebanners')->middleware('can:read pagebanners');
            $router->get('pagebanners/export', [AdminController::class, 'export'])->name('admin::export-pagebanners')->middleware('can:read pagebanners');
            $router->get('pagebanners/create', [AdminController::class, 'create'])->name('create-pagebanner')->middleware('can:create pagebanners');
            $router->get('pagebanners/{pagebanner}/edit', [AdminController::class, 'edit'])->name('edit-pagebanner')->middleware('can:read pagebanners');
            $router->post('pagebanners', [AdminController::class, 'store'])->name('store-pagebanner')->middleware('can:create pagebanners');
            $router->put('pagebanners/{pagebanner}', [AdminController::class, 'update'])->name('update-pagebanner')->middleware('can:update pagebanners');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('pagebanners', [ApiController::class, 'index'])->middleware('can:read pagebanners');
            $router->patch('pagebanners/{pagebanner}', [ApiController::class, 'updatePartial'])->middleware('can:update pagebanners');
            $router->delete('pagebanners/{pagebanner}', [ApiController::class, 'destroy'])->middleware('can:delete pagebanners');
        });
    }
}
