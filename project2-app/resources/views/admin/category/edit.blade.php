@extends('admin.master')

@section('title')
    Dashboard | Edit Category Page
@endsection

@section('body')
    <div class=" form-grids row form-grids-right">
        <div class="widget-shadow " data-example-id="basic-forms">
            <div class="form-title">
                <h4>Edit Category Form</h4>
                <h4 class="text-center text-success">{{Session::get('message')}}</h4>
            </div>
            <div class="form-body">
                <form class="form-horizontal" action="{{route('category.update', ['id' => $category->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Category Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" value="{{$category->name}}" class="form-control" id="inputEmail3"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Category Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="description" id="inputPassword3">{{$category->description}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Category Image</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control-file" name="image"/>
                            <img src="{{asset($category->image)}}" alt="" height="90" width="75">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Publication</label>
                        <div class="col-sm-9">
                            <label><input type="radio" {{$category->status == 1 ? 'checked' : ''}} name="status" value="1" />published</label>
                            <label><input type="radio" {{$category->status == 0 ? 'checked' : ''}} name="status" value="0"/>unpublished</label>
                        </div>
                    </div>

                    <div class="col-sm-offset-2">
                        <button type="submit" class="btn btn-default">Update Category Info</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

