@extends('admin_layout.master')

@section('title')
    Slider
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sliders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sliders</li>
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
                <h3 class="card-title">All Sliders</h3>
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
                    <th>Num.</th>
                    <th>Picture</th>
                    <th>Description one</th>
                    <th>Description Two</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>

                    @foreach ($SLDR as $slider)
                    <tr>
                          <td>
                            {{$incriment}} 
                          </td>
                          <td>
                            <img src="{{asset("storage/slide_images/".$slider->images)}}" 
                            style="height : 50px; width : 50px" class="img-circle elevation-2" alt="User Image"
                            alt="">
                          
                          </td>
                          <td>
                          {{ $slider->description_1 }}
                          </td>

                          <td>
                          {{ $slider->description_2 }}
                          </td>

                        
                        
                          <td>
                            @if ($slider->status ==1)

                            <form action=" {{ url('/admin/DesactivateSlider/'.$slider->id)}}" method="POST">
                              @csrf
                              @method("PUT")
                              <input type="submit"  class="btn btn-success" value="Desactivate">
                            {{-- <a href="#" class="btn btn-success">Desactivate</a> --}}

                            </form>
                            
                            @else
                            <form action=" {{ url('/admin/activateSlider/'.$slider->id)}}" method="POST">
                              @csrf
                              @method("PUT")
                              <input type="submit"  class="btn btn-warning" value="Activate">
                            {{-- <a href="#" class="btn btn-success">Desactivate</a> --}}

                            </form>
                            {{-- <a href="#" class="btn btn-warning">Activate</a> --}}
                            @endif
                           
                            <a href="{{url('/admin/editeSlider/'.$slider->id)}}" class="btn btn-primary">Edite</i></a>
                           
                            <form action="{{url('admin/deleteslider/'.$slider->id)}}"  method="POST">
                              @csrf
                              @method("DELETE")
                            {{-- <a href="#" id="delete" class="btn btn-danger" ><i class="nav-icon fas fa-trash"></i></a> --}}
                            <input type="submit" id="delete" class="btn btn-danger" value="Delete">

                          </form>
                          </td>
                    </tr>
                    <input type="hidden" {{$incriment++}}>

                    @endforeach

                     
                  {{-- <tr>
                    <td>2</td>
                    <td>
                      <img src="{{asset("backend/dist/img/user2-160x160.jpg")}}" style="height : 50px; width : 50px" class="img-circle elevation-2" alt="User Image">
                    </td>
                    <td>Internet
                      Explorer 5.0
                    </td>
                    <td>5</td>
                    <td>
                      <a href="#" class="btn btn-success">Unactivate</a>
                      <a href="#" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a>
                      <a href="#" id="delete" class="btn btn-danger" ><i class="nav-icon fas fa-trash"></i></a>
                    </td>
                  </tr> --}}
                  </tbody>
                  <tfoot>
                  {{-- <tr>
                    <th>Num.</th>
                    <th>Picture</th>
                    <th>Description one</th>
                    <th>Description Two</th>
                    <th>Actions</th>
                  </tr> --}}
                  </tfoot>
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
