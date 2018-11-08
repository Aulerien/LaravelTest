<?php
/**
 * Created by PhpStorm.
 * User: Aulerien
 * Date: 01/11/2018
 * Time: 15:00
 */
?>


<html>
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{asset('MDB/css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('MDB/css/mdb.css')}}">

        <style>
            body{
                font-family: "Lucida Sans Unicode", "Lucida Grande", Verdana, Arial, Helvetica, sans-serif;
            }
        </style>

    </head>


        <body>

        <!-- -->

        <br>
        <div class="row">
            <div class="col-lg-1"></div>

            <div class="col-lg-10">

                <div class="row">
                    <div class="col-lg-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                Articles</a>

                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                Mail</a>

                            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                Oprérations</a>

                            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                Tout</a>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="tab-content" id="v-pills-tabContent">

                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                                @if(session()->has('message.ajouter'))
                                    <div class="alert alert-{{ session('message.ajouter') }}">
                                        {!! session('message.contenu') !!}
                                    </div>
                                @endif

                                <form action="{{url('ajouter/article')}}" method="post">
                                    {!! csrf_field() !!}

                                    <div class="row">

                                        <div class="col-lg-4">
                                            <input type="text" required class="form-control" placeholder="Code" name="code">
                                            <br>
                                        </div>

                                        <div class="col-lg-5">
                                            <input type="text" required class="form-control" placeholder="Désignation" name="designation">
                                            <br>
                                        </div>

                                        <div class="col-lg-3">
                                            <select name="pays" id="pays" class="form-control">
                                                @foreach($pays as $pa)
                                                <option value="{{$pa->id}}">{{$pa->pays}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <input type="submit" value="Ajouter" class="btn btn-primary animated bounce">
                                        <br>
                                        <input type="reset" value="Annuler" class="btn btn-danger animated bounce">
                                    </div>
                                </form>
                                <!-- Fin du formulaire -->


                                <!-- Table -->
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Code</th>
                                        <th scope="col">Désignation</th>
                                        <th scope="col">Pays</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($articles as $article)
                                     <tr>
                                        <td>{{$article->code}}</td>
                                        <td>{{$article->designation}}</td>
                                        <td>{{$article->pays->pays}}</td>

                                         <td>
                                             <i class="mdi mdi-create"></i>
                                             <button type="button" class="btn btn-primary animated bounce" data-toggle="modal" data-target="#exampleModal{{$article->id}}">
                                                 Modifier
                                             </button>
                                         </td>

                                         <td>
                                             <button type="button" class="animated bounce btn btn-danger">
                                                 <a data-confirm="Voulez-vous vraiment supprimer {{$article->code}} {{$article->designation}} ?" style="color: white;" href="{{url('supprimer', array('idArticle' => $article->id))}}">
                                                     Supprimer
                                                 </a>
                                             </button>

                                         </td>

                                    </tr>
                                    @endforeach


                                    </tbody>
                                </table>
                                <!-- Fin de Table -->

                            </div>


                            <!-- Les Modals de Modifications Articles -->
                            <!-- Button trigger modal -->


                            @foreach($articles as $article)
                                <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$article->id}}" role="dialog" aria-labelledby="exampleModalLabel{{$article->id}}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel{{$article->id}}">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <form action="{{url('modifier/article',array('idArticle' => $article->id))}}" method="post">
                                                        {!! csrf_field() !!}
                                                        <input name="code" type="text" placeholder="Code" value="{{$article->code}}" required class="form-control">
                                                        <br>
                                                        <input name="designation" type="text" placeholder="Désignation" value="{{$article->designation}}" required class="form-control">
                                                        <br>
                                                        <input type="submit" class="btn btn-success" value="Modifier">
                                                        <input type="reset" class="btn btn-danger" value="Annuler">
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                @endforeach



                        <!-- Mail -->
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                                @if(session()->has('message.envoyer'))
                                    <div class="alert alert-{{ session('message.envoyer') }}">
                                        {!! session('message.contenu') !!}
                                    </div>
                                @endif

                                <form action="{{url('envoyer_mail')}}" method="post">
                                    {!! csrf_field() !!}

                                    <input required type="text" class="form-control" name="titre" placeholder="Le titre de Votre Message">
                                    <br>

                                    <input required type="email" class="form-control" name="destination" placeholder="Adresse Email de Destination">
                                    <br>

                                    <textarea required name="message" id="message" cols="30" rows="10" placeholder="Votre Message" class="form-control">

                                    </textarea>
                                    <br>

                                    <input required type="text" name="nom" class="form-control" id="nom" placeholder="Votre Nom">
                                    <br>

                                    <input type="reset" value="Annuler" class="btn btn-danger">

                                    <input type="submit" value="Envoyer" class="btn btn-success">

                                </form>

                                    <br>
                                    <!-- Verification de mail -->

                                    <form action="{{url('tester/mail')}}" method="post" id="formulaireTest">
                                        {!! csrf_field() !!}

                                        <div class="row">
                                            <div class="col-lg-2">
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="">&nbsp;</label>
                                                <input type="email" required placeholder="Adresse Email à Tester" name="testname" class="form-control" id="testname">
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="">&nbsp;</label>
                                                <input type="submit" value="Tester" class="btn btn-success">
                                            </div>
                                        </div>


                                    </form>

                                    <!--  Fin de verification -->


                            </div>
                            <!-- Fin de Mail -->

                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad consequuntur earum expedita harum ipsum maiores non quos reiciendis repellat ut? A ab earum exercitationem expedita odit pariatur provident reiciendis, similique.
                            </div>

                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi assumenda at atque commodi deserunt eius eveniet fugit harum impedit labore, maiores optio, quam quidem quisquam repellendus reprehenderit sit voluptas voluptatem.
                            </div>

                        </div>
                    </div>
                </div>

            </div>


        </div>

        <!--  -->


        <div class="container">
            @yield('content')
        </div>
        </body>

    <script src="{{asset('MDB/js/jquery-3.2.1.min.js')}}" type="application/javascript"></script>
    <script src="{{asset('MDB/js/bootstrap.js')}}" type="application/javascript"></script>
    <script src="{{asset('MDB/js/mdb.js')}}" type="application/javascript"></script>
    <script src="{{asset('MDB/js/popper.min.js')}}" type="application/javascript"></script>

    <script>
        $(function() {
            $('a[data-confirm]').click(function(ev) {
                var href = $(this).attr('href');

                if (!$('#dataConfirmModal').length) {
                    $('body').append('<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header">' +
                        '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>' +
                        '<h3 id="dataConfirmLabel">Merci de Confirmer</h3></div><div class="modal-body">' +
                        '</div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>' +
                        '<a class="btn btn-danger" id="dataConfirmOK">Oui</a></div></div></div></div>');
                }
                $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
                $('#dataConfirmOK').attr('href', href);
                $('#dataConfirmModal').modal({show:true});

                return false;
            });

        });

        $(document).ready(function () {
            $('#formulaireTest').submit(function () {

                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),

                    beforeSend: function () {
                        console.log('OK OK OK');
                    },
                    success: function (donnees) {

                    }
                })


            })
        })


    </script>

</html>