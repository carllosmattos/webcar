<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use DB;

class ChartController extends Controller
{
  public function costByVehicle(Request $field)
  {
    $vehicle = DB::table('vehicles')
      ->where('brand', '!=', 'Não atribuído')
      ->select(
        DB::raw('id as id'),
        DB::raw('brand as brand'),
        DB::raw('model as model'),
        DB::raw('placa as placa')
      )->get();

    foreach ($vehicle as $key => $value) {
      $expense_vehicle[++$key] = [$value->id, $value->brand, $value->model, $value->placa];
    }

    foreach ($vehicle as $data) {
      $wheelsetsKm[] = DB::table('expenses')
        ->where('category_id', '=', '2')->get()
        ->where('vehicle_id', '=', $data->id)
        ->sum('amount_paid');
      $fuel[] = DB::table('expenses')
        ->where('category_id', '=', '1')->get()
        ->where('vehicle_id', '=', $data->id)
        ->sum('amount_paid');
      $maintenance[] = DB::table('expenses')
        ->where('category_id', '=', '3')->get()
        ->where('vehicle_id', '=', $data->id)
        ->sum('amount_paid');
    };

    for ($i = 1; $i <= count($vehicle); $i++) {
      array_push($expense_vehicle[$i], $wheelsetsKm[$i - 1]);
      array_push($expense_vehicle[$i], $fuel[$i - 1]);
      array_push($expense_vehicle[$i], $maintenance[$i - 1]);
    }
    return view('chart/cost_by_vehicle')->with('expenses', json_encode($expense_vehicle));
  }

  public function searchVeicleIntervalDate(Request $field)
  {
    if (!is_null($field['datainicio']) && !is_null($field['datafim'])) {
      $vehicle = DB::table('vehicles')
        ->where('brand', '!=', 'Não atribuído')
        ->select(
          DB::raw('id as id'),
          DB::raw('brand as brand'),
          DB::raw('model as model'),
          DB::raw('placa as placa')
        )->get();

      foreach ($vehicle as $key => $value) {
        $expense_vehicle[++$key] = [$value->id, $value->brand, $value->model, $value->placa];
      }

      foreach ($vehicle as $data) {
        $wheelsetsKm[] = DB::table('expenses')
          ->where('category_id', '=', '2')
          ->where('updated_at', '>=', $field['datainicio'] . ' ' . '00:00:00')
          ->where('updated_at', '<=', $field['datafim'] . ' ' . '23:59:99')->get()
          ->where('vehicle_id', '=', $data->id)
          ->sum('amount_paid');
        $fuel[] = DB::table('expenses')
          ->where('category_id', '=', '1')
          ->where('updated_at', '>=', $field['datainicio'] . ' ' . '00:00:00')
          ->where('updated_at', '<=', $field['datafim'] . ' ' . '23:59:99')->get()
          ->where('vehicle_id', '=', $data->id)
          ->sum('amount_paid');
        $maintenance[] = DB::table('expenses')
          ->where('category_id', '=', '3')
          ->where('updated_at', '>=', $field['datainicio'] . ' ' . '00:00:00')
          ->where('updated_at', '<=', $field['datafim'] . ' ' . '23:59:99')->get()
          ->where('vehicle_id', '=', $data->id)
          ->sum('amount_paid');
      };

      for ($i = 1; $i <= count($vehicle); $i++) {
        array_push($expense_vehicle[$i], $wheelsetsKm[$i - 1]);
        array_push($expense_vehicle[$i], $fuel[$i - 1]);
        array_push($expense_vehicle[$i], $maintenance[$i - 1]);
      }
      return view('chart/cost_by_vehicle')->with('expenses', json_encode($expense_vehicle));
    } else {
      return $this->costByVehicle($field);
    }
  }

  public function costBySector()
  {
    $sector = DB::table('solicitacoes')
      ->join('sectors', 'solicitacoes.namesolicitante', '=', 'sectors.cc')
      ->select('sectors.sector as sec', DB::raw('SUM(kmtotal) as total'))
      ->groupBy('sec')
      ->get();

    $expense_sector[] = ['Setor', 'km´s rodados'];
    foreach ($sector as $key => $value) {
      $expense_sector[++$key] = [$value->sec, intval($value->total)];
    }

    // dd($expense_sector);

    return view('chart/cost_by_sector')->with('sectors', json_encode($expense_sector));
  }

  public function searchSectorIntervalDate(Request $field)
  {
    if (!is_null($field['datainicio']) && !is_null($field['datafim'])) {

      $sector = DB::table('solicitacoes')
        ->where('updated_at', '>=', $field['datainicio'] . ' ' . '00:00:00')
        ->where('updated_at', '<=', $field['datafim'] . ' ' . '23:59:99')
        ->join('sectors', 'solicitacoes.namesolicitante', '=', 'sectors.cc')
        ->select('sectors.sector as sec', DB::raw('SUM(kmtotal) as total'))
        ->groupBy('sec')
        ->get();

      $expense_sector[] = ['Setor', 'km´s rodados'];
      foreach ($sector as $key => $value) {
        $expense_sector[++$key] = [$value->sec, intval($value->total)];
      }

      return view('chart/cost_by_sector')->with('sectors', json_encode($expense_sector));
    } else {
      return $this->costBySector($field);
    }
  }
}
