<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * Class Test
 */
class Test extends TestCase
{
    public function testCase1()
    {
        $data = $this->getFileContentAsArray("bubble_compiled.js");

        $hashing = new \HashTree\Calculate\HashTree();
        $tree = new \HashTree\Services\GetBase64HashTreeService($hashing);

        self::assertSame($tree($data, 128), "ksRs5-KND_LhiFCKm7Z8B_FMOngXWCPsYplZ2wWj50I");
    }


    public function testCase2()
    {
        $data = $this->getFileContentAsArray("bubble_gss.css");
        $hashing = new \HashTree\Calculate\HashTree();
        $tree = new \HashTree\Services\GetBase64HashTreeService($hashing);

        self::assertSame($tree($data, 128), "LYMSPjg0R_nhUq1CpPm9fewACLMdRMcAWLb4L8HStNA");
    }

    /**
     * @param string $filePath
     * @return array
     */
    private function getFileContentAsArray(string $filePath): array
    {
        $handle = fopen(basename(__DIR__) . '/' . $filePath, "rb");

        if (FALSE === $handle) {
            exit("Failed to open stream to URL");
        }

        $data = [];

        while (!feof($handle)) {
            $data[] = fread($handle, 4096);
        }
        fclose($handle);

        return $data;
    }
}

