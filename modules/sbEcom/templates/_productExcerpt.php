<h4><a href="<?php echo url_for('@sb_ecom_product?slug=' . $product->getSlug()); ?>"><?php echo $product->getTitle(); ?></a></h4>
<p>Product excerpt</p>
<p class="ecom-product-cost">£<?php echo number_format($product->getCost(), 2); ?></p>