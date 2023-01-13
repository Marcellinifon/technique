@extends('layouts.app')

@section('content')

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 mb-4 animated slideInDown">Tableau de bord</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tableau de board</li>
            </ol>
        </nav>
    </div>
</div>

<div class="p-2">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="col-5 mt-2">
                            <a href="{{ url('/#send-money', []) }}" class="btn btn-primary btn-xm"  data-bs-whatever="@mdo"> Envoiyez de l'argent</a>
                        </div>
                        <div class="col-4 ml-1 mt-2 d-inline-block text-primary fw-semi-bold py-1 px-3">
                            <h4>Votre solde actuelle est: {{ $solde->amount }} FCFA</h4>
                        </div>
                        <div class="col-3 mt-2">
                            <input class="float-right" type="text" id="myInput" onkeyup="myFilter()" placeholder="Search for names..">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.3s">

                    <div class="border rounded p-4">
                        <nav>
                            <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                <button class="nav-link fw-semi-bold active" id="nav-story-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-sent" type="button" role="tab" aria-controls="nav-story"
                                    aria-selected="true">Envoyé</button>
                                <button class="nav-link fw-semi-bold" id="nav-mission-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-received" type="button" role="tab" aria-controls="nav-mission"
                                    aria-selected="false">Reçu</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-sent" role="tabpanel"
                                aria-labelledby="nav-story-tab">
                                <table id="myTable">
                                    <tr class="header">
                                        <th style="width:10%;">A</th>
                                        <th style="width:20%;">Devise</th>
                                        <th style="width:20%;">montant</th>
                                        <th style="width:10%;">Date</th>

                                    </tr>
                                    @foreach ( $transactions as $transaction )
                                    <tr>
                                        <td>{{ $transaction->receiver->name }}</td>
                                        <td>FCFA</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>{{ date('d-m-Y', strtotime($transaction->created_at))." à ".date('H:i:s', strtotime($transaction->created_at)) }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                                <div class="mt-2 float-right">
                                    <div class="d-flex ">
                                        {!! $transactions->links() !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-received" role="tabpanel"
                                aria-labelledby="nav-mission-tab">
                                <table id="myTable1">
                                    <tr class="header">
                                        <th style="width:10%;">De</th>
                                        <th style="width:20%;">Devise</th>
                                        <th style="width:20%;">Montant</th>
                                        <th style="width:10%;">Date</th>
                                    </tr>
                                    @foreach ( $transactions_reveived as $transaction_r )
                                    <tr>
                                        <td>{{ $transaction_r->user->name }}</td>
                                        <td>FCFA</td>
                                        <td>{{ $transaction_r->amount }}</td>
                                        <td>{{ date('d-m-Y', strtotime($transaction_r->created_at))." à ".date('H:i:s', strtotime($transaction_r->created_at)) }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                                <div class="mt-2">
                                    <div class="d-flex">
                                        {!! $transactions_reveived->links() !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-body">
            <div class="bg-white border rounded p-sm-5 wow fadeInUp" data-wow-delay="0.5s">
                <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">PayDunYa-Transfer
                    </p>
                    <h3 class="display-7 mb-5">Envoyez de l'argent en remplissant le formulais</h3>
                </div>
                <div class="row g-3">
                    <div class="col-sm-12">
                        <div class="form-floating">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>A QUI VOULLEZ-VOUS ENVOYER DE L'ARGENT ?</option>
                                <option value="1">One</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-floating">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>QUELLE DEVISE ?</option>
                                <option value="1">One</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="mobile" placeholder="Your Mobile">
                            <label for="mobile">MONTANT</label>
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <button class="btn btn-primary w-100 py-3" id="click"  type="">Envoyer</button>
                    </div>
                </div>

            </div>
        </div>
      </div>
    </div>
</div>
@endsection

