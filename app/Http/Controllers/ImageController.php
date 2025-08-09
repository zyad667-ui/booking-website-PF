<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ImageController extends Controller
{
    private $unsplashAccessKey = 'YOUR_UNSPLASH_ACCESS_KEY'; // Tu peux obtenir une clé gratuite sur unsplash.com/developers
    
    public function getMoroccanHouses()
    {
        // Cache les images pour éviter trop d'appels API
        return Cache::remember('moroccan_houses', 3600, function () {
            $images = [];
            
            // Recherches spécifiques pour des maisons marocaines
            $searches = [
                'moroccan riad interior',
                'marrakech traditional house',
                'moroccan courtyard house',
                'fes morocco traditional house',
                'chefchaouen blue house',
                'moroccan villa pool',
                'agadir beach house morocco',
                'essaouira moroccan house'
            ];
            
            foreach ($searches as $search) {
                try {
                    $response = Http::get('https://api.unsplash.com/search/photos', [
                        'query' => $search,
                        'client_id' => $this->unsplashAccessKey,
                        'per_page' => 1,
                        'orientation' => 'landscape'
                    ]);
                    
                    if ($response->successful()) {
                        $data = $response->json();
                        if (!empty($data['results'])) {
                            $images[] = [
                                'url' => $data['results'][0]['urls']['regular'],
                                'alt' => $data['results'][0]['alt_description'] ?? $search,
                                'photographer' => $data['results'][0]['user']['name'] ?? 'Unknown'
                            ];
                        }
                    }
                } catch (\Exception $e) {
                    // Fallback images si l'API échoue
                    $images[] = [
                        'url' => $this->getFallbackImage($search),
                        'alt' => $search,
                        'photographer' => 'PlaceZo'
                    ];
                }
            }
            
            return $images;
        });
    }
    
    private function getFallbackImage($search)
    {
        // Images de fallback pour chaque type de recherche
        $fallbackImages = [
            'moroccan riad interior' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'marrakech traditional house' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'moroccan courtyard house' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'fes morocco traditional house' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'chefchaouen blue house' => 'https://images.unsplash.com/photo-1600607687644-c7171b42498b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'moroccan villa pool' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'agadir beach house morocco' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'essaouira moroccan house' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
        ];
        
        return $fallbackImages[$search] ?? 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
    }
    
    public function getPropertyImages()
    {
        // Retourne des images statiques de haute qualité pour les propriétés marocaines
        return [
            [
                'url' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'alt' => 'Riad traditionnel marocain avec cour intérieure',
                'type' => 'riad',
                'location' => 'maroc'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'alt' => 'Villa moderne avec vue sur l\'océan à Agadir',
                'type' => 'villa',
                'location' => 'maroc'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'alt' => 'Maison historique dans la médina de Fès',
                'type' => 'maison',
                'location' => 'maroc'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'alt' => 'Appartement moderne à Casablanca',
                'type' => 'appartement',
                'location' => 'maroc'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1600607687644-c7171b42498b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'alt' => 'Maison bleue traditionnelle à Chefchaouen',
                'type' => 'maison',
                'location' => 'maroc'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'alt' => 'Villa côtière à Essaouira',
                'type' => 'villa',
                'location' => 'maroc'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'alt' => 'Riad de luxe dans la palmeraie de Marrakech',
                'type' => 'riad',
                'location' => 'maroc'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'alt' => 'Maison traditionnelle dans la kasbah de Tanger',
                'type' => 'maison',
                'location' => 'maroc'
            ]
        ];
    }
    
    public function getPropertyImageByType($type = 'maison')
    {
        // Images par défaut selon le type de propriété
        $defaultImages = [
            'villa' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'appartement' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'maison' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'riad' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'chalet' => 'https://images.unsplash.com/photo-1600607687644-c7171b42498b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'loft' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'default' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
        ];
        
        return $defaultImages[$type] ?? $defaultImages['default'];
    }
} 