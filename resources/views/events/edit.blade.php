@extends('layouts.main')

@section('title', 'Criar Eventos')

@section('content')
    <div class="content-general">
        @if ($errors->any()) 
            <div class="alert alert-danger" role="alert">
                <ul>
                    <h5>Ocorreu um Erro:</h5>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                </ul>
            </div>
        @endif
    </div>
   <form action="{{ route('event.update', $events->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h3 class="title">Editando Eventos</h3>
    <div class="card form-general">  
        <div class="card-body">
            <div class="row mb-3">
                <label for="image" class="col-sm-2 col-form-label">Imagem do Evento:</label>
                <div class="col-sm-10">
                    <input type="file" name="image" id="image" class="form-control" />
                    <img src="/img/events/{{ $events->image }}" alt="{{ $events->title }}" class="img-preview" />
                </div>
            </div>
            <div class="row mb-3">
                <label for="title" class="col-sm-2 col-form-label">Título:</label>
                <div class="col-sm-10">
                    <input type="text" name="title" id="title" class="form-control" value="{{ $events->title }}" />
                </div>
            </div>
            <div class="row mb-3">
                <label for="date_start" class="col-sm-2 col-form-label">Início do Evento:</label>
                <div class="col-sm-10">
                    <input type="date" name="date_start" id="date_start" class="form-control" value="{{ $events->date_start->format('Y-m-d') }}" />
                </div>
            </div>
            <div class="row mb-3">
                <label for="date_end" class="col-sm-2 col-form-label">Térmico do Evento:</label>
                <div class="col-sm-10">
                    <input type="date" name="date_end" id="date_end" class="form-control" value="{{ $events->date_end->format('Y-m-d') }}" />
                </div>
            </div>
            <div class="row mb-3">
                <label for="city" class="col-sm-2 col-form-label">Cidade:</label>
                <div class="col-sm-10">
                    <input type="text" name="city" id="city" class="form-control" value="{{ $events->city }}" />
                </div>
            </div>
            <div class="row mb-3">
                <label for="description" class="col-sm-2 col-form-label ">Descrição:</label>
                <div class="col-sm-10">
                   <textarea name="description" id="description" rows="3" class="form-control" >{{ $events->description }}</textarea>
                </div> 
            </div>

            <div class="row mb-3">
                <label for="itens" id="items" class="col-sm-2 col-form-label">Itens Disponíveis:</label>
                <div class="col-sm-10 form-check">
                    <div class="items-geral">
                        <input type="checkbox" id="accessibility" name="items[]" value="Acessibilidade" />
                        <label for="accessibility" class="col-sm-2 control-label items-geral-text">Acessibilidade</label>
                    </div>
                    <div class="items-geral">
                        <input type="checkbox" id="tigrados" name="items[]" value="Brindes" />
                        <label for="tigrados" class="col-sm-2 control-label items-geral-text">Brindes</label>
                    </div>
                    <div class="items-geral">
                        <input type="checkbox" id="certified" name="items[]" value="Certificado" />
                        <label for="certified" class="col-sm-3 control-label items-geral-text">Certificado de Participação</label>
                    </div>
                    <div class="items-geral">
                        <input type="checkbox" id="material" name="items[]" value="Material Grátis" />
                        <label for="material" class="col-sm-2 control-label items-geral-text">Material Grátis</label>
                    </div>
                    <div class="items-geral">
                        <input type="checkbox" id="drink" name="items[]" value="Bebida Grátis" />
                        <label for="drink" class="col-sm-2 control-label items-geral-text">Bebida Grátis</label>
                    </div>
                    <div class="items-geral">
                        <input type="checkbox" id="food" name="items[]" value="Open Food" />
                        <label for="food" class="col-sm-2 control-label  items-geral-text">Open Food</label> 
                    </div>                
                </div>   
            </div>

            <div class="row mb-3">
                <label for="private" class="col-sm-2 col-form-label">O evento é Privado?</label>
                <div class="col-sm-10">
                    <select name="private" id="private" class="form-select" >
                        <option selected>Selecione a opção</option>
                        <option value="0" {{ $events->private == 0 ? " selected='selected'" : ""  }}>Não</option>
                        <option value="1" {{ $events->private == 1 ? " selected='selected'" : ""  }}>Sim</option>
                    </select>
                </div>
            </div> 

            <div class="row mb-3">
                <label for="free" id="free" class="col-sm-2 col-form-label">O evento é Gratuito?</label>
                <div class="col-sm-10">
                    <select name="free" id="free-select" class="form-select" >
                        <option selected>Selecione a opção</option>
                        <option value="0" {{ $events->free == 0 ? " selected='selected'" : ""  }}>Não</option>
                        <option value="1" {{ $events->free == 1 ? " selected='selected'" : ""  }}>Sim</option>
                    </select>
                </div>
            </div> 
        </div>
    </div>
    </div>
    <input type="submit" value="Editar Evento" class="btn btn-primary btn-general"/>
   </form> 
@endsection