<?php

namespace App\Livewire\Backend;

use App\Models\Category;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryLivewire extends Component
{
    use WithPagination;

    #[Rule('required|min:3')]
    public $category_name = '';

    public $description = '';
    public $search = '';

    public $editingCategoryId;
    #[Rule('required|min:3')]
    public $editingCategoryName;
    public $editingCategoryDescription;

    public function create()
    {
        //Validate

        $validated = $this->validate();
        //Create category
        Category::create([
            'category_name' => $this->category_name,
            'description' => $this->description
        ]);
        // Reset
        $this->reset('category_name');
        $this->reset('description');
        $this->resetPage();
        session()->flash('success','Saved.');
    }
    public function delete($categoryId)
    {
        try {
            Category::findOrFail($categoryId)->delete();
        }
        catch (\Exception $exception)
        {
            session()->flash('error','Fail to delete');
        }
    }

    public function cancelEdit()
    {
        $this->reset('editingCategoryId');
        $this->reset('editingCategoryName');
        $this->reset('editingCategoryDescription');
    }
    public function update($categoryId)
    {
        $this->validateOnly('editingCategoryName');
        $category = Category::find($categoryId);
        $category->category_name = $this->editingCategoryName;
        $category->description = $this->editingCategoryDescription;
        $category->save();
        $this->cancelEdit();
    }
    public function toggle($categoryId)
    {
        $category = Category::find($categoryId);
        $category->completed = !$category->completed;
        $category->save();

    }
    public function edit($categoryId)
    {
        $category = Category::find($categoryId);
        $this->editingCategoryId = $categoryId;
        $this->editingCategoryName = $category->category_name;
        $this->editingCategoryDescription = $category->description;
    }
    public function render()
    {
        $categories = Category::latest()
                    ->where('category_name','LIKE',"%{$this->search}%")
                    ->paginate(5);
        return view('livewire.backend.category-livewire',['categories'=>$categories]);
    }
}
