<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{

    private $expense;

    public function __construct(Expense $expense)
    {
        $this->expense = $expense;
        $this->expenses = $expense;
        $this->middleware('auth');
    }

    //-------------------- Adicionar Custo --------------------//
    // Cadastrar custo livre
    public function get_add_expense_livre(Request $field)
    {
        return view('expense/add_free_expense');
    }

    // Cadastrar custo a partir de um veículo
    public function get_add_expense(Request $field)
    {
        $vehicles = \App\Vehicle::all(['id', 'model', 'brand', 'placa']);
        return view('expense/add_expense', compact('vehicles'));
    }

    public function post_add_expense(Request $request)
    {

        $expense = $this->expense->addExpense($request);
        return redirect()->route('expenses')->with('message', 'Custo adicionado com sucesso!');;
    }

    //---------------- Listar CUSTO específico -----------------//

    public function get_list_expense()
    {
    }

    public function post_list_expense(Request $field)
    {
        if (!is_null($field['name_expense']) || !is_null($field['data'])) {
            $vehicles = \App\Vehicle::all(['id', 'model', 'brand', 'placa']);
            $expenses = $this->expenses->getExpense($field);
        } else {
            $vehicles = \App\Vehicle::all(['id', 'model', 'brand', 'placa']);
            $expenses = $this->expenses->getExpenses()->sortByDesc("id");
        }
        return view('expense/list_expense', compact('expenses', 'vehicles'));
    }

    //--------------------- Listar Custos ----------------------//
    public function list_expenses()
    {
        $vehicles = \App\Vehicle::all(['id', 'model', 'brand', 'placa']);
        $expenses = $this->expenses->orderBy('created_at', 'desc')->get();
        return view('expense/list_expense', compact('expenses', 'vehicles'));
    }

    //-------------------- Editar Custos --------------------//
    public function get_edit_expense($id)
    {
        $vehicles = \App\Vehicle::all(['id', 'model', 'brand', 'placa']);
        $expense = $this->expense->find($id);
        return view('expense/edit_expense', compact('expense', 'vehicles'));
    }

    public function post_edit_expense(Request $info, $id)
    {
        $expense = $this->expense->find($id);
        $expense->name_expense  = $info['name_expense'];
        $expense->category_id  = $info['category_id'];
        $expense->unitary_value = $info['unitary_value'];
        $expense->amount = $info['amount'];
        $expense->discount  = $info['discount'];
        $expense->data = $info['data'];
        $expense->hora = $info['hora'];
        $expense->save();
        return redirect()->route('expenses')->with('message', 'Veiculo alterado com sucesso!');;
    }

    //-------------------- Deletar Custos --------------------//
    public function delete_expense($id)
    {
        $expense = $this->expense->find($id);
        $expense->delete();
        return redirect()->route('expenses')->with('message', 'Veiculo excluído com sucesso!');
    }
}
