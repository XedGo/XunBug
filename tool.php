<?php  
/* 
 *   Template Name: tool工具
 *   Description: 2 * 
 *   @package Bouquet 
 *  
 */   
?>  
<?php get_header(); ?>  
  
  
  
<?php  
$args=array(  
'parent'=>'278',  
'hide_empty'=>0  
);  
$categories = get_categories($args);  
foreach ($categories as $cat) {  
$catid = $cat->cat_ID;  
?>  
  
       <div class="div_post">  
         <div id="caption1">  
           <div class="div_detail">  
              <b><a href="<?php echo get_category_link($cat->cat_ID);?>" alt="<?php echo $cat->cat_name; ?>" title="<?php echo  $cat->cat_name; ?>"><?php echo  $cat->cat_name; ?> </a></b>   
           </div>   
        </div>  
      </div>  
  
   
<?php     
  
  }  
  
  ?>  
<?php get_footer(); ?>  