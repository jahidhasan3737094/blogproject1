@extends('layouts.backend.app')
@section('title','Tag')

@push('css')
 <!-- JQuery DataTable Css -->
 <link href="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
        <h1>{{Session::get('message')}}</h1>
            <div class="block-header">
               <a class="btn btn-primary waves-effect" href="{{route('admin.tag.create')}}"><i class="material-icons">add</i><span>Add new Tag</span></a>
            </div>
            <!-- Basic Examples -->
           
            <!-- #END# Basic Examples -->
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                All Tags
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>created_at</th>
                                            <th>updated_at</th>
                                            <th>Action</td>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            
                                        <th>ID</th>
                                            <th>Name</th>
                                            <th>created_at</th>
                                            <th>updated_at</th>
                                            <th>Action</td>
                                        </tr>
                                    </tfoot>
                                   <tbody>
                                   @foreach($tags as $key=>$tag)
                                     <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$tag->name}}</td>
                                        <td>{{$tag->created_at}}</td>
                                        <td>{{$tag->updated_at}}</td>
                                        <td class="center">
                                        <a href="{{route('admin.tag.edit',$tag->id)}}">
                                        <i class="material-icons">edit</i>
                                        </a>
                                           
                                         
                                        </td>
                                        <td>
                                       
                                           <form id="delete-form-{{$tag->id}}" action="{{route('admin.tag.destroy',$tag->id)}}" method="POST" >
                                               @csrf
                                               @method('DELETE')
                                           
                                               <button class="btn btn-danger waves-effect" type="submit">
                                           <i class="material-icons">delete</i> </button>
                                           </form>
                                        </td>
                                     </tr>
                                   @endforeach
                                   </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
@endsection

@push('js')
<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

    <script src="{{asset('assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    
@endpush