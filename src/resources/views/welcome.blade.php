@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
                    <div class="row">
                        @csrf
                        <div class="col-md-9">
                            <input type="file" name="csv_file" class="form-control form-control-lg">
                            @error('csv_file')
                            <div class="mt-3 alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if(Session::has('message'))
                            <div class="mt-3 alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        @if(Session::has('error'))
                            <div class="mt-3 alert alert-danger">{{ Session::get('error') }}</div>
                        @endif
                        <div class="col-md-3">
                            <button class="btn btn-outline-success btn-lg">Success</button>
                        </div>
                    </div>
                </form>
            </div>
            <hr class="mt-3">
            <div class="col-md-12 mt-3">
                <div>
                    <form action="{{ route('main') }}" method="get">
                        <div class="row">
                            @csrf
                            <div class="col-md-3">
                                <label for="exampleFormControlInput1">Category</label>
                                <input type="text" name="category" class="form-control" id="exampleFormControlInput1"
                                       placeholder="toys"
                                       value="{{ $query['category'] ?? '' }}">
                                @error('category')
                                <div class="mt-3 alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="exampleFormControlSelect1">Gender</label>
                                <select name="gender" class="form-control" id="exampleFormControlSelect1">
                                    <option value="">Select gender</option>
                                    <option value="female" {{ isset($query['gender']) ? $query['gender'] === "female" ? 'selected' : '' : '' }}>Female</option>
                                    <option value="male" {{ isset($query['gender']) ? $query['gender'] === "male" ? 'selected' : '' : '' }}>Male</option>
                                </select>
                                @error('gender')
                                <div class="mt-3 alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="exampleFormControlInput1">Date of Birth</label>
                                <input type="text" name="birthDate" class="form-control" id="exampleFormControlInput1"
                                       placeholder="1990-11-27" value="{{ $query['birthDate'] ?? ''  }}">
                                @error('birthDate')
                                <div class="mt-3 alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-1">
                                <label for="exampleFormControlInput1">Age start</label>
                                <input type="text" name="ageStart" class="form-control" id="exampleFormControlInput1"
                                       placeholder="10" value="{{ $query['ageStart'] ?? ''  }}">
                                @error('ageStart')
                                <div class="mt-3 alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-1">
                                <label for="exampleFormControlInput1">Age end</label>
                                <input type="text" name="ageEnd" class="form-control" id="exampleFormControlInput1"
                                       placeholder="20" value="{{ $query['ageEnd'] ?? ''  }}">
                                @error('ageEnd')
                                <div class="mt-3 alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <button class="btn btn-warning">Filter</button>
                        </div>
                        <div class="row mt-1 mb-4">
                            <a href="{{ route('category') }}" class="btn btn-info">Category</a>
                        </div>
                    </form>
                </div>
                <div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Email</th>
                            <th scope="col">Firstname</th>
                            <th scope="col">Lastname</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Age</th>
                            <th scope="col">Category</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->email}}</td>
                                <td>{{$user->firstname}}</td>
                                <td>{{$user->lastname}}</td>
                                <td>{{$user->birthDate}}</td>
                                <td>{{$user->gender}}</td>
                                <td>{{$user->age}}</td>
                                <td>{{$user->category->title}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 m-3">
                {{$users->appends($query)->links()}}
            </div>
        </div>
    </div>
@endsection
