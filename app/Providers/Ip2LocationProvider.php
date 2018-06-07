<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use DB;
use App\Country;

class Ip2LocationProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $countryCodeByIp;
        $ip_address = '27.147.203.23';
        $results = DB::select('SELECT * FROM `ip2location` WHERE INET_ATON(?) <= ip_to LIMIT 1', array($ip_address));
        foreach ($results as $result) {
            $countryCodeByIp = $result->country_code;
        }

        $countryinfo = Country::where('country_code', $countryCodeByIp)->first();

        View::share('current_info',$countryinfo);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
