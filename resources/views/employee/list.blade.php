<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>

  <div class="bg-dark">
    <div class="container">
         <div class="h4 text-white">Simple Crud Operation</div>
    </div>
  </div>

   <div class="container">
    
        <div class="d-flex justify-content-between py-3">
            <div class="h5">Employees List</div>
            <div class>
            <a href="{{route('employees.create')}}" class="btn btn-primary">Create</a>
            </div>
        </div>
            
        @if(Session::has('success'))

        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
        @endif
       
    <div class="card border-0 shadow-lg">
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>address</th>
                    <th>action</th>
                </tr>

                @if($employees->isNotEmpty())
                @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->id}}</td>
                    <td>
                    @if($employee->image != '' && file_exists(public_path().'/uploads/employees/'.$employee->image))
                            <img src="{{ url('uploads/employees/'.$employee->image) }}" alt="" width="50" height="50" class="rounded-circle">
                            @else
                            <img src="{{ url('assets/images/no-image.png') }}" alt="" width="50" height="50" class="rounded-circle">
                            @endif
                    </td>
                    <td>{{ $employee->name}}</td>
                    <td>{{ $employee->email}}</td>
                    <td>{{ $employee->address}}</td>
                    
                    <td>
                        <!-- <a href="{{url('employees/'.$employee->id.'/edit')}}" class="btn btn-primary btn-sm">Edit</a> -->
                        <a href="{{ route('employees.edit',$employee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="#" onclick="deleteEmployee({{$employee->id}})" class="btn btn-danger btn-sm">Delete</a>

                        <form id="employee-edit-action-{{$employee->id}}" action="{{ route('employees.destroy',$employee->id) }}" method="post">
                            @csrf
                            @method('delete')
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="6">Record Not Found</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
    <div class="mt-3">
            {{ $employees->links() }}
        </div>
        <td><a href="logout" class="btn btn-primary btn-sm">Logout</a></td>
   </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> -->
    <script>
        function deleteEmployee(id){
            if(confirm("Are you sure you want to delete")){
                document.getElementById('employee-edit-action-'+id).submit();
            }
        }
    </script>
  </body>
</html>