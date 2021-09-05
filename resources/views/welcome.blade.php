@extends('layouts.main')

@section('title', 'Divulga Eventos')

@section('content')
    <div id="search-container" class="col-md-12">
        <h1>Buscar por Eventos</h1>
        <form action="{{ route('home') }}"  class="search-container-area">
            <input type="text" id="search" name="search" class="form-control" />
            <input type="submit" value="Buscar" class="btn btn-primary" />
        </form>
    </div>
    <div id="events-container" class="col-md-12">
        @if ($search)
            <h2>Buscando por: {{ $search }}</h2>
        @else
            <h2>Próximos Eventos</h2>
        @endif
        <div id="cards-container" class="row">
            @foreach ($events as $event)
                <div class="card col-md-3">
                    <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="image">
                    <div class="card-body">
                        <p class="card-date">{{ date('d/m/Y', strtotime($event->date_start)) }}</p>
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-participants">{{ count($event->users) }} Participantes</p>
                        <a href="{{ route('event.show', $event->id) }}" class="btn btn-primary">Saber mais...</a>
                    </div>
                </div>
            @endforeach
            @if (count($events) == 0 && $search)
                <p>Não foi possível encontrar nenhum evento com {{ $search }}! <a href="{{ route('home') }}">Ver todos os eventos</a></p>
            @elseif(count($events) == 0)
                <p>Não há eventos disponíveis.</p>
            @endif
        </div>
    </div>
@endsection

