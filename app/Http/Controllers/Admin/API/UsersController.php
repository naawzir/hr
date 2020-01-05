<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(\Auth::user());
        $users = User::all();
        if ($users) {
            return response()->json([
                'error' => false,
                'data'  => $users,
            ]);
        }
        return response()->json([
            'error'   => true,
            'message' => 'Error - No data found'
        ]);
    }
}
