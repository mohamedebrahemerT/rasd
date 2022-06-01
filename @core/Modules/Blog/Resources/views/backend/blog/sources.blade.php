@extends('backend.admin-master')
@section('site-title')
    {{__('Blog sources')}}
@endsection
@section('style')
   <x-datatable.css/>
    <x-media.css/>
@endsection
@section('content')
  <div class="col-lg-12 col-ml-12 padding-bottom-30">
       <div class="row">
           <div class="col-lg-12">
               <div class="margin-top-40"></div>
               <x-msg.success/>
               <x-msg.error/>
           </div>
           <div class="col-lg-12 mt-5">
               <div class="card">
                   <div class="card-body">
                       <div class="header-wrap d-flex justify-content-between">
                           <div class="left-content">
                               <h4 class="header-title">{{__('All sources')}}  </h4>
                               @can('blog-sources-delete')
                               <x-bulk-action/>
                               @endcan
                           </div>
                           <div class="header-title d-flex">
                               <div class="btn-wrapper-inner">
                                   <form action="{{route('admin.blog.sources')}}" method="get" id="langauge_change_select_get_form">
                                       <x-lang.select :name="'lang'" :selected="$default_lang" :id="'langchange'"/>
                                   </form>
                               </div>
                               <div class="btn-wrapper-inner ml-2">
                                   <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#sources_add_modal">{{__('Add New')}}</button>
                               </div>
                           </div>
                       </div>
                           <div class="table-wrap table-responsive">
                               <table class="table table-default">
                                   <thead>
                                   <th class="no-sort">
                                      <div class="mark-all-checkbox">
                                          <input type="checkbox" class="all-checkbox">
                                      </div>
                                  </th>
                                   <th>{{__('ID')}}</th>
                                   <th>{{__('Image')}}</th>
                                   <th>{{__('Name')}}</th>
                                   <th>{{__('Status')}}</th>
                                   <th>{{__('Action')}}</th>
                                   </thead>
                                   <tbody>
                                   @foreach($all_sources as $data)
                                       <tr>
                                         <td>
                                             <div class="bulk-checkbox-wrapper">
                                                 <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                             </div>
                                         </td>
                                           <td>{{$data->id}}</td>
                                           <td>
                                               @php
                                                   $testimonial_img = get_attachment_image_by_id($data->image,null,true);
                                               @endphp
                                               @if (!empty($testimonial_img))
                                                   <div class="attachment-preview">
                                                       <div class="thumbnail">
                                                           <div class="centered">
                                                               <img class="avatar user-thumb"
                                                                    src="{{$testimonial_img['img_url']}}" alt="">
                                                           </div>
                                                       </div>
                                                   </div>
                                                   @php  $img_url = $testimonial_img['img_url']; @endphp
                                               @endif
                                           </td>
                                           <td>{{$data->getTranslation('title',$default_lang,true)}}</td>

                                           <td>
                                               @if($data->status == 'draft')
                                                   <span class="alert alert-primary" >{{__('Draft')}}</span>
                                               @else
                                                   <span class="alert alert-success" >{{__('Publish')}}</span>
                                               @endif
                                           </td>

                                           <td>
                                               @can('blog-sources-delete')
                                                  <x-delete-popover-all-lang :url="route('admin.blog.sources.delete.all.lang',$data->id)"/>
                                               @endcan



                                             @can('blog-sources-edit')

                                               <a href="#"
                                                  data-toggle="modal"
                                                  data-target="#sources_edit_modal"
                                                  class="btn btn-lg btn-primary btn-sm mb-3 mr-1 sources_edit_btn"
                                                  data-id="{{$data->id}}"
                                                  data-title="{{$data->getTranslation('title',$default_lang )}}"
                                                  data-status="{{$data->status}}"
                                                  data-imageid="{{$data->image}}"
                                                  data-image="{{$img_url}}"
                                               >
                                                   <i class="ti-pencil"></i>
                                               </a>
                                              @endcan

                                           </td>
                                       </tr>
                                   @endforeach
                                   </tbody>
                               </table>
                         </div>
                   </div>
               </div>
           </div>

           @can('blog-sources-create')
               <div class="modal fade" id="sources_add_modal" aria-hidden="true">
                   <div class="modal-dialog modal-lg">
                       <div class="modal-content">
                           <div class="modal-header">
                               <h5 class="modal-title">{{__('Create sources')}}</h5>
                               <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                           </div>
                           <form action="{{route('admin.blog.sources.store')}}"  method="post">
                               <div class="modal-body">
                                   @csrf
                                   <input type="hidden" name="lang" value="{{$default_lang}}">
                                   <div class="form-group">
                                       <label for="edit_name">{{__('Title')}}</label>
                                       <input type="text" class="form-control"  name="title" placeholder="{{__('Title')}}">
                                   </div>

                                   <div class="form-group ">
                                       <label for="image">{{__('Blog Image')}}</label>
                                       <div class="media-upload-btn-wrapper">
                                           <div class="img-wrap"></div>
                                           <input type="hidden" name="image">
                                           <button type="button" class="btn btn-info media_upload_form_btn"
                                                   data-btntitle="{{__('Select Image')}}"
                                                   data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                   data-target="#media_upload_modal">
                                               {{__('Upload Image')}}
                                           </button>
                                       </div>
                                   </div>


                                   <div class="form-group">
                                       <label for="edit_status">{{__('Status')}}</label>
                                       <select name="status" class="form-control" id="edit_status">

                                       

                                           <option value="publish">{{__("Publish")}}</option>

                                               <option value="draft">{{__("Draft")}}</option>

                                               
                                       </select>
                                   </div>


                               </div>
                               <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                                   <button id="submit" type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                               </div>
                           </form>
                       </div>
                   </div>
               </div>
           @endcan

       </div>
   </div>

  @can('blog-sources-edit')
   <div class="modal fade" id="sources_edit_modal" aria-hidden="true">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">{{__('Update sources')}}</h5>
                   <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
               </div>
               <form action="{{route('admin.blog.sources.update')}}"  method="post">
                   <input type="hidden" name="id" id="sources_id">
                   <div class="modal-body">
                       @csrf
                       <input type="hidden" name="lang" value="{{$default_lang}}">
                       <div class="form-group">
                           <label for="edit_name">{{__('Title')}}</label>
                           <input type="text" class="form-control"  id="edit_title" name="title" >
                       </div>

                       <div class="form-group">
                           <label for="image">{{__('Image')}}</label>
                           <div class="media-upload-btn-wrapper">
                               <div class="img-wrap"></div>
                               <input type="hidden" id="edit_image" name="image" value="">
                               <button type="button" class="btn btn-info media_upload_form_btn"
                                       data-btntitle="{{__('Select Image')}}"
                                       data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                       data-target="#media_upload_modal">
                                   {{__('Upload Image')}}
                               </button>
                           </div>
                           <small>{{__('360x360 px image recommended')}}</small>
                       </div>

                       <div class="form-group">
                           <label for="edit_status">{{__('Status')}}</label>
                           <select name="status" class="form-control" id="edit_status">
                               <option value="draft">{{__("Draft")}}</option>
                               <option value="publish">{{__("Publish")}}</option>
                           </select>
                       </div>

                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                       <button id="update" type="submit" class="btn btn-primary">{{__('Save Change')}}</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
@endcan
  <x-media.markup/>


@endsection
@section('script')
    <script>
        (function ($){
            "use strict";
            $(document).ready(function () {
                <x-bulk-action-js :url="route('admin.blog.sources.bulk.action')" />
                <x-btn.submit/>
                <x-btn.save/>
                <x-btn.update/>

                $(document).on('change','#langchange',function(e){
                    $('#langauge_change_select_get_form').trigger('submit');
                });

                $(document).on('click','.sources_edit_btn',function(){
                   var el = $(this);
                   var id = el.data('id');
                   var title = el.data('title');
                   var status = el.data('status');
                   var order_by = el.data('order');
                   var modal = $('#sources_edit_modal');
                    var image = el.data('image');
                    var imageid = el.data('imageid');

                   modal.find('#sources_id').val(id);
                   modal.find('#edit_status option[value="'+status+'"]').attr('selected',true);
                   modal.find('#edit_title').val(title);
                   $('#edit_order_by').val(order_by);

                    if (imageid != '') {
                        modal.find('.media-upload-btn-wrapper .img-wrap').html('<div class="attachment-preview"><div class="thumbnail"><div class="centered"><img class="avatar user-thumb" src="' + image + '" > </div></div></div>');
                        modal.find('.media-upload-btn-wrapper input').val(imageid);
                        modal.find('.media-upload-btn-wrapper .media_upload_form_btn').text('Change Image');
                    }

               });
            });
        })(jQuery)
    </script>
    <x-datatable.js/>
    <x-media.js/>
@endsection
