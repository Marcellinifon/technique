@extends('layouts.app')
@section("content")
 <!-- Carousel Start -->
 <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="{{ asset('assets/img/carousel-1.jpg') }}" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-lg-8">
                                <p
                                    class="d-inline-block border border-white rounded text-primary fw-semi-bold py-1 px-3 animated slideInDown">
                                    Bienvenue à PayDunYa Transfer</p>
                                <h1 class="display-1 mb-4 animated slideInDown">Votre plateform de tranfert d'argent
                                </h1>
                                <a href="{{ url('/#send-money') }}" class="btn btn-primary py-3 px-5 animated slideInDown">Envoyez de l'argent</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="{{ asset('assets/img/carousel-2.jpg') }}" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-lg-7">
                                <p
                                class="d-inline-block border border-white rounded text-primary fw-semi-bold py-1 px-3 animated slideInDown">
                                    Bienvenue à PayDunYa Transfer</p>
                                <h1 class="display-1 mb-4 animated slideInDown">Votre plateform de transaction
                                </h1>
                                <a href="{{ url('/#send-money') }}" class="btn btn-primary py-3 px-5 animated slideInDown">Envoyez de l'argent</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->

 <!-- Callback Start -->
<div class="container-fluid callback my-5 pt-5" id="send-money">
    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="bg-white border rounded p-4 p-sm-5 wow fadeInUp" data-wow-delay="0.5s">
                    @if (Auth::user())

                    <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                        <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3" id="solde_form">Votre solde est de :
                        </p>
                        <h4 class="display-5 mb-5">Envoyez de l'argent en remplissant le formulais</h4>
                    </div>
                    <div class="row g-3">
                        <div class="col-sm-12">
                            <div class="form-floating">
                                <select class="form-select" onchange="validation(this)" id="user_select" aria-label="Default select example">
                                    <option value="">A QUI VOULLEZ-VOUS ENVOYER DE L'ARGENT ?</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <select class="form-select" onchange="validation(this)" id="dv_select" aria-label="Default select example">
                                    <option value="">DEVISE?</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <input type="number" onkeyup="validation(this)" class="form-control" id="amount" placeholder="Your Mobile">
                                <label for="mobile">MONTANT</label>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary w-100 py-3" id="send"  type="">Envoyé</button>
                        </div>
                        <button class="btn btn-primary w-100 py-3" id="encours" type="button" disabled >
                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                            <span class="visually-hidden">Loading...</span>
                            <span class="">Chargement...</span>
                        </button>
                    </div>
                    @else
                    <div class="text-justifie">
                        <h3 class="text-center">Connectez-vous avant de pouvoir effectuer des oppérations sur cette plateforme. Pour vous connecter, cliquez  <a href="{{ url('/login') }}">ici</a> </h3>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Callback End -->

@endsection
@section('js')
    <script>var user_id = "{{ Auth::user()? Auth::user()->id:0 }}";</script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/form.js') }}"></script>
@endsection


