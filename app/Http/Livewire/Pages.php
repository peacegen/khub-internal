<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;
use App\Http\Livewire\Trix;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class Pages extends Component
{
    use WithPagination;

    public $slug;
    public $title;
    public $content;
    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;

//    public $listeners = [
//        Trix::EVENT_VALUE_UPDATED // trix_value_updated()
//    ];
//
//    public function trix_value_updated($value){
//        $this->content = $value;
//    }

    /**
     * Validation rules
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => ['required', Rule::unique('pages', 'slug')],
            'content' => 'required',
        ];
    }

    public function mount()
    {
        // Resets pagination after reloading the page
        $this->resetPage();
    }

    public function create()
    {
        $this->validate($this->rules());
        Page::create($this->modelData());
        $this->modalFormVisible = false;
        $this->clearVars();
    }

    public function read()
    {
        return Page::paginate(5);
    }

    public function update()
    {
        $this->validate($this->rules());
        Page::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
        $this->clearVars();
    }

    public function delete()
    {
        Page::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    /**
     * Shows the form modal
     * @return void
     */
    public function createShowModal()
    {
        $this->clearVars();
        $this->resetValidation();
        $this->modalFormVisible = true;
    }

    /**
     * Shows the modal and updates it
     * @param $id the id of the model to update
     * @return void
     */
    public function updateShowModal($id)
    {
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->loadModel();
    }

    /**
     * Loads the model based on the modelId variable
     * @return void
     */
    private function loadModel()
    {
        $data = Page::find($this->modelId);
        $this->title = $data->title;
        $this->slug = $data->slug;
        $this->content = $data->content;
    }

    /**
     * Returns the model data
     * @return array
     */
    public function modelData()
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
        ];
    }

    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    public function clearVars()
    {
        $this->title = null;
        $this->slug = null;
        $this->content = null;
        $this->modelId = null;
    }

    public function updatedTitle($value)
    {
        $this->slug=$this->generateSlug($value);
    }

    public function generateSlug($value)
    {
        $process1 = str_replace(' ','-', $value);
        $process2 = strtolower($process1);
        return $process2;
    }

    public function render()
    {
        return view('livewire.pages', [
            'data' => $this->read(),
        ]);
    }


}
