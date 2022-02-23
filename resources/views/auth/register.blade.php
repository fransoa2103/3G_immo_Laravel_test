
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
                Inscription
            </div>
        </div>
        <!-- /.card -->

        <div class="card-body">
            <!-- Formulaire d'inscription -->
            <form action = " {{ route('post.register')}} " method="POST">
                {{-- @csrf --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}">
                    @error('name')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{old('email')}}">
                    @error('email')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> --}}
                <button type="submit" class="btn btn-primary">Inscription</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.col-lg-9 -->

</div>

@stop