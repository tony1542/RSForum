<?php

namespace App\Models\RSS;

use SimpleXMLElement;

abstract class RSS
{
    protected SimpleXMLElement $contents;

    public function __construct($url)
    {
        // Check for existing results before fetching new ones
        $existingResults = $this->getExistingResults();
        if ($existingResults) {
            $this->contents = simplexml_load_string($existingResults['results']);

            return;
        }

        // No existing results; fetch new ones and save them to the DB
        $this->contents = simplexml_load_string(file_get_contents($url));
        $this->storeResults();
    }

    protected function getExistingResults()
    {
        $dbh = getDatabase();
        $stmt = $dbh->query("SELECT * FROM rss_results WHERE DATE(saved_at) = DATE(NOW())");

        return $stmt->fetch();
    }

    protected function storeResults(): void
    {
        $dbh = getDatabase();
        $stmt = $dbh->prepare("INSERT INTO rss_results SET results = ?");
        $stmt->bindParam('s', $this->contents);
        $stmt->execute();
    }

    abstract public function getContents(): SimpleXMLElement;
}
