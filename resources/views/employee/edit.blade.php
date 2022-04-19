<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <style>
        label{

            font-weight: 600;
        }
    </style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('company.index') }}">Companies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('employee.index')}}">Employees</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="d-flex justify-content-center p-2 m-2">

    <div class="card p-2 w-50">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Edit Employee Details</h3>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>


        <form action="{{ route('employee.update' , $employee->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col">
                    <label for="">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ $employee->first_name }}" placeholder="First name">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="">First Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ $employee->last_name }}" placeholder="Last name">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="">Company</label>
                    <select class="form-control" name="company">
                        <option class="text-white bg-dark" value={{$employee->company->id}}>{{$employee->company->name}}</option>
                    @foreach($companies as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $employee->email }}" placeholder="Enter email here..">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="">Phone</label>
                    <input type="text" name="phone" value="{{ $employee->phone }}" class="form-control" placeholder="Enter passowrd here..">
                </div>

            </div>

            <div class="my-2">

                <div class="row">
                    <button type="submit" class="btn btn-success m-1 w-25">Update</button>
                    <button onclick="goBack()" class="btn btn-warning m-1 w-25">Cancel</button>
                </div>

            </div>

        </form>

    </div>

</div>

</body>

</html>
