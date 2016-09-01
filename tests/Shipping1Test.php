<?php
use PHPUnit\Framework\TestCase;

class product {

    private $name;
    private $price;

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
    private $qnt;


}

class Cart {
    public $stack = array();

    public function AddToCart($product){
        //print_r(count($this->stack));

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

            /*for($i=0;$i<=count($this->stack);$i++)
            {
                    $vName =  $product->getName();
                    $vAName = $this->stack[$i]->getName();
                    print_r($vName);
                    print_r($vAName);

                    if ( strcmp($vAName,$vName) == 0)
                    {
                        print_r('Name match');
                        $vQnt = $product->getQnt();
                        $vAQnt = $this->stack[$i]->getQnt();
                        $this->stack[$i]->setQnt($vQnt+$vAQnt);
                    }
                    else
                    {
                        array_push($this->stack,$product);
                    }

            }*/
        }


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

        $this->assertEquals(0, $cart1->AddToCart($product));
        $this->assertEquals(0, $cart1->AddToCart($product2));
        $this->assertEquals(0, $cart1->AddToCart($product3));
        print_r($cart1->ViewCart());

    }
}
?>