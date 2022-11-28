<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class EditPage extends Component
{

    use WithFileUploads;

    public $urlslug;
    public $is_new;
    public $page;
    public $tag_list;

    public $title;
    public $content;
    public $slug;
    public $tags = [];
    public $files;
    public $thumbnail;
    public $thumbnail_url;

    public function mount($urlslug = null)
    {
        $this->urlslug = $urlslug;
        if ($this->urlslug == null) {
            $this->is_new = true;
        } else {
            $this->is_new = false;
        }
        if (!$this->is_new) {
            $this->loadModel($this->urlslug);
        } else {
            $this->title = "";
            $this->content = "";
            $this->slug = "";
            $this->tags = [];
        }
        $this->tag_list = Tag::all()->pluck('name')->toArray();
    }

    /**
     * Validation rules
     *
     * @return array
     */
    public function rules()
    {
        if($this->is_new){
            return [
                'title' => 'required',
                'slug' => 'required|unique:pages,slug',
                'content' => 'required',
                'thumbnail' => 'image|nullable',
            ];
        } else {
            return [
                'title' => 'required',
                'slug' => ['required', Rule::unique('pages', 'slug')->ignore($this->page->id)],
                'content' => 'required',
                'thumbnail' => 'image|nullable',
            ];
        }
    }

    public function loadModel($slug)
    {
        $model = Page::where('slug', $slug)->first();
        $this->page = $model;
        $this->title = $model->title;
        $this->slug = $model->slug;
        $this->content = $model->content;
        $this->tags = $model->tags->pluck('name')->toArray();
        $this->thumbnail = $model->thumbnail;
        $this->thumbnail_url = $model->thumbnail_url;
    }

    public function create()
    {
        $this->validate();
        $page = new Page();
        $page->title = $this->title;
        $page->slug = Str::slug($this->slug);
        $page->content = $this->content;
        $page->save();
        $page->tags()->sync(Tag::whereIn('name', $this->tags)->get());
        if ($this->files){
            foreach ($this->files as $file) {
                $page->addMedia($file->getRealPath())
                    ->usingName($file->getClientOriginalName())
                    ->toMediaCollection('files');
            }
        }
        if ($this->thumbnail) {
            $page->addMedia($this->thumbnail->getRealPath())
                ->toMediaCollection('thumbnail');
        }
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Page Created!']);
        return redirect()->to('/pages/' . $page->slug);
    }

    public function update()
    {
        $this->validate();
        $this->page->tags()->sync(Tag::whereIn('name', $this->tags)->get());
        if ($this->files){
            foreach ($this->files as $file) {
                $this->page->addMedia($file->getRealPath())
                    ->usingName($file->getClientOriginalName())
                    ->toMediaCollection('files');
            }
        }
        if ($this->thumbnail){
            $this->page->addMedia($this->thumbnail->getRealPath())
            ->usingFileName(Str::random(32) . '.' . $this->thumbnail->getClientOriginalExtension())
            ->toMediaCollection('thumbnail');
        }
        $this->page->update($this->modelData());
        session()->flash('flash.banner', 'Page saved successfully');
        session()->flash('flash.bannerStyle', 'success');
        redirect()->to('/pages/'.$this->page->slug);
    }

    public function modelData(){
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'has_tags' => count($this->tags) > 0,
        ];
    }

    /**
     * Loads all Tags in a list
     */
    public function tag_list(){
        return Tag::all()->pluck('name')->toArray();
    }

    public function cancel(){
        return redirect()->route('pages.index');
    }

    public function updatedTitle($value)
    {
        $this->slug=$this->generateSlug($value);
    }

    public function generateSlug($value)
    {
        return Str::slug($value);
    }

    public function render()
    {
        return view('livewire.edit-page');
    }
}
