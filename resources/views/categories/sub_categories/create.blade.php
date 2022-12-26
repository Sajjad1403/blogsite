<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" > --}}

</head>
<style>
    .container {
        padding-top: 80px;
    }

    .align-center {
        display: flex;
        justify-content: end;
    }

    body {
        background-image: url('{{ asset('images/color.jpeg') }}');
        background-repeat: no-repeat;
        height: 100%;
        margin: 0;
        background-size: cover;
        background-position: center;
    }

    .border {
        border-radius: 0.50rem;
        background-color: #fff;
    }

    .heading {
        margin: 0;
        padding-bottom: 2rem;
    }
    .parentCategory{
    padding-bottom: 5px;
    }
</style>

<body>

    <div class="container">
        <form class="loginform" action="{{ route('subcategory.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="border p-5">
                        <h2 class="heading">Create SubCategory</h2>

                        <div class="form-group">
                            <label for="parentCategory" class="parentCategory">Parent Category</label>
                            <select class="form-select" name="parent_id" aria-label="Default select example">
                             <option selected disabled>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group pt-2">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="form-group pt-2">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="align-center">
                            <input type="submit" class="btn btn-primary mt-4 ">
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>

    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
