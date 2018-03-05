@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">tournament {{ $tournament->id }}</div>
                    <div class="panel-body">
                        <a href="/" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i>go to main</button></a>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $tournament->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $tournament->name }} </td></tr><tr><th> Date </th><td> {{ $tournament->date }} </td></tr><tr><th> Status </th><td> {{ $tournament->status }} </td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
