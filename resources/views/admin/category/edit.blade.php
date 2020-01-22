@extends('layouts.backend.app')

@section('title','Category')
@push('css')

@endpush

@section('content')
<div class="container-fluid">
            

            <!-- Vertical Layout -->
           
            <!-- #END# Vertical Layout -->
            <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               Edit Category
                                 </h2>
                        </div>
                        <div class="body">
                             <h1>{{Session::get('message')}}</h1>
                            <form action="{{route('admin.category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Category name</label>
                                        <input type="text" id="name" class="form-control" name="name"  value="{{$category->name}}">
                                        
                                    </div>
                                </div>
                               <div class="form-group">
                                    <input type="file" name="image">
                               </div>
                               <a class="btn btn-danger m-t-15 waves-effect" href="{{route('admin.category.index')}}">Back</a>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>

                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->
            <!-- Horizontal Layout -->
           
            <!-- #END# Multi Column -->
        </div>
@endsection

@push('js')

@endpush