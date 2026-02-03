<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DBController extends Controller
{
    public function migrate()
    {
        try {
            Artisan::call('migrate');
            return response()->json(
                array(
                    'status' => 'success',
                    'message' => 'migrate successfully.',
                ),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                array(
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ),
                404
            );
        }
    }

    public function migrateFresh()
    {
        try {
            Artisan::call('migrate:fresh');
            return response()->json(
                array(
                    'status' => 'success',
                    'message' => 'migrate fresh successfully.',
                ),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                array(
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ),
                404
            );
        }
    }

    public function migrateRollback()
    {
        try {
            Artisan::call('migrate:rollback');
            return response()->json(
                array(
                    'status' => 'success',
                    'message' => 'migrate rollback successfully.',
                ),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                array(
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ),
                404
            );
        }
    }

    public function seed()
    {
        try {
            Artisan::call('db:seed');
            return response()->json(
                array(
                    'status' => 'success',
                    'message' => 'DB seed successfully.',
                ),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                array(
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ),
                404
            );
        }
    }

    public function seedClass($class)
    {
        try {
            Artisan::call("db:seed --class=$class");
            return response()->json(
                array(
                    'status' => 'success',
                    'message' => 'DB seed successfully.',
                ),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                array(
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ),
                404
            );
        }
    }
}
