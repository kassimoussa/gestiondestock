@extends('app', ['page' => 'Accueil', 'pageSlug' => 'accueil', 'sup' => 'Index'])
@section('content')
    <div class="col p-4">
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

        <div class="d-flex justify-content-end mb-3">
            <a class="btn  btn-primary  fw-bold" data-bs-toggle="modal" data-bs-target="#addMateriel">Ajouter</a>
        </div>

        <div class="modal fade" id="addMateriel" tabindex="-1" aria-labelledby="addMateriel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <form action="{{ url('storeMateriel') }}" role="form" method="post" class="form-card">
                        @csrf
                        <div class="modal-header d-flex justify-content-between">
                            <h3>Ajouter</h3>
                            <div class="row">
                                <div class=" form-group">
                                    <button type="submit" name="submit"
                                        class="btn btn-primary fw-bold">Enregistrer</button>
                                    <button type="button" class="btn btn-danger fw-bold" data-bs-dismiss="modal"><i
                                            class="fas fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="field_wrapper  mb-2">

                                <div class="input-group">
                                    <a class="input-group-text icon add_button" onclick="addInput()">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </a>
                                    <input type="text" class="form-control" name="nom_materiel[]"
                                        placeholder="Nom du matériel" required>
                                    <input type="text" class="form-control" name="quantite[]" placeholder="Quantité"
                                        onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                        required>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>




        <table class="table table-bordered border-red table-sm align-middle display" id="">
            <thead class="bg-dark text-white text-center">
                <th>#</th>
                <th>Materiels</th>
                <th>Quantité</th>
                <th>Action</th>
            </thead>

            <tbody class="text-center">

                @if (!empty($stocks) && $stocks->count())
                    @php
                        $cnt = 1;
                        $delmodal = 'del' . $cnt;
                    @endphp

                    @foreach ($stocks as $key => $stock)
                        <tr>
                            <td>{{ $cnt }}</td>
                            <td>{{ $stock->materiel }}</td>
                            <td>{{ $stock->quantite }}</td>
                            <td class="td-actions ">
                                <a href="{{ url('newrentree', $stock) }}" class="btn btn-transparent btn-xs  "
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Rentrée de stock">
                                    <i class="fas fa-plus"></i>
                                </a>
                                <a href="{{ url('newsortie', $stock) }}" class="btn btn-transparent btn-xs  "
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Sortie de stock">
                                    <i class="fas fa-minus"></i>
                                </a>
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer">
                                    <a class="btn btn-transparent btn-xs " data-bs-toggle="modal"
                                        data-bs-target="#{{ $delmodal }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </span>
                            </td>
                        </tr>
                        <div class="modal fade" id="{{ $delmodal }}" tabindex="-1" aria-labelledby="deleteEquipement"
                            aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-center text-dark">
                                        <h4>Etes vous sûr de supprimer le materiel</h4>
                                    </div>
                                    <div class="modal-body text-center">
                                        <form action="{{ url('deleteMateriel', $stock) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger  fw-bold"
                                                data-bs-dismiss="modal">Supprimer</button>
                                            </button>
                                            <button type="button" class="btn btn-danger fw-bold"
                                                data-bs-dismiss="modal">Annuler</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $cnt = $cnt + 1;
                            $delmodal = 'del' . $cnt;
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

    <style>
        .btn-default:hover {
            background-color: red !important;
            color: white;
        }

        .btn-primary {
            color: white;
        }

        .ipg {
            width: 132px;
            /* background: rgb(196, 196, 228); */
        }

        .iput {
            background: white !important;
        }

        .nav-link {
            color: black;
            font-size: 16px;
        }

        .active {
            color: blue !important;
        }

        a {
            text-decoration: none;
        }
    </style>

    

    <script>
        function addInput() {
            $(document).ready(function() {
                var maxField = 10; //Input fields increment limitation
                var addButton = $('.add_button'); //Add button selector
                var wrapper = $('.field_wrapper'); //Input field wrapper
                var fieldHTML =
                    "<div class='input-group'><a class='input-group-text icon remove_button' onclick='removeInput()'><i class='fa fa-minus' aria-hidden='true'></i></a><input type='text' class='form-control' name='nom_materiel[]'' placeholder='Nom du matériel' required ><input type='number' class='form-control' name='quantite[]' placeholder='Quantité' required ></div>"; //New input field html 
                var x = 1; //Initial field counter is 1

                //Once add button is clicked

                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }


                //Once remove button is clicked
                $(wrapper).on('click', '.remove_button', function(e) {
                    e.preventDefault();
                    $(this).parent('div').remove(); //Remove field html
                    x--; //Decrement field counter
                });
            });
        }
    </script>

@endsection
