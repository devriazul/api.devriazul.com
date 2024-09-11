<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class MigrationController extends Controller
{
    public function runMigrations()
    {
        // Optionally, check for authorization
        // if (!auth()->user() || !auth()->user()->is_admin) {
        //     abort(403, 'Unauthorized');
        // }

        // Run the migrations
        Artisan::call('migrate');

        return response()->json(['status' => 'Migrations ran successfully']);
    }
}
