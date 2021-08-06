<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Game as GameModel;
use Livewire\WithFileUploads;

class Game extends Component
{
    use WithFileUploads;

    public $games, $name, $url, $description, $status, $image_path, $game_id, $image;
    public $isModalCreateUpdateOpen = 0;
    public $isModalShowOpen = 0;

    public function render()
    {
        $this->games = GameModel::all();
        return view('livewire.game');
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->image_path = env('DEFAULT_IMG');
        $this->openModalCreateUpdate();
    }

    public function openModalCreateUpdate()
    {
        $this->isModalCreateUpdateOpen = true;
    }

    public function closeModalCreateUpdate()
    {
        $this->isModalCreateUpdateOpen = false;
    }

    public function openModalShow()
    {
        $this->isModalShowOpen = true;
    }

    public function closeModalShow()
    {
        $this->isModalShowOpen = false;
        $this->resetCreateForm();
    }

    private function resetCreateForm(){
        $this->name = '';
        $this->url = '';
        $this->description = '';
        $this->status = false;
        $this->image_path = '';
        $this->image = null;
    }

    public function find($id) {
        $game = GameModel::findOrFail($id);
        $this->game_id = $id;
        $this->name = $game->name;
        $this->url = $game->url;
        $this->description = $game->description;
        $this->status = $game->status;
        $this->image_path = isset($game->media[0]) ? $game->media[0]->getUrl() : env('DEFAULT_IMG');
    }

    public function show($id)
    {
        $this->find($id);
        $this->openModalShow();
    }

    public function store()
    {

        $this->validate([
            'name' => 'required|string|min:3|max:50',
            'url' => 'required|string|min:13|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean'
        ]);

        $game = GameModel::updateOrCreate(['id' => $this->game_id], [
            'name' => $this->name,
            'url' => $this->url,
            'description' => $this->description,
            'status' => $this->status,
        ]);

        if( isset($this->image) ) {
            if(isset($game->media[0])) {
                $game->clearMediaCollection($this->name);
            }
            $game->addMedia($this->image->getRealPath())->toMediaCollection($this->name);
            $game->save();
        }

        session()->flash('message', $this->game_id ? 'Game updated.' : 'Game created.');

        $this->closeModalCreateUpdate();
        $this->resetCreateForm();

    }

    public function edit($id)
    {
        $this->find($id);
        $this->openModalCreateUpdate();
    }

    public function delete($id)
    {
        GameModel::find($id)->delete();
        session()->flash('message', 'Game deleted.');
    }
}
