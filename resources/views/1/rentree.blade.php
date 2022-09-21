@extends('app', ['page' => 'Nouvelle rentrée', 'pageSlug' => 'stocks'])
@section('content')

    <div class="row mt-3">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show " role="alert">
                <p>{{ $message }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($message = Session::get('fail'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <p>{{ $message }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
            <form action="{{ url('ajout', $stock) }}" role="form" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="card col-md-12 mb-3">
                    <h4 class="card-header text-center">Rentrée de stock</h4>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold ">Materiel</span>
                                    <input type="text" class="form-control" name="materiel"
                                        value="{{ $stock->materiel }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3 mb-3">
                                    <span class="input-group-text txt fw-bold ">Quantité</span>
                                    <input type="text" class="form-control" name="quantite"
                                        placeholder="Quantité disponible: {{ $stock->quantite }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold ">Fournisseur</span>
                                    <input type="text" class="form-control" name="fournisseur"required >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3 mb-3">
                                    <span class="input-group-text txt fw-bold ">Date</span>
                                    <input type="date" class="form-control" name="date_rentree" required >
                                </div>
                            </div>

                            <div class="row mt-3 mb-2">
                                <div class="col-md-12 form-group text-center">
                                    <button type="submit" name="submit" class="btn btn-primary fw-bold">Enregistrer</button>
                                    <button type="reset" class="btn btn-outline-danger  fw-bold">Annuler</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                
            </form>
        </div>
        <br>
        <div class="col-md-12">
            <h3>Dernières Rentrées pour {{ $stock->materiel }}</h3>
            <table class="table table-bordered border-dark table-sm table-hover " id="">
                <thead class="  table-dark">
                    <th scope="col">#</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Fournisseur</th>
                    <th scope="col">Date</th>
                </thead>
                <tbody>
                    @if (!empty($rentrees) && $rentrees->count())
                        @php
                            $cnt = 1;
                        @endphp

                        @foreach ($rentrees as $key => $rentree)
                            <tr>
                                <td>{{ $cnt }}</td>
                                <td>{{ $rentree->quantite }}</td>
                                <td>{{ $rentree->fournisseur }}</td>
                                <td>{{ date('d/m/Y', strtotime($rentree->date_rentree)) }}</td>
                            </tr>
                            @php
                                $cnt = $cnt + 1;
                            @endphp
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">There are no data.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <style>
        .btn-default:hover {
            background-color: red !important;
            color: white;
        }

        .btn-primary {
            color: white;
        }

        .card-header {
            background: #4F81BD;
            color: white;
        }
        .txt {
            width: 20%;
        }

    </style>
@endsection
