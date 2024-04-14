Simple Render Table CLI for PHP
===

A simple lib to render tables in php.

### Example 1

```bash
# Code:
$data = [
	['First Name', 'Last Name', 'Age'],
	['Steve',      'Magal',     '37'],
	['Jorel',      'Seila',     '14'],
	['William',    'Shostners', '9'],
	['Carlos',     'Felino',    '39'],
];

echo SimpleCliTable::build($data);

# Output:
+------------+-----------+-----+
| First Name | Last Name | Age |
+------------+-----------+-----+
| Steve      | Magal     | 37  |
| Jorel      | Seila     | 14  |
| William    | Shostners | 9   |
| Carlos     | Felino    | 39  |
+------------+-----------+-----+
```

### Example 2

```bash
# Code:
$data = [
	['Steve',      'Magal',     '37'],
	['Jorel',      'Seila',     '14'],
	['William',    'Shostners', '9'],
	['Carlos',     'Felino',    '39'],
];

$simpleTableCli = new SimpleCliTable;
$simpleTableCli->setContainsHeader(false);

foreach ($data as $line) {
	$simpleTableCli->add($line);
}

echo $simpleTableCli->render();

# Output:
+---------+-----------+----+
| Steve   | Magal     | 37 |
| Jorel   | Seila     | 14 |
| William | Shostners | 9  |
| Carlos  | Felino    | 39 |
+---------+-----------+----+
```