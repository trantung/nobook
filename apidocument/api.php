<?php
/**
 * @api {get} /api/home/courses Request list course's information
 * @apiName HomeGetCourse
 * @apiGroup Frontend
 *
 * @apiParam {String} token Token of user can be empty
 *
 * @apiSuccess {Integer} status Status of response
 * @apiSuccess {String} data  data response
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *{
*    "success": 1,
*    "message": null,
*    "code": 0,
*    "data": [
*        {
*            "id": 12,
*            "name": "Lớp 12",
*            "code": "lop12",
*            "level": "Cấp 3",
*            "courses": []
*        },
*        {
*            "id": 11,
*            "name": "Lớp 11",
*            "code": "lop11",
*            "level": "Cấp 3",
*            "courses": []
*        },
*        {
*            "id": 10,
*            "name": "Lớp 10",
*            "code": "lop10",
*            "level": "Cấp 3",
*            "courses": []
*        },
*        {
*            "id": 9,
*            "name": "Lớp 9",
*            "code": "lop9",
*            "level": "Cấp 2",
*            "courses": []
*        },
*        {
*            "id": 7,
*            "name": "Lớp 8",
*            "code": "lop8",
*            "level": "Cấp 2",
*            "courses": []
*        },
*        {
*            "id": 8,
*            "name": "Lớp 7",
*            "code": "lop7",
*            "level": "Cấp 2",
*            "courses": [
*                {
*                    "id": 1,
*                    "name": "Khóa học thí nghiệm khoa học tự nhiên lớp 6",
*                    "slug": "tunglaso1-khoa-hoc-le",
*                    "type": "Khóa học lẻ",
*                    "desktop_avatar": "nobook63fe18679b81f.png",
*                    "mobile_avatar": "nobook63fe18679bb03.png",
*                    "intro_link": "https://www.youtube.com/watch?v=fNs1VDbeI7E",
*                    "method": "Khóa video",
*                    "description": "mô tả ngắn",
*                    "detail": "<p><u>m&ocirc; tả chi tiết</u></p>",
*                    "result_content": "<p><strong>kết quả nhận được</strong></p>",
*                    "object_content": "<p><em>đối tượng học</em></p>",
*                    "include_content": {
*                        "video_include": "content video",
*                        "access_include": "content mobile",
*                        "article_include": "content text",
*                        "certificate_include": "content cup"
*                    }
*                }
*            ]
*        },
*        {
*            "id": 6,
*            "name": "Lớp 6",
*            "code": "lop6",
*            "level": "Cấp 2",
*            "courses": [
*                {
*                    "id": 1,
*                    "name": "Khóa học thí nghiệm khoa học tự nhiên lớp 6",
*                    "slug": "tunglaso1-khoa-hoc-le",
*                    "type": "Khóa học lẻ",
*                    "desktop_avatar": "nobook63fe18679b81f.png",
*                    "mobile_avatar": "nobook63fe18679bb03.png",
*                    "intro_link": "https://www.youtube.com/watch?v=fNs1VDbeI7E",
*                    "method": "Khóa video",
*                    "description": "mô tả ngắn",
*                    "detail": "<p><u>m&ocirc; tả chi tiết</u></p>",
*                    "result_content": "<p><strong>kết quả nhận được</strong></p>",
*                    "object_content": "<p><em>đối tượng học</em></p>",
*                    "include_content": {
*                        "video_include": "content video",
*                        "access_include": "content mobile",
*                        "article_include": "content text",
*                        "certificate_include": "content cup"
*                    }
*                }
*            ]
*        },
*        {
*            "id": 5,
*            "name": "Lớp 5",
*            "code": "lop5",
*            "level": "Cấp 1",
*            "courses": []
*        },
*        {
*            "id": 4,
*            "name": "Lớp 4",
*            "code": "lop4",
*            "level": "Cấp 1",
*            "courses": []
*        },
*        {
*            "id": 3,
*            "name": "Lớp 3",
*            "code": "lop3",
*            "level": "Cấp 1",
*            "courses": []
*        },
*        {
*            "id": 2,
*            "name": "Lớp 2",
*            "code": "lop2",
*            "level": "Cấp 1",
*            "courses": []
*        },
*        {
*            "id": 1,
*            "name": "Lớp 1",
*            "code": "lop1",
*            "level": "Cấp 1",
*            "courses": []
*        }
*    ]
*}
 */

/**
 * @api {get} /api/course/{id}/detail Request list course's information
 * @apiName FrontendGetIndex
 * @apiGroup Frontend
 *
 * @apiParam {String} token Token of user can be empty
 *
 * @apiSuccess {Integer} status Status of response
 * @apiSuccess {String} data  data response
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 * {
*     "success": 1,
*     "message": null,
*     "code": 0,
*     "data": {
*         "id": 1,
*         "name": "Khóa học thí nghiệm khoa học tự nhiên lớp 6",
*         "slug": "tunglaso1-khoa-hoc-le",
*         "type": "Khóa học lẻ",
*         "desktop_avatar": "nobook63fe18679b81f.png",
*         "mobile_avatar": "nobook63fe18679bb03.png",
*         "intro_link": "https:*www.youtube.com/watch?v=fNs1VDbeI7E",
*         "method": "Khóa video",
*         "description": "mô tả ngắn",
*         "detail": "<p><u>m&ocirc; tả chi tiết</u></p>",
*         "result_content": "<p><strong>kết quả nhận được</strong></p>",
*         "object_content": "<p><em>đối tượng học</em></p>",
*         "include_content": {
*             "video_include": "content video",
*             "access_include": "content mobile",
*             "article_include": "content text",
*             "certificate_include": "content cup"
*         },
*         "sections": [
*             {
*                 "id": 8,
*                 "name": "Chủ đề 1 - Các phép đo",
*                 "data": [
*                     {
*                         "id": 8,
*                         "module": 22,
*                         "instance": 2,
*                         "section": 8,
*                         "name": "url",
*                         "detail": {
*                             "id": 2,
*                             "course": 3,
*                             "name": "Thí nghiệm từ trường",
*                             "intro": "",
*                             "introformat": 1,
*                             "externalurl": "https:*www.youtube.com/watch?v=Tl91B_w_TRs",
*                             "display": 1,
*                             "displayoptions": "a:1:{s:10:\"printintro\";i:1;}",
*                             "parameters": "a:0:{}",
*                             "timemodified": 1676992911
*                         }
*                     },
*                     {
*                         "id": 9,
*                         "module": 22,
*                         "instance": 3,
*                         "section": 8,
*                         "name": "url",
*                         "detail": {
*                             "id": 3,
*                             "course": 3,
*                             "name": "Thực hành cân đo khối lượng",
*                             "intro": "",
*                             "introformat": 1,
*                             "externalurl": "https:*www.youtube.com/watch?v=Tl91B_w_TRs",
*                             "display": 1,
*                             "displayoptions": "a:1:{s:10:\"printintro\";i:1;}",
*                             "parameters": "a:0:{}",
*                             "timemodified": 1676993035
*                         }
*                     },
*                     {
*                         "id": 12,
*                         "module": 15,
*                         "instance": 1,
*                         "section": 8,
*                         "name": "lesson",
*                         "detail": {
*                             "id": 1,
*                             "course": 3,
*                             "name": "Bài học từ trường",
*                             "intro": "<p dir=\"ltr\" style=\"text-align: left;\">&nbsp;<video controls=\"true\"><source src=\"@@PLUGINFILE@@/file_example_MP4_480_1_5MG.mp4\">@@PLUGINFILE@@/file_example_MP4_480_1_5MG.mp4</video>&nbsp;<br></p>",
*                             "introformat": 1,
*                             "practice": 0,
*                             "modattempts": 0,
*                             "usepassword": 0,
*                             "password": "",
*                             "dependency": 0,
*                             "conditions": "O:8:\"stdClass\":3:{s:9:\"timespent\";i:0;s:9:\"completed\";i:0;s:15:\"gradebetterthan\";i:0;}",
*                             "grade": 100,
*                             "custom": 1,
*                             "ongoing": 0,
*                             "usemaxgrade": 0,
*                             "maxanswers": 5,
*                             "maxattempts": 1,
*                             "review": 0,
*                             "nextpagedefault": 0,
*                             "feedback": 0,
*                             "minquestions": 0,
*                             "maxpages": 1,
*                             "timelimit": 0,
*                             "retake": 0,
*                             "activitylink": 0,
*                             "mediafile": "",
*                             "mediaheight": 480,
*                             "mediawidth": 640,
*                             "mediaclose": 0,
*                             "slideshow": 0,
*                             "width": 640,
*                             "height": 480,
*                             "bgcolor": "#FFFFFF",
*                             "displayleft": 0,
*                             "displayleftif": 0,
*                             "progressbar": 0,
*                             "available": 0,
*                             "deadline": 0,
*                             "timemodified": 1676998735,
*                             "completionendreached": 0,
*                             "completiontimespent": 0,
*                             "allowofflineattempts": 0
*                         }
*                     }
*                 ]
*             },
*             {
*                 "id": 9,
*                 "name": "Chủ đề 2 - Lực",
*                 "data": [
*                     {
*                         "id": 10,
*                         "module": 17,
*                         "instance": 2,
*                         "section": 9,
*                         "name": "page",
*                         "detail": {
*                             "id": 2,
*                             "course": 3,
*                             "name": "Thực hành đo lực, kiểm chứng tác dụng của Lực",
*                             "intro": "",
*                             "introformat": 1,
*                             "content": "<p dir=\"ltr\" style=\"text-align: left;\">Đo lực</p>",
*                             "contentformat": 1,
*                             "legacyfiles": 0,
*                             "legacyfileslast": null,
*                             "display": 5,
*                             "displayoptions": "a:2:{s:10:\"printintro\";s:1:\"0\";s:17:\"printlastmodified\";s:1:\"1\";}",
*                             "revision": 1,
*                             "timemodified": 1676993082
*                         }
*                     }
*                 ]
*             }
*         ]
*     }
* }

 */


?>
