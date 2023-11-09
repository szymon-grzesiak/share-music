<?php

return [
    'attributes' => [
        'name' => 'Nazwa',
    ],
    'actions' => [
        'create' => 'Dodaj kategorię',
        'edit' => 'Edytuj kategorię',
        'destroy' => 'Usuń kategorię',
        'restore' => 'Przywróć kategorię',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowej kategorii',
        'edit_form_title' => 'Edycja kategorii',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano kategorię :name',
            'updated' => 'Zaktualizowano kategorię :name',
            'destroyed' => 'Usunięto kategorię :name',
            'restored' => 'Przywrócono kategorię :name',
        ]
    ],
    'dialogs' => [
        'soft_deletes' => [
            'title' => 'Usuwanie kategorii',
            'description' => 'Czy na pewno usunąć kategorię :name',
        ],
        'restore' => [
            'title' => 'Przywracanie kategorii',
            'description' => 'Czy na pewno przywrócić kategorię :name',
        ],
    ],
];
