<?php $__env->startSection('content'); ?>


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

<?php
use App\Helpers\LanguageHelper;
$all_category = App\BlogCategory::select(['id','title','status','image'])->get();
$all_source = App\Blogsources::select(['id','title','status','image'])->get();
$blogs = App\Blog::get();
        $default_lang = $request->lang ?? LanguageHelper::default_slug();
 
 
?>

<br>
                               

                                   <div class="container">


        <div class="row">
            <div class="col-lg-12">
                 <h4>التصنيفات الرئيسية</h4>
                    <br>
                 <div class="row">


                      <?php $__currentLoopData = $all_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="col-lg-2">
                 <h5>  
         <a href="">
             <?php echo e($data->getTranslation('title', $default_lang ,true)); ?>

             
         </a>
                 </h5>
                </div>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
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
                        <?php $__currentLoopData = $all_source; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="col-lg-2">
                 <h5>  
         <a href="">
         <?php
                                                   $testimonial_img = get_attachment_image_by_id($data->image,null,true);
                                               ?>
                                               <?php if(!empty($testimonial_img)): ?>
                                                   <div class="attachment-preview">
                                                       <div class="thumbnail">
                                                           <div class="centered">
                                                               <img class="avatar user-thumb"
                                                                    src="<?php echo e($testimonial_img['img_url']); ?>" alt="">
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <?php  $img_url = $testimonial_img['img_url']; ?>
                                               <?php endif; ?>
             
         </a>
                 </h5>
                </div>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                 </div>
            </div>
            
        </div>
        
    </div>

    <div class="container">


        <div class="row">
            <div class="col-lg-12">
                <table class="table" id="example">
  <thead>
    <tr>
          <th scope="col"> تاريخ النشر  </th>
      <th scope="col">المحور</th>
      <th scope="col">عنوان الخبر</th>
      <th scope="col">المصدر</th>
      <th scope="col"> ملخص الخبر</th>
  
    </tr>
  </thead>
  <tbody>
                      <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <tr>
             <td> <?php echo e($data->created_at); ?></td>
      <td>

           <?php $__currentLoopData = $data->category_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php
                                  $category_id=$cat->id;
                                  ?>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php
$Category = App\BlogCategory::where('id',$category_id)->first();
?>

        <?php echo e($Category->getTranslation('title',$default_lang,true)); ?>


           
      </td>
      <td>
        <a href="<?php echo e($data->url); ?>" target="_blank"> 
        <?php echo e($data->getTranslation('title',$default_lang,true)); ?>

        </a>
    </td>
      <td> 

        <?php
      
        $Blogsource = App\Blogsources::where('id',$data->sources_id)->first();
        ?>

        <?php if( $Blogsource ): ?>
   
             <?php echo e($Blogsource->getTranslation('title','ar',true)); ?>


        <?php endif; ?>

           

              
      </td>
      <td>
          <a class="submit-btn btn-default" href="<?php echo e(url('/')); ?>/الاخبار/<?php echo e($data->slug); ?>"><i class="fa fa-eye"> </i>عرض </a>

         
      </td>

    </tr>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

   
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\dashboard\rasd\@core\resources\views/frontend/frontend-home.blade.php ENDPATH**/ ?>