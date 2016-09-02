<?php
use PHPUnit\Framework\TestCase;

class product {

    private $name;
    private $price;
    private $qnt;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getQnt()
    {
        return $this->qnt;
    }

    /**
     * @param mixed $qnt
     */
    public function setQnt($qnt)
    {
        $this->qnt = $qnt;
    }



}

class CartItem {
    private $Cqnt;
    Private $product;

    /**
     * CartItem constructor.
     * @param $product
     */
    public function __construct($product,$pqnt)
    {
        $this->setCqnt(0);
    }

    /**
     * @return mixed
     */
    public function getCqnt()
    {
        return $this->Cqnt;
    }

    /**
     * @param mixed $Cqnt
     */
    public function setCqnt($Cqnt)
    {
        $this->Cqnt = $Cqnt;
    }

    public function addProduct($product,$pqnt)
    {
        $this->product = $product;
        $vpqnt  = $product->getQnt();
        $cqnt = $this->getCqnt();
        $this->setCqnt($pqnt+$cqnt);
        $product->setQnt($vpqnt-$pqnt);
    }

    public function viewProduct()
    {
       return $this->product;
    }


}

class Cart {
    public $stack = array();

    public function AddToCart($product){
        //print_r(count($this->stack));

        if (!$product instanceof product) {
            return false;
        }


        if (empty($this->stack))
        {
            array_push($this->stack,$product);
        }
        else
        {

            foreach ($this->stack as $key=>$value)
            {
                $vName =  $product->getName();
                $vAName = $this->stack [$key]->getName();

                   if ( strcmp($vAName,$vName) == 0)
                   {
                       print_r('Name match');
                       $vQnt = $product->getQnt();
                       $vAQnt = $this->stack[$key]->getQnt();
                       $this->stack[$key]->setQnt($vQnt+$vAQnt);
                   }
                   else
                   {
                       array_push($this->stack,$product);
                   }
            }


        }

        return true;


    } //eof AddToCart

    public function ViewCart(){
        return $this->stack;
    }//eof ViewCart
}

class ShippingTest extends TestCase
{
    /** @test */
    public function AddToCart()
    {
        $product = new product();
        $product->setName('Tomato');
        $product->setPrice(10);
        $product->setQnt(10);

        $product2 = new product();
        $product2->setName('Tomato');
        $product2->setPrice(10);
        $product2->setQnt(10);

        $product3 = new product();
        $product3->setName('Botato');
        $product3->setPrice(10);
        $product3->setQnt(10);

        $cart1 = new Cart();

        $this->assertEquals(true, $cart1->AddToCart($product));
        $this->assertEquals(true, $cart1->AddToCart($product2));
        $this->assertEquals(true, $cart1->AddToCart($product3));
        print_r($cart1->ViewCart());

    }
}
?>