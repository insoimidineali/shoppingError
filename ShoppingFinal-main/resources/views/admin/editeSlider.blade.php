@extends('admin_layout.master')

@section('title')
Edite Slider
@endsection

@section('content')

  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Slider</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Slider</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Add slider</h3>
              </div>
              <!-- /.card-header -->
              @if (Session::has("status"))
              <br>

              <div class="alert alert-success">
                {{Session::get("status")}}
              </div>
              @endif

              @if (count($errors) > 0)
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{$error}} </li>
                          @endforeach
                  
                        </ul>
                  </div>             
              @endif
              <!-- form start -->
              <form action="{{ url("admin/updateSlider/".$SLDRS->id) }}" method="POST" enctype="multipart/form-data" >
                @csrf
                @method("PUT")
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Slider description 1</label>
                    <input type="text" value=" {{$SLDRS->description_1}} " name="description1" class="form-control" id="exampleInputEmail1" placeholder="Enter slider description">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Slider description </label>
                    <input type="text"  value=" {{$SLDRS->description_2}}"  name="description2" class="form-control" id="exampleInputEmail1" placeholder="Enter slider description">
                  </div>
                  <label for="exampleInputFile">Slider image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="image" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <!-- <button type="submit" class="btn btn-warning">Submit</button> -->
                  <input type="submit" class="btn btn-warning" value="Update" >
                </div>
              </form>
            </div>
            <!-- /.card --> 
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection


