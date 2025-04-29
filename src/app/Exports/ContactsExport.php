<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactsExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Contact::query();

        if ($this->request->filled('keyword')) {
            $query->where(function($q) {
                $q->where('name', 'like', '%'.$this->request->keyword.'%')
                  ->orWhere('email', 'like', '%'.$this->request->keyword.'%');
            });
        }

        if ($this->request->filled('gender') && $this->request->gender !== 'all') {
            $query->where('gender', $this->request->gender);
        }

        if ($this->request->filled('type')) {
            $query->where('type', $this->request->type);
        }

        if ($this->request->filled('date')) {
            $query->whereDate('created_at', $this->request->date);
        }

        return $query->get(['id', 'name', 'email', 'gender', 'type', 'created_at']);
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Email', 'Gender', 'Type', 'Created At'];
    }
}
