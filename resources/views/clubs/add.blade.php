@extends('layouts.app')

@section('breadcrumbs')
<div class="breadcrumbs">
    <h1>Add New Club</h1>

    <ol class="breadcrumb">
        <li>
            <a href="/dashboard">Dashboard</a>
        </li>
        <li>
            <a href="/clubs/lists">Clubs List</a>
        </li>
        <li class="active">Add New Club</li>
    </ol>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 ">
        <div class="portlet light bordered">
            <div class="portlet-body form">
                <form role="form" action="/clubs/add" method="post">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                    <div class="form-body">
                        <div class="form-group">
                            <label class="bold">Club name</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter club name" />
                        </div>
                        <div class="form-group">
                            <label class="bold">Add club owner</label>
                            <select name="owner_id" class="form-control">
                                <option value="1">Owner 1</option>
                                <option value="2">Owner 2</option>
                                <option value="3">Owner 3</option>
                                <option value="4">Owner 4</option>
                                <option value="5">Owner 5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="bold">Basic club details</label>
                            <textarea name="details" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="bold">Available club activity</label>
                            <select class="form-control">
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                                <option>Option 4</option>
                                <option>Option 5</option>
                            </select>
                        </div>
                        <div class="form-actions right">
                            <button type="submit" class="btn green">Add club</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
