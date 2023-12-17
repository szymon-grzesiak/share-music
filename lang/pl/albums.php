<?php

return [
    'attributes' => [
        'name' => 'Nazwa',
        'album_cover' => 'Okładka albumu',
        'description' => 'Opis',
        'release_date' => 'Data wydania',
        'artist' => 'Wykonawca',
    ],
    'filters' => [
        'name' => 'Nazwa',
        'release_date' => 'Data wydania',
        'artist_id' => 'Wykonawca',
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
            'image_deleted' => 'Zdjęcia dla albumu :name zostało usunięte',
            'restored' => 'Przywrócono album :name',
        ],
        'errors' => [
            'image_deleted' => 'Nie udało się usunąć zdjęcia dla albumu :name',
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
        'image_delete' => [
            'title' => 'Usuwanie zdjęcia',
            'description' => 'Czy na pewno usunąć zdjęcie dla albumu :name'
        ]
    ],
];
