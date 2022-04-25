# PageBanner

每一頁的Banner管理

# News

## step1
composer require tonghe/pagebanners

## step2
Add TypiCMS\Modules\PageBanners\Providers\ModuleServiceProvider::class, to config/app.php, before TypiCMS\Modules\Core\Providers\ModuleServiceProvider::class,

## step3
php artisan vendor:publish

## step4
php artisan migrate