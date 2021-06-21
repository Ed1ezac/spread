<?php

namespace App\Helpers;

class FileChunkReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    private $startRow = 0;
    private $endRow   = 0;
    const chunkSize = 2048;

    /**  Set the list of rows that we want to read*/
    public function setRows($startRow) {
        $this->startRow = $startRow;
        $this->endRow   = $startRow + self::chunkSize;
    }

    public function readCell($column, $row, $worksheetName = '') {
        //  Only read the heading row, and the configured rows
        if (($row == 1) || ($row >= $this->startRow && $row < $this->endRow)) {
            return true;
        }
        return false;
    }
}