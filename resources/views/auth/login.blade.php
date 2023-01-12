@extends('layouts.app')

@section('content')

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 mb-4 animated slideInDown">Connectez-vous</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Connexion</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->
 <!-- Callback Start -->
 <div class="container-fluid callback mt-5 my-5 pt-5" id="send-money">
    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="bg-white border rounded p-4 p-sm-5 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                        <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">PayDunYa-Transfer
                        </p>
                        <h3 class="display-5 mb-5">Connextez-vous ici</h3>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row g-3">

                            <div class="col-sm-12">
                                <div class="form-floating">
                                    <input type="email" autocomplete="email" name="email" id="mail"  placeholder="Votre adresse mail" autofocus required value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" >
                                    <label for="email">Email</label>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12">
                                <div class="form-floating">
                                    <input type="password"  autocomplete="password" name="password" id="password"  placeholder="Votre mot de passe" autofocus required value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror">
                                    <label for="password">Mot de passe</label>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-primary w-100 py-3" id="submit"  type="">Connexion</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
