<?php

namespace Plafor\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Plafor\Models\ModuleModel;
use Plafor\Models\UserCourseModuleModel;

class addUserCourseModulesDatas extends Seeder
{
    public function run()
    {
        $links = [
            1 => [
                // 1st year
                [
                    'module_number' => 100,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 101,
                    'version' => 3,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 104,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 114,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 117,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 123,
                    'version' => 2,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 253,
                    'version' => 2,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 301,
                    'version' => 1,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 302,
                    'version' => 3,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 304,
                    'version' => 2,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 305,
                    'version' => 2,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 403,
                    'version' => 1,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 404,
                    'version' => 1,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 431,
                    'version' => 2,
                    'is_school' => TRUE,
                ],
                // 2nd year
                [
                    'module_number' => 120,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 121,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 122,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 129,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 213,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 214,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => '226A',
                    'version' => 4,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => '226B',
                    'version' => 4,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 242,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 256,
                    'version' => 2,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 307,
                    'version' => 3,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 318,
                    'version' => 3,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 411,
                    'version' => 1,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 426,
                    'version' => 1,
                    'is_school' => TRUE,
                ],
                // 3rd year
                [
                    'module_number' => 105,
                    'version' => 3,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 133,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 151,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 306,
                    'version' => 4,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 326,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 335,
                    'version' => 3,
                    'is_school' => FALSE,
                ],
                // 4th year
                [
                    'module_number' => 150,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 152,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 153,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 154,
                    'version' => 2,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 155,
                    'version' => 2,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 183,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 223,
                    'version' => 3,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 254,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
            ],
            2 => [
                // 1st year
                [
                    'module_number' => 100,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 101,
                    'version' => 3,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 104,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 114,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 117,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 123,
                    'version' => 2,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 301,
                    'version' => 1,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 302,
                    'version' => 3,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 304,
                    'version' => 2,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 305,
                    'version' => 2,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 403,
                    'version' => 1,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 404,
                    'version' => TRUE,
                    'is_school' => 1,
                ],
                [
                    'module_number' => 431,
                    'version' => 2,
                    'is_school' => TRUE,
                ],
                // 2nd year
                [
                    'module_number' => 121,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 122,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 124,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 126,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 127,
                    'version' => 3,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 129,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 130,
                    'version' => 3,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 213,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 214,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 242,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 437,
                    'version' => 1,
                    'is_school' => TRUE,
                ],
                // 3rd year
                [
                    'module_number' => 105,
                    'version' => 3,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 141,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 143,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 145,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 146,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 182,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 239,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 300,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 306,
                    'version' => 4,
                    'is_school' => TRUE,
                ],
                // 4th year
                [
                    'module_number' => 156,
                    'version' => 2,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 157,
                    'version' => 4,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 158,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 159,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 184,
                    'version' => 3,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 330,
                    'version' => 3,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 340,
                    'version' => 3,
                    'is_school' => FALSE,
                ],
            ],
            3 => [
                // 1st year
                [
                    'module_number' => 117,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 123,
                    'version' => 2,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 126,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 214,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 260,
                    'version' => 1,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 304,
                    'version' => 2,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 305,
                    'version' => 2,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 431,
                    'version' => 2,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 437,
                    'version' => 1,
                    'is_school' => TRUE,
                ],
                // 2nd year
                [
                    'module_number' => 129,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 261,
                    'version' => 1,
                    'is_school' => FALSE,
                ],
                [
                    'module_number' => 263,
                    'version' => 1,
                    'is_school' => TRUE,
                ],
                // 3rd year
                [
                    'module_number' => 122,
                    'version' => 3,
                    'is_school' => TRUE,
                ],
                [
                    'module_number' => 262,
                    'version' => 1,
                    'is_school' => TRUE,
                ],
            ],
        ];

        foreach ($links as $user_course_id => $user_course_links) {
            foreach ($user_course_links as $link) {
                $module_number = $link['module_number'];
                $version = $link['version'];
                $module = ModuleModel::getInstance()->where('module_number', $module_number)->where('version', $version)->first();
                if (empty($module)) {
                    log_message('error', "Could not find module with number ${module_number} and version ${version}");
                    continue;
                }

                UserCourseModuleModel::getInstance()->insert([
                    'fk_user_course' => $user_course_id,
                    'fk_module' => $module['id'],
                    'is_school' => $link['is_school'],
                ]);
            }
        }
    }
}
