@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
          <div class="col-md-2">

          </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Register team to tournament</div>
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

                        <form class="form" action="/new-register/create" method="post">
                          {{ csrf_field() }}
                          <div class="col-md-2"></div>
                          <div class="form-group col-md-8">
                            <div class="form-group">
                              <label for="team">Team name:</label>
                              <select class="form-control" name="team" id='team'>
                                @forelse ($teams as $team)
                                  <option value="{{$team->id}}">{{$team->team_name}}</option>
                                @empty
                                  <option value="0" selected disabled>No teams registered</option>
                                @endforelse
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="tournament">Available tournaments: </label>
                              <select class="form-control" name="tournament" id='tournament'>
                                @forelse ($tournaments as $tournament)
                                  <option value="{{$tournament->id}}">{{$tournament->name}}</option>
                                @empty
                                  <option value="0" selected disabled>No tournaments currently</option>
                                @endforelse
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="participants">Number of participants: </label>
                              <input class="form-control" type="number" name="participants" min="5" max="15" id='participants'>
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
