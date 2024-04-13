<?php

namespace App\Livewire\Admin\Color;

use App\Models\Color;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

public $name, $code, $status, $color;


public function storeColor(){
    $this->validate([
        'name' => 'required|string',
        'code' => 'required|string',
    ]);

    Color::create([
        'name' => $this->name,
        'code' => $this->code,
        'status' => $this->status == true ? '1': '0', 
    ]);

    session()->flash('success', 'Color Successfully Created');
    $this->reset();
    $this->dispatch('close-modal');
}
    
public function editColor(Color $color){
$this->color = $color;
$this->name = $color->name;
$this->code = $color->code;
$this->status = $color->status == '1' ? true : false;
}



public function updateColor(){
    $this->validate([
        'name' => 'required|string',
        'code' => 'required|string',
    ]);
    
    $this->color->update([
        'name' => $this->name,
        'code' => $this->code,
        'status' => $this->status == true ? '1' : '0',
    ]);
    session()->flash('success', 'Color Successfully Updated');
    $this->reset();
    $this->dispatch('close-modal');
    
}

public function deleteColor($color){
    $this->color = $color;
}

public function destroyColor(){
    Color::findOrFail($this->color)->delete();
    session()->flash('success', 'Color Successfully Deleted');
    $this->dispatch('close-modal');
}


    public function render()
    {
        $colors = Color::latest()->paginate(10);
        return view('livewire.admin.color.index', compact('colors'))->extends('layouts.admin')->section('content');
    }
}