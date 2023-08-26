@extends('admin_layout.master')

@section('title')
Categories
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All categories</h3>
              </div>
              @if (Session::has("status"))
              <br>

              <div class="alert alert-success">
                {{Session::get("status")}}
              </div>
              @endif

              <input type="hidden"{{$incriment=1}}>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text-center">Num.</th>
                    <th class="text-center">Category Name</th>
                    <th class="text-center">Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($CTGR as $category )
                      <tr>
                        <td>{{$incriment}} </td>
                        <td>
                            {{$category->category_name}}
                        </td>
                        <td>
                          <div class="d-flex justify-content-center">
                                <a href="{{url('admin/editeCategory/'.$category->id)}}" class="btn btn-primary mr-2">Edite</a>
                            
                            
                              {{-- <a href="#" id="delete" class="btn btn-danger" ><i class="nav-icon fas fa-trash"></i></a> --}}
                                <form action="{{url('admin/deleteCategory/'.$category->id)}}"  method="POST">
                                  @csrf
                                  @method("DELETE")
                                  <input type="submit" id="delete" class="btn btn-danger" value="Delete">

                                </form>
                          </div>      
                        </td>
                      </tr>
                      <input type="hidden" {{$incriment++}}>
                    @endforeach
                   
              
                  </tbody>
                  {{-- <tfoot>
                    <tr>
                      <th class="text-center">Num</th>
                      <th class="text-center">Category Name</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </tfoot> --}}
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section("styles")
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset("backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
  <link rel="stylesheet" href="{{asset("backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
  <!-- Theme style -->
@endsection

@section("scripts")
<!-- DataTables -->
    <script src="{{asset("backend/plugins/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="{{asset("backend/plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
    <script src="{{asset("backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}"></script>
    <!-- AdminLTE App -->

    <script>
        $(function () {
          $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
          });
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        });
      </script>
@endsection
