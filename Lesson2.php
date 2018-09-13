<?php
//  1. Создать структуру классов ведения товарной номенклатуры.
//  а) Есть абстрактный товар.
//  б) Есть цифровой товар, штучный физический товар и товар на вес.
//  в) У каждого есть метод подсчета финальной стоимости.
//  г) У цифрового товара стоимость постоянная – дешевле штучного товара в два раза. У штучного товара обычная
//  стоимость, у весового – в зависимости от продаваемого количества в килограммах. У всех формируется
//  в конечном итоге доход с продаж.
//  д) Что можно вынести в абстрактный класс, наследование?

abstract class Product
{
	public $name;
	public $price;
	public $quantity;

	public function __construct(string $name)
	{
		$this->name = $name;
	}

	public function cost() {
		return $this->price * $this->quantity;
	}

	public function revenue() {
		return $this->cost() * 0.1;
	}
}

class PieceProduct extends Product
{
	public function __construct(string $name, float $price, int $quantity = 1)
	{
		parent::__construct($name);
		$this->price = $price;
		$this->quantity = $quantity;
	}
}

class DigitalProduct extends Product
{
	public function __construct(PieceProduct $piece)
	{
		$this->name = $piece->name.' | DIGITAL |';
		$this->price = $piece->price / 2;
		$this->quantity = 1;
	}
}

class WeightProduct extends Product
{
	public function __construct(string $name, float $startPrice, float $quantity)
	{
		parent::__construct($name);
		$this->quantity = $quantity;
		if ($quantity <= 1) {
			$this->price = $startPrice;
		} elseif ($quantity > 1 and $quantity <= 10) {
			$this->price = $startPrice * 0.75;
		} else {
			$this->price = $startPrice * 0.5;
		}
	}
}
$book = new PieceProduct('Harry Potter 2', 103.54, 24);
$digit = new DigitalProduct($book);
$weight = new WeightProduct('tomat', 7.94, 15);
echo $book->cost() . "\n";
echo $digit->cost() . "\n";
echo $weight->cost() . "\n";
echo $weight->revenue() . "\n";



//  2. *Реализовать паттерн Singleton при помощи traits.
trait Singleton
{
	private static $instance;

	private function __construct() {}
	private function __clone()     {}
	private function __wakeup()    {}

	public function getInstance() {
		if (empty(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}

class newSingleton {
	use Singleton;

	private $a = 0;
	public function doAction() {
		echo $this->a++ . "\n";
	}
}

$one = newSingleton::getInstance();
$two = newSingleton::getInstance();
$one->doAction();
$two->doAction();
$one->doAction();
$two->doAction();
$one->doAction();