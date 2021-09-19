<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Books</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css')  }}">
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .co {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <h3 class="co" style="margin-top: 50px;">Iron and Fire</h3>
        <div class="container-fluid">
            @if(session('success'))
               <div class="alert alert-success alert-dismissible fade show" role="alert">
                   {{session('success')}}
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>               
                </div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Isbn</th>
                    <th scope="col">Pages</th>
                    <th scope="col">Publisher</th>
                    <th scope="col">Country</th>
                    <th scope="col">Released On</th>
                    <th class="co" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($books->count() > 0)
                        @foreach($books as $key => $book)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$book->name}}</td>
                            <td>{{$book->authors}}</td>
                            <td>{{$book->isbn}}</td>
                            <td>{{$book->number_of_pages}}</td>
                            <td>{{$book->publisher}}</td>
                            <td>{{$book->country}}</td>
                            <td>{{date('F d, Y',strtotime($book->release_date))}}</td>
                            <td>
                                <a href="{{route('book-edit',['id' => $book->id])}}" class="btn btn-sm btn-primary">
                                    Edit
                                </a> 
                            </td>
                            <td>
                                <form action="{{route('book-delete',['id' => $book->id])}}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete">
                                    <button onclick="return confirm('Are you sure, you want to delete?');" type='submit' class="btn btn-sm btn-danger">
                                       Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                            <tr>
                                <td colspan="9">
                                    <div class="co">
                                        <a href="{{ route('refresh')}}" class="btn btn-primary">
                                            Fetch Books
                                        </a>
                                    </div>
                                </td>
                            </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </body>
</html>
