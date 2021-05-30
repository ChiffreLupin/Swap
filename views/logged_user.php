<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

<script>
//jQuery code
/*
$(document).ready(function() {
    var productCount = 7;
    $(document).on('click', 'button#showMore', function() {
        productCount = productCount + 7;
        //deri ket ne rregull        
        catId = php echo $cid;               
        alert("works" + catId);
        $("#productRows").load("/views/authentication/load-products.php", {
            cid: catId,
            productNewCount: productCount            
        });
        
    });
});   
*/
</script>

<section class="fill-page">
<section id="categories-section">
        <div id="carouselExample" class="carouselPrograms carousel slide" data-ride="carousel" data-interval="false">
            <div class="container" >
                <div class="carousel-inner row w-100 mx-auto" role="listbox">
                    <?php use app\core\form\CarouselItem;
                          use app\core\Application;
                       
                        
                    $carousel = new CarouselItem();
                    $theSelectedCategory = $selectedCategory;
                    $c = $_GET['categoryId'] ?? false;
                    
                    if($selectedCategory > 3) {
                        while($selectedCategory > 3) {
                            $el = array_shift($categories);
                            array_push($categories, $el);
                            $selectedCategory--;
                        }
                    }
                    foreach($categories as $key => $category) {
                        $carousel->carouselItem($category, $selectedCategory == $key);
                    }
                    ?>                                                                              
                    
                </div>
                <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next text-faded"  href="#carouselExample" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                
            </div>
        </div>
    </section>

    <section id="products-section" class="fill-page">
        <div class="container">
            <div class="row" id="productRows">                
            <?php 
            // $i = 0;
            // $limit = 7;
            // $products = new Product();
            // $products = $products->getProducts(['category_id' => $cid]);

            if($products) {
                foreach($products as $key => $product) {
                    $carousel->productItem($product);
                }   
            }
            ?>            
            </div>            
            <?php if($noOfProducts > 7) { ?>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="button-wrapper">
                        <button class="btn btn-white" id="showMore" value="<?php echo $noOfProducts ?>"
                        onclick="loadProducts(<?php echo $theSelectedCategory+1 ?>, <?php echo $c ?>)">
                            Show More
                        </button>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

    </section>

</section>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

