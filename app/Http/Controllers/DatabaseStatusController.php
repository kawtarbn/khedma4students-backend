<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Employer;
use App\Models\Job;
use App\Models\Service;
use App\Models\Application;

class DatabaseStatusController extends Controller
{
    public function getDatabaseStatus()
    {
        try {
            $status = [
                'database_connection' => 'Connected',
                'timestamp' => now()->format('Y-m-d H:i:s'),
                'tables' => [
                    'students' => [
                        'count' => Student::count(),
                        'latest_id' => Student::max('id'),
                        'sample' => Student::latest()->first()
                    ],
                    'employers' => [
                        'count' => Employer::count(),
                        'latest_id' => Employer::max('id'),
                        'sample' => Employer::latest()->first()
                    ],
                    'jobs' => [
                        'count' => Job::count(),
                        'latest_id' => Job::max('id'),
                        'sample' => Job::latest()->first()
                    ],
                    'services' => [
                        'count' => Service::count(),
                        'latest_id' => Service::max('id'),
                        'sample' => Service::latest()->first()
                    ],
                    'applications' => [
                        'count' => Application::count(),
                        'latest_id' => Application::max('id'),
                        'sample' => Application::latest()->first()
                    ]
                ],
                'database_info' => [
                    'connection' => config('database.default'),
                    'host' => config('database.connections.' . config('database.default') . '.host'),
                    'database' => config('database.connections.' . config('database.default') . '.database')
                ]
            ];
            
            return response()->json($status);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'database_connection' => 'Failed',
                'timestamp' => now()->format('Y-m-d H:i:s')
            ], 500);
        }
    }
}
