<?php
$filepath = "c:\\xampplatest\\htdocs\\Minimart - sample\\resources\\views\\Admin\\Inventory\\stock-out.blade.php";
$lines = file($filepath);

// We need to delete from line 260 to 457 inclusive.
// Line 260 is index 259.
// Line 457 is index 456.
// Length to delete is 457 - 260 + 1 = 198 lines.

array_splice($lines, 259, 198);
file_put_contents($filepath, implode("", $lines));
echo "Deleted duplicated lines.\n";
