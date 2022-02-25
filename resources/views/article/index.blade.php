@extends('layouts.main')
@section('content')
<div class="row">
    <!-- views/includes/sidebar.blade.php -->
    <div class="col-lg-3">
        @include('includes.sidebar')
    </div>
    <!-- /.col-lg-3 -->
    <div class="col-lg-9">
        
        <!-- affiche un message de success lorsqu'un nouvel utilisateur s'inscrit ou se  connecte -->
        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        {{-- début du post --}}
        @foreach($articles as $article)
            <div class="card mt-4">
                <div class="card-body">
                    <h2 class="card-title"><a href="{{ route('articles.show', ['article'=>$article->slug]) }}">{{ $article->title }}</a></h2>
                    <p class="card-text">{{ $article->content, 50 }}</p>
                    
                    <span class="auhtor">Par 
                        <a href="{{ route('user.profile', ['user'=>$article->user->id]) }}">{{ $article->user->name }}</a></span> <br>
                    <span class="time">
                        {{ $article->created_at->diffForHumans()}} le 
                        {{ $article->created_at->isoFormat('LL')}}
                    </span>

                    @if(Auth::check() && Auth::user()->id == $article->user_id)
                        <div class="author mt-3">
                            <a href="{{ route('articles.edit', ['article'=>$article->slug]) }}" class="btn btn-secondary">Modifier</a>
                            <form style="display: inline;" action="{{ route('articles.destroy', ['article'=>$article->slug]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">X</button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        @endforeach
        {{-- fin du post --}}

        {{-- début de pagination --}}
        <div class="pagination mt-5">
            {{ $articles->links()}}
        </div>
        {{-- fin de pagination --}}
    
        <!-- /.card -->

        {{-- <div class="card card-outline-secondary my-4">
            <div class="card-header">
                Commentaires
            </div>
            <div class="card-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
                <small class="text-muted">Jean le 25 Janvier à 19h02</small>
                <hr>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
                <small class="text-muted">Paul le 29 Juin à 15h09</small>
                <hr>

                <a href="#" class="btn btn-success">Laisser un commentaire</a>
            </div>
        </div> --}}
        <!-- /.card -->

    </div>
    <!-- /.col-lg-9 -->

    </div>
@stop