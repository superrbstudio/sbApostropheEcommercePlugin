<h4><a href="<?php echo url_for('@sb_ecom_categories?slug=' . $category->getSlug()); ?>"><?php echo $category->getName(); ?></a></h4>
<p>Category Description</p>
<a class="ecom-category-more" href="<?php echo url_for('@sb_ecom_categories?slug=' . $category->getSlug()); ?>"><span>Read more</span></a>