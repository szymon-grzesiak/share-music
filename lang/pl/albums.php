<?php

return [
    'attributes' => [
        'name' => 'Nazwa',
        'album_cover' => 'Okładka albumu',
        'description' => 'Opis',
    ],
    'actions' => [
        'create' => 'Dodaj album',
        'edit' => 'Edytuj album',
        'destroy' => 'Usuń album',
        'restore' => 'Przywróć album',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowego albumu',
        'edit_form_title' => 'Edycja albumu',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano album :name',
            'updated' => 'Zaktualizowano album :name',
            'destroyed' => 'Usunięto album :name',
            'restored' => 'Przywrócono album :name',
        ]
    ],
    'dialogs' => [
        'soft_deletes' => [
            'title' => 'Usuwanie albumu',
            'description' => 'Czy na pewno usunąć album :name',
        ],
        'restore' => [
            'title' => 'Przywracanie album',
            'description' => 'Czy na pewno przywrócić album :name',
        ],
    ],
];
