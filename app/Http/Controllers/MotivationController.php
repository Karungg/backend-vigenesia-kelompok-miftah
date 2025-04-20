<?php

namespace App\Http\Controllers;

use App\Models\Motivation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MotivationController extends Controller
{
    public function index()
    {
        try {
            $motivasi = Motivation::join('users', 'motivations.id_user', '=', 'users.id')
                ->select('motivations.*', 'users.nama as nama')
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'message' => 'Success',
                'data' => $motivasi
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to load data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getByName(string $name)
    {
        try {
            $motivasi = Motivation::join('users', 'motivations.id_user', '=', 'users.id')
                ->where('nama', $name)
                ->select('motivations.*', 'users.nama as nama')
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'message' => 'Success',
                'data' => $motivasi
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to load data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getUser(string $name)
    {
        try {
            $user = User::where('nama', $name)
                ->select(['id', 'nama', 'profesi', 'email', 'password'])
                ->get();

            return response()->json([
                'is_active' => true,
                'message' => 'Success',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to load data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getById(string $id)
    {
        try {
            $motivasi = Motivation::join('users', 'motivations.id_user', '=', 'users.id')
                ->where('motivations.id', $id)
                ->select('motivations.*', 'users.nama as nama')
                ->get();

            return response()->json([
                'message' => 'Success',
                'data' => $motivasi
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to load data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $userId = DB::table('users')
                ->where('nama', $request->input('nama'))
                ->value('id');

            Motivation::create([
                'id_user' => $userId,
                'isi_motivasi' => $request->input('motivasi'),
                'id_kategori' => 1,
                'tanggal_input' => now()->toString(),
                'tanggal_update' => now()->toString()
            ]);

            return response()->json([
                'message' => 'success',
                'data' => [
                    $request->all()
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => [
                    $e->getMessage()
                ]
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Motivation $motivation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motivation $motivation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Motivation $motivation)
    {
        try {
            Motivation::where('id', $request->input('id'))
                ->update([
                    'isi_motivasi' => $request->input('motivasi'),
                    'tanggal_update' => now()->toString()
                ]);

            return response()->json([
                'message' => 'success',
                'data' => [
                    $request->all()
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => [
                    $e->getMessage(),
                    $request->all()
                ]
            ]);
        }
    }

    public function updateUser(Request $request, Motivation $motivation)
    {
        try {
            User::where('nama', $request->input('id'))
                ->update([
                    'nama' => $request->input('nama'),
                    'profesi' => $request->input('profesi'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password'))
                ]);

            return response()->json([
                'message' => 'success',
                'data' => [
                    $request->all()
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => [
                    $e->getMessage(),
                    $request->all()
                ]
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Motivation $motivation)
    {
        try {
            Motivation::where('id', $id)
                ->delete();

            return response()->json([
                'message' => 'success',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => [
                    $e->getMessage(),
                ]
            ]);
        }
    }
}
