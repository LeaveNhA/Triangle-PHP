<?php

class Triangle {
	private $all_ = [];

	static private $exceptionMessages
		= [
			'typeExceptionMessage'  => 'Sayısal bir değer bekleniyordu, alınan değer: ',
			'valueExceptionMessage' => 'Üzgünüm, bu bir üçgen değil!',
		];

	static private $returnValues
		= [
			'equilateral' => 'equilateral',
			'isosceles' => 'isosceles',
			'scalene' => 'scalene'
		];

	function __construct($x, $y, $z)
	{
		$this->all_ = [$x, $y, $z];
	}

	private function all(): Array
	{
		return $this->all_;
	}

	private static function checkSum(Array $v): bool
	{
		return array_pop($v) + array_pop($v) >= array_pop($v);
	}

	private static function areAllEqual(Array $v) : bool
	{
		return count(array_unique($v)) === 1;
	}

	private static function areIsosceles(Array $v) : bool
	{
		return count(array_unique($v)) === 2;
	}

	public function kind(): string
	{
		foreach ($this->all() as $check)
		{
			if ( ! is_numeric($check) || $check <= 0)
			{
				throw new Exception(
					self::$exceptionMessages['typeExceptionMessage'].$check
				);
			}
		}

		foreach ([0, 1, 2] as $offset)
		{
			if ( ! self::checkSum(array_slice(array_merge($this->all(),
				$this->all()), $offset, 3))
			)
			{
				throw new Exception(self::$exceptionMessages['valueExceptionMessage']);
			}
		}

		if(self::areAllEqual($this->all()))
			return self::$returnValues['equilateral'];

		if(self::areIsosceles($this->all()))
			return self::$returnValues['isosceles'];

		return self::$returnValues['scalene'];
	}
}
