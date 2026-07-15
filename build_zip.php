<?php

$source = __DIR__;
$destination = __DIR__ . '/bkj_ready_to_deploy.zip';

if (file_exists($destination)) {
    unlink($destination);
}

$zip = new ZipArchive();
if (!$zip->open($destination, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
    die("Failed to create zip file.\n");
}

$excludes = [
    '/node_modules/',
    '/.git/',
    '/.gemini/',
    '/tests/',
    '/storage/logs/',
    '/storage/framework/cache/data/',
    '/storage/framework/views/'
];

$excludeExtensions = [
    '.patch'
];

$excludeFiles = [
    '/build_zip.php',
    '/test_turnstile.php',
    '/bkj_ready_to_deploy.zip'
];

echo "Starting ZIP process. This may take a few seconds...\n";

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

$count = 0;
foreach ($iterator as $item) {
    $path = str_replace('\\', '/', $item->getPathname());
    $sourceNormalized = str_replace('\\', '/', $source);
    $relativePath = substr($path, strlen($sourceNormalized));

    $skip = false;
    foreach ($excludes as $exclude) {
        if (strpos($relativePath, $exclude) === 0 || strpos($relativePath, $exclude) !== false) {
            $skip = true;
            break;
        }
    }
    
    foreach ($excludeFiles as $exFile) {
        if ($relativePath === $exFile) {
            $skip = true;
            break;
        }
    }

    if ($skip) continue;

    if ($item->isFile()) {
        $ext = strtolower('.' . $item->getExtension());
        if (in_array($ext, $excludeExtensions)) {
            continue;
        }
        $zip->addFile($item->getPathname(), ltrim($relativePath, '/'));
        $count++;
    } elseif ($item->isDir()) {
        $zip->addEmptyDir(ltrim($relativePath, '/'));
    }
}

$zip->close();
echo "SUCCESS! Created ZIP archive: bkj_ready_to_deploy.zip with $count files.\n";
