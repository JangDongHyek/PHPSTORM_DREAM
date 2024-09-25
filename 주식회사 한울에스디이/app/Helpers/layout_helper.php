<?php
/**
 * 레이아웃 헬퍼
 */

if (!function_exists('render')) {
    function render(string $name, array $data = [], array $options = [])
    {
        return view(
            '_common/layout',
            [
                'content' => view($name, $data, $options),
            ],
            $options
        );
    }
}