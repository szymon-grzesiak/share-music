<?php

return [
    'attributes' => [
        'title' => 'Tytuł',
        'artist' => 'Wykonawca',
        'album' => 'Album',
        'genres' => 'Gatunki',
        'duration' => 'Czas trwania',
    ],
    'actions' => [
        'create' => 'Dodaj piosenkę',
        'edit' => 'Edytuj piosenkę',
        'destroy' => 'Usuń piosenkę',
        'restore' => 'Przywróć piosenkę',
    ],
    'filters' => [
        'artists' => 'Wykonawca',
        'albums' => 'Album',
        'genres' => 'Gatunek',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowej piosenki',
        'edit_form_title' => 'Edycja piosenki',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano piosenke :title',
            'updated' => 'Zaktualizowano piosenke :title',
            'destroyed' => 'Usunięto piosenke :title',
            'restored' => 'Przywrócono piosenke :title',
        ]
    ],
    'dialogs' => [
        'soft_deletes' => [
            'title' => 'Usuwanie piosenki',
            'description' => 'Czy na pewno usunąć piosenke :title',
        ],
        'restore' => [
            'title' => 'Przywracanie piosenki',
            'description' => 'Czy na pewno przywrócić piosenke :title',
        ],
    ],
];
