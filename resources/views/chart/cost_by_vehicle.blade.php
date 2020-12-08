@extends('layouts.application')

@section('content')

<html>

<head>
  <title>Controle Veiculos</title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

  <style type="text/css">
    .box {
      width: 300px;
      margin: 0 auto;
    }
  </style>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body>

  <h1 class="ls-title-intro ls-ico-chart-bar-up">Custos por veículos</h1>
  <div class="ls-box">
    <div id="section-table">
      <div class="ls-box">
        <div class="box-header">
          <form method="post" action="{{ route('vehicle-cost') }}" class="form form-inline">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <fieldset class="col-md-12">
              <div class="col-md-4"></div>
              <label class="ls-label col-md-8" style="margin-bottom: 20px;">
                <div class="col-md-4">
                  <input type="date" name="datainicio" required>
                </div>
                <div class="col-md-4">
                  <input type="date" name="datafim" required>
                </div>
                <div class="col-col-md-2">
                  <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
                <div class="col-col-md-2" style="margin-left: 5px;">
                  <a class="ls-btn-primary-danger" href="/vehicle-cost">Limpar</a>
                </div>
              </label>
            </fieldset>
          </form>
        </div>

        <div class="col-md-12">
          <div id="table">
            <table id="tab1" class="display">
              <thead>
                <th>&nbsp;</th>
                <th>ID do Veículo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Placa</th>
                <th>Km's rodados</th>
                <th>Combustível(R$)</th>
                <th>Combustível/Km's rodados</th>
                <th>Manutenção(R$)</th>
                <th>Manutenção/Km's rodados</th>
                <th>TOTAL</th>
                <th>Custo por Km Rodado</th>
              </thead>
              <tbody id="tbody">
                <tr>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="ls-box">
      <div class="col-md-12" style="height: 450px;">
        <h6>Os graficos são dinamicos a partir de filtro</h6>
        <div class="col-md-6">
          <div id="kmscharts" style="width: 700px; height: 350px;"></div>
        </div>
        <div class="col-md-6">
          <div id="costbykmcharts" style="width: 700px; height: 350px;"></div>
        </div>
      </div>
    </div>

  </div>

  <script type="text/javascript">
    var expenses = <?php echo $expenses; ?>;
    var count = Object.keys(expenses).length;
    var table = document.getElementById("tab1")[0]; // sugestão, coloque um id na tabela para usar getElementById.
    var fuel_km = 0;
    var maintenance_km = 0;
    var expense = 0

    // limpar tbody

    tbody.innerHTML = "";

    //adicionar as linha na tabela
    for (var i = 1; i < count + 1; i++) {
      var total = (expenses[i][5] + expenses[i][6]).toFixed(2)

      if (expenses[i][0] == 1 || expenses[i][4] == 0) {
        fuel_km = (0).toFixed(2)
        maintenance_km = (0).toFixed(2)
        expense = (0).toFixed(2)
      } else {
        fuel_km = (expenses[i][5] / expenses[i][4]).toFixed(2)
        maintenance_km = (expenses[i][6] / expenses[i][4]).toFixed(2)
        expense = (total / expenses[i][4]).toFixed(2)
      }

      tbody.innerHTML += "<tr><td>" + i +
        "</td><td>" //indice
        +
        expenses[i][0] + "</td><td>" //Id do veículo
        +
        expenses[i][1] + "</td><td>" //Marca
        +
        expenses[i][2] + "</td><td>" //Modelo
        +
        expenses[i][3] + "</td><td>" //Placa
        +
        expenses[i][4] + "</td><td>" //Kms rodados
        +
        expenses[i][5].toFixed(2) + "</td><td>" //Combustível

        +
        fuel_km + "</td><td>" // Combustivel(/)km
        +
        expenses[i][6].toFixed(2) + "</td><td>" //Manutenção
        +
        maintenance_km + "</td><td>" // Manutenção(/)km
        +
        total + "</td><td>" // TOTAL (Combustivel + Manutenção)
        +
        expense + "</td></tr>" // Custo por Km Rodado
      // + "</tr>"
    }
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#tab1').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copyHtml5',
          'excelHtml5',
          'csvHtml5',
          'pdfHtml5'
        ]
      });
    });
  </script>

  <!-- Gráficos Pizza -->
  <script type="text/javascript">
    var graph_expenses = <?php echo $expenses; ?>;
    var iterator = Object.keys(graph_expenses).length;
    var arraykeys = [];
    var arrayValues = [];

    // Iniciando array com titulo do gráfico
    var arraykms = [
      ['Custo', 'Total']
    ];

    //Criando array com string=veículos e value=kms rodados
    for (var j = 1; j < iterator + 1; j++) {
      arraykeys.push(graph_expenses[j][1] + ' ' + graph_expenses[j][2] + ' ' + graph_expenses[j][3])
      arrayValues.push(graph_expenses[j][4])
    }

    //Unindo arrays para popular gráficos
    for (var j = 0; j < iterator; j++) {
      arraykms.push([arraykeys[j], arrayValues[j]])
    }

    google.charts.load('current', {
      'packages': ['corechart']
    });

    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.arrayToDataTable(arraykms);

      var options = {
        // title: graph_expenses[2][1] + ' ' + graph_expenses[2][2] + ' ' + graph_expenses[2][3],
        title: 'KM´s RODADOS',
        is3D: true,
      };

      var chart = new google.visualization.PieChart(document.getElementById('kmscharts'));

      chart.draw(data, options);
    }
    // }
  </script>

  <script type="text/javascript">
    google.charts.load("current", {
      packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    // Iniciando array com titulo do gráfico
    var arrayCostByKm = [
      ['Custo', 'Total']
    ];

    var arrayTotalCost = [];

    //Criando array com valor de custo/km dorado(combustível + Manutenção / kms rodados)
    for (var j = 1; j < iterator + 1; j++) {
      var none = 0;
      if (isNaN(graph_expenses[j][5] + graph_expenses[j][6] / graph_expenses[j][4])) {
        none = 0;
      } else {
        none = ((graph_expenses[j][5] + graph_expenses[j][6]) / graph_expenses[j][4])
      }

      arrayTotalCost.push(none)
    }

    //Unindo arrays para popular gráficos
    for (var j = 0; j < iterator; j++) {
      arrayCostByKm.push([arraykeys[j], arrayTotalCost[j]])
    }

    console.log(arrayCostByKm)

    function drawChart() {
      var data = google.visualization.arrayToDataTable(arrayCostByKm);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1]);

      var options = {
        title: "Custo por Km Rodado",
        width: 600,
        height: 400,
        bar: {
          groupWidth: "95%"
        },
        legend: {
          position: "none"
        },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("costbykmcharts"));
      chart.draw(view, options);
    }
  </script>
</body>

</html>
@stop