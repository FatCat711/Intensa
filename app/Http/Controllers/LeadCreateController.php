<?php

namespace App\Http\Controllers;

use App\City;
use App\Models\Lead;
use App\Models\LeadSubmission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
//Объединить с LeadController
class LeadCreateController extends Controller
{
    public function create()
    {
        $ip = request()->ip();

        $submissionsLastHour = LeadSubmission::where('ip', $ip)
            ->where('created_at', '>=', Carbon::now()->subHour())
            ->count();

        $blockedUntil = cache()->get("ip_blocked_{$ip}");

        if ($blockedUntil) {
            return redirect()->route('feed')->with('error', "You blocked untill {$blockedUntil->toDateTimeString()}");
        }

        if ($submissionsLastHour >= 5) {
            $blockTime = Carbon::now()->addHours(2);
            cache()->put("ip_blocked_{$ip}", $blockTime, $blockTime);

            return redirect()->route('feed')->with('error', "You blocked untill {$blockTime->toDateTimeString()}");
        }


        $validated = request()->validate([
            "fullname" => "required|min:3|max:30",
            "email" => "required|email",
            "phone" => "required|min:1|max:12",
        ]);
        $city_validated = request()->validate([
            'city' => [new Enum(City::class)],
        ]);
        $lead = Lead::create(
            [
                "fullname" => $validated["fullname"],
                "email" => $validated["email"],
                "phone_number" => $validated["phone"],
                "city" => $city_validated["city"],
            ]
        );
        LeadSubmission::create(['ip' => $ip]);
        return redirect()->route('feed')->with('success', 'Lead created successfuly');
    }
}
