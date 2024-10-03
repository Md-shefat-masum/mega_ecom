<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\Cache;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $data = Cache::remember('shared_data', (5 * 60), function(){
            $fields = [
                'header_logo',
                'footer_logo',

                'title',
                'site_name',
                'tag',
                'keywords',
                'image',
                'map_link',
                'address',

                // 'sitemap' ,
                // 'terms_and_condition' ,

                'youtube',
                'whatsapp',
                'telegram',
                'facebook',
                'phone_numbers',
                'emails',

                'short_intro',
                'shiping_on_order',
                'shiping_and_delivery',

                // 'schema_tag' ,

                'return_and_exchange',
                'payment_gateway_logo',

                'delivery_charge',

                'home_page_descrption',
                'description',

                'fabicon',
                'copy_right',
                'breaking_news',

                // 'cookies_policy' ,
                // 'about_us' ,
            ];

            $SettingModel = \App\Modules\ConfigurationManagement\WebsiteConfiguration\Models\SettingTitleModel::class;
            $settings = $SettingModel::query()
                ->select('id', 'title')
                ->whereIn('title', $fields)
                ->with([
                    'setting_values:id,setting_title_id,title,value',
                ])
                ->get();

            $all_category_parents = \App\Modules\WebsiteApi\Category\Actions\GetAllCategoryParent::execute();
            $user = null;
            $all_cart_data = [];
            $select = ['role_id', 'slug', 'name', 'user_name', 'email', 'phone_number', 'photo', 'id'];
            if (auth()->check()) {
                $user = \App\Modules\UserManagement\User\Models\Model::select($select)
                    ->with('role:id,name,serial')
                    ->where('id', auth()->user()->id)
                    ->first();
                $user->user_delivery_address = $user->user_delivery_address()->where('is_default', 1)->first();
                $all_cart_data = \App\Modules\WebsiteApi\Cart\Actions\All::execute(true);
            }

            $data = [
                'all_cart_data' => $all_cart_data,
                'auth' => $user,
                'settings' => $settings,
                'all_category_parents' => $all_category_parents,
            ];

            return $data;
        });

        return array_merge(parent::share($request), $data);
    }
}
