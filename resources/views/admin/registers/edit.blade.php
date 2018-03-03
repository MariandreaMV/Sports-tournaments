@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Register #{{ $register->id }}</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/registers') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/registers/' . $register->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                              <div class="form-group">
                                <label for="team">Team name:</label>
                                <select class="form-control" name="team_id" id='team'>
                                    <option value="{{$team->id}}">{{$team->team_name}}</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="tournament">Available tournaments: </label>
                                <select class="form-control" name="tournament_id" id='tournament'>
                                    <option value="{{$tournament->id}}">{{$tournament->name}}</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="participants">Number of participants: </label>
                                <input class="form-control" type="number" name="n_participants" min="5" max="15" id='participants'>
                              </div>
                              <div class="form-group">
                                <label for="category">Category: </label>
                                <select class="form-control" name="category" id='category'>
                                  <option value="Beginner">Beginner</option>
                                  <option value="Amateur">Amateur</option>
                                  <option value="Professional">Professional</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="button">Registrar</button>
                              </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
