@extends('layouts.main')

@section('title', 'Eventos')

@section('content')

<div class="table-index">
    <h3>Meus Eventos</h3>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Cidade</th>
                <th>Privado</th>
                <th>Gratuito</th>
                <th>Data Início</th>
                <th>Data Término</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>{{ $event->id }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->city }}</td>
                    <td>{{ $converted_res = isset ( $event->private ) ? ( $event->private ? 'sim' : 'não' ) : 'false'; }}</td>{{--convertendo boolean para string--}}
                    <td>{{ $converted_res = isset ( $event->free ) ? ( $event->free ? 'sim' : 'não' ) : 'false'; }}</td>{{--convertendo boolean para string--}}
                    <td>{{ date('d-m-Y', strtotime($event->date_start)) }}</td>{{--convertendo data para formato brasileiro R$--}}
                    <td>{{ date('d-m-Y', strtotime($event->date_end)) }}</td>{{--convertendo data para formato brasileiro R$--}}
                    <td>
                        <a href="{{ route('event.show', $event->id) }}" class="btn btn-success btn-sm"><ion-icon name="eye-outline"></ion-icon> Ver</a>
                        <a href="{{ route('event.edit', $event->id) }}" class="btn btn-info btn-sm"><ion-icon name="create-outline"></ion-icon> Editar</a>
                        <form class="d-inline" action="{{ route('event.destroy', $event->id) }}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm"><ion-icon name="trash-outline"></ion-icon> Excluir</ion-icon></button>
                        </form>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="table-index">
    <h3>Eventos que participo</h3>
    @if (count($eventsAsParticipant) > 0)
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Participantes</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eventsAsParticipant as $event)
                <tr>
                    <td>{{ $event->id }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ count($event->users) }}</td>
                    <td>
                        <a href="{{ route('event.show', $event->id) }}" class="btn btn-success btn-sm"><ion-icon name="eye-outline"></ion-icon> Ver</a>
                        <form action="{{ route('event.leave', $event->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm"><ion-icon name="trash-outline"></ion-icon> Deixar de Participar</ion-icon></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>Você ainda não está participando de nenhum evento. <a href="/">Veja todos os eventos</a></p>
    @endif
</div>

@endsection