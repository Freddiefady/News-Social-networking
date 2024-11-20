<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingsResoucres;
use App\Models\RelatedNewsSite;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function getSettings()
    {
        $settings = Setting::first();
        if(!$settings){
            return responseApi(new SettingsResoucres($settings), 'Not found Settings', 404);
        }
        $data = [
            'settings' => new SettingsResoucres($settings),
            'related_news' => $this->relatedNews()
        ];
        return responseApi($data, 'Response data successfully', 200);
    }
    public function relatedNews()
    {
        $related = RelatedNewsSite::select('name', 'url')->get();
        if(!$related){
            return responseApi($related, 'Not found related', 404);
        }
        return responseApi(['related-news'=>$related], 'Response data successfully', 200);
    }
}
