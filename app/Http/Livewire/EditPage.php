<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

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
    public $thumbnail;
    public $thumbnail_url;

    public function mount($urlslug = null, $is_new = false)
    {
        $this->urlslug = $urlslug;
        $this->is_new = $is_new;
        if (!$this->is_new) {
            $this->loadModel($this->urlslug);
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
        return [
            'title' => 'required',
            'slug' => ['required', Rule::unique('pages', 'slug')->ignore($this->page->id)],
            'content' => 'required',
            'thumbnail' => 'image|nullable',
        ];
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

    public function update()
    {
        $this->validate();
        $this->page->tags()->sync(Tag::whereIn('name', $this->tags)->get());
        if ($this->thumbnail){
            $this->page->addMedia($this->thumbnail)->toMediaCollection('thumbnail');
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


    public function render()
    {
        return view('livewire.edit-page')->layout('layouts.frontpage');
    }
}
