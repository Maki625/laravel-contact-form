<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContactsExport;
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $contacts = Contact::query();

        $query = Contact::query();

        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%'.$request->keyword.'%')
                ->orWhere('last_name', 'like', '%'.$request->keyword.'%')
                ->orWhere('email', 'like', '%'.$request->keyword.'%');
            });
        }

        if ($request->filled('gender')) {
            if ($request->gender !== 'all') {
                $query->where('gender', $request->gender);
            }
        }

        if ($request->filled('inquiry_type')) {
            $query->where('inquiry_type', $request->type);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(7);

        return view('admin', compact('contacts', 'categories'));
    }

    public function export(Request $request)
    {
        return Excel::download(new ContactsExport($request), 'contacts.csv');
    }
}

