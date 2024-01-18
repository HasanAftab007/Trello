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
                        'title' => 'Fix Database Connection Bug',
                        'description' => 'Investigate and resolve issue with database connection.',
                        'activity' => 'Programming',
                        'position' => 0
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Design New Dashboard Icons',
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
                        'title' => 'Refactor User Authentication',
                        'description' => 'Enhance and refactor the existing user authentication system.',
                        'activity' => 'Programming',
                        'position' => 6
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Implement File Upload Feature',
                        'description' => 'Add the ability for users to upload files to the application.',
                        'activity' => 'Programming',
                        'position' => 7
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Design User Profile Page',
                        'description' => 'Create a visually appealing user profile page layout.',
                        'activity' => 'Design',
                        'position' => 8
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
                        'title' => 'Resolve User Login Issue',
                        'description' => 'Users are unable to log in. Investigate and fix the issue.',
                        'activity' => 'Programming',
                        'position' => 0
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Fix Styling Bug in Navigation',
                        'description' => 'Correct the styling issue affecting the navigation menu.',
                        'activity' => 'Design',
                        'position' => 1
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Resolve Image Loading Issue',
                        'description' => 'Investigate and fix issues related to images not loading properly.',
                        'activity' => 'Programming',
                        'position' => 7
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Fix Broken Links in Navigation',
                        'description' => 'Identify and correct any broken links affecting the navigation menu.',
                        'activity' => 'Design',
                        'position' => 8
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Address UI Rendering Bug',
                        'description' => 'Investigate and resolve issues with the user interface rendering incorrectly.',
                        'activity' => 'Design',
                        'position' => 9
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Patch Security Vulnerability',
                        'description' => 'Identify and address any security vulnerabilities in the codebase.',
                        'activity' => 'Security',
                        'position' => 10
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
                        'title' => 'Test Cross-Browser Compatibility',
                        'description' => 'Ensure the application works well on various browsers.',
                        'activity' => 'Testing',
                        'position' => 1
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Perform Load Testing',
                        'description' => 'Conduct load testing to assess the system\'s performance under heavy load.',
                        'activity' => 'Testing',
                        'position' => 7
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Test Mobile Responsiveness',
                        'description' => 'Ensure the application is responsive and functions well on various mobile devices.',
                        'activity' => 'Testing',
                        'position' => 8
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Verify Cross-Platform Compatibility',
                        'description' => 'Check compatibility across different platforms, including Windows, macOS, and Linux.',
                        'activity' => 'Testing',
                        'position' => 9
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Test Integration with Third-Party APIs',
                        'description' => 'Verify the seamless integration of the application with external APIs.',
                        'activity' => 'Testing',
                        'position' => 10
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
                        'title' => 'Deploy to Staging Environment',
                        'description' => 'Deploy the latest changes to the staging environment for testing.',
                        'activity' => 'Deployment',
                        'position' => 0
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Prepare Release Notes',
                        'description' => 'Draft release notes for the upcoming version.',
                        'activity' => 'Documentation',
                        'position' => 1
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Configure Production Database',
                        'description' => 'Set up and configure the production database for optimal performance.',
                        'activity' => 'Deployment',
                        'position' => 6
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Generate SSL Certificates',
                        'description' => 'Obtain and configure SSL certificates to secure data transmission over HTTPS.',
                        'activity' => 'Security',
                        'position' => 7
                    ],
                    [
                        'user_id' => 1,
                        'title' => 'Prepare Release Checklist',
                        'description' => 'Create a checklist of tasks to be completed before the final release.',
                        'activity' => 'Documentation',
                        'position' => 8
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
