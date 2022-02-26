<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use App\Http\Resources\FileResource;
use App\Http\Resources\GroupResource;
use App\Imports\ContactImport;
use App\Models\Contact;
use App\Models\FileList;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fileLists = FileList::latest()
            ->paginate(10)
            ->appends(request()->query());

        return Inertia::render('File/Index', [
            'fileLists' => FileResource::collection($fileLists)
        ]);
    }

    /**
     * Show the form for import a new file.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        return Inertia::render('File/ImportFile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeImport(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'file' => 'required',
        ]);
        $extension = $request->file->extension();
        $name = $request->name . '.' . $extension;
        $count = count($fp = file($request->file));
        $fileList = FileList::create([
            'user_id' => Auth::user()->id,
            'file_name' => $name,
            'file_path' => $request->file('file')->storeAs('files', $name)
        ]);

        Excel::import(new ContactImport($fileList, $count), $request->file('file'));
        return redirect()->route('filelist.index')->with('success', 'File Imported');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $groups = Group::where('file_list_id', $id)->get();
        return response([
            'groups' => GroupResource::collection($groups)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getContactList($id)
    {
        $contacts = Contact::where('group_id', $id)
            ->latest()
            ->paginate(10)
            ->appends(request()->query());

        return Inertia::render('File/ContactList', [
            'contacts' => ContactResource::collection($contacts)
        ]);
    }
}
