<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your Website')</title> 
    <link rel="stylesheet" href="{{ asset('css/addCharacters.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/relation.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  
</head>
<body>
    <h1><a class="navbar-brand" href="{{ url('/') }}">Mystera Legacy Tracker</a></h1>
    <x-nav></x-nav>
    <div class="navbar">
        <div class="navbar-plus-filter">            
            <!-- START SEARCH -->
            <form action={{ route('character.filtersearch') }} class="d-flex" role="search" method="GET">
                <div class="cntSearch">
                    <div class="nav-filter">
                        <div class="form-group">
                            <div class="btn-container character-type">
                                <label class="switch btn-color-mode-switch">
                                    <input value="1" id="characterType" name="characterType" type="checkbox">
                                    <label class="btn-color-mode-switch-inner" data-off="Alt" data-on="Main" for="characterType"></label>
                                </label>    
                            </div>
                        </div>
                        <div class="form-group">    
                                <select id="inputState" name="selectedServer" class="form-control char-filter">                               
                                    @foreach ($serversList as $key => $server)                                        
                                        <option {{ $key==0 ? 'selected' : '' }} value="{{ $server->id }}">{{ $server->name }}</option>
                                    @endforeach                             
                                </select>
                            </div> 
                        <div class="btnAlt">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </div>
                    </div>
                </div>
            </form>            
        </div>  
    </div>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>