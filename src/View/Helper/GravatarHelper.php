<?php
/*
**
** The MIT License (MIT)
** 
** Copyright (c) 2015, Marcus Alday
** 
** Permission is hereby granted, free of charge, to any person obtaining a copy
** of this software and associated documentation files (the "Software"), to deal
** in the Software without restriction, including without limitation the rights
** to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
** copies of the Software, and to permit persons to whom the Software is
** furnished to do so, subject to the following conditions:
** 
** The above copyright notice and this permission notice shall be included in
** all copies or substantial portions of the Software.
** 
** THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
** IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
** FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
** AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
** LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
** OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
** THE SOFTWARE.
** 
*/

namespace App\View\Helper;

use Cake\View\Helper;

class GravatarHelper extends Helper
{

    public $helpers = ['Html'];

    /**
     * Gravatar API Url
     */
    protected $api = 'https://www.gravatar.com/avatar';
    
    /**
     * Creates a gravatar IMG src url.
     *
     * ### Usage:
     *
     * Create a gravatar src url:
     *
     * ```
     * // get the SRC url with no options
     * echo $this->Gravatar->src('none@none.com');
     *
     * // get the SRC url with options
     * echo $this->Gravatar->src('none@none.com', ['size'=> 80, 'default'=>'mm', 'rating'=>'g']);
     *
     * ```
     *
     * Create an image link:
     *
     * ```
     * echo $this->Gravatar->image('none@none.com');
     *
     * // image tag changing default options
     * echo $this->Gravatar->image('none@none.com', ['size'=> 80, 'default'=>'mm', 'rating'=>'g']);
     * ```
     *
     * ### Options:
     *
     * - `size` Size in pixels, defaults to 80px [ 1 - 2048 ]
     * - `default` Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * - `rating` Maximum rating (inclusive) [ g | pg | r | x ]
     *
     * @param string $email The email address
     * @param array $options Optional, overloaded array that contains options for the gravatar
     *                       api call, as well as the CakePHP HTML Helper image function
     * @return String containing gravatar src url
     */
    public function src ($email, array $options = []) {
        $api = 'https://www.gravatar.com/avatar';

        $defaults = [
            'size' => 80,
            'default' => 'mm',
            'rating' =>'g'
        ];

        $options = array_merge($defaults, $options);

        return $api . '/' . md5(strtolower(trim($email))) . "?" . http_build_query([
            's' => $options['size'],
            'd' => $options['default'],
            'r' => $options['rating']
        ]);      
    }

    /**
     * Creates a gravatar IMG tag.
     * 
     * @param string $email The email address
     * @param array $options Overloaded options array for both the gravatar api and the cakephp HTML helper
     */
    public function image ($email, array $options = []) {
        $src = $this->src($email, $options);
        return $this->Html->image($src, $options);
    }
}