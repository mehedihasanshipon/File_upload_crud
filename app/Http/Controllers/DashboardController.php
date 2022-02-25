<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\FileList;
use App\Models\Group;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $totalFiles = FileList::count();
        $totalGroups = Group::count();
        $totalContacts = Contact::count();
        return Inertia::render('Dashboard',[
            'totalFiles' => $totalFiles,
            'totalGroups' => $totalGroups, 
            'totalContacts' => $totalContacts, 
        ]);
    }
}
