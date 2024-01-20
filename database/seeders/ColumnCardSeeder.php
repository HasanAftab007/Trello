<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Column;
use Illuminate\Database\Seeder;

class ColumnCardSeeder extends Seeder
{
    public function run(): void {
        $columnCards = [
            [
                'column' => [
                    'user_id' => 1,
                    'title' => 'Development Tasks',
                    'position' => 0,
                ],
                'cards' => [
                    [
                        'user_id' => 1,
                        'title' => 'Fix Database Bug',
                        'description' => 'Investigate and resolve issue with database connection.',
                        'activity' => 'Programming',
                        'position' => 0
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Design Dashboard Icons',
                        'description' => 'Create modern and visually appealing icons for the dashboard.',
                        'activity' => 'Design',
                        'position' => 1
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Write API Documentation',
                        'description' => 'Document the API endpoints for better understanding.',
                        'activity' => 'Documentation',
                        'position' => 2
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Refactor Authentication',
                        'description' => 'Enhance and refactor the existing user authentication system.',
                        'activity' => 'Programming',
                        'position' => 3
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Implement Feature',
                        'description' => 'Add the ability for users to upload files to the application.',
                        'activity' => 'Programming',
                        'position' => 4
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Design Profile Page',
                        'description' => 'Create a visually appealing user profile page layout.',
                        'activity' => 'Design',
                        'position' => 5
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Configure Database',
                        'description' => 'Set up and configure the production database for optimal performance.',
                        'activity' => 'Deployment',
                        'position' => 6
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Seed Data',
                        'description' => 'Set up and configure the production database for optimal performance.',
                        'activity' => 'Deployment',
                        'position' => 7
                    ],
                ]
            ],
            [
                'column' => [
                    'user_id' => 1,
                    'title' => 'Bug Fixes',
                    'position' => 1,
                ],
                'cards' => [
                    [
                        'user_id' => 1,
                        'title' => 'Resolve Login Issue',
                        'description' => 'Users are unable to log in. Investigate and fix the issue.',
                        'activity' => 'Programming',
                        'position' => 0
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Fix Bug Navigation',
                        'description' => 'Correct the styling issue affecting the navigation menu.',
                        'activity' => 'Design',
                        'position' => 1
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Resolve Loading Issue',
                        'description' => 'Investigate and fix issues related to images not loading properly.',
                        'activity' => 'Programming',
                        'position' => 2
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Fix Broken Links',
                        'description' => 'Identify and correct any broken links affecting the navigation menu.',
                        'activity' => 'Design',
                        'position' => 3
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Address UI Bug',
                        'description' => 'Investigate and resolve issues with the user interface rendering incorrectly.',
                        'activity' => 'Design',
                        'position' => 4
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Patch Security',
                        'description' => 'Identify and address any security vulnerabilities in the codebase.',
                        'activity' => 'Security',
                        'position' => 5
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Prepare Notes',
                        'description' => 'Draft release notes for the upcoming version.',
                        'activity' => 'Documentation',
                        'position' => 6
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Configure Database',
                        'description' => 'Set up and configure the production database for optimal performance.',
                        'activity' => 'Deployment',
                        'position' => 7
                    ],
                ]
            ],
            [
                'column' => [
                    'user_id' => 1,
                    'title' => 'Testing Phase',
                    'position' => 2,
                ],
                'cards' => [
                    [
                        'user_id' => 1,
                        'title' => 'Perform Unit Tests',
                        'description' => 'Write and execute unit tests for critical components.',
                        'activity' => 'Testing',
                        'position' => 0
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Test Compatibility',
                        'description' => 'Ensure the application works well on various browsers.',
                        'activity' => 'Testing',
                        'position' => 1
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Perform Testing',
                        'description' => 'Conduct load testing to assess the system\'s performance under heavy load.',
                        'activity' => 'Testing',
                        'position' => 2
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Test Responsiveness',
                        'description' => 'Ensure the application is responsive and functions well on various mobile devices.',
                        'activity' => 'Testing',
                        'position' => 3
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Verify Compatibility',
                        'description' => 'Check compatibility across different platforms, including Windows, macOS, and Linux.',
                        'activity' => 'Testing',
                        'position' => 4
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Integration with APIs',
                        'description' => 'Verify the seamless integration of the application with external APIs.',
                        'activity' => 'Testing',
                        'position' => 5
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Test Responsiveness',
                        'description' => 'Ensure the application is responsive and functions well on various mobile devices.',
                        'activity' => 'Testing',
                        'position' => 6
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Verify Compatibility',
                        'description' => 'Check compatibility across different platforms, including Windows, macOS, and Linux.',
                        'activity' => 'Testing',
                        'position' => 7
                    ],
                ]
            ],
            [
                'column' => [
                    'user_id' => 1,
                    'title' => 'Deployment Tasks',
                    'position' => 3,
                ],
                'cards' => [
                    [
                        'user_id' => 1,
                        'title' => 'Deploy Environment',
                        'description' => 'Deploy the latest changes to the staging environment for testing.',
                        'activity' => 'Deployment',
                        'position' => 0
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Prepare Notes',
                        'description' => 'Draft release notes for the upcoming version.',
                        'activity' => 'Documentation',
                        'position' => 1
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Configure Database',
                        'description' => 'Set up and configure the production database for optimal performance.',
                        'activity' => 'Deployment',
                        'position' => 2
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Generate Certificates',
                        'description' => 'Obtain and configure SSL certificates to secure data transmission over HTTPS.',
                        'activity' => 'Security',
                        'position' => 3
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Prepare Checklist',
                        'description' => 'Create a checklist of tasks to be completed before the final release.',
                        'activity' => 'Documentation',
                        'position' => 4
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Fix Bug Navigation',
                        'description' => 'Correct the styling issue affecting the navigation menu.',
                        'activity' => 'Design',
                        'position' => 5
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Resolve Loading Issue',
                        'description' => 'Investigate and fix issues related to images not loading properly.',
                        'activity' => 'Programming',
                        'position' => 6
                    ],
                ]
            ],
        ];

        foreach ($columnCards as $columnCard) {
            $column = Column::create($columnCard['column']);

            foreach ($columnCard['cards'] as $card) {
                $card['column_id'] = $column->id;
                Card::create($card);
            }

        }
    }
}
