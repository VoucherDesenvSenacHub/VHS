<?php

foreach (new DirectoryIterator(__DIR__ . '/../controllers') as $file) {
    if($file->isDir() && !$file->isDot()) {
        $filePath = $file->getPathname();
        
        foreach (new DirectoryIterator($filePath) as $subFile) {
            if($subFile->getExtension() === 'php' && str_contains($subFile->getFilename(), '.controller.php')) {
                require_once $subFile->getPathname();
            }
        }
        continue;
    }

    if($file->getExtension() === 'php' && str_contains($file->getFilename(), '.controller.php')) {
        require_once $file->getPathname();
    }
}

foreach (new DirectoryIterator(__DIR__ . '/../application/middlewares') as $file) {
    if($file->getExtension() === 'php' && str_contains($file->getFilename(), '.middleware.php')) {
        require_once $file->getPathname();
    }
}