@extends('layouts.application')

@section('content')

<html>

<head>
  <title>Controle Setor</title>
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
  <script type="text/javascript">
    var graph_sectors = <?php echo $sectors; ?>;

    console.log(graph_sectors);

    google.charts.load('current', {
      'packages': ['corechart']
    });

    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable(graph_sectors);
      var options = {
        is3D: true,
        title: 'Km´s Rodados por setor'
      };
      var chart = new google.visualization.PieChart(document.getElementById('chart'));
      chart.draw(data, options);
    }
  </script>
</head>

<body>
  <br />

  <h1 class="ls-title-intro ls-ico-chart-bar-up">Custos por setor</h1>
  <div class="ls-box">
    <div class="col-md-12">
      <div class="col-md-7">
        <div class="box-header">
          <form method="post" action="{{ route('sector-cost') }}" class="form form-inline">
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
                  <a class="ls-btn-primary-danger" href="/sector-cost">Limpar</a>
                </div>
              </label>
            </fieldset>
          </form>
        </div>

        <div class="col-md-12">
          <div id="table">
            <table id="cost-by-sectors" class="display">
              <thead>
                <th>&nbsp;</th>
                <th>Setor</th>
                <th>Km's rodados</th>
              </thead>
              <tbody id="tbody">
                <tr>
                  <td>Carlos</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div id="chart" style="width: 600px; height: 350px;"></div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    var sectors = <?php echo $sectors ?>;
    var count = Object.keys(sectors).length;
    var table = document.getElementById("cost-by-sectors")[0]; // sugestão, coloque um id na tabela para usar getElementById.

    // limpar tbody

    tbody.innerHTML = "";

    //adicionar as linha na tabela
    for (var i = 1; i < count + 1; i++) {
      tbody.innerHTML += "<tr><td>" + [i] + "</td><td>" + sectors[i][0] + "</td><td>" + sectors[i][1] + "</td></tr>";
    }
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#cost-by-sectors').DataTable({
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
</body>

</html>
@stop