@extends('header')

@section('page-content')
       
    <form action="/" method="POST" class="mx-auto p-5" style="width: 800px;">
        @csrf

        <div class="mb-3 row">
        <label for="inputAPIKey" class="col-sm-2 col-form-label">API Key</label>
            <div class="col-sm-10">
                <input type="text" name="APIKey" class="form-control" id="inputAPIKey">
            </div>
        </div>

        <div class="mb-3 row">
        <label for="inputMovieName" class="col-sm-2 col-form-label">Movie Search</label>
            <div class="col-sm-10">
                <input type="text" name="MovieName" class="form-control" id="inputMovieName">
            </div>
        </div>

        <button type="submit" class="btn btn-light" value="submit">Submit</button>
        
    </form>

@endsection