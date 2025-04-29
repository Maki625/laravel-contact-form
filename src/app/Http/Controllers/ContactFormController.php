<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactFormRequest;
use App\Models\Category;

class ContactFormController extends Controller
{
    // フォームの表示
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }



public function submitForm(ContactFormRequest $request)
{
    $data = $request->all();

    $data['tel'] = $data['tel1'] . '-' . $data['tel2'] . '-' . $data['tel3'];

    $category = Category::find($data['inquiry_type']);
    $data['inquiry_type_name'] = $category ? $category->content : '不明';

    return view('confirm', compact('data'));
}

    public function store(Request $request)
{
    Contact::create($request->only([
        'first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'inquiry_type', 'inquiry_content'
    ]));

    return redirect('/thanks');
}

    // サンクスページ
    public function thanks()
    {
        return view('thanks');
    }

    // 管理画面一覧表示
public function adminIndex()
{
    $contacts = Contact::paginate(7);
    return view('admin', compact('contacts'));
}

}