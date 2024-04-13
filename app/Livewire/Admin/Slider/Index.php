<?php

namespace App\Livewire\Admin\Slider;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;

    public $title;

    public $description;

    public $image;

    public $old_image;

    public $new_image;
    public $new_image1;

    public $status;

    public $slider;

    public function storeSlider()
    {
        $this->validate([
            'title' => 'required|string',
            'description' => 'required|string|max:255',
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);

        if ($this->image) {
            $image = $this->image->store('public/uploads/Sliders');
        }

        Slider::create([
            'title' => $this->title,
            'description' => $this->description,
            'image' => $image,
            'status' => $this->status == true ? '1' : '0',

        ]);

        $this->reset();
        session()->flash('success', 'Slider Successfully Created');
        $this->dispatch('close-modal');
    }

    public function editSlider(Slider $slider)
    {
        $this->slider = $slider;
        $this->title = $slider->title;
        $this->description = $slider->description;
        $this->status = $slider->status == '1' ? true : false;
        $this->old_image = $slider->image;

    }

    public function updateSlider()
    {
        $this->validate([
            'title' => 'required|string',
            'description' => 'required|string|max:255',
            'image' => 'nullable|mimes:png,jpg,jpeg',
        ]);

        $image = $this->slider->image;
        if ($this->new_image) {
            if (Storage::exists($this->old_image)) {
                Storage::delete($this->old_image);
            }
            $image = $this->new_image->store('public/uploads/Sliders');
            

        }
        $this->slider->update([
            'title' => $this->title,
            'description' => $this->description,
            'image' => $image,
            'status' => $this->status == true ? '1' : '0',
        ]);

        $this->reset();
        session()->flash('success', 'Slider Successfully Updated');
        $this->dispatch('close-modal');
    }

    public function deleteSlider($slider)
    {
        $this->slider = $slider;
    }

    public function destroySlider()
    {

        $slider = Slider::findOrFail($this->slider);
        if($slider->image){
                if(Storage::exists($slider->image)){
                    Storage::delete($slider->image);
                }
            }
        $slider->delete();
        session()->flash('success', 'Slider Successfully Deleted');
        $this->dispatch('close-modal');

    }

    public function render()
    {
        $sliders = Slider::paginate(10);

        return view('livewire.admin.slider.index', compact('sliders'))->extends('layouts.admin')->section('content');
    }
}