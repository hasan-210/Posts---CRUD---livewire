<div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if($updateMode)
             @include('livewire.edit-post')
        @elseif($createMode)
               @include('livewire.create-post')
        @elseif($showMode)
               @include('livewire.show-post')
        @endif

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="container">
                    <div class="card">
                        <div class="card-header d-flex">
                            <b>Posts</b>
                            <a href="javascript:void(0);" wire:click="create_post" style="margin-left: 800px" class="btn btn-primary" >Create Post</a>
                        </div>
                        <div class="card-body">
                           <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Image</td>
                                        <td>Title</td>
                                        <td>Owner</td>
                                        <td>Category</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                    <tr>
                                        <td>
                                            @if ($post->image != '')
                                               <img src="{{ asset('assets/images/'.$post->image) }}" alt="{{ $post->title }}" width="100px" height="100px" >
                                            @endif
                                        </td>
                                        <td> <a href="javascript:void(0);" wire:click="show_post({{ $post->id }})">{{ $post ->title }}</a></td>
                                        <td>{{ $post ->user->name }}</td>
                                        <td>{{ $post ->category->name }}</td>
                                        <td>
                                            <button wire:click="edit({{ $post->id }})" class="btn btn-primary btn-sm">Edit</button>
                                            <button wire:click="delete({{ $post->id }})" class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                           </div>
                            <div class="float-right">
                                {!! $posts->links() !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

</div>
