<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Tags extends Component
{
    use WithPagination;

    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;

    /**
     * Put your custom public properties here!
     */

     public $name;
     public $description;

    /**
     * The validation rules
     *
     * @return void
     */
    public function rules()
    {
        return [
            'name' => ['required', Rule::Unique('tags', 'name')->ignore($this->modelId)],
        ];
    }

    /**
     * Loads the model data
     * of this component.
     *
     * @return void
     */
    public function loadModel()
    {
        $data = Tag::find($this->modelId);
        // Assign the variables here
    }

    /**
     * The data for the model mapped
     * in this component.
     *
     * @return void
     */
    public function modelData()
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
        ];
    }

    /**
     * The create function.
     *
     * @return void
     */
    public function create()
    {
        $this->validate();
        Tag::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }

    /**
     * The read function.
     *
     * @return void
     */
    public function read()
    {
        return Tag::paginate(5);
    }

    /**
     * The update function
     *
     * @return void
     */
    public function update()
    {
        $this->validate();
        Tag::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    /**
     * The delete function.
     *
     * @return void
     */
    public function delete()
    {
        Tag::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    /**
     * Shows the create modal
     *
     * @return void
     */
    public function createShowModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    /**
     * Shows the form modal
     * in update mode.
     *
     * @param  mixed $id
     * @return void
     */
    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
        $this->modelId = $id;
        $this->loadModel();
    }

    /**
     * Shows the delete confirmation modal.
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    public function render()
    {
        return view('livewire.tags', [
            'data' => $this->read(),
        ]);
    }
}
