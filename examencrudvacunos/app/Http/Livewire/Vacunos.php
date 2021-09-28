<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Vacuno;

class Vacunos extends Component
{
    public $vacunos, $nombrev, $pesov, $razav, $nacimientov, $codigov, $Vacuno_id;
    public $isOpen = false;
    public function render()
    {
        $this->vacunos = Vacuno::all();
        return view('livewire.vacunos');
    }
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }
    public function openModal()
    {
        $this->isOpen = true;
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }
    private function resetInputFields(){
        $this->nombrev = '';
        $this->pesov = '';
        $this->razav = '';
        $this->nacimientov = '';
        $this->codigov = '';
        $this->vacuno_id = '';
    }
    public function store()
    {
        $this->validate([
            'nombrev' => 'required',
            'pesov' => 'required',
            'razav' => 'required',
            'nacimientov' => 'required',
            'codigov' => 'required',
        ]);

        Vacuno::updateOrCreate(['id' => $this->vacuno_id], [
            'nombrev' => $this->nombrev,
            'pesov' => $this->pesov,
            'razav' => $this->razav,
            'nacimientov' => $this->nacimientov,
            'codigov' => $this->codigov
        ]);

        session()->flash('message',
            $this->vacuno_id ? 'Vacuno Updated Successfully.' : 'Vacuno Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }
    public function edit($id)
    {
        $vacuno = Vacuno::findOrFail($id);
        $this->vacuno_id = $id;
        $this->nombrev = $vacuno->nombrev;
        $this->pesov = $vacuno->pesov;
        $this->razav = $vacuno->razav;
        $this->nacimientov = $vacuno->nacimientov;
        $this->codigov = $vacuno->codigov;

        $this->openModal();
    }
    public function delete($id)
    {
        Vacuno::find($id)->delete();
        session()->flash('message', 'Vacuno Deleted Successfully.');
    }
}
