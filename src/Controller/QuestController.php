<?php

namespace App\Controller;

use App\Entity\Pin;
use App\Form\PinType;
use App\Repository\PinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestController extends AbstractController
{

    private array $dungeonType;
    private array $trashMobs;
    private array $boss;

    public function __construct(){

//        NOTES :
//        Cardio < Force
//        Gym < Cardio
//        Force < Gym
//        https://www.millenium.org/guide/392929.html
//        https://www.printerstudio.fr/personnalise/cartes-de-jeu-sur-mesure-cartes-blanches.html

        $this->dungeonType =  [
            'elementary',
            'draconide',
            'hybride',
            'insectoide',
            'undead',
            'spectre',
            'vampire',
            'vestige'
        ];

        // TRASH MOBS
        // -------------------------------------------------------------------------------------------------------------
        $this->trashMobs = [];
        $this->trashMobs['elementary'] = [
            [
                'name' => 'golem',
                'type' => 'elementary',
                'hp' => [
                    7,
                    9,
                    11,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'golem',
                'type' => 'elementary',
                'hp' => [
                    8,
                    10,
                    12,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'golem',
                'type' => 'elementary',
                'hp' => [
                    9,
                    11,
                    13,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'golem',
                'type' => 'elementary',
                'hp' => [
                    10,
                    12,
                    14,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ]
        ];
        $this->trashMobs['draconide'] = [
            [
                'name' => 'Wyvern',
                'type' => 'draconide',
                'hp' => [
                    7,
                    9,
                    11,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Wyvern',
                'type' => 'draconide',
                'hp' => [
                    8,
                    10,
                    12,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Wyvern',
                'type' => 'draconide',
                'hp' => [
                    9,
                    11,
                    13,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Wyvern',
                'type' => 'draconide',
                'hp' => [
                    10,
                    12,
                    14,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ]
        ];
        $this->trashMobs['hybride'] = [
            [
                'name' => 'Harpie',
                'type' => 'hybride',
                'hp' => [
                    7,
                    9,
                    11,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Sirène',
                'type' => 'hybride',
                'hp' => [
                    8,
                    10,
                    12,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Loup-garou',
                'type' => 'hybride',
                'hp' => [
                    9,
                    11,
                    13,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Maudits',
                'type' => 'hybride',
                'hp' => [
                    10,
                    12,
                    14,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ]
        ];
        $this->trashMobs['insectoide'] = [
            [
                'name' => 'Guerrières kikimorrhes',
                'type' => 'insectoide',
                'hp' => [
                    7,
                    9,
                    11,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Ouvrières kikimorrhes',
                'type' => 'insectoide',
                'hp' => [
                    8,
                    10,
                    12,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Nuée de frelons',
                'type' => 'insectoide',
                'hp' => [
                    9,
                    11,
                    13,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Scolopendromorphes',
                'type' => 'insectoide',
                'hp' => [
                    10,
                    12,
                    14,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],

        ];
        $this->trashMobs['undead'] = [
            [
                'name' => 'Goule',
                'type' => 'undead',
                'hp' => [
                    7,
                    9,
                    11,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Brumelin',
                'type' => 'undead',
                'hp' => [
                    8,
                    10,
                    12,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Noyeur',
                'type' => 'undead',
                'hp' => [
                    9,
                    11,
                    13,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Nécrophages',
                'type' => 'undead',
                'hp' => [
                    10,
                    12,
                    14,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ]
        ];
        $this->trashMobs['spectre'] = [
            [
                'name' => 'Banshee',
                'type' => 'spectre',
                'hp' => [
                    7,
                    9,
                    11,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Spectre de midi',
                'type' => 'spectre',
                'hp' => [
                    8,
                    10,
                    12,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Spectre de minuit',
                'type' => 'spectre',
                'hp' => [
                    9,
                    11,
                    13,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Fantôme',
                'type' => 'spectre',
                'hp' => [
                    10,
                    12,
                    14,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ]
        ];
        $this->trashMobs['vampire'] = [
            [
                'name' => 'Alpyre',
                'type' => 'vampire',
                'hp' => [
                    7,
                    9,
                    11,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Une alpyre est un problème terrible pour les petits villages ou les villes naissantes. Vous voyez, les vampires, dans l`ensemble, sont des créatures très dangereuses. Mais les alpyres, tout comme leurs sœurs les brouxes, sont capables de se déguiser mieux que n`importe quel garkain. Les légendes disent qu`elles peuvent prendre la forme de chiens, de chats, de crapauds et de belles jeunes femmes. Cela peut provoquer la propagation de paranoïa dans un village où, n`importe qui pourrait être le vampire. Pour aggraver les choses, les gens disent qu`ils ont une sorte de venin qui vous endort.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => 'Humaine',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Brouxe',
                'type' => 'vampire',
                'hp' => [
                    8,
                    10,
                    12,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Katakan',
                'type' => 'vampire',
                'hp' => [
                    9,
                    11,
                    13,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Noctule',
                'type' => 'vampire',
                'hp' => [
                    10,
                    12,
                    14,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
        ];
        $this->trashMobs['vestige'] = [
            [
                'name' => 'Lutin',
                'type' => 'vestige',
                'hp' => [
                    7,
                    9,
                    11,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Lutin',
                'type' => 'vestige',
                'hp' => [
                    8,
                    10,
                    12,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Lutin',
                'type' => 'vestige',
                'hp' => [
                    9,
                    11,
                    13,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
            [
                'name' => 'Lutin',
                'type' => 'vestige',
                'hp' => [
                    10,
                    12,
                    14,
                ],
                'informations' => [
                    'menace' => 'Trash mob',
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'height' => '',
                    'weight' => '',
                    'environment' => '',
                    'intelligence' => '',
                    'organisation' => '',
                ]
            ],
        ];

        // MONSTER
        // -------------------------------------------------------------------------------------------------------------
        $this->boss = [];
        $this->boss['elementary'] = [
            'id' => 6,
            'name' => 'Elementaire',
            'type' => 'elementary',
            'hp' => 220,
            'informations' => [
                'strength' => [
                    'type' => 'Selon le type (feu: cardio / glace: gym / terre: force)',
                    'description' => [
                        'Clean (force)',
                        'Shoulder press (force)',
                        '25 pull ups (gym)',
                        '50 push ups (gym)',
                        '100 sit ups (gym)',
                        '1k row (cardio)',
                        '50 burpees (cardio)',
                        '100 DU (cardio)',
                        'Deadlift (force)',
                    ],
                ],
                'weakness' => [
                    'type' => 'Selon le type (feu: force / glace: cardio / terre: gym)',
                    'description' => [
                        'Clean (force)',
                        'Shoulder press (force)',
                        '25 pull ups (gym)',
                        '50 push ups (gym)',
                        '100 sit ups (gym)',
                        '1k row (cardio)',
                        '50 burpees (cardio)',
                        '100 DU (cardio)',
                        'Deadlift (force)',
                    ],
                ],
                'menace' => 'Difficile, Simple',
                'description' => 'Un élémentaire est un agglomérat matière organique animé par magie. En apparence lent et maladroit, il est cependant terriblement dangereux et doit être évité à tout prix',
                'height' => 'Jusqu’à 2,5 m au garrot',
                'weight' => 'Jusqu’à  1000kg',
                'intelligence' => 'Capable de pensées simples',
                'organisation' => ' Solitaire',
                'specificity' => 'Lancer 1d20 pour connaitre la résistance de l’élémentaire ( 1->6 : glace / 7->12 : terre / 13->18 : feu / 18->20 : choisissez )',
            ],
        ];
        $this->boss['draconide'] = [
            'id' => 8,
            'name' => 'Phénix',
            'type' => 'draconide',
            'hp' => 200,
            'informations' => [
                'strength' => [
                    'type' =>'force',
                    'description' => [
                        '20 Deadlift (70% 1RM)',
                        '20 Clean (60% 1RM)',
                        '20 Shoulder press (50% 1RM clean)',
                    ],
                ],
                'weakness' => [
                    'type' => 'gym',
                    'description' => [
                        '25 pull ups',
                        '50 push ups',
                        '100 sit ups'
                    ],
                ],
                'menace' => 'Fort, Complexe',
                'description' => 'Le légendaire phénix est un animal noble, capable non seulement de ramener d’entre les morts ceux qui ont été injustement tués, mais aussi lui-même, se conférant une vie éternelle. Un phénix est capable de frapper de ses flammes les hommes malfaisants qui le chasseraient pour ses plumes magiques, les détruisant complètement.',
                'height' => '1,5 m au garrot',
                'weight' => 'Environ 550kg',
                'environment' => 'Montagnes, plaines et déserts',
                'intelligence' => 'Aussi intelligent qu’un humain stupide',
                'organisation' => ' Solitaire',
                'specificity' => 'Une fois tué, le Phénix tentera de renaitre de ses cendres avec la moitié de ses points de vie. Il peut lancer un jet de dé de survie ( 1->15 : échec / 16->20 : succès )',
            ],
        ];
        $this->boss['hybride'] = [
            'id' => 1,
            'name' => 'Succube',
            'type' => 'hybride',
            'hp' => 120,
            'informations' => [
                'notes_MJ' => [
                    'Pour 3 séances semaines -> 4 à 5 semaines pour faire le boss',
                    'Pour 3 séances semaines + extrawods -> 2 à 3 semaines pour faire le boss',
                    'Pour 5 séances semaines -> 1 à 2 semaines pour faire le boss',
                    'Pour 5 séances semaines -> 3 à 4 semaines pour faire le boss',
                    'Pour 5 séances semaines + extrawods -> 1 à 2 semaines pour faire le boss',
                ],
                'strength' => [
                    'type' =>'cardio',
                    'description' => [
                        '1k row',
                        '50 burpees',
                        '100 DU',
                    ],
                ],
                'weakness' => [
                    'type' => 'force',
                    'description' => [
                        '20 Deadlift (70% 1RM)',
                        '20 Clean (60% 1RM)',
                        '20 Shoulder press (50% 1RM clean)',
                    ],
                ],
                'menace' => 'Moyen, Complexe',
                'description' => 'Une succube est un démon ailé de la luxure, invoqué par un mage maléfique pour satisfaire ses propres désirs pervers. Ces mauvais esprits vont drainer une âme grâce à leur maîtrise de la séduction et des arts charnels.',
                'height' => 'Taille humaine',
                'weight' => 'Poids humain',
                'environment' => 'Partout où il y a des gens',
                'intelligence' => 'Aussi intelligent qu’un humain',
                'organisation' => 'Solitaire',
                'specificity' => 'Tente de vous corrompre en utilisant un lancé de dé d’esquive lors de vos jets de dégât ou de récupération de santé lors de vos extra workouts',
            ]
        ];
        $this->boss['insectoide'] = [
            'id' => 5,
            'name' => 'Reine kikimorrhe',
            'type' => 'insectoide',
            'hp' => 160,
            'informations' => [
                'menace' => 'Fort, Difficile',
                'strength' => [
                    'type' => 'force',
                    'description' => [
                        '20 Deadlift (70% 1RM)',
                        '20 Clean (60% 1RM)',
                        '20 Shoulder press (50% 1RM clean)',
                    ],
                ],
                'weakness' => [
                    'type' => 'cardio',
                    'description' => [
                        '1k row ',
                        '50 burpees',
                        '100 DU',
                    ],
                ],
                'description' => 'Les sorceleurs connaissent des centaines de façons de combattre les monstres. En abordant la reine d’un essaim de kikimorrhes, une seule méthode est efficace — courir comme le vent. Avec cette tactique, il est difficile de tuer la bête, mais elle garantit la survie, ce qui est une sorte de victoire. ',
                'height' => 'Entre 4 et 5m',
                'weight' => '2000kg',
                'environment' => 'Lieux calmes, sombres et humides.',
                'intelligence' => 'Aussi intelligent qu’un chien',
                'organisation' => 'Entourée de Kikimorrhe, soldats et ouvriers',
                'specificity' => 'Lancer 1d20 pour savoir combien de soldats entourent la Reine kikimorrhe ( 1->10 : 3 / 11->15 : 4 / 16->20 : 5 ). Les soldats possèdent 10pv chacun.',
            ],
        ];
        $this->boss['undead'] = [
            'id' => 4,
            'name' => 'Naïade',
            'type' => 'undead',
            'hp' => 90,
            'informations' => [
                'strength' => [
                    'type' =>'cardio',
                    'description' => [
                        '1k row ',
                        '50 burpees',
                        '100 DU',
                    ],
                ],
                'weakness' => [
                    'type' => 'force',
                    'description' => [
                        '20 Deadlift (70% 1RM)',
                        '20 Clean (60% 1RM)',
                        '20 Shoulder press (50% 1RM clean)',
                    ],
                ],
                'description' => 'Les jeunes femmes qui se sont suicidées par noyade en raison d’un mariage malheureux (elles ont peut-être été abandonnées par leur amant ou maltraitées et harcelées par leur mari beaucoup plus âgé), ou qui ont été violemment noyées contre leur gré (surtout après être tombées enceintes d’enfants non désirés), doivent vivre leur temps désigné sur terre comme naïade. Un esprit undead cruel et illusoire qui habite l’eau de sa mort ; une eau qui ne parvient pas à éteindre sa haine brûlante de l’humanité',
                'height' => 'Taille humaine normale',
                'weight' => 'Poids humain normal',
                'environment' => 'Rivières, bois et lacs',
                'intelligence' => 'Aussi intelligent qu’un humain',
                'organisation' => 'Solitaire, ou en bandes de 2 à 3',
                'specificity' => 'Lancer 1d20 pour savoir combien de monstres vous allez affronter ( 1->10 : 1 / 11->15 : 2 / 16->20 : 3 )',
            ],
        ];
        $this->boss['spectre'] = [
            'id' => 3,
            'name' => 'Draugr',
            'type' => 'spectre',
            'hp' => 150,
            'informations' => [
                'strength' => [
                    'type' =>'force',
                    'description' => [
                        '20 Deadlift (70% 1RM)',
                        '20 Clean (60% 1RM)',
                        '20 Shoulder press (50% 1RM clean)',
                    ],
                ],
                'weakness' => [
                    'type' => 'gym',
                    'description' => [
                        '25 pull ups',
                        '50 push ups',
                        '100 sit ups'
                    ],
                ],
                'menace' => 'Fort, Difficile',
                'description' => 'Étant prince des damnés, le draugr n’a pas à se salir les mains. Il a des laquais pour cela, spectres eux aussi, des revenants, des âmes en peine. Roi ou commandant de son vivant, le draugr conserve son charisme dans le trépas et ses sujets obéissent aveuglément à ses ordres. C’est pourquoi il faut les exterminer jusqu’au dernier pour se frayer un chemin vers le palais souterrain, la forteresse sauvage ou toute autre demeure de l’ombre. Alors seulement vous affronterez le draugr lui-même. Enfin, c’est la tradition',
                'height' => 'Jusqu’à 6m',
                'weight' => 'Environ 1000kg',
                'environment' => 'Champs de batailles, fosses communes, ruines',
                'intelligence' => 'Aussi intelligent qu’il l’était en vie, souvent fou',
                'organisation' => 'Solitaire, souvent avec un Martyr',
                'specificity' => 'Peut invoquer un Martyr de 50pv qui combattra à sa place jusqu’à sa mort. Lancez 1d20 pour savoir si le sbire est invoqué ( 1->10 : non / 11->20 : oui )',
            ],
        ];
        $this->boss['vampire'] = [
            'id' => 2,
            'name' => 'Vampire supérieur',
            'type' => 'vampire',
            'hp' => 130,
            'informations' => [
                'strength' => [
                    'type' =>'aucune',
                    'description' => [
                        'aucune',
                    ],
                ],
                'weakness' => [
                    'type' => 'cardio / gym / force',
                    'description' => [
                        '1k row ',
                        '50 burpees',
                        '100 DU',
                        '20 Deadlift (70% 1RM)',
                        '20 Clean (60% 1RM)',
                        '20 Shoulder press (50% 1RM clean)',
                        '25 pull ups',
                        '50 push ups',
                        '100 sit ups'
                    ],
                ],
                'menace' => 'Fort, Difficile',
                'description' => 'Nombreux sont ceux qui comptent parmi les membres de ce groupe les albs, les mulas, les katakans, les bruxes et les nosferatu. Ces espèces possèdent en effet plusieurs caractéristiques uniques que ne partagent pas leurs cousins mineurs, et sont donc communément appelées vampires supérieurs. Ils sont résistants à la lumière du soleil et la plupart peuvent masquer leur véritable nature et se faire passer pour des humains, ce qui les aide à chasser ou à échapper à la poursuite. Beaucoup sont également capables de se transformer et possèdent des pouvoirs télépathiques, ce qui en fait des ennemis redoutables. Malgré toutes ces capacités, ils ne sont cependant pas de véritables vampires supérieurs.',
                'height' => 'Taille humaine normale',
                'weight' => 'Poids humain normal',
                'environment' => 'Partout, souvent en zones urbaines',
                'intelligence' => 'Bien plus intelligent qu’un humain',
                'organisation' => 'Solitaire',
                'specificity' => 'Sac à PV. Vous vol un point de santé à chaque tour. Ce monstre n’inflige pas de pénalité en cas d’échec critique',
            ],
        ];
        $this->boss['vestige'] = [
            'id' => 7,
            'name' => 'Leshen',
            'type' => 'vestige',
            'hp' => 200,
            'informations' => [
                'strength' => [
                    'type' => 'gym',
                    'description' => [
                        '25 pull ups',
                        '50 push ups',
                        '100 sit ups'
                    ],
                ],
                'weakness' => [
                    'type' =>'cardio',
                    'description' => [
                        '1k row ',
                        '50 burpees',
                        '100 DU',
                    ],
                ],
                'menace' => 'Fort, Difficile',
                'description' => 'Le Seigneur de la forêt est un dieu ancien qui commande à toutes les bêtes et à tous les oiseaux de la forêt. Si l’on ne laisse pas une offrande ou un sacrifice jugé digne, de terribles malheurs s’abattront sur le village. Les rivières s’assècheront, le gibier s’enfuira et la fumée jaillira des arbres cachant les loups.',
                'height' => 'Environ 4m',
                'weight' => 'Environ 250kg',
                'environment' => 'Forêts profonde et nature sauvage',
                'intelligence' => 'Peut être plus intelligent qu’un humain',
                'organisation' => ' Solitaire',
                'specificity' => 'Sac à PV',
            ],
        ];
    }

    private function display($any){
        echo "<pre>" . $any . "</pre>";
    }

    private function boostHp(array $trashMobData): array
    {
        $newTrashMobData = $trashMobData;
        $newTrashMobData['name'] = $newTrashMobData['name'] . " Alpha";
        if (isset($newTrashMobData['hp']) && is_array($newTrashMobData['hp'])) {
            foreach ($newTrashMobData['hp'] as &$hp) {
                $hp += 5;
            }
        }

        return $newTrashMobData;
    }

    private function checkDieStatus(int $value): string
    {
        switch ($value) {
            case 20:
                return "criticalSuccess";
            case 19:
            case 18:
            case 17:
            case 16:
            case 15:
            case 14:
            case 13:
            case 12:
            case 11:
                return "success";
            case 10:
            case 9:
            case 8:
            case 7:
            case 6:
                return "challenge";
            case 5:
            case 4:
            case 3:
            case 2:
                return "challenge";
            case 1:
                return "criticalFail";
            default:
                return "pb";
        }
    }

    private function dungeonBuilder(?bool $isBossOnly = false): array
    {
        $dungeon = [];
        $monsterType = $this->dungeonType[mt_rand(0, count($this->dungeonType) - 1)];

        if(!$isBossOnly){
            $waveDieRoll = mt_rand(3, 3);

            // TRASH MOBS
            for ($i = 1; $i <= $waveDieRoll; $i++) {
                $this->trashMobsDieRoll = mt_rand(1, 3);
                $this->trashMobsType = $this->dungeonType[mt_rand(0, count($this->dungeonType) - 1)];
                $trashMob = $this->trashMobs[$this->trashMobsType][mt_rand(0, count($this->trashMobs[$this->trashMobsType]) - 1)];
                $dungeon['wave'][$i] = [];
                for ($j = 0; $j <= ($this->trashMobsDieRoll-1); $j++) {
                    if($this->trashMobsType === $monsterType) {
                        $dungeon['wave'][$i][$j] = $this->boostHp($trashMob);
                    } else {
                        $dungeon['wave'][$i][$j] = $trashMob;
                    }
                }
            }
        }

        // BOSS
        $dungeon['boss'] = $this->boss[$monsterType];

        return $dungeon;
    }

    private function battleScenario($dungeon): array
    {
        $logs = [];

        $isExtraWods = true;
        $isPanicSystemPlayer = true;
        $isOverMotivatedPlayer = true;
        $isRestaureHealthBeforeBoss = true;

        $dieClassic = 20;
        $dieTrashMob = 4;

        $initHpPerso = 100;
        $hpPerso = $initHpPerso;

        $round = 0;
        $penalityRound = 0;
        $extraWorkoutRound = 0;

        $nbCriticalSuccess = 0;
        $nbSuccess = 0;
        $nbFail= 0;
        $nbCriticalFail = 0;

        if(array_key_exists('wave', $dungeon)){
            foreach ($dungeon['wave'] as $indexWave => $wave) {
                $monstersHp = [];
                foreach ($wave as $monster) {
                    $monstersHp[] = $monster['hp'][$indexWave-1];
                }

                $nbMonsters = count($monstersHp);

                $index = 0;
                while (array_sum($monstersHp) > 0) {
                    $round++;
                    $nbPA = 1;
                    if($isExtraWods){
                        $extraWorkoutRound++;
                        $nbPA++;
                    }
                    while ($nbPA > 0) {
                        $nbPA--;
                        $actionDieRoll = mt_rand(1, $dieClassic);
                        $dmgDieRoll = mt_rand(1, $dieClassic);
                        $makeDmg = 0;
                        $receveDmg = 0;

                        // -----------------------------------------------------------------------------------------
                        // PLAYER
                        // -----------------------------------------------------------------------------------------

                        // CLASSIC
                        if ($this->checkDieStatus($actionDieRoll) === "criticalSuccess") {
                            $nbCriticalSuccess++;
                            $makeDmg = $dmgDieRoll * 2;

                            $logs['battle'][$round][] = "-------------------------------------> Wave #$indexWave | ROUND #$round : " . $monster['name'] . " #$index (Critical Success: $actionDieRoll)";
                        } else if ($this->checkDieStatus($actionDieRoll) === "success") {
                            $nbSuccess++;
                            $makeDmg = $dmgDieRoll;

                            $logs['battle'][$round][] = "-------------------------------------> Wave #$indexWave | ROUND #$round : " . $monster['name'] . " #$index (Success: $actionDieRoll)";
                        } else if ($this->checkDieStatus($actionDieRoll) === "criticalFail") {
                            $nbCriticalFail++;
                            $penalityRound++;
                            $receveDmg = $dmgDieRoll;

                            $logs['battle'][$round][] = "-------------------------------------> Wave #$indexWave | ROUND #$round : " . $monster['name'] . " #$index (Critical Fail: $actionDieRoll)";
                            $logs['battle'][$round][] = "Receve extra damage : " . $dmgDieRoll;
                        } else {
                            $nbFail++;
                            $logs['battle'][$round][] = "-------------------------------------> Wave #$indexWave | ROUND #$round : " . $monster['name'] . " #$index (Fail: $actionDieRoll)";
                        }

                        if ($makeDmg >= $monstersHp[$index]) {
                            $monstersHp[$index] = 0;
                            $logs['battle'][$round][] = "Wave #$indexWave ". $monster['name'] . " killed";

                            // Always in the same wave
                            if(array_sum($monstersHp)){
                                $nbMonsters--;
                                $index++;
                            }
                        } else {
                            $monstersHp[$index] -= $makeDmg;
                            $logDmg = $this->checkDieStatus($actionDieRoll) === "criticalSuccess" || $this->checkDieStatus($actionDieRoll) === "success" ? " (-$makeDmg)" : "";
                            $logs['battle'][$round][] = "Wave #$indexWave ".$monster['name'] . " : $monstersHp[$index]pv$logDmg";
                        }


                        // Panic system player
                        if ($isExtraWods && $isPanicSystemPlayer && $hpPerso < 40 ){
                            $nbPA--;
                            $extraHealDieRoll = mt_rand(1, $dieClassic);
                            $logs['battle'][$round][] = "Get health (EXTRA WORKOUT) : " . $extraHealDieRoll;
                            $hpPerso += $extraHealDieRoll; // Gain HP
                        }

                    }

                    // ---------------------------------------------------------------------------------------------
                    // MONSTERS
                    // ---------------------------------------------------------------------------------------------
                    if (array_sum($monstersHp) && $nbMonsters) {
                        $logs['battle'][$round][] = "Monsters damage -------------------------";
                        for ($i = 1; $i <= $nbMonsters; $i++) {
                            $dmgDieRoll = mt_rand(1, $dieTrashMob);
                            $receveDmg += $dmgDieRoll;
                            $logs['battle'][$round][] = "Receve $dmgDieRoll damage";
                        }

                        $hpPerso -= $receveDmg;
                        $logs['battle'][$round][] = "-------------";
                        $logs['battle'][$round][] = "PERSO : " . $hpPerso . "pv " . (($receveDmg !== 0) ? "(-" . $receveDmg . ")" : "");
                    }
                }
            }
        }

        if(array_key_exists('boss', $dungeon)){

            // Drink health potion
            if($isRestaureHealthBeforeBoss){
                $hpPerso = 100;
                $logs['battle'][$round][] = "-------------------------------------> Drink health potions. Restaure all perso PV";
            }

            $boss = $dungeon['boss'];
            $bossHp = $dungeon['boss']['hp'];
            while ($bossHp > 0) {
                $round++;
                $nbPA = 1;
                if($isExtraWods){
                    $extraWorkoutRound++;
                    $nbPA++;
                }
                while ($nbPA > 0) {
                    $nbPA--;
                    $actionDieRoll = mt_rand(1, $dieClassic);
                    $dmgDieRoll = mt_rand(1, $dieClassic);
                    $makeDmg = 0;
                    $receveDmg = 0;

                    // -----------------------------------------------------------------------------------------
                    // PLAYER
                    // -----------------------------------------------------------------------------------------

                    // CLASSIC
                    if ($this->checkDieStatus($actionDieRoll) === "criticalSuccess") {
                        $nbCriticalSuccess++;
                        $makeDmg = $dmgDieRoll * 2;

                        $logs['battle'][$round][] = "-------------------------------------> Wave BOSS | ROUND #$round : " . $boss['name'] . " (Critical Success: $actionDieRoll)";
                    } else if ($this->checkDieStatus($actionDieRoll) === "success") {
                        $nbSuccess++;
                        $makeDmg = $dmgDieRoll;

                        $logs['battle'][$round][] = "-------------------------------------> Wave BOSS | ROUND #$round : " . $boss['name'] . " (Success: $actionDieRoll)";
                    } else if ($this->checkDieStatus($actionDieRoll) === "criticalFail") {
                        $nbCriticalFail++;
                        $penalityRound++;
                        $receveDmg = $dmgDieRoll;

                        $logs['battle'][$round][] = "-------------------------------------> Wave BOSS | ROUND #$round : " . $boss['name'] . " (Critical Fail: $actionDieRoll)";
                        $logs['battle'][$round][] = "Receve extra damage : " . $dmgDieRoll;
                    } else {
                        $nbFail++;
                        $logs['battle'][$round][] = "-------------------------------------> Wave BOSS | ROUND #$round : " . $boss['name'] . " (Fail: $actionDieRoll)";
                    }

                    if ($makeDmg >= $bossHp) {
                        $bossHp = 0;
                        $logs['battle'][$round][] = "Wave BOSS ". $boss['name'] . " killed";
                    } else {
                        $bossHp -= $makeDmg;
                        $logDmg = $this->checkDieStatus($actionDieRoll) === "criticalSuccess" || $this->checkDieStatus($actionDieRoll) === "success" ? " (-$makeDmg)" : "";
                        $logs['battle'][$round][] = "Wave BOSS ".$boss['name'] . " : $bossHp pv $logDmg";
                    }


                    // Panic system player
                    if ($isExtraWods && $isPanicSystemPlayer && $hpPerso < 40 ){
                        $nbPA--;
                        $extraHealDieRoll = mt_rand(1, $dieClassic);
                        $logs['battle'][$round][] = "Get health (EXTRA WORKOUT) : " . $extraHealDieRoll;
                        $hpPerso += $extraHealDieRoll; // Gain HP
                    }

                }

                // ---------------------------------------------------------------------------------------------
                // MONSTERS
                // ---------------------------------------------------------------------------------------------
                $logs['battle'][$round][] = "Monsters damage -------------------------";

                $dmgDieRoll = mt_rand(1, $dieTrashMob);
                $receveDmg += $dmgDieRoll;
                $logs['battle'][$round][] = "Receve $dmgDieRoll damage";


                $hpPerso -= $receveDmg;
                $logs['battle'][$round][] = "-------------";
                $logs['battle'][$round][] = "PERSO : " . $hpPerso . "pv " . (($receveDmg !== 0) ? "(-" . $receveDmg . ")" : "");

            }
        }

        $logs['nbTotalRounds'] = $round;
        $logs['nbExtraWorkoutRound'] = $extraWorkoutRound;
        $logs['nbPenalityRound'] = $penalityRound;
        $logs['threePerWeekWeeks'] = ceil($round / 3);
        $logs['fivePerWeekWeeks'] = ceil($round / 5);
        $logs['diceStatus']['criticalSuccess'] = $nbCriticalSuccess;
        $logs['diceStatus']['succes'] = $nbSuccess;
        $logs['diceStatus']['fail'] = $nbFail;
        $logs['diceStatus']['criticalFail'] = $nbCriticalFail;
        $logs['health'] = $hpPerso;
        $logs['win'] = ($hpPerso >= 0) ? true : false;

        return $logs;
    }

    /**
     * @Route("/quest/", name="app_quest", methods={"GET"})
     */
    public function index(
        Request $request
    ): Response
    {

//        for ($i = 1; $i <= 1; $i++) {
//            // $logs[$i] = battleScenario($this->>boss[$this->>dungeonType[mt_rand(0, count($this->>dungeonType) - 1)]]);
//            // $logs[$i] = battleBossScenario($this->>boss['hybride']);
//            $dungeon = dungeonBuilder($this->>dungeonType, $this->>trashMobs, $this->>boss);
//            $logs[$i] = battleScenario($dungeon);
//        }

        $dungeon = $this->dungeonBuilder(false);
        $battle = $this->battleScenario($dungeon);

        return $this->render('quest/index.html.twig', [
            'monsters' => $this->boss,
            'dungeon' => $dungeon,
            'battle' => $battle,
        ]);
    }

}
