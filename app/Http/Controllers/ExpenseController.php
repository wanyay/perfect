<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Expense;

use App\Category;

class ExpenseController extends Controller
{
    public function index()
    {
      $expenses = Expense::orderBy('created_at', 'desc')->get();
      return view('expense.index',compact('expenses'));
    }

    public function create()
    {
      $categories= Category::pluck('name','id');
      return view('expense.create',compact('categories'));
    }

    public function store(Request $request)
    {
      $expense = new Expense();
      
      $expense->category_id = $request->category_id;
      $expense->amount  = $request->amount;
      $expense->created_at = $request->created_at;
      $expense->save();

      $expense ? flash()->success('Success','New Expense has been added.') : flash()->error('Error','Something is wrong!');

      return redirect()->action('ExpenseController@index');
    }

    public function edit($id)
    {
      $expense = Expense::with(['category'])->findOrfail($id);
      $categories = Category::pluck('name','id');
      $category_selected = [$expense->category->id];
      return view('expense.edit',compact('expense','categories','category_selected'));
    }

     public function update($id,Request $request)
    {
      $expense = Expense::findOrFail($id);

      $expense->update($request->all());

      flash()->success('Updated','Expense has been updated.');

      return redirect()->action('ExpenseController@index');
    }

    public function destroy($id)
    {
      $expense = Expense::destroy($id);
      return $expense;
    }
}
