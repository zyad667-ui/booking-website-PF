<?php

return [
    'moroccan_properties' => [
        [
            'id' => 1,
            'title' => 'Riad Traditionnel',
            'location' => 'Médina, Marrakech, Maroc',
            'hosts' => 'Ahmed & Fatima',
            'guests' => 6,
            'price' => 120,
            'rating' => 4.9,
            'type' => 'riad',
            'image_url' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'image_alt' => 'Riad traditionnel marocain avec cour intérieure',
            'description' => 'Magnifique riad traditionnel au cœur de la médina de Marrakech'
        ],
        [
            'id' => 2,
            'title' => 'Villa avec Vue Océan',
            'location' => 'Corniche, Agadir, Maroc',
            'hosts' => 'Karim & Leila',
            'guests' => 8,
            'price' => 180,
            'rating' => 4.8,
            'type' => 'villa',
            'image_url' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'image_alt' => 'Villa moderne avec vue sur l\'océan à Agadir',
            'description' => 'Villa luxueuse avec vue panoramique sur l\'océan Atlantique'
        ],
        [
            'id' => 3,
            'title' => 'Maison Historique',
            'location' => 'Médina, Fès, Maroc',
            'hosts' => 'Hassan & Amina',
            'guests' => 4,
            'price' => 95,
            'rating' => 4.7,
            'type' => 'maison',
            'image_url' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'image_alt' => 'Maison historique dans la médina de Fès',
            'description' => 'Maison traditionnelle dans la médina historique de Fès'
        ],
        [
            'id' => 4,
            'title' => 'Appartement Moderne',
            'location' => 'Centre-ville, Casablanca, Maroc',
            'hosts' => 'Youssef & Samira',
            'guests' => 3,
            'price' => 85,
            'rating' => 4.9,
            'type' => 'appartement',
            'image_url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'image_alt' => 'Appartement moderne à Casablanca',
            'description' => 'Appartement contemporain au cœur de Casablanca'
        ],
        [
            'id' => 5,
            'title' => 'Maison Bleue',
            'location' => 'Médina, Chefchaouen, Maroc',
            'hosts' => 'Omar & Khadija',
            'guests' => 5,
            'price' => 110,
            'rating' => 5.0,
            'type' => 'maison',
            'image_url' => 'https://images.unsplash.com/photo-1600607687644-c7171b42498b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'image_alt' => 'Maison bleue traditionnelle à Chefchaouen',
            'description' => 'Maison traditionnelle dans la ville bleue de Chefchaouen'
        ],
        [
            'id' => 6,
            'title' => 'Villa Côtière',
            'location' => 'Plage, Essaouira, Maroc',
            'hosts' => 'Rachid & Malika',
            'guests' => 7,
            'price' => 160,
            'rating' => 4.8,
            'type' => 'villa',
            'image_url' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'image_alt' => 'Villa côtière à Essaouira',
            'description' => 'Villa avec accès direct à la plage d\'Essaouira'
        ],
        [
            'id' => 7,
            'title' => 'Riad de Luxe',
            'location' => 'Palmeraie, Marrakech, Maroc',
            'hosts' => 'Aziz & Zineb',
            'guests' => 10,
            'price' => 250,
            'rating' => 4.9,
            'type' => 'riad',
            'image_url' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'image_alt' => 'Riad de luxe dans la palmeraie de Marrakech',
            'description' => 'Riad luxueux dans la palmeraie de Marrakech'
        ],
        [
            'id' => 8,
            'title' => 'Maison Traditionnelle',
            'location' => 'Kasbah, Tanger, Maroc',
            'hosts' => 'Mustapha & Aicha',
            'guests' => 6,
            'price' => 130,
            'rating' => 4.6,
            'type' => 'maison',
            'image_url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'image_alt' => 'Maison traditionnelle dans la kasbah de Tanger',
            'description' => 'Maison traditionnelle dans la kasbah historique de Tanger'
        ]
    ],
    
    'unsplash_api' => [
        'base_url' => 'https://api.unsplash.com',
        'search_endpoint' => '/search/photos',
        'access_key' => env('UNSPLASH_ACCESS_KEY', 'YOUR_UNSPLASH_ACCESS_KEY'),
        'cache_duration' => 3600, // 1 heure
    ],
    
    'fallback_images' => [
        'moroccan_riad' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'moroccan_villa' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'moroccan_house' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'moroccan_apartment' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    ]
]; 