<?php

namespace Rfd\ImageMagick\Helper;

use Rfd\ImageMagick\CLI\Operation\Factory as OperationFactory;
use Rfd\ImageMagick\Image\File;
use Rfd\ImageMagick\Image\Url;
use Rfd\ImageMagick\Image\Canvas;
use Rfd\ImageMagick\ImageMagick;
use Rfd\ImageMagick\Options\CommonOptions;

class MergeImages {

    public function merge($fileNames, $outputFilename, $removeFiles = true)
    {
        $output = new File($outputFilename);
        
        $im = new ImageMagick(new OperationFactory());
        
        $firstImageFilename = array_shift($fileNames);
        $input = new File($firstImageFilename);

        $operationBuilder = $im->getOperationBuilder($input);
        
        $operationBuilder
            ->convert(CommonOptions::FORMAT_PNG)
            ->next()->direct()->setCommand('-alpha on -background none')->takeRisk();
            
        foreach($fileNames as $fileName) {
            $operationBuilder
                ->next()->direct()->setCommand('\( ' . $fileName. ' \) -composite')->takeRisk();
        }
        
        $operationBuilder->finish($output);

        if($removeFiles)
        {
            unlink($firstImageFilename);
            foreach($fileNames as $fileName) {
                unlink($fileName);
            }
        }
    }
    
} 