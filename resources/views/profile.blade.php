@extends('app' , ['page' => 'Profile', 'pageSlug' => 'profile', 'sup' => 'pro'])
@section('content')
    <br>
    <div class="row">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($message = Session::get('fail'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div>
            <div class="card mb-3" style="width: 100%;">
                <h3 class="card-header fw-bold">Informations personnelles</h3>
                <div class="card-body">
                    <form action="{{ url('/change_infos', $user) }}" role="form" method="post" class="form-card">
                        @csrf
                        @method('PUT')
                        <div class="row mb-2">
                            <div class="input-group mb-3 mb-3">
                                <span class="input-group-text txt fw-bold ">Nom</span>
                                <input type="text" class="form-control" name="name" placeholder=""
                                    value="{{ $user->name }}" required>
                            </div>

                            <div class="input-group mb-3 mb-3">
                                <span class="input-group-text txt fw-bold ">Email</span>
                                <input type="text" class="form-control" name="email" placeholder=""
                                    value="{{ $user->email }}" required>
                            </div>
                        </div>
                        <div class="row" style="text-align: center; margin-top: 2%;">
                            <div class=" form-group">
                                <button type="submit" name="submit" class="btn btn-primary fw-bold">Modifer</button>
                                <button type="reset" class="btn btn-outline-danger  fw-bold">Annuler</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div>
            <div class="card" style="width: 100%;">
                <h3 class="card-header fw-bold">Mot de passe</h3>
                <div class="card-body">
                    <form action="{{ url('/change_pass', $user) }}" role="form" method="post" class="form-card">
                        @csrf
                        @method('PUT')
                        <div class="row mb-2">
                            <div class="input-group mb-3">
                                <span class="input-group-text txt fw-bold ">Pass</span>
                                <input type="password" class="form-control" name="current_password"
                                    placeholder="Mot de passe actuel" required>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text txt fw-bold ">New pass </span>
                                <input type="password" class="form-control" name="new_password"
                                    placeholder="Nouveau mot de pase" required>
                            </div>
                        </div>
                        <div class="row" style="text-align: center; margin-top: 2%;">
                            <div class=" form-group">
                                <button type="submit" name="submit" class="btn btn-primary fw-bold">Modifer</button>
                                <button type="reset" class="btn btn-outline-danger  fw-bold">Annuler</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
            width: 10%;
        }

    </style>

@endsection
