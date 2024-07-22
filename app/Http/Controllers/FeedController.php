<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function feed()
    {
        $query = Lead::query();

        if (request()->has('city') && request()->city != '') {
            $query->where('city', request()->city);
        }

        $leads = $query->get();
        return view('feed', [
            "leads" => $leads,
        ]);
    }
}
