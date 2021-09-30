@extends('layouts.app')
@section('content')
    <div class="container mb-3">
        <a href="{{ route('categories.create') }}"><button type="button" class="btn btn-light">ADD category</button></a>
    </div>
    <div class="container">

        <table id="myTable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>name</th>
                   
                    <th>icon</th>
                   
                </tr>
            </thead>
            <tbody>
         
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')

 <script >
    
    $(document).ready(function(){
       $('#myTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('categories.index') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'c_name',
                            name: 'c_name'
                        } 
                    ],
       });
         
    });
   
  </script>  

@endpush

