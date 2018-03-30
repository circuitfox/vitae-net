<?php

namespace App;

use Picqer\Barcode\BarcodeGeneratorPNG;

trait GeneratesBarcodes
{
    /**
     * Generates a barcode with the given type tag and id.
     *
     * @param string $type the type tag for this barcode, should be one
     * character.
     * @param int $id the id to encode into this barcode
     * @return an image of this barcode
     */
    protected function generateBarcodeWithFormat(string $type, int $id)
    {
        $generator = new BarcodeGeneratorPNG();
        $patcode = $type . ' ' . $id;
        $barcode = base64_encode($generator->getBarcode($patcode, $generator::TYPE_CODE_128, 3, 50));
        return '<img src="data:image/png;base64,' . $barcode . '" />';
    }

    /**
     * Generates a download button for a barcode with the given type tag and id.
     *
     * @param string $type the type tag for this barcode, should be one
     * character.
     * @param int $id the id to encode into this barcode
     * @param string $fileName the name of the file
     * @return an image of this barcode
     */
    protected function generateDownloadButtonWithFormat(string $type, int $id, string $fileName)
    {
        $generator = new BarcodeGeneratorPNG();
        $patcode = $type . ' ' . $id;
        $barcode = base64_encode($generator->getBarcode($patcode, $generator::TYPE_CODE_128));
        return  '<a type="button" class="btn btn-primary" id="download"'
            . 'href="data:image/png;base64,' . $barcode . '" download="' . $fileName . '.png">Download Bar Code</a>';
    }
}
