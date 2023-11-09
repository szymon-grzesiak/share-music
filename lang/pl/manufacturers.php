<?php

return [
    'attributes' => [
        'name' => 'Nazwa',
        'address' => 'Adres',
    ],
    'actions' => [
        'create' => 'Dodaj producenta',
        'edit' => 'Edytuj producenta',
        'destroy' => 'Usuń producenta',
        'restore' => 'Przywróć producenta',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowego producenta',
        'edit_form_title' => 'Edycja producenta',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano producenta :name',
            'updated' => 'Zaktualizowano producenta :name',
            'destroyed' => 'Usunięto producenta :name',
            'restored' => 'Przywrócono producenta :name',
        ]
    ],
    'dialogs' => [
        'soft_deletes' => [
            'title' => 'Usuwanie producenta',
            'description' => 'Czy na pewno usunąć producenta :name',
        ],
        'restore' => [
            'title' => 'Przywracanie producenta',
            'description' => 'Czy na pewno przywrócić producenta :name',
        ],
    ]
];
