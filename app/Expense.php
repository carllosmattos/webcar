<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
  protected $table = "expenses";
  protected $fillable = ['name_expense'];
  public function getExpense($field)
  {
    if (!is_null($field['name_expense'])) {
      $expense = Expense::where('name_expense', 'LIKE', '%' . $field['name_expense'] . '%')
        ->orderBy('id', 'DESC')->get();
    } elseif (!is_null($field['data'])) {
      $expense = Expense::where('data', 'LIKE', '%' . $field['data'] . '%')
        ->orderBy('id', 'DESC')->get();
    }

    return $expense;
  }

  public function getExpenses()
  {
    $expenses = Expense::all();
    return $expenses;
  }

  public function addExpense($field)
  {
    $expense = new Expense();
    $expense->name_expense = $field['name_expense'];
    $expense->category_id = $field['category_id'];
    $expense->unitary_value = $field['unitary_value'];
    $expense->amount = $field['amount'];
    $expense->discount = $field['discount'];
    $expense->data = $field['data'];
    if (!isset($field['vehicle_id'])) {
      $expense->vehicle_id = 1;
    } else {
      $expense->vehicle_id = $field['vehicle_id'];
    }


    $expense->save();
  }

  // Custo pertence a veículo
  public function vehicle()
  {
    return $this->belongsTo(Vehicle::class);
  }

  public function categories()
  {
    return $this->belongsToMany(Category::class);
  }
}
