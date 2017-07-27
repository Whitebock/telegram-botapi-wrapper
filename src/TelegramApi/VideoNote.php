<?php

namespace Whitebock\TelegramApi;

/**
 * Telegram Bot Api - PHP Wrapper
 * For an updated description of this class visit
 * https://core.telegram.org/bots/api#voice
 *
 * VideoNote Class
 * This object represents a video message (available in Telegram apps as of v.4.0).
 *
 * @package TelegramBot-Api
 * @author Sven Drewniok <sven.drewniok@web.de>
 * @author Sven Drewniok @Whitebock
 * @license https://opensource.org/licenses/MIT MIT License
 */
class VideoNote extends File
{
    /**
     * @var int Duration of the audio in video as defined by sender
     */
    protected $duration;

    /**
     * @var Photo Video thumbnail
     */
    protected $thumb;

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     * @return VideoNote
     */
    public function setDuration(int $duration): VideoNote
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * @return Photo
     */
    public function getThumb(): Photo
    {
        return $this->thumb;
    }

    /**
     * @param Photo $thumb
     * @return VideoNote
     */
    public function setThumb(Photo $thumb): VideoNote
    {
        $this->thumb = $thumb;
        return $this;
    }
}