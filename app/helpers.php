<?php

if (!function_exists('browse_nodes')) {

    /**
     * ASINのデータからブラウズノードのリスト
     *
     * @param array|null $item
     *
     * @return array
     */
    function browse_nodes($item): array
    {
        if (empty($item) or !is_array($item)) {
            return [];
        }

        $browse_nodes = [];

        $nodes = array_get($item, 'BrowseNodes');

        while ($nodes = array_get($nodes, 'BrowseNode')) {
            if (!array_has($nodes, 'BrowseNodeId')) {
                $nodes = head($nodes);
            }

            $name = array_get($nodes, 'Name');
            if (!empty($name)) {
                $browse_nodes[$name] = (int)array_get($nodes, 'BrowseNodeId');
            }

            $nodes = array_get($nodes, 'Ancestors');
        }

        return $browse_nodes;
    }
}
