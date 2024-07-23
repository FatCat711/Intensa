<?php

use App\Http\Controllers\FeedController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LeadCreateController;
use App\Models\Lead;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [FeedController::class, 'feed'])->name('feed');

Route::get('/create', [LeadController::class, 'show'])->name('show');

Route::post('/created', [LeadCreateController::class, 'create'])->name('create');

Route::get('/all-leads-csv', function () {
    $table = Lead::all();
    $filename = "leads.csv";
    $handle = fopen($filename, 'w+');
    fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));
    fputcsv($handle, array('fullname', 'email', "city", 'phone_number', 'created_at'));

    foreach ($table as $row) {
        fputcsv($handle, array($row['fullname'], $row['email'], $row['city']->string_to(), $row['phone_number'], $row['created_at']));
    }
    fclose($handle);

    $headers = array(
        'Content-Type' => 'text/csv',
    );
    return Response::download($filename, 'leads.csv', $headers);
});
