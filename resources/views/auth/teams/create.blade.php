@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
          <div class="col-md-2">

          </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">create new team</div>
                    <div class="panel-body">
                        <a href="{{ url('/') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @if (isset($success))
                          @if ($success)
                          <ul class="alert alert-success">
                              <li>Succesfully registered!!</li>
                          </ul>
                          @endif
                        @endif

                         @if (isset($exists))
                          @if ($exists)
                          <ul class="alert alert-warning">
                              <li>team already exists!!</li>
                          </ul>
                          @endif
                        @endif

                        <form class="form-horizontal" action="/new-team/create" method="post">
                          {{ csrf_field() }}
                          @include ('admin.teams.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
