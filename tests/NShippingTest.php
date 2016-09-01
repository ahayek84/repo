

<?php

/*
File created by N abuSedo.
*/

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
    Private $CQuantity;

    /**
     * @return mixed
     */
    public function getCQuantity()
    {
        return $this->CQuantity;
    }

    /**
     * @param mixed $CQuantity
     */
    public function setCQuantity($CQuantity)
    {
        $this->CQuantity = $CQuantity;
    }

    /**
     * @return mixed
     */
    public function getCproduct()
    {
        return $this->Cproduct;
    }

    /**
     * @param mixed $Cproduct
     */
    public function setCproduct($Cproduct)
    {
        $this->Cproduct = $Cproduct;
    }
    Private $Cproduct = product;



}
class Cart {
    public $stack = array();
    public function AddToCart($product,$NQuantity){ //NQuantity is the needed quantity
        //print_r(count($this->stack));
        if (!$product instanceof product) {
            return false;
        }
        if (empty($this->stack))
        {
            if($NQuantity<$product->getQnt()) {
                $Item = new CartItem();
                $Item->setCproduct($product);
                $Item->setCQuantity($NQuantity);
                array_push($this->stack, $Item);
            }
            else{
                print_r ('the quantity you want is more than exists');
                return false;
            }
        }
        else
        {
            foreach ($this->stack as $key=>$value)
            {
                $NewProduct =$product;
                $CurrentProduct = $this->stack [$key]->getCproduct()->getName();
                if ( strcmp($CurrentProduct,$NewProduct) == 0)
                {
                    print_r('Product exists');
                    $Quantity = $this->stack[$key]->getCQuantity();
                    $this->stack[$key]->setCQuantity($NQuantity+$Quantity);
                }
                else
                {
                    $Item = new CartItem();
                    $Item->setCproduct($product);
                    $Item->setCQuantity($NQuantity);
                    array_push($this->stack,$Item);
                }
            }
        }
        return true;
    } //eof AddToCart
    public function getQuantity(){
        $Sum =0;
        foreach ($this->stack as $key=>$value){
            $Sum+=$this->stack[$key]->getCQuantity();
        }
        return $Sum;
    }
    public function ViewCart(){
        return $this->stack;
    }//eof ViewCart
}

use PHPUnit\Framework\TestCase;
class NShippingTest extends TestCase
{
    /** @test */
    public function product_limttation()
    {
        $product = new Product();
        $cart = new Cart();
        $this->assertEquals(false, $cart->AddToCart($product,1));
        $this->assertEquals(false, $cart->AddToCart($product,1));
    }
    public function product_quantity()
    {
        $product = new Product();
        $cart = new Cart();
        $this->assertGreaterThan(0, $cart->getQuantity());
    }
    /** @test */
    public function add_new_product_or_increase_quantity()
    {
        $cart = new Cart();
        $product1 = new Product();
        $product2 = new Product();
        $product1->setName("A");
        $product2->setName("A");
        $this->assertFalse($cart->AddToCart($product1,2));//if product is a new, method will add product and return True
        $this->assertFalse($cart->AddToCart($product2,2));
        //if product is similar another item , method will increase qunt and return  false
    }
}
