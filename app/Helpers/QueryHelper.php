<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class QueryHelper
{
    private Builder $query;

    public function __construct(private Model $Model, private array $config)
    {
    }

    private function getQueryPart($type, $field, $params, $convert)
    {
        $params = array_map(function ($item) use ($convert) {
            return match ($convert) {
                'date' => date('Y-m-d', strtotime($item)),
                default => $item
            };
        }, $params);

        return match ($type) {
            'range' => fn(Builder $query) => $query->whereBetween($field, $params),
            'oneOf' => fn(Builder $query) => $query->whereIn($field, $params),
        };
    }

    // Создание запроса QueryBuilder'a
    public function applyOptions($userOptions)
    {
        $this->query = $this->Model->newQuery();

        foreach ($userOptions['filters'] as $field => $params) {
            if (!is_array($params)) {
                $params = [$params];
            }

            $configItem = $this->config[$field];
            if (is_string($configItem)) {
                $field = $configItem;
                $configItem = $this->config[$field] ?? [];
            }

            $type = $configItem['type'] ?? 'oneOf';
            if (isset($configItem['fkField'])) {
                $this->query->whereHas($field, $this->getQueryPart($type, $configItem['fkField'], $params, $configItem['convert'] ?? null));
            } else {
                $this->getQueryPart($type, $field, $params, $configItem['convert'] ?? null)($this->query);
            }
        }

        if ($userOptions['order']) {
            $this->query->orderBy(...$userOptions['order']);
        }
    }

    // Получение скомпилированного запроса QueryBuilder'a
    public function getQuery()
    {
        return $this->query;
    }

}
