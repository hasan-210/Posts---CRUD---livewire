<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;
    use WithFileUploads;

    public  $post , $title, $body, $post_id,$category,$image;
    public $updateMode = false;
    public $createMode = false;
    public $showMode = false;

    public function render()
    {
        $posts = Post::with(['user', 'category'])->orderBy('id', 'desc')->paginate(5);
        $categories = Category::all();

        return view('livewire.posts', [
            'posts' => $posts,
            'categories' => $categories,
        ]);

    }




    public function resetInputFields(){
        $this->title = '';
        $this->body = '';
        $this->category= '';
        $this->reset('image');
    }

    public function create_post(){
        $this->showMode = false ;
        $this ->createMode = true ;
    }


    public function store()
    {
        $validatedDate = $this->validate([
            'title' => 'required|max:255',
            'category' => 'required',
            'body' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,svg,gif|max:20000',
        ]);
        $filename =time().$this->image->getClientOriginalName();
        $this->image->storePubliclyAs('assets/images', $filename, 'public');
        Post::create([
            'title' => $this->title,
            'body' => $this->body,
            'image' =>$filename,
            'category_id' => $this->category,
            'user_id' => Auth::id()
        ]);

        session()->flash('message', 'Post Created Successfully.');

        $this->resetInputFields();
        $this->createMode = false;
    }

    public function show_post($id){
        $post = Post::findOrFail($id);
        $this->post=$post;
        $this->showMode = true ;

    }

    public function edit($id)
    {
        $this->showMode = false ;
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->title = $post->title;
        $this->body = $post->body;
        $this->image = $post->image;
        $this->category = $post->category_id;

        $this->updateMode = true;
    }


    public function update()
    {
        $validatedDate = $this->validate([
            'title' => 'required|max:255',
            'category' => 'required',
            'body' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,svg,gif|max:20000',
        ]);
        $filename =time().$this->image->getClientOriginalName();
        $this->image->storePubliclyAs('assets/images', $filename, 'public');
        $post = Post::find($this->post_id);
        $post->update([
            'title' => $this->title,
            'body' => $this->body,
            'image' =>$filename,
            'category_id' => $this->category,
        ]);

        $this->updateMode = false;

        session()->flash('message', 'Post Updated Successfully.');
        $this->resetInputFields();
    }


    public function delete($id)
    {
        $post = Post::find($id);
        if($post->image){
            if(File::exists('assets/images/'.$post->image)){
                unlink('assets/images/'.$post->image);
            }
        }

        $post -> delete();
        session()->flash('message', 'Post Deleted Successfully.');
    }
}

