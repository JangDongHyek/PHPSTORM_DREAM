<?php
/**
 * 레이아웃 헬퍼
 */

if (!function_exists('render')) {
    function render(string $name, array $data = [], array $options = []): string
    {
        return view(
            'template/layout',
            [
                'content' => view($name, $data, $options),
                'isAdmPage' => (isset($data['isAdmPage']) && $data['isAdmPage'] === true),
            ],
            $options
        );
    }
}