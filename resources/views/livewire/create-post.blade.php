
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="container">
                <div class="card">
                    <div class="card-header d-flex">
                        <b>Create Posts</b>
                        {{-- <a href="{{ route('posts.index') }}" class="btn btn-primary btn-sm ml-auto" >All Post</a> --}}
                    </div>
                    <div class="card-body">
                        <form >
                            <div class="form-group">
                                <label for="title">Tilte</label>
                                <input type="text" wire:model="title" value="{{ old('title') }}" class="form-control" >
                                @error('title')
                                <span class="text-danger" >{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select wire:model="category" id="category" class="form-control">
                                    <option selected >select category . . </option>
                                    @foreach ($categories as $category)
                                       <option value="{{ $category->id }}" {{ old('title') == $category->id ? 'selected' : '' }} >{{ $category->name }} </option>
                                    @endforeach
                                </select>
                                @error('category')
                                <span class="text-danger" >{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea wire:model="body" class="form-control" rows="5">{{ old('body') }}</textarea>
                                @error('body')
                                <span class="text-danger" >{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" wire:model="image" id="image" class="form-control" >
                                @error('image')
                                <span class="text-danger" >{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button wire:click.prevent="store()" class="btn btn-success">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
