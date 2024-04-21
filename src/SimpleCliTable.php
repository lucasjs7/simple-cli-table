<?php

namespace Lucasjs7;

class SimpleCliTable {

	private array $lenColumns;
	private int $numColumns;
	private array $data;
	private string $separator;
	private bool $containsHeader;

	public function __construct() {
		$this->setDefaultAttrs();
	}

	private function setDefaultAttrs(): void {
		$this->lenColumns = [];
		$this->numColumns = 0;
		$this->data = [];
		$this->separator = '';
		$this->containsHeader = true;
	}

	public function add(array $line) {
		$this->data[] = $line;
	}

	public function render(): string {
		$this->checkNumColumns();
		$this->checkLengthColumns();
		$this->genSeparator();

		$table = $this->separator;
		$header = $this->containsHeader;

		foreach ($this->data as $line) {
			$table .= $this->renderLine($line);

			if ($header) {
				$table .= $this->separator;
				$header = false;
			}
		}

		$table .= $this->separator;

		return $table;
	}

	public static function build(
		array $data,
		bool $containsHeader = true,
	): string {

		if (count($data) == 0) return '';

		$t = new (__CLASS__);

		$t->setDefaultAttrs();
		$t->setData($data);
		$t->setContainsHeader($containsHeader);

		return $t->render();
	}

	private function checkNumColumns(): void {
		$currentLine = $this->data[0] ?? [];

		$this->numColumns = count($currentLine);
	}

	private function checkLengthColumns(): void {
		for ($i = 0; $i < $this->numColumns; $i++) {
			$this->lenColumns[$i] = max(array_map('mb_strlen', array_column($this->data, $i)));
		}
	}

	private function genSeparator(): void {
		$sepCols = [];

		foreach ($this->lenColumns as $colLength) {
			$sepCols[] = str_pad('', ($colLength + 2), '-');
		}

		$this->separator = '+' . implode('+', $sepCols) . "+\n";
	}

	private function renderLine(array $line): string {
		for ($i = 0; $i < $this->numColumns; $i++) {
			$lenDiff = (int) ($this->lenColumns[$i] - mb_strlen($line[$i]));
			$line[$i] = $line[$i] . str_repeat(' ', $lenDiff);
		}

		return '| ' . implode(' | ', $line) . " |\n";
	}

	public function setLenColumns(array $value): void {
		$this->lenColumns = $value;
	}

	public function getLenColumns(): array {
		return $this->lenColumns;
	}

	public function setNumColumns(int $value): void {
		$this->numColumns = $value;
	}

	public function getNumColumns(): int {
		return $this->numColumns;
	}

	public function setData(array $value): void {
		$this->data = $value;
	}

	public function getData(): array {
		return $this->data;
	}

	public function setSeparator(string $value): void {
		$this->separator = $value;
	}

	public function getSeparator(): string {
		return $this->separator;
	}

	public function setContainsHeader(bool $value): void {
		$this->containsHeader = $value;
	}

	public function getContainsHeader(): bool {
		return $this->containsHeader;
	}
}
