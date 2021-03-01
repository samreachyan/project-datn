<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnterpriseController extends Controller
{
    public function erp_dashboard() {
        return view('application.enterprise.erp-dashboard');
    }

    public function crm_dashboard() {
        return view('application.enterprise.crm-dashboard');
    }

    public function hr_dashboard() {
        return view('application.enterprise.hr-dashboard');
    }

    public function employees() {
        return view('application.enterprise.employees');
    }

    public function staff() {
        return view('application.enterprise.staff');
    }

    public function leaves() {
        return view('application.enterprise.leaves');
    }
}
