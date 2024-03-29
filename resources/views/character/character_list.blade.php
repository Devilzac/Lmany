@extends('layout')
@section('title', 'All Characters')
@section('content')
    @if (session('message'))
    <div class="alert">{{ session('message') }}</div>
    @endif    
    <div id="container">     
        <!-- START LIST -->
        <ul class="list-flex">
            @foreach ($characters as $key => $character)    
            <li>
                <a href="{{url('/main/'.$character->id)}}">
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
                            Alts: {{ count($character->relatedCharacters) }} 
                        </div>
                    </div>
                </a>
            </li>    
            <hr>      
            @endforeach()    
        </ul>   
    </div>
@endsection