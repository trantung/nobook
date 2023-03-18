<?php
/**
 * @api {post} /api/home/courses Danh sách course được nhóm theo lớp
 * @apiName HomeGetCourseGroupByClass
 * @apiGroup Frontend
 *
 * @apiParam {String} token Token of user can be empty
 * @apiParam {String} group_by_class Nhóm theo lớp
 * ví dụ: group_by_class = 1
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
 * @api {post} /api/home/courses Danh sách course được nhóm theo môn
 * @apiName HomeGetCourseGroupBySubject
 * @apiGroup Frontend
 *
 * @apiParam {String} token Token of user can be empty
 * @apiParam {String} group_by_subject Nhóm theo môn
 * ví dụ: group_by_subject = 1
 * @apiSuccess {Integer} status Status of response
 * @apiSuccess {String} data  data response
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
* {
* "success": 1,
* "message": null,
* "code": 0,
* "data": [
*     {
*         "id": 1,
*         "name": "Toán",
*         "code": "toan",
*         "courses": [
*             {
*                 "id": 3,
*                 "name": "Khóa 2",
*                 "slug": "khoa-2",
*                 "type": "Khóa học lẻ",
*                 "desktop_avatar": "nobook64108d22e3a73.png",
*                 "mobile_avatar": null,
*                 "intro_link": "https:*antdv.com/components/notification/#Notification",
*                 "method": "Khóa video",
*                 "description": "Mô tả ngắn",
*                 "detail": "<p>M&ocirc; tả chi tiết kh&oacute;a học</p>",
*                 "result_content": "<p>Kết quả nhận được</p>",
*                 "object_content": null,
*                 "include_content": {
*                     "video_include": "asd",
*                     "access_include": "fgg",
*                     "article_include": "asdwew",
*                     "certificate_include": "zxczxc"
*                 }
*             }
*         ]
*     },
*     {
*         "id": 2,
*         "name": "Lý",
*         "code": "ly",
*         "courses": [
*             {
*                 "id": 4,
*                 "name": "Khóa 3",
*                 "slug": "khoa-3",
*                 "type": "Khóa học lẻ",
*                 "desktop_avatar": "nobook64108d50ca08a.png",
*                 "mobile_avatar": null,
*                 "intro_link": null,
*                 "method": "Khóa video",
*                 "description": "Mô tả ngắ",
*                 "detail": "<p>M&ocirc; tả ngắ</p>",
*                 "result_content": "<p>M&ocirc; tả ngắ</p>",
*                 "object_content": null,
*                 "include_content": {
*                     "video_include": "",
*                     "access_include": "",
*                     "article_include": "",
*                     "certificate_include": ""
*                 }
*             },
*             {
*                 "id": 3,
*                 "name": "Khóa 2",
*                 "slug": "khoa-2",
*                 "type": "Khóa học lẻ",
*                 "desktop_avatar": "nobook64108d22e3a73.png",
*                 "mobile_avatar": null,
*                 "intro_link": "https:*antdv.com/components/notification/#Notification",
*                 "method": "Khóa video",
*                 "description": "Mô tả ngắn",
*                 "detail": "<p>M&ocirc; tả chi tiết kh&oacute;a học</p>",
*                 "result_content": "<p>Kết quả nhận được</p>",
*                 "object_content": null,
*                 "include_content": {
*                     "video_include": "asd",
*                     "access_include": "fgg",
*                     "article_include": "asdwew",
*                     "certificate_include": "zxczxc"
*                 }
*             },
*             {
*                 "id": 2,
*                 "name": "Khóa 1",
*                 "slug": "khoa-1",
*                 "type": "Khóa học lẻ",
*                 "desktop_avatar": "nobook64108c6e1dadb.png",
*                 "mobile_avatar": "nobook64108c6e1dcea.png",
*                 "intro_link": "https:*antdv.com/components/notification/#Notification",
*                 "method": "Khóa video",
*                 "description": "mô tả ngắn",
*                 "detail": "<p>chi tiết kh&oacute;a học</p>",
*                 "result_content": "<p>kết quả</p>",
*                 "object_content": "<p>Đối tượng học</p>",
*                 "include_content": {
*                     "video_include": "a",
*                     "access_include": "c",
*                     "article_include": "b",
*                     "certificate_include": "d"
*                 }
*             }
*         ]
*     },
*     {
*         "id": 3,
*         "name": "Hóa",
*         "code": "hoa",
*         "courses": [
*             {
*                 "id": 4,
*                 "name": "Khóa 3",
*                 "slug": "khoa-3",
*                 "type": "Khóa học lẻ",
*                 "desktop_avatar": "nobook64108d50ca08a.png",
*                 "mobile_avatar": null,
*                 "intro_link": null,
*                 "method": "Khóa video",
*                 "description": "Mô tả ngắ",
*                 "detail": "<p>M&ocirc; tả ngắ</p>",
*                 "result_content": "<p>M&ocirc; tả ngắ</p>",
*                 "object_content": null,
*                 "include_content": {
*                     "video_include": "",
*                     "access_include": "",
*                     "article_include": "",
*                     "certificate_include": ""
*                 }
*             },
*             {
*                 "id": 2,
*                 "name": "Khóa 1",
*                 "slug": "khoa-1",
*                 "type": "Khóa học lẻ",
*                 "desktop_avatar": "nobook64108c6e1dadb.png",
*                 "mobile_avatar": "nobook64108c6e1dcea.png",
*                 "intro_link": "https:*antdv.com/components/notification/#Notification",
*                 "method": "Khóa video",
*                 "description": "mô tả ngắn",
*                 "detail": "<p>chi tiết kh&oacute;a học</p>",
*                 "result_content": "<p>kết quả</p>",
*                 "object_content": "<p>Đối tượng học</p>",
*                 "include_content": {
*                     "video_include": "a",
*                     "access_include": "c",
*                     "article_include": "b",
*                     "certificate_include": "d"
*                 }
*             },
*             {
*                 "id": 1,
*                 "name": "Khóa học thí nghiệm khoa học tự nhiên lớp 6",
*                 "slug": "tunglaso1-khoa-hoc-le",
*                 "type": "Khóa học lẻ",
*                 "desktop_avatar": "nobook63fe18679b81f.png",
*                 "mobile_avatar": "nobook63fe18679bb03.png",
*                 "intro_link": "https:*www.youtube.com/watch?v=fNs1VDbeI7E",
*                 "method": "Khóa video",
*                 "description": "mô tả ngắn",
*                 "detail": "<p><u>m&ocirc; tả chi tiết</u></p>",
*                 "result_content": "<p><strong>kết quả nhận được</strong></p>",
*                 "object_content": "<p><em>đối tượng học</em></p>",
*                 "include_content": {
*                     "video_include": "content video",
*                     "access_include": "content mobile",
*                     "article_include": "content text",
*                     "certificate_include": "content cup"
*                 }
*             }
*         ]
*     }
* ]
* }
 */

/**
 * @api {post} /api/home/courses Danh sách course được filter theo lớp và môn
 * @apiName HomeGetCourseFilterByClassSubject
 * @apiGroup Frontend
 *
 * @apiParam {String} token Token of user can be empty
 * @apiParam {String} class_id id của lớp
 * @apiParam {String} subject_id id của môn học
 * ví dụ: class = 10, subject_id = 2
 * @apiSuccess {Integer} status Status of response
 * @apiSuccess {String} data  data response
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
* {
* "success": 1,
* "message": null,
* "code": 0,
* "data": [
*     {
*         "id": 3,
*         "name": "Khóa 2",
*         "slug": "khoa-2",
*         "type": "Khóa học lẻ",
*         "desktop_avatar": "nobook64108d22e3a73.png",
*         "mobile_avatar": null,
*         "intro_link": "https:*antdv.com/components/notification/#Notification",
*         "method": "Khóa video",
*         "description": "Mô tả ngắn",
*         "detail": "<p>M&ocirc; tả chi tiết kh&oacute;a học</p>",
*         "result_content": "<p>Kết quả nhận được</p>",
*         "object_content": null,
*         "include_content": {
*             "video_include": "asd",
*             "access_include": "fgg",
*             "article_include": "asdwew",
*             "certificate_include": "zxczxc"
*         }
*     },
*     {
*         "id": 2,
*         "name": "Khóa 1",
*         "slug": "khoa-1",
*         "type": "Khóa học lẻ",
*         "desktop_avatar": "nobook64108c6e1dadb.png",
*         "mobile_avatar": "nobook64108c6e1dcea.png",
*         "intro_link": "https:*antdv.com/components/notification/#Notification",
*         "method": "Khóa video",
*         "description": "mô tả ngắn",
*         "detail": "<p>chi tiết kh&oacute;a học</p>",
*         "result_content": "<p>kết quả</p>",
*         "object_content": "<p>Đối tượng học</p>",
*         "include_content": {
*             "video_include": "a",
*             "access_include": "c",
*             "article_include": "b",
*             "certificate_include": "d"
*         }
*     }
* ]
* }
 */

/**
 * @api {post} /api/course/{id}/detail Request get course's detail
 * @apiName getCourseDetail
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
*         "id": 2,
*         "login": false,
*         "name": "Khóa 1",
*         "slug": "khoa-1",
*         "type": "Khóa học lẻ",
*         "desktop_avatar": "https:*cms.nobook.asia/nobook64108c6e1dadb.png",
*         "mobile_avatar": "https:*cms.nobook.asia/nobook64108c6e1dcea.png",
*         "intro_link": "https:*antdv.com/components/notification/#Notification",
*         "method": "Khóa video",
*         "description": "mô tả ngắn",
*         "detail": "<p>chi tiết kh&oacute;a học</p>",
*         "result_content": "<p>kết quả</p>",
*         "object_content": "<p>Đối tượng học</p>",
*         "include_content": {
*             "video_include": "a",
*             "access_include": "c",
*             "article_include": "b",
*             "certificate_include": "d"
*         },
*         "classes": [
*             {
*                 "id": 12,
*                 "name": "Lớp 12",
*                 "code": "lop12",
*                 "level": "Cấp 3"
*             },
*             {
*                 "id": 10,
*                 "name": "Lớp 10",
*                 "code": "lop10",
*                 "level": "Cấp 3"
*             }
*         ],
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
*             },
*             {
*                 "id": 10,
*                 "name": "Chủ đề 3",
*                 "data": []
*             },
*             {
*                 "id": 11,
*                 "name": "Chủ đề 4",
*                 "data": []
*             }
*         ],
*         "teachers": [
*             {
*                 "id": 2,
*                 "name": "Khoa David",
*                 "label": "Giáo viên tâm lý",
*                 "avatar": "https:*cms.nobook.asia/nobook63fe17952d5ca.jpg",
*                 "description": "<p>L&agrave; gi&aacute;o vi&ecirc;n trẻ v&agrave; lu&ocirc;n nhiệt t&igrave;nh với học sinh</p>"
*             },
*             {
*                 "id": 3,
*                 "name": "tung",
*                 "label": "danh hieu",
*                 "avatar": "https:*cms.nobook.asia/nobook6411a3ac1f1f5.png",
*                 "description": "<p>mo ta ngan</p>"
*             }
*         ]
*     }
* }
 */

/**
 * @api {get} /api/home/class/list Danh sách lớp và môn học
 * @apiName HomeGetClassList
 * @apiGroup Frontend
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
*         "class": [
*             {
*                 "id": 1,
*                 "name": "Lớp 1"
*             },
*             {
*                 "id": 2,
*                 "name": "Lớp 2"
*             },
*             {
*                 "id": 3,
*                 "name": "Lớp 3"
*             },
*             {
*                 "id": 4,
*                 "name": "Lớp 4"
*             },
*             {
*                 "id": 5,
*                 "name": "Lớp 5"
*             },
*             {
*                 "id": 6,
*                 "name": "Lớp 6"
*             },
*             {
*                 "id": 7,
*                 "name": "Lớp 8"
*             },
*             {
*                 "id": 8,
*                 "name": "Lớp 7"
*             },
*             {
*                 "id": 9,
*                 "name": "Lớp 9"
*             },
*             {
*                 "id": 10,
*                 "name": "Lớp 10"
*             },
*             {
*                 "id": 11,
*                 "name": "Lớp 11"
*             },
*             {
*                 "id": 12,
*                 "name": "Lớp 12"
*             }
*         ],
*         "subject": [
*             {
*                 "id": 1,
*                 "name": "Toán"
*             },
*             {
*                 "id": 2,
*                 "name": "Lý"
*             },
*             {
*                 "id": 3,
*                 "name": "Hóa"
*             }
*         ]
*     }
* }
 */
/**
 * @api {get} /api/home/subject/list Danh sách môn
 * @apiName HomeGetSubjectList
 * @apiGroup Frontend
 * @apiSuccess {Integer} status Status of response
 * @apiSuccess {String} data  data response
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
* {
*     "success": 1,
*     "message": null,
*     "code": 0,
*     "data": [
*         {
*             "id": 1,
*             "name": "Toán"
*         },
*         {
*             "id": 2,
*             "name": "Lý"
*         },
*         {
*             "id": 3,
*             "name": "Hóa"
*         }
*     ]
* }
 */

/**
 * @api {post} /api/cms/course/list Danh sách course cho cms
 * @apiName CmsCourseList
 * @apiGroup CMS
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
*            "id": 4,
*            "lms_id": 2,
*            "name": "Khóa 3",
*            "slug": "khoa-3",
*            "sections": [
*                {
*                    "id": 1,
*                    "name": "Thông báo",
*                    "data": null
*                },
*                {
*                    "id": 2,
*                    "name": "Bài 1. Quy tắc cộng. Quy tắc nhân. Sơ đồ hình cây (P1)",
*                    "data": null
*                },
*                {
*                    "id": 3,
*                    "name": "Bài 2. Quy tắc cộng. Quy tắc nhân. Sơ đồ hình cây (P2)",
*                    "data": null
*                },
*                {
*                    "id": 4,
*                    "name": "Bài 3. Hoán vị. Chỉnh hợp. Tổ hợp (P1)",
*                    "data": null
*                },
*                {
*                    "id": 5,
*                    "name": "Bài 4. Hoán vị. Chỉnh hợp. Tổ hợp (P2)",
*                    "data": null
*                }
*            ]
*        },
*        {
*            "id": 3,
*            "lms_id": 4,
*            "name": "Khóa 2",
*            "slug": "khoa-2",
*            "sections": [
*                {
*                    "id": 12,
*                    "name": "Chủ đề 0",
*                    "data": null
*                },
*                {
*                    "id": 13,
*                    "name": "Chủ đề mẫu",
*                    "data": null
*                },
*                {
*                    "id": 14,
*                    "name": "Chủ đề 2",
*                    "data": null
*                },
*                {
*                    "id": 15,
*                    "name": "Chủ đề 3",
*                    "data": null
*                },
*                {
*                    "id": 16,
*                    "name": "Chủ đề 4",
*                    "data": null
*                }
*            ]
*        },
*        {
*            "id": 2,
*            "lms_id": 3,
*            "name": "Khóa 1",
*            "slug": "khoa-1",
*            "sections": [
*                {
*                    "id": 7,
*                    "name": "Chủ đề 0",
*                    "data": null
*                },
*                {
*                    "id": 8,
*                    "name": "Chủ đề 1 - Các phép đo",
*                    "data": null
*                },
*                {
*                    "id": 9,
*                    "name": "Chủ đề 2 - Lực",
*                    "data": null
*                },
*                {
*                    "id": 10,
*                    "name": "Chủ đề 3",
*                    "data": null
*                },
*                {
*                    "id": 11,
*                    "name": "Chủ đề 4",
*                    "data": null
*                }
*            ]
*        },
*        {
*            "id": 1,
*            "lms_id": 3,
*            "name": "Khóa học thí nghiệm khoa học tự nhiên lớp 6",
*            "slug": "tunglaso1-khoa-hoc-le",
*            "sections": [
*                {
*                    "id": 7,
*                    "name": "Chủ đề 0",
*                    "data": null
*                },
*                {
*                    "id": 8,
*                    "name": "Chủ đề 1 - Các phép đo",
*                    "data": null
*                },
*                {
*                    "id": 9,
*                    "name": "Chủ đề 2 - Lực",
*                    "data": null
*                },
*                {
*                    "id": 10,
*                    "name": "Chủ đề 3",
*                    "data": null
*                },
*                {
*                    "id": 11,
*                    "name": "Chủ đề 4",
*                    "data": null
*                }
*            ]
*        }
*    ]
*}
 */
?>
