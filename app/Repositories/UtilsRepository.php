<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Http;
use App\Jobs\SyncMenuJob;

class UtilsRepository
{
    public function getStatusFormat($status)
    {
        if ($status == true) {
            return '<h5><span class="badge rounded-pill bg-success align-middle">' . __('translation.active') . '</span></h5>';
        } elseif ($status == false) {
            return '<h5><span class="badge rounded-pill bg-danger align-middle">' . __('translation.inactive') . '</span></h5>';
        }
    }

    public function getmenu($menu)
    {
        $key =  env('RAPID_KEY', '');
        $host =  env('RAPID_HOST', '');
        $base_url =  env('RAPID_BASE_URL', '');

        if ($menu->category == 'Pizza') {
            $response = Http::withHeaders([
                'X-RapidAPI-Host' => $host,
                'X-RapidAPI-Key' => $key
            ])->get($base_url.'pizzas/');
    
            if ($response->successful() == true) {
                $menures = $response->getBody();
                return $menures;
            }
             return false;
        } else {
        $response = Http::withHeaders([
            'X-RapidAPI-Host' => $host,
            'X-RapidAPI-Key' => $key
        ])->get($base_url.'desserts/');

        if ($response->successful() == true) {
            $menures = $response->getBody();
            return $menures;
        }
         return false;
        }
    }

    public function getAllMenu($request)
    {
        $key =  env('RAPID_KEY', '');
        $host =  env('RAPID_HOST', '');
        $base_url =  env('RAPID_BASE_URL', '');

        if ($request->category == 'Pizza') {
            $response = Http::withHeaders([
                'X-RapidAPI-Host' => $host,
                'X-RapidAPI-Key' => $key
            ])->get($base_url.'pizzas/');

            if ($response->successful() == true) {
                $menures = $response->getBody();
                
                foreach ($menures as $menu) {
                    SyncMenuJob::dispatch($menu);
                }
                return true;
            }
             return false;
        } else {
        $response = Http::withHeaders([
            'X-RapidAPI-Host' => $host,
            'X-RapidAPI-Key' => $key
        ])->get($base_url.'desserts/');

        if ($response->successful() == true) {
            $menures = $response->getBody();
            foreach ($menures as $menu) {
                SyncMenuJob::dispatch($menu);
            }
            return true;
        }
         return false;
        }
    }

}