<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Login | Ecossistema</title>
    </head>
    <body>
        <header>
            <nav>
                <div class="nav-wrapper light-blue darken-4"></div>
            </nav>
        </header>
        <div class="container">
            <div class="section">
                <h1>Ecossistema</h1>
            </div>
            <div class="divider"></div>
        </div>
        <div class="container">
            <div class="card-panel">
                <div class="row">
                  <form id="form" class="col s12 center-align" action="{{route('acesso.autenticacao')}}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="section">
                            <h6>Bem-vindo ao Ecossistema</h6>
                        </div>
                        <div class="divider"></div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input name="email" id="email" type="email" data-length="50">
                        <label for="email">E-mail</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input name="senha" id="senha" type="password" data-length="50">
                        <label for="senha">Senha</label>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <button title="Entrar" id="entrar" class="btn light-blue darken-4" type="button" name="action">Entrar</button>
                        </div>
                    </div>
                  </form>
                </div>              
            </div>
            <div class="center">
                <p>© 2019 Desenvolvido por Miqueias Matias Caetano - Todos os direitos reservados</p>
                <a href="https://www.facebook.com/miqueiasmatiascaetano" target="_blank">Facebook</a> | <a href="https://www.linkedin.com/in/miqueias-matias-caetano-21902068/" target="_blank">LinkedIn</i></a>
            </div>
        </div>     
        <!--JavaScript at end of body for optimized loading-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                M.updateTextFields();
                $('.sidenav').sidenav();

                $( "#entrar" ).click(function() {
                    if ($('#email').val() === '') {
                        M.toast({html: 'Informe seu e-mail!'});
                    }else if($('#senha').val() === ''){
                        M.toast({html: 'Informe sua senha!'});
                    }else{
                        $('#form').submit();
                    }
                });
            });
        </script>
    </body>
</html>
