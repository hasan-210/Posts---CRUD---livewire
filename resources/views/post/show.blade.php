<x-app-layout>
    <br>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="container">
                    <div class="card">
                        <div class="card-header d-flex">
                            <b>Posts</b>
                            <a href="{{ route('posts.index') }}"  class="btn btn-primary btn-sm ml-auto" >All Post</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if ($post ->image != '')
                                <div class="col-12 text-center">
                                    <img src="{{ asset('assets/images/'.$post->image) }}" style="max-width: 100%" class="img-fluid" alt="{{ $post->title }}">
                                </div>
                                @endif

                                <div class="col-12 justify-content-center pt-5">
                                    <h2>{{ $post->title }}</h2>
                                    <small>{{ $post->category->name }} || By : {{ $post->user->name }}</small>

                                    <p>
                                        {!! $post->body !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
