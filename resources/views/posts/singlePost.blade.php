@extends('layouts.mainlayout')
@include('layouts.mainMenu')
@section('content')
    <!-- Page Header-->
<header class="masthead" style="background-image: url('{{asset('assets/img/post-bg.jpg')}}')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-12 col-lg-12 col-xl-7">
                <div class="post-heading">
                    <h1><?=$post->title?></h1>
                    <span class="meta">
                        Posted by
                        <a href="#!">{{$post->author->name}}</a>
                        on {{$dateHelper::toDate($post->published_at, 'F d, Y')}}?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-7">
                <img src="{{ asset('assets/upload/posts/' . $post->imgUrl) }}" class="w-100 h-25 my-5" alt="Post Image">
                <p>{{$post->content}}</p>
            </div>
        </div>
    </div>
</article>
@endsection
@include('layouts.footer')

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{asset('assets/js/scripts.js')}}"></script>

