<?php

declare(strict_types=1);

require_once 'CsvFileReader.php';
require_once 'XmlFileReader.php';

class FileReader
{
    private $file;

    private $fileType;

    public function __construct(string $filename)
    {
        $this->file = $filename;
        $this->fileType = pathinfo($filename, PATHINFO_EXTENSION);
    }

    public function getFileReader()
    {
        switch ($this->fileType) {
            case 'csv':
                return new CsvFileReader();
            case 'xml':
                return new XmlFileReader();
            default:
                exit('File type not supported. Supported file types are XML and CSV.');
        }
    }

    public function getFile(): string
    {
        return $this->file;
    }
}
