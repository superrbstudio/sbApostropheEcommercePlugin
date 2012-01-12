<h4>Shopping Basket (<?php echo $basket->getNumProducts(); ?>)</h4>
<a class="a-link" href="<?php echo url_for('@sb_ecom_basket'); ?>"><?php echo sbEcomToolkit::costFormat($basket->getCost()); ?></a>
