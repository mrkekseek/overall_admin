@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>{{ ! empty($id) ? 'Edit' : 'Add New' }} Club</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/dashboard">Dashboard</a>
        </li>
        <li>
            <a href="/clubs/lists">Clubs List</a>
        </li>
        <li class="active">{{ ! empty($id) ? 'Edit' : 'Add New' }} Club</li>
    </ol>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 ">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                <form role="form" action="/clubs/add{{ ! empty($id) ? '/'.$id : '' }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                    <div class="form-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="bold">Club name</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter club name" value="{{ old('name') != null ? old('name') : (isset($club->name) ? $club->name : '') }}" />
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <label class="bold">Add club owner</label>
                        <div class="row">
                            <div class="col-xs-12 form-group contact-person-list {{ ! empty($club->owner_id) || old('owner_id') != null ? 'col-sm-12' : 'col-sm-6'}}">
                                <select name="owner_id" class="form-control">
                                    <option value="0" {{ (old('owner_id') == '0' || old('owner_id') == null && isset($club->owner_id) && $club->owner_id == '0') ? 'selected="selected"' : '' }}>Add new owner</option>
                                    <option value="1" {{ (old('owner_id') == '1' || old('owner_id') == null && isset($club->owner_id) && $club->owner_id == '1') ? 'selected="selected"' : '' }}>Owner 2</option>
                                    <option value="2" {{ (old('owner_id') == '2' || old('owner_id') == null && isset($club->owner_id) && $club->owner_id == '2') ? 'selected="selected"' : '' }}>Owner 3</option>
                                    <option value="3" {{ (old('owner_id') == '3' || old('owner_id') == null && isset($club->owner_id) && $club->owner_id == '3') ? 'selected="selected"' : '' }}>Owner 4</option>
                                    <option value="4" {{ (old('owner_id') == '4' || old('owner_id') == null && isset($club->owner_id) && $club->owner_id == '4') ? 'selected="selected"' : '' }}>Owner 5</option>
                                </select>
                            </div>

                            <div class="col-xs-12 form-group contact-person-name{{ $errors->has('new_owner') ? ' has-error' : '' }} {{ ! empty($club->owner_id) ? 'hidden' : 'col-sm-6'}}">
                                <input name="new_owner" type="text" class="form-control" placeholder="Enter name of new owner" value="{{ old('new_owner') != null ? old('new_owner') : (isset($club->new_owner) ? $club->new_owner : '') }}" />
                                @if ($errors->has('new_owner'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_owner') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="bold">Basic club details</label>
                            <textarea name="details" class="form-control" rows="3">{{ old('details') != null ? old('details') : (isset($club->details) ? $club->details : '') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="bold">Available club activity</label>
                            <select name="activity" class="form-control">
                                <option value="0" {{ (old('activity') == '0' || old('activity') == null && isset($club->activity) && $club->activity == '0') ? 'selected="selected"' : '' }}>Choose club activity</option>
                                <option value="1" {{ (old('activity') == '1' || old('activity') == null && isset($club->activity) && $club->activity == '1') ? 'selected="selected"' : '' }}>Option 1</option>
                                <option value="2" {{ (old('activity') == '2' || old('activity') == null && isset($club->activity) && $club->activity == '2') ? 'selected="selected"' : '' }}>Option 2</option>
                                <option value="3" {{ (old('activity') == '3' || old('activity') == null && isset($club->activity) && $club->activity == '3') ? 'selected="selected"' : '' }}>Option 3</option>
                                <option value="4" {{ (old('activity') == '4' || old('activity') == null && isset($club->activity) && $club->activity == '4') ? 'selected="selected"' : '' }}>Option 4</option>
                                <option value="5" {{ (old('activity') == '5' || old('activity') == null && isset($club->activity) && $club->activity == '5') ? 'selected="selected"' : '' }}>Option 5</option>
                            </select>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn green">{{ ! empty($id) ? 'Save' : 'Add' }} club</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
