<?php


namespace App\Builders;


use App\Models\Key;
use App\Models\Language;
use App\Models\Translation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Symfony\Component\Yaml\Yaml;
use ZipArchive;

class ExportBuilder
{
    /** @var string */
    private $exportKey;

    /** @var ZipArchive */
    private $zipArchive;

    /** @var Collection */
    private $keys;

    /** @var Collection */
    private $groupedTranslations;

    public function __construct()
    {
        $this->exportKey = Str::random(32);

        $this->zipArchive = new ZipArchive();
        $this->zipArchive->open(
            storage_path("app/$this->exportKey.zip"),
            ZipArchive::CREATE | ZipArchive::OVERWRITE
        );
    }

    /**
     * @param Collection|Key[] $keys
     * @return ExportBuilder
     * @return ExportBuilder
     */
    public function setKeys(Collection $keys): self
    {
        $this->keys = $keys;

        return $this;
    }

    public function groupKeys(): self
    {
        $this->groupedTranslations = $this->groupTranslationsByLanguage($this->keys);

        return $this;
    }

    public function prepareJson(): self
    {
        $this->groupedTranslations->each(function (array $translations, string $key) {
            Storage::put(
                "$this->exportKey/$key.json",
                json_encode($translations, JSON_PRETTY_PRINT)
            );
        });

        return $this;
    }

    public function prepareYaml(): self
    {
        Storage::put(
            $this->exportKey . '/translations.yaml',
            Yaml::dump($this->groupedTranslations->toArray(), 4)
        );

        return $this;
    }

    public function exportZip(): self
    {
        $path = storage_path('app/' . $this->exportKey);
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $fileName = substr($filePath, strlen($path) + 1);

                $this->zipArchive->addFile($filePath, $fileName);
            }
        }

        $this->zipArchive->close();

        return $this;
    }

    public function getExportKey()
    {
        return $this->exportKey;
    }

    public function getPath()
    {
        return storage_path("app/$this->exportKey.zip");
    }

    public function __destruct()
    {
        Storage::deleteDirectory($this->exportKey);
    }

    private function groupTranslationsByLanguage(Collection $keys): Collection
    {
        $groupedTranslations = [];

        Language::all()->each(function (Language $language) use (&$groupedTranslations) {
            $groupedTranslations[$language->iso_code] = [
                'is_rtl' => $language->is_rtl,
                'translations' => []
            ];
        });

        $keys->each(function (Key $key) use (&$groupedTranslations) {
            $key->translations->each(function (Translation $translation) use (&$groupedTranslations) {
                $groupedTranslations[$translation->language_iso_code]['translations'][] = [
                    'key' => $translation->key->name,
                    'value' => $translation->value,
                ];
            });
        })->toArray();

        return collect($groupedTranslations);
    }
}
