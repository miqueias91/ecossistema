<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
   <head>
     <!--Import Google Icon Font-->
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <!--Import materialize.css-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
      <link rel="stylesheet" href="{{ asset('/css/style.css') }}">

  <!--JavaScript at end of body for optimized loading-->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>
  <script src="{{ asset('/js/jquery.maskMoney.min.js') }}"></script>

     <!--Let browser know website is optimized for mobile-->
     <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
     <title>@yield('titulo')</title>
   </head>
   <body>
     <header>
        <nav>
          <div class="nav-wrapper light-blue darken-4">
            <div class="container">
              @if(Auth::guest())
                 <li>
                  <a href="#">Login</a>
                 </li>
               @else
                 <a href="{{route('admin.inicio')}}" class="brand-logo" style="font-size: 24px;">Ecossistema</a>
               @endif
              <!--<a href="#!" class="brand-logo">Ecossistema</a>-->
              <a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i>
              </a>
              <ul class="right hide-on-med-and-down">
                <li>
                  <a title="Início" href="{{route('admin.inicio')}}">
                    <i class="material-icons">home</i>
                  </a>
                </li>
                <li>
                  <a title="Relatórios" href="#">
                    <i class="material-icons">description</i>
                  </a>
                </li>
                <li>
                  <a title="Gerenciar Empresa" href="{{route('admin.empresas.gerenciarempresas')}}">
                    <i class="material-icons">business</i>
                  </a>
                </li>
                <li>
                  <a title="Gerenciar Produtos" href="{{route('admin.produtos.gerenciarproduto')}}">
                    <i class="material-icons">devices_other</i>
                  </a>
                </li>
                <li>
                  <a title="Gerenciar Pedidos" href="{{route('admin.pedidos.gerenciarpedido')}}">
                    <i class="material-icons">assignment</i>
                  </a>
                </li>
                <li>
                  <a title="Conta" href="{{route('acesso.conta.gerenciarconta')}}">
                    <i class="material-icons">account_circle</i>
                  </a>
                </li>
                <li>
                  <a title="Sair" href="{{route('acesso.sair')}}">
                    <i class="material-icons">exit_to_app</i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>

        <ul class="sidenav" id="mobile">
          <li>
            <a title="Início" href="{{route('admin.inicio')}}">
              <i class="material-icons">home</i>Início
            </a>
          </li>
          <li>
            <a title="Relatórios" href="#">
              <i class="material-icons">description</i>Relatórios
            </a>
          </li>
          <li>
            <a title="Gerenciar Empresa" href="{{route('admin.empresas.gerenciarempresas')}}">
              <i class="material-icons">business</i>Gerenciar Empresa
            </a>
          </li>
          <li>
            <a title="Gerenciar Produtos" href="{{route('admin.produtos.gerenciarproduto')}}">
              <i class="material-icons">devices_other</i>Gerenciar Produtos
            </a>
          </li>
          <li>
            <a title="Gerenciar Pedidos" href="{{route('admin.pedidos.gerenciarpedido')}}">
              <i class="material-icons">assignment</i>Gerenciar Pedidos
            </a>
          </li>
          <li>
            <a title="Conta" href="{{route('acesso.conta.gerenciarconta')}}">
              <i class="material-icons">account_circle</i>Conta
            </a>
          </li>
          <li>
            <a title="Sair" href="{{route('acesso.sair')}}">
              <i class="material-icons">exit_to_app</i>Sair
            </a>
          </li>
        </ul>
    </header>
    <div class="container">
    @yield('conteudo')
    </div>
    @extends('layout._includes.footer')
