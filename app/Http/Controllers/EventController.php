<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\User;

use App\Http\Requests\ValidateEvent;

class EventController extends Controller
{
    public function home(Request $request) {
        //fazer a busca pelo title, date, city
        $search = request('search');

        if($search) {
            $events = Event::where('title', 'like', '%'.$search.'%')
            ->orwhere('date_start', 'like', '%'.$search.'%')
            ->orwhere('city', 'like', '%'.$search.'%')
            ->get();
        } else {
            $events = Event::all();
        }      
        return view('welcome', ['events' => $events, 'search' => $search]);
    }

    public function create() {
        return view('events.create');
    }

    public function store(ValidateEvent $request) {
        $events = new Event;
        $events->title = $request->title;
        $events->city = $request->city;
        $events->private = $request->private;
        $events->items = $request->items;
        $events->description = $request->description;
        $events->free = $request->free;
        $events->date_start = $request->date_start;
        $events->date_end = $request->date_end;

        //upload image
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            //cria a extensão
            $extension = $requestImage->extension();

            //gera um nome
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            //salvo no servidor na pasta img/events
            $requestImage->move(public_path('img/events'), $imageName);

            $events->image = $imageName;
        }

        //pega o usuário logado
        $user = auth()->user();
        $events->user_id = $user->id;

        $events->save();
        return redirect()
            ->route('home')
            ->with('message', "Evento cadastrado com sucesso!");      
    }

    public function show($id) {
        $events = Event::findOrFail($id);

        //user participando do evento
        $user = auth()->user();
        $hasUserJoined = false;

        if($user) {
            $userEvents = $user->eventsAsParticipant->toArray();

            foreach($userEvents as $userEvent) {
                if($userEvent['id'] == $id) {
                    $hasUserJoined = true;
                }
            }
        }


        $eventOwner = User::where('id', $events->user_id )->first()->toArray(); //pefa o 1º user q ele encontrar e exibe no array
            return view('events.show', ['events' => $events, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard() {
        //user logado e seus respectivos eventos
        $user = auth()->user();
        $events = $user->events;

        //para ter acesso aos eventos que o usuário participa
        $eventsAsParticipant = $user->eventsAsParticipant;

       return view('dashboard', ['events' => $events, 'eventsAsParticipant' => $eventsAsParticipant]);
    }

    public function destroy($id) {
        $events = Event::findOrFail($id)->delete();
        
        return redirect()
        ->route('dashboard')
        ->with('message', 'Evento deletado com sucesso!');
    }

    public function edit($id) {
        $user = auth()->user();

        $events = Event::findOrFail($id);

        if ($user->id != $events->user_id) {
            return redirect()
            ->route('dashboard');
        }
        return view('events.edit', compact('events'));
    }

    public function update(Request $request, $id) {
        $data = $request->all();

        //upload image
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            //cria a extensão
            $extension = $requestImage->extension();

            //gera um nome
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            //salvo no servidor na pasta img/events
            $requestImage->move(public_path('img/events'), $imageName);

            $data['image'] = $imageName;
        }

        Event::findOrFail($request->id)->update($data);

        return redirect()
        ->route('dashboard')
        ->with('message', 'Evento editado com sucesso!');

    }

    //participar do evento
    public function joinEvent($id) {
        $user = auth()->user();  //user logado 

        //salvar o user ao evento
        $user->eventsAsParticipant()->attach($id); //insere o id do evento no id do usuário p/o o metodo e preencher a coluna
        
        $events = Event::findOrFail($id);

        return redirect()
        ->route('dashboard')
        ->with('message', 'Sua presença foi confirmada no evento: '.$events->title );
    }

    public function leaveEvent($id) {
        $user = auth()->user();

        $user->eventsAsParticipant()->detach($id); //retira a participação do user no evento

        $event = Event::findOrFail($id);

        return redirect()
        ->route('dashboard')
        ->with('message', 'Você deixou de participar do evento '.$user->title);

    }
}
