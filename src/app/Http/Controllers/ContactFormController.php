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
    if ($request->return) {
        return redirect('/')->withInput();
    }

    $tel = $request->tel1 . '-' . $request->tel2 . '-' . $request->tel3;

    Contact::create([
        'first_name' => $request->first_name, 'last_name' => $request->last_name,
        'gender' => $request->gender, 'email' => $request->email,
        'tel' => $tel,
        'address' => $request->address,
        'building' => $request->building,
        'inquiry_type' => $request->inquiry_type,
        'inquiry_content' => $request->inquiry_content,
    ]);

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

// 検索ボタン
public function search(Request $request)
    {
        if ($request->has('reset')) {
            return redirect('/admin');
        }
        $query = Contact::query();

        $query = $this->getSearchQuery($request, $query);

        $contacts = $query->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

// 削除ボタン
public function destroy(Request $request)
{
    Contact::find($request->id)->delete();
    return redirect('/admin');
}

}