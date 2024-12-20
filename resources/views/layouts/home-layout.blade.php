<!-- resources/views/layouts/login-layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ env('NOME_EMPRESA') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="app sidebar-mini " x-data="{ open: true }" :class="open ? '' : 'sidenav-toggled' ">
<!-- Navbar-->
<header class="app-header"><a class="app-header__logo" style="font-family: 'Arial Black',serif;font-size: 18px" wire:navigate.hover href="/home"><img src="{{ asset('images/logo.png') }}" style="width: 100px; height: 40px;"></a>
    <!-- Sidebar toggle button--><span x-on:click="open = ! open" style="cursor: pointer" class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></span>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown">
            <a class="app-nav__item" href="#" data-bs-toggle="dropdown" aria-label="Open Profile Menu"><i class="bi bi-person fs-4"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right me-2 fs-5"></i> Logout</a>
                </li>
            </ul>
        </li>
    </ul>
</header>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <div class="d-grid align-items-center justify-center">
            <p class="app-sidebar__user-name">{{ auth()->user()->nome_guerra }}</p>
        </div>
    </div>
    <ul class="app-menu">
        @foreach(auth()->user()->pccontroi as $Pccontroi)
            @if($Pccontroi->codrotina == 8177)
                @if($Pccontroi->codcontrole == 1 && $Pccontroi->acesso =='S')
                    <li><a class="app-menu__item some_no_mobile" href="/home"><i class="app-menu__icon bi bi-amd"></i><span class="app-menu__label">Cadastro Ocorrências</span></a></li>
                @endif
                @if($Pccontroi->codcontrole == 2 && $Pccontroi->acesso =='S')
                    <li><a class="app-menu__item some_no_mobile" href="/ocorrencia"><i class="app-menu__icon bi bi-card-text"></i><span class="app-menu__label">Listar Ocorrências</span></a></li>
                @endif
                @if($Pccontroi->codcontrole == 3 && $Pccontroi->acesso =='S')
                    <li><a class="app-menu__item some_no_mobile" href="/tipos"><i class="app-menu__icon bi bi-bar-chart-steps"></i><span class="app-menu__label">Tipos Ocorrências</span></a></li>
                @endif
            @endif
        @endforeach
    </ul>
</aside>
<main class="app-content">
    <x-livewire-alert::scripts />
    <div class="cover">
        {{ $slot }}
    </div>
</main>
<x-livewire-alert::scripts />
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('AbrirModalEditar', () => {
            $('#exampleModalEditar').modal('show');
        });

        Livewire.on('FecharModalEditar', () => {
            $('#exampleModalEditar').modal('hide');
        });

        Livewire.on('FecharModalCadastro', () => {
            $('#exampleModal').modal('hide');
        });

        Livewire.on('abrirModalOcorrencia', () => {
            $('#ModalOcorrencia').modal('show');
        });
    });


    $('#sampleTable').DataTable({
        language: {
            "sEmptyTable": "Nenhum dado disponível na tabela",
            "sInfo": "Mostrando _START_ até _END_ de _TOTAL_ entradas",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 entradas",
            "sInfoFiltered": "(filtrado de _MAX_ entradas no total)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Mostrar _MENU_ entradas",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sSearch": "Buscar:",
            "sZeroRecords": "Nenhum registro encontrado",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior"
            }
        }
    });
    document.querySelector("html").classList.add('js');
</script>
@livewireScripts
</body>
</html>

