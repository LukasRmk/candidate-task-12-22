<?php

declare(strict_types=1);

require_once 'FileReaderInterface.php';

class CsvFileReader implements FileReaderInterface
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
        $csv = [];

        if (($handle = fopen($file, 'r')) !== false) {
            $headers = array_map('trim', fgetcsv($handle, 0));

            if (!$this->validateHeaders($headers)) {
                exit(printf('Headers are supposed to be %s.', implode(', ', $this->expectedHeaders)));
            }

            while (($data = fgetcsv($handle)) !== false) {
                if (!$this->validateRow($data)) {
                    exit(printf('Row format is supposed to be %s.', implode(', ', $this->rowFormat)));
                }

                $csv[] = $data;
            }

            fclose($handle);
        }

        foreach ($csv as $i => $row) {
            $csv[$i] = array_combine($headers, $row);
        }

        return $csv;
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
