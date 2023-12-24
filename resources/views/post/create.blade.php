<x-app-layout>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="container">
                <div class="card">
                    <div class="card-header d-flex">
                        <b>Create Posts</b>
                        <a href="{{ route('posts.index') }}" class="btn btn-primary btn-sm ml-auto" >All Post</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data" >
                            @csrf

                            <div class="form-group">
                                <label for="title">Tilte</label>
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control" >
                                @error('title')
                                <span class="text-danger" >{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-control">
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
                                <textarea name="body" class="form-control" rows="5">{{ old('body') }}</textarea>
                                @error('body')
                                <span class="text-danger" >{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control" >
                                @error('image')
                                <span class="text-danger" >{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="text-center">
                                <input type="submit" style="background-color: rebeccapurple" class="btn btn-primary" name="save" value="Add Post">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
