<?php

namespace Whitebock\TelegramApi;

/**
 * Telegram Bot Api - PHP Wrapper
 * For an updated description of this class visit
 * https://core.telegram.org/bots/api#file
 *
 * File Class
 * This object represents a file ready to be downloaded. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile.
 *
 * @package TelegramBot-Api
 * @author Sven Drewniok <sven.drewniok@web.de>
 * @author Sven Drewniok @Whitebock
 * @license https://opensource.org/licenses/MIT MIT License
 */
abstract class File
{
    /**
     * @var string Unique identifier for this file
     */
    protected $file_id;

    /**
     * @var int File size, if known
     */
    protected $file_size;

    /**
     * @var string File path
     */
    protected $file_path;

    /**
     * @var \CURLFile Local path
     */
    protected $local_path;

    public static function fromFile(string $path): File
    {
        $path = realpath($path);
        if (!$path) {
            throw new \Exception('File "'.$path.'" not found');
        }

        $file = new static();
        $file->local_path = new \CURLFile($path);

        return $file;
    }

    /**
     * Downloads this file to a local file
     *
     * @param string $token Bot token
     * @param string $to_file The file path to download to, for example: '/img/test.jpg'
     * @return bool Returns true if it was successful
     */
    public function downloadTo(string $token, string $to_file)
    {

        $rawData = $this->download($token);

        $fp = fopen($to_file, 'w');
        if ($fp === false) {
            return false;
        }
        fwrite($fp, $rawData);
        fclose($fp);
        return true;
    }

    /**
     * Downloads this file
     *
     * @param string $token Bot token
     * @return string The raw file data
     */
    public function download(string $token)
    {
        $ch = curl_init(Bot::API_URL . 'file/bot' . $token . '/' . $this->file_path);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        $rawData = curl_exec($ch);
        curl_close($ch);
        return $rawData;
    }

    /**
     * @return string
     */
    public function getFileId(): string
    {
        return $this->file_id;
    }

    /**
     * @param string $file_id
     * @return File
     */
    public function setFileId(string $file_id): File
    {
        $this->file_id = $file_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getFileSize(): int
    {
        return $this->file_size;
    }

    /**
     * @param int $file_size
     * @return File
     */
    public function setFileSize(int $file_size): File
    {
        $this->file_size = $file_size;
        return $this;
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->file_path;
    }

    /**
     * @param string $file_path
     * @return File
     */
    public function setFilePath(string $file_path): File
    {
        $this->file_path = $file_path;
        return $this;
    }

    /**
     * @return \CURLFile
     */
    public function getLocalPath(): \CURLFile
    {
        return $this->local_path;
    }
}
