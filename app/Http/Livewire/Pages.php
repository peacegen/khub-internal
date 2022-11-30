<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Tonysm\RichTextLaravel\Livewire\WithRichTexts;
use Illuminate\Support\Facades\Storage;

class Pages extends Component
{
    use WithPagination;
    use WithRichTexts;
    use WithFileUploads;

    public $slug;
    public $title;
    public $content;
    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;
    public $isSetToDefaultHomePage;
    public $isSetToDefaultNotFoundPage;
    public $tags = [];
    public $img;
    /** @var array \Livewire\TemporaryUploadedFile[] */
    public $newFiles = [];

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
            'img' => 'image',
        ];
    }

    public function mount()
    {
        // Resets pagination after reloading the page
        $this->resetPage();
    }

    public function create()
    {
        return redirect()->route('create-page');
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
        $page = Page::find($this->modelId);
        $page->update($this->modelData());
        $page->tags()->sync(Tag::whereIn('name', $this->tags)->get());
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

    public function editPage($id)
    {
        $slug = Page::find($id)->slug;
        redirect()->to('/pages/'.$slug.'/edit');
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
        $this->tags = $data->tags->pluck('name')->toArray();
        $this->title = $data->title;
        $this->slug = $data->slug;
        $this->content = $data->content;
        $this->thumbnail_url = $data->thumbnail_url;
        $this->isSetToDefaultHomePage = !$data->is_default_home ? null : true;
        $this->isSetToDefaultNotFoundPage = !$data->is_default_not_found ? null : true;
    }

    public function getTagsByNames($names)
    {
        return Tag::whereIn('name', $names)->get();
    }

    public function createTag()
    {
        $this->validate();
        $this->tags = Tag::create($this->modelData());
        $this->reset();
    }

    public function readAllTagNamesAsArray()
    {
        return Tag::pluck('name')->toArray();
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
            'thumbnail_url' => $this->thumbnail_url,
            'has_tags' => count($this->tags) > 0,
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
        // dd($this->readAllTagNamesAsArray());
        return view('livewire.pages')->with([
            'data' => $this->read(),
            'tag_list' => $this->readAllTagNamesAsArray(),
        ]);
    }
}
