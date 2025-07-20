<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function dashboard()
    {
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            return $this->adminDashboard();
        }
        
        return $this->userDashboard();
    }

    /**
     * Admin dashboard view
     */
    protected function adminDashboard()
    {
        return view('admin.dashboard', [
            'adminData' => [] // Tambahkan data khusus admin jika perlu
        ]);
    }

    /**
     * Regular user dashboard view
     */
    protected function userDashboard()
    {
        return view('dashboard', [
            'userData' => [] // Tambahkan data khusus user jika perlu
        ]);
    }
}
