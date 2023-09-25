<?php
namespace common\widgets;

use yii\base\InvalidArgumentException;
use yii\helpers\ArrayHelper;

class Icon
{
    private static $prefix = '#icon';

    public static function svg(string $iconName, $options = []) {
        $href = self::$prefix . '-' . $iconName;
        return \yii\helpers\Html::tag('svg', "<use href='{$href}'></use>", $options);
    }

    public static function question(array $config = [])
    {
        return static::svg('question', ArrayHelper::merge([
            'style' => [
                'width' => '1.5rem',
                'height' => '1.5rem'
            ]
        ],$config));
    }

    /**
     * 
     * @param string $type [ success, warning, danger, muted  ]
     * @param array $config 
     * @return string Svg icon
     */
    public static function dot(string $title = null, string $type = null, array $config = [])
    {
        if ($title) {
            $config['title'] = $title;
            $config['data-toggle'] = 'tooltip';
        }

        if ($type) {
            \yii\helpers\Html::addCssClass($config, 'text-' . $type);
        }

        return static::svg('dot', ArrayHelper::merge([
            'style' => [
                'width' => '1.5rem',
                'height' => '1.5rem'
            ]
        ], $config));
    }

    public static function yandex(array $config = [])
    {        
        return static::svg('yandex', ArrayHelper::merge([
            'style' => [
                'width' => '1.2rem',
                'height' => '1.5rem'
            ]
        ], $config));
    }

    public static function email(array $config = [])
    {
        return static::svg('mail', ArrayHelper::merge([
            'style' => [
                'color' => '#9466ff',
                'width' => '1.5rem',
                'height' => '1.5rem'
            ]
        ], $config));
    }

    public static function mytarget(array $config = [])
    {
        return static::svg('mytarget', ArrayHelper::merge([
            'viewBox' => '0 0 2277.2 1322',
            'style' => [
                'width' => '2.8rem',
                'height' => '1.5rem'
            ]
        ], $config));
    }

    public static function recuring(array $config = [])
    {
        return static::svg('recuring', ArrayHelper::merge([
            'style' => [
                'width' => '1.25rem',
                'height' => '1.25rem'
            ]
        ], $config));
    }
}