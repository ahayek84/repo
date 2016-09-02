<?php
use PHPUnit\Framework\TestCase;
//Edited by Eng.Abdullrahman Elhayek .. Email; ahayek84@gmail.com
//Test active 

abstract class product {

    private $name;
    private $price;
    private $ProductQnt;

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
    public function getProductQnt()
    {
        return $this->ProductQnt;
    }

    /**
     * @param mixed $qnt
     */
    public function setProductQnt($qnt)
    {
        $this->ProductQnt = $qnt;
    }



}

class CartItem extends product{
    private $CartItemQnt;

    /**
     * CartItem constructor.
     * @param $product
     */
    public function __construct()
    {
        $this->setCartItemQnt(0);
    }

    /**
     * @return mixed
     */
    public function getCartItemQnt()
    {
        return $this->CartItemQnt;
    }

    /**
     * @param mixed $Cqnt
     */
    public function setCartItemQnt($Cqnt)
    {
        $this->CartItemQnt = $Cqnt;
    }

}

class Cart {
    public $stack = array();

    public function AddToCart($CartItem){
        //print_r(count($this->stack));

        if (!$CartItem instanceof CartItem) {
            return false;
        }


        if (empty($this->stack))
        {
            array_push($this->stack,$CartItem);
        }
        else
        {

            foreach ($this->stack as $key=>$value)
            {
                $vName =  $CartItem->getName();
                $vAName = $this->stack [$key]->getName();

                   if ( strcmp($vAName,$vName) == 0)
                   {
                       //print_r('Name match');
                       $vQnt = $CartItem->getCartItemQnt();
                       $vAQnt = $this->stack[$key]->getCartItemQnt();
                       $this->stack[$key]->setCartItemQnt($vQnt+$vAQnt); // how much item in cart
                       $this->stack[$key]->setProductQnt($this->stack[$key]->getProductQnt()+$CartItem->getProductQnt()); //sum of all products items
                   }
                   else
                   {
                       array_push($this->stack,$CartItem);
                   }
            }


        }

        return true;


    } //eof AddToCart

    public function ViewCart(){
        return $this->stack;
    }//eof ViewCart
}

class ShippingMTest extends TestCase
{
    /** @test */
    // This function performs all tests
    // Cart can add endless cartItems
    // Quantity is calculated for the CartItem and the Product
    // Result is viewed
    public function AddToCart()
    {
        //New cart Item added
        $CartItem1 = new CartItem();
        $CartItem1->setName('Tomato');
        $CartItem1->setPrice(10);
        $CartItem1->setProductQnt(10);
        $CartItem1->setCartItemQnt(5);

        //New cart Item added
        $CartItem2 = new CartItem();
        $CartItem2->setName('Tomato');
        $CartItem2->setPrice(10);
        $CartItem2->setProductQnt(10);
        $CartItem2->setCartItemQnt(5);

        //New cart Item added
        $CartItem3 = new CartItem();
        $CartItem3->setName('Botato');
        $CartItem3->setPrice(10);
        $CartItem3->setProductQnt(10);
        $CartItem3->setCartItemQnt(5);


        $cart1 = new Cart();

        $this->assertEquals(true, $cart1->AddToCart($CartItem1));
        $this->assertEquals(true, $cart1->AddToCart($CartItem2));
        $this->assertEquals(true, $cart1->AddToCart($CartItem3));
        print_r($cart1->ViewCart());

    }
}
?>