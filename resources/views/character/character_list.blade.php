@extends('layout')
@section('title', 'All Characters')
@section('content')
    @if (session('message'))
    <div class="alert">{{ session('message') }}</div>
    @endif    
    <div id="container" class="main-list">     
        <!-- START LIST -->
        <ul class="list-flex">
            @if (count($characters)>0)                
                @foreach ($characters as $key => $character)    
                <li>
                    <a href="{{url('/character/'.$character->id)}}">
                        <div class="charList">
                            <img class="" src="{{url('images/'.rand(1, 10).'.webp')}}" alt="{{$character->name}}">
                            <div class="mainCharInfo">
                                <span class="">
                                {{$character->name}}
                                </span>
                                <span class="">
                                    {{$character->tribe}}
                                </span>
                            </div>
                            <div class="altAmount">
                                Related: {{ count($character->relatedCharacters) }}</br>
                                Server: {{$character->server->name}}
                            </div>
                        </div>
                    </a>
                </li>    
                <hr>      
                @endforeach()  
                
                @else
                    <h3>
                        No Characters Found!
                    </h3>  
                @endif
        </ul> 
    </div>   
    <div class="out-relate">    
        @if ($characters->lastPage() > 1)
            <ul class="pagination">
                @if($characters->currentPage() > 1)
                    <li class="page-item">
                        <a href="{{ $characters->url(1) }}" class="page-link">&laquo;</a>
                    </li>
                @endif

                @for ($i = max(1, $characters->currentPage() - 2); $i <= min($characters->lastPage(), $characters->currentPage() + 4); $i++)
                    <li class="page-item {{ ($characters->currentPage() == $i) ? ' active' : '' }}">
                        <a href="{{ $characters->url($i) }}" class="page-link">{{ $i }}</a>
                    </li>
                @endfor

                @if($characters->currentPage() < $characters->lastPage())
                    <li class="page-item">
                        <a href="{{ $characters->url($characters->lastPage()) }}" class="page-link">&raquo;</a>
                    </li>
                @endif
            </ul>
        @endif
 
    </div>
@endsection