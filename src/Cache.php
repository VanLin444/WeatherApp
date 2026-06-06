<?php
class Cache
{
    private string $cachePath;
    private int $defaultExpiry;

    public function __construct(string $cachePath = __DIR__ . '/../cache', int $defaultExpiry = 300)
    {
        $this->cachePath = $cachePath;
        $this->defaultExpiry = $defaultExpiry;

        if (!is_dir($this->cachePath)) {
            mkdir($this->cachePath, 0755, true);
        }
    }

    // Получение данных из кэша
    public function get(string $key): ?string
    {
        $filename = $this->getCacheFilename($key);

        if (!file_exists($filename)) {
            return null;
        }

        $data = json_decode(file_get_contents($filename), true);

        if (!$data || $data['expires'] < time()) {
            unlink($filename);
            return null;
        }
        return json_encode($data['content'], JSON_UNESCAPED_UNICODE);
    }

    // Запись данных в кэш
    public function set(string $key, string $value, ?int $expiry = null): void
    {
        $filename = $this->getCacheFilename($key);
        $data = [
            'expires' => time() + ($expiry ?? $this->defaultExpiry),
            'content' => json_decode($value, true)
        ];

        file_put_contents($filename, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), LOCK_EX);
    }

    // Удаление кэша
    public function delete(string $key): void
    {
        $filename = $this->getCacheFilename($key);
        if (file_exists($filename)) {
            unlink($filename);
        }
    }

    // Получение имени кэша
    private function getCacheFilename(string $key): string
    {
        return $this->cachePath . '/' . $key . '.json';
    }
}
