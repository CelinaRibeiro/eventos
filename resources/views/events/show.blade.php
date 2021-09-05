@extends('layouts.main')

@section('title', $events->title )

@section('content')

    <div class="mb-3 offset-md-1">
        <div class="row">
            <div class="col-sm-4" id="image-container">
                <img src="/img/events/{{ $events->image }}" alt="{{ $events->title }}" class="img-fluid">
            </div>
            <div class="col-sm-8"  id="info-container">
                <h1>{{ $events->title }}</h1>
                <p class="event-city"><ion-icon name="location-outline"></ion-icon>Cidade:  {{ $events->city }}</p>
                <p class="event-date"><ion-icon name="calendar-outline"></ion-icon> Início: {{ date('d/m/Y', strtotime($events->date_start)) }}</p>
                <p class="event-date"><ion-icon name="calendar-outline"></ion-icon> Término: {{ date('d/m/Y', strtotime($events->date_end)) }}</p>
                <p class="events-participants"><ion-icon name="person-outline"></ion-icon>{{ count($events->users) }} Participantes</p>
                <p class="event-owner"><ion-icon name="star-outline"></ion-icon> {{ $eventOwner['name'] }}</p>
               @if (!$hasUserJoined)
                <form action="{{ route('event.join', $events->id) }}" method="POST" >
                    @csrf
                    <a href="/events/join/{{ $events->id }}" 
                        class="btn btn-primary"
                        id="event-submit"
                        onclick="event.preventDefault();
                        this.closest('form').submit();">
                        Confirmar Presença
                    </a>
                </form>
               @else
                   <p class="already-joined-msg">Você já está participando deste evento!</p>
               @endif
                <h3>O evento conta com:</h3>
                <ul id="items-list">
                    @foreach ($events->items as $item)
                        <li><ion-icon name="checkmark-done-outline"></ion-icon>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-12"  id="description-container">
                <h3>Sobre o evento</h3>
                <p class="event-description">{{ $events->description }}</p>
            </div>
        </div>
    </div>

@endsection



