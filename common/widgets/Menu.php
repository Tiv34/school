<?php

namespace common\widgets;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * Class Menu
 * Theme menu widget.
 */
class Menu extends \yii\widgets\Menu
{

    public $linkTemplate = '<a class="{active}" href="{url}">{icon} {label}</a>';

    public $labelTemplate = '{label}';
    public $submenuTemplate = "<ul>{submenu}</ul>";
    public $activateParents = true;
    public $defaultIconHtml = '';
    public $options = [];

    public static $iconClassPrefix = '#icon-nav-';

    private $noDefaultAction;
    private $noDefaultRoute;

    /**
     * Renders the menu.
     */
    public function run()
    {
        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }
        if ($this->params === null) {
            $this->params = Yii::$app->request->getQueryParams();
        }
        $posDefaultAction = strpos($this->route, Yii::$app->controller->defaultAction);
        if ($posDefaultAction) {
            $this->noDefaultAction = rtrim(substr($this->route, 0, $posDefaultAction), '/');
        } else {
            $this->noDefaultAction = false;
        }
        $posDefaultRoute = strpos($this->route, Yii::$app->controller->module->defaultRoute);
        if ($posDefaultRoute) {
            $this->noDefaultRoute = rtrim(substr($this->route, 0, $posDefaultRoute), '/');
        } else {
            $this->noDefaultRoute = false;
        }
        $items = $this->normalizeItems($items = $this->renderGroup($this->items), $hasActiveChild);
        if (!empty($items)) {
            echo $this->renderItems($items);
        }
    }

    /**
     * @inheritdoc
     */
    protected function renderItem($item)
    {

        if (isset($item['submenu'])) {
            $labelTemplate = '<a class="sub-nav-indicator ' . ($item['active'] ? 'active' : '') . '
                " href="{url}">{icon} {label} </a>';
            $linkTemplate = '<a class="sub-nav-indicator ' . ($item['active'] ? 'active' : '') . '
                " href="{url}">{icon} {label} </a>';
        } else {
            $labelTemplate = $this->labelTemplate;
            $linkTemplate = $this->linkTemplate;
        }
        $replacements = [
            '{label}' => $item['label'] == '<hr>' ? $item['label'] : strtr('<span>' . $this->labelTemplate . '</span>', ['{label}' => $item['label'],]),
            '{icon}' => empty($item['icon']) ? $this->defaultIconHtml
                : '<svg><use href="' . static::$iconClassPrefix . $item['icon'] . '"/>
                        </svg>',
            '{url}' => isset($item['url']) ? Url::to($item['url']) : '#',
            '{active}' => !empty($item['active']) ? $this->activeCssClass : '',
        ];

        $template = ArrayHelper::getValue($item, 'template', isset($item['url']) ? $linkTemplate : $labelTemplate);
        return strtr($template, $replacements);
    }

    /**
     * Recursively renders the menu items (without the container tag).
     * @param array $items the menu items to be rendered recursively
     * @return string the rendering result
     */
    protected function renderItems($items)
    {
        $n = count($items);
        $lines = [];

        foreach ($items as $i => $item) {
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];

            !empty($item['active']) ? $class[] = 'sub-nav-opened' : $class[] = 'sub-nav-collapsed';

            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
                !empty($item['active']) ? $class[] = 'sub-nav-opened' : $class[] = 'sub-nav-collapsed';
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }
            if (!empty($class)) {
                if (empty($options['class'])) {
                    $options['class'] = implode(' ', $class);
                } else {
                    $options['class'] .= ' ' . implode(' ', $class);
                }
            }
            $menu = $this->renderItem($item);
            if (!empty($item['submenu'])) {
                $menu .= strtr($this->submenuTemplate, [
                    '{submenu}' => $this->renderItems($item['submenu']),
                ]);
            }
            $lines[] = Html::tag($tag, $menu, $options);
        }
        return implode("\n", $lines);
    }

    protected function renderGroup($items)
    {
        //Пересобираем меню, проверяем на права доступа.
        $menuItems = [];
        foreach ($items as $i => $item) {
            $header = [];
            foreach ($item['items'] as $value) {
                if (!empty($item['items']) && !empty($value['visible']) === true) {
                    if ((!empty($item['label']) != !empty($header['label']))) {
                        $separator = [
                            'label' => '<hr>',
                            'options' => ['class' => 'main-nav-divider']
                        ];
                        $header = [
                            'label' => $item['label'],
                            'options' => ['class' => 'main-nav-header']
                        ];
                        array_push($menuItems, $separator, $header);

                    }
                    if (isset($value['visible'])) {
                        array_push($menuItems, $value);
                    }
                }
            }
        }
        return $menuItems;
    }

    /**
     * @inheritdoc
     */
    protected function normalizeItems($items, &$active)
    {
        foreach ($items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                unset($items[$i]);
                continue;
            }
            if (!isset($item['label'])) {
                $item['label'] = '';
            }
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $items[$i]['label'] = $encodeLabel ? $item['label'] : '';
            $items[$i]['icon'] = isset($item['icon']) ? $item['icon'] : '';
            $hasActiveChild = false;
            if (isset($item['submenu'])) {
                $items[$i]['submenu'] = $this->normalizeItems($item['submenu'], $hasActiveChild);
                if (empty($items[$i]['submenu']) && $this->hideEmptyItems) {
                    unset($items[$i]['submenu']);
                    if (!isset($item['url'])) {
                        unset($items[$i]);
                        continue;
                    }
                }
            }
            if (!isset($item['active'])) {
                if ($this->activateParents && $hasActiveChild || $this->activateItems && $this->isItemActive($item)) {
                    $active = $items[$i]['active'] = true;
                } else {
                    $items[$i]['active'] = false;
                }
            } elseif ($item['active']) {
                $active = true;
            }
        }
        return array_values($items);
    }

    /**
     * Checks whether a menu item is active.
     * This is done by checking if [[route]] and [[params]] match that specified in the `url` option of the menu item.
     * When the `url` option of a menu item is specified in terms of an array, its first element is treated
     * as the route for the item and the rest of the elements are the associated parameters.
     * Only when its route and parameters match [[route]] and [[params]], respectively, will a menu item
     * be considered active.
     * @param array $item the menu item to be checked
     * @return boolean whether the menu item is active
     */
    protected function isItemActive($item)
    {
        if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
            $route = $item['url'][0];
            if (isset($route[0]) && $route[0] !== '/' && Yii::$app->controller) {
                $route = ltrim(Yii::$app->controller->module->getUniqueId() . '/' . $route, '/');
            }
            $route = ltrim($route, '/');
            $pos = strpos($this->route, $route);
            if ($pos ===  false){
                return false;
            }else{
                return true;
            }
        }
        return false;
    }
}
