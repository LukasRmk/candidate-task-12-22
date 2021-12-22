<?php

declare(strict_types=1);

interface FileReaderInterface
{
    public function getFileData(string $fileName): array;

    public function validateRow(array $row): bool;

    public function validateHeaders(array $headers): bool;
}
