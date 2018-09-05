<?php
//  1. Придумать класс, который описывает любую сущность из предметной области
//  интернет-магазинов: продукт, ценник, посылка и т.п.
//  2. Описать свойства класса из п.1 (состояние).
//  3. Описать поведение класса из п.1 (методы).
class Product
{
    protected $name;
    protected $price;
    protected $stockQuantity;

    public function __construct(string $name, float $price, int $stockQuantity)
    {
        $this->name = $name;
        $this->price = $price;
        $this->stockQuantity = $stockQuantity;
    }

    public function getName()
    {
        echo "Название: $this->name \n";
    }

    public function setName($newName)
    {
        $this->price = $newName;
    }

    public function getPrice()
    {
        echo "Цена: $this->price \n";
    }

    public function setPrice($newPrice)
    {
        $this->price = $newPrice;
    }
}

$phone1 = new Product('Xiaomi', 500.56, 1000);
$phone1->getName();
$phone1->getPrice();
$phone1->setPrice(700);
$phone1->getPrice();



//  4. Придумать наследников класса из п.1. Чем они будут отличаться?
class Car extends Product
{
    protected $brand;

    public function __construct(string $name, float $price, int $stockQuantity, string $brand)
    {
        parent::__construct($name, $price, $stockQuantity);
        $this->brand = $brand;
    }

    public function getName()
    {
        parent::getName();
        echo "Марка: $this->brand \n";
    }
}
$car1 = new Car('4X4', 123456.70, 10, 'LADA');
$car1->getName();



//  5. Дан код:
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();
//  Что он выведет на каждом шаге? Почему?
//  Так как переменная x статическая, а объекты а1 и а2 являются экземплярами одного и того же класса,
//  то при каждом вызове метода foo, не важно у какого объекта переменная x будет увеличиваться на 1 и выводиться.


//  6. Немного изменим п.5:
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A();
$b1 = new B();
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();
//  Объясните результаты в этом случае.
//  Так как классов теперь 2 то и переменных х теперь тоже 2, одна у объекта a1, другая у объекта b1, поэтому
//  при вызове метода foo переменная будет увеличиваться в зависимости от объекта.



//  7. *Дан код:
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A;
$b1 = new B;
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();
//  Этот вариант полностью аналогичен предыдущему и он допустим, если нет конструктора, например.