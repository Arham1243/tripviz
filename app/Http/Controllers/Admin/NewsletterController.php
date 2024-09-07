<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::all();

        return view('admin.newsletters.list', compact('newsletters'))->with('title', 'Newsletters');
    }

    public function suspend(Newsletter $newsletter)
    {
        $newsletter->is_active = ! $newsletter->is_active;
        $newsletter->save();

        return redirect()->route('admin.newsletters')->with('notify_success', 'Email status updated successfully.');
    }

    public function destroy(Newsletter $newsletter)
    {
        if ($newsletter) {
            $newsletter->delete();

            return redirect()->route('admin.newsletters')->with('notify_success', 'Email deleted successfully');

        }

        return redirect()->back()->with('notify_error', 'Email Not Found!');
    }
}
