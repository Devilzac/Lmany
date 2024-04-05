<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your Website')</title> 
    <link rel="stylesheet" href="{{ asset('css/addCharacters.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css?v=2') }}">
    <link rel="stylesheet" href="{{ asset('css/relation.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  
</head>
<body>
    <div class="layout-content">

        <h1 class="mainTitle"><a class="navbar-brand" href="{{ url('/') }}">Mystera Legacy Tracker</a></h1>
        <x-nav></x-nav>
        <input type="checkbox" name="filterToggle" id="filterToggle" />
        <label class="filterToggle" for="filterToggle">
            <img src="{{ asset('/images/toggle/shield.webp') }}" alt="">
        </label>
        <form action={{ route('character.filtersearch') }} class="d-flex filter-cnt row-wrap" role="search" method="POST">
            @csrf
            <div class="navbar">
                <div class="navbar-plus-filter">            
                    <!-- START SEARCH -->
                        <div class="cntSearch">
                            <div class="nav-filter">
                                <div class="form-group">
                                    <div class="btn-container character-type">
                                        <label class="switch btn-color-mode-switch">
                                            <input value="1" id="character-type" name="character-type" type="checkbox">
                                            <label class="btn-color-mode-switch-inner" data-off="Alt" data-on="Main" for="character-type"></label>
                                        </label>    
                                    </div>
                                </div>
                                <div class="btnAlt">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </div>
                            </div>
                        </div>           
                </div>  
            </div>
            <div class="navbar chip-cnt">
                <div class="form-group chips">    
                    @foreach ($serversList as $key => $server)    
                        @if($server->name != 'Unknown' && $key!=11)
                            <input class="server-display-chip" {{ $key==1 ? 'checked' : '' }} value="{{ $server->id }}" id="server{{ $server->name }}" name="selectedServer" type="radio">
                            <label class="server-chip" data-off="Alt" data-on="Main" for="server{{ $server->name }}">{{ $server->name }}</label>
                        @endif                            
                    @endforeach  
                </div> 
            </div>                
        </form> 
        @yield('content')
        
        <footer>
            <figure>
                <a href="https://discord.gg/cb5Evf7w5S" target="_blank">
                    <img src="{{ asset('/images/social/discord.svg') }}" alt="Discord Broadcast channel">
                    <figcaption>In collaboration with Anonym</figcaption>
                </a>
            </figure>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>