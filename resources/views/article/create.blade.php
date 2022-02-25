
@extends('layouts.main')
@section('content')

<div class="row">
    <!-- views/includes/sidebar.blade.php -->
    <div class="col-lg-3">
        @include('includes.sidebar')
    </div>
    <!-- /.col-lg-3 -->

    <div class="col-lg-9">

        <!-- affiche un message de success lorsqu'un nouvel utilisateur s'est inscrit -->
        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif
        
        <div class="card card-outline-secondary my-4">
            <div class="card-header">
                Ajouter un nouvel article
            </div>
        </div>
        <!-- /.card -->

        <div class="card-body">
            <!-- Formulaire cretion article -->
            <form action = " {{ route('articles.store')}} " method="POST">
                {{-- @csrf --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text" name="title" class="form-control" value="{{old('title')}}">
                    @error('title')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Titre</label>
                    <textarea name="content" cols="30" rows="10" class="form-control">{{old('content')}}</textarea>
                    @error('content')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category">Catégorie</label>
                    <select name="category" id="category" class="form-control">
                        <option value=""></option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.col-lg-9 -->

</div>

@stop