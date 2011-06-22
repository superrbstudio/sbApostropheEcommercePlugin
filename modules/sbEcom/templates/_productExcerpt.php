<h4><a href="<?php echo url_for('@sb_ecom_product?slug=' . $product['slug']); ?>"><?php echo $product['title']; ?></a></h4>
<p>Product excerpt</p>
<strong class="ecom-product-cost">£<?php echo number_format($product['cost'], 2); ?></strong>
<a class="ecom-product-more" href="<?php echo url_for('@sb_ecom_basket_action?action=add&id=' . $product['id']); ?>"><span>Add to basket</span></a>