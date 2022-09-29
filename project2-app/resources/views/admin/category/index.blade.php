@extends('admin.master')

@section('title')
    Dashboard | Add Category Page
@endsection

@section('body')
    <div class=" form-grids row form-grids-right">
        <div class="widget-shadow " data-example-id="basic-forms">
            <div class="form-title">
                <h4>Add Category Form</h4>
                <h4 class="text-center text-success">{{Session::get('message')}}</h4>
            </div>
            <div class="form-body">
                <form class="form-horizontal" action="{{route('category.new')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Category Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" id="inputEmail3"/>
                            <span class="text-danger">{{$errors->has('name') ? $errors->first('name') : ''}}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Category Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="description" id="inputPassword3"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Category Image</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control-file" name="image"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Publication Status</label>
                        <div class="col-sm-9">
                            <label><input type="radio" name="status" value="1" checked>published</label>
                            <label><input type="radio" name="status" value="0">unpublished</label>
                        </div>
                    </div>

                    <div class="col-sm-offset-2">
                        <button type="submit" class="btn btn-default">Create New Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
