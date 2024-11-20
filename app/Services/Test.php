<?php

namespace App\Services;

use App\Helpers\QueryHelper;
use App\Models\Posts;

class Test
{

    public function runTest()
    {

        $config = [
            'ids' => 'id',
            'tags' => [
                'fkField' => 'slug'
            ],
            'active' => 'is_active',
            'author' => 'owner_id',
            'create_date_range' => 'created_at',
            'created_at' => [
                'type' => 'range',
                'convert' => 'date'
            ]
        ];

        /*
        !!! Обратите внимание,
        что наименования ключей, формат данных в объекте filters не всегда соответствует
        наименованию и значению фильтруемой колонки в БД.
        Это сделано намеренно. Просим учесть это при реализации методов класса QueryHelper и структуры $config'а.
        */
        $testData = [
            'items' => [
                [
                    'filters' => [
                        'ids' => [1, 2, 3], // posts.id - id публикаций (int | string | array)
                        'tags' => ['news', 'articles'], // tags.slug - привязанные теги публикаций (string | array)
                        'active' => true, // posts.is_active - статус публикаций (boolean)
                        'author' => 1, // posts.owner_id - владелец публикаций (int | string | array)
                        'create_date_range' => ['26-03-2024', '27-03-2024'], // posts.created_at - дата создания публикации (array)
                    ],
                    'order' => ['id', 'desc'], // сортировка записей
                ],
            ],
        ];

        $testResults = [];
        foreach ($testData['items'] as $userOptions) {

            $Model = new Posts();
            $QueryHelper = new QueryHelper($Model, $config);
            $QueryHelper->applyOptions($userOptions); // Создание запроса QueryBuilder'a

            $q = $QueryHelper->getQuery(); // Получение скомпилированного запроса QueryBuilder'a
            $items = $q->get(); // Получение публикаций
            $testResults[] = $items->toArray();

        }

        dump($testResults);

        // !!! Запись результатов в zip-архив

    }

}
