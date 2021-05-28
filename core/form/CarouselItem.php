<?php
namespace app\core\form;
use app\models\Category;
use app\models\Product;
class CarouselItem{

    /**
     * Ruaj nje variabel per kategorine aktive
     * kur te levizi karuseli majtas/djathtas edhe kategoria do zbreze/rritet
     * merr produktet ne baze te kategorise ??ketu ose jo ketu?? edhe shfaqi ne logged_user
     * pjesa e iteracioneve mbase me numra nga array  i produkteve 
     * qe fitohet nga komanda e sql
     * kur ben show more mbase ben add variablave te tjere te arrayt
     */
    public static int $categoryId = 1;
    public int $catNumber = 1;

    public function carouselItem(Category $name, $isActive)
    {
        $activeClass = $isActive ? "active" : "";
        $categoryName = $name->category_name;
        $id = $name->category_id;
      echo  "<div class='carousel-item col-md-4 col-sm-6 col-xs-12 $activeClass'>
                       <div class='panel panel-default  text-center'>
                           <a href='/category?categoryId=$id'>
                               <span class='category-item'>
                                    $categoryName
                               </span>
                           </a>
                        </div>
                    </div>";
    }

    // public function newItem(Category $name)
    // {
    //     echo '<div class="carousel-item col-md-4 col-sm-6 col-xs-12  ">
    //     <div class="panel panel-default text-center">
    //         <a href="#">
    //             <span class="category-item ">
    //             <form action="" method="POST">                
    //             <button type="submit" class="control" name="butoni" value="'.$name->category_id.'">
    //                 '.$name->category_name.'
    //                 </button>
    //              </form>
    //             </span>
    //         </a>
    //      </div>
    //  </div>';
    // }

public function productItem(Product $product)
{
    //ndrroi thonjzat
    $id = $product->id;
    $image = $product->image_Path;
    $description = $product->description;
    echo "<div class='col-md-4 '>
            <div class='product-item-wrapper'>
                <div class='image-wrapper'>
                    <form action='' method='POST'>
                    <a href='/productDetails?productId=$id' name='butoniProdukt' value='$id'>
                    <img id='images' class='img-fluid' src='$image' alt=''>
                    </a>
                    </form>
                </div>
                <div class='product-description'>
                    <p class='product-text'>
                    $description;
                    </p>
                </div>
            </div>
        </div>
    ";
}

    public function changeId(int $number)
    {
        $nr = (self::$categoryId + $number)%self::$categoryId;
        if($nr === 0)
        {
            self::$categoryId = 6;
        }
        elseif ($nr === 7) {
            self::$categoryId = 1;
        }
        else
        {
            self::$categoryId = $nr;
        }

        return  self::$categoryId;
    }
    
    public function setNumber(int $number)
    {
        $catNr = $number;
    }
}