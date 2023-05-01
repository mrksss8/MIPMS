<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{
    public function updateStatus($user_id, $status_code)
    {
        try {
            $udpate_user = User::whereId($user_id)->update([
                'status' => $status_code
            ]);


            if ($udpate_user) {
                return redirect()->route('dashboard.index')->with('success', 'user status updated successfully.');
            }


            return redirect()->route('dashboard.index')->with('error', 'fail to update user status.');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}