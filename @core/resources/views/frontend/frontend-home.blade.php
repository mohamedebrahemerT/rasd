@extends('frontend.frontend-master')
@section('content')


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

<style type="text/css">
    .btn-default {
  font-size: 16px;
  display: inline-block;
  text-align: center;
  font-weight: 500;
  cursor: pointer;
  border: 1px solid var(--main-color-one);
  background-color: var(--main-color-one);
  color: #fff;
  text-transform: capitalize;
  padding: 10px 30px 11px;
  -webkit-transition: all linear .2s;
  transition: all linear .2s;
  line-height: 20px;
}
    
</style>

@php
use App\Helpers\LanguageHelper;
$all_category = App\BlogCategory::select(['id','title','status','image'])->get();
$all_source = App\Blogsources::select(['id','title','status','image'])->get();
$blogs = App\Blog::get();
        $default_lang = $request->lang ?? LanguageHelper::default_slug();
 
 
@endphp

<br>
                               

                                   <div class="container">


        <div class="row">
            <div class="col-lg-12">
                 <h4>التصنيفات الرئيسية</h4>
                    <br>
                 <div class="row">


                      @foreach($all_category as $data)

                <div class="col-lg-2">
                 <h5>  
         <a href="">
             {{$data->getTranslation('title', $default_lang ,true)}}
             
         </a>
                 </h5>
                </div>
                                   @endforeach 
                 </div>
            </div>
            
        </div>
        <br>
    </div>


 
 


                <div class="container">


        <div class="row">
            <div class="col-lg-12">
                   <h4> المصادر</h4>
                    <br>
                 <div class="row">
                        @foreach($all_source as $data)

                <div class="col-lg-2">
                 <h5>  
         <a href="">
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
             
         </a>
                 </h5>
                </div>
                                   @endforeach 
                 </div>
            </div>
            
        </div>
        
    </div>

    <div class="container">


        <div class="row">
            <div class="col-lg-12">
                <table class="table" id="example" style="text-align: center;">
  <thead>
    <tr style="text-align: center;">
          <th scope="col" style="text-align: center;"> تاريخ النشر  </th>
      <th scope="col" style="text-align: center;">المحور</th>
      <th scope="col" style="text-align: center;">عنوان الخبر</th>
      <th scope="col" style="text-align: center;">المصدر</th>
      <th scope="col" style="text-align: center;"> ملخص الخبر</th>
  
    </tr>
  </thead>
  <tbody>
                      @foreach($blogs as $data)

    <tr>
             <td> {{$data->created_at}}</td>
      <td>

           @foreach($data->category_id as $cat)
                                  @php
                                  $category_id=$cat->id;
                                  @endphp
               @endforeach

@php
$Category = App\BlogCategory::where('id',$category_id)->first();
@endphp

        {{$Category->getTranslation('title',$default_lang,true)}}

           
      </td>
      <td>
        <a href="{{$data->url}}" target="_blank"> 
        {{$data->getTranslation('title',$default_lang,true)}}
        </a>
    </td>
      <td> 

        @php
      
        $Blogsource = App\Blogsources::where('id',$data->sources_id)->first();
        @endphp

        @if( $Blogsource )
   
             {{$Blogsource->getTranslation('title','ar',true)}}

        @endif

           

              
      </td>
      <td>
          <a class="submit-btn btn-default" href="{{url('/')}}/الاخبار/{{$data->slug}}"><i class="fa fa-eye"> </i>عرض </a>

         
      </td>

    </tr>
                                   @endforeach 

   
  </tbody>
</table>
            </div>
            
        </div>
        
    </div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
    $('#example').DataTable();
});
    
</script>
@endsection
