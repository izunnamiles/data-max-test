<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Edit {{$book->name}} Book</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css')  }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" integrity="sha256-b5ZKCi55IX+24Jqn638cP/q3Nb2nlx+MH/vMMqrId6k=" crossorigin="anonymous" /> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>

        

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
        <h3 class="co" style="margin-top: 50px;">Edit "{{$book->name}}" Book Info</h3>
        <div class="container ">
            @if(session('error'))
               <div class="alert alert-success alert-dismissible fade show" role="alert">
                   {{session('error')}}
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>               
                </div>
            @endif
            <form  action="{{route('book-update',['id'=>$book->id])}}" method="post">
                @csrf
                <input type="hidden" name="_method" value="patch">
                <div style="margin-left: 200px;">
                    <div class="form-group row">
                        <label for="book_name" class="col-sm-2 col-form-label">Book Name</label>
                        <div class="col-sm-6">
                        <input type="text"  class="form-control" id="book_name" name="book_name" value="{{$book->name}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="author" class="col-sm-2 col-form-label">Author</label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="author" name="authors" value="{{$book->authors}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="isbn" class="col-sm-2 col-form-label">Isbn</label>
                        <div class="col-sm-6">
                        <input type="text"  class="form-control" id="isbn" name="isbn" value="{{$book->isbn}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="country" class="col-sm-2 col-form-label">Country</label>
                        <div class="col-sm-6">
                        <input type="text"  class="form-control" id="country" name="country" value="{{$book->country}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="page" class="col-sm-2 col-form-label">Pages</label>
                        <div class="col-sm-6">
                        <input type="number" class="form-control" id="page" name="number_of_pages" value="{{$book->number_of_pages}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="publisher" class="col-sm-2 col-form-label">Publisher</label>
                        <div class="col-sm-6">
                        <input type="text"  class="form-control" id="publisher"name="publisher" value="{{$book->publisher}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="release_date" class="col-sm-2 col-form-label">Released Date</label>
                        <div class="col-sm-6">
                        <input type="text"   class="form-control date" id="release_date" name="release_date" value="{{$book->release_date}}" required>
                        </div>
                    </div>
            </div>
        </div>
            
                </div>
                <div class="co">
                  <button type="submit" class="btn btn-primary">update</button>
                </div>
            </form>
        </div>
    </body>
    <script type="text/javascript">
     $(function() {
           $('.date').datetimepicker();
        }); 

</script> 
</html>
