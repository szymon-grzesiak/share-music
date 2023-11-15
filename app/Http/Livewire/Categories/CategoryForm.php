<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;

class CategoryForm extends Component
{
    use Actions;

    public Category $category;
    public Bool $editMode;

    public function rules()
    {
        return [
            'category.name' => [
                'required',
                'string',
                'min:2',
                'unique:categories,name' .
                ($this->editMode
                    ? (',' . $this->category->id)
                    : ''
                ),
            ],
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => Str::lower(
                __('categories.attributes.name')
            ),
        ];
    }

    public function mount(Category $category, Bool $editMode)
    {
        $this->category = $category;
        $this->editMode = $editMode;
    }

    public function render()
    {
        return view('livewire.categories.category-form');
    }

    /**
     * Walidacja na żywo
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        sleep(1);   // tymczasowo, celem pokazania opóźnienia
        $this->validate();
        $this->category->save();
        $this->notification()->success(
            $title = $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('categories.messages.successes.updated', ['name' => $this->category->name])
                : __('categories.messages.successes.stored', ['name' => $this->category->name])
        );
        $this->editMode = true;
        // opcjonalne przekierowanie na inny adres URL
        // return redirect()->route('categories.index');
    }
}
