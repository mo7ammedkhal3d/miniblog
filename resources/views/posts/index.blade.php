@extends('layouts.mainlayout')
@include('layouts.mainMenu')
@include('layouts.header')
@section('content')
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                @foreach ($posts as $post)
                    <!-- Post preview-->
                <div class="post-preview">
                    <a href="{{route('posts.singlePost',['id' => $post->id])}}">
                        <h2 class="post-title">{{$post->title}}</h2>
                        <p class="read-more">{{$post->content}}</p>
                    </a>
                    <p class="post-meta">
                        Posted by
                        <a href="#!">{{$post->author->name}}</a>
                        on {{$dateHelper::toDate($post['date'], 'F d, Y')}}
                    </p>
                </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                @endforeach
                <!-- Pager-->
                <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
            </div>
        </div>
    </div>
@endsection
@include('layouts.footer')

