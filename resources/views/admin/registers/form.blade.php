<div class="form-group {{ $errors->has('tournament_id') ? 'has-error' : ''}}">
    <label for="tournament_id" class="col-md-4 control-label">{{ 'Tournament Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="tournament_id" type="number" id="tournament_id" value="{{ $register->tournament_id or ''}}" >
        {!! $errors->first('tournament_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('team_id') ? 'has-error' : ''}}">
    <label for="team_id" class="col-md-4 control-label">{{ 'Team Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="team_id" type="number" id="team_id" value="{{ $register->team_id or ''}}" >
        {!! $errors->first('team_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('n_participants') ? 'has-error' : ''}}">
    <label for="n_participants" class="col-md-4 control-label">{{ 'N Participants' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="n_participants" type="number" id="n_participants" value="{{ $register->n_participants or ''}}" >
        {!! $errors->first('n_participants', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
    <label for="category" class="col-md-4 control-label">{{ 'Category' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="category" type="text" id="category" value="{{ $register->category or ''}}" >
        {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
