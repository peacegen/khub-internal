<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
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

    public function create($modelData)
    {
        $this->validate();
        $this->unassignDefaultHomePage();
        $this->unassignDefaultNotFoundPage();
        $modelData = $this->modelData();
        $page = Page::create($modelData);
        $page->tags()->attach(Tag::whereIn('name', $this->tags)->get());
        $this->modalFormVisible = false;
        $this->reset();
    }
}
