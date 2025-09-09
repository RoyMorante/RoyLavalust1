<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @since Version 1
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
|
*/

// Default route
$router->get('/', 'AuthController::login');

/* AUTH ROUTES */
$router->get('/auth/login', 'AuthController::login');
$router->post('/auth/login', 'AuthController::login');
$router->get('/auth/logout', 'AuthController::logout');
$router->get('/auth/register', 'AuthController::register');
$router->post('/auth/register', 'AuthController::register');

/* STUDENTS ROUTES (ADMIN ONLY) */
$router->get('/students', 'StudentsController::get_all');
$router->get('/students/get-all', 'StudentsController::get_all');
$router->get('/students/get-all/{page}', 'StudentsController::get_all');
$router->get('/students/create', 'StudentsController::create');
$router->post('/students/create', 'StudentsController::create');
$router->get('/students/update/{id}', 'StudentsController::update');
$router->post('/students/update/{id}', 'StudentsController::update');
$router->get('/students/delete/{id}', 'StudentsController::delete');
$router->get('/students/restore/{id}', 'StudentsController::restore');
$router->get('/students/hard_delete/{id}', 'StudentsController::hard_delete');

/* USER ROUTES */
$router->get('/user/profile', 'UserController::profile');
$router->get('/user/dashboard', 'UserController::dashboard');
