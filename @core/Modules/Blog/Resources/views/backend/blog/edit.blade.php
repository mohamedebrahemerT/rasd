@extends('backend.admin-master')
@section('style')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <x-summernote.css/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
    <x-media.css/>
    <x-blog-inline-css/>
@endsection
@section('site-title')
    {{__('Edit Blog Post')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h3 class="header-title">{{__('Edit Blog Items')}}   </h3>
                            </div>
                            <div class="header-title d-flex">
                                <div class="btn-wrapper-inner">

                                    <a href="{{ route('admin.blog') }}"
                                       class="btn btn-primary">{{__('All Blog Post')}}
                                    </a>
                                    <a href="{{ route('admin.blog.new') }}"
                                       class="btn btn-info">{{__('Create New')}}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <form action="{{route('admin.blog.update',$blog_post->id)}}" method="post" enctype="multipart/form-data"
                              id="blog_new_form">
                            @csrf
                  <input type="hidden" name="lang" value="{{$default_lang}}">

                    <div class="form-group">
                                <label for="date">{{__('date')}}</label>
             <input type="date" class="form-control" name="date" id="date"
                                       placeholder="{{__('date')}}"
                                        value="{{$blog_post->date}}">
                            </div>

                               <!--div class="form-group">
                                <label for="time">{{__('time')}}</label>
             <input type="time" class="form-control" name="time" id="time"
                                       placeholder="{{__('time')}}"
                                        value="{{$blog_post->time}}">
                            </div -->


                            <div class="form-group">
                                <label for="title">{{__('Title')}}</label>
                                <input type="text" class="form-control" name="title" id="title"
                                       value="{{$blog_post->getTranslation('title',$default_lang)}}">
                            </div>

                                <div class="form-group">
                             <label for="sources_id"><strong>{{__('Select sources')}}</strong></label>
                             <select style="text-align:right;" name="sources_id" class="form-control js-example-basic-single" id="sources_id">
                        @foreach($all_sources as $source)
   <option

   @if($blog_post->sources_id )
 
                {{ $blog_post->id === $source->id ? 'selected' : '' }}
                                                                  
   @endif

    value="{{$source->id}}">  {{purify_html($source->getTranslation('title',$default_lang))}}
   </option>                                         
  @endforeach
                                            </select>
                            </div>

                            <div class="form-group">
                                <label for="url">{{__('url')}}</label>
                                <input type="text" class="form-control" name="url" id="url"
                                       value="{{$blog_post->url}}">
                            </div>

                            <div class="form-group permalink_label">
                                <label class="text-dark">{{__('Permalink * : ')}}
                                    <span id="slug_show" class="display-inline"></span>
                                    <span id="slug_edit" class="display-inline">
                                         <button class="btn btn-warning btn-sm slug_edit_button"> <i class="fas fa-edit"></i> </button>
                                          <input type="text" name="slug" value="{{$blog_post->slug}}" class="form-control blog_slug mt-2" style="display: none">
                                          <button class="btn btn-info btn-sm slug_update_button mt-2" style="display: none">{{__('Update')}}</button>
                                    </span>
                                </label>
                            </div>

                            <div class="form-group">
                                <label>{{__('Blog Content')}}</label>
                                <input type="hidden" name="blog_content" value="{{$blog_post->getTranslation('blog_content',$default_lang)}}">
                                <div class="summernote" data-content="{{$blog_post->getTranslation('blog_content',$default_lang)}}"></div>
                            </div>

                            <div class="form-group">
                                <label for="title">{{__('Excerpt')}}</label>
                                <textarea name="excerpt" id="excerpt" class="form-control max-height-150" cols="30"
                                          rows="10">{{$blog_post->getTranslation('excerpt',$default_lang)}}</textarea>
                            </div>
                    </div>
                </div>

             
            </div>

            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="post_type_radio">
                                    <h6>{{__('Post Type')}}</h6>
                                    <div class="form-check form-check-inline d-block">
                                        @php
                                            $check = $blog_post->video_url || $blog_post->embed_code || $blog_post->video_thumbnail ? 'checked' : ''
                                        @endphp
                                        <input class="form-check-input post_type" type="radio"
                                               name="inlineRadioOptions" checked
                                               id="radio_general" value="option1"
                                        >
                                        <i class="ti-settings"></i>
                                        <label class="form-check-label" for="inlineRadio1">{{__('General')}}</label>
                                    </div>
                                    <div class="form-check form-check-inline d-block">

                                        <input class="form-check-input post_type" type="radio" name="inlineRadioOptions"
                                               id="radio_video" value="option2" {{$check}}>
                                        <i class="ti-video-camera"></i>
                                        <label class="form-check-label" for="inlineRadio2">{{__('Video')}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="video_section" style="display: none">
                            <div class="card mb-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="slug">{{__('Video Url')}}</label>
                                                <input type="text" class="form-control" name="video_url" value=" {!! $blog_post->video_url ?? '' !!}">
                                            </div>

                                            <div class="form-group">
                                                <label for="slug">{{__('Video Duation')}}</label>
                                                <input type="text" class="form-control" name="video_duration" value=" {!! $blog_post->video_duration ?? '' !!}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-12">
                                       <div class="form-group">
                                            <label for="featured"><strong>{{__('Select Categories')}}</strong></label>
                                            <div class="category-section">
                                                

                                                 <select name="category_id[]" class="form-control" id="category_id">
                        @foreach($all_category as $category)
   <option  
       @foreach($blog_post->category_id as $cat)
                                   {{ $cat->id === $category->id ? 'selected' : '' }}
                                                                    @endforeach

   value="{{$category->id}}">  {{purify_html($category->getTranslation('title',$default_lang))}}</option>
                                                
  @endforeach
                                             
                                          
                                            </select>

                                                  
                                               
                                            </div>
                                        </div>


                                        <div class="form-group " id="blog_tag_list">
                                            <label for="title">{{__('Blog Tag')}}</label>


                                                @php
                                                    $tags_arr = json_decode($blog_post->tag_id);
                                                    $tags = is_array($tags_arr) ? implode(",", $tags_arr) : "";
                                                @endphp

                                            <input type="text" class="form-control tags_filed" data-role="tagsinput"
                                                   name="tag_id[]"  value=" {{ $tags }} ">

                                            <div id="show-autocomplete" style="display: none;">
                                                <ul class="autocomplete-warp" ></ul>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="featured"><strong>{{__('Featured')}}</strong></label>
                                            <label class="switch">
                                                <input type="checkbox" name="featured" @if ($blog_post->featured ?? '') checked  @endif >
                                                <span class="slider"></span>
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label for="breaking_news"><strong>{{__('Breaking News')}}</strong></label>
                                            <label class="switch">
                                                <input type="checkbox" name="breaking_news" @if ($blog_post->breaking_news ?? '') checked  @endif >
                                                <span class="slider"></span>
                                            </label>
                                        </div>

                                        <div class="form-group ">
                                            <label for="slug">{{__('Order')}}</label>
                                            <input type="number" class="form-control" name="order_by"
                                                   value="{{$blog_post->order_by ?? ''}}">
                                        </div>
                                        <div id="visibility_list" class="form-group ">
                                            <label for="visibility">{{__('Visibility')}}</label>
                                            <select name="visibility" class="form-control" id="visibility">
                                                <option value="public" @if($blog_post->visibility == 'public') selected @endif >{{__('Public')}}</option>
                                                <option value="logged_user" @if($blog_post->visibility == 'logged_user') selected @endif >{{__('Logged User')}}</option>
                                                <option value="password"@if($blog_post->visibility == 'password') selected @endif >{{__('Password')}}</option>
                                            </select>
                                        </div>

                                        <div class="form-group d-none password-section">
                                            <label for="title">{{__('Blog Password')}}</label>
                                            <div class="d-flex justify-content-between">
                                                <input type="password" class="form-control password" name="password">
                                                <span href="" class="btn btn-primary btn-sm mr-1 password-show"> <i class="las la-eye show-icon d-none"></i> <i class="las la-low-vision close-icon"></i></span>
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <label for="status">{{__('Status')}}</label>
                                            <select name="status" class="form-control" id="status">
                                                <option value="draft" @if($blog_post->status == 'draft') selected @endif>{{__("Draft")}}</option>
                                                <option value="publish"@if($blog_post->status == 'publish') selected @endif>{{__("Publish")}}</option>
                                                <option value="archive"@if($blog_post->status == 'archive') selected @endif>{{__("Archive")}}</option>
                                                <option class="selected_schedule"
                                                        value="schedule"@if($blog_post->status == 'schedule') selected @endif>{{__("Schedule")}}</option>
                                            </select>
                                            @php

                                            @endphp

                                            <input type="date" name="schedule_date" class="form-control mt-2 date" value="{{$blog_post->schedule_date ?? ''}}" style="display: none" id="edit_schedule">

                                        </div>

                                        <div class="form-group">
                                            <label for="og_meta_image">{{__('Blog Image')}}</label>
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap">
                                                    {!! render_attachment_preview_for_admin($blog_post->image ?? '') !!}
                                                </div>
                                                <input type="hidden" id="image" name="image"
                                                       value="{{$blog_post->image}}">
                                                <button type="button" class="btn btn-info media_upload_form_btn"
                                                        data-btntitle="{{__('Select Image')}}"
                                                        data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                        data-target="#media_upload_modal">
                                                    {{'Change Image'}}
                                                </button>
                                            </div>
                                            <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="og_meta_image">{{__('Blog Image Gallery')}}</label>
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap">
                                                    {!! render_gallery_image_attachment_preview($blog_post->image_gallery ?? '') !!}
                                                </div>
                                                <input type="hidden" id="og_meta_image" name="image_gallery"
                                                       value="{{$blog_post->image_gallery ?? ''}}">
                                                <button type="button" class="btn btn-info media_upload_form_btn"
                                                        data-btntitle="{{__('Select Image')}}"
                                                        data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                        data-mulitple="true"
                                                        data-target="#media_upload_modal">
                                                    {{'Change Image'}}
                                                </button>
                                            </div>
                                            <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
                                        </div>


                                        <div class="submit_btn mt-5">
                                            <button type="submit"
                                                    class="btn btn-success">{{__('Save Post ')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    <x-summernote.js/>
    <x-media.js/>

    <script>

        //Date Picker
        flatpickr('#edit_schedule', {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d H:i",
        });

        var blogTagInput = $('#blog_tag_list .tags_filed');
        var oldTag = '';
        blogTagInput.tagsinput();
        //For Tags
        $(document).on('keyup','#blog_tag_list .bootstrap-tagsinput input[type="text"]',function (e) {
            e.preventDefault();
            var el = $(this);
            var inputValue = $(this).val();
            $.ajax({
                type: 'get',
                url :  "{{ route('admin.get.tags.by.ajax') }}",
                async: false,
                data: {
                    query: inputValue
                },

                success: function (data){
                    oldTag = inputValue;
                    let html = '';
                    var showAutocomplete = '';
                    $('#show-autocomplete').html('<ul class="autocomplete-warp"></ul>');
                    if(el.val() != '' && data.markup != ''){


                        data.result.map(function (tag, key) {
                            html += '<li class="tag_option" data-id="'+key+'" data-val="'+tag+'">' + tag + '</li>'
                        })

                        $('#show-autocomplete ul').html(html);
                        $('#show-autocomplete').show();


                    } else {
                        $('#show-autocomplete').hide();
                        oldTag = '';
                    }

                },
                error: function (res){

                }
            });
        });

        $(document).on('click', '.tag_option', function(e) {
            e.preventDefault();

            let id = $(this).data('id');
            let tag = $(this).data('val');
            blogTagInput.tagsinput('add', tag);
            $(this).parent().remove();
            blogTagInput.tagsinput('remove', oldTag);
        });

    </script>


    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                //Status Code

            if($('#status').val() == 'schedule') {
                $('.date').show();
                $('.date').focus();
            }
                $(document).on('change','#status',function(e){
                    e.preventDefault();
                    if ($(this).val() == 'schedule') {
                        $('.date').show();
                        $('.date').focus();
                    } else {
                        $('.date').hide();
                    }
                });

                //Permalink Code
                var sl =  $('.blog_slug').val();
                var url = `{{url('/blog/')}}/` + sl;
                var data = $('#slug_show').text(url).css('color', 'blue');

                var form = $('#blog_new_form');

                $(document).on('keyup', '#title', function (e) {
                    var slug = $(this).val().trim().toLowerCase().split(' ').join('-');
                    var url = `{{url('/'.get_page_slug(get_static_option('blog_page'),'blog').'/')}}/` + slug;
                    $('.permalink_label').show();
                    var data = $('#slug_show').text(url).css('color', 'blue');
                    $('.blog_slug').val(slug);

                });

                //Slug Edit Code
                $(document).on('click', '.slug_edit_button', function (e) {
                    e.preventDefault();
                    $('.blog_slug').show();
                    $(this).hide();
                    $('.slug_update_button').show();
                });

                //Slug Update Code
                $(document).on('click', '.slug_update_button', function (e) {
                    e.preventDefault();
                    $(this).hide();
                    $('.slug_edit_button').show();
                    var update_input = $('.blog_slug').val();
                    var slug = update_input.trim().toLowerCase().split(' ').join('-');
                    var url = `{{url('/blog/')}}/` + slug;
                    $('#slug_show').text(url);
                    $('.blog_slug').hide();
                });
                checkPostStatus();
                function checkPostStatus(){
                    if ($('#status').val() == 'schedule') {
                        $('.date').show();
                        $('.date').focus();
                    } else {
                        $('.date').hide();
                    }
                }
                $(document).on('change','#status',function(e){
                    e.preventDefault();
                    if ($(this).val() == 'schedule') {
                        $('.date').show();
                        $('.date').focus();
                    } else {
                        $('.date').hide();
                    }
                });


                <x-btn.submit/>
                $(document).on('change', '#langchange', function (e) {
                    $('#langauge_change_select_get_form').trigger('submit');
                });

                $(document).on('change', '.post_type', function () {
                    var val = $(this).val();
                    if (val === 'option2') {
                        $('.video_section').show();
                    } else {
                        $('.video_section').hide();
                    }
                })

            });

            if('{{$check}}'){
                $('.video_section').show();
            }


            $('.summernote').summernote({
                height: 400,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function (contents, $editable) {
                        $(this).prev('input').val(contents);
                    }
                }
            });
            if ($('.summernote').length > 0) {
                $('.summernote').each(function (index, value) {
                    $(this).summernote('code', $(this).data('content'));
                });
            }
            
          
        })(jQuery)
        
          
            //Visibility Password Code
            $(document).on('change', '#visibility', function (e) {
                if( $(this).val() === 'password'){
                    $('.password-section').removeClass('d-none');
                }else{
                    $('.password-section').addClass('d-none');
                }
            });

            $(document).on('mousedown', '.password-show', function (e) {
                e.preventDefault();
                let paswd= $('.password');
                paswd.attr("type","text");
                $('.password-show').attr("value","hide");
                $('.show-icon').removeClass('d-none');
                $('.close-icon').addClass('d-none');
            });

            $(document).on('mouseup', '.password-show', function (e) {
                e.preventDefault();
                let paswd= $('.password');
                paswd.attr("type","password");
                $('.password-show').attr("value","show");
                $('.show-icon').addClass('d-none');
                $('.close-icon').removeClass('d-none');
            });

            let exist_password_value = '{{$blog_post->password }}';
            let password = $('.password');

            if($('#visibility').val() == 'password'){
                $('.password-section').removeClass('d-none');
                 password.val(exist_password_value);
            }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
        
    </script>
@endsection
