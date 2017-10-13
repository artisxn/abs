<?php

if (!function_exists('browse_nodes')) {

    /**
     * ASINのデータからブラウズノードのリスト
     *
     * @param array $item
     *
     * @return array
     */
    function browse_nodes(array $item): array
    {
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
