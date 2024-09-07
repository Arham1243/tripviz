<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\ImageTable;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class SiteSettingsController extends Controller
{
    use UploadImageTrait;

    public function __construct()
    {
        $logo = ImageTable::where('table_name', 'logo')->latest()->first();
        View()->share('logo', $logo);
        View()->share('config', $this->getConfig());
    }

    public function showLogo()
    {
        $logo = ImageTable::where('table_name', 'logo')->latest()->first();

        return view('admin.logo-management')->with('title', 'Logo Management');
    }

    public function saveLogo(Request $request)
    {
        // Validate the request input
        $request->validate([
            'logo' => 'required|file|max:2048',
        ]);

        // Get the existing or create a new ImageTable instance
        $imageEntry = ImageTable::updateOrCreate(
            ['table_name' => 'logo']
        );

        // Use the trait method to handle the file upload and update the image path
        $this->uploadImg('logo', 'img_path', 'Logo', $imageEntry);

        // Redirect back with a success message
        return back()->with('notify_success', 'Logo Updated!');
    }

    public function socialInfo()
    {
        return view('admin.contact-social')->with('title', 'Contact / Social Info Management
        ');
    }

    public function saveSocialInfo(Request $request)
    {
        $configs = $request->except('_token');

        foreach ($configs as $key => $value) {
            Config::updateOrCreate(
                ['flag_type' => $key],
                ['flag_value' => $value]
            );
        }

        return redirect()->route('admin.dashboard')->with('notify_success', 'Information Updated!');
    }
}
