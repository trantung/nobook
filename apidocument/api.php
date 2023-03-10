<?php
/**
 * @api {post} /api/frontend/index Request list course's information
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
 *{
 *	'status' => 200,
 *	'data' => [
 *		{
 *			"class" => "Lop 6",
 *			"data" => [
 *				{
 *					"img_destop":"image_link_destop",
 *					"img_mobile":"image_link_mobile",
 *					"course_name":"course name",
 *					"short_description":"short mô tả chi tiết"
 *				},
 *				{
 *					"img_destop":"image_link_destop",
 *					"img_mobile":"image_link_mobile",
 *					"course_name":"course name",
 *					"short_description":"short mô tả chi tiết"
 *				}
 *			]
 *			
 *		},
 *		{
 *			"class" => "Lop 7",
 *			"data" => [
 *				{
 *					"img_destop":"image_link_destop",
 *					"img_mobile":"image_link_mobile",
 *					"course_name":"course name",
 *					"short_description":"short mô tả chi tiết"
 *				},
 *				{
 *					"img_destop":"image_link_destop",
 *					"img_mobile":"image_link_mobile",
 *					"course_name":"course name",
 *					"short_description":"short mô tả chi tiết"
 *				}
 *			]
 *		}
 *	]
 *}
 *
 * @apiError UserNotFound The id of the User was not found.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "error": "UserNotFound"
 *     }
 */

?>
