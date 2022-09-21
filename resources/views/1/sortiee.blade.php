@extends('app', ['page' => 'Nouvelle sortie', 'pageSlug' => 'stocks'])
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
            <form action="{{ url('retrait', $stock) }}" role="form" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="card col-md-12 mb-3">
                    <h4 class="card-header text-center">Sortie de stock</h4>
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
                                        placeholder="Quantité disponible: {{ $stock->quantite }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold ">Raison</span>
                                    <input type="text" class="form-control" name="raison">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3 mb-3">
                                    <span class="input-group-text txt fw-bold ">Date</span>
                                    <input type="date" class="form-control" name="date_sortie">
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
            <h3>Dernières Sorties pour {{ $stock->materiel }}</h3>
            <table class="table table-bordered border-dark table-sm table-hover" id="">
                <thead class="  table-dark">
                    <th scope="col">#</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Raison</th>
                    <th scope="col">Date</th>
                </thead>
                <tbody>
                    @if (!empty($sorties) && $sorties->count())
                        @php
                            $cnt = 1;
                        @endphp

                        @foreach ($sorties as $key => $sortie)
                            <tr>
                                <td>{{ $cnt }}</td>
                                <td>{{ $sortie->quantite }}</td>
                                <td>
                                    @if ($sortie->raison == 'livraison')
                                        <a href="{{ url('/livraison/show', $sortie->numero_fiche) }}"
                                            class="" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Voir la fiche de livraison  ">
                                            {{ ucfirst($sortie->raison) }}</i>
                                        </a>
                                    @else
                                        {{ ucfirst($sortie->raison) }}
                                    @endif
                                </td>
                                <td>{{ date('d/m/Y', strtotime($sortie->date_sortie)) }}</td>
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
