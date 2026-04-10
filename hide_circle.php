<?php
$files = [
    "c:\\xampplatest\\htdocs\\Minimart - sample\\resources\\views\\Admin\\Inventory\\stock-in.blade.php",
    "c:\\xampplatest\\htdocs\\Minimart - sample\\resources\\views\\Admin\\Inventory\\stock-out.blade.php"
];

$target = 'class="bg-white bg-opacity-20 rounded-pill p-2 me-3" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;"';
$replacement = 'class="d-none bg-white bg-opacity-20 rounded-pill p-2 me-3" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;"';

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $content = str_replace($target, $replacement, $content);
        file_put_contents($file, $content);
        echo "Updated $file\n";
    }
}
