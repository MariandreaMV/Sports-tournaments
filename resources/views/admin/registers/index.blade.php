@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Registers</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/registers/create') }}" class="btn btn-success btn-sm" title="Add New Register">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <a href="{{ url('/') }}" class="btn btn-success btn-sm" title="Add New Register">
                            <i class="fa fa" aria-hidden="true"></i> Back
                        </a>

                        <form method="GET" action="{{ url('/admin/registers') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                      <form method="get">
                                        <th>
                                          <input class="btn-rm" type="submit" name="sort" value="id">
                                        </th>
                                        <th>
                                          <input class="btn-rm" type="submit" name="sort" value="tournament_id">
                                        </th>
                                        <th>
                                          <input class="btn-rm" type="submit" name="sort" value="team_id">
                                        </th>
                                        <th>
                                          <input class="btn-rm" type="submit" name="sort" value="n_participants">
                                        </th>
                                        <th>
                                          <input class="btn-rm" type="submit" name="sort" value="category">
                                        </th>
                                        <th>
                                          Actions
                                        </th>
                                        <input type="hidden" name="order" value="{{$order}}">
                                      </form>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($registers as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->tournament_id }}</td><td>{{ $item->team_id }}</td><td>{{ $item->n_participants }}</td><td>{{ $item->category }}</td>
                                        <td>
                                            <a href="{{ url('/admin/registers/' . $item->id) }}" title="View Register"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/registers/' . $item->id . '/edit') }}" title="Edit Register"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/registers' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete Register" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $registers->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
