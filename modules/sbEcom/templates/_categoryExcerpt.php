<h4><a href="<?php echo url_for('@sb_ecom_categories?cat=' . $category['slug']); ?>"><?php echo $category['name']; ?></a></h4>
<p>Category Description</p>
<a class="ecom-category-more" href="<?php echo url_for('@sb_ecom_categories?cat=' . $category['slug']); ?>"><span>Read more</span></a>