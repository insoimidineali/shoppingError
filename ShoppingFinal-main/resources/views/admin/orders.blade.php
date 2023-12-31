@extends('admin_layout.master')

@section('title')
 Orders
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Ordes</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Ordes</li>
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
                    <h3 class="card-title">All Ordes</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                            <thead>
                               
                                <tr>
                                    <th>Date</th>
                                    <th>Client Names</th>
                                    <th>Address</th>
                                    <th>Commande</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach ($commands as $command )
                            <tr>
                                <td>{{$command->created_at}}</td>
                                <td>{{$command->name}}</td>
                                <td>{{$command->address}}</td>
                                <td>
                                   @foreach ($command->cart->items as $item)
                                      
                                            {{$item['product_name'].", "."Qty :".$item["qty"]}}
                                       
                                   @endforeach
                                </td>

                                <td>
                                <a href=" {{ url('ShowCommand', [$command->id]) }} " target="_blank" class="btn btn-primary"><i class="nav-icon fas fa-eye"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            
                        
                        </tbody>
                    
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
