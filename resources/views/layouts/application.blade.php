<!DOCTYPE html>
<html class="ls-theme-green" lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta name="description" content="Insira aqui a descrição da página.">
  <link href="http://assets.locaweb.com.br/locastyle/3.10.0/stylesheets/locastyle.css" rel="stylesheet" type="text/css">
  <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->
  <link rel="stylesheet" href="css/app.css">
  <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon" />
  <title>WebCar HSJ</title>
</head>

<body>
  <div class="ls-topbar ">

    <script src="js/app.js" charset="utf-8"></script>
    <!-- Barra de Notificações -->
    <div class="ls-notification-topbar">
      <!-- Dropdown com detalhes da conta de usuário -->
      <div data-ls-module="dropdown" class="ls-dropdown ls-user-account">
        <a href="#" class="ls-ico-user">
          <span class="ls-name">{{ Auth::user()->name }}</span>
        </a>

        <nav class="ls-dropdown-nav ls-user-menu">
          <ul>
            <li><a href="{{ route('logout') }}">Sair</a></li>
          </ul>
        </nav>
      </div>
    </div>

    <!-- Nome do produto/marca com sidebar -->


    <h1 class="ls-brand-name">
      <div class="container-fluid">
        <!-- <div class="form-group col-md-6" style="width: 200px; height: 50px; top: -8px; background-color: #fff;"> -->
          <img src="{{URL::asset('images/LogoHSJ.png')}}" alt="profile Pic" style="width: 170px; height: 42px; top: -8px; background-color: #fff;">

        <!-- </div> -->

      </div>
    </h1>
  </div>

  <aside class="ls-sidebar">
    <div class="ls-sidebar-inner">
      <a href="/locawebstyle/documentacao/exemplos//pre-painel" class="ls-go-prev">
        <span class="ls-text">Voltar à lista de controle</span></a>

      <nav class="ls-menu">
        <ul>
          <!-- PÁGINA INICIAL -->
          <li><a href="/" class="ls-ico-home" title="Pagina Inicial">Pagina Inicial</a></li>
          <!-- PÁGINA INICIAL -->

          <!-- ADMINISTRATIVO -->
          @can('Manages Users')
          <li>
            <a href="#" class="ls-ico-cog" title="Veiculo">Administrativo</a>
            <ul>
              <li><a href="{{ route('users') }}">Atualizar Informações <br> Usuários</a></li>
              <li><a href="/roleuser/add">Cadastrar Papeis de <br> Usuário</a></li>
              <li><a href="{{ route('roleusers') }}">Editar Papel de Usuários</a></li>
            </ul>
          </li>
          @endcan
          <!-- ADMINISTRATIVO -->

          <!-- AUTORIZAR SOLICITAÇÕES -->
          @can('Authorize Request')
          <li>
            <a href="{{ route('authorizacoes') }}" class="ls-ico-checkmark-circle" title="Autorizacao">Autorizar Solicitações
              <small style="border: 1px solid red; padding: 0px 4px; border-radius: 50px; background-color: red; color:#fff">
                {{ App\Authorizacao::where('statussolicitacao', 'PENDENTE')
  ->where('datasaida', '>', date('Y-m-d', mktime(0, 0, 0, date('m') , 1 , date('Y'))))
  ->count() }}
              </small>
            </a>
          </li>
          @endcan
          <!-- AUTORIZAR SOLICITAÇÕES       -->

          <!-- CADASTRAR MOTORISTAS -->
          @can('Manages drivers')
          <li>
            <a href="#" class="ls-ico-user-add" title="Veiculo">Gerenciar Motoristas</a>
            <ul>
              <li><a href="/driver/add">Cadastrar Motoristas</a></li>
              <li><a href="{{ route('drivers') }}">Listagem de Motoristas</a></li>
            </ul>
          </li>
          @endcan
          <!-- CADASTRAR MOTORISTAS -->

          <!-- CADASTRAR VEÍCULOS -->
          @can('Manages drivers')
          <li>
            <a href="#" class="ls-ico-dashboard" title="Veiculo">Gerenciar Veículos</a>
            <ul>
              <li><a href="/vehicle/add">Cadastrar Veículo</a></li>
              <li><a href="{{ route('vehicles') }}">Varificar Veículos</a></li>
            </ul>
          </li>
          @endcan
          <!-- CADASTRAR VEÍCULOS -->

          <!-- CADASTRAR DESPESAS -->
          @can('Manages expenses')
          <li>
            <a href="#" class="ls-ico-plus" title="Veiculo">Gerenciar Despesas</a>
            <ul>
              <li><a href="/expense/addfree">Cadastrar Despesa para Gerador</a></li>
              <li><a href="{{ route('expenses') }}">Listar Despesas</a></li>
            </ul>
          </li>
          @endcan
          <!-- CADASTRAR DESPESAS -->

          <!-- SOLICITAR VEÍCULOS -->
          <li>
            <a href="#" class="ls-ico-code" title="Solicitacao">Solicitação de Veículos</a>
            <ul>
              <li><a href="/solicitacao/add">Solicitar Veículo</a></li>
              <li><a href="{{ route('solicitacoes') }}">Verificar Solicitações</a></li>
            </ul>
          </li>
          <!-- SOLICITAR VEÍCULOS -->

          <!-- GRÁFICOS E RELATÓRIOS -->
          @can('Access reports')
          <li>
            <a class="ls-ico-chart-bar-up" href="#">Gráficos e Indicadores</a>
            <ul>
              <li><a href="/vehicle-cost">Custos por Veículo</a></li>
              <li><a href="/sector-cost">Custos por Setor</a></li>
            </ul>
          </li>
          @endcan
          <!-- GRÁFICOS E RELATÓRIOS -->

          <!-- SOBRE -->
          <li><a class="ls-ico-book" href="/informacao/add">Sobre</a></li>
          <!-- SOBRE  -->
        </ul>
      </nav>
    </div>
  </aside>

  <main class="ls-main ">
    <div class="container-fluid">

      @yield('content')

    </div>
  </main>

  <!-- We recommended use jQuery 1.10 or up -->
  <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="http://assets.locaweb.com.br/locastyle/3.10.0/javascripts/locastyle.js" type="text/javascript"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.css" />

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script> -->
</body>

</html>