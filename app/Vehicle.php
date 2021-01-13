<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use \App\Vehicle;


class Vehicle extends Model
{
  protected $fillable = ['situacao'];


  public function getVehicle($field)
  {
    if (!is_null($field['situacao'])) {
      $vehicle = Vehicle::where('situacao', 'LIKE', '%' . $field['situacao'] . '%')
        ->get();
    }
    return $vehicle;
  }
  public function getVehicles()
  {
    $vehicles = Vehicle::all();
    return $vehicles;
  }

  public function addVehicle($field)
  {
    $vehicle = new Vehicle();
    $vehicle->driver_id = $field['driver_id'];
    $vehicle->brand = $field['brand'];
    $vehicle->model = $field['model'];
    $vehicle->placa = $field['placa'];
    $vehicle->year = $field['year'];
    // $vehicle->km = $field['km'];
    $vehicle->situacao = $field['situacao'];
    $vehicle->descricao = $field['descricao'];

    $vehicle->save();
  }
  
  // Um veículo só pode ter um motorista
  public function driver(){
    return $this->belongsTo(Driver::class);
  }

  // Um veículo tem muitos custos
  public function expenses(){
    return $this->hasMany(Expense::class);
  }

}

