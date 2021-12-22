<?php

declare(strict_types=1);

require_once 'FileReaderInterface.php';

class XmlFileReader implements FileReaderInterface
{
    private $expectedHeaders = [
        'count',
        'latitude',
        'longitude',
    ];

    private $rowFormat = [
        'integer',
        'float',
        'float',
    ];

    public function getFileData(string $file): array
    {
        $content = file_get_contents($file);
        $xmlString = simplexml_load_string($content);
        $xmlArray = json_decode(json_encode($xmlString), true);

        $rows = [];

        foreach ($xmlArray['row'] as $row) {
            if (!$this->validateHeaders(array_keys($row))) {
                exit(printf('Headers are supposed to be %s.', implode(', ', $this->expectedHeaders)));
            }

            if (!$this->validateRow(array_values($row))) {
                exit(printf('Row format is supposed to be %s.', implode(', ', $this->rowFormat)));
            }

            $rows[] = $row;
        }

        return $rows;
    }

    public function validateHeaders(array $headers): bool
    {
        return $this->expectedHeaders === $headers;
    }

    public function validateRow(array $row): bool
    {
        if (count($row) != count($this->rowFormat)) {
            return false;
        }

        foreach ($row as $key => $value) {
            switch ($this->rowFormat[$key]) {
                case 'integer':
                    if (!ctype_digit($value)) {
                        return false;
                    }

                    break;
                case 'float':
                    if (!is_numeric($value)) {
                        return false;
                    }

                    break;
                default:
                    return false;
            }
        }

        return true;
    }
}
