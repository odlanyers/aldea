<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function categorize()
    {
        $expenses = Expense::with('category')->where('user_id', Auth::user()->id)->get();

        $categories = Category::all();

        return view('categorize', compact('expenses', 'categories'));
    }

    public function setCategory (Request $request)
    {
        Expense::whereIn('id', $request->expense_ids)->update(['category_id' => $request->category_selector]);

        return redirect('category/categorize');
    }

    public function statistics()
    {
        $categories = Category::with('expenses')->get();

        return view('statistics', compact('categories'));
    }
}
