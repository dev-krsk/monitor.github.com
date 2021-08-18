<?php

namespace App\Service;

use function Symfony\Component\String\s;

class OrionService
{
    public const API = 'http://cam.krk.ru/';
    public const ROUTE_CAMERA_INFO = self::API . 'api/v1/web/camera_info?camera_id=%s';
    public const ROUTE_CAMERA_PREVIEW = 'http://krkvideo15.orionnet.online/cam%s/preview.jpg';
    public const ROUTE_CAMERA_SOURCE = 'http://krkvideo5.orionnet.online/cam%s/index.m3u8';

    const FIND_START = '<script>rootScope=';
    const FIND_END = ';</script>';

    public static function loadSource(): array
    {
        return explode("\n", file_get_contents(self::API));
    }

    public static function findNeedSource(): string
    {
        $result = "";
        $numStart = null;
        $start = null;
        $numEnd = null;
        $end = null;

        $source = self::loadSource();

        foreach ($source as $num => $line) {
            $pos = mb_strpos($line, self::FIND_START);

            if ($pos !== false) {
                $numStart = $num;
                $start = $pos + mb_strlen(self::FIND_START);

                $result .= mb_strcut($line, $start);
            }

            if ($numStart !== null) {
                if ($num > $numStart) {
                    $result .= $line;
                }

                $pos = mb_strpos($line, self::FIND_END);

                if ($pos !== false) {
                    $numEnd = $num;
                    $end = $pos;

                    if ($numStart === $numEnd) {
                        return mb_strcut($line, $start, $end - $start);
                    }

                    $result .= mb_strcut($line, 0, $end);

                    return $result;
                }
            }
        }

        if ($numStart === null) {
            throw new \LogicException("Ошибка при парсинге: Не обнаружено начало требуемого участка кода.");
        }

        if ($numEnd === null) {
            throw new \LogicException("Ошибка при парсинге: Не обнаружено окончание требуемого участка кода.");
        }

        throw new \LogicException("Ошибка при парсинге: Общая ошибка");
    }

    public static function parseCameras(): array
    {
        $jsonString = self::findNeedSource();

        $jsonString = str_replace("''", "\"\"", $jsonString);

        $data = json_decode($jsonString, true);

        if ($data === null) {
            throw new \LogicException(sprintf("%s %s", json_last_error(), json_last_error_msg()));
        }

        return $data;
    }
}