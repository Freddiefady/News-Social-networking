<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsRequest;
use App\Utils\ImageManager;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:settings');
    }
    public function index()
    {
        return view('dashboard.settings.index');
    }

    public function update(SettingsRequest $request)
    {
        $request->validated();
        try
        {
            DB::beginTransaction();
            $settings = Setting::findOrFail($request->settings_id);
            $setting = $settings->update($request->except(['_token','settings_id','logo', 'favicon']));

            if($request->hasFile('logo'))
            {
                $this->updateLogo($settings, $request);
            }
            if($request->hasFile('favicon'))
            {
                $this->updateFavicon($settings, $request);
            }
            if(!$setting)
            {
                return redirect()->back()->with('error', 'Try later again');
            }
            DB::commit();
            return redirect()->back()->with('success', 'Updated settings successfully');
        }catch(\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors(['errors'=>$e->getMessage()]);
        }
    }
    private function updateLogo($settings, $request)
    {
        ImageManager::deleteImageFromLocal($settings->logo);
        $imageName = ImageManager::generateImageName($request->logo);
        $logo_path = ImageManager::storeImageInLocal($request->logo, $imageName, 'settings');
        $settings->update(['logo'=>$logo_path]);
    }
    private function updateFavicon($settings, $request)
    {
        ImageManager::deleteImageFromLocal($settings->favicon);
        $imageName = ImageManager::generateImageName($request->favicon);
        $favicon_path = ImageManager::storeImageInLocal($request->favicon, $imageName, 'settings');
        $settings->update(['favicon'=>$favicon_path]);
    }
}
