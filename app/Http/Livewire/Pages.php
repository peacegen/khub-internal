<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;
use App\Http\Livewire\Trix;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Str;
use Tonysm\RichTextLaravel\Livewire\WithRichTexts;

class Pages extends Component
{
    use WithPagination;
    // use WithRichTexts;

    public $slug;
    public $title;
    public $content;
    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;
    public $isSetToDefaultHomePage;
    public $isSetToDefaultNotFoundPage;

    /**
     * Validation rules
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => ['required', Rule::unique('pages', 'slug')->ignore($this->modelId)],
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
        $this->validate();
        $this->unassignDefaultHomePage();
        $this->unassignDefaultNotFoundPage();
        $modelData = $this->modelData();
        Page::create($modelData);
        $this->modalFormVisible = false;
        $this->reset();
    }

    public function read()
    {
        return Page::paginate(5);
    }

    public function update()
    {
        $this->validate();
        $this->unassignDefaultHomePage();
        $this->unassignDefaultNotFoundPage();
        Page::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
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
        $this->reset();
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
        $this->content = $data->content->toTrixHtml();
        $this->isSetToDefaultHomePage = !$data->is_default_home ? null : true;
        $this->isSetToDefaultNotFoundPage = !$data->is_default_not_found ? null : true;
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
            'is_default_home' => $this->isSetToDefaultHomePage,
            'is_default_not_found' => $this->isSetToDefaultNotFoundPage,
        ];
    }

    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    public function updatedTitle($value)
    {
        $this->slug=$this->generateSlug($value);
    }

    public function generateSlug($value)
    {
        return Str::slug($value);
    }

        /**
     * Runs everytime the isSetToDefaultHomePage
     * variable is updated.
     *
     * @return void
     */
    public function updatedIsSetToDefaultHomePage()
    {
        $this->isSetToDefaultNotFoundPage = null;
    }

    /**
     * Runs everytime the isSetToDefaultNotFoundPage
     * variable is updated.
     *
     * @return void
     */
    public function updatedIsSetToDefaultNotFoundPage()
    {
        $this->isSetToDefaultHomePage = null;
    }

    private function unassignDefaultHomePage()
    {
        if ($this->isSetToDefaultHomePage != null) {
            Page::where('is_default_home', true)->update([
                'is_default_home' => false,
            ]);
        }
    }

    /**
     * Unassigns the default 404 page in the database table
     *
     * @return void
     */
    private function unassignDefaultNotFoundPage()
    {
        if ($this->isSetToDefaultNotFoundPage != null) {
            Page::where('is_default_not_found', true)->update([
                'is_default_not_found' => false,
            ]);
        }
    }


    public function render()
    {
        return view('livewire.pages', [
            'data' => $this->read(),
        ]);
    }


}
